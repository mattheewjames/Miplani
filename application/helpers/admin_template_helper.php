<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('load_admin_main_template'))
{
    function load_admin_main_template($current_view, $header_data = '', $data = '') 
	{
  		$ci=& get_instance();
		$menu_data = array();
      	$ci->load->view('admin/admin-common-files/header',$header_data);
 		$ci->load->view('admin/admin-common-files/top_menu');
		$ci->load->view('admin/admin-common-files/left_menu');
 		$ci->load->view($current_view,$data);
   		$ci->load->view('admin/admin-common-files/pages-footer');
		return NULL;
	}
}
if(!function_exists('load_admin_login_template'))
{
 	function load_admin_login_template($current_view, $header_data = '', $data = '') 
	{
  		$ci=& get_instance();
  		$ci->load->view('admin/admin-common-files/header',$header_data);
 		$ci->load->view($current_view,$data);
   		$ci->load->view('admin/admin-common-files/footer');
		return NULL;
	}  
}
?>