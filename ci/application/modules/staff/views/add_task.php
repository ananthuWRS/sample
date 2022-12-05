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
                                                    <label class="required fw-semibold fs-6 mb-2">Task Start
                                                        Date</label>
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
                                                    <label class="required fw-semibold fs-6 mb-2">Task Start
                                                        Date</label>
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


                                                <div class="fv-row mb-7  col-md-4">
                                                    <button type="button" class="btn btn-primary addTaskStatus ">
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
                                                        <!--end::Svg Icon-->Add Status
                                                    </button>
                                                </div>


                                            </div>
                                            <!--end::Scroll-->
                                            <!--begin::Actions-->






                                            <div class="card-toolbar">


                                                <div class="text-right pt-15">

                                                    <button type="reset" class="btn btn-light me-3"
                                                        data-kt-users-modal-action="cancel">Reset</button>
                                                    <button type="button" class="btn btn-primary" id="submitTask"
                                                        data-kt-users-modal-action="submit">
                                                        <span class="indicator-label">Submit</span>
                                                        <span class="indicator-progress">Please wait...
                                                            <span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                    </button>



                                                </div>
                                            </div>


                                            <!--end::Actions-->
                                        </form>


                                        <div class="statusDisplay">

                                        </div>


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