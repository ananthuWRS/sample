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

                    <?php $task_head = 'Edit Task';?>
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        <?=(isset($taskDetails)) ? $task_head : 'Add Task'?></h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="<?=base_url()?>staff" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Task Management</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->

                        <li class="breadcrumb-item text-muted"><?=(isset($taskDetails)) ? $task_head : 'Add New Task'?>
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
                                        <h2 class="fw-bold"><?=(isset($taskDetails)) ? $task_head : 'Add New Task'?>
                                        </h2>
                                        <!--end::Modal title-->
                                    </div>
                                    <!--end::Modal header-->
                                    <!--begin::Modal body-->
                                    <div class="mx-5 mx-xl-5 my-7">
                                        <!--begin::Form-->
                                        <form class="form" id="addTaskForm" action="#" data-parsley-validate>
                                            <input type="hidden" name="editid"
                                                value="<?=(isset($taskDetails)) ? $taskDetails->taskid : ''?>">
                                            <input type="hidden" name="editauth"
                                                value="<?=(isset($auth)) ? $auth : ''?>">
                                            <!--begin::Scroll-->
                                            <div class="row d-flex   me-n7 pe-7">

                                                <!--begin::Input group-->
                                                <div class="fv-row mb-7">
                                                    <!--begin::Label-->
                                                    <label class="required fw-semibold fs-6 mb-2">Task Name</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="task_name" id="task_name" required
                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                        placeholder="Task Name"
                                                        value="<?=(isset($taskDetails)) ? $taskDetails->task_title : ''?>" />
                                                    <!--end::Input-->
                                                </div>
                                                <div class="fv-row mb-7 col-md-6">
                                                    <!--begin::Label-->
                                                    <label class="required fw-semibold fs-6 mb-2">Category</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <select data-parsley-errors-container="#category-errors" required
                                                        name="category" id="category" data-control="select2"
                                                        data-placeholder="Select a Category" data-hide-search="false"
                                                        class="form-select form-select-solid fw-bold">
                                                        <option></option>
                                                        <?php
if ($categorylist) {
    foreach ($categorylist as $cat) {
        ?>
                                                        <option
                                                            <?=(isset($taskDetails) &&  $taskDetails->task_category==$cat->task_categoryid) ? 'selected' : ''?>
                                                            value="<?=$cat->task_categoryid?>">
                                                            <?=ucfirst($cat->tc_name)?>
                                                        </option>
                                                        <?php
    }
}
                    ?>

                                                    </select>
                                                    <!--end::Input-->
                                                    <div id="category-errors"></div>
                                                </div>
                                                <div class="fv-row mb-7 col-md-6">
                                                    <!--begin::Label-->
                                                    <label class="required fw-semibold fs-6 mb-2">Sub Category</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <select data-parsley-errors-container="#subcategory-errors" required
                                                        name="subcategory" id="subcategory" data-control="select2"
                                                        data-placeholder="Select a Sub Category" data-hide-search="true"
                                                        class="form-select form-select-solid fw-bold">
                                                        <option></option>
                                                        <?php
