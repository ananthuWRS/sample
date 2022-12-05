<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usertype_model extends MY_Model {

	public $_table               = 'ck_usertype';
	public $protected_attributes = array('usertypeid');
	public $primary_key          = 'usertypeid';

	private $select_fields = 'usertypeid, ut_name, ut_status';

	public function __construct() {
		parent::__construct();

	}

	public function getallrows() {
		$this->db->select($this->select_fields);
		$this->db->from('ck_usertype');
		$query = $this->db->get();
		if ($query->num_rows()) {
			return $query->result();
		}
		return FALSE;
	}

}

/* End of file Usertype_model.php */
/* Location: ./application/models/Usertype_model.php */