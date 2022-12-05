<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Task_status_details extends My_Model
{
    public $_table = 'ah_task_status_details';
    protected $primary_key = 'task_details_id';
    public $protected_attributes = array('task_details_id');
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

    public function getmaxstatus($taskid,$userid){
        $this->db->select_max('a.td_completion_percentage','maxstatus');
        $this->db->from('ah_task_status_details a');
        $this->db->where('a.td_staff_id',$userid);
        $this->db->where('a.td_task_id',$taskid);
        $query = $this->db->get();
        return  $query->row()->maxstatus;
    }


    public function getpreviousentrydate($taskid,$user,$task_execution_date){
        $this->db->select('*');
        $this->db->from('ah_task_status_details a');
        $this->db->where('a.td_staff_id',$user);
        $this->db->where('a.td_task_id',$taskid);
        $this->db->where('a.td_execution_date >',date('Y-m-d', strtotime($task_execution_date)));
        $this->db->order_by('a.td_execution_date','asc');
        $this->db->limit('1');
        $query = $this->db->get();
        $result=[];
        if($query->num_rows()> 0){
           $resultArray= $query->row();
            $result['nextdatestatus']=$resultArray->td_completion_percentage;
        }

        $this->db->select('*');
        $this->db->from('ah_task_status_details a');
        $this->db->where('a.td_staff_id',$user);
        $this->db->where('a.td_task_id',$taskid);
        $this->db->where('a.td_execution_date < ',date('Y-m-d', strtotime($task_execution_date)));
        $this->db->order_by('a.td_execution_date','asc');
        $this->db->limit('1');
        $query2 = $this->db->get();
        if($query2->num_rows()> 0){
            $resultArray2= $query2->row();
             $result['previousdatestatus']=$resultArray2->td_completion_percentage;
         }
        return $result;
    }

   
}
