<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Staff_reporting_conn extends My_Model
{
    public $_table = 'ah_staff_reporting_conn'; 
    protected $primary_key = 'reportingid';
    public $protected_attributes = array('reportingid');
    public $validate = array('formvalid' => array(
        array('field' => 'name',
            'label' => 'name',
            'rules' => 'required'),
    ),

    );

    public $column_order = array('c.authenticationid', 'c.au_crickf', 'c.au_cricke', 'c.au_emp_number','c.au_designation','c.au_deptarment','c.au_school');
    public $column_search = array('c.authenticationid', 'CAST(AES_DECRYPT(c.au_crickf, "' . EncriptKey . '") AS CHAR)', 'AES_DECRYPT(c.au_cricke,"' . EncriptKey . '")', 'c.au_emp_number','c.au_designation','c.au_deptarment','c.au_school');
    public $order = array('orderbyfirstname' => 'desc');

    private function _get_datatables_query()
    {
        $this->db->select('CAST(AES_DECRYPT(c.au_crickf, "' . EncriptKey . '") AS CHAR) AS orderbyfirstname,AES_DECRYPT(c.au_crickf,"' . EncriptKey . '") as au_crickf,AES_DECRYPT(c.au_crickl,"' . EncriptKey . '") as au_crickl,AES_DECRYPT(c.au_cricke,"' . EncriptKey . '") as au_cricke,AES_DECRYPT(c.au_cricka,"' . EncriptKey . '") as au_cricka,c.au_title,c.au_emp_number,c.au_usertype,c.au_gender,c.au_deptarment,c.au_school,c.au_campus,c.au_designation,c.au_status,a.ut_name,c.authenticationid');
        $this->db->from('ck_authentication c');
        $this->db->join('ck_usertype a','c.au_usertype=a.usertypeid','inner');
        $this->db->join('ah_staff_reporting_conn b','c.authenticationid=b.rp_reportingperson','inner');      
        $this->db->where('c.au_usertype !=','1');
        $this->db->where('b.rp_status','0');
        $this->db->group_by('c.authenticationid');

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
        $this->db->join('ck_usertype a','c.au_usertype=a.usertypeid','inner');
        $this->db->join('ah_staff_reporting_conn b','c.authenticationid=b.rp_reportingperson','inner');      
        $this->db->where('c.au_usertype !=','1');
        $this->db->where('b.rp_status','0');
        $this->db->group_by('c.authenticationid');
        return $this->db->count_all_results();
    }

    public function getallassignedstafflist($id) {
        $this->db->select('CAST(AES_DECRYPT(c.au_crickf, "' . EncriptKey . '") AS CHAR) AS orderbyfirstname,AES_DECRYPT(c.au_crickf,"' . EncriptKey . '") as au_crickf,AES_DECRYPT(c.au_crickl,"' . EncriptKey . '") as au_crickl,AES_DECRYPT(c.au_cricke,"' . EncriptKey . '") as au_cricke,AES_DECRYPT(c.au_cricka,"' . EncriptKey . '") as au_cricka,c.au_title,c.au_emp_number,c.au_usertype,c.au_gender,c.au_deptarment,c.au_school,c.au_campus,c.au_designation,c.au_status,a.ut_name,c.authenticationid,a.*');
        $this->db->from('ck_authentication c');
        $this->db->join('ck_usertype a','c.au_usertype=a.usertypeid','inner');
        $this->db->join('ah_staff_reporting_conn b','c.authenticationid=b.rp_staffid','inner');
      //  $this->db->join('ck_authentication d','d.authenticationid=b.rp_reportingperson','left');
        $this->db->where('b.rp_reportingperson',$id);
        $this->db->where('b.rp_status','0');
        $this->db->group_by('b.rp_staffid');
        $query = $this->db->get();
        if ($query->num_rows()) {
            return $query->result();
        }
        return FALSE;
    }
    public function getallreportingusers($id) {
        $this->db->select('CAST(AES_DECRYPT(c.au_crickf, "' . EncriptKey . '") AS CHAR) AS orderbyfirstname,AES_DECRYPT(c.au_crickf,"' . EncriptKey . '") as au_crickf,AES_DECRYPT(c.au_crickl,"' . EncriptKey . '") as au_crickl,AES_DECRYPT(c.au_cricke,"' . EncriptKey . '") as au_cricke,AES_DECRYPT(c.au_cricka,"' . EncriptKey . '") as au_cricka,c.au_title,c.au_emp_number,c.au_usertype,c.au_gender,c.au_deptarment,c.au_school,c.au_campus,c.au_designation,c.au_status,a.ut_name,c.authenticationid,b.*');
        $this->db->from('ck_authentication c');
        $this->db->join('ck_usertype a','c.au_usertype=a.usertypeid','inner');
        $this->db->join('ah_staff_reporting_conn b','c.authenticationid=b.rp_reportingperson','inner');
      //  $this->db->join('ck_authentication d','d.authenticationid=b.rp_reportingperson','left');
        $this->db->where('b.rp_staffid',$id);
        $this->db->where('b.rp_status','0');
        $query = $this->db->get();
        if ($query->num_rows()) {
            return $query->result();
        }
        return FALSE;
    }

    
}
