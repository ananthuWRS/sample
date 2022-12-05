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
                                                        <p><?=(isset($taskDetails)) ? $taskDetails->tsa_completed_percentage : ''?>%</p><p>|</p><p><?=(isset($taskDetails)) ? $taskDetails->task_title : ''?></p>
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
                                                  <div class="d_line1 d-flex"><p><?=$timeSpent?></p><p>|</p><p class="m-0"><?= $priority?></p></div>
                                                  
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
                                            <div class="card-toolbar">


                                                <div class="text-right pt-10">
                                                    <?php if($taskstaff->tsa_completed_status!='2'){ ?>
                                                    
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
                                                    <?php } ?>
                                                    
                                                </div>
                                            </div>
                                            <!--end::Actions-->
                                        </form>
                                        <!--end::Form-->

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
                                                                <?php if($details->td_approved !='1'){ ?>
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