if ($subcategory) {
    foreach ($subcategory as $cat) {
        ?>
                                                        <option
                                                            <?=(isset($taskDetails) &&  $taskDetails->task_subcategory==$cat->subcategoryid) ? 'selected' : ''?>
                                                            value="<?=$cat->subcategoryid?>"><?=ucfirst($cat->sc_name)?>
                                                        </option>
                                                        <?php
    }
}
                    ?>
                                                    </select>
                                                    <div id="subcategory-errors"></div>
                                                    <!--end::Input-->
                                                </div>

                                                <!--end::Input group-->

                                                <!--begin::Input group-->

                                                <?php if (!isset($taskDetails)) {?>

                                                <div class="fv-row mb-7  col-md-6">
                                                    <!--begin::Label-->
                                                    <label class="required fw-semibold fs-6 mb-2">Task Start Date</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" required name="task_date" id="task_date"
                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                        placeholder="Task Start Date" value="" />
                                                    <!--end::Input-->
                                                </div>

                                                <!--end::Input group-->

                                                <!--begin::Input group-->

                                                <div class="fv-row mb-7  col-md-6">
                                                    <!--begin::Label-->
                                                    <label class=" fw-semibold fs-6 mb-2">Task End Date</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="task_end_date" id="task_end_date"
                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                        placeholder="Task End Date" value="" />
                                                    <!--end::Input-->
                                                </div>

                                                <!--end::Input group-->
                                                <?php } else {
                                                    if ($taskDetails->task_status=="0") {?>

                                                <div class="fv-row mb-7  col-md-6">
                                                    <!--begin::Label-->
                                                    <label class="required fw-semibold fs-6 mb-2">Task Start Date</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" required name="task_date" id="task_date"
                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                        placeholder="Task Start Date"
                                                        value="<?=(isset($taskDetails) &&  $taskDetails->task_date!="" && $taskDetails->task_date!="1970-01-01") ? date('d-m-Y', strtotime($taskDetails->task_date)) : ''?>" />
                                                    <!--end::Input-->
                                                </div>

                                                <!--end::Input group-->

                                                <!--begin::Input group-->

                                                <div class="fv-row mb-7  col-md-6">
                                                    <!--begin::Label-->
                                                    <label class=" fw-semibold fs-6 mb-2">Task End Date</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="task_end_date" id="task_end_date"
                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                        placeholder="Task End Date"
                                                        value="<?=(isset($taskDetails) &&  $taskDetails->task_end_date!="" && $taskDetails->task_end_date!="1970-01-01") ? date('d-m-Y', strtotime($taskDetails->task_end_date)) : ''?>" />
                                                    <!--end::Input-->
                                                </div>

                                                <!--end::Input group-->


                                                <?php }
                                                    } ?>

                                                <!--begin::Input group-->

                                                <div class="fv-row mb-7  col-md-6">

                                                    <!--begin::Label-->
                                                    <label class="fw-semibold fs-6 mb-2">Task Details</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <textarea type="text" name="task_details" id="task_details"
                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                        placeholder="Task Details"
                                                        value=""><?=(isset($taskDetails)) ? $taskDetails->task_details : ''?></textarea>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="fv-row mb-7   col-md-6">
                                                    <!--begin::Label-->
                                                    <label class="required fw-semibold fs-6 mb-2">Priority</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <select data-parsley-errors-container="#priority-errors"
                                                        name="priority" id="priority" required data-control="select2"
                                                        data-placeholder="Select a Priority" data-hide-search="true"
                                                        class="form-select form-select-solid fw-bold">
                                                        <option></option>
                                                        <option
                                                            <?=(isset($taskDetails) &&  $taskDetails->task_priority=='low') ? 'selected' : ''?>
                                                            value="low">Low</option>
                                                        <option
                                                            <?=(isset($taskDetails) &&  $taskDetails->task_priority=='normal') ? 'selected' : ''?>
                                                            value="normal">Normal</option>
                                                        <option
                                                            <?=(isset($taskDetails) &&  $taskDetails->task_priority=='urgent') ? 'selected' : ''?>
                                                            value="urgent">Urgent</option>
                                                    </select>
                                                    <div id="priority-errors"></div>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <?php if (!isset($taskDetails)) {?>
                                                <div class="fv-row mb-7 mt-7 row   col-md-6">
                                                    <div class="col-md-6 col-lg-6 col-xxl-6 ">
                                                        <label class="  btn-active-light-primary active  text-start p-4"
                                                            data-kt-button="true">
                                                            <!--begin::Radio button-->
                                                            <span
                                                                class=" fs-4 fw-bold form-check-solid form-check-sm align-items-start mt-1">
                                                                <input
                                                                    <?=(isset($taskDetails) &&  $taskDetails->task_temids=='') ? 'checked' : ''?>
                                                                    data-parsley-errors-container="#assigntype-errors"
                                                                    required class="form-check-input assign_type"
                                                                    type="radio" name="assign_type" id="assign_type"
                                                                    value="1">
                                                            </span>
                                                            <!--end::Radio button-->
                                                            <span class="ms-5 ">
                                                                <span class="fs-4 fw-bold mb-1 "> Individual Staff
                                                                </span>

                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-xxl-6 ">

                                                        <label class="  btn-active-light-primary active  text-start p-4"
                                                            data-kt-button="true">
                                                            <!--begin::Radio button-->
                                                            <span
                                                                class="  form-check-solid form-check-sm align-items-start mt-1">
                                                                <input
                                                                    data-parsley-errors-container="#assigntype-errors"
                                                                    required class="form-check-input assign_type"
                                                                    type="radio" name="assign_type"
                                                                    <?=(isset($taskDetails) &&  $taskDetails->task_temids!='') ? 'checked' : ''?>
                                                                    id="assign_type" value="2">
                                                            </span>
                                                            <!--end::Radio button-->
                                                            <span class="ms-5 ">
                                                                <span class="fs-4 fw-bold mb-1 ">Team
                                                                </span>

                                                            </span>
                                                        </label>
                                                    </div>

                                                    <div id="assigntype-errors"></div>
                                                </div>

                                                <?php } else {
                                                    if ($taskDetails->task_staffid==$this->session->userdata('authenticationid')) {
                                                        ?>
                                                <div class="fv-row mb-7 mt-7 row   col-md-6">
                                                    <div class="col-md-6 col-lg-6 col-xxl-6 ">
                                                        <label class="  btn-active-light-primary active  text-start p-4"
                                                            data-kt-button="true">
                                                            <!--begin::Radio button-->
                                                            <span
                                                                class=" fs-4 fw-bold form-check-solid form-check-sm align-items-start mt-1">
                                                                <input
                                                                    <?=(isset($taskDetails) &&  $taskDetails->task_temids=='') ? 'checked' : ''?>
                                                                    data-parsley-errors-container="#assigntype-errors"
                                                                    required class="form-check-input assign_type"
                                                                    type="radio" name="assign_type" id="assign_type"
                                                                    value="1">
                                                            </span>
                                                            <!--end::Radio button-->
                                                            <span class="ms-5 ">
                                                                <span class="fs-4 fw-bold mb-1 "> Individual Staff
                                                                </span>

                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-xxl-6 ">

                                                        <label class="  btn-active-light-primary active  text-start p-4"
                                                            data-kt-button="true">
                                                            <!--begin::Radio button-->
                                                            <span
                                                                class="  form-check-solid form-check-sm align-items-start mt-1">
                                                                <input
                                                                    data-parsley-errors-container="#assigntype-errors"
                                                                    required class="form-check-input assign_type"
                                                                    type="radio" name="assign_type"
                                                                    <?=(isset($taskDetails) &&  $taskDetails->task_temids!='') ? 'checked' : ''?>
                                                                    id="assign_type" value="2">
                                                            </span>
                                                            <!--end::Radio button-->
                                                            <span class="ms-5 ">
                                                                <span class="fs-4 fw-bold mb-1 ">Team
                                                                </span>

                                                            </span>
                                                        </label>
                                                    </div>

                                                    <div id="assigntype-errors"></div>
                                                </div>

                                                <?php
                                                    }
                                                } ?>




                                                <div class="fv-row mb-7 col-md-6">
                                                    <div class="individualList"
                                                        style="display: <?=(isset($taskDetails) &&  $taskDetails->task_staffid==$this->session->userdata('authenticationid')  && $taskDetails->task_temids=='') ? 'block' : 'none'?>;">
                                                        <!--begin::Label-->
                                                        <label class="required fw-semibold fs-6 mb-2">Staff</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <select data-parsley-errors-container="#assign_staff-errors"
                                                            required multiple name="assign_staff[]" id="assign_staff"
                                                            data-control="select2" data-placeholder="Select a Staff"
                                                            data-hide-search="false"
                                                            class="form-select form-select-solid fw-bold">
                                                            <option></option>
                                                            <?php
