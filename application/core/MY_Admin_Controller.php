<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Admin_Controller extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->checkLoginStatus();
  	}
	// redirect user to login page if not logged in
	protected function checkLoginStatus() 
	{
		if (!$this->session->userdata('MiPlani_admin_id')) 
		{
			redirect(base_admin_url('login'));
		}
	} 
	public function get_login_user_row()
	{
		if(!empty($this->session->userdata('MiPlani_admin_id')))
		{ 
			$this->load->model("Admin_user_m","user");
			return $this->user->get_login_user_row($this->session->userdata('MiPlani_admin_id'));
		}
	}
	public function get_package_name($package_id)
	{
		$this->load->model("Packages_m","package");
		return $this->package->get_package_name($package_id);
 	}
	public function get_customer_call_follow_up_row($id)
	{
		$this->load->model("Customer_m","customer");
		return $this->customer->get_customer_call_follow_up_row($id);
 	}
	
}
?>