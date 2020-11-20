<?php defined('BASEPATH') OR exit('No direct script access allowed');?> 
<link rel="apple-touch-icon" href="<?php echo base_admin_url("app-assets/images/ico/apple-icon-120.png");?>">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
<link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_admin_url("app-assets/css/vendors.min.css");?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_admin_url("app-assets/css/app.min.css");?>">
<?php
if($this->router->class=='login')
{
?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_admin_url("app-assets/css/pages/login-register.min.css");?>">
<?php
}
else
{
?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_admin_url("app-assets/css/core/menu/menu-types/vertical-menu-modern.css");?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_admin_url("app-assets/css/core/colors/palette-gradient.min.css");?>">
	<?php
	if($this->router->class=='dashboard')
	{
	?>
         <!--<link rel="stylesheet" type="text/css" href="<?php echo base_admin_url("app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css");?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_admin_url("app-assets/vendors/css/charts/morris.css");?>">-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_admin_url("app-assets/fonts/simple-line-icons/style.min.css");?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_admin_url("app-assets/css/core/colors/palette-gradient.min.css");?>">
	<?php
	}
	else
	{
	?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_admin_url("app-assets/vendors/css/tables/datatable/datatables.min.css");?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_admin_url("app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css");?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_admin_url("app-assets/vendors/css/extensions/sweetalert.css");?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_admin_url("app-assets/vendors/css/forms/selects/select2.min.css");?>"> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_admin_url("assets/css/DateTimePicker/bootstrap-datetimepicker-standalone.css");?>"> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_admin_url("assets/css/DateTimePicker/bootstrap-datetimepicker.min.css");?>"> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_admin_url("assets/css/DateTimePicker/bootstrap-datetimepicker.css");?>"> 
 	<?php
	}
	?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_admin_url("assets/css/style.css");?>">
<?php 
}
?>