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
                                                        value="<?=(isset($taskDetails) &&  $taskDetails->task_date!="" && $taskDetails->task_date!="1970-01-01") ? date('d-m-Y',strtotime($taskDetails->task_date)) : ''?>" />
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
                                                        value="<?=(isset($taskDetails) &&  $taskDetails->task_end_date!="" && $taskDetails->task_end_date!="1970-01-01") ? date('d-m-Y',strtotime($taskDetails->task_end_date)) : ''?>" />
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
                                                <!--begin::Input group-->

                                                <div class="fv-row mb-7  col-md-4">
                                                    <!--begin::Label-->
                                                    <label class="required fw-semibold fs-6 mb-2">Task Completion Status
                                                        [1-100]</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="number" required min="0" max="100" name="task_status"
                                                        maxlength='3' id="task_status"
                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                        placeholder="Task Status"
                                                        value="<?=(isset($taskDetails)) ? $taskDetails->task_completed_percentage : '0'?>" />
                                                    <!--end::Input-->
                                                </div>

                                                <!--end::Input group-->


                                                <!--begin::Input group-->

                                                <div class="fv-row   col-md-8 row addTaskExecutionDetails"
                                                    style="display:none ;">
                                                    <div class=" mb-7  col-md-6">
                                                        <!--begin::Label-->
                                                        <label class="required fw-semibold fs-6 mb-2">Task Execution
                                                            Date
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" required name="task_execution_date"
                                                            id="task_execution_date"
                                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                                            placeholder="Task Execution Date" value="" />
                                                    </div>
                                                    <!--end::Input-->

                                                    <div class=" mb-4  col-md-6 row">
                                                        <div class=" mb-4  col-md-7 ">
                                                            <!--begin::Label-->
                                                            <label class="required fw-semibold fs-6 mb-2">Time Spent
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input type="number" min="1" max="24" 
                                                                name="task_time_spend_hours" maxlength='2'
                                                                id="task_time_spend_hours"
                                                                class="form-control form-control-solid mb-3 mb-lg-0"
                                                                placeholder="Hours" value="" />
                                                        </div>
                                                        <div class=" mb-4  col-md-5 ">
                                                            <label class=" fw-semibold fs-6 mb-2">&nbsp;
                                                            </label>
                                                            <input type="number" min="1" max="60" 
                                                                name="task_time_spend_mins" maxlength='2'
                                                                id="task_time_spend_mins"
                                                                class="form-control form-control-solid mb-3 mb-lg-0"
                                                                placeholder="Mins" value="" />
                                                        </div>
                                                    </div>
                                                    <!--end::Input-->
                                                </div>



                                                <!--end::Input group-->

                                                <!--begin::Input group-->

                                                <div class="fv-row mb-7  col-md-6 addTaskExecutionDetails">

                                                    <!--begin::Label-->
                                                    <label class="fw-semibold fs-6 mb-2">Remarks</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <textarea type="text" name="task_remarks" id="task_remarks"
                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                        placeholder="Task Remarks" value=""></textarea>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <?php } ?>


                                            </div>
                                            <!--end::Scroll-->
                                            <!--begin::Actions-->






                                            <div class="card-toolbar">


                                                <div class="text-right pt-15">
                                                    <?php if (isset($taskDetails)) {?>
                                                    <?php if ($taskDetails->task_staffid==$this->session->userdata('authenticationid')) {?>
                                                    <button type="reset" class="btn btn-light me-3"
                                                        data-kt-users-modal-action="cancel">Reset</button>
                                                    <button type="button" class="btn btn-primary" id="submitTask"
                                                        data-kt-users-modal-action="submit">
                                                        <span class="indicator-label">Save Task</span>
                                                        <span class="indicator-progress">Please wait...
                                                            <span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                    </button>
                                                    <?php } if((isset($taskstaff) && $taskstaff->tsa_completed_status!='2') || empty($taskstaff)){ ?>
                                                    <button type="button" class="btn btn-primary updateTaskStatus "
                                                        data-item="<?=$taskDetails->taskid?>">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                                        <span class="svg-icon svg-icon-2">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.5" x="11.364" y="20.364" width="16"
                                                                    height="2" rx="1"
                                                                    transform="rotate(-90 11.364 20.364)"
                                                                    fill="currentColor"></rect>
                                                                <rect x="4.36396" y="11.364" width="16" height="2"
                                                                    rx="1" fill="currentColor"></rect>
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->Update Status
                                                    </button>
                                                    <?php } }else{
                                                        ?>
                                                    <button type="reset" class="btn btn-light me-3"
                                                        data-kt-users-modal-action="cancel">Reset</button>
                                                    <button type="button" class="btn btn-primary" id="submitTask"
                                                        data-kt-users-modal-action="submit">
                                                        <span class="indicator-label">Save Task</span>
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

                                        <?php if (isset($taskDetails)) {?>
                                        <div class="detail_st">
                                            <p>Status Update Details</p>
                                        </div>
                                        <div id="" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                            <div class="table-responsive">
                                                <table
                                                    class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                                                    id="kt_table_task_details" aria-describedby="kt_table_users_info"
                                                    style="width: 1280px;">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <!--begin::Table row-->
                                                        <tr
                                                            class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                            <th class="w-10px pe-2 sorting" tabindex="0"
                                                                aria-controls="kt_table_users" rowspan="1" colspan="1"
                                                                aria-label="#: activate to sort column ascending"
                                                                style="width: 10.5px;">#</th>
                                                            <th class="min-w-125px sorting" tabindex="0"
                                                                aria-controls="kt_table_users" rowspan="1" colspan="1"
                                                                aria-label="Task Name: activate to sort column ascending"
                                                                style="width: 125.25px;">Date</th>
                                                            <th class="min-w-125px sorting" tabindex="0"
                                                                aria-controls="kt_table_users" rowspan="1" colspan="1"
                                                                aria-label="Category: activate to sort column ascending"
                                                                style="width: 125.25px;">Status%</th>
                                                                <th class="min-w-125px sorting" tabindex="0"
                                                                aria-controls="kt_table_users" rowspan="1" colspan="1"
                                                                aria-label="Category: activate to sort column ascending"
                                                                style="width: 125.25px;">Time</th>
                                                            <th class="min-w-125px sorting" tabindex="0"
                                                                aria-controls="kt_table_users" rowspan="1" colspan="1"
                                                                aria-label="Sub Category: activate to sort column ascending"
                                                                style="width: 125.25px;">Remarks</th>
                                                            <th class="text-center min-w-100px sorting" tabindex="0"
                                                                aria-controls="kt_table_users" rowspan="1" colspan="1"
                                                                aria-label="Actions: activate to sort column ascending"
                                                                style="width: 100.25px;">Actions</th>
                                                        </tr>
                                                        <!--end::Table row-->
                                                    </thead>
                                                    <!--end::Table head-->
                                                    <!--begin::Table body-->
                                                    <tbody class="text-gray-600 fw-semibold">
                                                        <?php

if ($taskStatusDetails) {
    $i=1;
    foreach ($taskStatusDetails as $details) {
    

    ?>
                                                        <tr class="odd">
                                                            <td><?=$i?></td>
                                                            <td><?=date('d-m-Y',strtotime($details->td_execution_date))?>
                                                            </td>
                                                            <td><?=$details->td_completion_percentage?></td>
                                                            <td><?=(($details->td_hours!='')?$details->td_hours:'0').' Hrs|'.(($details->td_minutes!='')?$details->td_minutes:'0').' Minutes'?></td>
                                                            <td><?=$details->td_remarks?></td>
                                                            <td>
                                                                <?php if($details->td_approved!='1'){?>
                                                                <a href="javascript:;"
                                                                    data-item="<?=$details->task_details_id?>"
                                                                    class="btn btn-light-primary  btn-sm editTaskStatusDetails"><i
                                                                        class="
                                                                    fa fa-edit"></i> Edit</a>&nbsp;
                                                                    <?php } ?>
                                                                
                                                            </td>
                                                        </tr>
                                                        <?php $i++; }
} ?>
                                                    </tbody>
                                                    <!--end::Table body-->
                                                </table>
                                            </div>
                                        </div>

                                        <?php } ?>
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