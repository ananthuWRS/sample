<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Stafflocation extends My_Model
{
	public $_table = 'ah_stafflocation';
	protected $primary_key = 'stafflocation_id ';
	public $protected_attributes = array('stafflocation_id ');
	public $validate = array(
		'formvalid' => array(
			array(
				'field' => 'sl_location_type',
				'label' => 'Location Type',
				'rules' => 'trim|required'
			), 
			array(
				'field' => 'sl_start_date',
				'label' => 'Start Date',
				'rules' => 'trim|required'
			), array(
				'field' => 'sl_start_date',
				'label' => 'End Date',
				'rules' => 'trim|required'
			),
		),
		'locationInsertValid' => array(
			array(
				'field' => 'sl_location_type',
				'label' => 'Location Type',
				'rules' => 'trim|required'
			), 
			array(
				'field' => 'sl_start_date',
				'label' => 'Start Date',
				'rules' => 'trim|required'
			), array(
				'field' => 'sl_start_date',
				'label' => 'End Date',
				'rules' => 'trim|required'
			),
		),

	);

	public $column_order = array('a.stafflocation_id', 'a.sl_status', 'a.sl_addedon');
	public $column_search =  array('a.stafflocation_id', 'a.sl_status', 'a.sl_addedon');
	public $order = array('a.sl_addedon' => 'desc');

	private function _get_datatables_query()
	{

		$this->db->select('*');
		$this->db->from('ah_stafflocation a');
		$this->db->where('a.sl_status', '0');
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
		$this->db->from('ah_stafflocation a');
		$this->db->where('a.sl_status', '0');
		return $this->db->count_all_results();
	}
	public function updateStaffLocation($data, $id)
	{
		$this->db->set($data);
		$this->db->where('sl_staff_id ', $id);
		$this->db->where('sl_status ', '0');
		$this->db->update('ah_stafflocation');
	}
}
