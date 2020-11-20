<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Authentication extends MY_Web_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->output->set_header('Access-Control-Allow-Origin: *');
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
      		}
 		}
		switch($id)
		{
 			case 1:$this->sign_up_validation();break;
			case 2:$this->sign_in_validation();break;
			case 3:$this->sign_in_facebook();break;
			case 4:$this->sign_in_google();break;
			case 5:$this->sign_in_linkedin();break;
			case 6:$this->forgot_password_validation();break;
			case 7:$this->reset_password_validation();break;
			
     		default:echo "Default";
 		}
 	}
	/*=================Federated Logins=========================*/
	public function sign_in_google()
	{
		// print_r('aa gaya');
		// exit();
		$userData = array(); 
		//Authenticate user with google
		if(!empty($_POST['user_token']))
		{ 
			
			$id_token = trim($_POST['user_token']);
			require_once APPPATH.'third_party/google_sdk/vendor/autoload.php';
			$this->load->model("Users_m","users");
		
			$userData = array(); 

			// Get $id_token via HTTPS POST.
			$client = new Google_Client(['client_id' => '442403036920-jqo6io369dle3rc8mocdvs9ktbqucis0.apps.googleusercontent.com']);  // Specify the CLIENT_ID of the app that accesses the backend
			$payload = $client->verifyIdToken($id_token);
			$email_verified = $payload['email_verified'];

			if ((!empty($payload) && isset($payload)) && $email_verified == 1) {
				
				// Preparing data for database insertion 
				$userData['oauth_provider'] = 'gmail'; 
				$userData['oauth_uid'] = !empty($payload['sub']) ? $payload['sub']:'';
				$userData['first_name'] = !empty($payload['given_name']) ? $payload['given_name']:''; 
				$userData['last_name'] = !empty($payload['family_name']) ? $payload['family_name']:''; 
				$userData['user_email'] = !empty($payload['email']) ? $payload['email']:''; 
				$userData['user_picture'] = !empty($payload['picture']) ? $payload['picture']:''; 

				// Insert or update user data to the database 
				$userID = $this->users->checkGmailUser($userData);

				// Check user data insert or update status 
				if(!empty($userID)){ 

					//Initiate Session
					//$this->session->set_userdata("MiPlani_user_name", $name);	**do something about it
					$this->session->set_userdata("MiPlani_oauth_provider", 'gmail');
					$this->session->set_userdata("MiPlani_user_id", $userID);
					echo 'done-SEPARATOR-'.'EmptyMsg'.'-SEPARATOR-'.base_url('panel');
					
				} else { 
	
					//Show Error During Login
					echo '<li>'.$this->lang->line('lang_enter_valid_email_error').'</li>';
					
				} 

			} else {

				//Show Error During Login
				echo '<li>'.$this->lang->line('lang_enter_valid_email_error').'</li>';

			}

 	 
        } else { 
			
			//Show Authenticate Error
			echo '<li>Unable To Authenticate, Please Review Your Gmail Settings & Try Again!</li>';
			 
        } 

	}
	protected function sign_in_linkedin(){
		
	}
	/*=================For Password==============================*/
	
	public function forgot_password_validation()
	{
  		$this->load->model("Users_m","user");
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
				$receiver_name = $user_row->first_name." ".$user_row->last_name;
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
						
						$reset_link = base_url('users/ResetPassword?link=').base64_encode($id.$hash.$add_timestamp.$expiry_timestamp);
 						$message_body = $this->emailtemp->WebForgotPasswordTemplate($receiver_name,$reset_link);
					}
					else
					{
 						$message_body ='';
					}
 					$this->smtpemails->send($receiver_email,$message_subject, $message_body);
  					echo 'done-SEPARATOR-'.'An email is sent at your email address to reset password'.'-SEPARATOR-'.base_url('users/SignIn');
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
    	$this->load->model("Users_m","user");
  		$this->form_validation->set_error_delimiters('<li>', '</li>');
		if(empty($this->session->userdata('MiPlani_user_id'))) 
		{
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
										$receiver_name = $user_row->first_name." ".$user_row->last_name;
										if(empty(trim($receiver_name)))
										{
											$receiver_name = 'User';	
										}
										$receiver_email = $user_row->user_email;

										$this->user->update_delete_user_reset_password($reset_password_row->id,$user_row->user_id);
										$message_subject = "Reset Password";
										$link = base_url('users/SignIn');
										$message_body = $this->emailtemp->WebResetPasswordTemplate($receiver_name,$link);
										$this->smtpemails->send($receiver_email,$message_subject, $message_body);
										echo 'done-SEPARATOR-'.'Password reset successfully'.'-SEPARATOR-'.base_url('users/SignIn');
									}
									else
									{
										echo 'Some error has occured, please try again';
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
				echo '<li>We are sorry, the link you requested cannot be found any more!</li>';
			}
		}
		else
		{
			echo "<li>You are already login, you cannot reset password!</li>";
		}
 	}
 	public function check_password_strength() {	

		if(!empty($_POST['new_password'])) {

			$user_password = $this->input->post('new_password');

		} else
		if(!empty($_POST['user_password'])) {

			$user_password = $this->input->post('user_password');

		} else
		if(!empty($_POST['password'])) {

			$user_password = $this->input->post('password');

		} else {
			
			$user_password = '';

		}

		if(!empty($user_password)) {

			$response_msg = check_password_strength($user_password);

			if(empty($response_msg) || $response_msg=='success') {

				return TRUE;

			} else {

				$this->form_validation->set_message('check_password_strength', $response_msg);
				return FALSE;

			}

		} else {

			return TRUE;

		}

	}
	/*=================SignUo validation=========================*/
	protected function sign_up_validation()
	{
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('first_name', '', 'trim|required',array('required' => $this->lang->line('lang_enter_first_name_error')));
		$this->form_validation->set_rules('last_name', '', 'trim|required',array('required' => $this->lang->line('lang_enter_last_name_error')));
		$this->form_validation->set_rules('username', '', 'trim|required|callback_check_add_username',array('required' => $this->lang->line('lang_enter_username_error')));
		$this->form_validation->set_rules('user_email', '', 'trim|required|valid_email|callback_check_add_user_email',
			array(
				'required' => $this->lang->line('lang_enter_email_error'),
				'valid_email' => $this->lang->line('lang_enter_valid_email_error'),
			)
		);
		$this->form_validation->set_rules('password', '', 'trim|required|min_length[8]|max_length[25]',
			array(
				'required' => $this->lang->line('lang_enter_password_error'),
				'min_length' => $this->lang->line('lang_enter_min_password_length_error'),
				'max_length' => $this->lang->line('lang_enter_max_password_length_error'),
			)
		);
		$this->form_validation->set_rules('cpassword', '', 'trim|required|matches[password]',
			array(
				'required' => $this->lang->line('lang_enter_confirm_password_error'),
				'matches' => $this->lang->line('lang_enter_password_match_error'),
			)
		);
		if(empty($_POST['is_agree']))
		{
			$this->form_validation->set_rules('is_agree', '', 'trim|required',array('required' => $this->lang->line('lang_confirm_privacy_policy_error')));
		}
  		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			$this->load->model("Users_m","users");
  			$user_id = $this->users->register_user();
			if(!empty($user_id))
			{
				$user_row = $this->users->get_common_user_row($user_id);
				if(!empty($user_row))
				{
					$verification_link = $user_row->verification_link;
					$verification_link_url = base_url('pages/verification?link=').$verification_link;
					$this->load->library("Smtpemails");
					$this->load->library('Emailtemp');
					$message_subject = $this->lang->line('lang_registration_success_label');
					$message_body = $this->emailtemp->WebSignupTemplate($this->input->post('username'),$verification_link_url);
					$this->smtpemails->send($this->input->post('user_email'),$message_subject, $message_body);
 					echo 'done-SEPARATOR-'.$this->lang->line('lang_registration_successful_message').'-SEPARATOR-'.base_url('pages/SignUpSuccess');
				}
				else
				{
					echo '<li>'.$this->lang->line('lang_refresh_page_error').'</li>';
				}
			}
			else
			{
				echo '<li>'.$this->lang->line('lang_refresh_page_error').'</li>';
			}
		}
	}
	protected function sign_in_validation()
	{
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('user_email', '', 'trim|required|valid_email',
			array(
				'required' => $this->lang->line('lang_enter_email_error'),
				'valid_email' => $this->lang->line('lang_enter_valid_email_error'),
			)
		);
		$this->form_validation->set_rules('password', '', 'trim|required',
			array(
				'required' => $this->lang->line('lang_enter_password_error'),
			)
		);
  		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			$this->load->model("Users_m","users");
  			$user_row = $this->users->get_login_user_row();
			if(!empty($user_row))
			{
				if(!empty($user_row->first_name) && !empty($user_row->last_name))
				{
					$name = $user_row->first_name." ".$user_row->last_name;
				}
				elseif(!empty($user_row->first_name))
				{
					$name = $user_row->first_name;
				}
				elseif(!empty($user_row->last_name))
				{
					$name = $user_row->last_name;
				}
				elseif(!empty($user_row->username))
				{
					$name = $user_row->username;
				}
				else
				{
					$name = $this->lang->line('lang_empty_user_name_label');
				}
				$this->session->set_userdata("MiPlani_user_name",$name);
				$this->session->set_userdata("MiPlani_oauth_provider",$user_row->oauth_provider);
				$this->session->set_userdata("MiPlani_user_id",$user_row->user_id);
				// print_r($this->session->userdata());
				// exit();

				echo 'done-SEPARATOR-'.'EmptyMsg'.'-SEPARATOR-'.base_url();
			}
			else
			{
				echo '<li>'.$this->lang->line('lang_please_enter_valid_login_information_error').'</li>';
			}
		}
	}
	public function check_add_username()
	{
		$this->load->model("Users_m","users");
		if(!empty($_POST['username']))
		{
			if($this->input->post('username') !== str_replace(' ','',$this->input->post('username')) )
			{
				$this->form_validation->set_message('check_add_username', $this->lang->line('lang_enter_username_without_spaces_error'));
				return FALSE;
			}
			elseif($this->users->check_user_columns('username',$this->input->post('username'),'add','0')>0)
			{
				$this->form_validation->set_message('check_add_username', $this->lang->line('lang_enter_username_already_exists_error'));
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
	public function check_add_user_email()
	{
		$this->load->model("Users_m","users");
		if(!empty($_POST['user_email']))
		{
			if($this->input->post('user_email') !== str_replace(' ','',$this->input->post('user_email')) )
			{
				$this->form_validation->set_message('check_add_user_email', $this->lang->line('lang_enter_email_without_spaces_error'));
				return FALSE;
			}
			elseif($this->users->check_user_columns('user_email',$this->input->post('user_email'),'add','0')>0)
			{
				$this->form_validation->set_message('check_add_user_email', $this->lang->line('lang_enter_email_already_exists_error'));
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
	public function verify_user_email() {

		$this->load->model("Users_m","users");
		if(!empty($_POST['user_email'])) {

			if($this->input->post('user_email') !== str_replace(' ','',$this->input->post('user_email')) ) {

				$this->form_validation->set_message('verify_user_email', $this->lang->line('lang_enter_email_without_spaces_error'));
				return FALSE;

			} else
			if($this->users->verify_forgot_password_user_email($this->input->post('user_email')) == 0) {
				$this->form_validation->set_message('verify_user_email', 'No Records Found For This Email. Please Enter Correct Email & Try Again.');
				return FALSE;

			} else {

				return TRUE;

			}

		} else {

			return FALSE;

		}
	}
	
	
	public function check_user_email()
	{
		$this->load->model("Users_m","user");
 		if($this->user->check_user_by_email($this->input->post('user_email'))<1)
		{
			$this->form_validation->set_message('check_user_email', 'We are sorry, email does not exist');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	







}
?>