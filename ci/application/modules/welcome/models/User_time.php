<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class User_time extends My_Model
{
	public $_table = ' ah_usertime';
	protected $primary_key = 'usertime_id';
	public $protected_attributes = array('usertime_id');
	public $validate = array(
		'formvalid' => array(
			array(
				'field' => 'name',
				'label' => 'name',
				'rules' => 'trim|required'
			),
		),

	);
	public function updateLogoutTime($data, $id, $login_time)
	{
		foreach ($data as $key => $value) {
			$this->db->set($key,$value);
		}
		//$this->db->set('ut_total_time',"TIMEDIFF (2017/08/25, 2011/08/25)");
		//$this->db->set('ut_total_time',"DATEDIFF('month', '2017/08/25', '2011/08/25')");
		$this->db->where('ut_staff_id',$id);
		$this->db->where('ut_login_time',$login_time);
		$this->db->update('ah_usertime');
	}
	public function getstaff_time()
	{
	}
}
