<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Tasks extends My_Model
{
    public $_table = 'ah_tasks';
    protected $primary_key = 'taskid';
    public $protected_attributes = array('taskid');
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

    public $column_order = array('a.taskid', 'a.task_title', 'b.tc_name','c.sc_name','a.task_priority','e.tsa_completed_status', 'a.task_addedon');
    public $column_search = array('a.taskid', 'a.task_title','b.tc_name','c.sc_name','a.task_priority','e.tsa_completed_status', 'a.task_addedon');
    public $order = array('a.task_addedon' => 'desc');

    private function _get_datatables_query()
    {
        if ($this->session->userdata('usertype')==1) {
            $this->db->select('a.*,b.*,c.*,AES_DECRYPT(d.au_crickf,"' . EncriptKey . '") as au_crickf,d.au_title,d.au_emp_number');
        } else {
            $this->db->select('a.*,b.*,c.*,AES_DECRYPT(d.au_crickf,"' . EncriptKey . '") as au_crickf,d.au_title,d.au_emp_number,e.*');
        }
        $this->db->from('ah_tasks a');
        if ($this->session->userdata('usertype')==2 || $this->session->userdata('usertype')=='3') {
            $this->db->join('ah_task_staff e', 'e.tsa_taskid=a.taskid', 'inner');
        }
        $this->db->join('ah_task_category b', 'b.task_categoryid=a.task_category', 'inner');
        $this->db->join('ah_subcategory c', 'c.subcategoryid=a.task_subcategory', 'left');
        $this->db->join('ck_authentication d', 'd.authenticationid=a.task_staffid', 'inner');
        if ($this->session->userdata('usertype')==2 || $this->session->userdata('usertype')=='3') {
            $this->db->where('e.tsa_staffid', $this->session->userdata('authenticationid'));
            if($this->input->post('tasktype')=='1'){
            $this->db->where('e.tsa_completed_status !=','2');
            }elseif($this->input->post('tasktype')=='2'){
                $this->db->where('e.tsa_completed_status','2');
                $this->db->where('e.tsa_approved !=','2');

            }elseif($this->input->post('tasktype')=='3'){
                $this->db->where('e.tsa_completed_status','2');
                $this->db->where('e.tsa_approved','2');
            }
        }

        $this->db->where('a.task_active', '0');

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
        if ($this->session->userdata('usertype')==1) {
            $this->db->select('a.*,b.*,c.*,AES_DECRYPT(d.au_crickf,"' . EncriptKey . '") as au_crickf,d.au_title,d.au_emp_number');
        } else {
            $this->db->select('a.*,b.*,c.*,AES_DECRYPT(d.au_crickf,"' . EncriptKey . '") as au_crickf,d.au_title,d.au_emp_number,e.*');
        }
        $this->db->from('ah_tasks a');
        if ($this->session->userdata('usertype')==2 || $this->session->userdata('usertype')=='3') {
            $this->db->join('ah_task_staff e', 'e.tsa_taskid=a.taskid', 'inner');
        }
        $this->db->join('ah_task_category b', 'b.task_categoryid=a.task_category', 'inner');
        $this->db->join('ah_subcategory c', 'c.subcategoryid=a.task_subcategory', 'left');
        $this->db->join('ck_authentication d', 'd.authenticationid=a.task_staffid', 'inner');
        if ($this->session->userdata('usertype')==2 || $this->session->userdata('usertype')=='3') {
            $this->db->where('e.tsa_staffid', $this->session->userdata('authenticationid'));
            if($this->input->post('tasktype')=='1'){
                $this->db->where('e.tsa_completed_status !=','2');
            }elseif($this->input->post('tasktype')=='2'){
                $this->db->where('e.tsa_completed_status','2');
                $this->db->where('e.tsa_approved !=','2');
            }elseif($this->input->post('tasktype')=='3'){
                $this->db->where('e.tsa_completed_status','2');
                $this->db->where('e.tsa_approved','2');
            }
        }
        $this->db->where('a.task_active', '0');
        return $this->db->count_all_results();
    }


    public function getstaffalltasks($id)
    {
        $this->db->select('a.*,b.*,c.*,AES_DECRYPT(d.au_crickf,"' . EncriptKey . '") as au_crickf,d.au_title,d.au_emp_number,e.*');

        $this->db->from('ah_tasks a');
        $this->db->join('ah_task_staff e', 'e.tsa_taskid=a.taskid', 'inner');
        $this->db->join('ah_task_category b', 'b.task_categoryid=a.task_category', 'inner');
        $this->db->join('ah_subcategory c', 'c.subcategoryid=a.task_subcategory', 'left');
        $this->db->join('ck_authentication d', 'd.authenticationid=a.task_staffid', 'inner');
        $this->db->where('e.tsa_staffid', $id);
        $this->db->where('a.task_active', '0');

        $query = $this->db->get();
        return $query->result();
    }

    public function gettaskdetails($id,$user='')
    {
        $this->db->select('*');
        $this->db->from('ah_tasks a');
        $this->db->join('ah_task_category b', 'b.task_categoryid=a.task_category', 'inner');
        $this->db->join('ah_subcategory c', 'c.subcategoryid=a.task_subcategory', 'left');
        if($user!=''){
            $this->db->join('ah_task_staff d', 'd.tsa_taskid=a.taskid', 'inner');  
            $this->db->where('d.tsa_staffid', $user);
        }
        $this->db->where('a.taskid', $id);

        $query = $this->db->get();
        return $query->result();
    }
    public function gettaskdetailswithstaff($id, $staffid)
    {
        $this->db->select('*');
        $this->db->from('ah_tasks a');
        $this->db->join('ah_task_staff e', 'e.tsa_taskid=a.taskid', 'inner');
        $this->db->join('ah_task_category b', 'b.task_categoryid=a.task_category', 'inner');
        $this->db->join('ah_subcategory c', 'c.subcategoryid=a.task_subcategory', 'left');
        $this->db->where('a.taskid', $id);
        $this->db->where('e.tsa_staffid', $staffid);
        $this->db->where('a.task_active', '0');
        $query = $this->db->get();
        return $query->row();
    }



    public $column_order_reporting = array('a.taskid','d.au_crickf', 'a.task_title', 'b.tc_name','c.sc_name','a.task_priority','e.tsa_completed_status', 'a.task_addedon');
    public $column_search_reporting = array('a.taskid','CAST(AES_DECRYPT(d.au_crickf, "' . EncriptKey . '") AS CHAR)', 'a.task_title','b.tc_name','c.sc_name','a.task_priority','e.tsa_completed_status', 'a.task_addedon');
    public $order_reporting = array('a.task_addedon' => 'desc');

    private function _get_datatables_query_reporting()
    {
        
        $this->db->select('a.*,b.*,c.*,AES_DECRYPT(d.au_crickf,"' . EncriptKey . '") as au_crickf,d.au_title,d.au_emp_number,e.*');
        $this->db->from('ah_tasks a');       
        $this->db->join('ah_task_staff e', 'e.tsa_taskid=a.taskid', 'inner');       
        $this->db->join('ah_staff_reporting_conn f', 'f.rp_staffid =e.tsa_staffid', 'inner');
        $this->db->join('ah_task_category b', 'b.task_categoryid=a.task_category', 'inner');
        $this->db->join('ah_subcategory c', 'c.subcategoryid=a.task_subcategory', 'left');
        $this->db->join('ck_authentication d', 'd.authenticationid=e.tsa_staffid', 'inner');        
        $this->db->where('a.task_active', '0');
        $this->db->where('f.rp_reportingperson', $this->session->userdata('authenticationid'));
        $this->db->where('f.rp_status','0');
        $this->db->group_by('a.taskid');

        $i = 0;
        foreach ($this->column_search_reporting as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_reporting) - 1 == $i) { //last loop
                    $this->db->group_end();
                }
                //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_reporting[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } elseif (isset($this->order_reporting)) {
            $order = $this->order_reporting;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables_reporting()
    {
        $this->_get_datatables_query_reporting();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        $query = $this->db->get();
        
        return $query->result();
    }
    public function count_filtered_reporting()
    {
        $this->_get_datatables_query_reporting();
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->num_rows();
    }
    public function count_all_reporting()
    {
        $this->db->select('a.*,b.*,c.*,AES_DECRYPT(d.au_crickf,"' . EncriptKey . '") as au_crickf,d.au_title,d.au_emp_number,e.*');
        $this->db->from('ah_tasks a');       
        $this->db->join('ah_task_staff e', 'e.tsa_taskid=a.taskid', 'inner');       
        $this->db->join('ah_staff_reporting_conn f', 'f.rp_staffid =e.tsa_staffid', 'inner');
        $this->db->join('ah_task_category b', 'b.task_categoryid=a.task_category', 'inner');
        $this->db->join('ah_subcategory c', 'c.subcategoryid=a.task_subcategory', 'left');
        $this->db->join('ck_authentication d', 'd.authenticationid=e.tsa_staffid', 'inner');        
        $this->db->where('a.task_active', '0');
        $this->db->where('f.rp_reportingperson', $this->session->userdata('authenticationid'));
        $this->db->where('f.rp_status','0');
        $this->db->group_by('a.taskid');
        return $this->db->count_all_results();
    }




    private function _get_datatables_query_reporting_finished()
    {
        
        $this->db->select('a.*,b.*,c.*,AES_DECRYPT(d.au_crickf,"' . EncriptKey . '") as au_crickf,d.au_title,d.au_emp_number,d.authenticationid,e.*');
        $this->db->from('ah_tasks a');       
        $this->db->join('ah_task_staff e', 'e.tsa_taskid=a.taskid', 'inner');       
        $this->db->join('ah_staff_reporting_conn f', 'f.rp_staffid =e.tsa_staffid', 'inner');
        $this->db->join('ah_task_category b', 'b.task_categoryid=a.task_category', 'inner');
        $this->db->join('ah_subcategory c', 'c.subcategoryid=a.task_subcategory', 'left');
        $this->db->join('ck_authentication d', 'd.authenticationid=e.tsa_staffid', 'inner');        
        $this->db->where('a.task_active', '0');
        $this->db->where('f.rp_reportingperson', $this->session->userdata('authenticationid'));
        $this->db->where('f.rp_status','0');
        $this->db->where('e.tsa_completed_status','2');
       // $this->db->group_by('a.taskid');

        $i = 0;
        foreach ($this->column_search_reporting as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_reporting) - 1 == $i) { //last loop
                    $this->db->group_end();
                }
                //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_reporting[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } elseif (isset($this->order_reporting)) {
            $order = $this->order_reporting;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables_reporting_finished()
    {
        $this->_get_datatables_query_reporting_finished();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        $query = $this->db->get();
        
        return $query->result();
    }
    public function count_filtered_reporting_finished()
    {
        $this->_get_datatables_query_reporting_finished();
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->num_rows();
    }
    public function count_all_reporting_finished()
    {
        $this->db->select('a.*,b.*,c.*,AES_DECRYPT(d.au_crickf,"' . EncriptKey . '") as au_crickf,d.au_title,d.au_emp_number,d.authenticationid,e.*');
        $this->db->from('ah_tasks a');       
        $this->db->join('ah_task_staff e', 'e.tsa_taskid=a.taskid', 'inner');       
        $this->db->join('ah_staff_reporting_conn f', 'f.rp_staffid =e.tsa_staffid', 'inner');
        $this->db->join('ah_task_category b', 'b.task_categoryid=a.task_category', 'inner');
        $this->db->join('ah_subcategory c', 'c.subcategoryid=a.task_subcategory', 'left');
        $this->db->join('ck_authentication d', 'd.authenticationid=e.tsa_staffid', 'inner');        
        $this->db->where('a.task_active', '0');
        $this->db->where('f.rp_reportingperson', $this->session->userdata('authenticationid'));
        $this->db->where('f.rp_status','0');
        $this->db->where('e.tsa_completed_status','2');
       // $this->db->group_by('a.taskid');
        return $this->db->count_all_results();
    }

    public function getstaffalltasksonadate($id,$date)
    {
        $this->db->select('a.*,e.*');

        $this->db->from('ah_tasks a');
        $this->db->join('ah_task_staff e', 'e.tsa_taskid=a.taskid', 'inner');
       // $this->db->join('ah_task_category b', 'b.task_categoryid=a.task_category', 'inner');
       // $this->db->join('ah_subcategory c', 'c.subcategoryid=a.task_subcategory', 'left');
       // $this->db->join('ck_authentication d', 'd.authenticationid=a.task_staffid', 'inner');
        $this->db->where('e.tsa_staffid', $id);
        $this->db->where('a.task_date', $date);
        $this->db->where('a.task_active', '0');

        $query = $this->db->get();
        return $query->result();
    }
}
