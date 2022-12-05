<!-- main-content opened -->
<div class="main-content horizontal-content">

    <!-- container opened -->
    <div class="container">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Admin</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/
                    Change Password</span>
                </div>
            </div>
            
        </div>
        <!-- breadcrumb -->

        <!-- row opened -->
        <div class="row row-sm">

            <!--/div-->

            <!--div-->
            <div class="col-md-12">
                <div class="card">


                    <div class="card-body">
                        <h4 class="formmainheading mb-2">Change Password</h4>
                        <form class="form-sample" autocomplete="off" data-parsley-validate id="changepasswordform" data-parsley-trigger="onchange">


                            <div class="formfielddiv">

                                <!-- ROW OPENED  -->
                                <div class="row row-xs mg-b-20">
                                    <div class="col-md-4">
                                        <label class="form-label mg-b-0">Password <?php echo mandatory() ?></label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <input type="password" 
                                        data-parsley-minlength="8"
                                        data-parsley-maxlength="15"
                                        data-parsley-required-message="Please enter your new password."
                                        data-parsley-uppercase="1"
                                        data-parsley-lowercase="1"
                                        data-parsley-number="1"
                                        data-parsley-special="1"
                                        data-parsley-required 
                                        class="form-control" id="password" placeholder="Password">
                                    </div>
                                </div>
                                <!-- /ROW CLOSED  -->

                                <!-- ROW OPENED  -->
                                <div class="row row-xs mg-b-20">
                                    <div class="col-md-4">
                                        <label class="form-label mg-b-0">Confirm Password <?php echo mandatory() ?></label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <input type="password" required class="form-control" data-parsley-equalto="#password" id="confpassword" placeholder="Confirm Password">
                                    </div>
                                </div>
                                <!-- /ROW CLOSED  -->


                          <!-- ROW OPENED  -->
                          <div class="row row-xs mg-b-20">
                            <div class="col-md-4">
                                <label class="form-label mg-b-0"></label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <button class="btn btn-primary mr-2 listbtns addchangepasswordSubmit" id="addchangepasswordSubmit">Submit</button>
                                <a href="javascript:history.go(-1);" class="btn btn-secondary listbtns">Cancel</a>
                            </div>
                        </div>
                        <!-- /ROW CLOSED  -->

                    </div>

                </form>
            </div><!-- bd -->
        </div><!-- bd -->
    </div>
    <!--/div-->


</div>
<!-- /row -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->

<?php $this->view('userdashboard/footer') ?>