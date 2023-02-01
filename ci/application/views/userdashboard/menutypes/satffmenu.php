 <!--begin::Menu-->
 <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true"
     data-kt-menu-expand="false">
     <!--begin:Menu item-->
     <div class="menu-item here show menu-accordion">
         <!--begin:Menu link-->
         <span class="menu-link">
             <span class="menu-icon">
                 <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                 <span class="svg-icon svg-icon-2">
                     <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
                         <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
                         <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
                         <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
                     </svg>
                 </span>
                 <!--end::Svg Icon-->
             </span>
             <a class="menu-link" href="<?=base_url('staff')?>" style="padding-left:0px">
                 <span class="menu-title">Dashboard</span></a>
         </span>
         <!--end:Menu link-->
     </div>
     <!--end:Menu item-->
     <!--begin:Menu item-->
     <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
         <!--begin:Menu link-->
         <span class="menu-link">
             <span class="menu-icon">
                 <!--begin::Svg Icon | path: icons/duotune/abstract/abs029.svg-->
                 <span class="svg-icon svg-icon-2">
                     <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <path
                             d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z"
                             fill="currentColor"></path>
                         <path opacity="0.3"
                             d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z"
                             fill="currentColor"></path>
                     </svg>
                 </span>
                 <!--end::Svg Icon-->
             </span>
             <span class="menu-title">My Tasks</span>
             <span class="menu-arrow"></span>
         </span>
         <!--end:Menu link-->
         <!--begin:Menu sub-->
         <div class="menu-sub menu-sub-accordion">
             <!--begin:Menu item-->

             <!--begin:Menu sub-->
             <div class="menu-sub menu-sub-accordion">
                 <!--begin:Menu item-->
                 <div class="menu-item">
                     <!--begin:Menu link-->
                     <a class="menu-link" href="<?=base_url()?>staff/tasks">
                         <span class="menu-bullet">
                             <span class="bullet bullet-dot"></span>
                         </span>
                         <span class="menu-title">Tasks List</span>
                     </a>
                     <!--end:Menu link-->
                 </div>
                 <!--end:Menu item-->
                 <!--begin:Menu item-->
                 <div class="menu-item">
                     <!--begin:Menu link-->
                     <a class="menu-link" href="<?=base_url()?>staff/finishedtasks">
                         <span class="menu-bullet">
                             <span class="bullet bullet-dot"></span>
                         </span>
                         <span class="menu-title">Finished Tasks List</span>
                     </a>
                     <!--end:Menu link-->
                 </div>
                 <!--end:Menu item-->
                 <!--begin:Menu item-->
                 <div class="menu-item">
                     <!--begin:Menu link-->
                     <a class="menu-link" href="<?=base_url()?>staff/rejectedtasks">
                         <span class="menu-bullet">
                             <span class="bullet bullet-dot"></span>
                         </span>
                         <span class="menu-title">Rejected Tasks List</span>
                     </a>
                     <!--end:Menu link-->
                 </div>
                 <!--end:Menu item-->
             </div>
             <div class="menu-sub menu-sub-accordion">
                 <!--begin:Menu item-->
                 <div class="menu-item">
                     <!--begin:Menu link-->
                     <a class="menu-link" href="<?=base_url()?>staff/calendar">
                         <span class="menu-bullet">
                             <span class="bullet bullet-dot"></span>
                         </span>
                         <span class="menu-title">Calendar</span>
                     </a>
                     <!--end:Menu link-->
                 </div>
                 <!--end:Menu item-->
             </div>


             <!--end:Menu item-->
         </div>
     </div>


     <?php if ($this->reportingPerson > 0) { ?>
     <!--begin:Menu item-->
     <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
         <!--begin:Menu link-->
         <span class="menu-link">
             <span class="menu-icon">
                 <!--begin::Svg Icon | path: icons/duotune/abstract/abs029.svg-->
                 <span class="svg-icon svg-icon-2">
                     <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <path
                             d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z"
                             fill="currentColor"></path>
                         <path opacity="0.3"
                             d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z"
                             fill="currentColor"></path>
                     </svg>
                 </span>
                 <!--end::Svg Icon-->
             </span>
             <span class="menu-title">Manage Tasks</span>
             <span class="menu-arrow"></span>
         </span>
         <!--end:Menu link-->
         <!--begin:Menu sub-->
         <div class="menu-sub menu-sub-accordion">
             <!--begin:Menu item-->

             <!--begin:Menu sub-->
             <div class="menu-sub menu-sub-accordion">
                 <!--begin:Menu item-->
                 <div class="menu-item">
                     <!--begin:Menu link-->
                     <a class="menu-link" href="<?=base_url()?>staff/reportingstafftasks">
                         <span class="menu-bullet">
                             <span class="bullet bullet-dot"></span>
                         </span>
                         <span class="menu-title">Tasks List</span>
                     </a>
                     <!--end:Menu link-->
                 </div>
                 <!--end:Menu item-->

                 <!--begin:Menu item-->
                 <div class="menu-item">
                     <!--begin:Menu link-->
                     <a class="menu-link" href="<?=base_url()?>staff/reportingstafftasksfinished">
                         <span class="menu-bullet">
                             <span class="bullet bullet-dot"></span>
                         </span>
                         <span class="menu-title">Finished Tasks List</span>
                     </a>
                     <!--end:Menu link-->
                 </div>
                 <!--end:Menu item-->
             </div>



             <!--end:Menu item-->
         </div>
     </div>
     <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
         <!--begin:Menu link-->
         <span class="menu-link">
             <span class="menu-icon">
                 <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2022-10-09-043348/core/html/src/media/icons/duotune/abstract/abs027.svg-->
                 <span class="svg-icon svg-icon-muted svg-icon-2hx">
                     <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <path
                             d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z"
                             fill="currentColor"></path>
                         <path
                             d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z"
                             fill="currentColor"></path>
                         <path opacity="0.3"
                             d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z"
                             fill="currentColor"></path>
                         <path opacity="0.3"
                             d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z"
                             fill="currentColor"></path>
                     </svg>
                 </span>
                 <!--end::Svg Icon-->
             </span>
             <span class="menu-title">Manage Category</span>
             <span class="menu-arrow"></span>
         </span>
         <!--end:Menu link-->
         <!--begin:Menu sub-->
         <div class="menu-sub menu-sub-accordion">
             <!--begin:Menu item-->
             <div class="menu-item">
                 <!--begin:Menu link-->
                 <a class="menu-link" href="<?=base_url()?>admin/taskcategory">
                     <span class="menu-bullet">
                         <span class="bullet bullet-dot"></span>
                     </span>
                     <span class="menu-title">Task Category</span>
                 </a>
                 <!--end:Menu link-->
             </div>
             <!--end:Menu item-->
             <!--begin:Menu item-->
             <div class="menu-item">
                 <!--begin:Menu link-->
                 <a class="menu-link" href="<?=base_url()?>admin/tasksubcategory">
                     <span class="menu-bullet">
                         <span class="bullet bullet-dot"></span>
                     </span>
                     <span class="menu-title">Task Sub Category</span>
                 </a>
                 <!--end:Menu link-->
             </div>
             <!--end:Menu item-->
         </div>
         <!--end:Menu sub-->
     </div>
     <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
         <!--begin:Menu link-->
         <span class="menu-link">
             <span class="menu-icon">
                 <!--begin::Svg Icon | path: icons/duotune/abstract/abs029.svg-->
                 <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24"
                         fill="none" xmlns="http://www.w3.org/2000/svg">
                         <path
                             d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                             fill="currentColor" />
                         <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor" />
                     </svg>
                 </span>
                 <!--end::Svg Icon-->
             </span>
             <span class="menu-title">Staff Management</span>
             <span class="menu-arrow"></span>
         </span>
         <!--end:Menu link-->
         <!--begin:Menu sub-->
         <div class="menu-sub menu-sub-accordion">
             <!--begin:Menu item-->

             <!--begin:Menu sub-->
             <div class="menu-sub menu-sub-accordion">
                 <!--begin:Menu item-->
                 <div class="menu-item">
                     <!--begin:Menu link-->
                     <a class="menu-link" href="<?=base_url()?>staff/stafflist">
                         <span class="menu-bullet">
                             <span class="bullet bullet-dot"></span>
                         </span>
                         <span class="menu-title">Staff List</span>
                     </a>                    
                     <!--end:Menu link-->
                 </div>
                 <!--end:Menu item-->
             </div>
             <div class="menu-sub menu-sub-accordion">
                 <!--begin:Menu item-->
                 <div class="menu-item">
                     <!--begin:Menu link-->
                     <a class="menu-link" href="<?=base_url()?>staff/staffcalendar">
                         <span class="menu-bullet">
                             <span class="bullet bullet-dot"></span>
                         </span>
                         <span class="menu-title">Staff Calendar</span>
                     </a>                    
                     <!--end:Menu link-->
                 </div>
                 <!--end:Menu item-->
             </div>
             
         </div>
         <!--end:Menu sub-->
     </div>

     <?php } else {
         ?>
     <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
         <!--begin:Menu link-->
         <span class="menu-link">
             <span class="menu-icon">
                 <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2022-10-09-043348/core/html/src/media/icons/duotune/abstract/abs027.svg-->
                 <span class="svg-icon svg-icon-muted svg-icon-2hx">
                     <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <path
                             d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z"
                             fill="currentColor"></path>
                         <path
                             d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z"
                             fill="currentColor"></path>
                         <path opacity="0.3"
                             d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z"
                             fill="currentColor"></path>
                         <path opacity="0.3"
                             d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z"
                             fill="currentColor"></path>
                     </svg>
                 </span>
                 <!--end::Svg Icon-->
             </span>
             <span class="menu-title">Manage Category</span>
             <span class="menu-arrow"></span>
         </span>
         <!--end:Menu link-->
         <!--begin:Menu sub-->
         <div class="menu-sub menu-sub-accordion">

             <!--begin:Menu item-->
             <div class="menu-item">
                 <!--begin:Menu link-->
                 <a class="menu-link" href="<?=base_url()?>admin/tasksubcategory">
                     <span class="menu-bullet">
                         <span class="bullet bullet-dot"></span>
                     </span>
                     <span class="menu-title">Task Sub Category</span>
                 </a>
                 <!--end:Menu link-->
             </div>
             <!--end:Menu item-->
         </div>
         <!--end:Menu sub-->
     </div>
     <?php
     } ?>





 </div>


 <!--end::Menu-->
 <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/63d890fcc2f1ac1e20307d33/1go2vcnln';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->