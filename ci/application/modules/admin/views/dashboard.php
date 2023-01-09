<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="https://momentjs.com/downloads/moment.min.js"></script> 
<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">

                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="javascript:;" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Dashboards</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
		
	 <!-- Report section start -->
	 
	    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
		<div class="col-md-4 col-lg-4 col-xl-4 col-xxl-3 mb-md-5 mb-xl-10">
											<!--begin::Card widget 20-->
											<div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100 mb-5 mb-xl-10" onclick="showreport('task')" style="background-color: #b20f55;background-image:url('/metronic8/demo1/assets/media/patterns/vector-1.png')">
												<!--begin::Header-->
												<div class="card-header pt-5">
													<!--begin::Title-->
													<div class="card-title d-flex flex-column">
														<!--begin::Amount-->
														<span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2"><?=$totaltask;?></span>
														<!--end::Amount-->
														<!--begin::Subtitle-->
														<span class="text-white opacity-75 pt-1 fw-semibold fs-6">Tasks</span>
														<!--end::Subtitle-->
													</div>
													<!--end::Title-->
												</div>
												<!--end::Header-->
												<!--begin::Card body-->
												<div class="card-body d-flex align-items-end pt-0">
													<!--begin::Progress-->
													<div class="d-flex align-items-center flex-column mt-3 w-100">
														<div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
															<span><i class="fa fa-clock-o"></i> As on <?php echo date('d - F - Y'); ?></span>
														</div>
														
													</div>
													<!--end::Progress-->
												</div>
												<!--end::Card body-->
											</div>
											<!--end::Card widget 20-->
											
										</div>
										
										<div class="col-md-4 col-lg-4 col-xl-4 col-xxl-3 mb-md-5 mb-xl-10" onclick="showreport('staff')">
											<!--begin::Card widget 20-->
											<div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100 mb-5 mb-xl-10" style="background-color: #5298d4;background-image:url('/metronic8/demo1/assets/media/patterns/vector-1.png')">
												<!--begin::Header-->
												<div class="card-header pt-5">
													<!--begin::Title-->
													<div class="card-title d-flex flex-column">
														<!--begin::Amount-->
														<span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2"><?=$totalstaff?></span>
														<!--end::Amount-->
														<!--begin::Subtitle-->
														<span class="text-white opacity-75 pt-1 fw-semibold fs-6">Staffs</span>
														<!--end::Subtitle-->
													</div>
													<!--end::Title-->
												</div>
												<!--end::Header-->
												<!--begin::Card body-->
												<div class="card-body d-flex align-items-end pt-0">
													<!--begin::Progress-->
													<div class="d-flex align-items-center flex-column mt-3 w-100">
														<div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
															<span><i class="fa fa-clock-o"></i> As on <?php echo date('d - F - Y'); ?></span>
														</div>
														
													</div>
													<!--end::Progress-->
												</div>
												<!--end::Card body-->
											</div>
											<!--end::Card widget 20-->
											
										</div>
										
										<div class="col-md-4 col-lg-4 col-xl-4 col-xxl-3 mb-md-5 mb-xl-10">
											<!--begin::Card widget 20-->
											<div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100 mb-5 mb-xl-10" style="background-color: #F1416C;background-image:url('/metronic8/demo1/assets/media/patterns/vector-1.png')">
												<!--begin::Header-->
												<div class="card-header pt-5">
													<!--begin::Title-->
													<div class="card-title d-flex flex-column">
														<!--begin::Amount-->
														<span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2"><?=$total_departments?></span>
														<!--end::Amount-->
														<!--begin::Subtitle-->
														<span class="text-white opacity-75 pt-1 fw-semibold fs-6">Departments</span>
														<!--end::Subtitle-->
													</div>
													<!--end::Title-->
												</div>
												<!--end::Header-->
												<!--begin::Card body-->
												<div class="card-body d-flex align-items-end pt-0">
													<!--begin::Progress-->
													<div class="d-flex align-items-center flex-column mt-3 w-100">
														<div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
															<span><i class="fa fa-clock-o"></i> As on <?php echo date('d - F - Y'); ?></span>
														</div>
														
													</div>
													<!--end::Progress-->
												</div>
												<!--end::Card body-->
											</div>
											<!--end::Card widget 20-->
											
										</div>
										
										<div class="col-md-6 rptgraph">
											<!--begin::Engage widget 10-->
											<div class="card card-flush overflow-hidden h-lg-100">
												<!--begin::Header-->
												<div class="card-header pt-5">
													<!--begin::Title-->
													<h3 class="card-title align-items-start flex-column">
														<span class="card-label fw-bold text-dark">Staff Recent Login</span>
														<!--<span class="text-gray-400 mt-1 fw-semibold fs-6">Total <?=$totalstaff?> Staff</span>-->
													</h3>
													<!--end::Title-->
													<!--begin::Toolbar-->
													<div class="card-toolbar">
														
													</div>
													<!--end::Toolbar-->
												</div>
												<!--end::Header-->
												<!--begin::Card body-->
												<div class="card-body d-flex align-items-end p-0">
													<!--begin::Chart-->
													<canvas id="myChart" style="width:100%;max-width:600px"></canvas>
													<!--end::Chart-->
												</div>
												<!--end::Card body-->
											</div>
											<!--end::Engage widget 10-->
										</div>
										
										<div class="col-md-6 rptgraph">
											<!--begin::Engage widget 10-->
											<div class="card card-flush overflow-hidden h-lg-100">
												<!--begin::Header-->
												<div class="card-header pt-5">
													<!--begin::Title-->
													<h3 class="card-title align-items-start flex-column">
														<span class="card-label fw-bold text-dark">Task Summary</span>
														<!--<span class="text-gray-400 mt-1 fw-semibold fs-6">Total <?=$totaltask;?> Tasks</span>-->
													</h3>
													<!--end::Title-->
													<!--begin::Toolbar-->
													<div class="card-toolbar">
														<!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
														
														<!--end::Daterangepicker-->
													</div>
													<!--end::Toolbar-->
												</div>
												<!--end::Header-->
												<!--begin::Card body-->
												<div class="card-body d-flex align-items-end p-0">
													<!--begin::Chart-->
													<canvas id="myChart1" width="200" height="200"></canvas>
													<!--end::Chart-->
												</div>
												<!--end::Card body-->
											</div>
											<!--end::Engage widget 10-->
										</div>
		</div>
		
		
		<div class="row g-5 g-xl-10 mb-5 mb-xl-10" id="report_task" style="display:none;">
										<!--begin::Col-->
										<div class="col-xl-4">
											<!--begin::Chart Widget 35-->
											<div class="card card-flush h-md-100">
												<!--begin::Header-->
												<div class="card-header pt-5 mb-6">
													<!--begin::Title-->
													<h3 class="card-title align-items-start flex-column">
															
														<!--begin::Description-->
														<span class="fs-6 fw-semibold text-gray-400">Search</span>
														<!--end::Description-->
													</h3>
													<!--end::Title-->
													<!--begin::Toolbar-->
													<div class="card-toolbar">
														
														
														<!--end::Menu 2-->
														<!--end::Menu-->
													</div>
													<!--end::Toolbar-->
												</div>
												<!--end::Header-->
												<!--begin::Body-->
												<div class="card-body py-0 px-0">
													
													<!--begin::Tab Content-->
													<div class="tab-content mt-n6">
														
														 <div class="table-responsive mx-9 mt-n6">
                                                   
                                               
                                                   
                                                    <!--begin::Label-->
                                                    <label class="fw-semibold fs-6 mb-2"></label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                     <input type="text" required name="task_date" id="task_date"
                                                        class="form-control form-control-solid mb-3 mb-lg-0 reporttask_search"
                                                        placeholder="Start Date" value="" onchange="reporttask('task');" /><!--end::Input-->
													
													<!--begin::Label-->
                                                    <label class="fw-semibold fs-6 mb-2"></label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" required name="task_end_date" id="task_end_date"
                                                        class="form-control form-control-solid mb-3 mb-lg-0 reporttask_search"
                                                        placeholder="End Date" value="" onchange="reporttask('task');" /><!--end::Input-->
                                               
                                               
													<!--begin::Label-->
                                                    <label class="fw-semibold fs-6 mb-2"></label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <select 
                                                        name="priority" id="priority" 
                                                        class="form-select form-select-solid" onchange="reporttask('task');">
                                                        <option value="null">Select Priority</option>
														<option value="urgent">Urgent</option>
														  <option value="normal">Normal</option>
														   <option value="low">Low</option>
                                                        

                                                    </select>
                                                    <!--end::Input-->
                                                    <div id="category-errors"></div>
													
													
													<!--begin::Label-->
                                                    <label class="fw-semibold fs-6 mb-2"></label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <select 
                                                        name="status" id="status" 
                                                        class="form-select form-select-solid" onchange="reporttask('task');">
                                                        <option value="null">Select Status</option>
                                                        <option value="0">Active</option>
														<option value="1">Pending</option>
														<option value="2">Completed</option>

                                                    </select>
                                                    <!--end::Input-->
                                                    <div id="category-errors"></div>
													
                                                </div>
														
													</div>
													<!--end::Tab Content-->
												</div>
												<!--end::Body-->
											</div>
											<!--end::Chart Widget 35-->
										</div>
										<!--end::Col-->
										<!--begin::Col-->
										<div class="col-xl-8">
											<!--begin::Table widget 14-->
											<div class="card card-flush h-md-100">
												<!--begin::Header-->
												<div class="card-header pt-7">
													<!--begin::Title-->
													<h3 class="card-title align-items-start flex-column">
														<span class="card-label fw-bold text-gray-800">Task Report</span>
														<!--<span class="text-gray-400 mt-1 fw-semibold fs-6">Updated 37 minutes ago</span>-->
													</h3>
													<!--end::Title-->
													
													<!--<div class="card-toolbar">
														<a href="/metronic8/demo1/../demo1/apps/ecommerce/catalog/add-product.html" class="btn btn-sm btn-primary btn-light">Generate Reports</a>
													</div>-->
													
												</div>
												<!--end::Header-->
												<!--begin::Body-->
												<div class="card-body pt-6">
													<!--begin::Table container-->
													<div class="table-responsive">
														<!--begin::Table-->
														<table class="table table-row-dashed align-middle gs-0 gy-3 my-0" id="kt_task_report">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
																	<th class="p-0 pb-3 min-w-100px text-start">Task Name</th>
																	<th class="p-0 pb-3 min-w-100px text-end">Priority</th>
																	<th class="p-0 pb-3 min-w-100px text-end">Status</th>
																	<th class="p-0 pb-3 min-w-100px text-end pe-12">Completed % </th>
																	<th class="p-0 pb-3 min-w-100px text-end pe-12">View</th>
																	
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																
															</tbody>
															<!--end::Table body-->
														</table>
													</div>
													<!--end::Table-->
												</div>
												<!--end: Card Body-->
											</div>
											<!--end::Table widget 14-->
										</div>
										<!--end::Col-->
									</div>
									
									<!--staff report start-->
									
									<div class="row g-5 g-xl-10 mb-5 mb-xl-10" id="report_staff" style="display:none;">
										<!--begin::Col-->
										<div class="col-xl-4">
											<!--begin::Chart Widget 35-->
											<div class="card card-flush h-md-100">
												<!--begin::Header-->
												<div class="card-header pt-5 mb-6">
													<!--begin::Title-->
													<h3 class="card-title align-items-start flex-column">
															
														<!--begin::Description-->
														<span class="fs-6 fw-semibold text-gray-400">Search</span>
														<!--end::Description-->
													</h3>
													<!--end::Title-->
													<!--begin::Toolbar-->
													<div class="card-toolbar">
														
														
														<!--end::Menu 2-->
														<!--end::Menu-->
													</div>
													<!--end::Toolbar-->
												</div>
												<!--end::Header-->
												<!--begin::Body-->
												<div class="card-body py-0 px-0">
													
													<!--begin::Tab Content-->
													<div class="tab-content mt-n6">
														
														 <div class="table-responsive mx-9 mt-n6">
														  <label class="fw-semibold fs-6 mb-2"></label>
                                                           <select 
                                                        name="department" id="department" 
                                                        class="form-select form-select-solid" onchange="reportstaff('staff');">
                                                        <option value="null">Select Department</option>
                                                       <?php
														if ($department) {
															foreach ($department as $cat) {
														?>
																<option <?= (isset($userdata) &&  $userdata->au_deptarment == strtolower($cat->dp_name)) ? 'selected' : '' ?> value="<?= strtolower($cat->dp_name) ?>">
																	<?= ucfirst($cat->dp_name) ?>
																</option>
														<?php
															}
														}
														?>

                                                    </select>
													
                                                <label class="fw-semibold fs-6 mb-2"></label>
                                                           <select 
                                                        name="school" id="school" 
                                                        class="form-select form-select-solid" onchange="reportstaff('staff');">
                                                        <option value="null">Select School</option>
                                                       <?php
														if ($school) {
															foreach ($school as $cat) {
														?>
																<option <?= (isset($userdata) &&  $userdata->au_school == strtolower($cat->campus_name)) ? 'selected' : '' ?> value="<?= strtolower($cat->campus_name) ?>">
																	<?= ucfirst($cat->campus_name) ?>
																</option>
														<?php
															}
														}
														?>
                                                    </select>
													
													
													<label class="fw-semibold fs-6 mb-2"></label>
                                                           <select 
                                                        name="usertype" id="usertype" 
                                                        class="form-select form-select-solid" onchange="reportstaff('staff');">
                                                        <option value="null">Select Usertype</option>
                                                       <?php
														if ($usertype) {

															foreach ($usertype as $key => $cat) {

														?>
																<option value="<?= strtolower($cat->usertypeid) ?>">
																	<?= ucfirst($cat->ut_name) ?>

																</option>
														<?php
															}
														}
														?>
                                                    </select>
													
													
													<label class="fw-semibold fs-6 mb-2"></label>
                                                           <select 
                                                        name="designation" id="designation" 
                                                        class="form-select form-select-solid" onchange="reportstaff('staff');">
                                                        <option value="null">Select Designation</option>
                                                       <?php
														if ($designation) {

															foreach ($designation as $key => $cat) {

														?>
																<option value="<?= strtolower($cat->designation_id) ?>">
																	<?= ucfirst($cat->designation_name) ?>

																</option>
														<?php
															}
														}
														?>
                                                    </select>
													
                                                </div>
														
													</div>
													<!--end::Tab Content-->
												</div>
												<!--end::Body-->
											</div>
											<!--end::Chart Widget 35-->
										</div>
										<!--end::Col-->
										<!--begin::Col-->
										<div class="col-xl-8">
											<!--begin::Table widget 14-->
											<div class="card card-flush h-md-100">
												<!--begin::Header-->
												<div class="card-header pt-7">
													<!--begin::Title-->
													<h3 class="card-title align-items-start flex-column">
														<span class="card-label fw-bold text-gray-800">Staff Report</span>
														<!--<span class="text-gray-400 mt-1 fw-semibold fs-6">Updated 37 minutes ago</span>-->
													</h3>
													<!--end::Title-->
													
													<!--<div class="card-toolbar">
														<a href="/metronic8/demo1/../demo1/apps/ecommerce/catalog/add-product.html" class="btn btn-sm btn-primary btn-light">Generate Reports</a>
													</div>-->
													
												</div>
												<!--end::Header-->
												<!--begin::Body-->
												<div class="card-body pt-6">
													<!--begin::Table container-->
													<div class="table-responsive">
														<!--begin::Table-->
														<table class="table table-row-dashed align-middle gs-0 gy-3 my-0" id="kt_staff_report">
															<!--begin::Table head-->
															<thead>
																<tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
																	<th class="p-0 pb-3 min-w-100px text-start">Emp.Id</th>
																	<th class="p-0 pb-3 min-w-100px text-end">Name</th>
																	<th class="p-0 pb-3 min-w-100px text-end">Designation</th>
																	<th class="p-0 pb-3 min-w-175px text-end ">Rating</th>
																	<th class="p-0 pb-3 min-w-100px text-end ">View</th>
																	
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody>
																
																
															</tbody>
															<!--end::Table body-->
														</table>
													</div>
													<!--end::Table-->
												</div>
												<!--end: Card Body-->
											</div>
											<!--end::Table widget 14-->
										</div>
										<!--end::Col-->
									</div>
									
									
	 
	 <!-- Report section end -->
	 
	 <!--begin::Modal - Userlogin-->
