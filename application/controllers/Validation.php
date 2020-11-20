<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Validation extends MY_Web_Controller 
{
	public function __construct()
	{
		parent::__construct();
 	}	
  	public function index()
	{
		$id = '';
		if(!empty($_GET['id']))
		{
			$id = $this->input->get('id', TRUE);
		}
 		if(is_numeric($id))
		{
			$id = $id;
 		}
		else
		{
			$id = '';
			if(!empty($_GET['id']))
			{
				$id =  base64_decode($this->input->get('id', TRUE));
			}
 			if(!empty($_POST['type']))
			{
				$get_type =  base64_decode($this->input->post('type', TRUE));
 				if($get_type=='projection')
				{
					$id = 6;
				}
				elseif($get_type=='main projection')
				{
					$id = 7;
				}
				elseif($get_type=='dream projection')
				{
					$id = 4;
				}
      		}
 		}
		switch($id)
		{
 			case 1:$this->contact_us_validation();break;
			case 2:$this->update_profile_validation();break;	
 			case 3:$this->change_password_validation();break;
			case 4:$this->delete_dream_projection_validation();break;
			case 5:$this->projection_comment_validation();break;
			case 6:$this->delete_projection_validation();break;
			case 7:$this->delete_main_projection_validation();break;
			case 8:$this->invite_friend_projection_validation();break;
			case 9:$this->invite_friend_main_projection_validation();break;
			case 10:$this->write_a_review_validation();break;
			case 11:$this->newsletter_subscriptions_validation();break;
			case 12:$this->invite_dream_projection_validation();break;
      		default:echo "Default";
 		}
 	}
	/*=================Contact Us validation=========================*/
	protected function projection_comment_validation()
	{
		$this->load->model("Projection_m","projection");
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		if(!empty($_POST['projection_id']))
		{
			$projection_id = base64_decode($this->input->post('projection_id', TRUE));
			if($this->projection->check_active_projection_record($projection_id)>0)
			{
				$this->form_validation->set_rules('name', '', 'trim|required',array('required' => 'Please enter name'));
				$this->form_validation->set_rules('email', '', 'trim|required|valid_email',
					array(
						'required' => 'Please enter email',
						'valid_email' => 'Please enter valid email'
					)
				);
				$this->form_validation->set_rules('comments', '', 'trim|required',array('required' => 'Please enter comment'));
				if($this->form_validation->run() == FALSE)
				{
					echo validation_errors();
				}
				else
				{
					$this->projection->SaveComment();
 					echo 'done-SEPARATOR-add-SEPARATOR-'.base_url('pages/ViewProjection?key_id=').$_POST['projection_id'];
				}
			}
			else
			{
				echo 'Please select valid record';
			}
		}
		else
		{
			echo 'Please select valid record';
		}
  	}
	public function invite_friend_projection_validation()
	{
		$this->load->model("Users_m","users");
		$this->load->model("Projection_m","projection");
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$user_row = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(!empty($user_row))
			{
 				if(!empty($_POST['pid']))
				{
					$projection_id = base64_decode($this->input->post('pid'));
					if($this->projection->check_projection_record($projection_id,$this->session->userdata('MiPlani_user_id'))>0)
					{
						$error = 0;
						if(!empty($_POST['permission']))
						{
							if(!in_array($_POST['permission'],array('view','update')))
							{
								echo 'please select valid permission<br>';
								$error = 1;
							}
						}
						else
						{
							echo 'please select permission<br>';
							$error = 1;
						}
						if(!empty($_POST['email']))
						{
							if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
							{
								echo 'please select valid email<br>';
								$error = 1;
							}
						}
						else
						{
							echo 'please select email<br>';
							$error = 1;
						}
						if($error==0)
						{
							$this->load->library("Smtpemails");
							$this->load->library('Emailtemp');
							$user_message_subject = 'Message sent successfully!';

							$message_subject = 'This is your private Invitation from a friend!';
							//send email 
							$key_url = $this->projection->invite_friend_projection();
							$message_body = $this->emailtemp->InviteProjection($key_url,'sub'); 
							$this->smtpemails->send($this->input->post('email'),$message_subject, $message_body);
							echo 'done-SEPARATOR-update-SEPARATOR-'.base_url('projections');
						}
						
					}
					else
					{
						echo 'Please select valid projection';
					}
 				}
				else
				{
					echo 'Please select valid projection';
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
	public function invite_friend_main_projection_validation()
	{
		$this->load->model("Users_m","users");
		$this->load->model("ProjectionMain_m","projection");
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$user_row = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(!empty($user_row))
			{
 				if(!empty($_POST['pid']))
				{
					$projection_id = base64_decode($this->input->post('pid'));
					if($this->projection->check_projection_record($projection_id,$this->session->userdata('MiPlani_user_id'))>0)
					{
						$error = 0;
						if(!empty($_POST['permission']))
						{
							if(!in_array($_POST['permission'],array('view','update')))
							{
								echo 'please select valid permission<br>';
								$error = 1;
							}
						}
						else
						{
							echo 'please select permission<br>';
							$error = 1;
						}
						if(!empty($_POST['email']))
						{
							if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
							{
								echo 'please select valid email<br>';
								$error = 1;
							}
						}
						else
						{
							echo 'please select email<br>';
							$error = 1;
						}
						if($error==0)
						{
							$this->load->library("Smtpemails");
							$this->load->library('Emailtemp');
							$message_subject = 'Share Projection on MiPlani!';
							//send email 
							$key_url = $this->projection->invite_friend_projection();
							$message_body = $this->emailtemp->InviteProjection($key_url,'main'); 
							$this->smtpemails->send($this->input->post('email'),$message_subject, $message_body);
							echo 'done-SEPARATOR-update-SEPARATOR-'.base_url('projection');
						}
						
					}
					else
					{
						echo 'Please select valid projection';
					}
 				}
				else
				{
					echo 'Please select valid projection';
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
	public function invite_dream_projection_validation()
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
					$projection_id = base64_decode($this->input->post('pid'));
					$row = $this->projection->get_projection_row($projection_id,$this->session->userdata('MiPlani_user_id'));
					if(!empty($row))
					{
						$error = 0;
						if(!empty($_POST['permission']))
						{
							if(!in_array($_POST['permission'],array('view','update')))
							{
								echo 'please select valid permission<br>';
								$error = 1;
							}
						}
						else
						{
							echo 'please select permission<br>';
							$error = 1;
						}
						if(!empty($_POST['email']))
						{
							if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
							{
								echo 'please select valid email<br>';
								$error = 1;
							}
						}
						else
						{
							echo 'please select email<br>';
							$error = 1;
						}
						if($error==0)
						{
							$this->load->library("Smtpemails");
							$this->load->library('Emailtemp');
							$message_subject = 'Share Projection on MiPlani!';
							//send email 
							$key_url = $this->projection->invite_friend_projection();
							$message_body = $this->emailtemp->InviteProjection($key_url,'dream'); 
							$this->smtpemails->send($this->input->post('email'),$message_subject, $message_body);
							if($row->projection_type=='Yearly')
							{
								$url = base_url('dreamProjection');
							}
							elseif($row->projection_type=='6 Months')
							{
								$url = base_url('dreamProjection/Biannual');
							}
							elseif($row->projection_type=='3 Months')
							{
								$url = base_url('dreamProjection/Quarterly');
							}
							else
							{
								$url = base_url('dreamProjection');
							}
							echo 'done-SEPARATOR-update-SEPARATOR-'.$url;
						}
						
					}
					else
					{
						echo 'Please select valid projection';
					}
 				}
				else
				{
					echo 'Please select valid projection';
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
	/*=================Delete Projection validation=========================*/
 	protected function delete_projection_validation()
	{
		$this->load->model("Users_m","users");
		$this->load->model("Projection_m","projection");
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$user_row = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(!empty($user_row))
			{
 				if(!empty($_POST['ids']) && !empty($_POST['type']))
				{
					$projection_id = base64_decode($this->input->post('ids'));
					$type = base64_decode($this->input->post('type'));
					if($type=='projection')
					{
						if($this->projection->check_projection_record($projection_id,$this->session->userdata('MiPlani_user_id'))>0)
						{
							$this->projection->delete_projection_record($projection_id,$this->session->userdata('MiPlani_user_id'));
							echo 'done';
						}
						else
						{
							echo 'Please select valid projection';
						}
					}
					else
					{
						echo 'Please select valid projection';
					}
				}
			}
			else
			{
				echo 'Please login to continue!';
			}
		}
		else
		{
			echo 'Please login to continue!';
		}
	}
	protected function delete_main_projection_validation()
	{
		$this->load->model("Users_m","users");
		$this->load->model("ProjectionMain_m","projection");
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$user_row = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(!empty($user_row))
			{
 				if(!empty($_POST['ids']) && !empty($_POST['type']))
				{
					$projection_id = base64_decode($this->input->post('ids'));
						$type = base64_decode($this->input->post('type'));
					if($type=='main projection')
					{
 						if($this->projection->check_main_projection_record($projection_id,$this->session->userdata('MiPlani_user_id'))>0)
						{
							$this->projection->delete_projection_record($projection_id,$this->session->userdata('MiPlani_user_id'));
							echo 'done';
						}
						else
						{
							echo 'Please select valid projection';
						}
					}
					else
					{
						echo 'Please select valid projection';
					}
				}
			}
			else
			{
				echo 'Please login to continue!';
			}
		}
		else
		{
			echo 'Please login to continue!';
		}
	}
	protected function delete_dream_projection_validation()
	{		$this->load->model("Users_m","users");
		$this->load->model("Dream_projection_m","projection");
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$user_row = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(!empty($user_row))
			{
 				if(!empty($_POST['ids']) && !empty($_POST['type']))
				{
					$projection_id = base64_decode($this->input->post('ids'));
					$type = base64_decode($this->input->post('type'));
					if($type=='dream projection')
					{
 						if($this->projection->check_dream_projection_record($projection_id,$this->session->userdata('MiPlani_user_id'))>0)
						{
							$this->projection->delete_projection_record($projection_id,$this->session->userdata('MiPlani_user_id'));
							echo 'done';
						}
						else
						{
							echo 'Please select valid projection';
						}
					}
					else
					{
						echo 'Please select valid projection';
					}
				}
			}
			else
			{
				echo 'Please login to continue!';
			}
		}
		else
		{
			echo 'Please login to continue!';
		}
	}
	
	protected function write_a_review_validation()
	{
		$this->load->model("Users_m","users");
		$this->load->model("Web_setting_m","setting");
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$user_row = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(!empty($user_row))
			{
 				if($this->setting->is_user_post_review($this->session->userdata('MiPlani_user_id'))<1)
				{
					$this->form_validation->set_rules('rating', '', 'trim|required',array('required' => 'Please select rating'));
 					$this->form_validation->set_rules('review', '', 'trim|required',array('required' => 'Please enter review'));
					if($this->form_validation->run() == FALSE)
					{
						echo validation_errors();
					}
					else
					{
						if($_POST['rating']<1 || $_POST['rating']>5)
						{
							echo 'please select valid rating';
						}
						else
						{
							$this->setting->PostReview();
							echo 'done-SEPARATOR-add-SEPARATOR-'.base_url('reviews'); 
						}
					}

				}
				else
				{
					echo 'You have already post review';
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
	protected function newsletter_subscriptions_validation()
	{
		$this->load->model("Web_setting_m","setting");
		$this->form_validation->set_rules('sub_name', '', 'trim|required',
			array('required' => 'Please enter name')
		);
		$this->form_validation->set_rules('sub_email', '', 'trim|required|valid_email',
			array(
				'required' => $this->lang->line('lang_enter_email_error'),
				'valid_email' => $this->lang->line('lang_enter_valid_email_error'),
			)
		);
		$this->form_validation->set_rules('sub_agree', '', 'trim|required',
			array('required' => 'Please read our terms & condition and select checkbox')
		);
		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			if($this->setting->is_user_subscribe_newsletter($this->input->post('sub_email'))>0)
			{
				echo 'You have already subscribe newsletter';
			}
			else
			{
				$this->setting->NewsletterSubscriptions();
				
				$this->load->library("Smtpemails");
				$this->load->library('Emailtemp');
				$receiver_name = $this->input->post('sub_name');
				$receiver_email = $this->input->post('sub_email');
				$message = 'Newsletter is subscribed successfully!';

				//send email to user
				$message_body = $this->emailtemp->WebNewsletterTemplate($receiver_name);
				$this->smtpemails->send($this->input->post('email'),'newsletter Subscription', $message_body);
				echo 'done-SEPARATOR-subscribe-SEPARATOR-'.base_url(); 
			}
		}
 	}	
	/*=================Password validation=========================*/
	public function change_password_validation()
	{
 		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->load->model("Users_m","users");
		if(!empty($this->session->userdata('MiPlani_user_id'))) 
		{
			$user_row = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(!empty($user_row))
			{
				$this->form_validation->set_rules('old_password', '', 'trim|required|callback_check_user_password',
					array('required' => 'Please enter current password')
				);
				$this->form_validation->set_rules('new_password', '', 'trim|required|min_length[8]|max_length[25]|callback_check_password_strength',
					array(
							'required' => 'Please enter new password',
							'min_length' => 'New password must have minimum 8 characters or numbers',
							'max_length' => 'New password must have maximum 25 characters or numbers',
						 )
				);
				$this->form_validation->set_rules('confirm_password', '', 'trim|required|matches[new_password]',
						array(
							'required' => 'Please enter confirm password',
							'matches' => 'New password and confirm password not match'
						 )
				);
				if($this->form_validation->run() == FALSE)
				{
					echo validation_errors();
				}
				else
				{
 					$this->users->update_user_password();
					//send email
					$this->load->library("Smtpemails");
					$this->load->library('Emailtemp');
					if($user_row->user_password!=md5($this->input->post('new_password')))
					{
						$message_subject = 'Password Changed Successfully!';
						$message_body = $this->emailtemp->WebChangePasswordTemplate($user_row->username);
						$this->smtpemails->send($user_row->user_email,$message_subject, $message_body);
					}
					echo 'done-SEPARATOR-cpass-SEPARATOR-'.base_url('panel');
				}
			}
			else
			{
				echo '<li>Please login again to continue</li>';
			}
		}
		else
		{
			echo "<li>Please login to continue!</li>";
		}
	}
	
	public function update_profile_validation()
	{
		$this->load->model("Users_m","users");
 		$this->form_validation->set_error_delimiters('<li>', '</li>');
		if(!empty($this->session->userdata('MiPlani_user_id'))) 
		{
			$user_row = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(!empty($user_row))
			{
				$this->form_validation->set_rules('first_name', '', 'trim|required',array('required' => 'Please enter first name'));
				$this->form_validation->set_rules('last_name', '', 'trim|required',array('required' => 'Please enter last name'));
				$this->form_validation->set_rules('username', '', 'trim|required|callback_check_update_username',array('required' => 'Please enter username'));
				$this->form_validation->set_rules('user_email', '', 'trim|required|callback_check_update_user_email',array('required' => 'Please enter email'));

				if($this->form_validation->run() == FALSE)
				{
					echo validation_errors();
				}
				else
				{
					$this->users->update_profile();
					//send email
					$this->load->library("Smtpemails");
					$this->load->library('Emailtemp');
					if($user_row->user_email!=$this->input->post('user_email'))
					{
						$message_subject = 'Update Email';
						$message_body = $this->emailtemp->WebChangeEmailTemplate($this->input->post('username'),$this->input->post('user_email'));
						$this->smtpemails->send($user_row->user_email,$message_subject, $message_body);
					}
					else
					{
						$is_send_email = 'No';
						if($user_row->username!=$this->input->post('username'))
						{
							$is_send_email = 'Yes';
						}
						elseif($user_row->user_email!=$this->input->post('user_email'))
						{
							$is_send_email = 'Yes';
						}
						elseif($user_row->first_name!=$this->input->post('first_name'))
						{
							$is_send_email = 'Yes';
						}
						elseif($user_row->last_name!=$this->input->post('last_name'))
						{
							$is_send_email = 'Yes';
						}
						
						if($is_send_email=='Yes')
						{
							$message_subject = 'Update Profile';
							$message_body = $this->emailtemp->WebUpdateProfileTemplate($this->input->post('username'));
							$this->smtpemails->send($this->input->post('user_email'),$message_subject, $message_body);
						}
					}
					echo 'done-SEPARATOR-update-SEPARATOR-'.base_url('panel');
				}
			}
			else
			{
				echo '<li>Please login again to continue</li>';
			}
		}
		else
		{
			echo "<li>Please login to continue!</li>";
		}
	}
 	/*=================Contact Us validation=========================*/
	protected function contact_us_validation()
	{
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('name', '', 'trim|required',array('required' => 'Please enter name'));
		$this->form_validation->set_rules('email', '', 'trim|required|valid_email',
			array(
				'required' => 'Please enter email',
				'valid_email' => 'Please enter valid email'
			)
		);
		$this->form_validation->set_rules('message', '', 'trim|required',array('required' => 'Please enter message'));
  		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			$this->load->library("Smtpemails");
  			$this->load->library('Emailtemp');
			$receiver_name = $this->input->post('name');
			$receiver_email = $this->input->post('email');
			$message = $this->input->post('message');
			$user_message_subject = 'Message sent successfully At Miplani!';
			
			//send email to user
			$message_body = $this->emailtemp->WebContactUsUserTemplate($receiver_name); 
			//$this->smtpemails->send($receiver_email,$user_message_subject, $message_body);
			
			//send email to admin
			$admin_message_subject = "New message from ".$this->input->post('name');
			$admin_message_body = $this->emailtemp->WebContactUsAdminTemplate('Admin');
			$this->smtpemails->send($this->config->config['admin_email'],'Contact Us', $admin_message_body);
 			echo 'done-SEPARATOR-sent-SEPARATOR-'.base_url('pages/ContactUs');
		}
  	}
 	/*=================Common Function=========================*/
 	 
  	public function check_phone_number()
	{
		if(!empty($_POST['phone_number']))
		{
			$phone_number = trim($this->input->post('phone_number'));
		}
 		else
		{
			$phone_number = '';
		}
		if(!empty($phone_number))
		{
			$response_msg = check_phone_number($phone_number);
			if(empty($response_msg) || $response_msg=='success')
			{
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('check_phone_number', $response_msg);
				return FALSE;
			}
		}
		else
		{
			return TRUE;
		}
	}
	
	public function check_password_strength()
	{
		if(!empty($_POST['new_password']))
		{
			$user_password = $this->input->post('new_password');
		}
		elseif(!empty($_POST['user_password']))
		{
			$user_password = $this->input->post('user_password');
		}
		elseif(!empty($_POST['password']))
		{
			$user_password = $this->input->post('password');
		}
		else
		{
			$user_password = '';
		}
		if(!empty($user_password))
		{
			$response_msg = check_password_strength($user_password);
			if(empty($response_msg) || $response_msg=='success')
			{
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('check_password_strength', $response_msg);
				return FALSE;
			}
		}
		else
		{
			return TRUE;
		}
	}
	public function check_user_password()
	{
		$customer_id = 0;
		$this->load->model("Users_m","user");
		if(!empty($this->session->userdata('MiPlani_user_id'))) 
		{
			if($this->user->check_user_password($this->session->userdata('MiPlani_user_id'),$this->input->post('old_password'))<1)
			{
				$this->form_validation->set_message('check_user_password', 'please enter valid current password');
				return FALSE;
			}
 		}
  		else
		{
			return TRUE;
		}
	}
	
	public function check_update_username()
	{
 		$this->load->model("Users_m","user");
		$update_id = $this->session->userdata('MiPlani_user_id');
		if(!empty($_POST['username']))
		{
			if($this->input->post('username') !== str_replace(' ','',$this->input->post('username')) )
			{
				$this->form_validation->set_message('check_update_username', 'Please enter valid username');
				return FALSE;
			}
			elseif($this->user->check_user_columns('username',$this->input->post('username'),'update',$update_id)>0)
			{
				$this->form_validation->set_message('check_update_username', 'This login username already exists!');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			return TRUE;
		}
	}
	public function check_update_user_email()
	{
 		$this->load->model("Users_m","user");
		$update_id = $this->session->userdata('MiPlani_user_id');
		if(!empty($_POST['user_email']))
		{
			$user_email = trim($this->input->post('user_email'));
			if(!filter_var($user_email, FILTER_VALIDATE_EMAIL))
			{
				$this->form_validation->set_message('check_update_user_email', 'Please enter valid email');
				return FALSE;
			}
			elseif($this->input->post('user_email') !== str_replace(' ','',$this->input->post('user_email')) )
			{
				$this->form_validation->set_message('check_update_user_email', 'Please enter valid email');
				return FALSE;
			}
 			elseif($this->user->check_user_columns('user_email',$user_email,'update',$update_id)>0)
			{
				$this->form_validation->set_message('check_update_user_email', 'This email already exists!');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			return TRUE;
		}
	}
}
?>