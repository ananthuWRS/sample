<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Work Report</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="<?=base_url()?>" class="text-muted text-hover-primary">Home</a>
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
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                        transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-user-table-filter="search"  
                                class="form-control form-control-solid w-250px ps-14 search-in-table" placeholder="Search" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                           
                          
                            <!--begin::Add user-->
                            <button type="button" class="btn btn-primary addTaskCampus"                                 >
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                            transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->Add School
                            </button>
                            <!--end::Add user-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Group actions-->
                        <div class="d-flex justify-content-end align-items-center d-none"
                            data-kt-user-table-toolbar="selected">
                            <div class="fw-bold me-5">
                                <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected
                            </div>
                            <button type="button" class="btn btn-danger"
                                data-kt-user-table-select="delete_selected">Delete Selected</button>
                        </div>
                        <!--end::Group actions-->
                        
                        
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4 overflow_auto">
                    <!--begin::Table-->
                    <table class="calender_tb table align-middle table-row-dashed fs-6 gy-5" id="kt_table_Campus">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="wi-100" >Employee</th>
                                <th class="">1<p>Mo</p></th> 
                                <th class="">2<p>Tu</p></th> 
                                <th class="">3<p>We</p></th> 
                                <th class="">4<p>Th</p></th> 
                                <th class="">5<p>Fr</p></th> 
                                <th class="">6<p>Sa</p></th> 
                                <th class="">7<p>Su</p></th> 
                                <th class="">8<p>Mo</p></th> 
                                <th class="">9<p>Tu</p></th> 
                                <th class="">10<p>We</p></th> 
                                <th class="">11<p>Th</p></th> 
                                <th class="">12<p>Fr</p></th> 
                                <th class="">13<p>Sa</p></th> 
                                <th class="">14<p>Su</p></th> 
                                <th class="">15<p>Mo</p></th> 
                                <th class="">16<p>Tu</p></th> 
                                <th class="">17<p>We</p></th> 
                                <th class="">18<p>Th</p></th> 
                                <th class="">19<p>Fr</p></th> 
                                <th class="">20<p>Sa</p></th> 
                                <th class="">21<p>Su</p></th> 
                                <th class="">22<p>Mo</p></th> 
                                <th class="">23<p>Tu</p></th> 
                                <th class="">24<p>We</p></th> 
                                <th class="">25<p>Th</p></th> 
                                <th class="">27<p>Fr</p></th> 
                                <th class="">28<p>Sa</p></th> 
                                <th class="">29<p>Su</p></th> 
                                <th class="">30<p>Mo</p></th> 
                                <th class="">31<p>Tu</p></th> 
                              </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="text-gray-600 fw-semibold">
                        <tr class="tb_title">
                            <td colspan="100%">Solutions Pvt Ltd</td> 
                        </tr>
                        <tr>
                            <td  class="wi-100"><div>Ram Kumar</div></td>
                            <td><div class="approve_green">Report</div></td>
                            <td><div class="pending_grey">Report</div></td>
                            <td><div class="finished_orange">Report</div></td>
                            <td> </td>
                            <td> </td>
                            <td><div class="pending_grey">Report</div></td>
                            <td><div class="finished_orange">Report</div></td> 
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td><div>Ram Kumar</div></td>
                            <td><div class="approve_green">Report</div></td>
                            <td><div class="pending_grey">Report</div></td>
                            <td><div class="finished_orange">Report</div></td>
                            <td> </td> 
                            <td><div class="pending_grey">Report</div></td>
                            <td><div class="finished_orange">Report</div></td> 
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
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