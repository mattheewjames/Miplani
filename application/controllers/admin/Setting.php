<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Setting extends MY_Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Admin_setting_m","setting");
   	}
	/*=================================System Setting=================================*/
	public function index()
	{
 		$this->profile();
	}
 	/*=================================Profile=================================*/
 	public function profile()
	{
 		$header_data = array('page_title' => 'Profile - miplani');
		$data = array();
		if(!empty($this->session->userdata('MiPlani_admin_id')))
		{
			$this->load->model("Admin_user_m","user");
  			$data['row'] = $this->user->get_login_user_row($this->session->userdata('MiPlani_admin_id'));
		}
		load_admin_main_template('admin/update_profile_v', $header_data, $data);
	}
	public function Changepassword()
	{
 		$header_data = array('page_title' => 'Change Password');
		load_admin_main_template('admin/change_password_v', $header_data, '');
	}
}
