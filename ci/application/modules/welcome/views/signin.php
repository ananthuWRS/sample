<!--begin::Root-->
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Page bg image-->
    <style>
    body {
        background-image: url('<?=base_url()?>components/media/auth/bg10.jpeg');
    }

    [data-theme="dark"] body {
        background-image: url('<?=base_url()?>components/media/auth/bg10-dark.jpeg');
    }
    </style>
    <!--end::Page bg image-->
    <!--begin::Authentication - Sign-in -->
     
        <!--begin::Aside-->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid"style="
    background: url(<?=base_url()?>components/media/logos/maxresdefault.jpg);
    background-size: cover;
    background-repeat: no-repeat;">
    <div style="background: #0c0c0c7a;display: flex;width: 100%;padding-right: 30px;">
        <div class="d-flex flex-lg-row-fluid">
            <!--begin::Content-->
            <div class="d-flex flex-column   pb-0 pb-lg-10   w-100" style="padding-left:150px;justify-content: center;">
            <div class="" style="margin-bottom:20px; border-bottom:4px solid #fff;">
		 <img src="<?= base_url() ?>components/media/logos/logo.svg" alt="logo" style="padding-bottom:20px;" />
									</div>
                
                <p class="text-gray-800 fs-2qx fw-bold mb-7" style="
    color: #fff !important;  
    text-transform: uppercase;  
">Work Tracking & Reporting System</p>
                <!--end::Title--> 
            </div>
            <!--end::Content-->
        </div>
        <!--begin::Aside-->
        <!--begin::Body-->
        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-20"style="
    padding-left: 0px !important;">
            <!--begin::Wrapper-->
            <div class="d-flex flex-center  " style="
                border-radius: 0px !important;
                background: #fff !important;
                height: 500px;
                margin: auto;
                ">
                <!--begin::Content-->
                <div style="width: 450px!important;">
                    <!--begin::Form-->
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form"
                         action="#" style=" padding-left: 65px;">
                        <!--begin::Heading-->
                        <!--begin::Heading-->
                        <!--begin::Login options-->
                         
                        <!--end::Login options-->
                        <!--begin::Separator-->
                        <div class="mb-15">
                           <p style=" font-size: 19px;
    font-weight: bold;
    border-bottom: 2px solid #000;">AHEAD</p>
                        </div> 
                        <!--end::Separator-->
                        <div style="padding-right: 65px;">
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <!--begin::Email-->
                            <input type="text" placeholder="Email or Username" name="signupuserName" id="signupuserName" autocomplete="off" 
                                class="form-control bg-transparent" minlength="10" style="    background: transparent !important;
    border-radius: 0px;
    border: 1px solid #ababab !important;
    padding: 5px 7px;"
                            data-fv-string-length___message="Minimum 5 chars required" />
                            <!--end::Email-->
                        </div>
                        <!--end::Input group=-->
                        <div class="fv-row mb-3">
                            <!--begin::Password-->
                            <input type="password" placeholder="Password" name="signupPassword" style="     background: transparent !important;
    border-radius: 0px;
    border: 1px solid #ababab !important;
    padding: 5px 7px;"id="signupPassword" autocomplete="off"
                                class="form-control bg-transparent" />
                            <!--end::Password-->
                        </div>
                        <!--end::Input group=-->
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                            <div></div>
                            <!--begin::Link-->
                            <a href="#"
                                class="link-primary">Forgot Password ?</a>
                            <!--end::Link-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Submit button-->
                        <div class="d-grid mb-10">
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary"style="
    background: #990A5E !important;
    border-radius: 0;
    padding: 8px;">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">SIGN IN</span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                <!--end::Indicator progress-->
                            </button>
                        </div>
                        </div>
                        <!--end::Submit button-->
                        <!--begin::Sign up-->
                        <!-- <div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
                            <a href="../../demo1/dist/authentication/layouts/overlay/sign-up.html"
                                class="link-primary">Sign up</a>
                        </div> -->
                        <!--end::Sign up-->
                    </form>
                    <!--end::Form-->
                </div>
                </div>
                <!--end::Content--> 
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Root-->