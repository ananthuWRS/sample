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
                        <li class="breadcrumb-item text-muted">Staff Management</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->

                        <li class="breadcrumb-item text-muted">Edit Staff
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
                                        <h2 class="fw-bold">Edit Staff
                                        </h2>
                                        <!--end::Modal title-->
                                    </div>
                                    <!--end::Modal header-->
                                    <!--begin::Modal body-->
                                    <div class="mx-5 mx-xl-5 my-7">
                                        <!--begin::Form-->
                                        <form class="form" id="addTaskForm" action="#" data-parsley-validate>
                                            <input type="hidden" name="editid" value="<?=(isset($id)) ? $id : ''?>">
                                            <input type="hidden" name="editauth"
                                                value="<?=(isset($auth)) ? $auth : ''?>">
                                            <!--begin::Scroll-->
                                            <div class="row d-flex   me-n7 pe-7">

                                                <!--begin::Input group-->
                                                <div class="fv-row mb-7 col-md-6">
                                                    <!--begin::Label-->
                                                    <label class="required fw-semibold fs-6 mb-2">Title</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="staff_title" id="staff_title" required
                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                        placeholder="Title"
                                                        value="<?=(isset($userdata)) ? $userdata->au_title : ''?>" />
                                                    <!--end::Input-->
                                                </div>

                                                <!--begin::Input group-->
                                                <div class="fv-row mb-7 col-md-6">
                                                    <!--begin::Label-->
                                                    <label class="required fw-semibold fs-6 mb-2">Name</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="staff_name" id="staff_name" required
                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                        placeholder="Name"
                                                        value="<?=(isset($userdata)) ? $userdata->au_crickf : ''?>" />
                                                    <!--end::Input-->
                                                </div>


                                                <!--begin::Input group-->
                                                <div class="fv-row mb-7 col-md-6">
                                                    <!--begin::Label-->
                                                    <label class="required fw-semibold fs-6 mb-2">Email</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="staff_email" id="staff_email" required
                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                        placeholder="Email"
                                                        value="<?=(isset($userdata)) ? $userdata->au_cricke : ''?>" />
                                                    <!--end::Input-->
                                                </div>


                                                <!--begin::Input group-->
                                                <div class="fv-row mb-7 col-md-6">
                                                    <!--begin::Label-->
                                                    <label class="required fw-semibold fs-6 mb-2">Employee
                                                        Number</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="staff_empnumber" id="staff_empnumber" required
                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                        placeholder="Employee Number"
                                                        value="<?=(isset($userdata)) ? $userdata->au_emp_number : ''?>" />
                                                    <!--end::Input-->
                                                </div>




                                                <div class="fv-row mb-7 col-md-6">
                                                    <!--begin::Label-->
                                                    <label class="required fw-semibold fs-6 mb-2">Gender</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <select data-parsley-errors-container="#gender-errors" required
                                                        name="staff_gender" id="staff_gender" data-control="select2"
                                                        data-placeholder="Select a Gender" data-hide-search="false"
                                                        class="form-select form-select-solid fw-bold">
                                                        <option></option>
                                                        <option <?=(isset($userdata) && $userdata->au_gender=='Male') ? 'selected' : ''?> value="Male">Male</option>
                                                        <option <?=(isset($userdata) && $userdata->au_gender=='Female') ? 'selected' : ''?> value="Female">Female</option>

                                                    </select>
                                                    <!--end::Input-->
                                                    <div id="gender-errors">    </div>
                                                </div>


                                                <!--end::Input group-->


                                                <div class="fv-row mb-7 col-md-6">
                                                    <!--begin::Label-->
                                                    <label class="required fw-semibold fs-6 mb-2">Department</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <select data-parsley-errors-container="#department-errors" required
                                                        name="staff_department" id="staff_department" data-control="select2"
                                                        data-placeholder="Select a Department" data-hide-search="false"
                                                        class="form-select form-select-solid fw-bold">
                                                        <option></option>
                                                        <?php
if ($department) {
    foreach ($department as $cat) {
        ?>
                                                        <option
                                                            <?=(isset($userdata) &&  $userdata->au_deptarment==strtolower($cat->dp_name)) ? 'selected' : ''?>
                                                            value="<?=strtolower($cat->dp_name)?>">
                                                            <?=ucfirst($cat->dp_name)?>
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
                                                    <select data-parsley-errors-container="#school-errors" required
                                                        name="staff_school" id="staff_school" data-control="select2"
                                                        data-placeholder="Select a School" data-hide-search="false"
                                                        class="form-select form-select-solid fw-bold">
                                                        <option></option>
                                                        <?php
if ($school) {
    foreach ($school as $cat) {
        ?>
                                                        <option
                                                            <?=(isset($userdata) &&  $userdata->au_school==strtolower($cat->campus_name)) ? 'selected' : ''?>
                                                            value="<?=strtolower($cat->campus_name)?>">
                                                            <?=ucfirst($cat->campus_name)?>
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
                                                    <label class="required fw-semibold fs-6 mb-2">Campus</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="staff_campus" id="staff_campus" required
                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                        placeholder="Campus"
                                                        value="<?=(isset($userdata)) ? $userdata->au_campus: ''?>" />
                                                    <!--end::Input-->
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