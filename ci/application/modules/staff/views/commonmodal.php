<?php
switch($modalname) {
    case 'updateTaskStatus':
        ?>
<!--begin::Modal - Add task-->
<div class="modal fade commonmodal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-lg modal-dialog-centered ">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Update Task Status | <?=$taskDetails->task_title?></h2>
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
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="kt_modal_add_category_form" class="form" action="#" data-parsley-validate>

                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header"
                        data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <input type="hidden" name="editid" id="editid" value="<?= (isset($editid)) ? $editid : '' ?>">




                        <!--begin::Input group-->

                        <div class="fv-row   col-md-12 row ">

                            <!--begin::Input group-->

                            <div class="fv-row mb-7  col-md-4">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Completion %
                                    [1-100]</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="number" required min="1" max="100" name="task_completion_status"
                                    maxlength='3' id="task_completion_status"
                                    class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Completion %"
                                    data-previous="<?=(isset($taskDetails)) ? $taskDetails->tsa_completed_percentage : '0'?>"
                                    value="" />
                                <!--end::Input-->
                            </div>

                            <!--end::Input group-->
                            <div class=" mb-7  col-md-3">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Execution
                                    Date
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" required name="task_execution_date" id="task_execution_date"
                                    class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Execution Date"
                                    value="" />
                            </div>
                            <!--end::Input-->

                            <div class=" mb-4  col-md-5 row">
                                <div class=" mb-4  col-md-7 ">
                                    <!--begin::Label-->
                                    <label class="required fw-semibold fs-6 mb-2">Time Spent
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="number" min="1" max="4" name="task_time_spend_hours" maxlength='2'
                                        id="task_time_spend_hours" class="form-control form-control-solid mb-3 mb-lg-0"
                                        placeholder="Hours" value="" />
                                </div>
                                <div class=" mb-4  col-md-5 ">
                                    <label class=" fw-semibold fs-6 mb-2">&nbsp;
                                    </label>
                                    <input type="number" min="1" max="60" name="task_time_spend_mins" maxlength='2'
                                        id="task_time_spend_mins" class="form-control form-control-solid mb-3 mb-lg-0"
                                        placeholder="Mins" value="" />
                                </div>
                            </div>
                            <!--end::Input-->
                        </div>



                        <!--end::Input group-->

                        <!--begin::Input group-->

                        <div class="fv-row mb-7  col-md-12">

                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">Remarks</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea type="text" name="task_remarks" id="task_remarks"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Remarks"
                                value=""></textarea>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-right pt-15">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="kt_add_category_submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
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
<!--end::Modal - Add task-->
<?php
                        break;


    case 'editTaskStatusDetails':
        ?>
<!--begin::Modal - Add task-->
<div class="modal fade commonmodal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-lg modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Edit Status</h2>
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
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="kt_modal_add_category_form" class="form" action="#" data-parsley-validate>

                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header"
                        data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <input type="hidden" name="editid" id="editid" value="<?= (isset($editid)) ? $editid : '' ?>">

                        <!--begin::Input group-->

                        <div class="fv-row mb-7  col-md-12">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Task Completion Status
                                [1-100]</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="number" required min="1" max="100" name="task_completion_status" maxlength='3'
                                id="task_completion_status" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Task Status" data-previous="0"
                                value="<?=(isset($taskDetails)) ? $taskDetails->td_completion_percentage : '0'?>" />
                            <!--end::Input-->
                        </div>

                        <!--end::Input group-->


                        <!--begin::Input group-->

                        <div class="fv-row   col-md-12 row ">
                            <div class=" mb-7  col-md-6">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Task Execution
                                    Date
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" required name="task_execution_date" id="task_execution_date"
                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                    placeholder="Task Execution Date"
                                    value="<?=(isset($taskDetails)) ? date('d-m-Y', strtotime($taskDetails->td_execution_date)) : ''?>" />
                            </div>
                            <!--end::Input-->

                            <div class=" mb-4  col-md-6 row">
                                <div class=" mb-4  col-md-7 ">
                                    <!--begin::Label-->
                                    <label class="required fw-semibold fs-6 mb-2">Time Spent
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="number" min="1" max="4" required name="task_time_spend_hours"
                                        maxlength='2' id="task_time_spend_hours"
                                        class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Hours"
                                        value="<?=(isset($taskDetails)) ? $taskDetails->td_hours : ''?>" />
                                </div>
                                <div class=" mb-4  col-md-5 ">
                                    <label class=" fw-semibold fs-6 mb-2">&nbsp;
                                    </label>
                                    <input type="number" min="1" max="60" required name="task_time_spend_mins"
                                        maxlength='2' id="task_time_spend_mins"
                                        class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Mins"
                                        value="<?=(isset($taskDetails)) ? $taskDetails->td_minutes : ''?>" />
                                </div>
                            </div>
                            <!--end::Input-->
                        </div>



                        <!--end::Input group-->

                        <!--begin::Input group-->

                        <div class="fv-row mb-7  col-md-12">

                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">Remarks</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea type="text" name="task_remarks" id="task_remarks"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Task Remarks"
                                value=""><?=(isset($taskDetails)) ? $taskDetails->td_remarks : ''?></textarea>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-right pt-15">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="kt_add_task_status_edit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
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
<!--end::Modal - Add task-->
<?php
                        break;


    case 'viewTaskStatusDetails':
        ?>
<!--begin::Modal - Add task-->
<div class="modal fade commonmodal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-lg modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">View Details</h2>
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
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->


                <!--begin::Scroll-->
                <div class="row view_task d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll"
                    data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                    data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header"
                    data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                    <!--begin::Input group-->



                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class=" fw-semibold fs-6 mb-2">Task Completion Status
                            [1-100]</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <p><?=(isset($taskDetails)) ? $taskDetails->td_completion_percentage : '0'?></p>
                        <!--end::Input-->
                    </div>
                    <div class="fv-row mb-7 col-md-12 row">
                        <div class="  col-md-6">
                            <!--begin::Label-->
                            <label class=" fw-semibold fs-6 mb-2">Task Execution
                                Date</label>
                            <!--end::Label-->
                            <p><?=(isset($taskDetails)) ? date('d-m-Y', strtotime($taskDetails->td_execution_date)) : ''?>
                            </p>
                        </div>


                        <div class="  col-md-6">
                            <!--begin::Label-->
                            <label class=" fw-semibold fs-6 mb-2">Time Spent</label>
                            <!--end::Label-->
                            <p><?=(isset($taskDetails)) ? $taskDetails->td_hours.'Hrs' : ''?>
                                <?=(isset($taskDetails)) ? $taskDetails->td_minutes.'Mins' : ''?> </p>
                        </div>
                    </div>

                    <!--end::Input group-->


                    <div class="fv-row mb-7 col-md-6">
                        <!--begin::Label-->
                        <label class=" fw-semibold fs-6 mb-2">Remarks</label>
                        <!--end::Label-->
                        <p><?=(isset($taskDetails)) ? $taskDetails->td_remarks : ''?></p>
                    </div>



                </div>
                <!--end::Scroll-->
                <!--begin::Actions-->
                <div class="text-right pt-15">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>

                </div>
                <!--end::Actions-->

                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Add task-->
<?php
                        break;

    case 'addTaskStatus':
        ?>
<!--begin::Modal - Add task-->
<div class="modal fade commonmodal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-lg modal-dialog-centered ">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add Task Status </h2>
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
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="kt_modal_add_task_form" class="form" action="#" data-parsley-validate>

                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header"
                        data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">




                        <!--begin::Input group-->

                        <div class="fv-row   col-md-12 row ">

                            <!--begin::Input group-->

                            <div class="fv-row mb-7  col-md-4">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Completion %
                                    <span style="color: #b20f55 !important;">
                                        [<?=(isset($startcount) && $startcount!="") ? $startcount : '1'?>-100]</span></label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="number" required min="1" max="100" name="task_completion_status"
                                    maxlength='3' id="task_completion_status"
                                    class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Completion %"
                                    value="" />
                                <!--end::Input-->
                            </div>

                            <!--end::Input group-->
                            <div class=" mb-7  col-md-3">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Execution
                                    Date
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" required name="task_execution_date" id="task_execution_date"
                                    class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Execution Date"
                                    value="" />
                            </div>
                            <!--end::Input-->

                            <div class=" mb-4  col-md-5 row">
                                <div class=" mb-4  col-md-7 ">
                                    <!--begin::Label-->
                                    <label class="required fw-semibold fs-6 mb-2">Time Spent
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="number" min="1" max="4" name="task_time_spend_hours" maxlength='2'
                                        id="task_time_spend_hours" class="form-control form-control-solid mb-3 mb-lg-0"
                                        placeholder="Hours" value="" />
                                </div>
                                <div class=" mb-4  col-md-5 ">
                                    <label class=" fw-semibold fs-6 mb-2">&nbsp;
                                    </label>
                                    <input type="number" min="1" max="60" name="task_time_spend_mins" maxlength='2'
                                        id="task_time_spend_mins" class="form-control form-control-solid mb-3 mb-lg-0"
                                        placeholder="Mins" value="" />
                                </div>
                            </div>
                            <!--end::Input-->
                        </div>



                        <!--end::Input group-->

                        <!--begin::Input group-->

                        <div class="fv-row mb-7  col-md-12">

                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">Remarks</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea type="text" name="task_remarks" id="task_remarks"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Remarks"
                                value=""></textarea>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-right pt-15">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="kt_add_task_submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
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
<!--end::Modal - Add task-->
<?php
                        break;

    case 'addTaskStatusDetails':
        ?>
<!--begin::Modal - Add task-->
<div class="detail_st">
    <p>Status Update Details</p>
</div>
<div id="" class="dataTables_wrapper dt-bootstrap4 no-footer">
    <div class="table-responsive">
        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_table_task_details"
            aria-describedby="kt_table_users_info" style="width: 1280px;">
            <!--begin::Table head-->
            <thead>
                <!--begin::Table row-->
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="w-10px pe-2 sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1"
                        aria-label="#: activate to sort column ascending" style="width: 10.5px;">#</th>
                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1"
                        aria-label="Task Name: activate to sort column ascending" style="width: 125.25px;">Date</th>
                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1"
                        aria-label="Category: activate to sort column ascending" style="width: 125.25px;">Status%</th>
                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1"
                        aria-label="Category: activate to sort column ascending" style="width: 125.25px;">Time</th>
                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1"
                        aria-label="Sub Category: activate to sort column ascending" style="width: 125.25px;">Remarks
                    </th>
                    <th class="text-center min-w-100px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                        colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 100.25px;">
                        Actions</th>
                </tr>
                <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody class="text-gray-600 fw-semibold">
                <?php

if ($taskStatusDetails) {
    $i=1;
    foreach ($taskStatusDetails as $key=>$details) {
        ?>
                <tr class="odd">
                    <td><?=$i?></td>
                    <td><?=date('d-m-Y', strtotime($details['date']))?>
                    </td>
                    <td><?=$details['status']?></td>                    
                    <td><?=(($details['hours']!='')?$details['hours']:'0').' Hrs|'.(($details['minutes']!='')?$details['minutes']:'0').' Minutes'?></td>
                    <td><?=$details['remarks']?></td>
                    
                    <td>
                        <!-- <a href="javascript:;" data-item="<?=$key?>"
                            class="btn btn-light-primary  btn-sm editAddTaskStatusDetails"><i class="
                                                                    fa fa-edit"></i> Edit</a>&nbsp; -->
                        <a href="javascript:;" class="btn btn-light-danger btn-sm   btn-sm deleteAddTaskStatusDetails"
                            data-item="<?=$key?>"><i class="fas fa-times-circle"></i> Delete</a>&nbsp;
                    </td>
                </tr>
                <?php $i++;
    }
} ?>
            </tbody>
            <!--end::Table body-->
        </table>
    </div>
</div>
<!--end::Modal - Add task-->
<?php
                        break;

    case 'editAddTaskStatusDetails':
        ?>
<!--begin::Modal - Add task-->
<div class="modal fade commonmodal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-lg modal-dialog-centered ">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Edit Task Status </h2>
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
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="kt_modal_add_task_form" class="form" action="#" data-parsley-validate>

                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header"
                        data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">




                        <!--begin::Input group-->

                        <div class="fv-row   col-md-12 row ">

                            <!--begin::Input group-->

                            <div class="fv-row mb-7  col-md-4">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Completion %
                                    [1-100]</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="number" required min="1" max="100" name="task_completion_status"
                                    maxlength='3'
                                    class="form-control task_completion_status form-control-solid mb-3 mb-lg-0"
                                    placeholder="Completion %" value="<?=$taskStatusDetails['status']?>" />
                                <!--end::Input-->
                            </div>

                            <!--end::Input group-->
                            <div class=" mb-7  col-md-3">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Execution
                                    Date
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" required name="task_execution_date" id="task_execution_date"
                                    class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Execution Date"
                                    value="<?=date('d-m-Y', strtotime($taskStatusDetails['date']))?>" />
                            </div>
                            <!--end::Input-->

                            <div class=" mb-4  col-md-5 row">
                                <div class=" mb-4  col-md-7 ">
                                    <!--begin::Label-->
                                    <label class="required fw-semibold fs-6 mb-2">Time Spent
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="number" min="1" max="4" name="task_time_spend_hours" maxlength='2'
                                        id="task_time_spend_hours" class="form-control form-control-solid mb-3 mb-lg-0"
                                        placeholder="Hours" value="<?=$taskStatusDetails['hours']?>" />
                                </div>
                                <div class=" mb-4  col-md-5 ">
                                    <label class=" fw-semibold fs-6 mb-2">&nbsp;
                                    </label>
                                    <input type="number" min="1" max="60" name="task_time_spend_mins" maxlength='2'
                                        id="task_time_spend_mins" class="form-control form-control-solid mb-3 mb-lg-0"
                                        placeholder="Mins" value="<?=$taskStatusDetails['minutes']?>" />
                                </div>
                            </div>
                            <!--end::Input-->
                        </div>



                        <!--end::Input group-->

                        <!--begin::Input group-->

                        <div class="fv-row mb-7  col-md-12">

                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">Remarks</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea type="text" name="task_remarks" id="task_remarks"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Remarks"
                                value=""><?=$taskStatusDetails['remarks']?></textarea>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-right pt-15">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" data-editid="<?=$editid?>" class="btn btn-primary"
                            id="kt_add_task_edit_submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
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
<!--end::Modal - Add task-->
<?php
                        break;

    case 'approveTaskStatus':
        ?>
<!--begin::Modal - Add task-->
<div class="modal fade commonmodal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-lg modal-dialog-centered ">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Approve Task </h2>
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
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="kt_modal_add_task_form" class="form" action="#" data-parsley-validate>

                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header"
                        data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <input type="hidden" name="editid" id="editid" value="<?=(isset($editid)) ? $editid : ''?>">

                        <!--begin::Input group-->

                        <div class="fv-row mb-7  col-md-12">

                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">Comments</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea type="text" name="task_comments" id="task_comments"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Comments"
                                value=""></textarea>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-right pt-15">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-editid="<?=(isset($editid)) ? $editid : ''?>"
                            id="kt_form_approve_task_submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
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
<!--end::Modal - Add task-->
<?php
                        break;


    case 'rejectTaskStatus':
        ?>
<!--begin::Modal - Add task-->
<div class="modal fade commonmodal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-lg modal-dialog-centered ">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Reject Task </h2>
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
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="kt_modal_add_task_form" class="form" action="#" data-parsley-validate>

                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header"
                        data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <input type="hidden" name="editid" id="editid" value="<?=(isset($editid)) ? $editid : ''?>">

                        <!--begin::Input group-->

                        <div class="fv-row mb-7  col-md-12">

                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">Comments</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea type="text" name="task_comments" id="task_comments"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Comments"
                                value=""></textarea>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-right pt-15">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" data-editid="<?=(isset($editid)) ? $editid : ''?>" class="btn btn-primary"
                            id="kt_form_reject_task_submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
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
<!--end::Modal - Add task-->
<?php
                        break;
    case 'taskCalendarView':
        ?>
<div class="modal fade commonmodal" id="kt_modal_view_event" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header border-0 justify-content-end">
                <!--begin::Edit-->
                <a href="<?=$editurl?>" class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-primary me-2"
                    data-bs-toggle="tooltip" data-bs-dismiss="click" id="kt_modal_view_event_edit"
                    aria-label="Edit Task" data-kt-initialized="1">
                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                    <span class="svg-icon svg-icon-2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3"
                                d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                fill="currentColor"></path>
                            <path
                                d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                fill="currentColor"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
    </a>
                <!--end::Edit-->
              
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-primary" data-bs-toggle="tooltip"
                    data-bs-dismiss="modal" aria-label="Hide Event" data-kt-initialized="1">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                fill="currentColor"></rect>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body pt-0 pb-20 px-lg-17">
                <!--begin::Row-->
                <div class="d-flex">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                    <span class="svg-icon svg-icon-1 svg-icon-muted me-5">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3"
                                d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z"
                                fill="currentColor"></path>
                            <path
                                d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z"
                                fill="currentColor"></path>
                            <path
                                d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z"
                                fill="currentColor"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <!--end::Icon-->
                    <div class="mb-9">
                        <!--begin::Event name-->
                        <div class="d-flex align-items-center mb-2">
                            <span class="fs-3 fw-bold me-3"
                                data-kt-calendar="event_name"><?=ucfirst($taskDetails->task_title)?></span>
                            <span class="badge badge-light-success"
                                data-kt-calendar="all_day"><?=ucfirst($taskDetails->task_priority)?></span>

                                <span class="badge badge-light-danger"
                                data-kt-calendar="all_day"><?=ucfirst($taskDetails->tsa_completed_percentage)?>%</span>
                        </div>
                        <!--end::Event name-->
                        <!--begin::Event description-->
                        <div class="fs-6" data-kt-calendar="event_description"><?=ucfirst($taskDetails->task_details)?>
                        </div>
                        <!--end::Event description-->
                    </div>
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="d-flex align-items-center mb-2">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs050.svg-->
                    <span class="svg-icon svg-icon-1 svg-icon-success me-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                            version="1.1">
                            <circle fill="currentColor" cx="12" cy="12" r="8"></circle>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <!--end::Icon-->
                    <!--begin::Event start date/time-->
                    <div class="fs-6">
                        <span class="fw-bold">Starts</span>
                        <span
                            data-kt-calendar="event_start_date"><?=date('d-m-Y', strtotime($taskDetails->task_date))?></span>
                    </div>
                    <!--end::Event start date/time-->
                </div>
                <!--end::Row-->
                <?php if($taskDetails->task_end_date!='' && $taskDetails->task_end_date!='1970-01-01'){?>
                <!--begin::Row-->
                <div class="d-flex align-items-center mb-9">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs050.svg-->
                    <span class="svg-icon svg-icon-1 svg-icon-danger me-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                            version="1.1">
                            <circle fill="currentColor" cx="12" cy="12" r="8"></circle>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <!--end::Icon-->
                    
                    <!--begin::Event end date/time-->
                    <div class="fs-6">
                        <span class="fw-bold">Ends</span>
                        <span
                            data-kt-calendar="event_end_date"><?=($taskDetails->task_end_date!='' && $taskDetails->task_end_date!='1970-01-01') ? date('d-m-Y', strtotime($taskDetails->task_end_date)) : ''?></span>
                    </div>
                    <!--end::Event end date/time-->
                    
                </div>
                <!--end::Row-->
                <?php } ?>
                <!--begin::Row-->
                <div class="d-flex align-items-center">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                    <span class="svg-icon svg-icon-1 svg-icon-muted me-5">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z" fill="currentColor"/>
<path d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z" fill="currentColor"/>
<path opacity="0.3" d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z" fill="currentColor"/>
<path opacity="0.3" d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z" fill="currentColor"/>
</svg>
                    </span>
                    <!--end::Svg Icon-->
                    <!--end::Icon-->
                    <!--begin::Event location-->
                    <div class="fs-6" data-kt-calendar="event_location"><?=ucfirst($taskDetails->tc_name)?>-<?=ucfirst($taskDetails->sc_name)?></div>
                    <!--end::Event location-->
                </div>
                <!--end::Row-->
                <?php if (isset($taskDetails)) {?>
                                        <div class="detail_st mt-4 ">
                                            <p>Status Update Details</p>
                                        </div>
                                        <div id="" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                            <div class="table-responsive">
                                                <table
                                                    class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                                                    id="kt_table_task_details_pop" aria-describedby="kt_table_users_info"
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
                                                                aria-label="Sub Category: activate to sort column ascending"
                                                                style="width: 125.25px;">Time </th>
                                                            <th class="min-w-125px sorting" tabindex="0"
                                                                aria-controls="kt_table_users" rowspan="1" colspan="1"
                                                                aria-label="Sub Category: activate to sort column ascending"
                                                                style="width: 125.25px;">Remarks</th>
                                                         
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
                                                            
                                                        </tr>
                                                        <?php $i++; }
} ?>
                                                    </tbody>
                                                    <!--end::Table body-->
                                                </table>
                                            </div>
                                        </div>

                                        <?php } ?>
            </div>
            <!--end::Modal body-->
        </div>
    </div>
</div>

<?php
break;
}
?>