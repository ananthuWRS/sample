<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Userauthentication_model extends MY_Model
{

	public $_table               = 'ck_authentication';
	public $protected_attributes = array('authenticationid');
	public $primary_key          = 'authenticationid';

	public $validate = array(
		'adduser_validation'              => array(
			array(
				'field' => 'firstname',
				'label' => 'firstname',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'emailaddress',
				'label' => 'emailaddress',
				'rules' => 'trim|required|valid_email',
			),
			array(
				'field' => 'contactnumber',
				'label' => 'contactnumber',
				'rules' => 'trim|required',
			),
		),




		'updateprofile' => array(
			array(
				'field' => 'firstname',
				'label' => 'First Name',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'phone',
				'label' => 'mobilenumber',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'email',
				'label' => 'email ',
				'rules' => 'trim|required|valid_email',
			),

		),
		'changepassword'                  => array(
			array(
				'field' => 'newpassword',
				'label' => 'New password',
				'rules' => 'required|min_length[5]',
			),
			array(
				'field' => 'confirmpassword',
				'label' => 'Confirm password',
				'rules' => 'required|min_length[8]|matches[newpassword]',
			),
			array(
				'field' => 'currentpassword',
				'label' => 'currentpassword password',
				'rules' => 'required|min_length[8]',
			),

		),
		'logincheck'                      => array(
			array(
				'field' => 'username',
				'label' => 'User Name',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'userpassword',
				'label' => 'Password',
				'rules' => 'trim|required|min_length[5]',
			),

		), 'updateuser_validation_no_password'           => array(
			array(
				'field' => 'staff_email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email',
			),
			array(
				'field' => 'staff_name',
				'label' => 'First Name',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'staff_title',
				'label' => 'staff_title',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'staff_empnumber',
				'label' => 'staff_empnumber',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'staff_gender',
				'label' => 'staff_gender',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'staff_department',
				'label' => 'staff_department',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'staff_school',
				'label' => 'staff_school',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'staff_campus',
				'label' => 'staff_campus',
				'rules' => 'trim|required',
			), array(
				'field' => 'staff_type',
				'label' => 'staff_type',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'staff_location',
				'label' => 'staff_location',
				'rules' => 'required'
			),

		),
		'updateuser_validation'           => array(
			array(
				'field' => 'staff_email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email',
			),
			array(
				'field' => 'staff_name',
				'label' => 'First Name',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'staff_title',
				'label' => 'staff_title',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'staff_empnumber',
				'label' => 'staff_empnumber',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'staff_gender',
				'label' => 'staff_gender',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'staff_department',
				'label' => 'staff_department',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'staff_school',
				'label' => 'staff_school',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'staff_campus',
				'label' => 'staff_campus',
				'rules' => 'trim|required',
			), array(
				'field' => 'staff_type',
				'label' => 'staff_type',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'staff_pass',
				'label' => 'staff_pass',
				'rules' => 'required'
			),
			array(
				'field' => 'staff_confirmpass',
				'label' => 'staff_confirmpass',
				'rules' => 'required'
			),	array(
				'field' => 'staff_location',
				'label' => 'staff_location',
				'rules' => 'required'
			),

		),
		'newstaff_validations' => array(
			array(
				'field' => 'staff_email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email',
			),
			array(
				'field' => 'staff_name',
				'label' => 'First Name',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'staff_title',
				'label' => 'staff_title',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'staff_empnumber',
				'label' => 'staff_empnumber',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'staff_gender',
				'label' => 'staff_gender',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'staff_department',
				'label' => 'staff_department',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'staff_school',
				'label' => 'staff_school',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'staff_campus',
				'label' => 'staff_campus',
				'rules' => 'trim|required',
			), array(
				'field' => 'staff_type',
				'label' => 'staff_type',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'staff_pass',
				'label' => 'staff_pass',
				'rules' => 'required'
			),
			array(
				'field' => 'staff_confirmpass',
				'label' => 'staff_confirmpass',
				'rules' => 'required'
			),	array(
				'field' => 'staff_location',
				'label' => 'staff_location',
				'rules' => 'required'
			),

		),
	);

	private $select_fields = 'authenticationid,
AES_DECRYPT(au_crickus, "' . EncriptKey . '") as au_crickus,
AES_DECRYPT(au_crickf, "' . EncriptKey . '") as au_crickf,
AES_DECRYPT(au_crickl, "' . EncriptKey . '") as au_crickl,
AES_DECRYPT(au_crickpn, "' . EncriptKey . '") as au_crickpn,
AES_DECRYPT(au_cricke, "' . EncriptKey . '") as au_cricke,
AES_DECRYPT(au_cricka, "' . EncriptKey . '") as au_cricka,
au_designation,
au_createdon,
au_usertype,
au_status,
au_salt,
au_emailverification,au_crickp,au_emp_number,au_title,au_designation,au_campus,au_school,au_deptarment,au_gender
';

	public function getrowbyid($id = 0)
	{
		$this->db->select('c.authenticationid,
        AES_DECRYPT(c.au_crickus, "' . EncriptKey . '") as au_crickus,
        au_crickp,
        AES_DECRYPT(c.au_crickf, "' . EncriptKey . '") as au_crickf,
        AES_DECRYPT(c.au_crickl, "' . EncriptKey . '") as au_crickl,
        AES_DECRYPT(c.au_crickpn, "' . EncriptKey . '") as au_crickpn,
        AES_DECRYPT(c.au_cricke, "' . EncriptKey . '") as au_cricke,
        AES_DECRYPT(c.au_cricka, "' . EncriptKey . '") as au_cricka,
        c.au_designation,
        c.au_createdon,
        c.au_usertype,
        c.au_status,        
        c.au_emailverification');
		$this->db->from('ck_authentication c');
		$this->db->where('c.authenticationid', $id);
		$this->db->where('c.au_status', 0);
		$query = $this->db->get();
		if ($query->num_rows()) {
			return $query->row();
		}
		return FALSE;
	}

	public function getrowbyid_array(array $id = [])
	{
		$this->db->select($this->select_fields);
		$this->db->from('ck_authentication');
		$this->db->where_in('authenticationid', $id);
		$query = $this->db->get();
		if ($query->num_rows()) {
			return $query->result();
		}
		return FALSE;
	}

	public function getrowby_salt_fid($id = '', $fid = 0)
	{

		$this->db->select($this->select_fields);

		$this->db->from('ck_authentication');

		$this->db->where('au_salt', $id);
		$this->db->where('au_facilityid', $fid);

		$query = $this->db->get();

		if ($query->num_rows()) {
			return $query->row();
		}
		return FALSE;
	}

	public function getuserdetails($data)
	{

		$this->db->select($this->select_fields);
		$this->db->from('ck_authentication');
		$this->db->where($data);
		$query = $this->db->get();
		if ($query->num_rows()) {
			return $query->row();
		}
		return FALSE;
	}


	public function getallusers($data)
	{

		$this->db->select($this->select_fields);
		$this->db->from('ck_authentication');
		$this->db->where($data);
		$query = $this->db->get();
		if ($query->num_rows()) {
			return $query->result();
		}
		return FALSE;
	}

	public function getactiveusers($fid = 0, $userids = [])
	{
		$this->db->select(getusernamehelper('a') . ', b.ut_name, GROUP_CONCAT(c.pd_name SEPARATOR " , ") AS premisesassigned');
		$this->db->from('ck_authentication a');
		$this->db->join('ck_usertype b', 'a.au_usertype = b.usertypeid', 'left');
		$this->db->join('ck_premisesdetails c', 'FIND_IN_SET(c.pd_premiseid, a.au_premisesids) != 0', 'left');
		if (!empty($userids)) {
			$this->db->where_in('authenticationid', $userids);
		}
		$this->db->where('a.au_facilityid', $fid);
		$this->db->where('a.au_usertype', Roles::user);
		$this->db->where('a.au_status', 0);
		$this->db->where('b.ut_status', 0);

		$this->db->group_by('a.authenticationid');
		$this->db->order_by('orderbyfirstname', 'asc');

		$query = $this->db->get();
		// echo  $this->db->last_query();exit;
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return FALSE;
	}

	public function getactiveusersby_facility($fid = 0)
	{
		$this->db->select(getusernamehelper('a') . ', b.ut_name');

		$this->db->from('ck_authentication a');
		$this->db->join('ck_usertype b', 'a.au_usertype=b.usertypeid', 'left');

		$this->db->where('a.au_facilityid', $fid);
		$this->db->where('a.au_status', 0);
		$this->db->where('b.ut_status', 0);

		$this->db->order_by('orderbyfirstname', 'asc');

		$query = $this->db->get();
		//echo  $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return FALSE;
	}

	public function getactiveusersby_facility_premiseid($fid = 0, $pid = 0)
	{
		$this->db->select(getusernamehelper('a') . ', b.ut_name');

		$this->db->from('ck_authentication a');
		$this->db->join('ck_usertype b', 'a.au_usertype=b.usertypeid', 'left');

		$this->db->where('a.au_status', 0);
		$this->db->where('b.ut_status', 0);
		$this->db->where('a.au_facilityid', $fid);
		$this->db->where('(FIND_IN_SET(' . $pid . ', a.au_premisesids) OR (a.au_usertype = ' . Roles::facilities . '))', NULL, FALSE);

		$this->db->order_by('orderbyfirstname', 'asc');

		$query = $this->db->get();
		//echo  $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return FALSE;
	}

	public function getactivestaffsby_usertype_facility_premisesid($utype = 0, $fid = 0, $pid = 0)
	{
		$this->db->select(getusernamehelper('a') . ', b.ut_name');

		$this->db->from('ck_authentication a');
		$this->db->join('ck_usertype b', 'a.au_usertype = b.usertypeid', 'left');

		$this->db->where('a.au_usertype', $utype);
		$this->db->where('a.au_facilityid', $fid);
		$this->db->where('FIND_IN_SET(' . $pid . ', a.au_premisesids) ', NULL, FALSE);

		$this->db->where('a.au_status', 0);
		$this->db->where('b.ut_status', 0);

		$this->db->order_by('orderbyfirstname', 'asc');

		$query = $this->db->get();
		//echo  $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return FALSE;
	}

	public function getrowsby_usertype_facilityid($usertype = '', $fid = 0)
	{
		$this->db->select(getusernamehelper('a') . ', dn_designation, GROUP_CONCAT(c.pd_name SEPARATOR " , ") AS premisesassigned');
		$this->db->from('ck_authentication a');
		$this->db->join('ck_designation b', 'a.au_designation = b.dn_designationid', 'left');
		$this->db->join('ck_premisesdetails c', 'FIND_IN_SET(c.pd_premiseid, a.au_premisesids) != 0', 'left');

		$this->db->where('a.au_usertype', $usertype);
		$this->db->where('a.au_facilityid', $fid);

		$this->db->group_by('a.authenticationid');

		$this->db->order_by('orderbyfirstname', 'asc');
		$query = $this->db->get();
		//echo  $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return FALSE;
	}

	public function getactiverowsby_usertype_facilityid($usertype = '', $fid = 0)
	{
		$this->db->select(getusernamehelper('a') . ', dn_designation, GROUP_CONCAT(c.pd_name SEPARATOR " , ") AS premisesassigned');
		$this->db->from('ck_authentication a');
		$this->db->join('ck_designation b', 'a.au_designation = b.dn_designationid', 'left');
		$this->db->join('ck_premisesdetails c', 'FIND_IN_SET(c.pd_premiseid, a.au_premisesids) != 0', 'left');

		$this->db->where('a.au_usertype', $usertype);
		$this->db->where('a.au_facilityid', $fid);
		$this->db->where('a.au_status', 0);

		$this->db->group_by('a.authenticationid');

		$this->db->order_by('orderbyfirstname', 'asc');
		$query = $this->db->get();
		//echo  $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return FALSE;
	}

	public function getactiverowsby_designation_facilityid($usertype = '', $fid = 0, $pid = 0)
	{
		$this->db->select(getusernamehelper('a') . ', dn_designation, GROUP_CONCAT(c.pd_name SEPARATOR " , ") AS premisesassigned');
		$this->db->from('ck_authentication a');
		$this->db->join('ck_designation b', 'a.au_designation = b.dn_designationid', 'left');
		$this->db->join('ck_premisesdetails c', 'FIND_IN_SET(c.pd_premiseid, a.au_premisesids) != 0', 'left');

		$this->db->where('a.au_designation', $usertype);
		$this->db->where('a.au_facilityid', $fid);
		$this->db->where('FIND_IN_SET(' . $pid . ', a.au_premisesids) ', NULL, FALSE);
		$this->db->where('a.au_status', 0);

		$this->db->group_by('a.authenticationid');

		$this->db->order_by('orderbyfirstname', 'asc');
		$query = $this->db->get();
		//echo  $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return FALSE;
	}

	public function registerclubuser($data)
	{
		$this->db->set('au_crickus', "AES_ENCRYPT('{$data['au_crickus']}','" . EncriptKey . "')", false);
		$this->db->set('au_crickp', $data['au_crickp']);
		$this->db->set('au_crickf', "AES_ENCRYPT('{$data['au_crickf']}','" . EncriptKey . "')", false);
		$this->db->set('au_crickl', "AES_ENCRYPT('{$data['au_crickl']}','" . EncriptKey . "')", false);
		$this->db->set('au_crickpn', "AES_ENCRYPT('{$data['au_crickpn']}','" . EncriptKey . "')", false);
		// $this->db->set('au_crickhpn', "AES_ENCRYPT('{$data['au_crickhpn']}','" . EncriptKey . "')", false);
		$this->db->set('au_cricke', "AES_ENCRYPT('{$data['au_cricke']}','" . EncriptKey . "')", false);
		$this->db->set('au_designation', $data['au_designation']);
		$this->db->set('au_facilityid', $data['au_facilityid']);
		$this->db->set('au_createdon', $data['au_createdon']);
		$this->db->set('au_usertype', $data['au_usertype']);
		$this->db->set('au_salt', $data['au_salt']);
		$this->db->set('au_createdby', $data['au_createdby']);
		$this->db->set('au_premisesids', $data['au_premisesids']);
		// $this->db->set('au_clubid', $data['au_clubid']);
		// $this->db->set('au_adminpermission', $data['au_adminpermission']);
		$this->db->insert('ck_authentication');
		return $insert_id = $this->db->insert_id();
	}

	public function updateclubuser($condition, $data)
	{
		$this->db->set('au_crickf', "AES_ENCRYPT('{$data['au_crickf']}','" . EncriptKey . "')", false);
		$this->db->set('au_crickl', "AES_ENCRYPT('{$data['au_crickl']}','" . EncriptKey . "')", false);
		$this->db->set('au_crickpn', "AES_ENCRYPT('{$data['au_crickpn']}','" . EncriptKey . "')", false);
		$this->db->set('au_cricke', "AES_ENCRYPT('{$data['au_cricke']}','" . EncriptKey . "')", false);
		$this->db->set('au_designation', $data['au_designation']);
		$this->db->set('au_createdon', $data['au_createdon']);
		$this->db->set('au_createdby', $data['au_createdby']);
		$this->db->set('au_premisesids', $data['au_premisesids']);
		$this->db->where($condition);
		$this->db->update('ck_authentication');
		return $this->db->affected_rows();
	}

	public function updatepasswordbysalt($salt, $data)
	{
		$this->db->set('au_crickp', $data['au_crickp']);
		$this->db->set('au_createdon', $data['au_createdon']);
		$this->db->set('au_createdby', $data['au_createdby']);
		$this->db->where('au_salt', $salt);
		$this->db->update('ck_authentication');
		return $this->db->affected_rows();
	}

	public function updatebysalt($salt, $data)
	{
		$this->db->where('au_salt', $salt);
		$this->db->update('ck_authentication', $data);
		return $this->db->affected_rows();
	}

	public function gettotalcountusertype($usertype, $facilityid)
	{
		$this->db->select('authenticationid');
		$this->db->where('au_status', 0);
		$this->db->where('au_usertype', 2);
		$this->db->where('au_designation', $usertype);
		$this->db->where('au_facilityid', $facilityid);
		$result = $this->db->count_all_results('ck_authentication');
		return $result;
	}

	public function usersinactivecount_all($userttypeid, $facilityid)
	{

		$this->db->select('authenticationid');
		$this->db->where('au_designation', $userttypeid);
		$this->db->where('au_status', '1');
		$this->db->where('au_usertype', 2);
		$this->db->where('au_facilityid', $facilityid);
		$num_results = $this->db->count_all_results('ck_authentication');
		return $num_results;
	}

	public function getallfacilitystaffnos($facilityid)
	{
		$this->db->select('authenticationid');
		$this->db->where('au_status', 0);
		$this->db->where('au_usertype', 2);
		$this->db->where('au_facilityid', $facilityid);
		$num_results = $this->db->count_all_results('ck_authentication');
		return $num_results;
	}

	public function getsecurityuserdeatils($usertype, $facilityid)
	{

		$this->db->select($this->select_fields);

		$this->db->where('au_designation', $usertype);
		$this->db->where('au_status', 0);
		$this->db->where('au_usertype', 2);
		$this->db->where('au_facilityid', $facilityid);
		$q = $this->db->get('ck_authentication');

		if ($q->num_rows()) {
			return $q->result();
		}
		return FALSE;
	}

	public function getallstaffdetails($staffids)
	{
		$this->db->select(getusernamehelper('a') . ', b.ut_name');

		$this->db->from('ck_authentication a');
		$this->db->join('ck_usertype b', 'a.au_usertype=b.usertypeid', 'left');

		$this->db->where_in('a.authenticationid', $staffids);
		// $this->db->where('a.au_status', 0);
		// $this->db->where('b.ut_status', 0);
		$this->db->order_by('orderbyfirstname', 'asc');

		$query = $this->db->get();
		//echo  $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	public function firststaffid()
	{
		$this->db->select('authenticationid');
		$this->db->from('ck_authentication');
		$this->db->where('au_status', 0);
		$this->db->where('au_usertype', 2);
		$this->db->where('au_facilityid', $this->session->userdata('facilityid'));
		$this->db->where('(FIND_IN_SET(' . $this->session->userdata('premiseid') . ', au_premisesids))', NULL, FALSE);
		$this->db->order_by('authenticationid', 'ASC');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				return $row->authenticationid;
			}
		}
	}

	public function activestafflisting()
	{
		$this->db->select(getusernamehelper('a') . ',b.*,c.dn_designation');
		$this->db->from('ck_authentication a');
		$this->db->join('ck_usertype b', 'a.au_usertype=b.usertypeid', 'left');
		$this->db->join('ck_designation c', 'a.au_designation=c.dn_designationid', 'left');
		$this->db->where('a.au_status', 0);
		$this->db->where('a.au_usertype', 2);
		$this->db->where('a.au_facilityid', $this->session->userdata('facilityid'));
		$this->db->where('(FIND_IN_SET(' . $this->session->userdata('premiseid') . ', a.au_premisesids))', NULL, FALSE);
		$this->db->order_by('a.authenticationid', 'ASC');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	public function getrowsbyactivetrinmatrixworkingtype()
	{
		$this->db->select(getusernamehelper('a') . ',a.au_usertype,b.*,c.dn_designationid, c.dn_designation');
		$this->db->from('ck_authentication a');
		$this->db->join('ck_usertype b', 'a.au_usertype=b.usertypeid', 'left');
		$this->db->join('ck_designation c', 'c.dn_designationid=a.au_designation', 'left');
		$this->db->where('a.au_status', 0);
		$this->db->where('a.au_usertype', 2);
		$this->db->where('a.au_facilityid', $this->session->userdata('facilityid'));
		$this->db->where('(FIND_IN_SET(' . $this->session->userdata('premiseid') . ', a.au_premisesids))', NULL, FALSE);
		$this->db->order_by('c.dn_designation', 'ASC');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}

	public function getrowsbyactivetrinmatrixworkingtypefilter($usertypes)
	{
		$this->db->select(getusernamehelper('a') . ',a.au_usertype,b.*,c.dn_designationid, c.dn_designation');
		$this->db->from('ck_authentication a');
		$this->db->join('ck_usertype b', 'a.au_usertype=b.usertypeid', 'left');
		$this->db->join('ck_designation c', 'c.dn_designationid=a.au_designation', 'left');
		$this->db->where('a.au_status', 0);
		$this->db->where('a.au_usertype', 2);
		$this->db->where('a.au_facilityid', $this->session->userdata('facilityid'));
		$this->db->where('(FIND_IN_SET(' . $this->session->userdata('premiseid') . ', a.au_premisesids))', NULL, FALSE);
		$this->db->where_in('c.dn_designationid', $usertypes);
		$this->db->order_by('c.dn_designation', 'ASC');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}



	public function selectedemployeedetails($empid)
	{
		$this->db->select(getusernamehelper('a') . ',b.*,c.dn_designation');
		$this->db->from('ck_authentication a');
		$this->db->join('ck_usertype b', 'a.au_usertype=b.usertypeid', 'left');
		$this->db->join('ck_designation c', 'a.au_designation=c.dn_designationid', 'left');
		$this->db->where('a.au_status', 0);
		// $this->db->where('a.au_usertype', 2);   
		$this->db->where('a.authenticationid', $empid);

		$this->db->where('a.au_facilityid', $this->session->userdata('facilityid'));
		$this->db->where('(FIND_IN_SET(' . $this->session->userdata('premiseid') . ', a.au_premisesids))', NULL, FALSE);

		$query = $this->db->get();
		// echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	public function lastemployeeid()
	{
		$this->db->select('authenticationid');
		$this->db->from('ck_authentication');
		$this->db->where('a.au_status', 0);
		$this->db->where('a.au_usertype', 2);
		$this->db->order_by('authenticationid', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				return $row->authenticationid;
			}
		}
	}



	public function leftsideemployees($empid)
	{
		$this->db->select(getusernamehelper('a') . ',b.*');
		$this->db->from('ck_authentication a');
		$this->db->join('ck_usertype b', 'a.au_usertype=b.usertypeid', 'left');
		$this->db->where('a.au_status', 0);
		$this->db->where('a.au_usertype', 2);
		$this->db->where('a.authenticationid <', $empid);

		$this->db->where('a.au_facilityid', $this->session->userdata('facilityid'));
		$this->db->where('(FIND_IN_SET(' . $this->session->userdata('premiseid') . ', a.au_premisesids))', NULL, FALSE);
		$this->db->order_by('a.authenticationid', 'DESC');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}


	public function rightsideemployees($empid)
	{
		$this->db->select(getusernamehelper('a') . ',b.*');
		$this->db->from('ck_authentication a');
		$this->db->join('ck_usertype b', 'a.au_usertype=b.usertypeid', 'left');
		$this->db->where('a.au_status', 0);
		$this->db->where('a.au_usertype', 2);
		$this->db->where('a.authenticationid >', $empid);

		$this->db->where('a.au_facilityid', $this->session->userdata('facilityid'));
		$this->db->where('(FIND_IN_SET(' . $this->session->userdata('premiseid') . ', a.au_premisesids))', NULL, FALSE);
		$this->db->order_by('a.authenticationid', 'ASC');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	public function nextresid()
	{
		$this->db->select('authenticationid');
		$this->db->from('ck_authentication');
		$this->db->where('au_status', '0');
		$this->db->where('au_usertype', '2');
		$this->db->limit(1, 1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				return $row->authenticationid;
			}
		} else {
			return false;
		}
	}



	public function previousresid2()
	{
		$this->db->select('en_userid');
		$this->db->from('ck_authentication');
		$this->db->where('au_status', '0');
		$this->db->where('au_usertype', '2');
		$this->db->order_by('authenticationid', 'DESC');
		$this->db->limit(1, 1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				return $row->en_userid;
			}
		} else {
			return false;
		}
	}

	public function previousresid1($empid)
	{
		$query = $this->db->query('SELECT * FROM ck_authentication WHERE authenticationid<' . $empid . ' AND au_status = "0" AND au_usertype = "2" ORDER BY authenticationid DESC LIMIT 1');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				return $row->authenticationid;
			}
		} else {
			return "first";
		}
	}

	public function nextresid1($empid)
	{
		$query = $this->db->query('SELECT * FROM ck_authentication WHERE authenticationid>' . $empid . ' AND au_status = "0" AND au_usertype = "2" LIMIT 1');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				return $row->authenticationid;
			}
		} else {
			return "last";
		}
	}

	public function staffbydesignation($designation)
	{
		$this->db->select(getusernamehelper('a') . ',b.*');
		$this->db->from('ck_authentication a');
		$this->db->join('ck_usertype b', 'a.au_usertype=b.usertypeid', 'left');
		$this->db->where('a.au_status', 0);
		$this->db->where('a.au_usertype', 2);
		$this->db->where_in('a.au_designation', $designation);
		$this->db->where('a.au_facilityid', $this->session->userdata('facilityid'));
		$this->db->where('(FIND_IN_SET(' . $this->session->userdata('premiseid') . ', a.au_premisesids))', NULL, FALSE);
		$this->db->order_by('a.authenticationid', 'ASC');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	public function inserttoauthenticationtable($encripted = array(), $nonencripted = array())
	{

		if (count($encripted) > 0) {
			foreach ($encripted as $key => $value) {

				$this->db->set($key, "AES_ENCRYPT('{$value}','" . EncriptKey . "')", false);
			}
		}

		if (count($nonencripted) > 0) {
			foreach ($nonencripted as $key => $value) {

				$this->db->set($key, $value);
			}
		}

		$this->db->insert('ck_authentication');
		return  $this->db->insert_id();
	}

	public function updateauthenticationtable($condition, $encripted = array(), $nonencripted = array())
	{
		if (count($encripted) > 0) {
			foreach ($encripted as $key => $value) {

				$this->db->set($key, "AES_ENCRYPT('{$value}','" . EncriptKey . "')", false);
			}
		}
		if (count($nonencripted) > 0) {
			foreach ($nonencripted as $key => $value) {
				$this->db->set($key, $value);
			}
		}

		$this->db->where($condition);
		$this->db->update('ck_authentication');
		return $this->db->affected_rows();
	}


	public function getemployerdetailsbyid($id = 0)
	{
		$this->db->select('c.authenticationid,
        AES_DECRYPT(c.au_crickus, "' . EncriptKey . '") as au_crickus,
        AES_DECRYPT(c.au_crickf, "' . EncriptKey . '") as au_crickf,
        AES_DECRYPT(c.au_crickl, "' . EncriptKey . '") as au_crickl,
        AES_DECRYPT(c.au_crickpn, "' . EncriptKey . '") as au_crickpn,
        AES_DECRYPT(c.au_cricke, "' . EncriptKey . '") as au_cricke,
        AES_DECRYPT(c.au_cricka, "' . EncriptKey . '") as au_cricka,
        c.au_designation,
        c.au_createdon,
        c.au_usertype,
        c.au_status,
        c.au_firstlogin,
        c.au_profile,
        c.au_facilityid,
        c.au_userappauthid,
        c.au_devicetoken,
        c.au_emailverification,
        c.au_otp,
        c.au_otp_status,
        c.au_devicetype,
        c.au_salt,
        c.au_passwordreset,d.*');
		$this->db->from('ck_authentication c');
		$this->db->join('v_user_connections b', 'c.authenticationid=b.uc_userid', 'inner');
		$this->db->join('v_employer d', 'b.uc_employer_center=d.employerid', 'inner');
		$this->db->where('c.authenticationid', $id);
		$query = $this->db->get();
		if ($query->num_rows()) {
			return $query->row();
		}
		return FALSE;
	}


	public function getcentersdetailsbyid($id = 0)
	{
		$this->db->select('c.authenticationid,
        AES_DECRYPT(c.au_crickus, "' . EncriptKey . '") as au_crickus,
        AES_DECRYPT(c.au_crickf, "' . EncriptKey . '") as au_crickf,
        AES_DECRYPT(c.au_crickl, "' . EncriptKey . '") as au_crickl,
        AES_DECRYPT(c.au_crickpn, "' . EncriptKey . '") as au_crickpn,
        AES_DECRYPT(c.au_cricke, "' . EncriptKey . '") as au_cricke,
        AES_DECRYPT(c.au_cricka, "' . EncriptKey . '") as au_cricka,
        c.au_designation,
        c.au_createdon,
        c.au_usertype,
        c.au_status,
        c.au_firstlogin,
        c.au_profile,
        c.au_facilityid,
        c.au_userappauthid,
        c.au_devicetoken,
        c.au_emailverification,
        c.au_otp,
        c.au_otp_status,
        c.au_devicetype,
        c.au_salt,
        c.au_passwordreset,b.*');
		$this->db->from('ck_authentication c');
		$this->db->join('v_user_connections d', 'c.authenticationid=d.uc_userid', 'inner');
		$this->db->join('v_centers b', 'd.uc_employer_center=b.center_id', 'inner');
		$this->db->where('c.authenticationid', $id);
		$query = $this->db->get();
		if ($query->num_rows()) {
			return $query->row();
		}
		return FALSE;
	}





	public $column_order = array('c.authenticationid', 'c.au_crickf', 'c.au_cricke', 'c.au_emp_number', 'c.au_designation', 'c.au_deptarment', 'c.au_school');
	public $column_search = array('c.authenticationid', 'CAST(AES_DECRYPT(c.au_crickf, "' . EncriptKey . '") AS CHAR)', 'AES_DECRYPT(c.au_cricke,"' . EncriptKey . '")', 'c.au_emp_number', 'c.au_designation', 'c.au_deptarment', 'c.au_school');
	public $order = array('orderbyfirstname' => 'desc');

	private function _get_datatables_query()
	{
		$this->db->select('CAST(AES_DECRYPT(c.au_crickf, "' . EncriptKey . '") AS CHAR) AS orderbyfirstname,AES_DECRYPT(c.au_crickf,"' . EncriptKey . '") as au_crickf,AES_DECRYPT(c.au_crickl,"' . EncriptKey . '") as au_crickl,AES_DECRYPT(c.au_cricke,"' . EncriptKey . '") as au_cricke,AES_DECRYPT(c.au_cricka,"' . EncriptKey . '") as au_cricka,c.au_title,c.au_emp_number,c.au_usertype,c.au_gender,c.au_deptarment,c.au_school,c.au_campus,c.au_designation,c.au_status,a.ut_name,c.authenticationid,l.rating_option_title,sd.designation_name');
		$this->db->from('ck_authentication c');
		$this->db->join('ck_usertype a', 'c.au_usertype=a.usertypeid', 'inner');
		$this->db->join('ah_rating_option l','l.rating_option_id=(select r.rating from  ah_user_rating r inner join ah_rating_option o on  r.rating=o.rating_option_id where r.staff_id=c.authenticationid   ORDER BY r.rating_date DESC LIMIT 1)','left');   
         // $this->db->join('ah_staff_reporting_conn b','c.authenticationid=b.rp_staffid','left');
		// $this->db->join('ck_authentication d','d.authenticationid=b.rp_reportingperson','left');
		$this->db->join('ah_designation sd','sd.designation_id =c.au_designation','left');
		$this->db->where('c.au_usertype !=', '1');
		
		 if (isset($_POST['department']) && $_POST['department'] != 'null') {
			 
			 $this->db->where('c.au_deptarment',$_POST['department']);
		 }
		 if (isset($_POST['school']) && $_POST['school'] != 'null') {
			 
			 $this->db->where('c.au_school',$_POST['school']);
		 }
		 if (isset($_POST['usertype']) && $_POST['usertype'] != 'null') {
			 
			 $this->db->where('c.au_usertype',$_POST['usertype']);
		 }
		 if (isset($_POST['designation']) && $_POST['designation'] != 'null') {
			 
			 $this->db->where('c.au_designation',$_POST['designation']);
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
		// echo $this->db->last_query();
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
		$this->db->select('CAST(AES_DECRYPT(c.au_crickf, "' . EncriptKey . '") AS CHAR) AS orderbyfirstname,AES_DECRYPT(c.au_crickf,"' . EncriptKey . '") as au_crickf,AES_DECRYPT(c.au_crickl,"' . EncriptKey . '") as au_crickl,AES_DECRYPT(c.au_cricke,"' . EncriptKey . '") as au_cricke,AES_DECRYPT(c.au_cricka,"' . EncriptKey . '") as au_cricka,c.au_title,c.au_emp_number,c.au_usertype,c.au_gender,c.au_deptarment,c.au_school,c.au_campus,c.au_designation,c.au_status,a.ut_name,c.authenticationid');
		$this->db->from('ck_authentication c');
		$this->db->join('ck_usertype a', 'c.au_usertype=a.usertypeid', 'inner');
		// $this->db->join('ah_staff_reporting_conn b','c.authenticationid=b.rp_staffid','left');
		// $this->db->join('ck_authentication d','d.authenticationid=b.rp_reportingperson','left');
		$this->db->where('c.au_usertype !=', '1');
		return $this->db->count_all_results();
	}


	public function getstaffbycondition($condition)
	{
		$this->db->select('CAST(AES_DECRYPT(c.au_crickf, "' . EncriptKey . '") AS CHAR) AS orderbyfirstname,AES_DECRYPT(c.au_crickf,"' . EncriptKey . '") as au_crickf,AES_DECRYPT(c.au_crickl,"' . EncriptKey . '") as au_crickl,AES_DECRYPT(c.au_cricke,"' . EncriptKey . '") as au_cricke,AES_DECRYPT(c.au_cricka,"' . EncriptKey . '") as au_cricka,c.au_title,c.au_emp_number,c.au_usertype,c.au_gender,c.au_deptarment,c.au_school,c.au_campus,c.au_designation,c.au_status,a.ut_name,c.authenticationid,AES_DECRYPT(d.au_crickf,"' . EncriptKey . '") as reportingpersonname,d.au_title as reporttitle,d.au_emp_number as reportempnumber,a.*');
		$this->db->from('ck_authentication c');
		$this->db->join('ck_usertype a', 'c.au_usertype=a.usertypeid', 'inner');
		$this->db->join('ah_staff_reporting_conn b', 'c.authenticationid=b.rp_staffid', 'left');
		$this->db->join('ck_authentication d', 'd.authenticationid=b.rp_reportingperson', 'left');
		$this->db->where($condition);
		$query = $this->db->get();
		if ($query->num_rows()) {
			return $query->result();
		}
		return FALSE;
	}





    public function getallusersforreporting($data,$satff)
    {
        $this->db->select($this->select_fields);
        $this->db->from('ck_authentication');
        $this->db->where('authenticationid NOT IN (select rp_reportingperson from ah_staff_reporting_conn where rp_status="0" and  rp_staffid='.$satff.')');
        $this->db->where('au_status', '0');
        $this->db->where($data);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    private function _get_datatables_querystaff()
    {
        $this->db->select('CAST(AES_DECRYPT(c.au_crickf, "' . EncriptKey . '") AS CHAR) AS orderbyfirstname,AES_DECRYPT(c.au_crickf,"' . EncriptKey . '") as au_crickf,AES_DECRYPT(c.au_crickl,"' . EncriptKey . '") as au_crickl,AES_DECRYPT(c.au_cricke,"' . EncriptKey . '") as au_cricke,AES_DECRYPT(c.au_cricka,"' . EncriptKey . '") as au_cricka,c.au_title,c.au_emp_number,c.au_usertype,c.au_gender,c.au_deptarment,c.au_school,c.au_campus,c.au_designation,c.au_status,a.ut_name,c.authenticationid,l.rating_option_title');
        $this->db->from('ck_authentication c');
        $this->db->join('ck_usertype a','c.au_usertype=a.usertypeid','inner');
        $this->db->join('ah_staff_reporting_conn b','c.authenticationid=b.rp_staffid','inner');
        $this->db->join('ah_rating_option l','l.rating_option_id=(select r.rating from  ah_user_rating r inner join ah_rating_option o on  r.rating=o.rating_option_id where r.staff_id=c.authenticationid   ORDER BY r.rating_date DESC LIMIT 1)','left');   

        $this->db->where('c.au_usertype !=','1');
        $this->db->where('b.rp_reportingperson',$this->session->userdata('authenticationid'));

      //$this->db->where('b.rp_reportingperson','d.authenticationid');

        

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
    public function get_datatablesstaff_reportingperson()
    {
        $this->_get_datatables_querystaff();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        $query = $this->db->get();
         //echo $this->db->last_query();
        return $query->result();
    }
      public function count_allstaff()
    {
        $this->db->select('CAST(AES_DECRYPT(c.au_crickf, "' . EncriptKey . '") AS CHAR) AS orderbyfirstname,AES_DECRYPT(c.au_crickf,"' . EncriptKey . '") as au_crickf,AES_DECRYPT(c.au_crickl,"' . EncriptKey . '") as au_crickl,AES_DECRYPT(c.au_cricke,"' . EncriptKey . '") as au_cricke,AES_DECRYPT(c.au_cricka,"' . EncriptKey . '") as au_cricka,c.au_title,c.au_emp_number,c.au_usertype,c.au_gender,c.au_deptarment,c.au_school,c.au_campus,c.au_designation,c.au_status,a.ut_name,c.authenticationid,l.rating_option_title');
        $this->db->from('ck_authentication c');
        $this->db->join('ck_usertype a','c.au_usertype=a.usertypeid','inner');
        $this->db->join('ah_staff_reporting_conn b','c.authenticationid=b.rp_staffid','inner');
        $this->db->join('ah_rating_option l','l.rating_option_id=(select r.rating  from  ah_user_rating r inner join ah_rating_option o on  r.rating=o.rating_option_id where r.staff_id=c.authenticationid  ORDER BY r.rating_date DESC LIMIT 1)','left'); 
        $this->db->where('c.au_usertype !=','1');
        $this->db->where('b.rp_reportingperson',$this->session->userdata('authenticationid'));
        return $this->db->count_all_results();
    }

    public function count_filteredstaff()
    {
        $this->_get_datatables_querystaff();
        $query = $this->db->get();
        return $query->num_rows();
    }
	
	 public function login_users($time)
    {
		$dates = date('d-m-Y',strtotime($time));
        $day = date('d',strtotime($dates));
        $month = date('m',strtotime($dates));
        $year = date('Y');
		
        $this->db->select('DISTINCT CAST(AES_DECRYPT(c.au_crickf, "' . EncriptKey . '") AS CHAR) AS orderbyfirstname,AES_DECRYPT(c.au_crickf,"' . EncriptKey . '") as au_crickf,AES_DECRYPT(c.au_crickl,"' . EncriptKey . '") as au_crickl,AES_DECRYPT(c.au_cricke,"' . EncriptKey . '") as au_cricke,AES_DECRYPT(c.au_cricka,"' . EncriptKey . '") as au_cricka,c.au_title');
        $this->db->from('ck_authentication c');
        $this->db->join('ah_usertime a','c.authenticationid =a.ut_staff_id','inner');
         $this->db->where("MONTH(a.ut_login_time)", $month);
         $this->db->where("DAY(a.ut_login_time)" , $day);
        $this->db->where("YEAR(a.ut_login_time)" , $year);
        $query = $this->db->get();
         
        return $query->result();
    }

    }

    

