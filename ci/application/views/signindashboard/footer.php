<!--begin::Javascript-->
<script>
var hostUrl = "<?=base_url()?>components/";
var base_url = '<?=base_url() ?>';
</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="<?=base_url()?>components/plugins/global/plugins.bundle.js"></script>
<script src="<?=base_url()?>components/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="<?=base_url()?>components/js/custom/authentication/sign-in/general.js"></script>
<!--end::Custom Javascript-->

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
<!--end::Javascript-->
</body>
<!--end::Body-->

</html>