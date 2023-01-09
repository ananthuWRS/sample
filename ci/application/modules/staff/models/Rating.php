<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Rating extends My_Model
{
    public $_table = 'ah_user_rating'; 
    protected $primary_key = 'rating_id';
    public $protected_attributes = array('rating_id');
    public $validate = array('formvalid' => array(
        array('field' => 'name',
            'label' => 'name',
            'rules' => 'trim|required'),
    ),

    );

    public function getstaffrating_count($id,$rid,$date)
    {
        $sel_date = date('Y-m-d', strtotime($date));
        $this->db->select('count(rating_id) as ratingcnt');
        $this->db->from('ah_user_rating a');
        $this->db->where('a.staff_id', $id);
        $this->db->where('a.reporting_staff_id', $rid);
        $this->db->where("a.rating_date", $sel_date);
        $query = $this->db->get();
        return $query->row();
    }

}
