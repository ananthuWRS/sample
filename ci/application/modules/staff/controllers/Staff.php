<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('welcome/userauthentication_model', 'usersigin');
		$this->load->helper('text');
	}

	public function index($business = "")
	{
		$this->data['title']    = "Admin dashboard";
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/report.js');
		$this->data['scriptfunctions'] = array('adminreport();');
        $this->load->template('dashboard', $this->data, false);
	}





	public function tasks()
	{
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('stafftasks();');
		$this->data['title']           = "Tasks";

		$this->load->template('tasks_list', $this->data, false);
	}
	public function ajaxstafftaskslist()
    {
        $this->load->model('staff/Tasks', 'task');
		$this->load->model('staff/Task_status_details', 'taskstatus');
        $list = $this->task->get_datatables();
        $tabledata = array();
        $no = $this->input->post('start', true);
        $vt = 1;
        foreach ($list as $item) {
            $authid = $this->checksumgen($item->taskid);
            $no++;
            $row = array();
            $row[] = $no;
			 switch($item->task_priority) {
                case 'low':
                    $priority= '<span class="badge badge-light-success fs-base fa-exp">'.ucfirst(strtolower($item->task_priority)).'</span>';
                    break;
                case 'normal':
                    $priority= '<span class="badge badge-light-success fs-base fa-exp">'.ucfirst(strtolower($item->task_priority)).'</span>';
                    break;
                case 'urgent':
                    $priority= '<span class="badge badge-light-danger fs-base fa-exp">'.ucfirst(strtolower($item->task_priority)).'</span>';
                    break;
            }
            $row[] = $priority."<p>".ucfirst(strtolower($item->task_title))."</p>";
            //$row[] = ucfirst(strtolower($item->tc_name)).'-'.ucfirst(strtolower($item->sc_name));
            //$row[] = ;
            switch($item->tsa_completed_status) {
                case '0':
                    $status="Not Started";
                    break;
                case '1':
                    $status="Pending";
                    break;
                case '2':
                    $status="Completed";
                    break;
            }
           
            // $row[] = $status;
			
			$timeSpent=0;
            $taskStatus=$this->taskstatus->get_many_by(array('td_staff_id'=>$this->loggeduserid,'td_task_id'=>$item->taskid,'td_status'=>'0'));
            $this->data['taskStatusDetails']=$taskStatus;
            if ($taskStatus) {
                $timeHours=$taskStatus[0]->td_hours;
                $timeminutes=$taskStatus[0]->td_minutes;
                $time = strtotime($timeHours.':'.$timeminutes);

                $timeSpent = $this->totalTimeCalculation($taskStatus);
            }
            $this->data['timeSpent']=$timeSpent;

			
            $row[] = $timeSpent;
			
			if($item->tsa_completed_percentage){
				
			$percentage = ucfirst(strtolower($item->tsa_completed_percentage)).'%';
				
			}else{
			$percentage = '0%';	
			}
			
            $row[] = $percentage;
            // $row[] = ucfirst(strtolower(word_limiter($item->task_details, 100)));
            $statusText = ($item->tc_status == "0") ? array('Delete', 'btn btn-delete btn-sm', 'fa-times-circle') : array('Enable', 'btn btn-light-success btn-sm', 'fa-check');
            $deleteOption='';
            if ($item->task_staffid==$this->loggeduserid && $item->tsa_approved!='1') {
                $deleteOption='<a href="javascript:;" data-itemid="' . $item->taskid . '"  class="' . $statusText[1] . '  deleteTaskDetails"><i class="fas ' . $statusText[2] . '"></i> ' . $statusText[0] . '</a>';
            }
            $updateStatus='';
            if ($item->tsa_completed_status!='2') {
                $updateStatus='<a href="javascript:;" 
                data-item="'.$item->taskid.'"  class="btn btn-update updateTaskStatus btn-sm " "><i class="fa fa-plus"></i> Update Status</a>';
            }
            $editTask='';
            if ($item->tsa_approved!='1' && $item->task_staffid==$this->loggeduserid) {
                $editTask=
                '<a href="'.base_url().'staff/edittask/'.$item->taskid.'/'.$authid.'"  class="btn btn-edit  btn-sm " "><i class="fa fa-edit"></i> Edit</a>&nbsp;';
            }
            $row[] = $updateStatus.' '.$editTask.'
            
            <a href="'.base_url().'staff/viewtaskdetails/'.$item->taskid.'/'.$authid.'"  class="btn btn-view   btn-sm " "><i class="fa fa-eye"></i> View</a>&nbsp;
            '.$deleteOption;

            $tabledata[] = $row;
            $vt++;
            /* ================================ */
        }

        $output = array(
            "draw" => $this->input->post('draw', true),
            "recordsTotal" => $this->task->count_all(),
            "recordsFiltered" => $this->task->count_filtered(),
            "data" => $tabledata,
        );

        echo json_encode($output);
    }


	public function addtask()
	{
		$this->load->model('admin/Task_category', 'category');
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('staffaddtask();');
		$this->data['categorylist']    = $this->category->get_many_by(array('tc_status' => 0));

		$this->data['title']           = "Add Task";

		$this->load->template('add_task', $this->data, false);
	}

	public function getSubCategory()
	{
		$this->load->model('admin/Subcategory', 'subcategory');

		$category = $this->input->post('catid', true);
		if ($category) {
			$subcategory = $this->subcategory->get_many_by(array('sc_categoryid' => $category, 'sc_status' => '0'));
			echo "<option value=''></option>";
			if ($subcategory) {
				foreach ($subcategory as $subcat) {
					echo "<option value='" . $subcat->subcategoryid . "'>" . ucfirst($subcat->sc_name) . "</option>";
				}
			}
		}
	}
	public function taskSubmitProcess()
	{
		$this->load->model('staff/Tasks', 'task');
		$this->load->model('staff/Task_staff', 'taskstaff');
		$this->load->model('staff/Task_status_details', 'taskstatus');



		$task_name = $this->input->post('task_name', true);
		$category = $this->input->post('category', true);
		$subcategory = $this->input->post('subcategory', true);
		$task_details = $this->input->post('task_details', true);
		$task_status = $this->input->post('task_status', true);
		$statusdata = $this->input->post('statusdata');
		$priority = $this->input->post('priority', true);

		$task_date = $this->input->post('task_date', true);
		$task_end_date = $this->input->post('task_end_date', true);
		$task_execution_date = $this->input->post('task_execution_date', true);
		$task_time_spend_hours = $this->input->post('task_time_spend_hours', true);
		$task_time_spend_mins = $this->input->post('task_time_spend_mins', true);
		$task_remarks = $this->input->post('task_remarks', true);



		$editid = $this->input->post('editid', true);
		$editauth = $this->input->post('editauth', true);

		$validation = array(
			'task_name' => $task_name,
			'category' => $category,
			'subcategory' => $subcategory,
			'task_status' => '1',
			'priority' => $priority
		);
		if ($this->task->validate($validation, 'formvalid')) {
			$curdate = date('Y-m-d H:i:s');
			if ($editid == "") {
				// $errorCheck=[];
				if (isset($statusdata) && count($statusdata) > 0) {
					//  $hours=0;
					//  $minutes=0;
					//  foreach ($statusdata as $status) {
					//      if ($status['hours']!='') {
					//          $hours += $status['hours'];
					//      }
					//      if ($status['minutes']!='') {
					//          $minutes += $status['minutes'];
					//      }


					//      if ($minutes > 0) {
					//          $hours += floor($minutes / 60);
					//      }

					//     //  if ($hours > 4) {
					//     //      $errorCheck[]=  'Task total hours sould be less than or euqual to 4 Hrs';
					//     //  }
					//  }


					$needle = 100;
					$checkStatus = array_filter($statusdata, function ($var) use ($needle) {
						return $var['status'] == $needle;
					});
					if (count($checkStatus) > 0) {
						$taskCompletedStatus = 2;
					} else {
						$taskCompletedStatus = 1;
					}
				} else {
					$taskCompletedStatus = 0;
				}
				//if (!$errorCheck) {
				$taksInserted = $this->task->insert(array(
					'task_category' => $category,
					'task_subcategory' => $subcategory,
					'task_title' => $task_name,
					'task_details' => $task_details,
					'task_staffid' => $this->loggeduserid,
					'task_priority' => $priority,
					'task_date' => date('Y-m-d', strtotime($task_date)),
					'task_end_date' => ($task_date != "") ? date('Y-m-d', strtotime($task_end_date)) : '',
					//'task_completed_percentage' => $task_status,
					'task_status' => $taskCompletedStatus,
					'task_addedby' => $this->loggeduserid,
					'task_addedon' => $curdate,

				), true);
				if ($taksInserted) {
					$this->taskstaff->insert(array(
						'tsa_staffid' => $this->loggeduserid,
						'tsa_taskid' => $taksInserted,
						'tsa_completed_status' => $taskCompletedStatus,
						//'tsa_completed_percentage'=>$task_status,
						'tsa_status' => '0',
						'tsa_addedby' => $this->loggeduserid,
						'tsa_addedon' => $curdate,
					), true);

					if (isset($statusdata) && count($statusdata) > 0) {
						$taskStatusInsertArray = [];
						$statusCheck = [];

						foreach ($statusdata as $status) {
							$statusCheck[] = $status['status'];
							$taskStatusInsertArray[] = array(
								'td_staff_id' => $this->loggeduserid,
								'td_task_id' => $taksInserted,
								'td_completion_percentage' => $status['status'],
								'td_execution_date' => date('Y-m-d', strtotime($status['date'])),
								'td_hours' => $status['hours'],
								'td_minutes' => $status['minutes'],
								'td_remarks' => $status['remarks'],
								'td_status' => '0',
								'td_addedby' => $this->loggeduserid,
								'td_addedon' => $curdate,
							);
						}

						if (count($taskStatusInsertArray) > 0) {
							$this->taskstatus->insert_many($taskStatusInsertArray, true);

							$statusMaxValue = max($statusCheck);
							if ($statusMaxValue == 0) {
								$taskCompletedStatus = 0;
							} elseif ($statusMaxValue < 100) {
								$taskCompletedStatus = 1;
							} elseif ($statusMaxValue == 100) {
								$taskCompletedStatus = 2;
							}
							$this->task->update_status_by(array('taskid' => $taksInserted), array('task_status' => $taskCompletedStatus));
							$this->taskstaff->update_status_by(array('tsa_taskid' => $taksInserted, 'tsa_staffid' => $this->loggeduserid), array('tsa_completed_status' => $taskCompletedStatus, 'tsa_completed_percentage' => $statusMaxValue));
						}
					}

					$this->session->set_flashdata('successmessage', 'Task  added successfully.');
					$result = array('status' => 'Yes', 'Message' => 'Task added successfully');
				} else {
					$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
					$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
				}
				//  } else {
				//      $this->session->set_flashdata('errormessage', $errorCheck[0]);
				//      $result = array('status' => 'No', 'Message' => $errorCheck[0]);
				//  }
			} else {
				if ($this->validchecksumcheck($editid, $editauth)) {
					$taksInserted = $this->task->update_status_by(array('taskid' => $editid), array(
						'task_category' => $category,
						'task_subcategory' => $subcategory,
						'task_title' => $task_name,
						'task_details' => $task_details,
						'task_priority' => $priority,
						//'task_completed_percentage' => $task_status,
						'task_date' => date('Y-m-d', strtotime($task_date)),
						'task_end_date' => ($task_date != "") ? date('Y-m-d', strtotime($task_end_date)) : '',
						'task_addedby' => $this->loggeduserid

					));

					if ($taksInserted) {
						$this->session->set_flashdata('successmessage', 'Task  updated successfully.');
						$result = array('status' => 'Yes', 'Message' => 'Task updated successfully');
					} else {
						$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
						$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
					}
				} else {
					$this->session->set_flashdata('errormessage', 'Invalid request');
					$result = array('status' => 'No', 'Message' => 'Invalid request');
				}
			}
		} else {
			$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
			$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
		}

		echo json_encode($result);
	}

	public function edittask($id, $auth)
	{
		if ($this->validchecksumcheck($id, $auth)) {
			$this->load->model('staff/Tasks', 'task');
			$this->load->model('staff/Task_status_details', 'taskstatus');
			$this->load->model('staff/Task_staff', 'taskstaff');
			$taskDetails = $this->task->get_by(array('taskid' => $id));
			$this->load->model('admin/Task_category', 'category');
			$this->load->model('admin/Subcategory', 'subcategory');
			$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
			$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
			$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
			$this->data['scriptfunctions'] = array('staffedittask();');

			$this->data['categorylist']    = $this->category->get_many_by(array('tc_status' => 0));
			$this->data['subcategory'] = $this->subcategory->get_many_by(array('sc_categoryid' => $taskDetails->task_category, 'sc_status' => '0'));
			$this->data['taskDetails'] = $taskDetails;
			$this->data['auth'] = $auth;
			$this->data['title']           = "Update Task";
			$this->data['taskstaff'] = $this->taskstaff->get_by(array('tsa_staffid' => $this->loggeduserid, 'tsa_taskid ' => $id, 'tsa_status' => '0'));


			$this->data['taskStatusDetails'] = $this->taskstatus->get_many_by(array('td_staff_id' => $this->loggeduserid, 'td_task_id' => $id, 'td_status' => '0'));

			$this->load->template('edit_task', $this->data, false);
		} else {
			$this->session->set_flashdata('successmessage', 'Invalid request');
			redirect('staff/tasks');
		}
	}
	public function viewtask($id, $auth)
	{
		if ($this->validchecksumcheck($id, $auth)) {
			$this->load->model('staff/Tasks', 'task');
			$taskDetails = $this->task->gettaskdetails($id);

			$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
			$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
			$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
			$this->data['taskDetails'] = array_shift($taskDetails);
			$this->data['auth'] = $auth;
			$this->data['title']           = "Task Details";

			$this->load->template('view_task', $this->data, false);
		} else {
			$this->session->set_flashdata('successmessage', 'Invalid request');
			redirect('staff/tasks');
		}
	}


	public function calendar()
	{
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('staffcalendar();');
		$this->data['title']           = "Calendar";

		$this->load->template('calendar', $this->data, false);
	}

	public function updateTaskStatus()
	{
		$this->load->model('staff/Tasks', 'task');
		$pagename = $this->input->post('pagename');
		$editid = $this->input->post('editid');
		$taskDetails = $this->task->gettaskdetailswithstaff($editid, $this->loggeduserid);
		if ($pagename != "" && $editid != "") {
			if ($taskDetails) {
				$this->data['modalname'] = $pagename;
				$this->data['editid'] = $editid;
				$this->data['taskDetails'] = $taskDetails;
				echo $this->load->view('commonmodal', $this->data, true);
			}
		}
	}




	public function updateTaskStatusDetails()
	{
		$this->load->model('staff/Tasks', 'task');
		$this->load->model('staff/Task_staff', 'taskstaff');
		$this->load->model('staff/Task_status_details', 'taskstatus');

		$task_status = $this->input->post('task_completion_status', true);

		$task_execution_date = $this->input->post('task_execution_date', true);
		$task_time_spend_hours = $this->input->post('task_time_spend_hours', true);
		$task_time_spend_mins = $this->input->post('task_time_spend_mins', true);
		$task_remarks = $this->input->post('task_remarks', true);

		$editid = $this->input->post('editid', true);
		
		

		$validation = array(
			'task_name' => $task_status,
			'category' => $task_execution_date,
			'subcategory' => ($task_time_spend_hours != '') ? $task_time_spend_hours : '1',
			'task_status' => ($task_time_spend_mins != '') ? $task_time_spend_mins : '1',
			'priority' => $task_execution_date
		);


		if ($this->task->validate($validation, 'formvalid')) {
			$curdate = date('Y-m-d H:i:s');
			if ($editid != "") {
				$checkDataEntered = $this->taskstatus->get_by(array(
					'td_staff_id' => $this->loggeduserid,
					'td_task_id' => $editid, 'td_execution_date' => date('Y-m-d', strtotime($task_execution_date))
				));
				if (!$checkDataEntered) {
					$checkDateandStatus = $this->taskstatus->get_by(array(
						'td_staff_id' => $this->loggeduserid,
						'td_task_id' => $editid, 'td_completion_percentage <=' => $task_status, 'td_execution_date >' => date('Y-m-d', strtotime($task_execution_date))
					));
					$errorArray = [];

					if ($checkDateandStatus) {
						if ($checkDateandStatus->td_completion_percentage <= $task_status) {
							$errorArray[] =  'You can not enter same or higher  status on this date';
						}
					}

					$checkInBetweenData = $this->taskstatus->getpreviousentrydate($editid, $this->loggeduserid, $task_execution_date);
					if (count($checkInBetweenData) > 0) {
						if (isset($checkInBetweenData['previousdatestatus']) && $task_status <= $checkInBetweenData['previousdatestatus']) {
							$errorArray[] =  'Please enter status values between previous entries statuses';
						} elseif (isset($checkInBetweenData['nextdatestatus']) && $task_status >= $checkInBetweenData['nextdatestatus']) {
							$errorArray[] =  'Please enter status values between previous entries statuses';
						}
					}


					$maxstatus = $this->taskstatus->getmaxstatus($editid, $this->loggeduserid);
					if ($maxstatus) {
						if ($maxstatus == $task_status) {
							$errorArray[] =  'You can not enter same status value again';
						}

						$checkDateandStatus = $this->taskstatus->get_by(array(
							'td_staff_id' => $this->loggeduserid,
							'td_task_id' => $editid, 'td_completion_percentage =' => $maxstatus
						));
						if ($checkDateandStatus) {
							if (strtotime($task_execution_date) > strtotime($checkDateandStatus->td_execution_date)) {
								if ($task_status <= $checkDateandStatus->td_completion_percentage) {
									$errorArray[] =  'Status value should be greater';
								}
							}
						}
					}


					// $taskStatusTotal=$this->taskstatus->get_many_by(array('td_task_id'=>$editid,'td_staff_id'=>$this->loggeduserid,'td_status'=>'0'));
					// if ($taskStatusTotal) {
					//     $timeSpentArray = timeSpentCalculation($taskStatusTotal);
					//     $hours=0;
					//     $minutes=0;
					//     if ($task_time_spend_hours!='') {
					//         $hours += $task_time_spend_hours;
					//     }
					//     if ($task_time_spend_mins!='') {
					//         $minutes += $task_time_spend_mins;
					//     }
					//     if (isset($timeSpentArray['hours'])) {
					//         $hours +=$timeSpentArray['hours'];
					//     }
					//     if (isset($timeSpentArray['minutes'])) {
					//         $minutes +=$timeSpentArray['minutes'];
					//     }
					//     if ($minutes > 0) {
					//         $hours += floor($minutes / 60);
					//     }

					//     if ($hours > 4) {
					//         $errorArray[]=  'Task total hours sould be less than or euqual to 4 Hrs';
					//     }
					// }




					if (count($errorArray) <= 0) {
						// $maxstatus= $this->taskstatus->getmaxstatus($editid, $this->loggeduserid);
						if ($maxstatus != "") {
							if ($task_status > $maxstatus) {
								$staff_task_status = $task_status;
								if ($task_status == 0) {
									$taskCompletedStatus = 0;
								} elseif ($task_status < 100) {
									$taskCompletedStatus = 1;
								} elseif ($task_status == 100) {
									$taskCompletedStatus = 2;
								}
							} else {
								$staff_task_status = $maxstatus;
								if ($maxstatus == 0) {
									$taskCompletedStatus = 0;
								} elseif ($maxstatus < 100) {
									$taskCompletedStatus = 1;
								} elseif ($maxstatus == 100) {
									$taskCompletedStatus = 2;
								}
							}
						} else {
							$staff_task_status = $task_status;
							if ($task_status == 0) {
								$taskCompletedStatus = 0;
							} elseif ($task_status < 100) {
								$taskCompletedStatus = 1;
							} elseif ($task_status == 100) {
								$taskCompletedStatus = 2;
							}
						}
						$taksInserted = $this->task->update_status_by(array('taskid' => $editid), array(
							'task_status' => $taskCompletedStatus
						));
						if ($taksInserted) {
							$this->taskstaff->update_status_by(array(
								'tsa_staffid' => $this->loggeduserid,
								'tsa_taskid' => $editid
							), array(
								'tsa_completed_status' => $taskCompletedStatus,
								'tsa_completed_percentage' => $staff_task_status,
								'tsa_status' => '0',
								'tsa_addedby' => $this->loggeduserid
							));

							if ($task_status > 0) {
								$this->taskstatus->insert(array(
									'td_staff_id' => $this->loggeduserid,
									'td_task_id' => $editid,
									'td_completion_percentage' => $task_status,
									'td_execution_date' => date('Y-m-d', strtotime($task_execution_date)),
									'td_hours' => $task_time_spend_hours,
									'td_minutes' => $task_time_spend_mins,
									'td_remarks' => $task_remarks,
									'td_status' => '0',
									'td_addedby' => $this->loggeduserid,
									'td_addedon' => $curdate,
								), true);
							}
							//mail here
							// $taskAddedBy=$this->task->gettaskdetailswithstaff($editid, $this->loggeduserid)->task_addedby;
							// if ($taskCompletedStatus==2 && $taskAddedBy!=$this->loggeduserid &&($this->userlogged_data->au_usertype != '1' || $this->userlogged_data->au_usertype != '4')) {
							// 	$this->taskUpdateEmailToReportingPerson($editid, $task_status, $task_execution_date, $task_time_spend_hours, $task_remarks,$curdate=date('Y-m-d H:i:s'));
							// }

							

							$this->session->set_flashdata('successmessage', 'Task status  added successfully.');
							$result = array('status' => 'Yes', 'Message' => 'Task status added successfully');
						} else {
							$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
							$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
						}
					} else {
						$this->session->set_flashdata('errormessage', $errorArray[0]);
						$result = array('status' => 'No', 'Message' => $errorArray[0]);
					}
				} else {
					$this->session->set_flashdata('errormessage', 'Execution date already entered');
					$result = array('status' => 'No', 'Message' => 'Execution date already entered');
				}
			}
		} else {
			$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
			$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
		}

		echo json_encode($result);
	}

	public function taskUpdateEmailToReportingPerson($editid,$task_status, $task_execution_date, $task_time_spend_hours, $task_remarks,$curdate)
	{
		$authid = $this->checksumgen($editid);
		$taskDetails = $this->task->gettaskdetailswithstaff($editid, $this->loggeduserid);
		$staffdetails = $this->usersigin->getstaffbycondition(array('c.authenticationid' => $this->loggeduserid/*, 'rp_reportingperson' => $this->loggeduserid*/));


		$staffname = $staffdetails[0]->au_cricka;
		$staffEmail = $staffdetails[0]->au_cricke;
		$reportingStaffemail = array();
		foreach ($staffdetails as $stdetails) {

		
			$reportingStaffemail=array_merge($reportingStaffemail,array($this->usersigin->getstaffbycondition(array('c.au_emp_number' => $stdetails->reportempnumber))[0]->au_cricke));

		}
		

		$this->load->library('email');
		$fromName = "Staff";
		
			$from = $staffEmail;
		$subject = 'Task Completed';
		$message = '<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
			  <td style="padding:10px;" height="45" style="background:white !important;">
				<img src="http://ahead-amrita.nfonics.com/components/media/logos/fav_ico.png" style="width: 90px;">
			  </td>
			</tr>
			<tr>
			  <td height="20">&nbsp;</td>
			</tr>
			<tr>
			  <td style="padding-left:15px; font-weight:bold;text-transform:capitalize;">Hi,</td>
			</tr>
			<tr>
			  <td>&nbsp;</td>
			</tr>

			<tr>

			  <td style="padding-left:35px;line-height: 25px;padding-right: 15px;"> ' . ucfirst($staffname) . ' has completed his task <b>' . ucfirst($taskDetails->task_title) . '</b>. Please verify.</td>
			</tr>
			<tr>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
		  <td style="padding-left:35px;font-weight:bold;"><a style="    display: block;width: 115px;height: 25px;background: #b20f55;padding: 10px;text-align: center;border-radius: 5px;  color: white;font-weight: bold;line-height: 25px;text-decoration: none;"class="btn btn-primary" href="' . base_url() . 'staff/viewfinishedtaskbyreporting/' . $editid . '/' . $authid . '/' . $this->loggeduserid . '">Click Here</a></td>
		</tr>
		
			<tr>
			  <td>&nbsp;</td>
			</tr>
			<tr>
			  <td style="padding-left:15px; height:30px;">Regards,</td>
			</tr>
			<tr>
			  <td style="padding-left:15px;padding-bottom:15px; border-bottom:2px solid #353989;font-weight:bold;">' . WEBSITE_NAME . '</td>
			</tr>
		  </table>';


		$this->email->from($from, $fromName);
		$this->email->to((implode(', ', $reportingStaffemail)));

		$this->email->subject($subject);
		$this->email->message($message);

		if ($this->email->send()) {
			// echo "Mail Sent Successfully";
			return true;
		} else {
			return false;
			// echo "Failed to send email";
			// show_error($this->email->print_debugger());
		}
	}

	public function editTaskStatusDetails()
	{
		$this->load->model('staff/Task_status_details', 'taskstatus');
		$this->load->model('staff/Tasks', 'task');
		$pagename = $this->input->post('pagename');
		$editid = $this->input->post('editid');
		$taskDetails = $this->taskstatus->get_by(array('task_details_id' => $editid));
		if ($pagename != "" && $editid != "") {
			if ($taskDetails) {
				$this->data['modalname'] = $pagename;
				$this->data['editid'] = $editid;
				$this->data['taskDetails'] = $taskDetails;
				echo $this->load->view('commonmodal', $this->data, true);
			}
		}
	}

	public function editTaskStatusDetailsProcess()
	{
		$this->load->model('staff/Tasks', 'task');
		$this->load->model('staff/Task_staff', 'taskstaff');
		$this->load->model('staff/Task_status_details', 'taskstatus');

		$task_status = $this->input->post('task_completion_status', true);
		$task_execution_date = $this->input->post('task_execution_date', true);
		$task_time_spend_hours = $this->input->post('task_time_spend_hours', true);
		$task_time_spend_mins = $this->input->post('task_time_spend_mins', true);
		$task_remarks = $this->input->post('task_remarks', true);



		$editid = $this->input->post('editid', true);


		$validation = array(
			'task_name' => $task_status,
			'category' => $task_execution_date,
			'subcategory' => $task_time_spend_hours,
			'task_status' => $task_time_spend_mins,
			'priority' => $task_execution_date
		);
		if ($this->task->validate($validation, 'formvalid')) {
			$curdate = date('Y-m-d H:i:s');
			if ($editid != "") {
				// $maxstatus= $this->taskstatus->getmaxstatus($editid, $this->loggeduserid);

				$editDataCheck = $this->taskstatus->get_by(array(
					'td_staff_id' => $this->loggeduserid,
					'task_details_id' => $editid
				));
				if ($editDataCheck) {
					$checkDateandStatus = $this->taskstatus->get_by(array(
						'td_staff_id' => $this->loggeduserid,
						'td_task_id' => $editDataCheck->td_task_id, 'td_completion_percentage <=' => $task_status, 'td_execution_date >' => date('Y-m-d', strtotime($task_execution_date))
					));
					$errorArray = [];

					if ($checkDateandStatus) {
						if ($checkDateandStatus->td_completion_percentage <= $task_status) {
							$errorArray[] =  'You can not enter same or higher  status on this date';
						}
					}

					$checkInBetweenData = $this->taskstatus->getpreviousentrydate($editDataCheck->td_task_id, $this->loggeduserid, $task_execution_date);
					if (count($checkInBetweenData) > 0) {
						if (isset($checkInBetweenData['previousdatestatus']) && $task_status <= $checkInBetweenData['previousdatestatus']) {
							$errorArray[] =  'Please enter status values between previous entries statuses';
						} elseif (isset($checkInBetweenData['nextdatestatus']) && $task_status >= $checkInBetweenData['nextdatestatus']) {
							$errorArray[] =  'Please enter status values between previous entries statuses';
						}
					}


					$maxstatus = $this->taskstatus->getmaxstatus($editDataCheck->td_task_id, $this->loggeduserid);
					if ($maxstatus) {
						if ($maxstatus == $task_status) {
							$errorArray[] =  'You can not enter same status value again';
						}

						$checkDateandStatus = $this->taskstatus->get_by(array(
							'td_staff_id' => $this->loggeduserid,
							'td_task_id' => $editDataCheck->td_task_id, 'td_completion_percentage =' => $maxstatus
						));
						if ($checkDateandStatus) {
							if (strtotime($task_execution_date) > strtotime($checkDateandStatus->td_execution_date)) {
								if ($task_status <= $checkDateandStatus->td_completion_percentage) {
									$errorArray[] =  'Status value should be greater';
								}
							}
						}
					}


					if ($maxstatus != "") {
						if ($task_status > $maxstatus) {
							$staff_task_status = $task_status;
							if ($task_status == 0) {
								$taskCompletedStatus = 0;
							} elseif ($task_status < 100) {
								$taskCompletedStatus = 1;
							} elseif ($task_status == 100) {
								$taskCompletedStatus = 2;
							}
						} else {
							$staff_task_status = $maxstatus;

							if ($maxstatus == 0) {
								$taskCompletedStatus = 0;
							} elseif ($maxstatus < 100) {
								$taskCompletedStatus = 1;
							} elseif ($maxstatus == 100) {
								$taskCompletedStatus = 2;
							}
						}
					} else {
						$staff_task_status = $task_status;
						if ($task_status == 0) {
							$taskCompletedStatus = 0;
						} elseif ($task_status < 100) {
							$taskCompletedStatus = 1;
						} elseif ($task_status == 100) {
							$taskCompletedStatus = 2;
						}
					}




					// $taskStatusTotal=$this->taskstatus->get_many_by(array('td_task_id'=>$editDataCheck->td_task_id,'td_staff_id'=>$editDataCheck->td_staff_id,'td_status'=>'0'));
					// if ($taskStatusTotal) {
					//     $timeSpentArray = timeSpentCalculation($taskStatusTotal);
					//     $hours=0;
					//     $minutes=0;
					//     if ($task_time_spend_hours!='') {
					//         $hours += $task_time_spend_hours;
					//     }
					//     if ($task_time_spend_mins!='') {
					//         $minutes += $task_time_spend_mins;
					//     }
					//     if (isset($timeSpentArray['hours'])) {
					//         $hours +=$timeSpentArray['hours'];
					//     }
					//     if (isset($timeSpentArray['minutes'])) {
					//         $minutes +=$timeSpentArray['minutes'];
					//     }
					//     if ($minutes > 0) {
					//         $hours += floor($minutes / 60);
					//     }

					//     if ($hours > 4) {
					//         $errorArray[]=  'Task total hours sould be less than or euqual to 4 Hrs';
					//     }
					// }

					if ($editDataCheck->td_completion_percentage == $task_status && strtotime($editDataCheck->td_execution_date) == strtotime($task_execution_date)) {
						$emptyArray = (array) null;
					}


					if (count($errorArray) <= 0) {
						$taskDetails = $this->taskstatus->get_by(array('task_details_id' => $editid));

						$this->taskstaff->update_status_by(array(
							'tsa_staffid' => $this->loggeduserid,
							'tsa_taskid' => $taskDetails->td_task_id
						), array(
							'tsa_completed_status' => $taskCompletedStatus,
							'tsa_addedby' => $this->loggeduserid
						));
						$taskStaffDetails = $this->taskstaff->get_by(array(
							'tsa_staffid' => $this->loggeduserid,
							'tsa_taskid' => $taskDetails->td_task_id
						));
						if ($task_status > $taskStaffDetails->tsa_completed_percentage) {
							$this->taskstaff->update_status_by(array(
								'tsa_staffid' => $this->loggeduserid,
								'tsa_taskid' => $taskDetails->td_task_id
							), array(
								'tsa_completed_percentage' => $staff_task_status,

							));
						}


						if ($task_status > 0) {
							$this->taskstatus->update_status_by(array('task_details_id' => $editid), array(
								'td_completion_percentage' => $task_status,
								'td_execution_date' => date('Y-m-d', strtotime($task_execution_date)),
								'td_hours' => $task_time_spend_hours,
								'td_minutes' => $task_time_spend_mins,
								'td_remarks' => $task_remarks,
								'td_addedby' => $this->loggeduserid,

							));
						}

						$this->session->set_flashdata('successmessage', 'Task status  added successfully.');
						$result = array('status' => 'Yes', 'Message' => 'Task status added successfully');
					} else {
						$this->session->set_flashdata('errormessage', $errorArray[0]);
						$result = array('status' => 'No', 'Message' => $errorArray[0]);
					}
				} else {
					$this->session->set_flashdata('errormessage', 'Execution date already entered');
					$result = array('status' => 'No', 'Message' => 'Execution date already entered');
				}
			}
		} else {
			$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
			$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
		}

		echo json_encode($result);
	}
	public function viewTaskStatusDetails()
	{
		$this->load->model('staff/Task_status_details', 'taskstatus');
		$this->load->model('staff/Tasks', 'task');
		$pagename = $this->input->post('pagename');
		$editid = $this->input->post('editid');
		$taskDetails = $this->taskstatus->get_by(array('task_details_id' => $editid));
		if ($pagename != "" && $editid != "") {
			if ($taskDetails) {
				$this->data['modalname'] = $pagename;
				$this->data['editid'] = $editid;
				$this->data['taskDetails'] = $taskDetails;
				echo $this->load->view('commonmodal', $this->data, true);
			}
		}
	}

	public function addcalender_task()
	{
		$calendar_event_name = $this->input->post('calendar_event_name');
		$event_description = $this->input->post('calendar_event_description');
		$calendar_event_location = $this->input->post('calendar_event_location');
		$calendar_event_start_date = $this->input->post('calendar_event_start_date');
		$kt_calendar_datepicker_end_date = $this->input->post('calendar_event_end_date');
		$kt_calendar_datepicker_start_time = $this->input->post('calendar_event_start_time');
		$kt_calendar_datepicker_end_time = $this->input->post('calendar_event_end_time');
		$data = array(
			'event_name' => $calendar_event_name,
			'event_description' => $event_description,
			'event_location' => $calendar_event_location,
			'datepicker_start_date' => $calendar_event_start_date,
			'datepicker_end_date' => $kt_calendar_datepicker_end_date,
			'datepicker_start_time' => $kt_calendar_datepicker_start_time,
			'datepicker_end_time' => $kt_calendar_datepicker_end_time
		);
		$this->db->insert('calendar', $data);
		// if ($pagename) {
		//     $this->data['modalname'] = $pagename;
		//     echo $this->load->view('commonmodal', $this->data, true);
		// }
		redirect(base_url('staff/calendar'));
	}


	public function deleteTaskDetails($item)
	{
		$this->load->model('staff/Tasks', 'task');
		$getitem = $this->task->get_by(array('taskid' => $item));
		if ($getitem != "") {
			if ($getitem) {
				$status = ($getitem->task_active == "0") ? '1' : '0';
				$statusText = ($getitem->task_active == "0") ? 'Deleted' : 'Enabled';
				$deleted = $this->task->update_status_by(array('taskid' => $item), array('task_active' => $status));

				if ($deleted) {
					$this->session->set_flashdata('successmessage', 'Task ' . $statusText . ' successfully.');
					echo "true";
				} else {
					$this->session->set_flashdata('errormessage', 'Error occurred ,Please try again.');
					echo "false";
				}
			} else {
				$this->session->set_flashdata('errormessage', 'Error occurred ,Please try again.');
				echo "false";
			}
		} else {
			$this->session->set_flashdata('errormessage', 'Error occurred ,Please try again.');
			echo "false";
		}
	}

	public function reportingstafftasks()
	{
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('reportingstafftasks();');
		$this->data['title']           = "Tasks";

		$this->load->template('reportingstafftasks', $this->data, false);
	}

	public function ajaxreportingstafftaskslist()
	{
		$this->load->model('staff/Tasks', 'task');
		$list = $this->task->get_datatables_reporting();
		$tabledata = array();
		$no = $this->input->post('start', true);
		$vt = 1;
		foreach ($list as $item) {
			$authid = $this->checksumgen($item->taskid);
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = ucfirst(strtolower($item->task_title));
			//$row[] = ucfirst(strtolower($item->task_title));
			$row[] = ucfirst(strtolower($item->tc_name)) . '-' . ucfirst(strtolower($item->sc_name));

			switch ($item->task_priority) {
				case 'low':
					$priority = '<span class="badge badge-light-success fs-base">' . ucfirst(strtolower($item->task_priority)) . '</span>';
					break;
				case 'normal':
					$priority = '<span class="badge badge-light-success fs-base">' . ucfirst(strtolower($item->task_priority)) . '</span>';
					break;
				case 'urgent':
					$priority = '<span class="badge badge-light-danger fs-base">' . ucfirst(strtolower($item->task_priority)) . '</span>';
					break;
			}

			$row[] = $priority;
			// $row[] = ucfirst(strtolower($item->tsa_completed_percentage));
			$row[] = '<a href="' . base_url() . 'staff/viewassignedlist/' . $item->taskid . '/' . $authid . '"  class="btn btn-view mt-2  btn-sm " "><i class="fa fa-eye"></i> View</a>&nbsp;';

			$statusText = ($item->tc_status == "0") ? array('Delete', 'btn btn-delete btn-sm', 'fa-times-circle') : array('Enable', 'btn btn-light-success btn-sm', 'fa-check');
			$deleteOption = '';
			$editStatus = '';
			if ($item->task_staffid == $this->loggeduserid) {
				$deleteOption = '<a href="javascript:;" data-itemid="' . $item->taskid . '"  class="' . $statusText[1] . '  deleteTaskDetails"><i class="fas ' . $statusText[2] . '"></i> ' . $statusText[0] . '</a>';
				$editStatus = '<a href="' . base_url() . 'staff/editreportingstafftask/' . $item->taskid . '/' . $authid . '"  class="btn btn-edit  btn-sm " "><i class="fa fa-edit"></i> Edit</a>&nbsp;';
			}

			$row[] = $editStatus . '  <a href="' . base_url() . 'staff/viewtaskbyreporting/' . $item->taskid . '/' . $authid . '"  class="btn btn-view mt-2  btn-sm " "><i class="fa fa-eye"></i> View</a>&nbsp; ' . $deleteOption;

			$tabledata[] = $row;
			$vt++;
			/* ================================ */
		}

		$output = array(
			"draw" => $this->input->post('draw', true),
			"recordsTotal" => $this->task->count_all_reporting(),
			"recordsFiltered" => $this->task->count_filtered_reporting(),
			"data" => $tabledata,
		);

		echo json_encode($output);
	}

	public function viewtaskbyreporting($id, $auth)
	{
		if ($this->validchecksumcheck($id, $auth)) {
			$this->load->model('staff/Tasks', 'task');
			$this->load->model('staff/Task_status_details', 'taskstatus');
			$taskDetails = $this->task->gettaskdetails($id);

			$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
			$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
			$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
			$this->data['scriptfunctions'] = array('viewtaskbyreporting();');
			$this->data['taskDetails'] = array_shift($taskDetails);
			$this->data['auth'] = $auth;
			$this->data['title']           = "Task Details";
			// $this->data['taskStatusDetails']=$this->taskstatus->get_many_by(array('td_staff_id'=>$this->loggeduserid,'td_task_id'=>$id,'td_status'=>'0'));
			$this->load->template('viewtaskbyreporting', $this->data, false);
		} else {
			$this->session->set_flashdata('successmessage', 'Invalid request');
			redirect('staff/reportingstafftasks');
		}
	}

	public function reportingaddtask()
	{
		$this->load->model('admin/Task_category', 'category');
		$this->load->model('admin/Staff_reporting_conn', 'reporting');
		$this->load->model('admin/Team', 'team');
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('reportingaddtask();');
		$this->data['categorylist']    = $this->category->get_many_by(array('tc_status' => 0));
		$this->data['allusers'] = $this->reporting->getallassignedstafflist($this->loggeduserid);
		$this->data['allteam'] = $this->team->getallteamsofreporting($this->loggeduserid);
		$this->data['title']           = "Add Task";
		$this->load->template('reportingaddtask', $this->data, false);
	}

	public function reportingTaskSubmitProcess()
	{
		$this->load->model('staff/Tasks', 'task');
		$this->load->model('staff/Task_staff', 'taskstaff');
		$this->load->model('staff/Task_status_details', 'taskstatus');
		$this->load->model('admin/Team_member', 'teammember');
		$task_name = $this->input->post('task_name', true);
		$category = $this->input->post('category', true);
		$subcategory = $this->input->post('subcategory', true);
		$task_details = $this->input->post('task_details', true);
		$task_status = 0;
		$priority = $this->input->post('priority', true);

		$task_date = $this->input->post('task_date', true);
		$task_end_date = $this->input->post('task_end_date', true);
		$assign_staff = $this->input->post('assign_staff');
		$assign_team = $this->input->post('assign_team');
		$assign_type = $this->input->post('assign_type', true);



		$editid = $this->input->post('editid', true);
		$editauth = $this->input->post('editauth', true);

		$validation = array(
			'task_name' => $task_name,
			'category' => $category,
			'subcategory' => $subcategory,
			'task_status' => ($editid == "") ? $task_status : '0',
			'priority' => $priority
		);
		if ($this->task->validate($validation, 'formvalid')) {
			$curdate = date('Y-m-d H:i:s');
			if ($editid == "") {
				if ($task_status == 0) {
					$taskCompletedStatus = 0;
				} elseif ($task_status < 100) {
					$taskCompletedStatus = 1;
				} elseif ($task_status == 100) {
					$taskCompletedStatus = 2;
				}
				$taksInserted = $this->task->insert(array(
					'task_category' => $category,
					'task_subcategory' => $subcategory,
					'task_title' => $task_name,
					'task_details' => $task_details,
					'task_staffid' => $this->loggeduserid,
					'task_priority' => $priority,
					'task_date' => date('Y-m-d', strtotime($task_date)),
					'task_end_date' => ($task_date != "") ? date('Y-m-d', strtotime($task_end_date)) : '',
					//'task_completed_percentage' => $task_status,
					'task_status' => $taskCompletedStatus,
					'task_addedby' => $this->loggeduserid,
					'task_addedon' => $curdate,
					'task_temids' => (isset($assign_team) && count($assign_team) > 0) ? implode(',', $assign_team) : ''

				), true);
				if ($taksInserted) {
					if ($assign_type == '1') {
						if (count($assign_staff)) {
							$staffList = [];
							foreach ($assign_staff as $staff) {
								$staffList[] = array(
									'tsa_staffid' => $staff,
									'tsa_taskid' => $taksInserted,
									'tsa_completed_status' => $taskCompletedStatus,
									'tsa_completed_percentage' => $task_status,
									'tsa_status' => '0',
									'tsa_addedby' => $this->loggeduserid,
									'tsa_addedon' => $curdate,
								);
							}
							if (count($staffList) > 0) {
								$this->taskstaff->insert_many($staffList, true);
							}
						}
					} elseif ($assign_type == '2') {
						foreach ($assign_team as $team) {
							$teamMembers = $this->teammember->get_many_by(array('tm_teamid' => $team, 'tm_ishead' => '0', 'tm_status' => '0'));
							$assignStaffArray = [];
							foreach ($teamMembers as $member) {
								$assignStaffArray[] = array(
									'tsa_staffid' => $member,
									'tsa_taskid' => $taksInserted,
									'tsa_completed_status' => $taskCompletedStatus,
									'tsa_completed_percentage' => '0',
									'tsa_status' => '0',
									'tsa_addedby' => $this->loggeduserid,
									'tsa_addedon' => $curdate,
								);
							}
							if (count($assignStaffArray) > 0) {
								$this->taskstaff->insert_many($assignStaffArray, true);
							}
						}
					}






					$this->session->set_flashdata('successmessage', 'Task  added successfully.');
					$result = array('status' => 'Yes', 'Message' => 'Task added successfully');
				} else {
					$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
					$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
				}
			} else {
				if ($this->validchecksumcheck($editid, $editauth)) {
					$taksInserted = $this->task->update_status_by(array('taskid' => $editid), array(
						'task_category' => $category,
						'task_subcategory' => $subcategory,
						'task_title' => $task_name,
						'task_details' => $task_details,
						'task_priority' => $priority,
						//'task_completed_percentage' => $task_status,
						'task_date' => date('Y-m-d', strtotime($task_date)),
						'task_end_date' => ($task_date != "") ? date('Y-m-d', strtotime($task_end_date)) : '',
						'task_addedby' => $this->loggeduserid,
						'task_temids' => (isset($assign_team) && count($assign_team) > 0) ? implode(',', $assign_team) : ''

					));

					if (isset($assign_type)) {
						if ($assign_type == '1') {
							$this->taskstaff->delete_by(array('tsa_taskid' => $editid));
							$staffList = [];
							foreach ($assign_staff as $staff) {
								$staffList[] = array(
									'tsa_staffid' => $staff,
									'tsa_taskid' => $editid,
									'tsa_completed_status' => $task_status,
									'tsa_completed_percentage' => $task_status,
									'tsa_status' => '0',
									'tsa_addedby' => $this->loggeduserid,
									'tsa_addedon' => $curdate,
								);
							}
							if (count($staffList) > 0) {
								$this->taskstaff->insert_many($staffList, true);
							}
						} elseif ($assign_type == '2') {
							$this->taskstaff->delete_by(array('tsa_taskid' => $editid));
							foreach ($assign_team as $team) {
								$teamMembers = $this->teammember->get_many_by(array('tm_teamid' => $team, 'tm_ishead' => '0', 'tm_status' => '0'));
								$assignStaffArray = [];
								foreach ($teamMembers as $member) {
									$assignStaffArray[] = array(
										'tsa_staffid' => $member,
										'tsa_taskid' => $editid,
										'tsa_completed_status' => $task_status,
										'tsa_completed_percentage' => $task_status,
										'tsa_status' => '0',
										'tsa_addedby' => $this->loggeduserid,
										'tsa_addedon' => $curdate,
									);
								}
								if (count($assignStaffArray) > 0) {
									$this->taskstaff->insert_many($assignStaffArray, true);
								}
							}
						}
					}

					if ($taksInserted) {
						$this->session->set_flashdata('successmessage', 'Task  updated successfully.');
						$result = array('status' => 'Yes', 'Message' => 'Task updated successfully');
					} else {
						$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
						$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
					}
				} else {
					$this->session->set_flashdata('errormessage', 'Invalid request');
					$result = array('status' => 'No', 'Message' => 'Invalid request');
				}
			}
		} else {
			$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
			$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
		}

		echo json_encode($result);
	}



	public function editreportingstafftask($id, $auth)
	{
		if ($this->validchecksumcheck($id, $auth)) {
			$this->load->model('staff/Tasks', 'task');
			$this->load->model('staff/Task_staff', 'taskstaff');
			$this->load->model('admin/Staff_reporting_conn', 'reporting');
			$this->load->model('admin/Team', 'team');
			$taskDetails = $this->task->get_by(array('taskid' => $id));
			$this->load->model('admin/Task_category', 'category');
			$this->load->model('admin/Subcategory', 'subcategory');
			$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
			$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
			$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
			$this->data['scriptfunctions'] = array('reportingaddtask();');
			$this->data['categorylist']    = $this->category->get_many_by(array('tc_status' => 0));
			$this->data['allusers'] = $this->reporting->getallassignedstafflist($this->loggeduserid);
			$this->data['allteam'] = $this->team->getallteamsofreporting($this->loggeduserid);
			$this->data['subcategory'] = $this->subcategory->get_many_by(array('sc_categoryid' => $taskDetails->task_category, 'sc_status' => '0'));
			$this->data['taskDetails'] = $taskDetails;
			$this->data['auth'] = $auth;
			$this->data['title']           = "Update Task";
			$this->data['gettaskstaffids'] = $this->taskstaff->gettaskstaffids($id);


			$this->load->template('reportingaddtask', $this->data, false);
		} else {
			$this->session->set_flashdata('successmessage', 'Invalid request');
			redirect('staff/reportingstafftasks');
		}
	}

	public function viewassignedlist($id, $auth)
	{
		if ($this->validchecksumcheck($id, $auth)) {
			$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
			$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
			$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
			$this->data['scriptfunctions'] = array('viewassignedlist();');
			$this->data['title']           = "View Details";
			$this->data['editid']           = $id;
			$this->load->template('admin/manage_tasks/view_task_assigned_list', $this->data, false);
		} else {
			$this->session->set_flashdata('errormessage', 'Invalid request');
			redirect('staff/reportingstafftasks');
		}
	}

	public function addTaskStatus()
	{
		$pagename = $this->input->post('pagename');
		if ($pagename != "") {
			$this->data['modalname'] = $pagename;
			$this->data['startcount'] = $this->input->post('startcount');
			echo $this->load->view('commonmodal', $this->data, true);
		}
	}

	public function addTaskStatusDetails()
	{
		$items = $this->input->post('items');
		if ($items != "") {
			$this->data['taskStatusDetails'] =  $items;
			$this->data['modalname'] = 'addTaskStatusDetails';
			echo $this->load->view('commonmodal', $this->data, true);
		}
	}
	public function editAddTaskStatusDetails()
	{
		$items = $this->input->post('editdata');
		$pagename = $this->input->post('pagename');
		$editid = $this->input->post('editid');
		if ($items != "") {
			$this->data['taskStatusDetails'] =  $items[0];
			$this->data['modalname'] = $pagename;
			$this->data['editid'] = $editid;
			echo $this->load->view('commonmodal', $this->data, true);
		}
	}

	public function viewtaskdetails($id, $auth)
	{
		if ($this->validchecksumcheck($id, $auth)) {
			$this->load->model('staff/Tasks', 'task');
			$this->load->model('staff/Task_status_details', 'taskstatus');
			$this->load->model('staff/Task_staff', 'taskstaff');
			$taskDetails = $this->task->gettaskdetails($id, $this->loggeduserid);

			$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
			$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
			$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
			$this->data['taskDetails'] = array_shift($taskDetails);
			$this->data['auth'] = $auth;
			$this->data['title']           = "Task Details";


			$timeSpent = 0;
			$taskStatus = $this->taskstatus->get_many_by(array('td_staff_id' => $this->loggeduserid, 'td_task_id' => $id, 'td_status' => '0'));
			$this->data['taskStatusDetails'] = $taskStatus;
			if ($taskStatus) {
				$timeHours = $taskStatus[0]->td_hours;
				$timeminutes = $taskStatus[0]->td_minutes;
				$time = strtotime($timeHours . ':' . $timeminutes);

				$timeSpent = $this->totalTimeCalculation($taskStatus);
			}
			$this->data['timeSpent'] = $timeSpent;


			$this->data['scriptfunctions'] = array('viewtaskdetails();');
			$this->data['taskstaff'] = $this->taskstaff->get_by(array('tsa_staffid' => $this->loggeduserid, 'tsa_taskid ' => $id, 'tsa_status' => '0'));

			$this->load->template('viewtaskdetails', $this->data, false);
		} else {
			$this->session->set_flashdata('successmessage', 'Invalid request');
			redirect('staff/tasks');
		}
	}

	public function finishedtasks()
	{
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('finishedtasks();');
		$this->data['title']           = "Tasks";

		$this->load->template('finishedtasks', $this->data, false);
	}

	public function reportingstafftasksfinished()
	{
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('reportingstafftasksfinished();');
		$this->data['title']           = "Tasks";

		$this->load->template('reportingstafftasksfinished', $this->data, false);
	}
	public function ajaxreportingstafftasksfinishedlist()
	{
		$this->load->model('staff/Tasks', 'task');
		$this->load->model('staff/Task_status_details', 'taskstatus');
		$list = $this->task->get_datatables_reporting_finished();
		$tabledata = array();
		$no = $this->input->post('start', true);
		$vt = 1;
		foreach ($list as $item) {
			$authid = $this->checksumgen($item->taskid);


			$timeSpent = 0;
			$taskStatus = $this->taskstatus->get_many_by(array('td_task_id' => $item->taskid, 'td_staff_id' => $item->authenticationid, 'td_status' => '0'));
			if ($taskStatus) {
				$timeHours = $taskStatus[0]->td_hours;
				$timeminutes = $taskStatus[0]->td_minutes;
				$time = strtotime($timeHours . ':' . $timeminutes);

				$timeSpent = $this->totalTimeCalculation($taskStatus);
			}

			$no++;
			$row = array();
			if ($item->tsa_approved != '1') {
				$row[] = '<div class="form-check form-check-sm form-check-custom form-check-solid">
            <input class="form-check-input finishedtaskcheck" type="checkbox" name="allusers[]"  value="' . $item->task_staff_addedid . '" />
            </div>';
			} else {
				$row[] = '';
			}
			$row[] = ucfirst(strtolower($item->task_title));
			$row[] = ucfirst(strtolower($item->tc_name)) . '-' . ucfirst(strtolower($item->sc_name));
			switch ($item->task_priority) {
				case 'low':
					$priority = '<span class="badge badge-light-success fs-base">' . ucfirst(strtolower($item->task_priority)) . '</span>';
					break;
				case 'normal':
					$priority = '<span class="badge badge-light-success fs-base">' . ucfirst(strtolower($item->task_priority)) . '</span>';
					break;
				case 'urgent':
					$priority = '<span class="badge badge-light-danger fs-base">' . ucfirst(strtolower($item->task_priority)) . '</span>';
					break;
			}
			$row[] = $priority;
			$row[] = ucfirst(strtolower($item->au_title)) . ' ' . ucfirst(strtolower($item->au_crickf)) . '(' . $item->au_emp_number . ')';
			$row[] = ($item->tsa_approved == '1') ? 'Approved' : '';
			$row[] = $timeSpent;
			$row[] = '<a href="' . base_url() . 'staff/viewfinishedtaskbyreporting/' . $item->taskid . '/' . $authid . '/' . $item->authenticationid . '"  class="btn btn-view mt-2  btn-sm " "><i class="fa fa-eye"></i> View</a>&nbsp; ';

			$tabledata[] = $row;
			$vt++;
			/* ================================ */
		}

		$output = array(
			"draw" => $this->input->post('draw', true),
			"recordsTotal" => $this->task->count_all_reporting_finished(),
			"recordsFiltered" => $this->task->count_filtered_reporting_finished(),
			"data" => $tabledata,
		);

		echo json_encode($output);
	}

	public function viewfinishedtaskbyreporting($id, $auth, $userid)
	{
		if ($this->validchecksumcheck($id, $auth)) {
			$this->load->model('staff/Tasks', 'task');
			$this->load->model('staff/Task_status_details', 'taskstatus');
			$taskDetails = $this->task->gettaskdetailswithstaff($id, $userid);


			$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
			$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
			$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
			$this->data['scriptfunctions'] = array('viewtaskbyreporting();');
			$this->data['taskDetails'] = $taskDetails;
			$this->data['auth'] = $auth;
			$this->data['title']           = "Task Details";
			$this->data['userid']           = $userid;


			$timeSpent = 0;
			$taskStatus = $this->taskstatus->get_many_by(array('td_staff_id' => $userid, 'td_task_id' => $id, 'td_status' => '0'));
			$this->data['taskStatusDetails'] = $taskStatus;
			if ($taskStatus) {
				$timeHours = $taskStatus[0]->td_hours;
				$timeminutes = $taskStatus[0]->td_minutes;
				$time = strtotime($timeHours . ':' . $timeminutes);

				$timeSpent = $this->totalTimeCalculation($taskStatus);
			}
			$this->data['timeSpent']           = $timeSpent;
			$this->load->template('viewfinishedtaskbyreporting', $this->data, false);
		} else {
			$this->session->set_flashdata('successmessage', 'Invalid request');
			redirect('staff/reportingstafftasks');
		}
	}
	public function totalTimeCalculation($taskStatus)
	{
		$hours = 0;
		$minutes = 0;
		foreach ($taskStatus as $time) {
			if ($time->td_hours != '') {
				$hours += $time->td_hours;
			}
			if ($time->td_minutes != '') {
				$minutes += $time->td_minutes;
			}
		}

		$totalHours = floor($minutes / 60) . ':' . ($minutes -   floor($minutes / 60) * 60);
		$hours += floor($minutes / 60);
		$totalMinutes = ($minutes -   floor($minutes / 60) * 60);
		return $hours . 'Hrs : ' . $totalMinutes . 'Mins';
	}

	public function gettallstafftask()
	{
		$this->load->model('staff/Tasks', 'task');
		$tasklist = $this->task->getstaffalltasks($this->loggeduserid);
		$taskArray = [];
		if ($tasklist) {
			foreach ($tasklist as $task) {
				switch ($task->task_priority) {
					case 'low':
						$color = '#009ef7';
						break;
					case 'normal':
						$color = '#50cd89';
						break;
					case 'urgent':
						$color = '#f1416c';
						break;
				}
				$taskArray[] = array(
					'id' => $task->taskid,
					'title' => (($task->tsa_completed_percentage > 0) ? $task->tsa_completed_percentage : '0') . '% | ' . ucfirst(strtolower($task->task_title)),
					'description' => $task->task_details,
					'start' => $task->task_date, //date('d-m-Y',strtotime($task->task_date)),
					'completed_percentage' => $task->task_completed_percentage,
					'priority' => $task->task_priority,
					'status' => $task->task_status,
					'color' => $color
					//'display'=> 'background'
				);
			}
		}

		echo json_encode($taskArray);
	}
	public function approveTaskStatus()
	{
		$this->load->model('staff/Task_staff', 'taskstaff');
		$pagename = $this->input->post('pagename');
		$stafftaskid = $this->input->post('stafftaskid');
		$taskid = $this->input->post('taskid');
		$staffid = $this->input->post('staffid');
		$taskDetails = $this->taskstaff->get_by(array('tsa_staffid' => $staffid, 'task_staff_addedid' => $stafftaskid, 'tsa_taskid' => $taskid));
		if ($pagename != "" && $stafftaskid != "") {
			if ($taskDetails) {
				$this->data['modalname'] = $pagename;
				$this->data['editid'] = $stafftaskid;
				echo $this->load->view('commonmodal', $this->data, true);
			}
		}
	}

	public function approveTaskProcess()
	{
		$this->load->model('staff/Task_staff', 'taskstaff');
		$this->load->model('staff/Task_status_details', 'taskstatus');
		$this->load->model('staff/Task_approved_details', 'taskapproved');
		$task_comments = $this->input->post('task_comments', true);
		$editid = $this->input->post('editid', true);

		if ($editid != "") {
			$curdate = date('Y-m-d H:i:s');


			$taksInserted = $this->taskstaff->update_status_by(array('task_staff_addedid' => $editid), array(
				'tsa_approved' => '1',
				'tsa_approvedon' => $curdate,
				'tsa_approved_by' => $this->loggeduserid,
				'tsa_comment' => $task_comments

			));

			$getTaskDetails = $this->taskstaff->get_by(array('task_staff_addedid' => $editid));

			$taskApprovedId = $this->taskapproved->insert(array(
				'ad_staff_id' => $getTaskDetails->tsa_staffid,
				'ad_task_id' => $getTaskDetails->tsa_taskid,
				'ad_approved_date' => date('Y-m-d'),
				'ad_approved_type' => '1',
				'ad_approved_comment' => $task_comments,
				'ad_approved_by' => $this->loggeduserid
			), true);

			$taksInserted = $this->taskstatus->update_status_by(array('td_staff_id' => $getTaskDetails->tsa_staffid, 'td_task_id' => $getTaskDetails->tsa_taskid, 'td_approved !=' => '1'), array(
				'td_approved' => '1',
				'td_approved_id' => $taskApprovedId
			));
			if ($taksInserted) {
				$this->session->set_flashdata('successmessage', 'Task  approved successfully.');
				$result = array('status' => 'Yes', 'Message' => 'Task approved successfully');
			} else {
				$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
				$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
			}
		} else {
			$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
			$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
		}

		echo json_encode($result);
	}

	public function rejectTaskProcess()
	{
		$this->load->model('staff/Task_staff', 'taskstaff');
		$this->load->model('staff/Task_status_details', 'taskstatus');
		$this->load->model('staff/Task_approved_details', 'taskapproved');
		$task_comments = $this->input->post('task_comments', true);
		$editid = $this->input->post('editid', true);

		if ($editid != "") {
			$curdate = date('Y-m-d H:i:s');


			$taksInserted = $this->taskstaff->update_status_by(array('task_staff_addedid' => $editid), array(
				'tsa_approved' => '2',
				'tsa_approvedon' => $curdate,
				'tsa_approved_by' => $this->loggeduserid,
				'tsa_comment' => $task_comments


			));

			$getTaskDetails = $this->taskstaff->get_by(array('task_staff_addedid' => $editid));

			$taskApprovedId = $this->taskapproved->insert(array(
				'ad_staff_id' => $getTaskDetails->tsa_staffid,
				'ad_task_id' => $getTaskDetails->tsa_taskid,
				'ad_approved_date' => date('Y-m-d'),
				'ad_approved_type' => '2',
				'ad_approved_comment' => $task_comments,
				'ad_approved_by' => $this->loggeduserid
			), true);

			$taksInserted = $this->taskstatus->update_status_by(array('td_staff_id' => $getTaskDetails->tsa_staffid, 'td_task_id' => $getTaskDetails->tsa_taskid, 'td_approved !=' => '1'), array(
				'td_approved' => '2',
				'td_approved_id' => $taskApprovedId
			));
			if ($taksInserted) {
				$this->session->set_flashdata('successmessage', 'Task  rejected successfully.');
				$result = array('status' => 'Yes', 'Message' => 'Task rejected successfully');
			} else {
				$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
				$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
			}
		} else {
			$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
			$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
		}

		echo json_encode($result);
	}

	public function ajaxstafffinishedtaskslist()
	{
		$this->load->model('staff/Tasks', 'task');
		$this->load->model('staff/Task_status_details', 'taskstatus');
		$list = $this->task->get_datatables();
		$tabledata = array();
		$no = $this->input->post('start', true);
		$vt = 1;
		foreach ($list as $item) {
			$authid = $this->checksumgen($item->taskid);

			$timeSpent = 0;


			$taskStatus = $this->taskstatus->get_many_by(array('td_task_id' => $item->taskid, 'td_staff_id' => $item->tsa_staffid, 'td_status' => '0'));
			if ($taskStatus) {
				$timeHours = $taskStatus[0]->td_hours;
				$timeminutes = $taskStatus[0]->td_minutes;
				$time = strtotime($timeHours . ':' . $timeminutes);

				$timeSpent = $this->totalTimeCalculation($taskStatus);
			}



			$no++;
			$row = array();
			$row[] = $no;
			$row[] = ucfirst(strtolower($item->task_title));
			$row[] = ucfirst(strtolower($item->tc_name)) . '-' . ucfirst(strtolower($item->sc_name));
			//$row[] = ;
			switch ($item->tsa_completed_status) {
				case '0':
					$status = "Not Started";
					break;
				case '1':
					$status = "Pending";
					break;
				case '2':
					$status = "Completed";
					break;
			}
			switch ($item->task_priority) {
				case 'low':
					$priority = '<span class="badge badge-light-success fs-base">' . ucfirst(strtolower($item->task_priority)) . '</span>';
					break;
				case 'normal':
					$priority = '<span class="badge badge-light-success fs-base">' . ucfirst(strtolower($item->task_priority)) . '</span>';
					break;
				case 'urgent':
					$priority = '<span class="badge badge-light-danger fs-base">' . ucfirst(strtolower($item->task_priority)) . '</span>';
					break;
			}
			// $row[] = $status;
			$row[] = $priority;
			$row[] = ucfirst(strtolower($item->tsa_completed_percentage));

			$row[] = $timeSpent;

			$row[] = ($item->tsa_approved == '1') ? 'Approved' : '';
			// $row[] = ucfirst(strtolower(word_limiter($item->task_details, 100)));
			$statusText = ($item->tc_status == "0") ? array('Delete', 'btn btn-delete btn-sm', 'fa-times-circle') : array('Enable', 'btn btn-light-success btn-sm', 'fa-check');
			$deleteOption = '';
			if ($item->task_staffid == $this->loggeduserid && $item->tsa_approved != '1') {
				$deleteOption = '<a href="javascript:;" data-itemid="' . $item->taskid . '"  class="' . $statusText[1] . '  deleteTaskDetails"><i class="fas ' . $statusText[2] . '"></i> ' . $statusText[0] . '</a>';
			}
			$updateStatus = '';
			if ($item->tsa_completed_status != '2') {
				$updateStatus = '<a href="javascript:;" 
                data-item="' . $item->taskid . '"  class="btn btn-update updateTaskStatus btn-sm " "><i class="fa fa-plus"></i> Update Status</a>';
			}
			$editTask = '';
			if ($item->tsa_approved != '1') {
				$editTask =
					'<a href="' . base_url() . 'staff/edittask/' . $item->taskid . '/' . $authid . '"  class="btn btn-edit  btn-sm " "><i class="fa fa-edit"></i> Edit</a>&nbsp;';
			}
			$row[] = $updateStatus . ' ' . $editTask . '
            
            <a href="' . base_url() . 'staff/viewtaskdetails/' . $item->taskid . '/' . $authid . '"  class="btn btn-view mt-2  btn-sm " "><i class="fa fa-eye"></i> View</a>&nbsp;
            ' . $deleteOption;

			$tabledata[] = $row;
			$vt++;
			/* ================================ */
		}

		$output = array(
			"draw" => $this->input->post('draw', true),
			"recordsTotal" => $this->task->count_all(),
			"recordsFiltered" => $this->task->count_filtered(),
			"data" => $tabledata,
		);

		echo json_encode($output);
	}

	public function approveAllTaskStatus()
	{

		$this->load->model('staff/Task_staff', 'taskstaff');
		$this->load->model('staff/Tasks', 'task');
		$pagename = $this->input->post('pagename');
		$editid = $this->input->post('editid');

		$taskname = $this->task->gettaskdetails($editid);
		$taskname = array_shift($taskname);
		if ($pagename != "") {
			$this->data['modalname'] = $pagename;
			$this->data['taskname'] = $taskname->task_title;
			$this->data['editid'] = $editid;
			echo $this->load->view('commonmodal', $this->data, true);
		}
	}

	public function approveAllTaskProcess()
	{

		$this->load->model('staff/Task_staff', 'taskstaff');
		$this->load->model('staff/Task_status_details', 'taskstatus');
		$this->load->model('staff/Task_approved_details', 'taskapproved');
		$this->load->model('staff/Tasks', 'task');
		$task_comments = $this->input->post('task_comments', true);

		$checkedList = $this->input->post('checkedList');


		if (count($checkedList)) {
			$curdate = date('Y-m-d H:i:s');

			foreach ($checkedList as $item) {
				//uncommnet this
				$taksInserted = $this->taskstaff->update_status_by(array('task_staff_addedid' => $item), array(
					'tsa_approved' => '1',
					'tsa_approvedon' => $curdate,
					'tsa_approved_by' => $this->loggeduserid,
					'tsa_comment' => $task_comments
				));


				$getTaskDetails = $this->taskstaff->get_by(array('task_staff_addedid' => $item));

				//print_r($getTaskDetails);


				//uncomment this
				$taskApprovedId = $this->taskapproved->insert(array(
					'ad_staff_id' => $getTaskDetails->tsa_staffid,
					'ad_task_id' => $getTaskDetails->tsa_taskid,
					'ad_approved_date' => date('Y-m-d'),
					'ad_approved_type' => '1',
					'ad_approved_comment' => $task_comments,
					'ad_approved_by' => $this->loggeduserid
				), true);

				$taksInserted = $this->taskstatus->update_status_by(array('td_staff_id' => $getTaskDetails->tsa_staffid, 'td_task_id' => $getTaskDetails->tsa_taskid, 'td_approved !=' => '1'), array(
					'td_approved' => '1',
					'td_approved_id' => $taskApprovedId
				));
				//$isApproval = true;
				//$this->sendFinisedTaskStatusEmailToStaff($isApproval, $getTaskDetails, date('Y-m-d'), $task_comments);
			}


			if ($taksInserted) {
				//send email here

				$this->session->set_flashdata('successmessage', 'Task  approved successfully.');
				$result = array('status' => 'Yes', 'Message' => 'Task approved successfully');
			} else {
				$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
				$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
			}
		} else {
			$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
			$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
		}

		echo json_encode($result);
	}

	public function rejectAllTaskProcess()
	{
		$this->load->model('staff/Task_staff', 'taskstaff');
		$this->load->model('staff/Task_status_details', 'taskstatus');
		$this->load->model('staff/Task_approved_details', 'taskapproved');
		$this->load->model('staff/Tasks', 'task');
		$task_comments = $this->input->post('task_comments', true);
		$task_name = $this->input->post('task_name', true);
		$checkedList = $this->input->post('checkedList');
		$taskid = $this->input->post('editid', true);

		$this->task->update_status_by(array('taskid' => $taskid),  array('task_title' => $task_name));

		if (count($checkedList) > 0) {
			$curdate = date('Y-m-d H:i:s');

			foreach ($checkedList as $item) {
				$taksInserted = $this->taskstaff->update_status_by(array('task_staff_addedid' => $item), array(
					'tsa_approved' => '2',
					'tsa_approvedon' => $curdate,
					'tsa_approved_by' => $this->loggeduserid,
					'tsa_comment' => $task_comments
				));


				$getTaskDetails = $this->taskstaff->get_by(array('task_staff_addedid' => $item));

				$taskApprovedId = $this->taskapproved->insert(array(
					'ad_staff_id' => $getTaskDetails->tsa_staffid,
					'ad_task_id' => $getTaskDetails->tsa_taskid,
					'ad_approved_date' => date('Y-m-d'),
					'ad_approved_type' => '2',
					'ad_approved_comment' => $task_comments,
					'ad_approved_by' => $this->loggeduserid
				), true);

				$taksInserted = $this->taskstatus->update_status_by(array('td_staff_id' => $getTaskDetails->tsa_staffid, 'td_task_id' => $getTaskDetails->tsa_taskid, 'td_approved !=' => '1'), array(
					'td_approved' => '2',
					'td_approved_id' => $taskApprovedId
				));
				$isApproval = false;
				$this->sendFinisedTaskStatusEmailToStaff($isApproval, $getTaskDetails, date('Y-m-d'), $task_comments);
			}


			if ($taksInserted) {
				$this->session->set_flashdata('successmessage', 'Task  rejected successfully.');
				$result = array('status' => 'Yes', 'Message' => 'Task rejected successfully');
			} else {
				$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
				$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
			}
		} else {
			$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
			$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
		}

		echo json_encode($result);
	}

	public function sendFinisedTaskStatusEmailToStaff($isApproval, $taskDetails, $approvedDate, $task_comments)
	{
		$authid = $this->checksumgen($taskDetails->tsa_taskid);
		$tsakk = $this->task->gettaskdetails($taskDetails->tsa_taskid);
		$stafftask = $this->usersigin->getstaffbycondition(array('c.authenticationid' => $taskDetails->tsa_staffid, 'rp_reportingperson' => $this->loggeduserid));

		$reportingstaffemail = $this->usersigin->getstaffbycondition(array('c.authenticationid' => $this->loggeduserid));
		$au_cricka = $stafftask[0]->au_cricka;
		$au_cricke = $stafftask[0]->au_cricke;
		$au_emp_number = $stafftask[0]->au_emp_number;
		$authenticationid = $stafftask[0]->authenticationid;
		$reportingpersonname = $stafftask[0]->reportingpersonname;
		$reportempnumber = $stafftask[0]->reportempnumber;
		$task_title = $tsakk[0]->task_title;
		$task_details = $tsakk[0]->task_details;
		$task_completed_percentage = $tsakk[0]->task_completed_percentage;
		$taskStatus = ($isApproval == true) ? "approved successfully" : "rejected";
		$this->load->library('email');
		$fromName = "Reporting Person";
		$to = $au_cricke; 
		$from = $reportingstaffemail[0]->au_cricke; 
		$subject = ($isApproval == true) ? 'Task Appproved' : 'Task Rejected';
		$message = '<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
			  <td style="padding:10px;" height="45" style="background:white !important;">
				<img src="http://ahead-amrita.nfonics.com/components/media/logos/fav_ico.png" style="width: 90px;">
			  </td>
			</tr>
			<tr>
			  <td height="20">&nbsp;</td>
			</tr>
			<tr>
			  <td style="padding-left:15px; font-weight:bold;text-transform:capitalize;">Hi ' . ucfirst($au_cricka) . ',</td>
			</tr>
			<tr>
			  <td>&nbsp;</td>
			</tr>

			<tr>

			  <td style="padding-left:35px;line-height: 25px;padding-right: 15px;">Your task <b>' . ucfirst($task_title) . '</b> has been ' . $taskStatus . ' by <b>' . ucfirst($reportingpersonname) . '</b>. Please verify</td>
			</tr>
			<tr>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
		  <td style="padding-left:35px;font-weight:bold;"><a style="    display: block;width: 115px;height: 25px;background: #b20f55;padding: 10px;text-align: center;border-radius: 5px;  color: white;font-weight: bold;line-height: 25px;text-decoration: none;"class="btn btn-primary" href="' . base_url() . 'staff/viewtaskdetails/' .$taskDetails->tsa_taskid. '/' . $authid . '" >Click Here</a></td>
		</tr>

			<tr>
			  <td>&nbsp;</td>
			</tr>
			<tr>
			  <td style="padding-left:15px; height:30px;">Regards,</td>
			</tr>
			<tr>
			  <td style="padding-left:15px;padding-bottom:15px; border-bottom:2px solid #353989;font-weight:bold;">' . WEBSITE_NAME . '</td>
			</tr>
		  </table>';


		$this->email->from($from, $fromName);
		$this->email->to($to);

		$this->email->subject($subject);
		$this->email->message($message);

		if ($this->email->send()) {
			// echo "Mail Sent Successfully";
			return true;
		} else {
			return false;
			// echo "Failed to send email";
			// show_error($this->email->print_debugger());
		}
	}
	public function rejectedtasks()
	{
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('rejectedtasks();');
		$this->data['title']           = "Tasks";

		$this->load->template('rejectedtasks', $this->data, false);
	}

	public function ajaxstaffrejectedtaskslist()
	{
		$this->load->model('staff/Tasks', 'task');
		$list = $this->task->get_datatables();
		$tabledata = array();
		$no = $this->input->post('start', true);
		$vt = 1;
		foreach ($list as $item) {
			$authid = $this->checksumgen($item->taskid);
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = ucfirst(strtolower($item->task_title));
			$row[] = ucfirst(strtolower($item->tc_name)) . '-' . ucfirst(strtolower($item->sc_name));
			//$row[] = ;
			switch ($item->tsa_completed_status) {
				case '0':
					$status = "Not Started";
					break;
				case '1':
					$status = "Pending";
					break;
				case '2':
					$status = "Completed";
					break;
			}
			switch ($item->task_priority) {
				case 'low':
					$priority = '<span class="badge badge-light-success fs-base">' . ucfirst(strtolower($item->task_priority)) . '</span>';
					break;
				case 'normal':
					$priority = '<span class="badge badge-light-success fs-base">' . ucfirst(strtolower($item->task_priority)) . '</span>';
					break;
				case 'urgent':
					$priority = '<span class="badge badge-light-danger fs-base">' . ucfirst(strtolower($item->task_priority)) . '</span>';
					break;
			}
			// $row[] = $status;
			$row[] = $priority;
			$row[] = ucfirst(strtolower($item->tsa_completed_percentage));
			$row[] = ($item->tsa_approved == '1') ? 'Approved' : '';
			// $row[] = ucfirst(strtolower(word_limiter($item->task_details, 100)));
			$statusText = ($item->tc_status == "0") ? array('Delete', 'btn btn-delete btn-sm', 'fa-times-circle') : array('Enable', 'btn btn-light-success btn-sm', 'fa-check');
			$deleteOption = '';
			if ($item->task_staffid == $this->loggeduserid && $item->tsa_approved != '1') {
				$deleteOption = '<a href="javascript:;" data-itemid="' . $item->taskid . '"  class="' . $statusText[1] . '  deleteTaskDetails"><i class="fas ' . $statusText[2] . '"></i> ' . $statusText[0] . '</a>';
			}
			$updateStatus = '';
			if ($item->tsa_completed_status != '2') {
				$updateStatus = '<a href="javascript:;" 
                data-item="' . $item->taskid . '"  class="btn btn-update updateTaskStatus btn-sm " "><i class="fa fa-plus"></i> Update Status</a>';
			}
			$editTask = '';
			if ($item->tsa_approved != '1') {
				$editTask =
					'<a href="' . base_url() . 'staff/edittask/' . $item->taskid . '/' . $authid . '"  class="btn btn-edit  btn-sm " "><i class="fa fa-edit"></i> Edit</a>&nbsp;';
			}
			$row[] = $updateStatus . ' ' . $editTask . '
            
            <a href="' . base_url() . 'staff/viewtaskdetails/' . $item->taskid . '/' . $authid . '"  class="btn btn-view mt-2  btn-sm " "><i class="fa fa-eye"></i> View</a>&nbsp;
            ' . $deleteOption;

			$tabledata[] = $row;
			$vt++;
			/* ================================ */
		}

		$output = array(
			"draw" => $this->input->post('draw', true),
			"recordsTotal" => $this->task->count_all(),
			"recordsFiltered" => $this->task->count_filtered(),
			"data" => $tabledata,
		);

		echo json_encode($output);
	}





	public function taskCalendarView()
	{
		$this->load->model('staff/Tasks', 'task');
		$this->load->model('staff/Task_status_details', 'taskstatus');
		$pagename = $this->input->post('pagename');
		$editid = $this->input->post('editid');
		$taskDetails = $this->task->gettaskdetailswithstaff($editid, $this->loggeduserid);
		if ($pagename != "" && $editid != "") {
			if ($taskDetails) {
				$this->data['modalname'] = $pagename;
				$this->data['editid'] = $editid;
				$authid = $this->checksumgen($editid);
				if ($taskDetails->tsa_approved != '1') {
					$this->data['editurl'] = base_url() . 'staff/edittask/' . $editid . '/' . $authid;
				} else {
					$this->data['editurl'] = 'javascript:;';
				}
				$this->data['taskDetails'] = $taskDetails;
				$this->data['taskStatusDetails'] = $this->taskstatus->get_many_by(array('td_staff_id' => $this->loggeduserid, 'td_task_id' => $editid, 'td_status' => '0'));

				echo $this->load->view('commonmodal', $this->data, true);
			}
		}
	}

	public function staffcalendar($month = '', $year = '')
	{
		$this->load->model('admin/Staff_reporting_conn', 'reporting');
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('staffcalendarreporting();');
		$this->data['title']           = "Calendar";
		$this->data['allusers'] = $this->reporting->getallassignedstafflist($this->loggeduserid);
		$this->data['month'] = ($month != '') ? $month : date('m');
		$this->data['year'] = ($year != '') ? $year : date('Y');
		$this->data['controller'] = $this;
		$this->load->template('staffcalendar', $this->data, false);
	}

	public function gettaskonadate($staff, $date)
	{
		$this->load->model('staff/Tasks', 'task');
		return $this->task->getstaffalltasksonadate($staff, $date);
	}
	public function stafflist()
	{
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('staff_userlist();');
		$this->data['title']           = "Staff List";

		$this->load->template('user_list', $this->data, false);
	}

	public function ajaxstaff_userlist()
	{
		$this->load->model('staff/Staff_reporting_conn', 'reporting');
		$this->load->model('staff/Tasks', 'task');

		$list = $this->usersigin->get_datatablesstaff_reportingperson();
		$tabledata = array();
		$no = $this->input->post('start', true);
		$vt = 1;
		foreach ($list as $item) {
			$authid = $this->checksumgen($item->authenticationid);
			$checkReporting = $this->reporting->get_by(array('rp_staffid' => $item->authenticationid, 'rp_status' => '0'));

			//$rate=$this->task->show_staffrating($item->authenticationid);//currenty geting stati user

			$rateComment = $item->rating_option_title;
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = ucfirst(strtolower($item->au_emp_number));
			$row[] = ucfirst(strtolower($item->au_title . ' ' . $item->au_crickf));
			$row[] = ucfirst(strtolower($item->au_designation));
			$row[] = ucfirst(strtolower($item->rating_option_title));

			// $row[] = ($checkReporting) ? '<a href="javascript:;" data-item="' . $item->authenticationid . '" class="btn btn-edit viewReportingPerson btn-sm " "><i class="fa fa-eye"></i> Give Rating</a>' : '';
			//$row[] = '<a href="'.base_url().'staff/rating_staff/' . $item->authenticationid . '" class="btn btn-edit viewReportingPerson btn-sm " "><i class="fa fa-star-o"></i> '.$rateComment.'</a>';
			$row[] = '<a href="javascript:;" data-item="' . $item->authenticationid . '" class="btn btn-edit assignReportingPerson btn-sm " "></a>
          &nbsp;<a href="' . base_url() . 'admin/viewstaff/' . $item->authenticationid . '/' . $authid . '"  class="btn btn-view  btn-sm mt-2 " "><i class="fa fa-eye"></i> View</a>';

			$tabledata[] = $row;
			$vt++;
			/* ================================ */
		}

		$output = array(
			"draw" => $this->input->post('draw', true),
			"recordsTotal" => $this->usersigin->count_allstaff(),
			"recordsFiltered" => $this->usersigin->count_filteredstaff(),
			"data" => $tabledata,
		);

		echo json_encode($output);
	}
	public function rating_staff($id)
	{
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('task_rating(' . $id . ');');
		$this->data['title']           = "Rating";
		$this->data['uid'] = $id;
		$this->load->template('rating', $this->data, false);
	}
	public function ajax_get_staffrate()
	{

		$id = $this->input->post('id', true);
		$this->load->model('staff/Tasks', 'task');
		$list = $this->task->getstaffrating();
		$tabledata = array();
		$no = $this->input->post('start', true);
		$vt = 1;
		foreach ($list as $item) {
			$no++;
			$row = array();
			// $row[] = $no;
			// $row[] = ucfirst(strtolower($item->rating_date));
			// //$row[] = ucfirst(strtolower($item->rating_option_title));
			// $row[] = ucfirst(strtolower($item->comment));
			if ($this->session->userdata('usertype') != 1 && $this->session->userdata('authenticationid') != $this->input->post('id')) {


				$row[] = '<div class="d-flex flex-stack position-relative mt-6">
           <!--begin::Bar-->
           <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
           </div>
           <!--end::Bar-->
           <!--begin::Info-->
           <div class="fw-semibold ms-5">' . date('m-Y', strtotime($item->rating_date)) . '
               <!--begin::Time-->
               <div class="fs-7 mb-1">' . ucfirst(strtolower($item->rating_option_title)) . '
                   <span class="fs-7 text-muted text-uppercase"></span>
               </div>
               <!--end::Time-->
               <!--begin::Title-->
               <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">
                   </a>
               <!--end::Title-->
               <!--begin::User-->
               <div class="fs-7 text-muted">' . $item->comment . '
                   <a href="#"></a>
               </div>
               <!--end::User-->
           </div>
           <!--end::Info-->
           <!--begin::Action-->
          <!-- end::Action-->
       </div>';
			} else {

				$row[] = '<div class="d-flex flex-stack position-relative mt-6">
           <!--begin::Bar-->
           <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
           </div>
           <!--end::Bar-->
           <!--begin::Info-->
           <div class="fw-semibold ms-5">' . date('d-m-Y', strtotime($item->rating_date)) . '
               <!--begin::Time-->
               <div class="fs-7 mb-1">' . ucfirst(strtolower($item->rating_option_title)) . '
                   <span class="fs-7 text-muted text-uppercase"></span>
               </div>
               <!--end::Time-->
               <!--begin::Title-->
               <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">
                   </a>
               <!--end::Title-->
               <!--begin::User-->
               <div class="fs-7 text-muted">' . $item->comment . '
                   <a href="#"></a>
               </div>
               <!--end::User-->
           </div>
           <!--end::Info-->
           <!--begin::Action-->
 
           <!--end::Action-->
       </div>';
			}

			$tabledata[] = $row;
			$vt++;
			/* ================================ */
		}

		$output = array(
			"draw" => $this->input->post('draw', true),
			"recordsTotal" => $this->task->count_all_staff_rating(),
			"recordsFiltered" => $this->task->count_filteredstaff_rate(),
			"data" => $tabledata,
		);

		echo json_encode($output);
	}
	public function viewRatingPerson()
	{
		$this->load->model('staff/Tasks', 'task');
		$editid = $this->input->post('editid', true);
		$this->data['allratingoptions'] = $this->task->getallratingoptions();
		$category = $this->input->post('pagename');
		$this->data['staffid'] = $editid;
		if ($category) {
			$this->data['staffid'] = $editid;
			$this->data['modalname'] = $category;
			echo $this->load->view('commonmodal', $this->data, true);
		}
	}
	public function rating_submit()
	{
		$this->load->model('staff/Rating', 'rating');
		$rating_id = $this->input->post('rating_id', true);
		$staff_id = $this->input->post('editid', true);
		$reporting_staff_id = $this->session->userdata('authenticationid');
		$date = $this->input->post('rate_date', true);
		$comment = $this->input->post('comment', true);

		$check_rating = $this->rating->getstaffrating_count($staff_id, $reporting_staff_id, $date);
		if ($check_rating->ratingcnt == 0) {

			$rating_submit = array(
				'rating'  => $rating_id,
				'staff_id' => $staff_id,
				'reporting_staff_id' => $reporting_staff_id,
				'rating_date' => date('Y-m-d', strtotime($date)),
				'comment' => $comment,
			);

			//echo json_encode ($rating_submit);  exit();
			$this->load->model('staff/Tasks', 'task');
			$ratesubmit = $this->task->get_rating_sumbit($rating_submit);
			if ($ratesubmit) {
				$this->session->set_flashdata('successmessage', 'Rating Added successfully.');
				$result = array('status' => 'Yes', 'Message' => 'Changed Added successfully');
			} else {
				$this->session->set_flashdata('errormessage', 'Changes not found.');
				$result = array('status' => 'No', 'Message' => 'Changes not found.');
			}
		} else {

			$result = array('status' => 'No', 'Message' => 'Rating are already submitted.');
		}
		echo json_encode($result);
	}
	public function rating_edit()
	{
		$this->load->model('staff/Tasks', 'task');
		$editid = $this->input->post('editid', true);
		$this->data['editdata'] = $this->task->get_ratebyid($editid);
		$this->data['allratingoptions'] = $this->task->getallratingoptions();
		$category = $this->input->post('pagename');
		if ($category) {
			$this->data['modalname'] = $category;
			echo $this->load->view('commonmodal', $this->data, true);
		}
	}
	public function ratingedit_submit()
	{
		$rating = $this->input->post('editrating_id', true); //rating type
		$rating_id = $this->input->post('rating_id', true); //rating


		$staff_id = $this->input->post('editid', true);
		$reporting_staff_id = $this->session->userdata('authenticationid');
		$date_rate = $this->input->post('rate_date', true);
		//print_r($date_rate);
		$comment = $this->input->post('comment', true);

		$rating_submit = array(
			'rating'  => $rating,
			// 'rating_id' =>$rating_id,
			//'staff_id' =>$staff_id,
			// 'reporting_staff_id'=>$reporting_staff_id,
			'rating_date' => date('Y-m-d', strtotime($date_rate)),
			'comment' => $comment,
		);

		//echo json_encode ($rating_submit);  exit();
		$this->load->model('staff/Rating', 'rating');
		$ratesubmit = $this->rating->update_status_by(['rating_id' => $rating_id], $rating_submit);
		if ($ratesubmit) {
			$this->session->set_flashdata('successmessage', 'Rating changed successfully.');
			$result = array('status' => 'Yes', 'Message' => 'Changed Added successfully');
		} else {
			$this->session->set_flashdata('errormessage', 'Changes not found.');
			$result = array('status' => 'No', 'Message' => 'Changes not found.');
		}
		echo json_encode($result);
	}
	
	public function getlogindata(){


 $data = array();

  foreach($_GET['ddd'] as $dates)
   {
        
        $staff_id = $this->session->userdata('authenticationid');
		
		
        $day = date('d',strtotime($dates));
        $month = date('m',strtotime($dates));
        $year = date('Y',strtotime($dates));

$sql = $this->db->query("SELECT DISTINCT ut_total_time AS joins  from ah_usertime where MONTH(ut_login_time) = $month AND DAY(ut_login_time) = $day  AND  YEAR(ut_login_time) = $year AND ut_staff_id = $staff_id limit 1");
        $userlogin = $sql->result();
         $row_array['date'] = $month.'-'.$day;
		 if(isset($userlogin[0]->joins)){
           $dat =str_replace(":",".", $userlogin[0]->joins);
			$row_array['value'] = substr($dat, 0, strrpos($dat, "."));
			
			
		 }else{
			 $row_array['value'] = '00:00';
		 }
      array_push($data, $row_array);
        

    }

   echo json_encode($data);



}

public function getusersdata(){

     
	 $this->load->model('staff/Tasks', 'task');
		$this->data['totaltask'] = $this->task->count_all();
	 
      $pending = $this->task->count_all_task('1');
      $finished = $this->task->count_all_task('2');
      $rejected = $this->task->count_all_task('3');
      //print_r($expiredusers);exit();


echo json_encode(array('result1'=>$pending,'result2'=>$completed,'result3'=>$rejected));
}
}
