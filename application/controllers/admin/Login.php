<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		 header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
		$this->checkLoginStatus();
  	}
	// redirect user to login page if not logged in
	protected function checkLoginStatus() 
	{
		if ($this->session->userdata('MiPlani_admin_id')) 
		{
			redirect(base_admin_url('dashboard'));
		}
	} 
  	public function index()
	{
		$header_data = array('page_title' => 'Login');
		load_admin_login_template('admin/login_v', $header_data,'');
	}
	public function ForgotPassword()
	{
		$header_data = array('page_title' => 'Forgot Password');
		load_admin_login_template('admin/forgot_password_v', $header_data,'');
	}
 	public function ResetPassword()
	{
		$header_data = array('page_title' => 'Reset Password');
		$data['error_message'] = '';
 		if(!empty($_GET['link']))
		{
			$this->load->model("Admin_user_m","user");
			$link = base64_decode($_GET['link']);
			$id = strtok($link,'The');
			if($id>0)
			{
				$reset_password_row = $this->user->get_user_reset_password_row($id);
 				if(!empty($reset_password_row))
				{
 					$expiry_timestamp = $reset_password_row->expiry_timestamp;
 					if($expiry_timestamp>time())
					{
						$data['data_link'] = $_GET['link'];
 					}
					else
					{
  						$data['error_message'] = 'We are sorry, This link is expired, Please try to reset pasword again!';
 					}
				}
				else
				{
 					$data['error_message'] = 'We are sorry, this link is no more available or deleted!';
 				}
			}
			else
			{
 				$data['error_message'] = 'We are sorry, the link you are requesting cannot be found!';
 			}
		}
		else
		{
 			$data['error_message'] = 'We are sorry, the link you are requesting cannot be found!';
 		}
 	    load_admin_login_template('admin/reset_password_v', $header_data, $data); 
	}
 	public function Check()
	{
		return $this->login_validation();
	}
	protected function login_validation()
	{		
 		$this->form_validation->set_error_delimiters('<li>', '</li>');
 		$this->form_validation->set_rules('username', 'username', 'trim|required',
			array('required' => 'Please enter valid username')
		);
		$this->form_validation->set_rules('password', 'Password', 'trim|required',
			array('required' => 'Please enter valid password')
		);
		if($this->form_validation->run() == FALSE)
		{
				echo validation_errors();
		}
		else
		{
			$this->load->model("Admin_user_m","user");
			$row = $this->user->get_login_user_credential();
 			if(!empty($row))
			{
 				if($row->user_id>0)
				{
 					$this->session->set_userdata("MiPlani_admin_id",$row->user_id);
					$this->session->set_userdata("MiPlani_admin_user_type",$row->user_type);
					echo 'done';
				}
				else
				{
 					$this->login_enter_valid_info();
				}
			}
			else
			{
				$this->login_enter_valid_info();
			}
		}
  	}
	protected function login_enter_valid_info()
	{
		echo 'Please enter valid login information';
	}
	public function forgot_password_validation()
	{
  		$this->load->model("Admin_user_m","user");
  		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('user_email', '', 'trim|required|valid_email|callback_check_user_email',
			array(
					'required' => 'Please enter email',
					'valid_email' => 'Please enter valid email'
				 )
		);
		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			$this->load->library("Smtpemails");
  			$this->load->library('Emailtemp');
			$user_row = $this->user->get_user_row_by_email($this->input->post('user_email'));
			if(!empty($user_row)) 
			{
				$receiver_name = $user_row->user_full_name;
				if(empty(trim($receiver_name)))
				{
					$receiver_name = 'User';	
				}
 				$receiver_email = $this->input->post('user_email');
				$message_subject = "Forgot Password";
				
				$id = $this->user->add_user_reset_password($this->input->post('user_email'));
				if($id>0)
				{
					$reset_password_row = $this->user->get_user_reset_password_row($id);
  					if(!empty($reset_password_row))
					{
						$add_timestamp = $reset_password_row->add_timestamp;
						$expiry_timestamp = $reset_password_row->expiry_timestamp;
						$hash = 'The quick brown fox jumps over the lazy dog';
						
						$reset_link = base_admin_url('login/ResetPassword?link=').base64_encode($id.$hash.$add_timestamp.$expiry_timestamp);
 						$message_body = $this->emailtemp->AdminForgotPasswordTemplate($receiver_name,$reset_link);
					}
					else
					{
 						$message_body ='';
					}
 					$this->smtpemails->send($receiver_email,$message_subject, $message_body);
  					echo 'done';
				}
				else
				{
					echo 'Some error has occured, please try again';
				}
			}
		}
	}
 	public function reset_password_validation()
	{
    	$this->load->model("Admin_user_m","user");
  		$this->form_validation->set_error_delimiters('<li>', '</li>');
		if(!empty($_POST['data_link']))
		{
			$link = base64_decode($_POST['data_link']);
			$id = strtok($link,'The');
			if($id>0)
			{
				$reset_password_row = $this->user->get_user_reset_password_row($id);
  				if(!empty($reset_password_row))
				{
					$expiry_timestamp = $reset_password_row->expiry_timestamp;
					if($expiry_timestamp>time())
					{
						$this->form_validation->set_rules('email', '', 'trim|required|valid_email',
							array(
									'required' => 'Please enter email',
									'valid_email' => 'Please enter valid email'
								 )
						);
						if($this->form_validation->run() == FALSE)
						{
							echo validation_errors();
						}
						else
						{
 							if($reset_password_row->email!=$this->input->post('email'))
							{
								echo 'We are sorry, this email is not in our record';
							}
							else
							{
								$this->form_validation->set_rules('password', '', 'trim|required|callback_check_password_strength',
								array(
										'required' => 'Please enter password',
 									 )
								);
								if($this->form_validation->run() == FALSE)
								{
									echo validation_errors();
								}
								else
								{
									$this->form_validation->set_rules('cpassword', '', 'trim|required|matches[password]',
										array(
											'required' => 'Please enter confirm password',
											'matches' => 'password and confirm password not match'
										 )
									);
								
									if($this->form_validation->run() == FALSE)
									{
										echo validation_errors();
									}
									else
									{
										$this->load->library("Smtpemails");
										$this->load->library('Emailtemp');
										$user_row = $this->user->get_user_row_by_email($reset_password_row->email);
										if(!empty($user_row))
										{
											$receiver_name = $user_row->user_full_name;
											if(empty(trim($receiver_name)))
											{
												$receiver_name = 'User';	
											}
											$receiver_email = $user_row->user_email;
											
											$this->user->update_delete_user_reset_password($reset_password_row->id,$user_row->user_id);
 											$message_subject = "Reset Password";
											$link = base_admin_url("login");
											$message_body = $this->emailtemp->AdminResetPasswordTemplate($receiver_name,$link);
											$this->smtpemails->send($receiver_email,$message_subject, $message_body);
											echo 'done';
										}
										else
										{
											echo 'Some error has occured, please try again';
										}
									}
								}
							}
						}
 					}
					else
					{
						echo 'We are sorry, This link is expired, Please try to reset pasword again!';
					}
				}
				else
				{
					echo 'We are sorry, the link you requested cannot be found any more!';	
				}
			}
			else
			{
				echo 'We are sorry, the link you requested cannot be found any more!';
			}
		}
		else
		{
			echo 'We are sorry, the link you requested cannot be found any more!';
		}
 	}
	public function check_user_email()
	{
		$this->load->model("Admin_user_m","user");
 		if($this->user->check_user_by_email($this->input->post('user_email'))<1)
		{
			$this->form_validation->set_message('check_user_email', 'Please enter valid email');
			return FALSE;
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
}