<div class="modal fade commonmodal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <span class="card-label fw-bold text-dark">Active users on <span id="udate"></span></span>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15">
                <!--begin::Form-->
               
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header"
                        data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
						
						
						<!--<div id="loginstudents"></div>-->
						<div class="card-body loginstaff">
															

															
														</div>
                      
                       

                    </div>
                    <!--end::Scroll-->
                   
              
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Userlogin-->
	 
	 
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
<!--end::Content wrapper-->






<script>

</script>
<script>

$(document).ready(function(){
$("#task_date").flatpickr({
		// minDate: "today",
		dateFormat: "d-m-Y",
	});
	$("#task_end_date").flatpickr({
		// minDate: "today",
		dateFormat: "d-m-Y",
	});
})

function reporttask(type){
	  
					var table;
	table = $("#kt_task_report").DataTable({
		destroy: true,
		processing: true,
		serverSide: true,
		pageLength: 5,
		bLengthChange : false,
		order: [],
		ajax: {
			url: base_url + "Admin/ajaxreporttasklist",
			type: "POST",
			data: function (data) {
				data.status = $('#status').val();
				data.priority = $('#priority').val();
				data.startdate = $('#task_date').val();
				data.enddate = $('#task_end_date').val();
				//data.id = rid;
			},
		},
		language: {
			emptyTable: "No tasks available....!",
			processing: "Loading tasks ",
		},
		columnDefs: [
			{ className: "text-end pe-0", "targets": [ 1 ] },
			{ className: "text-end pe-0", "targets": [ 2 ] },
			{ className: "text-end pe-12", "targets": [ 3 ] }
		],
	});
}

function reportstaff(){
var table;
table = $("#kt_staff_report").DataTable({
		destroy: true,
		processing: true,
		serverSide: true,
		pageLength: 5,
		bLengthChange : false,
		order: [],
		ajax: {
			url: base_url + "Admin/ajax_report_stafflist",
			type: "POST",
			data: function (data) {
				data.department = $('#department').val();
				data.school = $('#school').val();
				data.usertype = $('#usertype').val();
				data.designation = $('#designation').val();
			},
		},
		language: {
			emptyTable: "No tasks available....!",
			processing: "Loading tasks ",
		},
		columnDefs: [
			{ className: "text-end pe-0", "targets": [ 1 ] },
			{ className: "text-end pe-0", "targets": [ 2 ] },
			{ className: "text-end pe-12", "targets": [ 3 ] }
		],
	});
}
</script>