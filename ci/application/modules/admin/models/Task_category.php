<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Task_category extends My_Model
{
    public $_table = 'ah_task_category'; 
    protected $primary_key = 'task_categoryid';
    public $protected_attributes = array('task_categoryid');
    public $validate = array('formvalid' => array(
        array('field' => 'name',
            'label' => 'name',
            'rules' => 'trim|required'),
    ),

    );

    public $column_order = array('a.task_categoryid', 'a.tc_name', 'a.tc_status', 'a.tc_addedon');
    public $column_search = array('a.task_categoryid', 'a.tc_name','a.tc_status', 'a.tc_addedon');
    public $order = array('a.tc_addedon' => 'desc');

    private function _get_datatables_query()
    {
        
        $this->db->select('*');
        $this->db->from('ah_task_category a');     
        $this->db->where('a.tc_status','0'); 
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) //last loop
                {
                    $this->db->group_end();
                }
                //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
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
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->select('*');
        $this->db->from('ah_task_category a');  
        $this->db->where('a.tc_status','0');     
        return $this->db->count_all_results();
    }

}
