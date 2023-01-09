<?php

class MY_Controller extends CI_Controller
{
	protected $data;

	public $CI;

	public $title = '';
	public $userlogged_data;
	public $loggeduserid;
	public $reportingPerson;




	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		$this->lang->load(['common_messages', 'common_styles'], 'english');
		$this->controller_name = $this->router->class;
		$this->method_name     = $this->router->method;
		$this->load->helper('language');
		$this->todaydate = current_date_mysqlformat();
		$this->updatedon = get_updated_on();
		$this->CI        = &get_instance();
		$this->loggeduserid = $this->session->userdata('authenticationid');



		$pages = array(
			array('c' => 'welcome', 'm' => 'index'),
			array('c' => 'website', 'm' => 'contactus'),
			array('c' => 'welcome', 'm' => 'signinauthentication'),
			array('c' => 'welcome', 'm' => 'register_email_exists'),
			array('c' => 'welcome', 'm' => 'forgotpassword'),
			array('c' => 'welcome', 'm' => 'forgotpasswordprocess'),
			array('c' => 'welcome', 'm' => 'reset_login_password'),
			array('c' => 'welcome', 'm' => 'nojsavailable'),

		);

		$flg = 0;
		foreach ($pages as $page) {
			if ($this->controller_name == $page['c'] && $this->method_name == $page['m']) {
				$flg = 1;
				break;
			}
		}

		if ($flg == 0) {
			$this->check_isvalidated();
			$session_id = $this->session->userdata('authenticationid');
			if ($session_id) {
				$this->load->model('welcome/userauthentication_model', 'usersignin');
				$this->load->model('admin/Staff_reporting_conn', 'reportstaff');
				$this->userlogged_data = $this->usersignin->getuserdetails(array('authenticationid' => $session_id));
				$this->reportingPerson = $this->reportstaff->count_by(array('rp_reportingperson' => $session_id, 'rp_status' => '0'));
			}
		}
	}





	public function render($content, $view = 'signindashboard/basic_view')
	{

		$data['content'] = &$content;

		$this->load->view("$view", $data);
	}

	public function dashboardrender($content, $view = 'userdashboard/base_view')
	{

		$data['content'] = &$content;

		$this->load->view("$view", $data);
	}



	private function check_isvalidated()
	{

		$session_id = $this->session->userdata('authenticationid');
		if ($session_id == false) {
			redirect('welcome/index');
		}
	}

	public function do_logout()
	{
		$this->load->model('welcome/User_time', 'usertime');
		$logout_time = date('Y-m-d H:i:s');
		$UserTimeStampJson= json_decode($this->input->post("UserTimeStampJson"));
		// echo json_encode($UserTimeStampJson);
		// exit();
		$usertime = array(
			'ut_logout_time' => $logout_time,
			'ut_json_time'=>$this->input->post("UserTimeStampJson")
		);


		$seconds = $this->input->post('seconds');
		
		$dt1 = new DateTime("@0");
		$dt2 = new DateTime("@$seconds");
		$result['time'] = $dt1->diff($dt2)->format('%a days, %h hours, %i minutes and %s seconds');
		$date_string = $dt1->diff($dt2)->format('%a') . "-" . date('m') . "-" . date('Y') . "," . $dt1->diff($dt2)->format('%h') . ":" . $dt1->diff($dt2)->format('%i') . ":" . $dt1->diff($dt2)->format('%s');
		$usertime =array_merge($usertime,array('ut_total_time'=> date('H:i:s', strtotime($date_string))));
		
		//exit();
		$this->usertime->updateLogoutTime($usertime, $this->session->userdata('ut_staff_id'), $this->session->userdata('ut_login_time'));
		//$this->usertime->insert(array('ut_staff_id'=>$success->authenticationid,'ut_login_time'=>$logout_time,'ut_status'=>'0'),true);
		$this->session->sess_destroy();

		//redirect('welcome/index');
	}

	public function checksumgen($val)
	{
		$checksum = sha1(HASHCODE . $val);
		return $checksum;
	}

	protected function validchecksumcheck($id, $hash)
	{

		$checksum = sha1(HASHCODE . $id);
		if ($id != '' && $hash != '') {
			if ($hash != $checksum) {
				return false;
			} else {
				return true;
			}
		} else {
			return false;
		}
	}

	public function time_ago($timestamp)
	{
		$time_ago        = strtotime($timestamp);
		$current_time    = time();
		$time_difference = $current_time - $time_ago;
		$seconds         = $time_difference;
		$minutes         = round($seconds / 60); // value 60 is seconds
		$hours           = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec
		$days            = round($seconds / 86400); //86400 = 24 * 60 * 60;
		$weeks           = round($seconds / 604800); // 7*24*60*60;
		$months          = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60
		$years           = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60
		if ($seconds <= 60) {
			return "Just Now";
		} else if ($minutes <= 60) {
			if ($minutes == 1) {
				return "one minute ago";
			} else {
				return "$minutes minutes ago";
			}
		} else if ($hours <= 24) {
			if ($hours == 1) {
				return "an hour ago";
			} else {
				return "$hours hrs ago";
			}
		} else if ($days <= 7) {
			if ($days == 1) {
				return "yesterday";
			} else {
				return "$days days ago";
			}
		} else if ($weeks <= 4.3) //4.3 == 52/12
		{
			if ($weeks == 1) {
				return "a week ago";
			} else {
				return "$weeks weeks ago";
			}
		} else if ($months <= 12) {
			if ($months == 1) {
				return "a month ago";
			} else {
				return "$months months ago";
			}
		} else {
			if ($years == 1) {
				return "one year ago";
			} else {
				return "$years years ago";
			}
		}
	}



	protected function curl($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
}