if ($allusers) {
    foreach ($allusers as $cat) {
        ?>
                                                            <option
                                                                <?php echo (isset($gettaskstaffids[0]) && in_array($cat->authenticationid, explode(',', $gettaskstaffids[0]->taskstaff))) ? 'selected' : ''?>
                                                                value="<?=$cat->authenticationid?>">
                                                                <?=$cat->au_title.' '.$cat->au_crickf.'('.$cat->au_cricke.')'?>
                                                            </option>
                                                            <?php
    }
}
                    ?>

                                                        </select>
                                                    </div>

                                                    <div class="teamList"
                                                        style="display: <?=(isset($taskDetails) &&  $taskDetails->task_temids!='') ? 'block' : 'none'?>;">
                                                        <!--begin::Label-->
                                                        <label class="required fw-semibold fs-6 mb-2">Team</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <select data-parsley-errors-container="#assign_staff-errors"
                                                            required multiple name="assign_team[]" id="assign_team"
                                                            data-control="select2" data-placeholder="Select a Team"
                                                            data-hide-search="false"
                                                            class="form-select form-select-solid fw-bold">
                                                            <option></option>
                                                            <?php
if ($allteam) {
    foreach ($allteam as $cat) {
        ?>
                                                            <option
                                                                <?=(isset($taskDetails) && $taskDetails->task_temids!="" &&  in_array($cat->teamid, explode(',', $taskDetails->task_temids))) ? 'selected' : ''?>
                                                                value="<?=$cat->teamid?>">
                                                                <?=ucfirst($cat->team_name)?>
                                                            </option>
                                                            <?php
    }
}
                    ?>

                                                        </select>
                                                    </div>
                                                    <!--end::Input-->
                                                    <div id="assign_staff-errors"></div>
                                                </div>






                                            </div>
                                            <!--end::Scroll-->
                                            <!--begin::Actions-->






                                            <div class="card-toolbar">

                                                <div class="text-right pt-15">
                                                    <?php if (isset($taskDetails)) {?>
                                                  
                                                    <button type="reset" class="btn btn-light me-3"
                                                        data-kt-users-modal-action="cancel">Reset</button>
                                                    <button type="button" class="btn btn-primary" id="submitTask"
                                                        data-kt-users-modal-action="submit">
                                                        <span class="indicator-label">Submit</span>
                                                        <span class="indicator-progress">Please wait...
                                                            <span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                    </button>
                                                    <?php 
                                                    } else {
                                                        ?>
                                                    <button type="reset" class="btn btn-light me-3"
                                                        data-kt-users-modal-action="cancel">Reset</button>
                                                    <button type="button" class="btn btn-primary" id="submitTask"
                                                        data-kt-users-modal-action="submit">
                                                        <span class="indicator-label">Submit</span>
                                                        <span class="indicator-progress">Please wait...
                                                            <span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                    </button>
                                                    <?php
                                                    } ?>

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