<?php defined('BASEPATH') OR exit('No direct script access allowed');?> 
<script src="<?php echo base_admin_url("app-assets/vendors/js/vendors.min.js");?>" type="text/javascript"></script>
<script src="<?php echo base_admin_url('app-assets/vendors/js/extensions/moment.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_admin_url('assets/js/jsconfig.js');?>" type="text/javascript"></script>
<script src="<?php echo base_admin_url('assets/js/loadingoverlay.min.js');?>" type="text/javascript" ></script>
<?php
if($this->router->class=='login')
{
?>	
	<script src="<?php echo base_admin_url('assets/js/login.js');?>" type="text/javascript" ></script>
<?php
}
else
{
?>
	<script src="<?php echo base_admin_url('app-assets/js/core/app-menu.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_admin_url('app-assets/js/core/app.min.js');?>" type="text/javascript"></script>
    <?php
	if($this->router->class=='dashboard')
	{
	?>	
 	<?php	
	}
	else
	{
	?>	
		<script src="<?php echo base_admin_url('app-assets/vendors/js/tables/datatable/datatables.min.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_admin_url('app-assets/vendors/js/extensions/sweetalert.min.js');?>" type="text/javascript" ></script>
        <script src="<?php echo base_admin_url('app-assets/js/scripts/customizer.min.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_admin_url('app-assets/js/scripts/tables/datatables/datatable-basic.js');?>" type="text/javascript"></script>
   	<?php	
	}
	?>
    <script type="text/ecmascript" src="<?php echo base_admin_url("assets/js/DateTimePicker/bootstrap-datetimepicker.min.js");?>"></script>
	<script src="<?php echo base_admin_url('app-assets/vendors/js/forms/select/select2.full.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_admin_url('app-assets/js/scripts/forms/select/form-select2.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_admin_url('assets/js/functions.js');?>" type="text/javascript" ></script>
 <?php	   
}




