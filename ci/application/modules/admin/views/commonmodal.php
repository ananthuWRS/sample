<?php
switch($modalname) {
    case 'addTaskCategory':
        ?>
<!--begin::Modal - Add task-->
<div class="modal fade commonmodal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add Category</h2>
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
                        <input type="hidden" name="editid" id="editid"
                            value="<?= (isset($editdata)) ? $editdata->task_categoryid : '' ?>">

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Category Name</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" required name="category_name" id="category_name"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Category name"
                                value="<?= (isset($editdata)) ? $editdata->tc_name : '' ?>" />
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
    case 'addTaskSubCategory':
        ?>
<!--begin::Modal - Add task-->
<div class="modal fade commonmodal" id="commonmodal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add Sub Category</h2>
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
                        <input type="hidden" name="editid" id="editid"
                            value="<?= (isset($editdata)) ? $editdata->subcategoryid : '' ?>">
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2 required">Category</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select required data-dropdown-parent="#commonmodal" id="category" name="category"
                                data-control="select2" data-placeholder="Select a category" data-hide-search="false"
                                class="form-select form-select-solid fw-bold">
                                <option></option>
                                <?php
                                foreach ($category as $cat) {
                                    ?>
                                <option
                                    <?php echo (isset($editdata->sc_categoryid) && $editdata->sc_categoryid==$cat->task_categoryid) ? 'selected' : ''?>
                                    value="<?=$cat->task_categoryid?>"><?=$cat->tc_name?></option>
                                <?php } ?>

                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Sub Category Name</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" required name="sub_category_name" id="sub_category_name"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Sub category name"
                                value="<?= (isset($editdata)) ? $editdata->sc_name : '' ?>" />
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
    case 'addTaskDepartments':
        ?>
<!--begin::Modal - Add task-->
<div class="modal fade commonmodal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add Department</h2>
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
                        <input type="hidden" name="editid" id="editid"
                            value="<?= (isset($editdata)) ? $editdata->departmentid : '' ?>">

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Department Name</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" required name="department_name" id="department_name"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Department name"
                                value="<?= (isset($editdata)) ? $editdata->dp_name : '' ?>" />
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


    case 'addTaskCampus':
        ?>
<!--begin::Modal - Add task-->
<div class="modal fade commonmodal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add School</h2>
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
                        <input type="hidden" name="editid" id="editid"
                            value="<?= (isset($editdata)) ? $editdata->campus_id : '' ?>">

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">School Name</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" required name="campus_name" id="campus_name"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="School name"
                                value="<?= (isset($editdata)) ? $editdata->campus_name : '' ?>" />
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



    case 'addTaskProgram':
        ?>
<!--begin::Modal - Add task-->
<div class="modal fade commonmodal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add Program</h2>
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
                        <input type="hidden" name="editid" id="editid"
                            value="<?= (isset($editdata)) ? $editdata->programmeid : '' ?>">

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Program Name</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" required name="pogram_name" id="pogram_name"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Program name"
                                value="<?= (isset($editdata)) ? $editdata->pg_name : '' ?>" />
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
    case 'assignReportingPerson':
        ?>
<!--begin::Modal - Add task-->
<div class="modal fade commonmodal" id="commonmodal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Assign Reporting Person</h2>
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
                        <input type="hidden" id="staffid" name="staffid" value="<?=$staffid?>">

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2 required">Reporting Person</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select required multiple data-dropdown-parent="#commonmodal" id="reportingperson"
                                name="reportingperson[]" data-control="select2"
                                data-placeholder="Select a Reporting Person" data-hide-search="false"
                                class="form-select form-select-solid fw-bold">
                                <option></option>
                                <?php
                                foreach ($allusers as $cat) {
                                    ?>
                                <option
                                    <?php echo (isset($editdata->sc_categoryid) && $editdata->sc_categoryid==$cat->authenticationid) ? 'selected' : ''?>
                                    value="<?=$cat->authenticationid?>">
                                    <?=$cat->au_title.' '.$cat->au_crickf.'('.$cat->au_cricke.')'?></option>
                                <?php } ?>

                            </select>
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

    case 'viewAssignedStaffs':
        ?>
<!--begin::Modal - Add task-->
<div class="modal fade commonmodal" id="commonmodal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-xl ">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Assigned Staff List</h2>
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
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-3 my-0">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fs-7 fw-bold text-gray-400 ">
                                <th class="p-0 pb-3 min-w-125px text-start">Name</th>
                                <th class="p-0 pb-3 min-w-50px text-start">Emp Number</th>
                                <th class="p-0 pb-3 min-w-125px text-start">Email</th>
                                <th class="p-0 pb-3 min-w-125x text-start ">Department</th>
                                <th class="p-0 pb-3 w-175px text-start ">School</th>
                                <th class="p-0 pb-3 w-50px text-start">Designation</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <?php
                            if ($allusers) {
                                foreach ($allusers as $item) {
                                    ?>
                            <tr>
                                <td><?=ucfirst(strtolower($item->au_title.' '.$item->au_crickf))?></td>
                                <td><?=ucfirst(strtolower($item->au_emp_number))?></td>
                                <td><?=strtolower($item->au_cricke)?></td>
                                <td><?=ucfirst(strtolower($item->au_deptarment))?></td>
                                <td><?=ucfirst(strtolower($item->au_school.' '.$item->au_campus))?></td>
                                <td><?=ucfirst(strtolower($item->au_designation))?></td>
                            </tr>

                            <?php
                                }
                            }

        ?>

                        </tbody>
                        <!--end::Table body-->
                    </table>
                </div>


                <!--begin::Actions-->
                <div class="text-center pt-15">
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

    case 'addTaskTeam':
        ?>
<!--begin::Modal - Add task-->
<div class="modal fade commonmodal" id="commonmodal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Create Team</h2>
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
                        <input type="hidden" name="editid" id="editid"
                            value="<?= (isset($editdata)) ? $editdata->teamid : '' ?>">


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Team Name</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" required name="team_name" id="team_name"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Team name"
                                value="<?= (isset($editdata)) ? $editdata->team_name : '' ?>" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->



                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2 required">Team Members</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select multiple required data-dropdown-parent="#commonmodal" id="teammembers"
                                name="teammembers[]" data-control="select2" data-placeholder="Select Team Members"
                                data-hide-search="false" class="form-select form-select-solid fw-bold">
                                <option></option>
                                <?php
                                foreach ($allusers as $cat) {
                                    ?>
                                <option
                                    <?php echo (isset($teammembers[0]) && in_array($cat->authenticationid, explode(',', $teammembers[0]->teammembers))) ? 'selected' : ''?>
                                    value="<?=$cat->authenticationid?>">
                                    <?=$cat->au_title.' '.$cat->au_crickf.'('.$cat->au_cricke.')'?></option>
                                <?php } ?>

                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2 required">Team Heads</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select required multiple data-dropdown-parent="#commonmodal" id="teamheads"
                                name="teamheads[]" data-control="select2" data-placeholder="Select Team Heads"
                                data-hide-search="false" class="form-select form-select-solid fw-bold">
                                <option></option>
                                <?php
                                foreach ($allusers as $cat) {
                                    ?>
                                <option
                                    <?php echo (isset($teamhead[0]) && in_array($cat->authenticationid, explode(',', $teamhead[0]->teamheads))) ? 'selected' : ''?>
                                    value="<?=$cat->authenticationid?>">
                                    <?=$cat->au_title.' '.$cat->au_crickf.'('.$cat->au_cricke.')'?></option>
                                <?php } ?>

                            </select>
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


    case 'viewReportingPerson':
        ?>
<!--begin::Modal - Add task-->
<div class="modal fade commonmodal" id="commonmodal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Reporting Persons</h2>
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
                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true"
                    data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                    data-kt-scroll-dependencies="#kt_modal_add_user_header"
                    data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">


                    <div class="fv-row">
                        <!--begin::Label-->

                        <!--end::Label-->
                        <!--begin::Table wrapper-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5">
                                <!--begin::Table head-->
                                <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <!-- <th class="w-10px pe-2">#</th> -->
                                        <th class="min-w-125px">Name</th>
                                        <th class="text-end min-w-100px" data-sortable="false">Actions</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-semibold">
                                    <!--begin::Table row-->
                                    <?php
if ($allreportingpersons) {
    foreach ($allreportingpersons as $person) {
        ?>
                                    <tr>
                                        <!-- <td></td> -->
                                        <td class="text-gray-800">
                                            <?=$person->au_title.' '.$person->au_crickf.' ('.$person->au_emp_number.')'?>
                                        </td>
                                        <td>
                                            <a href="javascript:;" data-itemid="<?=$person->reportingid?>"
                                                class="btn btn-light-danger btn-sm  deleteReportingPerson"><i
                                                    class="fas fa-times-circle"></i> Delete</a>
                                        </td>
                                    </tr>
                                    <?php }
    } ?>

                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table wrapper-->
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






    case 'viewStaffTaskStatusDetails':
        ?>
<!--begin::Modal - Add task-->
<div class="modal fade commonmodal" id="commonmodal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Task Status Details</h2>
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
                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true"
                    data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                    data-kt-scroll-dependencies="#kt_modal_add_user_header"
                    data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">


                    <div class="fv-row">
                        <!--begin::Label-->

                        <!--end::Label-->
                        <!--begin::Table wrapper-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5 statusdetailsTable">
                                <!--begin::Table head-->
                                <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2">#</th>
                                        <th class="min-w-125px">Date</th>
                                        <th class="min-w-125px">Status%</th>
                                        <th class="min-w-125px">Time</th>
                                        <th class="min-w-125px">Remarks</th>
                                       


                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-semibold">
                                    <!--begin::Table row-->
                                    <?php

if ($taskStatusDetails) {
    $i=1;
    foreach ($taskStatusDetails as $details) {
        ?>
                                    <tr class="odd">
                                        <td><?=$i?></td>
                                        <td><?=date('d-m-Y', strtotime($details->td_execution_date))?>
                                        </td>
                                        <td><?=$details->td_completion_percentage?></td>
                                       
                                        <td><?=$details->td_hours.' Hrs : '.$details->td_minutes.' Mins'?></td>
                                        <td><?=$details->td_remarks?></td>
                                    </tr>
                                    <?php $i++;
    }
} ?>

                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table wrapper-->
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

    case 'teamView':
        ?>
<!--begin::Modal - Add task-->
<div class="modal fade commonmodal" id="commonmodal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Team Members</h2>
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
                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true"
                    data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                    data-kt-scroll-dependencies="#kt_modal_add_user_header"
                    data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">


                    <div class="fv-row">
                        <!--begin::Label-->

                        <!--end::Label-->
                        <!--begin::Table wrapper-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5 teamdetailsTable">
                                <!--begin::Table head-->
                                <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2">#</th>
                                        <th class="min-w-125px">Name</th>
                                        <th class="min-w-125px">Email</th>
                                        <th class="min-w-125px">Emp Number</th>
                                        <th class="min-w-125px">Department</th>
                                        <th class="min-w-125px">School</th>

                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-semibold">
                                    <!--begin::Table row-->
                                    <?php

                                                                                                if ($taskStatusDetails) {
                                                                                                    $i=1;
                                                                                                    foreach ($taskStatusDetails as $details) {
                                                                                                        ?>
                                    <tr class="odd">
                                        <td><?=$i?></td>
                                        <td><?=$details->au_title.' '.$details->au_crickf?>
                                        </td>
                                        <td><?=$details->au_cricke?></td>
                                        <td><?=$details->au_emp_number?></td>
                                        <td><?=$details->au_deptarment?></td>
                                        <td><?=$details->au_school?></td>
                                    </tr>
                                    <?php $i++;
                                                                                                    }
                                                                                                } ?>

                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table wrapper-->
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

    case 'adminStaffProfileAddTask':
        ?>
<!--begin::Modal - Add task-->
<div class="modal fade commonmodal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add Taks</h2>
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
                <form id="addTaskForm" class="form" action="#" data-parsley-validate>

                    <!--begin::Scroll-->
                    <div class="row d-flex scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header"
                        data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <input type="hidden" name="editid"
                            value="<?=(isset($id)) ? $id : ''?>">
                        <input type="hidden" name="editauth" value="<?=(isset($auth)) ? $auth : ''?>">

                        <!--begin::Input group-->
                        <div class="fv-row mb-7 col-md-12">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Task Name</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="task_name" id="task_name" required
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Task Name"
                                value="<?=(isset($taskDetails)) ? $taskDetails->task_title : ''?>" />
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-7 col-md-6">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Category</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select data-parsley-errors-container="#category-errors" required name="category"
                                id="category" data-control="select2" data-placeholder="Select a Category"
                                data-hide-search="false" class="form-select form-select-solid fw-bold">
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
                            <select data-parsley-errors-container="#subcategory-errors" required name="subcategory"
                                id="subcategory" data-control="select2" data-placeholder="Select a Sub Category"
                                data-hide-search="true" class="form-select form-select-solid fw-bold">
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

                        <div class="fv-row mb-7  col-md-6">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Task Start Date</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" required name="task_date" id="task_date"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Task Start Date"
                                value="" />
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
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Task End Date"
                                value="" />
                            <!--end::Input-->
                        </div>

                        <!--end::Input group-->

                        <!--begin::Input group-->

                        <div class="fv-row mb-7  col-md-6">

                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">Task Details</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea type="text" name="task_details" id="task_details"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Task Details"
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
                            <select data-parsley-errors-container="#priority-errors" name="priority" id="priority"
                                required data-control="select2" data-placeholder="Select a Priority"
                                data-hide-search="true" class="form-select form-select-solid fw-bold">
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

                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-right pt-15">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="submitTask">
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
        break;
}
?>