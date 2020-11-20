<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('load_web_main_template'))
{
    function load_web_main_template($current_view, $header_data = array(), $data = array()) 
	{
   		$ci=& get_instance();
		$ci->load->view('web-common-files/header',$header_data);
  		$ci->load->view($current_view,$data);
 		$ci->load->view('web-common-files/footer');
 		return NULL;
	}
}
if(!function_exists('load_web_login_template'))
{
    function load_web_login_template($current_view, $header_data = array(), $data = array()) 
	{
   		$ci=& get_instance();
		$ci->load->view('web-common-files/user-pages-header',$header_data);
  		$ci->load->view($current_view,$data);
 		$ci->load->view('web-common-files/footer');
 		return NULL;
	}
}
?>