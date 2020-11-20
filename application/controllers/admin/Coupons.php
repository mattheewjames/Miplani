<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coupons extends MY_Admin_Controller {
	
	public function index() {
		
		$this->data['page_title']='Manage Coupons';
		$coupons = $this->db->query("select * from tbl_coupons order by coupon_id desc")->result();
		$this->data['coupons'] = $coupons;
		
		$header_data = array('page_title' => 'Manage Coupons');
		load_admin_main_template('admin/list_coupons', $header_data,$this->data);
	}

	public function add() {

		$this->data['page_title']='Add coupon - Admin';
		// $this->data['plans'] = $this->db->query("select * from membership_plan ")->result(); 
		// $this->data['users'] = $this->db->query("select ID, fname, lname, email from users ")->result();
		// $this->load->view('admin/add_coupon', $this->data);

		$header_data = array('page_title' => 'Add coupon - Admin');
		load_admin_main_template('admin/add_coupon', $header_data,$this->data);
	}

	public function add_process() {
		
		$this->load->model("Web_setting_m","setting");
		$this->form_validation->set_rules('coupon_code', 'Coupon Code', 'required');
		$this->form_validation->set_rules('frequency', 'Frequency', 'required');
		$this->form_validation->set_rules('coupon_discount_amount', 'coupon discount', 'required');	
		$this->form_validation->set_rules('start_date', 'start date', 'required');	
		$this->form_validation->set_rules('expiry_date', 'expiry date', 'required');	

		if($this->form_validation->run() == FALSE) 
		{
			$error = validation_errors();
			$this->session->set_flashdata('error', $error);    
			redirect('admin/coupons/add');
		}
		else
		{
			$error = '';
			if($this->setting->check_coupon_code($this->input->post('coupon_code'))>0)
			{
				$error =  "Coupon code <strong>".$this->input->post('coupon_code')."</strong> already exists";
				$this->session->set_flashdata('error', $error);    
				redirect('admin/coupons/add');
			}
			else
			{
				if($this->input->post('frequency')<1)
				{
					$error .= 'Please enter frequecncy greater than 0<br>';
				}
				if($this->input->post('coupon_discount_amount')<1 && $this->input->post('coupon_discount_amount')>99)
				{
					$error .= 'Please enter discount between 1-99<br>';
				}


				/*$start_timestamp = strtotime($this->input->post('start_date'));
				$expiry_timestamp = strtotime($this->input->post('expiry_date'));
				$today_time = mktime(23,59,59,date('d'),date('m'),date('Y'));
				if($today_time<$start_timestamp)
				{
					$error .= 'Please select start date greater than or equal to today<br>';
				}
				elseif($expiry_timestamp<$start_timestamp)
				{
					$error .= 'Please select expiry date greater than or equal to start date<br>';
				}*/

				if(!empty($error))
				{
					$this->session->set_flashdata('error', $error);    
					redirect('admin/coupons/add');
				}
				else
				{
					$ins = array();
					$ins['coupon_code'] = $this->input->post('coupon_code');
					$ins['frequency']= $this->input->post('frequency');
					$ins['coupon_discount_amount']= $this->input->post('coupon_discount_amount');
					$ins['coupon_start_date'] = strtotime($this->input->post('start_date'));
					$ins['coupon_expiry_date'] = strtotime($this->input->post('expiry_date'));
					$ins['add_date']= time();
					$ins['coupon_discount_type']= 'percentage';
					$ins['total_usage']= 0;

					$this->db->insert('tbl_coupons',$ins);
					$id=$this->db->insert_id();
					$this->session->set_flashdata('success', 'Coupon added successfully');    
					redirect('admin/coupons');
				}
			}
			
		}

	}


	public  function  delete_coupon() {
		
		$id=$this->input->post('id');
		
		if($id>0) {
			
			$coupon = $this->db->query("SELECT * FROM tbl_coupons WHERE coupon_id='".$id."'")->row();
			
			if($coupon) {
				
				$this->db->delete('tbl_coupons',array('coupon_id'=>$id));
				echo 'success';
				exit();
			}
			else {
				
				echo 'fail';
				exit();
			}
		}
		else {
			
			echo 'fail';
			exit();
		}
	}

	
}

