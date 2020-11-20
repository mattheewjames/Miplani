<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DreamProjection extends MY_Web_Profile_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$header_data = array('page_title' => 'Your Saved Dream Financial Goal');
		$this->load->model("Users_m","users");
		$this->load->model("Dream_projection_m","projection");
		$data['error_message'] ='';
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$data['user_row'] = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(!empty($data['user_row']))
			{
				
				$data['projection_list'] = $this->projection->get_user_wise_projection_list($this->session->userdata('MiPlani_user_id'),'Yearly');
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
  		load_web_main_template('dream_yearly_projection_v', $header_data,$data);
 	}
 	public function Create()
	{
    	$header_data = array('page_title' => 'Create Dream Financial Goal');
		$this->load->model("Users_m","users");
		$data['error_message'] ='';
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$data['user_row'] = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(!empty($data['user_row']))
			{
				$data['error_message'] = $this->lang->line('lang_sign_in_to_continue_error');
			}
		}
		else
		{
			$data['error_message'] = $this->lang->line('lang_sign_in_to_continue_error');
		}
  		load_web_main_template('create_dream_yearly_projection_v', $header_data,$data);
	}
	
 	public function Biannual()
	{
		//6 Months
		$header_data = array('page_title' => 'Your Saved Biannual Dream Financial Goal');
		$this->load->model("Users_m","users");
		$this->load->model("Dream_projection_m","projection");
		$data['error_message'] ='';
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$data['user_row'] = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(!empty($data['user_row']))
			{
				
				$data['projection_list'] = $this->projection->get_user_wise_projection_list($this->session->userdata('MiPlani_user_id'),'6 Months');
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
  		load_web_main_template('dream_biannual_projection_v', $header_data,$data);
 	}
 	public function CreateBiannualGoal()
	{
		//6 Months
    	$header_data = array('page_title' => 'Create Biannual Dream Financial Goal');
		$this->load->model("Users_m","users");
		$data['error_message'] ='';
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$data['user_row'] = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(!empty($data['user_row']))
			{
				$data['error_message'] = $this->lang->line('lang_sign_in_to_continue_error');
			}
		}
		else
		{
			$data['error_message'] = $this->lang->line('lang_sign_in_to_continue_error');
		}
  		load_web_main_template('create_dream_biannual_projection_v', $header_data,$data);
	}
	
 	public function Quarterly()
	{
		//3 Months
		$header_data = array('page_title' => 'Your Saved Quarterly Dream Financial Goal');
		$this->load->model("Users_m","users");
		$this->load->model("Dream_projection_m","projection");
		$data['error_message'] ='';
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$data['user_row'] = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(!empty($data['user_row']))
			{
				
				$data['projection_list'] = $this->projection->get_user_wise_projection_list($this->session->userdata('MiPlani_user_id'),'3 Months');
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
  		load_web_main_template('dream_quarterly_projection_v', $header_data,$data);
 	}
 	public function CreateQuarterlyGoal()
	{
		//3 Months
    	$header_data = array('page_title' => 'Create Quarterly Dream Financial Goal');
		$this->load->model("Users_m","users");
		$data['error_message'] ='';
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$data['user_row'] = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(!empty($data['user_row']))
			{
				$data['error_message'] = $this->lang->line('lang_sign_in_to_continue_error');
			}
		}
		else
		{
			$data['error_message'] = $this->lang->line('lang_sign_in_to_continue_error');
		}
  		load_web_main_template('create_dream_quarterly_projection_v', $header_data,$data);
	}
	public function CopyProjection()
	{
 		$this->load->model("Users_m","users");
		$this->load->model("Dream_projection_m","projection");
 		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$user_row = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(!empty($user_row))
			{
				if(!empty($_POST['pid']))
				{
					$projection_id = base64_decode($this->input->post('pid', TRUE));
					$row = $this->projection->get_projection_row($projection_id,$this->session->userdata('MiPlani_user_id'));
					if(!empty($row))
					{
						$this->projection->CopyProjection($projection_id);
						echo 'Projection copied successfully!';
					}
					else
					{
						echo 'Please select valid record';;
					}
				}
				else
				{
					echo 'Please select valid record';
				}
 			}
			else
			{
				echo $this->lang->line('lang_sign_in_to_continue_error');
			}
		}
		else
		{
			echo $this->lang->line('lang_sign_in_to_continue_error');
		}
	}
	public function Update()
	{
		$header_data = array('page_title' => 'Update Projection');
		$this->load->model("Users_m","users");
		$this->load->model("Dream_projection_m","projection");
		$data['error_message'] ='';
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$data['user_row'] = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(!empty($data['user_row']))
			{
				if(!empty($_GET['key_id']))
				{
					$projection_id = base64_decode($this->input->get('key_id', TRUE));
					$data['row'] = $this->projection->get_projection_row($projection_id,$this->session->userdata('MiPlani_user_id'));
					if(empty($data['row']))
					{
						$data['error_message'] = 'Please select valid record';
					}
				}
				else
				{
					$data['error_message'] = 'Please select valid record';
				}
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
    	load_web_main_template('update_dream_projection_v', $header_data,$data);
	}
}
