<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
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
		$this->load->template('dashboard', $this->data, false);
	}

	public function taskcategory()
	{
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('taskCategory();');
		$this->data['title']           = "Task Category";
		$this->load->template('taskcategory', $this->data, false);
	}

	public function ajaxtaskcategorylist()
	{
		$this->load->model('admin/Task_category', 'category');
		$list = $this->category->get_datatables();
		$tabledata = array();
		$no = $this->input->post('start', true);
		$vt = 1;
		foreach ($list as $item) {
			$authid = $this->checksumgen($item->task_categoryid);
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = ucfirst(strtolower($item->tc_name));
			$row[] = ($item->tc_status == "0") ? 'Active' : 'In-Active';
			// $row[] = date('d-m-Y H:i a', strtotime($item->tc_addedon));
			$statusText = ($item->tc_status == "0") ? array('Delete', 'btn btn-delete btn-sm', 'fa-times-circle') : array('Enable', 'btn btn-light-success btn-sm', 'fa-check');

			$row[] = '
            <a href="javascript:;" data-item="' . $item->task_categoryid . '" class="btn btn-edit categoryEdit btn-sm " "><i class="fa fa-edit"></i> Edit</a>&nbsp;
            <a href="javascript:;" data-itemid="' . $item->task_categoryid . '"  class="' . $statusText[1] . '  deleteCategory"><i class="fas ' . $statusText[2] . '"></i> ' . $statusText[0] . '</a>';

			$tabledata[] = $row;
			$vt++;
			/* ================================ */
		}

		$output = array(
			"draw" => $this->input->post('draw', true),
			"recordsTotal" => $this->category->count_all(),
			"recordsFiltered" => $this->category->count_filtered(),
			"data" => $tabledata,
		);

		echo json_encode($output);
	}

	public function addTaskCategory()
	{
		$pagename = $this->input->post('pagename');
		if ($pagename) {
			$this->data['modalname'] = $pagename;
			echo $this->load->view('commonmodal', $this->data, true);
		}
	}


	public function categorySubmitProcess()
	{
		$this->load->model('admin/Task_category', 'category');
		$category_name = $this->input->post('category_name', true);
		$editid = $this->input->post('editid', true);

		$validation = array('name' => $category_name);
		if ($this->category->validate($validation, 'formvalid')) {
			$curdate = date('Y-m-d H:i:s');
			if ($editid == "") {
				$catCheck = $this->category->get_by(array('tc_name' => $category_name, 'tc_status' => '0'));
				if (!$catCheck) {
					$areaTypeInserted = $this->category->insert(array(
						'tc_name' => $category_name,
						'tc_status' => '0',
						'tc_addedby' => $this->loggeduserid,
						'tc_addedon' => $curdate,

					), true);
					if ($areaTypeInserted) {
						$this->session->set_flashdata('successmessage', 'Category  added successfully.');
						$result = array('status' => 'Yes', 'Message' => 'Category added successfully');
					} else {
						$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
						$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
					}
				} else {
					$this->session->set_flashdata('errormessage', 'Category already exists.');
					$result = array('status' => 'No', 'Message' => 'Category already exists.');
				}
			} else {
				$catCheck = $this->category->get_by(array('task_categoryid !=' => $editid, 'tc_name' => $category_name, 'tc_status' => '0'));
				if (!$catCheck) {
					$areaTypeInserted = $this->category->update_status_by(array('task_categoryid' => $editid), array(
						'tc_name' => $category_name,
						'tc_addedby' => $this->loggeduserid

					));

					if ($areaTypeInserted) {
						$this->session->set_flashdata('successmessage', 'Category  updated successfully.');
						$result = array('status' => 'Yes', 'Message' => 'Category updated successfully');
					} else {
						$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
						$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
					}
				} else {
					$this->session->set_flashdata('errormessage', 'Category already exists.');
					$result = array('status' => 'No', 'Message' => 'Category already exists.');
				}
			}
		} else {
			$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
			$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
		}

		echo json_encode($result);
	}

	public function deleteCategory($item)
	{
		$this->load->model('admin/Subcategory', 'subcategory');
		$this->load->model('admin/Task_category', 'category');
		$this->load->model('staff/Tasks', 'task');
		$getitem = $this->category->get_by(array('task_categoryid' => $item));

		if ($getitem) {
			$checkTask = $this->task->get_by(array('task_category' => $item, 'task_active' => 0));
			if (!$checkTask) {
				$checkSubCat = $this->subcategory->get_by(array('sc_categoryid' => $item, 'sc_status' => 0));
				if (!$checkSubCat) {
					$status = ($getitem->tc_status == "0") ? '1' : '0';
					$statusText = ($getitem->tc_status == "0") ? 'Deleted' : 'Enabled';
					$deleted = $this->category->update_status_by(array('task_categoryid' => $item), array('tc_status' => $status));

					if ($deleted) {
						$this->session->set_flashdata('successmessage', 'Caregory ' . $statusText . ' successfully.');
						echo "true";
					} else {
						$this->session->set_flashdata('errormessage', 'Error occurred ,Please try again.');
						echo "false";
					}
				} else {
					$this->session->set_flashdata('errormessage', 'You can not delete as this Category is in use.');
					echo "false";
				}
			} else {
				$this->session->set_flashdata('errormessage', 'You can not delete as this Category is in use.');
				echo "false";
			}
		} else {
			$this->session->set_flashdata('errormessage', 'Error occurred ,Please try again.');
			echo "false";
		}
	}

	public function categoryEdit()
	{
		$this->load->model('admin/Task_category', 'category');
		$editid = $this->input->post('editid', true);
		$this->data['editdata'] = $this->category->get_by(array('task_categoryid' => $editid));
		$category = $this->input->post('pagename');
		if ($category) {
			$this->data['modalname'] = $category;
			echo $this->load->view('commonmodal', $this->data, true);
		}
	}
	public function tasksubcategory()
	{
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('taskSubcategory();');
		$this->data['title']           = "Task Sub Category";
		$this->load->template('tasksubcategory', $this->data, false);
	}

	public function ajaxtasksubcategorylist()
	{
		$this->load->model('admin/Subcategory', 'subcategory');
		$list = $this->subcategory->get_datatables();
		$tabledata = array();
		$no = $this->input->post('start', true);
		$vt = 1;
		foreach ($list as $item) {
			$authid = $this->checksumgen($item->subcategoryid);
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = ucfirst(strtolower($item->sc_name));
			$row[] = ucfirst(strtolower($item->tc_name));
			$row[] = ($item->sc_status == "0") ? 'Active' : 'In-Active';
			// $row[] = date('d-m-Y H:i a', strtotime($item->sc_addedon));
			$statusText = ($item->sc_status == "0") ? array('Delete', 'btn btn-delete btn-sm', 'fa-times-circle') : array('Enable', 'btn btn-light-success btn-sm', 'fa-check');

			$row[] = '
            <a href="javascript:;" data-item="' . $item->subcategoryid . '" class="btn btn-edit subCategoryEdit btn-sm " "><i class="fa fa-edit"></i> Edit</a>&nbsp;
            <a href="javascript:;" data-itemid="' . $item->subcategoryid . '"  class="' . $statusText[1] . '  deleteSubCategory"><i class="fas ' . $statusText[2] . '"></i> ' . $statusText[0] . '</a>';

			$tabledata[] = $row;
			$vt++;
			/* ================================ */
		}

		$output = array(
			"draw" => $this->input->post('draw', true),
			"recordsTotal" => $this->subcategory->count_all(),
			"recordsFiltered" => $this->subcategory->count_filtered(),
			"data" => $tabledata,
		);

		echo json_encode($output);
	}

	public function addTaskSubCategory()
	{
		$this->load->model('admin/Task_category', 'category');
		$this->data['category'] = $this->category->get_many_by(array('tc_status' => 0));
		$pagename = $this->input->post('pagename');
		if ($pagename) {
			$this->data['modalname'] = $pagename;
			echo $this->load->view('commonmodal', $this->data, true);
		}
	}

	public function subCategorySubmitProcess()
	{
		$this->load->model('admin/Subcategory', 'subcategory');
		$category = $this->input->post('category', true);
		$sub_category_name = $this->input->post('sub_category_name', true);
		$editid = $this->input->post('editid', true);

		$validation = array('name' => $sub_category_name);
		if ($this->subcategory->validate($validation, 'formvalid')) {
			$curdate = date('Y-m-d H:i:s');
			if ($editid == "") {
				$checkSubCat = $this->subcategory->get_by(array('sc_name' => $sub_category_name, 'sc_status' => '0', 'sc_categoryid' => $category));
				if (!$checkSubCat) {
					$areaTypeInserted = $this->subcategory->insert(array(
						'sc_categoryid' => $category,
						'sc_name' => $sub_category_name,
						'sc_status' => '0',
						'sc_addedby' => $this->loggeduserid,
						'sc_addedon' => $curdate,

					), true);
					if ($areaTypeInserted) {
						$this->session->set_flashdata('successmessage', 'Category  added successfully.');
						$result = array('status' => 'Yes', 'Message' => 'Category added successfully');
					} else {
						$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
						$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
					}
				} else {
					$this->session->set_flashdata('errormessage', 'Sub category already exists.');
					$result = array('status' => 'No', 'Message' => 'Sub category already exists.');
				}
			} else {
				$checkSubCat = $this->subcategory->get_by(array('subcategoryid !=' => $editid, 'sc_name' => $sub_category_name, 'sc_status' => '0', 'sc_categoryid' => $category));
				if (!$checkSubCat) {
					$areaTypeInserted = $this->subcategory->update_status_by(array('subcategoryid' => $editid), array(
						'sc_name' => $sub_category_name,
						'sc_categoryid' => $category,
						'sc_addedby' => $this->loggeduserid

					));

					if ($areaTypeInserted) {
						$this->session->set_flashdata('successmessage', 'Category  updated successfully.');
						$result = array('status' => 'Yes', 'Message' => 'Category updated successfully');
					} else {
						$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
						$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
					}
				} else {
					$this->session->set_flashdata('errormessage', 'Sub category already exists.');
					$result = array('status' => 'No', 'Message' => 'Sub category already exists.');
				}
			}
		} else {
			$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
			$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
		}

		echo json_encode($result);
	}
	public function subCategoryEdit()
	{
		$this->load->model('admin/Task_category', 'category');
		$this->load->model('admin/Subcategory', 'subcategory');
		$editid = $this->input->post('editid', true);
		$this->data['editdata'] = $this->subcategory->get_by(array('subcategoryid' => $editid));
		$this->data['category'] = $this->category->get_many_by(array('task_categoryid' => $this->data['editdata']->sc_categoryid));
		$category = $this->input->post('pagename');
		if ($category) {
			$this->data['modalname'] = $category;
			echo $this->load->view('commonmodal', $this->data, true);
		}
	}

	public function deleteSubCategory($item)
	{
		$this->load->model('staff/Tasks', 'task');
		$this->load->model('admin/Subcategory', 'subcategory');
		$getitem = $this->subcategory->get_by(array('subcategoryid' => $item));
		if ($getitem) {
			$checkTask = $this->task->get_by(array('task_subcategory' => $item, 'task_active' => 0));
			if (!$checkTask) {
				$status = ($getitem->sc_status == "0") ? '1' : '0';
				$statusText = ($getitem->sc_status == "0") ? 'Deleted' : 'Enabled';
				$deleted = $this->subcategory->update_status_by(array('subcategoryid' => $item), array('sc_status' => $status));

				if ($deleted) {
					$this->session->set_flashdata('successmessage', 'Sub Caregory ' . $statusText . ' successfully.');
					echo "true";
				} else {
					$this->session->set_flashdata('errormessage', 'Error occurred ,Please try again.');
					echo "false";
				}
			} else {
				$this->session->set_flashdata('errormessage', 'You can not delete as this Sub Category is in use.');
				echo "false";
			}
		} else {
			$this->session->set_flashdata('errormessage', 'Error occurred ,Please try again.');
			echo "false";
		}
	}

	public function staff()
	{
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('userList();');
		$this->data['title']           = "Staff List";

		$this->load->template('users/user_list', $this->data, false);
	}


	public function roles()
	{
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('taskCategory();');
		$this->data['title']           = "View User";

		$this->load->template('users/roles', $this->data, false);
	}
	public function view_roles()
	{
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('taskCategory();');
		$this->data['title']           = "View Roles";

		$this->load->template('users/view_roles', $this->data, false);
	}
	public function manage_tasks()
	{
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('admintasks();');
		$this->data['title']           = "Tasks";

		$this->load->template('manage_tasks/tasks', $this->data, false);
	}

	public function ajaxstafftaskslist()
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
			$row[] = '
            <a href="' . base_url() . 'admin/viewassignedlist/' . $item->taskid . '/' . $authid . '"  class="btn btn-view mt-2  btn-sm " "><i class="fa fa-eye"></i> View</a>&nbsp;
           ';
			$row[] = ucfirst(strtolower($item->tc_name)) . '-' . ucfirst(strtolower($item->sc_name));
			//$row[] = ;
			switch ($item->tc_status == "0") {
				case '0':
					$status = "Active";
					break;
				case '1':
					$status = "Pending";
					break;
				case '2':
					$status = "Completed";
					break;
			}
			// $row[] = $status;
			$row[] = ucfirst(strtolower($item->task_priority));
			$row[] = ucfirst(strtolower($item->task_completed_percentage));
			//  $row[] = ucfirst(strtolower(word_limiter($item->task_details, 100)));
			$statusText = ($item->tc_status == "0") ? array('Delete', 'btn btn-light-danger btn-sm', 'fa-times-circle') : array('Enable', 'btn btn-light-success btn-sm', 'fa-check');
			$deleteOption = "";
			if ($item->task_staffid == $this->loggeduserid) {
				$deleteOption = '<a href="javascript:;" data-itemid="' . $item->taskid . '"  class="' . $statusText[1] . '  deleteTaskDetails"><i class="fas ' . $statusText[2] . '"></i> ' . $statusText[0] . '</a>';
			}
			$row[] = '
            <a href="' . base_url() . 'admin/edittask/' . $item->taskid . '/' . $authid . '"  class="btn btn-edit  btn-sm " "><i class="fa fa-edit"></i> Edit</a>&nbsp;
            <a href="' . base_url() . 'staff/viewtask/' . $item->taskid . '/' . $authid . '"  class="btn btn-view mt-2  btn-sm " "><i class="fa fa-eye"></i> View</a>&nbsp;
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


	public function departments()
	{
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('taskDepartments();');
		$this->data['title']           = "Departments";
		$this->load->template('departments', $this->data, false);
	}

	public function ajaxdepartmentlist()
	{
		$this->load->model('admin/Departments', 'department');
		$list = $this->department->get_datatables();
		$tabledata = array();
		$no = $this->input->post('start', true);
		$vt = 1;
		foreach ($list as $item) {
			$authid = $this->checksumgen($item->departmentid);
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = ucfirst(strtolower($item->dp_name));
			$row[] = ($item->dp_status == "0") ? 'Active' : 'In-Active';
			// $row[] = date('d-m-Y H:i a', strtotime($item->dp_addedon));
			$statusText = ($item->dp_status == "0") ? array('Delete', 'btn btn-delete btn-sm', 'fa-times-circle') : array('Enable', 'btn btn-light-success btn-sm', 'fa-check');

			$row[] = '
            <a href="javascript:;" data-item="' . $item->departmentid . '" class="btn btn-edit departmentEdit btn-sm " "><i class="fa fa-edit"></i> Edit</a>&nbsp;
            <a href="javascript:;" data-itemid="' . $item->departmentid . '"  class="' . $statusText[1] . '  deleteDepartment"><i class="fas ' . $statusText[2] . '"></i> ' . $statusText[0] . '</a>';

			$tabledata[] = $row;
			$vt++;
			/* ================================ */
		}

		$output = array(
			"draw" => $this->input->post('draw', true),
			"recordsTotal" => $this->department->count_all(),
			"recordsFiltered" => $this->department->count_filtered(),
			"data" => $tabledata,
		);

		echo json_encode($output);
	}
	public function addTaskDepartments()
	{
		$pagename = $this->input->post('pagename');
		if ($pagename) {
			$this->data['modalname'] = $pagename;
			echo $this->load->view('commonmodal', $this->data, true);
		}
	}
	public function departmentSubmitProcess()
	{
		$this->load->model('admin/Departments', 'department');
		$department_name = $this->input->post('department_name', true);
		$editid = $this->input->post('editid', true);

		$validation = array('name' => $department_name);
		if ($this->department->validate($validation, 'formvalid')) {
			$curdate = date('Y-m-d H:i:s');
			if ($editid == "") {
				$checkDepartment = $this->department->get_by(array('dp_name' => $department_name, 'dp_status' => '0'));
				if (!$checkDepartment) {
					$areaTypeInserted = $this->department->insert(array(
						'dp_name' => $department_name,
						'dp_status' => '0',
						'dp_addedby' => $this->loggeduserid,
						'dp_addedon' => $curdate,

					), true);
					if ($areaTypeInserted) {
						$this->session->set_flashdata('successmessage', 'Department  added successfully.');
						$result = array('status' => 'Yes', 'Message' => 'Department added successfully');
					} else {
						$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
						$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
					}
				} else {
					$this->session->set_flashdata('errormessage', 'Department already exists');
					$result = array('status' => 'No', 'Message' => 'Department already exists');
				}
			} else {
				$checkDepartment = $this->department->get_by(array('departmentid !=' => $editid, 'dp_name' => $department_name, 'dp_status' => '0'));
				if (!$checkDepartment) {
					$areaTypeInserted = $this->department->update_status_by(array('departmentid' => $editid), array(
						'dp_name' => $department_name,
						'dp_addedby' => $this->loggeduserid

					));

					if ($areaTypeInserted) {
						$this->session->set_flashdata('successmessage', 'Department  updated successfully.');
						$result = array('status' => 'Yes', 'Message' => 'Department updated successfully');
					} else {
						$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
						$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
					}
				} else {
					$this->session->set_flashdata('errormessage', 'Department already exists');
					$result = array('status' => 'No', 'Message' => 'Department already exists');
				}
			}
		} else {
			$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
			$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
		}

		echo json_encode($result);
	}

	public function deleteDepartment($item)
	{
		$this->load->model('admin/Departments', 'department');
		$getitem = $this->department->get_by(array('departmentid' => $item));
		if ($getitem != "") {
			if ($getitem) {
				$checkDepartment = $this->usersigin->get_by(array('au_deptarment' => $getitem->dp_name));
				if (!$checkDepartment) {
					$status = ($getitem->dp_status == "0") ? '1' : '0';
					$statusText = ($getitem->dp_status == "0") ? 'Deleted' : 'Enabled';
					$deleted = $this->department->update_status_by(array('departmentid' => $item), array('dp_status' => $status));

					if ($deleted) {
						$this->session->set_flashdata('successmessage', 'Department ' . $statusText . ' successfully.');
						echo "true";
					} else {
						$this->session->set_flashdata('errormessage', 'Error occurred ,Please try again.');
						echo "false";
					}
				} else {
					$this->session->set_flashdata('errormessage', 'Staff assigned to this department');
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

	public function departmentEdit()
	{
		$this->load->model('admin/Departments', 'department');
		$editid = $this->input->post('editid', true);
		$this->data['editdata'] = $this->department->get_by(array('departmentid' => $editid));
		$category = $this->input->post('pagename');
		if ($category) {
			$this->data['modalname'] = $category;
			echo $this->load->view('commonmodal', $this->data, true);
		}
	}
	public function campus()
	{
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('taskCampus();');
		$this->data['title']           = "Campus";
		$this->load->template('campus', $this->data, false);
	}


	public function ajaxcampuslist()
	{
		$this->load->model('admin/Campus', 'campus');
		$list = $this->campus->get_datatables();
		$tabledata = array();
		$no = $this->input->post('start', true);
		$vt = 1;
		foreach ($list as $item) {
			$authid = $this->checksumgen($item->campus_id);
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = ucfirst(strtolower($item->campus_name));
			$row[] = ($item->cp_status == "0") ? 'Active' : 'In-Active';
			// $row[] = date('d-m-Y H:i a', strtotime($item->cp_addedon));
			$statusText = ($item->cp_status == "0") ? array('Delete', 'btn btn-delete btn-sm', 'fa-times-circle') : array('Enable', 'btn btn-light-success btn-sm', 'fa-check');

			$row[] = '
            <a href="javascript:;" data-item="' . $item->campus_id . '" class="btn btn-edit campusEdit btn-sm " "><i class="fa fa-edit"></i> Edit</a>&nbsp;
            <a href="javascript:;" data-itemid="' . $item->campus_id . '"  class="' . $statusText[1] . '  deleteCampus"><i class="fas ' . $statusText[2] . '"></i> ' . $statusText[0] . '</a>';

			$tabledata[] = $row;
			$vt++;
			/* ================================ */
		}

		$output = array(
			"draw" => $this->input->post('draw', true),
			"recordsTotal" => $this->campus->count_all(),
			"recordsFiltered" => $this->campus->count_filtered(),
			"data" => $tabledata,
		);

		echo json_encode($output);
	}

	public function addTaskCampus()
	{
		$pagename = $this->input->post('pagename');
		if ($pagename) {
			$this->data['modalname'] = $pagename;
			echo $this->load->view('commonmodal', $this->data, true);
		}
	}

	public function campusSubmitProcess()
	{
		$this->load->model('admin/Campus', 'campus');
		$campus_name = $this->input->post('campus_name', true);
		$editid = $this->input->post('editid', true);

		$validation = array('name' => $campus_name);
		if ($this->campus->validate($validation, 'formvalid')) {
			$curdate = date('Y-m-d H:i:s');
			if ($editid == "") {
				$checkSchool = $this->campus->get_by(array('campus_name' => $campus_name, 'cp_status' => '0'));
				if (!$checkSchool) {
					$areaTypeInserted = $this->campus->insert(array(
						'campus_name' => $campus_name,
						'cp_status' => '0',
						'cp_addedby' => $this->loggeduserid,
						'cp_addedon' => $curdate,

					), true);
					if ($areaTypeInserted) {
						$this->session->set_flashdata('successmessage', 'School  added successfully.');
						$result = array('status' => 'Yes', 'Message' => 'School added successfully');
					} else {
						$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
						$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
					}
				} else {
					$this->session->set_flashdata('errormessage', 'School already exists.');
					$result = array('status' => 'No', 'Message' => 'School already exists.');
				}
			} else {
				$checkSchool = $this->campus->get_by(array('campus_id !=' => $editid, 'campus_name' => $campus_name, 'cp_status' => '0'));
				if (!$checkSchool) {
					$areaTypeInserted = $this->campus->update_status_by(array('campus_id' => $editid), array(
						'campus_name' => $campus_name,
						'cp_addedby' => $this->loggeduserid

					));

					if ($areaTypeInserted) {
						$this->session->set_flashdata('successmessage', 'School  updated successfully.');
						$result = array('status' => 'Yes', 'Message' => 'School updated successfully');
					} else {
						$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
						$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
					}
				} else {
					$this->session->set_flashdata('errormessage', 'School already exists.');
					$result = array('status' => 'No', 'Message' => 'School already exists.');
				}
			}
		} else {
			$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
			$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
		}

		echo json_encode($result);
	}


	public function deleteCampus($item)
	{
		$this->load->model('admin/Campus', 'campus');
		$getitem = $this->campus->get_by(array('campus_id' => $item));
		if ($getitem != "") {
			if ($getitem) {
				$status = ($getitem->cp_status == "0") ? '1' : '0';
				$statusText = ($getitem->cp_status == "0") ? 'Deleted' : 'Enabled';
				$deleted = $this->campus->update_status_by(array('campus_id' => $item), array('cp_status' => $status));

				if ($deleted) {
					$this->session->set_flashdata('successmessage', 'Campus ' . $statusText . ' successfully.');
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

	public function campusEdit()
	{
		$this->load->model('admin/Campus', 'campus');
		$editid = $this->input->post('editid', true);
		$this->data['editdata'] = $this->campus->get_by(array('campus_id' => $editid));
		$category = $this->input->post('pagename');
		if ($category) {
			$this->data['modalname'] = $category;
			echo $this->load->view('commonmodal', $this->data, true);
		}
	}



	public function program()
	{
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('taskProgram();');
		$this->data['title']           = "Program";
		$this->load->template('program', $this->data, false);
	}



	public function ajaxprogramlist()
	{
		$this->load->model('admin/Program', 'program');
		$list = $this->program->get_datatables();
		$tabledata = array();
		$no = $this->input->post('start', true);
		$vt = 1;
		foreach ($list as $item) {
			$authid = $this->checksumgen($item->programmeid);
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = ucfirst(strtolower($item->pg_name));
			$row[] = ($item->pg_status == "0") ? 'Active' : 'In-Active';
			// $row[] = date('d-m-Y H:i a', strtotime($item->pg_addedon));
			$statusText = ($item->pg_status == "0") ? array('Delete', 'btn btn-delete btn-sm', 'fa-times-circle') : array('Enable', 'btn btn-light-success btn-sm', 'fa-check');

			$row[] = '
            <a href="javascript:;" data-item="' . $item->programmeid . '" class="btn btn-edit programEdit btn-sm " "><i class="fa fa-edit"></i> Edit</a>&nbsp;
            <a href="javascript:;" data-itemid="' . $item->programmeid . '"  class="' . $statusText[1] . '  deleteProgram"><i class="fas ' . $statusText[2] . '"></i> ' . $statusText[0] . '</a>';

			$tabledata[] = $row;
			$vt++;
			/* ================================ */
		}

		$output = array(
			"draw" => $this->input->post('draw', true),
			"recordsTotal" => $this->program->count_all(),
			"recordsFiltered" => $this->program->count_filtered(),
			"data" => $tabledata,
		);

		echo json_encode($output);
	}


	public function addTaskProgram()
	{
		$pagename = $this->input->post('pagename');
		if ($pagename) {
			$this->data['modalname'] = $pagename;
			echo $this->load->view('commonmodal', $this->data, true);
		}
	}


	public function programSubmitProcess()
	{
		$this->load->model('admin/Program', 'program');
		$pogram_name = $this->input->post('pogram_name', true);
		$editid = $this->input->post('editid', true);

		$validation = array('name' => $pogram_name);
		if ($this->program->validate($validation, 'formvalid')) {
			$curdate = date('Y-m-d H:i:s');
			if ($editid == "") {
				$checkProgram = $this->program->get_by(array('pg_name' => $pogram_name, 'pg_status' => '0'));
				if (!$checkProgram) {
					$areaTypeInserted = $this->program->insert(array(
						'pg_name' => $pogram_name,
						'pg_status' => '0',
						'pg_addedby' => $this->loggeduserid,
						'pg_addedon' => $curdate,

					), true);
					if ($areaTypeInserted) {
						$this->session->set_flashdata('successmessage', 'Program  added successfully.');
						$result = array('status' => 'Yes', 'Message' => 'Program added successfully');
					} else {
						$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
						$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
					}
				} else {
					$this->session->set_flashdata('errormessage', 'Program already exists');
					$result = array('status' => 'No', 'Message' => 'Program already exists');
				}
			} else {
				$checkProgram = $this->program->get_by(array('programmeid !=' => $editid, 'pg_name' => $pogram_name, 'pg_status' => '0'));
				if (!$checkProgram) {
					$areaTypeInserted = $this->program->update_status_by(array('programmeid' => $editid), array(
						'pg_name' => $pogram_name,
						'pg_addedby' => $this->loggeduserid

					));

					if ($areaTypeInserted) {
						$this->session->set_flashdata('successmessage', 'Program  updated successfully.');
						$result = array('status' => 'Yes', 'Message' => 'Program updated successfully');
					} else {
						$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
						$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
					}
				} else {
					$this->session->set_flashdata('errormessage', 'Program already exists');
					$result = array('status' => 'No', 'Message' => 'Program already exists');
				}
			}
		} else {
			$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
			$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
		}

		echo json_encode($result);
	}
	public function programEdit()
	{
		$this->load->model('admin/Program', 'program');
		$editid = $this->input->post('editid', true);
		$this->data['editdata'] = $this->program->get_by(array('programmeid' => $editid));
		$category = $this->input->post('pagename');
		if ($category) {
			$this->data['modalname'] = $category;
			echo $this->load->view('commonmodal', $this->data, true);
		}
	}

	public function deleteProgram($item)
	{
		$this->load->model('admin/Program', 'program');
		$getitem = $this->program->get_by(array('programmeid' => $item));
		if ($getitem != "") {
			if ($getitem) {
				$status = ($getitem->pg_status == "0") ? '1' : '0';
				$statusText = ($getitem->pg_status == "0") ? 'Deleted' : 'Enabled';
				$deleted = $this->program->update_status_by(array('programmeid' => $item), array('pg_status' => $status));

				if ($deleted) {
					$this->session->set_flashdata('successmessage', 'Program ' . $statusText . ' successfully.');
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


	public function apicall()
	{
		$client = new \GuzzleHttp\Client();
		$res = $client->request('GET', 'https://jsonplaceholder.typicode.com/todos/1');
		echo $res->getStatusCode();
		// "200"
		echo $res->getHeader('content-type')[0];
		// 'application/json; charset=utf8'
		echo $res->getBody();
		// {"type":"User"...'
	}



	public function ajaxstafflist()
	{
		$this->load->model('admin/Staff_reporting_conn', 'reporting');
		$list = $this->usersigin->get_datatables();
		$tabledata = array();
		$no = $this->input->post('start', true);
		$vt = 1;
		foreach ($list as $item) {
			$authid = $this->checksumgen($item->authenticationid);
			$checkReporting = $this->reporting->get_by(array('rp_staffid' => $item->authenticationid, 'rp_status' => '0'));
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = ucfirst(strtolower($item->au_emp_number));
			$row[] = ucfirst(strtolower($item->au_title) . ' ' .  ucfirst($item->au_crickf));
			$row[] = ucfirst(strtolower($item->au_designation));
			$row[] = ($checkReporting) ? '<a href="javascript:;" data-item="' . $item->authenticationid . '" class="btn btn-edit viewReportingPerson btn-sm " "><i class="fa fa-eye"></i> View</a>' : '';
			$row[] = '<a href="javascript:;" data-item="' . $item->authenticationid . '" class="btn btn-edit assignReportingPerson btn-sm " "><i class="fa fa-plus"></i> Assign</a>
            &nbsp;<a href="' . base_url() . 'admin/editstaff/' . $item->authenticationid . '/' . $authid . '"  class="btn btn-edit  btn-sm mt-2 " "><i class="fa fa-edit"></i> Edit</a>
            &nbsp;<a href="' . base_url() . 'admin/viewstaff/' . $item->authenticationid . '/' . $authid . '"  class="btn btn-view  btn-sm mt-2 " "><i class="fa fa-eye"></i> View</a>';

			$tabledata[] = $row;
			$vt++;
			/* ================================ */
		}

		$output = array(
			"draw" => $this->input->post('draw', true),
			"recordsTotal" => $this->usersigin->count_all(),
			"recordsFiltered" => $this->usersigin->count_filtered(),
			"data" => $tabledata,
		);

        echo json_encode($output);
    }
    

	public function synStaffData()
	{
		$client = new \GuzzleHttp\Client();
		$res = $client->request('GET', 'https://jsonplaceholder.typicode.com/todos/1');
		if ($res->getStatusCode() == 200) {
			$staffList = json_decode($res->getBody());

			if ($staffList) {
				$newsStaffArray = [];
				$updateStaffArray = [];


				foreach ($staffList as $staff) {
					$checkStaffExists = $this->usersigin->getuserdetails(array('AES_DECRYPT(au_crickus,"' . EncriptKey . '")' => $staff->employee_no));
					if ($checkStaffExists) {
						$updateStaffArray[] = array(
							'id' => $checkStaffExists->authenticationid,
							'au_crickus' => $staff->employee_no,
							'au_crickf' => $staff->name,
							'au_cricke' => $staff->email,
							'au_title' => $staff->name_title,
							'au_emp_number' => $staff->employee_no,
							'au_gender' => $staff->gender,
							'au_deptarment' => $staff->dept_name,
							'au_school' => $staff->school_name,
							'au_campus' => $staff->campus_name,
							'au_status' => '0',
							'au_createdby' => $this->loggeduserid,
							'au_designation' => $staff->designation_id,
						);
					} else {
						switch ($staff->type) {
							case 'Teaching':
								$userType = '2';
								// no break
							case 'Non Teaching':
								$userType = '3';
								break;
						}

						$newsStaffArray[] = array(
							'au_crickus' => $staff->employee_no,
							'au_crickf' => $staff->name,
							'au_cricke' => $staff->email,
							'au_usertype' => $userType,
							'au_title' => $staff->name_title,
							'au_emp_number' => $staff->employee_no,
							'au_gender' => $staff->gender,
							'au_deptarment' => $staff->dept_name,
							'au_school' => $staff->school_name,
							'au_campus' => $staff->campus_name,
							'au_status' => '0',
							'au_createdby' => $this->loggeduserid,
							'au_designation' => $staff->designation_id,
						);
					}
				}



				if (count($newsStaffArray) > 0) {
					foreach ($newsStaffArray as $staff) {
						$encrypted = array(
							'au_crickus' => $staff['au_crickus'],
							'au_crickf' => $staff['au_crickf'],
							'au_cricke' => $staff['au_cricke']
						);

						$nonEncrypted = array(
							'au_usertype' => $staff['au_usertype'],
							'au_title' => $staff['au_title'],
							'au_emp_number' => $staff['au_emp_number'],
							'au_gender' => $staff['au_gender'],
							'au_deptarment' => $staff['au_deptarment'],
							'au_school' => $staff['au_school'],
							'au_campus' => $staff['au_campus'],
							'au_status' => '0',
							'au_createdby' => $this->loggeduserid,
							'au_designation' => $staff['au_designation'],
						);

						$this->usersigin->inserttoauthenticationtable($encrypted, $nonEncrypted);
					}
				}


				if (count($updateStaffArray) > 0) {
					foreach ($updateStaffArray as $staff) {
						$encrypted = array(
							'au_crickf' => $staff['au_crickf'],
							'au_cricke' => $staff['au_cricke']
						);

						$nonEncrypted = array(
							'au_title' => $staff['au_title'],
							'au_emp_number' => $staff['au_emp_number'],
							'au_gender' => $staff['au_gender'],
							'au_deptarment' => $staff['au_deptarment'],
							'au_school' => $staff['au_school'],
							'au_campus' => $staff['au_campus'],
							'au_createdby' => $this->loggeduserid,
							'au_designation' => $staff['au_designation'],
						);

						$this->usersigin->updateauthenticationtable(array('authenticationid' => $staff['id']), $encrypted, $nonEncrypted);
					}
				}
				$result = array('status' => 'Yes', 'Message' => 'Staff list synced successfully');
			} else {
				$result = array('status' => 'No', 'Message' => 'Failed to sync staff list');
			}
		} else {
			$result = array('status' => 'No', 'Message' => 'Failed to sync staff list');
		}
		echo json_encode($result);
	}

	public function assignReportingPerson()
	{
		$this->load->model('admin/Program', 'program');
		$editid = $this->input->post('editid', true);
		$this->data['allusers'] = $this->usersigin->getallusersforreporting(array('	au_usertype !=' => 1, 'au_status' => '0', 'authenticationid !=' => $editid), $editid);
		$category = $this->input->post('pagename');
		if ($category) {
			$this->data['staffid'] = $editid;
			$this->data['modalname'] = $category;
			echo $this->load->view('commonmodal', $this->data, true);
		}
	}


	public function reportingPersonSubmitProcess()
	{
		$this->load->model('admin/Staff_reporting_conn', 'reporting');
		$reportingperson = $this->input->post('reportingperson', true);
		$staffid = $this->input->post('staffid', true);

		$validation = array('name' => $reportingperson);
		if ($this->reporting->validate($validation, 'formvalid')) {
			$curdate = date('Y-m-d H:i:s');

			//$checkData=  $this->reporting->delete_by(array('rp_staffid'=>$staffid));
			$reportingPersonList = array();

			foreach ($reportingperson as $report) {
				$reportingPersonList[] = array(
					'rp_staffid' => $staffid,
					'rp_reportingperson' => $report,
					'rp_addedby' => $this->loggeduserid,
					'rp_addedon' => $curdate
				);
			}

			if (count($reportingPersonList) > 0) {
				$insertedId = $this->reporting->insert_many($reportingPersonList, true);
			}



			if ($insertedId) {
				$this->session->set_flashdata('successmessage', 'Reporting Person  assigned successfully.');
				$result = array('status' => 'Yes', 'Message' => 'Reporting Person assigned successfully');
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

    public function viewstaff($id, $auth)
    {
        $this->load->model('staff/Tasks', 'task');
        $this->load->model('staff/Task_staff', 'taskstaff');
        $this->load->model('staff/Rating', 'rating');
       
        
        if ($this->validchecksumcheck($id, $auth)) {
            $this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
            $this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js','custom/parsleyjs/parsley.min.js');
            $this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
            //$this->data['scriptfunctions'] = array('task_rating('.$id.');');
            $this->data['taskList'] = $this->task->getstaffalltasks($id);
            $this->data['solved'] = $this->taskstaff->count_by(array('tsa_staffid'=>$id,'tsa_status'=>'0','tsa_completed_status'=>'2'));
            $this->data['pending'] = $this->taskstaff->count_by(array('tsa_staffid'=>$id,'tsa_status'=>'0','tsa_completed_status !='=>'2'));
            $userdata=$this->usersigin->getstaffbycondition(array('c.authenticationid'=>$id));
            $this->data['userdata']=array_shift($userdata);
            $rid=$this->session->userdata('authenticationid');
           // $this->data['ratingcnt']= $this->rating->getstaffrating_count($id,$rid);
            $this->data['scriptfunctions'] = array('viewstaff();','task_rating('.$id.');');
            $this->data['title']           = "View Staff";
            $this->data['id']           =  $id;
            $this->data['auth']           =  $auth;
            $this->data['controller']     =  $this;


            $this->load->template('users/view_user', $this->data, false);
        } else { 
            $this->session->set_flashdata('errormessage', 'Invalid request');
            redirect('admin/staff');
        }
    }

	public function reportingstaff()
	{
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('reportingStaffList();');
		$this->data['title']           = "Reporting Staff List";

		$this->load->template('users/reportingstaff', $this->data, false);
	}
	public function ajaxreportingstafflist()
	{
		$this->load->model('admin/Staff_reporting_conn', 'reporting');
		$list = $this->reporting->get_datatables();
		$tabledata = array();
		$no = $this->input->post('start', true);
		$vt = 1;
		foreach ($list as $item) {
			$authid = $this->checksumgen($item->authenticationid);
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = ucfirst(strtolower($item->au_title . ' ' . $item->au_crickf));
			$row[] = strtolower($item->au_cricke);
			$row[] = ucfirst(strtolower($item->au_emp_number));
			// $row[] = ucfirst(strtolower($item->au_designation));
			//$row[] = ucfirst(strtolower($item->au_deptarment));
			$row[] = ucfirst(strtolower($item->au_school . ' ' . $item->au_campus));
			//   $row[] = ($item->reportingpersonname) ? ucfirst(strtolower($item->reporttitle.' '.$item->reportingpersonname)).'('.$item->reportempnumber.')' : '';


			$row[] = '<a href="javascript:;" data-id="' . $item->authenticationid . '" data-auth="' . $authid . '"  class="btn btn-view viewAssignedStaffs  btn-sm mt-2 " "><i class="fa fa-eye"></i> View Staffs</a>';

			$tabledata[] = $row;
			$vt++;
			/* ================================ */
		}

		$output = array(
			"draw" => $this->input->post('draw', true),
			"recordsTotal" => $this->reporting->count_all(),
			"recordsFiltered" => $this->reporting->count_filtered(),
			"data" => $tabledata,
		);

		echo json_encode($output);
	}


	public function viewAssignedStaffs()
	{
		$this->load->model('admin/Staff_reporting_conn', 'reporting');
		$id = $this->input->post('id', true);
		$auth = $this->input->post('auth', true);
		if ($this->validchecksumcheck($id, $auth)) {
			$this->data['allusers'] = $this->reporting->getallassignedstafflist($id);
			$category = $this->input->post('pagename');
			if ($category) {
				$this->data['modalname'] = $category;
				echo $this->load->view('commonmodal', $this->data, true);
			}
		}
	}

	public function team()
	{
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('teamList();');
		$this->data['title']           = "Team List";

		$this->load->template('team', $this->data, false);
	}


	public function ajaxteamlist()
	{
		$this->load->model('admin/Team', 'team');
		$this->load->model('admin/Team_member', 'teammember');
		$list = $this->team->get_datatables();
		$tabledata = array();
		$no = $this->input->post('start', true);
		$vt = 1;
		foreach ($list as $item) {
			$authid = $this->checksumgen($item->teamid);
			$teamMembers = $this->teammember->getteammembers($item->teamid);
			$teamDisplay = "";
			if ($teamMembers) {
				$teamMembersList = explode(',', $teamMembers[0]->membername);
				foreach ($teamMembersList as $teamMem) {
					$teamDisplay .= '<div class="badge badge-lg mr-2 badge-light-primary d-inline">' . $teamMem . '</div>';
				}
			}


			$teamHeads = $this->teammember->getteamheads($item->teamid);
			$teamHeadDisplay = "";
			if ($teamHeads) {
				$teamHeadsList = explode(',', $teamHeads[0]->membername);
				foreach ($teamHeadsList as $teamMem) {
					$teamHeadDisplay .= '<div class="badge badge-lg mr-2 badge-light-primary d-inline">' . $teamMem . '</div>';
				}
			}
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = ucfirst(strtolower($item->team_name));
			$row[] = $teamDisplay;
			$row[] = $teamHeadDisplay;
			$statusText = ($item->team_status == "0") ? array('Delete', 'btn btn-delete btn-sm', 'fa-times-circle') : array('Enable', 'btn btn-light-success btn-sm', 'fa-check');

			$row[] = '
           <a href="javascript:;" data-item="' . $item->teamid . '" class="btn btn-edit mb-2 teamEdit btn-sm " "><i class="fa fa-edit"></i> Edit</a>&nbsp;
           <a href="javascript:;" data-item="' . $item->teamid . '" class="btn btn-view mb-2 teamView btn-sm " "><i class="fa fa-eye"></i> View</a>&nbsp;
           <a href="javascript:;" data-itemid="' . $item->teamid . '"  class="' . $statusText[1] . '  deleteTeam"><i class="fas ' . $statusText[2] . '"></i> ' . $statusText[0] . '</a>';

			$tabledata[] = $row;
			$vt++;
			/* ================================ */
		}

		$output = array(
			"draw" => $this->input->post('draw', true),
			"recordsTotal" => $this->team->count_all(),
			"recordsFiltered" => $this->team->count_filtered(),
			"data" => $tabledata,
		);

		echo json_encode($output);
	}
	public function addTaskTeam()
	{
		$this->data['allusers'] = $this->usersigin->getallusers(array('au_usertype !=' => 1, 'au_status' => '0'));
		$pagename = $this->input->post('pagename');
		if ($pagename) {
			$this->data['modalname'] = $pagename;
			echo $this->load->view('commonmodal', $this->data, true);
		}
	}

	public function teamSubmitProcess()
	{
		$this->load->model('admin/Team', 'team');
		$this->load->model('admin/Team_member', 'teammember');
		$this->load->model('admin/Staff_reporting_conn', 'reporting');
		$team_name = $this->input->post('team_name', true);
		$teammembers = $this->input->post('teammembers');
		$teamheads = $this->input->post('teamheads');
		$editid = $this->input->post('editid', true);


		$validation = array('name' => $team_name, 'teammember' => $teammembers, 'teamhead' => $teamheads);
		if ($this->team->validate($validation, 'formvalid')) {
			$curdate = date('Y-m-d H:i:s');
			if ($editid == "") {
				$checkTeam = $this->team->get_by(array('team_name' => $team_name, 'team_status' => '0'));
				if (!$checkTeam) {
					$insertedId = $this->team->insert(array(
						'team_name' => $team_name,
						'team_status' => '0',
						'team_addedby' => $this->loggeduserid,
						'team_addedon' => $curdate,

					), true);
					if ($insertedId) {
						$teamMembersList = array();

						if ($teammembers) {
							foreach ($teammembers as $member) {
								$teamMembersList[] = array(
									'tm_staffid' => $member,
									'tm_teamid' => $insertedId,
									'tm_ishead' => '0',
									'tm_status' => '0',
									'tm_addedon' => $curdate,
								);
							}

							$insertMembersId = $this->teammember->insert_many($teamMembersList);
						}


						if ($teamheads) {
							$teamHeadsList = array();
							foreach ($teamheads as $heads) {
								$checkMember = $this->teammember->get_by(array('tm_teamid' => $insertedId, 'tm_staffid' => $heads, 'tm_status' => '0'));

								if (!$checkMember) {
									$teamHeadsList[] = array(
										'tm_staffid' => $heads,
										'tm_teamid' => $insertedId,
										'tm_ishead' => '1',
										'tm_status' => '0',
										'tm_addedon' => $curdate,
									);
								} else {
									$insertMembersId = $this->teammember->update_status_by(array('team_memberid' => $checkMember->team_memberid), array(
										'tm_ishead' => '1'
									));
								}

								$reportingPersonList = [];
								foreach ($teamMembersList as $staff) {

									$reportingPersonList[] = array(
										'rp_staffid' => $staff['tm_staffid'],
										'rp_reportingperson' => $heads,
										'rp_teamid' => $insertedId,
										'rp_addedby' => $this->loggeduserid,
										'rp_addedon' => $curdate
									);
								}


								if (count($reportingPersonList) > 0) {
									$insertedId = $this->reporting->insert_many($reportingPersonList, true);
								}
							}

							if (count($teamHeadsList) > 0) {
								$insertMembersId = $this->teammember->insert_many($teamHeadsList);
							}
						}





						$this->session->set_flashdata('successmessage', 'Team  added successfully.');
						$result = array('status' => 'Yes', 'Message' => 'Team added successfully');
					} else {
						$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
						$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
					}
				} else {
					$this->session->set_flashdata('errormessage', 'Team already exists.');
					$result = array('status' => 'No', 'Message' => 'Team already exists.');
				}
			} else {
				$checkTeam = $this->team->get_by(array('teamid !=' => $editid, 'team_name' => $team_name, 'team_status' => '0'));
				if (!$checkTeam) {
					$insertedId = $this->team->update_status_by(array('teamid' => $editid), array(
						'team_name' => $team_name,
						'team_addedby' => $this->loggeduserid
					));
					if ($insertedId) {
						$existingmembers = $this->teammember->get_many_by(array('tm_teamid' => $editid, 'tm_status' => '0'));

						if ($existingmembers) {
							foreach ($existingmembers as $existmem) {
								if (!in_array($existmem->tm_staffid, $teammembers)) {
									$this->teammember->update_status_by(array('tm_staffid' => $existmem->tm_staffid, 'tm_teamid' => $editid), array(
										'tm_status' => '1'
									));
									$this->reporting->update_status_by(array('rp_staffid' => $existmem->tm_staffid, 'rp_teamid' => $editid), array(
										'rp_status' => '1'
									));
								}

								if (!in_array($existmem->tm_staffid, $teamheads)) {
									$this->teammember->update_status_by(array('tm_staffid' => $existmem->tm_staffid, 'tm_teamid' => $editid), array(
										'tm_ishead' => '0'
									));

									$this->reporting->update_status_by(array('rp_staffid' => $existmem->tm_staffid, 'rp_teamid' => $editid), array(
										'rp_status' => '1'
									));
								}
							}
						}



						$teamMembersList = array();

						if ($teammembers) {
							foreach ($teammembers as $member) {
								$checkMemberExists = $this->teammember->get_by(array('tm_teamid' => $editid, 'tm_staffid' => $member, 'tm_status' => '0'));
								if (!$checkMemberExists) {
									$teamMembersList[] = array(
										'tm_staffid' => $member,
										'tm_teamid' => $editid,
										'tm_ishead' => '0',
										'tm_status' => '0',
										'tm_addedon' => $curdate,
									);
								}
							}

							$insertMembersId = $this->teammember->insert_many($teamMembersList);
						}


						if ($teamheads) {
							$teamHeadsList = array();
							foreach ($teamheads as $heads) {
								$checkMember = $this->teammember->get_by(array('tm_teamid' => $editid, 'tm_staffid' => $heads));

								if (!$checkMember) {
									$teamHeadsList[] = array(
										'tm_staffid' => $heads,
										'tm_teamid' => $editid,
										'tm_ishead' => '1',
										'tm_status' => '0',
										'tm_addedon' => $curdate,
									);
								} else {
									$insertMembersId = $this->teammember->update_status_by(array('team_memberid' => $checkMember->team_memberid), array(
										'tm_ishead' => '1',
										'tm_status' => '0',
									));
								}



								$reportingPersonList = [];
								foreach ($teamMembersList as $staff) {

									$reportingPersonList[] = array(
										'rp_staffid' => $staff['tm_staffid'],
										'rp_reportingperson' => $heads,
										'rp_teamid' => $insertedId,
										'rp_addedby' => $this->loggeduserid,
										'rp_addedon' => $curdate
									);
								}


								if (count($reportingPersonList) > 0) {
									$insertedId = $this->reporting->insert_many($reportingPersonList, true);
								}
							}

							if (count($teamHeadsList) > 0) {
								$insertMembersId = $this->teammember->insert_many($teamHeadsList);
							}
						}





						$this->session->set_flashdata('successmessage', 'Team  updated successfully.');
						$result = array('status' => 'Yes', 'Message' => 'Team updated successfully');
					} else {
						$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
						$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
					}




					if ($insertedId) {
						$this->session->set_flashdata('successmessage', 'Team  updated successfully.');
						$result = array('status' => 'Yes', 'Message' => 'Team updated successfully');
					} else {
						$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
						$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
					}
				} else {
					$this->session->set_flashdata('errormessage', 'Team already exists.');
					$result = array('status' => 'No', 'Message' => 'Team already exists.');
				}
			}
		} else {
			$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
			$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
		}

		echo json_encode($result);
	}




	public function teamEdit()
	{
		$editid = $this->input->post('editid', true);

		$this->load->model('admin/Team_member', 'teammember');
		$this->load->model('admin/Team', 'team');
		$this->data['allusers'] = $this->usersigin->getallusers(array('au_usertype !=' => 1, 'au_status' => '0'));
		$this->data['editdata'] = $this->team->get_by(array('teamid' => $editid));
		$pagename = $this->input->post('pagename');
		if ($pagename != "" && $editid != "") {
			$this->data['teammembers'] = $this->teammember->getteammemberids($editid);
			$this->data['teamhead'] = $this->teammember->getteamheadids($editid);
			$this->data['modalname'] = $pagename;
			echo $this->load->view('commonmodal', $this->data, true);
		}
	}

	public function deleteTeam($item)
	{
		$this->load->model('admin/Team', 'team');
		$getitem = $this->team->get_by(array('teamid' => $item));
		if ($getitem != "") {
			if ($getitem) {
				$status = ($getitem->team_status == "0") ? '1' : '0';
				$statusText = ($getitem->team_status == "0") ? 'Deleted' : 'Enabled';
				$deleted = $this->team->update_status_by(array('teamid' => $item), array('team_status' => $status));

				if ($deleted) {
					$this->session->set_flashdata('successmessage', 'Team ' . $statusText . ' successfully.');
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


	public function viewReportingPerson()
	{
		$this->load->model('admin/Staff_reporting_conn', 'staffrep');
		$editid = $this->input->post('editid', true);
		$this->data['allreportingpersons'] = $this->staffrep->getallreportingusers($editid);
		$category = $this->input->post('pagename');
		if ($category) {
			$this->data['staffid'] = $editid;
			$this->data['modalname'] = $category;
			echo $this->load->view('commonmodal', $this->data, true);
		}
	}




	public function deleteReportingPerson($item)
	{
		$this->load->model('admin/Staff_reporting_conn', 'staffrep');
		$getitem = $this->staffrep->get_by(array('reportingid' => $item));
		if ($getitem != "") {
			if ($getitem) {
				$status = ($getitem->rp_status == "0") ? '1' : '0';
				$statusText = ($getitem->rp_status == "0") ? 'Deleted' : 'Enabled';
				$deleted = $this->staffrep->update_status_by(array('reportingid' => $item), array('rp_status' => $status));

				if ($deleted) {
					$this->session->set_flashdata('successmessage', 'Reporting Person ' . $statusText . ' successfully.');
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

	public function addCalendarTask()
	{
		$this->load->model('admin/Add_taskcalander', 'category');
		$category_name = $this->input->post('category_name', true);
		$editid = $this->input->post('editid', true);

		$validation = array('name' => $category_name);
		echo json_encode($result);
	}

	public function addtask()
	{
		$this->load->model('admin/Team', 'team');
		$this->load->model('admin/Task_category', 'category');
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('adminaddtask();');
		$this->data['categorylist']    = $this->category->get_many_by(array('tc_status' => 0));
		$this->data['allusers'] = $this->usersigin->getallusers(array('au_usertype !=' => 1, 'au_status' => '0'));
		$this->data['allteam'] = $this->team->get_many_by(array('team_status' => '0'));

		$this->data['title']           = "Add Task";

		$this->load->template('manage_tasks/add_task', $this->data, false);
	}

	public function taskSubmitProcess()
	{
		$this->load->model('staff/Tasks', 'task');
		$this->load->model('staff/Task_staff', 'taskstaff');
		$this->load->model('admin/Team_member', 'teammember');
		$task_name = $this->input->post('task_name', true);
		$category = $this->input->post('category', true);
		$subcategory = $this->input->post('subcategory', true);
		$task_details = $this->input->post('task_details', true);
		$priority = $this->input->post('priority', true);



		$assign_type = $this->input->post('assign_type', true);
		$assign_staff = $this->input->post('assign_staff');
		$assign_team = $this->input->post('assign_team');

		$task_date = $this->input->post('task_date', true);
		$task_end_date = $this->input->post('task_end_date', true);



		$editid = $this->input->post('editid', true);
		$editauth = $this->input->post('editauth', true);

		$validation = array(
			'task_name' => $task_name,
			'category' => $category,
			'subcategory' => $subcategory,
			'task_status' => ($editid == "") ? $assign_type : '1',
			'priority' => $priority
		);
		if ($this->task->validate($validation, 'formvalid')) {
			$curdate = date('Y-m-d H:i:s');
			if ($editid == "") {
				$taskCompletedStatus = 0;

				$taksInserted = $this->task->insert(array(
					'task_category' => $category,
					'task_subcategory' => $subcategory,
					'task_title' => $task_name,
					'task_details' => $task_details,
					'task_staffid' => $this->loggeduserid,
					'task_priority' => $priority,
					'task_date' => (isset($task_date) && $task_date != "") ? date('Y-m-d', strtotime($task_date)) : '',
					'task_end_date' => (isset($task_end_date) && $task_end_date != "") ? date('Y-m-d', strtotime($task_end_date)) : '',
					'task_status' => $taskCompletedStatus,
					'task_addedby' => $this->loggeduserid,
					'task_addedon' => $curdate,
					'task_temids' => (isset($assign_team) && count($assign_team) > 0) ? implode(',', $assign_team) : ''

				), true);
				if ($taksInserted) {
					if ($assign_type == '1') {
						$assignStaffArray = [];
						foreach ($assign_staff as $staff) {
							$assignStaffArray[] = array(
								'tsa_staffid' => $staff,
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
					$taskCompletedStatus = 0;

					$taksInserted = $this->task->update_status_by(array('taskid' => $editid), array(
						'task_category' => $category,
						'task_subcategory' => $subcategory,
						'task_title' => $task_name,
						'task_details' => $task_details,
						'task_priority' => $priority,
						'task_date' => (isset($task_date) && $task_date != "") ? date('Y-m-d', strtotime($task_date)) : '',
						'task_end_date' => (isset($task_end_date) && $task_end_date != "") ? date('Y-m-d', strtotime($task_end_date)) : '',
						'task_status' => $taskCompletedStatus,
						'task_addedby' => $this->loggeduserid,
						'task_addedon' => $curdate,
						'task_temids' => (isset($assign_team) && count($assign_team) > 0) ? implode(',', $assign_team) : ''

					));

					if (isset($assign_type)) {
						if ($assign_type == '1') {
							$this->taskstaff->delete_by(array('tsa_taskid' => $editid));
							$assignStaffArray = [];
							foreach ($assign_staff as $staff) {
								$assignStaffArray[] = array(
									'tsa_staffid' => $staff,
									'tsa_taskid' => $editid,
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
						} elseif ($assign_type == '2') {
							$this->taskstaff->delete_by(array('tsa_taskid' => $editid));
							foreach ($assign_team as $team) {
								$teamMembers = $this->teammember->get_many_by(array('tm_teamid' => $team, 'tm_ishead' => '0', 'tm_status' => '0'));
								$assignStaffArray = [];
								foreach ($teamMembers as $member) {
									$assignStaffArray[] = array(
										'tsa_staffid' => $member,
										'tsa_taskid' => $editid,
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

	public function viewassignedlist($id, $auth)
	{
		if ($this->validchecksumcheck($id, $auth)) {
			$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
			$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
			$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
			$this->data['scriptfunctions'] = array('viewassignedlist();');
			$this->data['title']           = "View Details";
			$this->data['editid']           = $id;
			$this->load->template('manage_tasks/view_task_assigned_list', $this->data, false);
		} else {
			$this->session->set_flashdata('errormessage', 'Invalid request');
			redirect('admin/manage_tasks');
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



	public function ajaxtaskassignedstafflist()
	{
		$this->load->model('staff/Task_staff', 'taskstaff');
		$this->load->model('staff/Task_status_details', 'taskstatus');
		$list = $this->taskstaff->get_datatables();
		$tabledata = array();
		$no = $this->input->post('start', true);
		$vt = 1;
		foreach ($list as $item) {
			$authid = $this->checksumgen($item->authenticationid);

			$timeSpent = 0;
			$taskStatus = $this->taskstatus->get_many_by(array('td_task_id' => $item->tsa_taskid, 'td_staff_id' => $item->authenticationid, 'td_status' => '0'));
			if ($taskStatus) {
				$timeHours = $taskStatus[0]->td_hours;
				$timeminutes = $taskStatus[0]->td_minutes;
				$time = strtotime($timeHours . ':' . $timeminutes);

				$timeSpent = $this->totalTimeCalculation($taskStatus);
			}

			$no++;
			$row = array();
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
			if ($item->tsa_approved != '1') {
				$row[] = '<div class="form-check form-check-sm form-check-custom form-check-solid">
            <input class="form-check-input finishedtaskcheck" type="checkbox" name="allusers[]"  value="' . $item->task_staff_addedid . '" />
            </div>';
			} else {
				$row[] = '';
			}
			$row[] = ucfirst(strtolower($item->au_title . ' ' . $item->au_crickf . '(' . $item->au_emp_number . ')'));
			$row[] = $status;
			$row[] = $item->tsa_completed_percentage;
			$row[] = $timeSpent;

			$row[] = '<a href="javascript:;" data-taskid="' . $item->tsa_taskid . '" data-staff="' . $item->authenticationid . '"  class="btn btn-view btn-sm mt-2 viewStaffTaskStatusDetails" "><i class="fa fa-eye"></i> View</a>';

			$tabledata[] = $row;
			$vt++;
			/* ================================ */
		}

		$output = array(
			"draw" => $this->input->post('draw', true),
			"recordsTotal" => $this->taskstaff->count_all(),
			"recordsFiltered" => $this->taskstaff->count_filtered(),
			"data" => $tabledata,
		);

		echo json_encode($output);
	}


	public function viewStaffTaskStatusDetails()
	{
		$this->load->model('staff/Task_status_details', 'taskstatus');
		$staff = $this->input->post('staff', true);
		$taskid = $this->input->post('taskid', true);
		$this->data['taskStatusDetails'] = $this->taskstatus->get_many_by(array('td_staff_id' => $staff, 'td_task_id' => $taskid, 'td_status' => '0'));


		if ($staff != "" && $taskid != "") {
			$this->data['modalname'] = $this->input->post('pagename', true);;
			echo $this->load->view('commonmodal', $this->data, true);
		}
	}
	public function teamView()
	{
		$this->load->model('admin/Team_member', 'teammember');
		$editid = $this->input->post('editid', true);

		$this->data['taskStatusDetails'] = $this->teammember->getallteammembers($editid);


		if ($editid != "") {
			$this->data['modalname'] = $this->input->post('pagename', true);;
			echo $this->load->view('commonmodal', $this->data, true);
		}
	}
	public function calendar_admin()
	{
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('reportingStaffList();');
		$this->data['title']           = "calendar";

		$this->load->template('admin/calendar', $this->data, false);
	}

	public function edittask($id, $auth)
	{
		if ($this->validchecksumcheck($id, $auth)) {
			$this->load->model('admin/Team', 'team');
			$this->load->model('staff/Tasks', 'task');
			$this->load->model('staff/Task_staff', 'taskstaff');
			$this->load->model('staff/Task_status_details', 'taskstatus');
			$taskDetails = $this->task->get_by(array('taskid' => $id));
			$this->load->model('admin/Task_category', 'category');
			$this->load->model('admin/Subcategory', 'subcategory');
			$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
			$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
			$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
			$this->data['scriptfunctions'] = array('adminaddtask();');

			$this->data['categorylist']    = $this->category->get_many_by(array('tc_status' => 0));
			$this->data['subcategory'] = $this->subcategory->get_many_by(array('sc_categoryid' => $taskDetails->task_category, 'sc_status' => '0'));
			$this->data['taskDetails'] = $taskDetails;
			$this->data['auth'] = $auth;
			$this->data['title']           = "Update Task";

			$this->data['taskStatusDetails'] = $this->taskstatus->get_many_by(array('td_staff_id' => $this->loggeduserid, 'td_task_id' => $id, 'td_status' => '0'));


			$this->data['categorylist']    = $this->category->get_many_by(array('tc_status' => 0));
			$this->data['allusers'] = $this->usersigin->getallusers(array('au_usertype !=' => 1, 'au_status' => '0'));
			$this->data['allteam'] = $this->team->get_many_by(array('team_status' => '0'));
			$this->data['gettaskstaffids'] = $this->taskstaff->gettaskstaffids($id);


			$this->load->template('manage_tasks/add_task', $this->data, false);
		} else {
			$this->session->set_flashdata('successmessage', 'Invalid request');
			redirect('staff/tasks');
		}
	}


	public function adminStaffProfileAddTask()
	{
		$this->load->model('admin/Task_category', 'category');

		$id = $this->input->post('id', true);
		$auth = $this->input->post('auth', true);
		if ($this->validchecksumcheck($id, $auth)) {
			$this->data['categorylist']    = $this->category->get_many_by(array('tc_status' => 0));

			$pagename = $this->input->post('pagename');
			if ($pagename) {
				$this->data['modalname'] = $pagename;
				$this->data['id'] = $id;
				$this->data['auth'] = $auth;
				echo $this->load->view('commonmodal', $this->data, true);
			}
		}
	}


	public function profileTaskSubmitProcess()
	{
		$this->load->model('staff/Tasks', 'task');
		$this->load->model('staff/Task_staff', 'taskstaff');
		$this->load->model('staff/Task_status_details', 'taskstatus');
		$task_name = $this->input->post('task_name', true);
		$category = $this->input->post('category', true);
		$subcategory = $this->input->post('subcategory', true);
		$task_details = $this->input->post('task_details', true);

		$priority = $this->input->post('priority', true);
		$task_status = 0;
		$task_date = $this->input->post('task_date', true);
		$task_end_date = $this->input->post('task_end_date', true);
		$editid = $this->input->post('editid', true);
		$editauth = $this->input->post('editauth', true);

		$validation = array(
			'task_name' => $task_name,
			'category' => $category,
			'subcategory' => $subcategory,
			'task_status' => '0',
			'priority' => $priority
		);
		if ($this->task->validate($validation, 'formvalid')) {
			$curdate = date('Y-m-d H:i:s');
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
				'task_status' => $taskCompletedStatus,
				'task_addedby' => $this->loggeduserid,
				'task_addedon' => $curdate,

			), true);
			if ($taksInserted) {
				$this->taskstaff->insert(array(
					'tsa_staffid' => $editid,
					'tsa_taskid' => $taksInserted,
					'tsa_completed_status' => $taskCompletedStatus,
					'tsa_completed_percentage' => $task_status,
					'tsa_status' => '0',
					'tsa_addedby' => $this->loggeduserid,
					'tsa_addedon' => $curdate,
				), true);



				$this->session->set_flashdata('successmessage', 'Task  added successfully.');
				$result = array('status' => 'Yes', 'Message' => 'Task added successfully');
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

	public function editstaff($id, $auth)
	{
		if ($this->validchecksumcheck($id, $auth)) {
			$this->load->model('admin/Departments', 'department');
			$this->load->model('admin/Campus', 'campus');
			$this->load->model('admin/Usertype', 'usertype');
			$this->load->model('admin/Designation', 'designation');
			$this->load->model('admin/Location', 'location');
			$this->load->model('admin/Stafflocation', 'stafflocation');
			$this->data['vendorjs']        = array('custom/parsleyjs/parsley.min.js');
			$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
			$userdata = $this->usersigin->getstaffbycondition(array('c.authenticationid' => $id));
			$this->data['userdata'] = array_shift($userdata);
			$this->data['scriptfunctions'] = array('editstaff();');
			$this->data['title']           = "Edit Staff";
			$this->data['id']           =  $id;
			$this->data['auth']           =  $auth;
			$this->data['department']           =  $this->department->get_many_by(array('dp_status' => '0'));
			$this->data['school']           =  $this->campus->get_many_by(array('cp_status' => '0'));
			$this->data['location']           =  $this->location->get_many_by(array('lo_status' => '0'));
			$usertype_id = array('2', '3');
			$usertype_status = array('0');
			$this->data['usertype'] = $this->usertype->getusertype($usertype_status, $usertype_id);
			$this->data['designation'] = $this->designation->get_many_by(array('dg_status' => '0'));

			$this->data['stafflocation'] = $this->stafflocation->get_many_by(array('sl_status' => '0', 'sl_staff_id' => $id));
			$this->load->template('users/editstaff', $this->data, false);
		} else {
			$this->session->set_flashdata('errormessage', 'Invalid request');
			redirect('admin/staff');
		}
	}
	public function editStaffSubmitProcess()
	{
		$this->load->model('admin/Stafflocation', 'stafflocation');
		$editid = $this->input->post('editid', true);
		$ischangepassword = $this->input->post('checked');
		$editauth = $this->input->post('editauth', true);
		$staff_title = $this->input->post('staff_title', true);
		$staff_name = $this->input->post('staff_name', true);
		$staff_email = $this->input->post('staff_email', true);
		$staff_empnumber = $this->input->post('staff_empnumber', true);
		$staff_gender = $this->input->post('staff_gender', true);
		$staff_department = $this->input->post('staff_department', true);

		$staff_school = $this->input->post('staff_school', true);
		$staff_campus = "Amritapuri"; //$this->input->post('staff_campus', true);
		$staff_location = $this->input->post('staff_location', true);

		$staff_work_start_date = $this->input->post('work_date', true);
		$staff_work_end_date = $this->input->post('work_end_date', true);

		$staff_password = null;
		if ($ischangepassword == 'true') {
			$staff_password = $this->input->post('staff_pass', true);
			$staff_password = password_hash($staff_password, PASSWORD_DEFAULT);
		}
		$userType = $this->input->post('staff_type', true); //2;
		$staff_designation_id = $this->input->post('staff_designation', true);


		$validation = array(
			'staff_title' => $staff_title,
			'staff_email' => $staff_email,
			'au_crickp' => $staff_password,
			'staff_name' => $staff_name,
			'staff_empnumber' => $staff_empnumber,
			'staff_gender' => $staff_gender,
			'staff_department' => $staff_department,
			'staff_school' => $staff_school,
			'staff_campus' => $staff_campus,
			'au_usertype' => $userType,
			'au_designation' => $staff_designation_id,
		);

		
		if ($ischangepassword != 'true') {
			unset($validation['au_crickp']);
		}

		/*
		if ($this->usersigin->validate($validation, ($ischangepassword == "true") ? 'updateuser_validation' : 'updateuser_validation_no_password')) {
			$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
			$result = array('status' => 'No', 'Message' => $validation, 'enc' => ($ischangepassword == "true") ? $nonEncryptedArray : $nonEncryptedArray, "loc" => $this->stafflocation->validate($userLocationArray, 'formvalid'));
			echo json_encode($result);
		}
		exit();*/
		if ($this->usersigin->validate($validation, ($ischangepassword == "true") ? 'updateuser_validation' : 'updateuser_validation_no_password')) {

			$encryptedArray = array(
				'au_crickus' => $staff_empnumber,
				'au_crickf' => $staff_name,
				'au_cricke' => $staff_email,

			);

			$nonEncryptedArray = array(
				'au_title' => $staff_title,
				'au_emp_number' => $staff_empnumber,
				'au_gender' => $staff_gender,
				'au_deptarment' => $staff_department,
				'au_school' => $staff_school,
				'au_campus' => $staff_campus,
				'au_crickp' => 	$staff_password,
				'au_usertype' => $userType,
				'au_status' => '0',
				'au_designation' => $staff_designation_id,

			);
			if ($ischangepassword != 'true') {
				unset($nonEncryptedArray['au_crickp']);
			}


			$updateArray = $this->usersigin->updateauthenticationtable(array('authenticationid' => $editid), $encryptedArray, $nonEncryptedArray);

			if (isset($staff_location) && isset($editid)) {

				$userLocationArray = array(
					'sl_location_type' => $staff_location,
					'sl_start_date' => date('Y-m-d', strtotime($staff_work_start_date)),
					'sl_end_date' => date('Y-m-d', strtotime($staff_work_end_date))
				);
				if ($this->stafflocation->validate($userLocationArray, 'formvalid')) {
					$this->stafflocation->updateStaffLocation($userLocationArray, $editid);

					$this->session->set_flashdata('successmessage', 'Changed updated successfully.');
					$result = array('status' => 'Yes', 'Message' => 'Changed updated successfully');
				}
			} else {
				$this->session->set_flashdata('errormessage', 'Changes not found.');
				$result = array('status' => 'No', 'Message' => 'Changes not found.', 'update' => $updateArray);
			}
		} else {
			$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
			$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
		}
		echo json_encode($result);
	}
	public function newStaffSubmitProcess()
	{
		$this->load->model('admin/Stafflocation', 'stafflocation');
		$staff_title = $this->input->post('staff_title', true);
		$staff_name = $this->input->post('staff_name', true);
		$staff_email = $this->input->post('staff_email', true);
		$staff_empnumber = $this->input->post('staff_empnumber', true);
		$staff_password = $this->input->post('staff_pass', true);
		$staff_password = password_hash($staff_password, PASSWORD_DEFAULT);
		$staff_gender = $this->input->post('staff_gender', true);
		$staff_department = $this->input->post('staff_department', true);
		$userType = $this->input->post('staff_type', true); //2;
		$staff_designation_id = $this->input->post('staff_designation', true);
		$staff_school = $this->input->post('staff_school', true);
		$staff_campus = "Amritapuri"; //$this->input->post('staff_campus', true);
		$staff_location = $this->input->post('staff_location', true);
		$staff_work_start_date = $this->input->post('work_date', true);
		$staff_work_end_date = $this->input->post('work_end_date', true);

		$valid = false;
		$validation[] = array(
			'au_crickus' => $staff_empnumber,
			'au_crickf' => $staff_name,
			'au_crickp' => $staff_password,
			'au_cricke' => $staff_email,
			'au_usertype' => $userType,
			'au_title' => $staff_title,
			'au_emp_number' => $staff_empnumber,
			'au_gender' => $staff_gender,
			'au_deptarment' => $staff_department,
			'au_school' => $staff_school,
			'au_campus' => $staff_campus,
			'au_status' => '0',
			'au_createdby' => $this->loggeduserid,
			'au_designation' => $staff_designation_id,
		);
		if ($this->usersigin->validate($validation, 'newstaff_validations')) {
			$valid = true;
		}
		$checkStaffExists = $this->usersigin->getuserdetails(array('AES_DECRYPT(au_crickus,"' . EncriptKey . '")' => $staff_empnumber));
		if (!$checkStaffExists && $valid) {
			$newsStaffArray[] = array(
				'au_crickus' => $staff_empnumber,
				'au_crickf' => $staff_name,
				'au_crickp' => $staff_password,
				'au_cricke' => $staff_email,
				'au_usertype' => $userType,
				'au_title' => $staff_title,
				'au_emp_number' => $staff_empnumber,
				'au_gender' => $staff_gender,
				'au_deptarment' => $staff_department,
				'au_school' => $staff_school,
				'au_campus' => $staff_campus,
				'au_status' => '0',
				'au_createdby' => $this->loggeduserid,
				'au_designation' => $staff_designation_id,
			);


			if (count($newsStaffArray) > 0) {
				foreach ($newsStaffArray as $staff) {
					$encrypted = array(
						'au_crickus' => $staff['au_crickus'],
						'au_crickf' => $staff['au_crickf'],
						'au_cricke' => $staff['au_cricke'],

					);

					$nonEncrypted = array(
						'au_crickp' => $staff['au_crickp'],
						'au_usertype' => $staff['au_usertype'],
						'au_title' => $staff['au_title'],
						'au_emp_number' => $staff['au_emp_number'],
						'au_gender' => $staff['au_gender'],
						'au_deptarment' => $staff['au_deptarment'],
						'au_school' => $staff['au_school'],
						'au_campus' => $staff['au_campus'],
						'au_status' => '0',
						'au_createdby' => $this->loggeduserid,
						'au_designation' => $staff['au_designation'],
					);

					$is_userRegister = $this->usersigin->inserttoauthenticationtable($encrypted, $nonEncrypted);
					if ($is_userRegister) {

						$userLocationArray = array(
							'sl_staff_id' => $is_userRegister,
							'sl_location_type' => $staff_location,
							'sl_addedby' => $this->loggeduserid,
							'sl_addedon' => date('Y-m-d H:i:s'),
							'sl_status' => '0',
							'sl_start_date' => date('Y-m-d', strtotime($staff_work_start_date)),
							'sl_end_date' => date('Y-m-d', strtotime($staff_work_end_date))
						);
						//print_r($userLocationArray);
						if ($this->stafflocation->validate($userLocationArray, 'formvalid')) {
						$this->stafflocation->insert($userLocationArray, true);

						$this->session->set_flashdata('successmessage', 'User registered successfully.');
						$result = array('status' => 'Yes', 'Message' => 'User registered successfully');
					}
					} else {
						$this->session->set_flashdata('errormessage', 'Not registered.');
						$result = array('status' => 'No', 'Message' => 'Not registered.');
					}
				}
			}
		} else {
			$this->session->set_flashdata('errormessage', 'User is already registered.');
			$result = array('status' => 'No', 'Message' => 'User is already registered.');
		}
		echo json_encode($result);
	}
	public function addstaff()
	{
		$this->load->model('admin/Departments', 'department');
		$this->load->model('admin/Campus', 'campus');
		$this->load->model('admin/Usertype', 'usertype');
		$this->load->model('admin/Designation', 'designation');
		$this->load->model('admin/Location', 'location');
		$this->data['vendorjs']        = array('custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('newstaff();');
		$this->data['title']           = "Add Staff";
		$this->data['department']           =  $this->department->get_many_by(array('dp_status' => '0'));
		$this->data['school']           =  $this->campus->get_many_by(array('cp_status' => '0'));
		$usertype_id = array('2', '3');
		$usertype_status = array('0');
		$this->data['usertype'] = $this->usertype->getusertype($usertype_status, $usertype_id);
		$this->data['designation'] = $this->designation->get_many_by(array('dg_status' => '0'));
		$this->data['location'] = $this->location->get_many_by(array('lo_status' => '0'));
		//$this->data['usertype']=$this->usertype->get_many_by(array('ut_status'=>'0','usertypeid'=>''));
		$this->load->template('users/addstaff', $this->data, false);
	}
	public function designation()
	{
		$this->data['vendorcss']        = array('custom/datatables/datatables.bundle.css');
		$this->data['vendorjs']        = array('custom/datatables/datatables.bundle.js', 'custom/parsleyjs/parsley.min.js');
		$this->data['commonjs']        = array('custom/scripts/customscriptfiles.js');
		$this->data['scriptfunctions'] = array('taskdesignation();');
		$this->data['title']           = "Designation";
		$this->load->template('designation', $this->data, false);
	}
	public function ajaxdesignationlist()
	{
		$this->load->model('admin/Designation', 'designation');
		$list = $this->designation->get_datatables();
		$tabledata = array();
		$no = $this->input->post('start', true);
		$vt = 1;
		foreach ($list as $item) {
			$authid = $this->checksumgen($item->designation_id);
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = ucfirst(strtolower($item->designation_name));
			$row[] = ($item->dg_status == "0") ? 'Active' : 'In-Active';
			// $row[] = date('d-m-Y H:i a', strtotime($item->dp_addedon));
			$statusText = ($item->dg_status == "0") ? array('Delete', 'btn btn-delete btn-sm', 'fa-times-circle') : array('Enable', 'btn btn-light-success btn-sm', 'fa-check');

			$row[] = '
            <a href="javascript:;" data-item="' . $item->designation_id . '" class="btn btn-edit designationEdit btn-sm " "><i class="fa fa-edit"></i> Edit</a>&nbsp;
            <a href="javascript:;" data-itemid="' . $item->designation_id . '"  class="' . $statusText[1] . '  deleteDesignation"><i class="fas ' . $statusText[2] . '"></i> ' . $statusText[0] . '</a>';

			$tabledata[] = $row;
			$vt++;
			/* ================================ */
		}

		$output = array(
			"draw" => $this->input->post('draw', true),
			"recordsTotal" => $this->designation->count_all(),
			"recordsFiltered" => $this->designation->count_filtered(),
			"data" => $tabledata,
		);
		echo json_encode($output);
	}
	public function addDesignation()
	{
		$pageName = $this->input->post('pagename');
		if ($pageName) {
			$this->data['modalname'] = $pageName;
			echo $this->load->view('commonmodal', $this->data, true);
		}
	}
	public function designationSubmitProcess()
	{
		$this->load->model('admin/Designation', 'designation');
		$designation_name = $this->input->post('designation_name', true);
		$editid = $this->input->post('editid', true);

		$validation = array('name' => $designation_name);
		if ($this->designation->validate($validation, 'formvalid')) {
			$curdate = date('Y-m-d H:i:s');
			if ($editid == "") {
				$checkDesignation = $this->designation->get_by(array('designation_name' => $designation_name, 'dg_status' => '0'));
				if (!$checkDesignation) {
					$insertedId = $this->designation->insert(array(
						'designation_name' => $designation_name,
						'dg_status' => '0',
						'dg_addedby' => $this->loggeduserid,
						'dg_addedon' => $curdate,

					), true);
					if ($insertedId) {
						$this->session->set_flashdata('successmessage', 'Designation  added successfully.');
						$result = array('status' => 'Yes', 'Message' => 'Designation added successfully');
					} else {
						$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
						$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
					}
				} else {
					$this->session->set_flashdata('errormessage', 'Designation already exists');
					$result = array('status' => 'No', 'Message' => 'Designation already exists');
				}
			} else {
				$checkDesignation = $this->designation->get_by(array('designation_id !=' => $editid, 'designation_name' => $designation_name, 'dg_status' => '0'));
				if (!$checkDesignation) {
					$insertedId = $this->designation->update_status_by(array('designation_id' => $editid), array(
						'designation_name' => $designation_name,
						'dg_addedby' => $this->loggeduserid

					));

					if ($insertedId) {
						$this->session->set_flashdata('successmessage', 'Designation  updated successfully.');
						$result = array('status' => 'Yes', 'Message' => 'Designation updated successfully');
					} else {
						$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
						$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
					}
				} else {
					$this->session->set_flashdata('errormessage', 'Designation already exists');
					$result = array('status' => 'No', 'Message' => 'Designation already exists');
				}
			}
		} else {
			$this->session->set_flashdata('errormessage', 'Please fill all mandatory fields.');
			$result = array('status' => 'No', 'Message' => 'Please fill all mandatory fields.');
		}

		echo json_encode($result);
	}
	public function designationEdit()
	{
		$this->load->model('admin/Designation', 'designation');
		$editid = $this->input->post('editid', true);
		$this->data['editdata'] = $this->designation->get_by(array('designation_id' => $editid));
		$category = $this->input->post('pagename');
		if ($category) {
			$this->data['modalname'] = $category;
			echo $this->load->view('commonmodal', $this->data, true);
		}
	}
	public function deleteDesignation($item)
	{
		$this->load->model('admin/Designation', 'designation');
		$getitem = $this->designation->get_by(array('designation_id' => $item));
		if ($getitem != "") {
			if ($getitem) {
				$checkDesignation = $this->usersigin->get_by(array('au_designation' => $getitem->dp_name));
				if (!$checkDesignation) {
					$status = ($getitem->dg_status == "0") ? '1' : '0';
					$statusText = ($getitem->dg_status == "0") ? 'Deleted' : 'Enabled';
					$deleted = $this->designation->update_status_by(array('designation_id' => $item), array('dg_status' => $status));

					if ($deleted) {
						$this->session->set_flashdata('successmessage', 'Designation ' . $statusText . ' successfully.');
						echo "true";
					} else {
						$this->session->set_flashdata('errormessage', 'Error occurred ,Please try again.');
						echo "false";
					}
				} else {
					$this->session->set_flashdata('errormessage', 'Staff assigned to this designation');
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
}
