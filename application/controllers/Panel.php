<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Panel extends MY_Web_Profile_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
 	public function index()
	{
  		 $this->profile();
	}
	public function profile()
	{
  		$header_data = array('page_title' => $this->lang->line('lang_profile_label'));
		$this->load->model("Users_m","users");
		$data['error_message'] ='';
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$data['user_row'] = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(empty($data['user_row']))
			{
				$data['error_message'] = $this->lang->line('lang_sign_in_to_continue_error');
			}
		}
		else
		{
			$data['error_message'] = $this->lang->line('lang_sign_in_to_continue_error');
		}
  		load_web_main_template('profile_v', $header_data,$data);
	}
	public function Payments()
	{
		$header_data = array('page_title' => 'Payments');
		$this->load->model("Users_m","users");
		$data['error_message'] ='';
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
		$row = $this->db->select("*")->where('user_id',$this->session->userdata('MiPlani_user_id'))->limit(1)->order_by('user_id',"DESC")->get("tbl_user_payments")->row();
		$status = $row->payment_status;
		// echo "<pre>";
		// 	print_r ($status);
		// 	echo "</pre>";
		// 	exit();	
		$usertype = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
		$userstatus = $usertype->current_subscription_type;
		// echo "<pre>";
		// print_r ($userstatus);
		// echo "</pre>";
		// exit();
			//$data['user_list'] = $this->users->get_user_list($this->session->userdata('MiPlani_user_id'));

			if($userstatus =='Free' || $status =='inactive')
			{
			$data['user_list'] = $this->users->get_user_list($this->session->userdata('MiPlani_user_id'));
				// echo "<pre>";
				// print_r ($data['user_list']);
				// echo "</pre>";
				// exit();
			}
			else
			{
				$data['payment_list'] = $this->users->get_payments_list($this->session->userdata('MiPlani_user_id'));
			}
		}
		else
		{
			$data['error_message'] = $this->lang->line('lang_sign_in_to_continue_error');
		}
  		load_web_main_template('user_payments_v', $header_data,$data);
 	}
	public function InviteFriends()
	{
		$header_data = array('page_title' => 'Invite Friends');
		$this->load->model("Users_m","users");
		$data['error_message'] ='';
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$data['user_row'] = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(!empty($data['user_row']))
			{
				$data['invite_friends_list'] = $this->users->get_invite_projection_friends_list($this->session->userdata('MiPlani_user_id'));
			}
			else
			{
				$data['error_message'] = $this->lang->line('lang_sign_in_to_continue_error');
			}
		}
		else
		{
			$data['error_message'] = $this->lang->line('lang_sign_in_to_continue_error');
		}
  		load_web_main_template('invite_projection_friends_list_v', $header_data,$data);
 	}
	public function ProfileView()
	{
		$header_data = array('page_title' => 'Profile View');
		$this->load->model("Users_m","users");
		$data['error_message'] ='';
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$data['user_row'] = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(empty($data['user_row']))
			{
				$data['error_message'] = $this->lang->line('lang_sign_in_to_continue_error');
			}
		}
		else
		{
			$data['error_message'] = $this->lang->line('lang_sign_in_to_continue_error');
		}
  		load_web_main_template('profile_view_v', $header_data,$data);
	}
	  public function delete($main_id)
   {
   	   $this->load->model("Users_m","users");	
       $table = "tbl_invite_projection_friends";
       $where = array ("main_id" => $main_id);

       $delete_user = $this->users->delete_record($table,$where);
       if($delete_user)
       {
        redirect(base_url('panel/InviteFriends'));
       }
       else
       {
        echo "something went wrong";
       }

   }
   	public function downloadinvoice()
	{
	
		
	 $this->load->model("Users_m","users");
	 $this->load->helper('download');

	  $download['invoices'] = $this->users->download_invoice();
	  $data = 
	 	$this->load->view('invoice');	
	}
	public function cancelplan($payment_id)
	{
		$update_plan_type = array(
				'payment_status' => 'inactive',
				);
				$this->db->set($update_plan_type);
				$this->db->where("payment_id",$payment_id);
				$this->db->update('tbl_user_payments');
	  	$update_user_array = array(
					'current_subscription_type' => 'Free',
					'user_payment_status' => 'free',
					'plan_id' => 'NULL',
					'subscription_start_date' => 'NULL',
					'subscription_end_date' => 'NULL',
				);
				$this->db->set($update_user_array);
				$this->db->where("user_id",$this->session->userdata('MiPlani_user_id'));
	            $this->db->update('tbl_users');	
	            redirect(base_url('panel/Payments'));
	}

}
