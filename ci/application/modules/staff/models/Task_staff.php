<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Task_staff extends My_Model
{
    public $_table = 'ah_task_staff';
    protected $primary_key = 'task_staff_addedid';
    public $protected_attributes = array('task_staff_addedid');
    public $validate = array('formvalid' => array(
        array('field' => 'task_name',
            'label' => 'task_name',
            'rules' => 'trim|required'),
            array('field' => 'category',
            'label' => 'category',
            'rules' => 'trim|required'),
            array('field' => 'subcategory',
            'label' => 'subcategory',
            'rules' => 'trim|required'),
            array('field' => 'task_status',
            'label' => 'task_status',
            'rules' => 'trim|required'),
            array('field' => 'priority',
            'label' => 'priority',
            'rules' => 'trim|required'),
    ),

    );

    public $column_order = array('a.task_staff_addedid', 'a.c.au_crickf', 'a.tsa_completed_status','a.tsa_completed_percentage','a.tsa_status','a.tsa_addedon');
    public $column_search = array('a.task_staff_addedid', 'CAST(AES_DECRYPT(c.au_crickf, "' . EncriptKey . '") AS CHAR)','a.tsa_completed_status','a.tsa_completed_percentage');
    public $order = array('a.tsa_addedon' => 'desc');

    private function _get_datatables_query()
    {
       
        $this->db->select('a.*,b.*,AES_DECRYPT(d.au_crickf,"' . EncriptKey . '") as au_crickf,d.authenticationid,d.au_title,d.au_emp_number');
        
        $this->db->from('ah_task_staff a');       
        $this->db->join('ah_tasks b', 'a.tsa_taskid=b.taskid', 'inner');           
        $this->db->join('ck_authentication d', 'd.authenticationid=a.tsa_staffid', 'inner');
        $this->db->where('a.tsa_status','0');
        $this->db->where('a.tsa_taskid',$this->input->post('viewtaskid',true));
if ($this->session->userdata('usertype')==2 || $this->session->userdata('usertype')=='3') {
    $this->db->join('ah_staff_reporting_conn f', 'f.rp_staffid =a.tsa_staffid', 'inner');
    $this->db->where('f.rp_reportingperson', $this->session->userdata('authenticationid'));
    $this->db->where('f.rp_status','0');
}
        
       

        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) { //last loop
                    $this->db->group_end();
                }
                //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } elseif (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }
    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->select('a.*,b.*,AES_DECRYPT(d.au_crickf,"' . EncriptKey . '") as au_crickf,d.au_title,d.au_emp_number');
        
        $this->db->from('ah_task_staff a');       
        $this->db->join('ah_tasks b', 'a.tsa_taskid=b.taskid', 'inner');           
        $this->db->join('ck_authentication d', 'd.authenticationid=a.tsa_staffid', 'inner');
        $this->db->where('a.tsa_status','0');
        $this->db->where('a.tsa_taskid',$this->input->post('viewtaskid',true));
        if ($this->session->userdata('usertype')==2 || $this->session->userdata('usertype')=='3') {
            $this->db->join('ah_staff_reporting_conn f', 'f.rp_staffid =a.tsa_staffid', 'inner');
            $this->db->where('f.rp_reportingperson', $this->session->userdata('authenticationid'));
            $this->db->where('f.rp_status','0');
        }
        return $this->db->count_all_results();
    }

    public function gettaskstaffids($task)
    {
        $this->db->select('GROUP_CONCAT(a.tsa_staffid) as taskstaff');
        $this->db->from('ah_task_staff a');        
        $this->db->where('a.tsa_taskid', $task);
        $this->db->where('a.tsa_status', '0');        
        $query = $this->db->get();        
        return $query->result();
    }
}
