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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">View
                        Task</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="<?=base_url()?>staff/tasks" class="text-muted text-hover-primary">Home</a>
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
                        <li class="breadcrumb-item text-muted">View Task</li>
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
                                    <!--begin::Modal body-->
                                    <div class="mx-5 mx-xl-5 my-7 view_task">
                                        <!--begin::Form-->
                                        <form class="form " action="#">
                                            <!--begin::Scroll-->
                                            <div class="row d-flex   me-n7 pe-7"> 
                                            <div>
                                                    <div class="d-flex space-bw purple_bdr_btm align_center pb-3" >
                                                    <div class="d_line1 d-flex ">
                                                        <p><?=(isset($taskDetails)) ? $taskDetails->task_completed_percentage : ''?>%</p><p>|</p><p><?=(isset($taskDetails)) ? $taskDetails->task_title : ''?></p>
                                                    </div>
                                                   <?php 
                                                   switch($taskDetails->task_priority) {
                                                    case 'low':
                                                        $priority= '<span class="badge badge-light-success fs-base">'.ucfirst(strtolower($taskDetails->task_priority)).'</span>';
                                                        break;
                                                    case 'normal':
                                                        $priority= '<span class="badge badge-light-success fs-base">'.ucfirst(strtolower($taskDetails->task_priority)).'</span>';
                                                        break;
                                                    case 'urgent':
                                                        $priority= '<span class="badge badge-light-danger fs-base">'.ucfirst(strtolower($taskDetails->task_priority)).'</span>';
                                                        break;
                                                  } 
                                                  ?>
                                                  <div><p class="m-0"><?= $priority?></p></div>
                                                  
                                                   </div>
                                                    <div class="d-flex space-bw  align_center" >
                                                    <div class="d_line2 d-flex">
                                                        <p><?=(isset($taskDetails)) ? $taskDetails->tc_name : ''?></p><p>|</p><p><?=(isset($taskDetails)) ? $taskDetails->sc_name : ''?></p>
                                                    </div>
                                                    <div class="period_mn"><p>Period : <b><?=(isset($taskDetails)) ? date('d-m-Y',strtotime($taskDetails->task_date)) : ''?></b> to <b><?=(isset($taskDetails) && $taskDetails->task_end_date!="1970-01-01" ) ? date('d-m-Y',strtotime($taskDetails->task_end_date)) : ''?></b></p></div>
                                                    </div>
                                                    <div class="detail_s"><span><?=(isset($taskDetails)) ? $taskDetails->task_details : ''?></span></div>
                                                  </div>
                                            </div>
                                            <!--end::Scroll-->
                                            <!--begin::Actions-->

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