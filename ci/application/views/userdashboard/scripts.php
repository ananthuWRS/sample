<!--begin::Drawers-->
	  
<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
		<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
		<span class="svg-icon">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
					fill="currentColor" />
				<path
					d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
					fill="currentColor" />
			</svg>
		</span>
		<!--end::Svg Icon-->
	</div>
	<!--end::Scrolltop-->
<!--begin::Javascript-->
<script>var hostUrl = "<?= base_url() ?>components/";
var base_url = '<?=base_url() ?>';
</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="<?= base_url() ?>components/plugins/global/plugins.bundle.js"></script>
		<script src="<?= base_url() ?>components/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->		
		<!--begin::Custom Javascript(used for this page only)-->
		 <script src="<?= base_url() ?>components/js/widgets.bundle.js"></script>
		<script src="<?= base_url() ?>components/js/custom/widgets.js"></script>
        <script src="<?= base_url() ?>components/js/custom/scripts/common.js"></script>	
		<!--end::Javascript-->


        <?php
        if (!empty($externalscript)) {
            foreach ($externalscript as $key => $value) {
        ?>
		        <script src="<?= $value ?>"></script>
		    <?php
            }
        }
        if (!empty($vendorjs)) {
            foreach ($vendorjs as $value) {
            ?>
		        <script src="<?= base_url() ?>components/plugins/<?= $value ?>?v=<?php echo getversion() ?>"></script>
		    <?php

            }
        }
        if (!empty($commonjs)) {
            foreach ($commonjs as $value) {
            ?>
		        <script src="<?= base_url() ?>components/js/<?= $value ?>?v=<?php echo getversion() ?>"></script>
		<?php

            }
        }
        if (!empty($scriptfunctions)) {
            echo '<script type="text/javascript">';
            echo "$(document).ready(function() {";

            foreach ($scriptfunctions as $value) {

                echo $value;
            }

            echo " });";
            echo "</script>";
        }

        if (!empty($scriptnonloadfunctions)) {
            echo '<script type="text/javascript">';

            foreach ($scriptnonloadfunctions as $value) {

                echo $value;
            }

            echo "</script>";
        }
        ?>
<?php if ($this->session->flashdata('successmessage') || $this->session->flashdata('errormessage')) {
    ?>
<script type="text/javascript">

$(document).ready(function() {
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toastr-top-right",
  "preventDuplicates": true,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "linear",
  "hideEasing": "linear",
  "showMethod": "show",
  "hideMethod": "fadeOut"
};
<?php if ($this->session->flashdata('successmessage')) {?>
        toastr.success('<?php echo $this->session->flashdata('successmessage'); ?>');
        <?php }?>
        <?php if ($this->session->flashdata('errormessage')) {?>
        toastr.error('<?php echo $this->session->flashdata('errormessage'); ?>');
        <?php }?>

});
</script>
<?php } ?>
<?php
if($this->session->userdata('usertype') !=1 && ($this->reportingPerson <= 0) ){
?>
<script>
	var now = new Date();
var millisTill10 = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 17, 00, 0, 0) - now;
if (millisTill10 < 0) {
     millisTill10 += 86400000; //24 Hours (hrs)
}
//console.log(millisTill10);
 setTimeout(function(){
	Swal.fire(
				'Please submit your work report',
			  )
			}, millisTill10);

	</script>
<?php	
} 
?>
