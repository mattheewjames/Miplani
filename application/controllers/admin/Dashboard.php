<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends MY_Admin_Controller 
{
 	public function index()
	{
		$this->load->model("Admin_setting_m","setting");
		$header_data = array('page_title' => 'Dashboard');
		$data['total_users'] = $this->db->query("select count(*) as cnt from tbl_users")->row()->cnt;
		$data['total_projections'] = $this->db->query("select count(*) as cnt from tbl_projections")->row()->cnt;
		$data['total_earning'] = $this->db->query("select sum(user_paid_amount) as total_earning from tbl_user_payments")->row()->total_earning;
		load_admin_main_template('admin/dashboard_v', $header_data,$data);
	}
}
