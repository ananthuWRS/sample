<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Team_member extends My_Model
{
    public $_table = 'ah_team_member';
    protected $primary_key = 'team_memberid';
    public $protected_attributes = array('team_memberid');
    public $validate = array('formvalid' => array(
        array('field' => 'name',
            'label' => 'name',
            'rules' => 'trim|required'),
    ),

    );

    public $column_order = array('a.team_memberid', 'a.team_name', 'a.team_status', 'a.team_addedon');
    public $column_search = array('a.team_memberid', 'a.team_name','a.team_status', 'a.team_addedon');
    public $order = array('a.team_addedon' => 'desc');

    private function _get_datatables_query()
    {
        $this->db->select('*');
        $this->db->from('ah_team_member a');
        $this->db->where('a.team_status', '0');
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
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->select('*');
        $this->db->from('ah_team_member a');
        $this->db->where('a.team_status', '0');
        return $this->db->count_all_results();
    }

    public function getteammembers($teamid)
    {
        $this->db->select('GROUP_CONCAT(CONCAT_WS(" ", d.au_title,AES_DECRYPT(d.au_crickf, "'.EncriptKey.'"),d.au_emp_number) SEPARATOR ", ") AS membername');
        $this->db->from('ah_team_member a');
        $this->db->join('ck_authentication d', 'd.authenticationid=a.tm_staffid', 'inner');
        $this->db->where('a.tm_teamid', $teamid);
        $this->db->where('a.tm_status', '0');
        $query = $this->db->get();        
        return $query->result();
    }
    public function getteamheads($teamid)
    {
        $this->db->select('GROUP_CONCAT(CONCAT_WS(" ", d.au_title,AES_DECRYPT(d.au_crickf, "'.EncriptKey.'"),d.au_emp_number) SEPARATOR ", ") AS membername');
        $this->db->from('ah_team_member a');
        $this->db->join('ck_authentication d', 'd.authenticationid=a.tm_staffid', 'inner');
        $this->db->where('a.tm_teamid', $teamid);
        $this->db->where('a.tm_status', '0');
        $this->db->where('a.tm_ishead', '1');
        $query = $this->db->get();        
        return $query->result();
    }
    
    public function getteammemberids($teamid)
    {
        $this->db->select('GROUP_CONCAT(a.tm_staffid) as teammembers');
        $this->db->from('ah_team_member a');        
        $this->db->where('a.tm_teamid', $teamid);
        $this->db->where('a.tm_status', '0');
        $this->db->where('a.tm_status', '0');
        $query = $this->db->get();        
        return $query->result();
    }

    

    public function getteamheadids($teamid)
    {
        $this->db->select('GROUP_CONCAT(a.tm_staffid) as teamheads');
        $this->db->from('ah_team_member a');       
        $this->db->where('a.tm_teamid', $teamid);
        $this->db->where('a.tm_status', '0');
        $this->db->where('a.tm_ishead', '1');
        $query = $this->db->get();        
        return $query->result();
    }

    public function getallteammembers($teamid)
    {
        $this->db->select('d.au_title,AES_DECRYPT(d.au_crickf, "'.EncriptKey.'") as au_crickf,d.au_emp_number,d.au_deptarment,d.au_school,AES_DECRYPT(d.au_cricke, "'.EncriptKey.'") as au_cricke');
        $this->db->from('ah_team_member a');
        $this->db->join('ck_authentication d', 'd.authenticationid=a.tm_staffid', 'inner');
        $this->db->where('a.tm_teamid', $teamid);
        $this->db->where('a.tm_status', '0');
        $query = $this->db->get();        
        return $query->result();
    }
    
}
