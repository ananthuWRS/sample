<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Usertype extends My_Model
{
    public $_table               = 'ck_usertype';
	public $protected_attributes = array('usertypeid');
	public $primary_key          = 'usertypeid';

	private $select_fields = 'usertypeid, ut_name, ut_status';

	public function getusertype($type_status,$typeid) {
		$this->db->select($this->select_fields);
		$this->db->from('ck_usertype');
		$this->db->where_in('ut_status', $type_status);
		$this->db->where_in('usertypeid', $typeid);
		$query = $this->db->get();
		if ($query->num_rows()) {
			return $query->result();
		}
		return FALSE;
	}
}
