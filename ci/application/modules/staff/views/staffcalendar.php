<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Work
                    Report</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="<?=base_url()?>/staff" class="text-muted text-hover-primary">Home</a>
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
                    <li class="breadcrumb-item text-muted">Work Report</li>
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
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">

                            <!--begin::Input group-->
                            <div class="fv-row mb-7   col-md-6">                                
                                <!--begin::Input-->
                                <select  name="month" id="month"
                                    required data-control="select2" data-placeholder="Month"
                                    data-hide-search="true" class="form-select form-select-solid dataselectfilter fw-bold">
                                    <option></option>
                                    <?php for($i=1;$i<=12;$i++) {?>
                                    <option
                                        <?=(isset($month) &&  $month==$i) ? 'selected' : ''?>
                                        value="<?=$i?>"><?=date('M',strtotime('01-'.$i.'-'.date('Y')))?></option>
                                        <?php } ?>                                   
                                </select>                                
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7   col-md-6">                                
                                <!--begin::Input-->
                                <select  name="year" id="year"
                                    required data-control="select2" data-placeholder="Year"
                                    data-hide-search="true" class="form-select form-select-solid dataselectfilter fw-bold">
                                    <option></option>
                                    <?php for($i=1970;$i<=date('Y');$i++) {?>
                                    <option
                                        <?=(isset($year) &&  $year==$i) ? 'selected' : ''?>
                                        value="<?=$i?>"><?=$i?></option>
                                        <?php } ?>
                                   
                                </select>                                
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">


                            <!--begin::Add user-->
                            <a type="button" class="btn btn-primary " href="<?=base_url()?>staff/reportingaddtask">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                            transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->Add Task
                            </a>
                            <!--end::Add user-->
                        </div>
                        <!--end::Toolbar-->



                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4 overflow_auto">
                    <!--begin::Table-->
                    <table class="calender_tb table align-middle table-row-dashed fs-6 gy-5">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="wi-100">Employee</th>
                                <?php

$monthdays=cal_days_in_month(CAL_GREGORIAN, $month, $year);

                        for ($i=1;$i<=$monthdays;$i++) {
                            ?>
                                <th><?=$i.'<p>'.date('D', strtotime($i.'-'.$month.'-'.$year));?></p>
                                </th>
                                <?php } ?>


                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="text-gray-600 fw-semibold">
                            <?php
if ($allusers) {
    foreach ($allusers as $user) {
        ?>


                            <tr>
                                <td class="wi-100">
                                    <div><?=$user->au_title.' '.$user->au_crickf.'('.$user->au_cricke.')'?></div>
                                </td>
                                <?php
                                for ($i=1;$i<=$monthdays;$i++) {
                                    ?>
                                <td><?php
                                $curentDate=date('Y-m-d', strtotime($i.'-'.$month.'-'.$year));


                                    $tasklist = $controller->gettaskonadate($user->authenticationid, $curentDate);

                                    if ($tasklist) {
                                        foreach ($tasklist as $task) {
                                            switch($task->tsa_approved) {
                                                case '1':
                                                    $color='approve_green';
                                                    break;
                                                case '2':
                                                    $color='finished_orange';
                                                    break;
                                                case '0':
                                                    $color='pending_grey';
                                                    break;
                                            }

                                            $auth= $controller->checksumgen($task->taskid);
                                            echo '<div class="'.$color.'"><a href="'.base_url().'staff/viewfinishedtaskbyreporting/'.$task->taskid.'/'.$auth.'/'.$task->tsa_staffid.'">'.(($task->tsa_completed_percentage>0) ? $task->tsa_completed_percentage : '0').'% | '.ucfirst(strtolower($task->task_title)).'</a></div>';
                                        }
                                    }

                                    ?></td>
                                <?php } ?>
                            </tr>
                            <?php
    }
}
                        ?>


                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
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