<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Task_approved_details extends My_Model
{
    public $_table = 'ah_staff_task_approved_details';
    protected $primary_key = 'approveddetailsid';
    public $protected_attributes = array('approveddetailsid');
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

   

   
}
