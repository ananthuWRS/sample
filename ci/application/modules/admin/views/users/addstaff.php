<!--begin::Content wrapper-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
	<!--begin::Content wrapper-->
	<div class="d-flex flex-column flex-column-fluid">
		<!--begin::Toolbar-->
		<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
			<!--begin::Toolbar container-->
			<div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
				<!--begin::Page title-->
				<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
					<!--begin::Title-->

					<?php $task_head = 'Edit Task'; ?>
					<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
						<?= (isset($taskDetails)) ? $task_head : 'Add Task' ?></h1>
					<!--end::Title-->
					<!--begin::Breadcrumb-->
					<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
						<!--begin::Item-->
						<li class="breadcrumb-item text-muted">
							<a href="<?= base_url() ?>staff" class="text-muted text-hover-primary">Home</a>
						</li>
						<!--end::Item-->
						<!--begin::Item-->
						<li class="breadcrumb-item">
							<span class="bullet bg-gray-400 w-5px h-2px"></span>
						</li>
						<!--end::Item-->
						<!--begin::Item-->
						<li class="breadcrumb-item text-muted">Staff Management</li>
						<!--end::Item-->
						<!--begin::Item-->
						<li class="breadcrumb-item">
							<span class="bullet bg-gray-400 w-5px h-2px"></span>
						</li>
						<!--end::Item-->
						<!--begin::Item-->

						<li class="breadcrumb-item text-muted">Add Staff
						</li>
						<!--end::Item-->
					</ul>
					<!--end::Breadcrumb-->
				</div>
				<!--end::Page title-->
				<div class="d-flex align-items-center gap-2 gap-lg-3">

					<!--begin::Secondary button-->
					<!--end::Secondary button-->
					<!--begin::Primary button-->
					<a href="javascript:;" onclick="history.back()" class="btn btn-sm fw-bold btn-primary">Back</a>
					<!--end::Primary button-->
				</div>
				<!--begin::Actions-->

				<!--end::Actions-->
			</div>
			<!--end::Toolbar container-->
		</div>
		<!--end::Toolbar-->
		<!--begin::Content-->
		<div id="kt_app_content" class="app-content flex-column-fluid">
			<!--begin::Content container-->
			<div id="kt_app_content_container" class="app-container container-xxl">
				<!--begin::Card-->
				<div class="card">
					<!--begin::Card body-->
					<div class="card-body py-4">
						<div>
							<!--begin::Modal dialog-->
							<div class="">
								<!--begin::Modal content-->
								<div class="modal-content">
									<!--begin::Modal header-->
									<div class="p-5 pb-0">
										<!--begin::Modal title-->
										<h2 class="fw-bold">Add Staff
										</h2>
										<!--end::Modal title-->
									</div>
									<!--end::Modal header-->
									<!--begin::Modal body-->
									<div class="mx-5 mx-xl-5 my-7">
										<!--begin::Form-->
										<form class="form" id="addStaffForm" action="#" data-parsley-validate>
											<input type="hidden" name="staffid" value="">
											<input type="hidden" name="staffauth" value="">
											<!--begin::Scroll-->
											<div class="row d-flex   me-n7 pe-7">

												<!--begin::Input group-->
												<div class="fv-row mb-7 col-md-6">
													<!--begin::Label-->
													<label class="required fw-semibold fs-6 mb-2">Title</label>
													<!--end::Label-->
													<!--begin::Input-->
													<input type="text" name="staff_title" id="staff_title" required class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Title" value="" />
													<!--end::Input-->
												</div>

												<!--begin::Input group-->
												<div class="fv-row mb-7 col-md-6">
													<!--begin::Label-->
													<label class="required fw-semibold fs-6 mb-2">Name</label>
													<!--end::Label-->
													<!--begin::Input-->
													<input type="text" name="staff_name" id="staff_name" required class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Name" value="" />
													<!--end::Input-->
												</div>


												<!--begin::Input group-->
												<div class="fv-row mb-7 col-md-6">
													<!--begin::Label-->
													<label class="required fw-semibold fs-6 mb-2">Email</label>
													<!--end::Label-->
													<!--begin::Input-->
													<input type="email"data-parsley-type="email"	 name="staff_email" id="staff_email" required class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Email" value="" />
													<!--end::Input-->
												</div>


												<!--begin::Input group-->
												<div class="fv-row mb-7 col-md-6">
													<!--begin::Label-->
													<label class="required fw-semibold fs-6 mb-2">Employee
														Number</label>
													<!--end::Label-->
													<!--begin::Input-->
													<input type="text" name="staff_empnumber" id="staff_empnumber" required class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Employee Number" value="" />
													<!--end::Input-->
												</div>




												<div class="fv-row mb-7 col-md-6">
													<!--begin::Label-->
													<label class="required fw-semibold fs-6 mb-2">Gender</label>
													<!--end::Label-->
													<!--begin::Input-->
													<select data-parsley-errors-container="#gender-errors" required name="staff_gender" id="staff_gender" data-control="select2" data-placeholder="Select a Gender" data-hide-search="false" class="form-select form-select-solid fw-bold">
														<option></option>
														<option <?= (isset($userdata) && $userdata->au_gender == 'Male') ? 'selected' : '' ?> value="Male">Male</option>
														<option <?= (isset($userdata) && $userdata->au_gender == 'Female') ? 'selected' : '' ?> value="Female">Female</option>

													</select>
													<!--end::Input-->
													<div id="gender-errors"> </div>
												</div>


												<!--end::Input group-->


												<div class="fv-row mb-7 col-md-6">
													<!--begin::Label-->
													<label class="required fw-semibold fs-6 mb-2">Department</label>
													<!--end::Label-->
													<!--begin::Input-->
													<select data-parsley-errors-container="#department-errors" required name="staff_department" id="staff_department" data-control="select2" data-placeholder="Select a Department" data-hide-search="false" class="form-select form-select-solid fw-bold">
														<option></option>
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
													<!--end::Input-->
													<div id="department-errors"></div>
												</div>



												<!--begin::Input group-->

												<div class="fv-row mb-7 col-md-6">
													<!--begin::Label-->
													<label class="required fw-semibold fs-6 mb-2">School</label>
													<!--end::Label-->
													<!--begin::Input-->
													<select data-parsley-errors-container="#school-errors" required name="staff_school" id="staff_school" data-control="select2" data-placeholder="Select a School" data-hide-search="false" class="form-select form-select-solid fw-bold">
														<option></option>
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
													<!--end::Input-->
													<div id="school-errors"></div>
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->

												<div class="fv-row mb-7 col-md-6">
													<!--begin::Label-->
													<label class="required fw-semibold fs-6 mb-2">User Type</label>
													<!--end::Label-->
													<!--begin::Input-->
													<select data-parsley-errors-container="#userType-errors" required name="staff_type" id="staff_type" data-control="select2" data-placeholder="Select User Type" data-hide-search="false" class="form-select form-select-solid fw-bold">
														<option></option>
														<!--<option value="2">Teaching Staff</option>
														<option value="3">Non Teaching Staff</option>--->
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
													<!--end::Input-->
													<div id="userType-errors"></div>
												</div>
												<!--end::Input group-->
												<!--begin::Input group-->
												<div class="fv-row mb-7 col-md-6">
													<!--begin::Label-->
													<label class="required fw-semibold fs-6 mb-2">Campus</label>
													<!--end::Label-->
													<!--begin::Input-->
													<input type="text" name="staff_campus" id="staff_campus" required class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Campus" value="Amritapuri" readonly />

													<!--end::Input-->
												</div>

												<!--begin::Input group-->
												<div class="fv-row mb-7 col-md-6">
													<!--begin::Label-->
													<label class="required fw-semibold fs-6 mb-2">Designation</label>
													<!--end::Label-->
													<!--begin::Input-->
													<select data-parsley-errors-container="#designation-errors" required name="staff_designation" id="staff_designation" data-control="select2" data-placeholder="Select designation" data-hide-search="false" class="form-select form-select-solid fw-bold">
														<option></option>
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
													<!--end::Input-->
													<div id="designation-errors"></div>
													<!--end::Input-->
												</div>
												<!--begin::Input group-->
												<div class="fv-row mb-7 col-md-6">
													<!--begin::Label-->
													<label class="required fw-semibold fs-6 mb-2">Password</label>
													<!--end::Label-->
													<!--begin::Input-->

													<input data-parsley-errors-container="#password-errors" type="password" name="staff_pass" id="staff_pass" required class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Password" value="" />
													<div id="password-errors"></div>
													<!--end::Input-->
												</div>

												<!--begin::Input group-->
												<div class="fv-row mb-7 col-md-6">
													<!--begin::Label-->
													<label class="required fw-semibold fs-6 mb-2">Confirm Password</label>
													<!--end::Label-->
													<!--begin::Input-->

													<input data-parsley-errors-container="#confirmpassword-errors" type="password" name="staff_confirmpass" id="staff_confirmpass" required class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Password" value="" data-parsley-equalto="#staff_pass" />
													<div id="confirmpassword-errors"></div>
													<!--end::Input-->
												</div>

												<!--begin::Input group-->
												<div class="fv-row mb-7 col-md-6">
													<!--begin::Label-->
													<label class="required fw-semibold fs-6 mb-2">Work Location</label>
													<!--end::Label-->
													<!--begin::Input-->
													<select data-parsley-errors-container="#location-errors" required name="staff_location" id="staff_location" data-control="select2" data-placeholder="Select location" data-hide-search="false" class="form-select form-select-solid fw-bold">
														<option></option>
														<?php
														if ($location) {

															foreach ($location as $key => $cat) {

														?>
																<option value="<?= strtolower($cat->location_id) ?>">
																	<?= ucfirst($cat->lo_name) ?>

																</option>
														<?php
															}
														}
														?>

													</select>
													<!--end::Input-->
													<div id="location-errors"></div>
													<!--end::Input-->
												</div>
												<div class="fv-row mb-7  col-md-6">
                                                    <!--begin::Label-->
                                                    <label class="required fw-semibold fs-6 mb-2">Work Start Date</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" required name="work_date" id="work_date"
                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                        placeholder="Work Start Date" value="" />
                                                    <!--end::Input-->
                                                </div>
												 <!--begin::Input group-->

												 <div class="fv-row mb-7  col-md-6">
                                                    <!--begin::Label-->
                                                    <label class=" fw-semibold fs-6 mb-2">Work End Date</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" required name="work_end_date" id="work_end_date"
                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                        placeholder="Work End Date" value="" />
                                                    <!--end::Input-->
                                                </div>

											</div>
											<!--end::Scroll-->
											<!--begin::Actions-->






											<div class="card-toolbar">


												<div class="text-right pt-15">

													<button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Reset</button>
													<button type="button" class="btn btn-primary" id="submitStaff" data-kt-users-modal-action="submit">
														<span class="indicator-label">Submit</span>
														<span class="indicator-progress">Please wait...
															<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
													</button>



												</div>
											</div>


											<!--end::Actions-->
										</form>





										<!--end::Form-->
									</div>
									<!--end::Modal body-->
								</div>
								<!--end::Modal content-->
							</div>
							<!--end::Modal dialog-->
						</div>
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Card-->
			</div>
			<!--end::Content container-->
		</div>
		<!--end::Content-->
	</div>
	<!--end::Content wrapper-->

</div>
<!--end::Content wrapper-->
