<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends MY_Web_Login_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->output->set_header('Access-Control-Allow-Origin: *');
		$this->load->library('facebook');
		$this->load->library("Google");

		 //$this->load->library('libraries/linkedin/src/LinkedIn/Client');
	}
 	public function index()
	{
  		 $this->SignUp();
	}
	public function fb()
	{
		$this->load->library('facebook');
		$this->load->model("Users_m","user");
        // Check if user is logged in
        if($this->facebook->is_authenticated())
		{
 			$this->facebook->destroy_session();
            // Get user facebook profile details
            $fbUser = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture');
            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid'] = !empty($fbUser['id'])?$fbUser['id']:'';;
            $userData['first_name'] = !empty($fbUser['first_name'])?$fbUser['first_name']:'';
            $userData['last_name'] = !empty($fbUser['last_name'])?$fbUser['last_name']:'';
            $userData['email'] = !empty($fbUser['email'])?$fbUser['email']:'';
            $userData['gender'] = !empty($fbUser['gender'])?$fbUser['gender']:'';
            $userData['picture'] = !empty($fbUser['picture']['data']['url'])?$fbUser['picture']['data']['url']:'';
            $userData['links'] = !empty($fbUser['link'])?$fbUser['link']:'';
            
            // Insert or update user data
            $user_id = $this->user->add_fb_user($userData);
            // Check user data insert or update status
            if(!empty($user_id))
			{
 				$this->session->set_userdata("MiPlani_oauth_provider","facebook");
				$this->session->set_userdata("MiPlani_user_id",$user_id);
				redirect(base_url('panel'));
            }
			else
			{
              redirect(base_url());
            }
            exit;
            // Get logout URL
            $data['authURL'] = $this->facebook->logout_url();
        }
		else
		{
            // Get login URL
            $data['authURL'] =  $this->facebook->login_url();
        }
 	}
	public function SignUp()
	{
		$header_data = array('page_title' => $this->lang->line('lang_sign_up_label'));
		$data['authURL'] = '';
		if($this->facebook->is_authenticated())
		{
			$data['authURL'] = $this->facebook->logout_url();
		}
		else
		{
			 $data['authURL'] =  $this->facebook->login_url();
		}
		$data['gmail_url'] = $this->google->getLoginUrl();
		// $data['oauth2URL'] = $this->login_linkedin();

		// $data['twitter_url'] = $this->login_twitter();
		// $data['linkedin_url'] = $this->linkedin->get_request_token();
  		load_web_main_template('sign_up_v', $header_data,$data);
	}
	public function SignIn()
	{
		$header_data = array('page_title' => $this->lang->line('lang_sign_in_label'));
		$data['authURL'] = '';
		if($this->facebook->is_authenticated())
		{
			$data['authURL'] = $this->facebook->logout_url();
		}
		else
		{
			 $data['authURL'] =  $this->facebook->login_url();
		}

		$data['gmail_url'] = $this->google->getLoginUrl();
		
  		load_web_main_template('sign_in_v', $header_data,$data);
	}
	
	public function ForgotPassword()
	{
		$header_data = array('page_title' => $this->lang->line('lang_forgot_password_label'));
  		load_web_main_template('forgot_password_v', $header_data,'');
	}
	public function ResetPassword()
	{
		$header_data = array('page_title' => $this->lang->line('lang_reset_password_label'));
		$data['error_message'] = '';
 		if(!empty($_GET['link']))
		{
			$this->load->model("Users_m","user");
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
 	    load_web_main_template('reset_password_v', $header_data, $data); 
	}


	public function google_callback() {
	
		$this->google->setAccessToken();
        $userData = $this->google->getUserInfo();
        $google_username="";
        if (empty($userData['name'])) {
            $email_parts = explode("@", $userData['email']);
            $google_username = $email_parts[0];
        } else {
			//$google_username = preg_replace('/\s+/', ' ', $userData['name']);
            $google_username = $userData['name'];
        }
		// echo '<pre>'; print_r($userData); echo '</pre>'; exit('Exit');
        //$password = mt_rand(10000000, 99999999);
        $this -> db -> select('user_id,username,user_email,first_name,last_name,is_verify_email,user_status');
	    $this -> db -> from('tbl_users');
	    $this -> db -> where('user_email', $userData['email']);
	    //$this -> db -> where('password', md5($password));
	    $this -> db -> limit(1);
	    $query = $this->db->get(); 
	    // print_r($query);
	    // exit();
		if($query -> num_rows() >= 1){
	    $sess_data = $query->result();
		$sess_data = $sess_data[0];	
		$query = $this->db->get_where('tbl_users', array('user_id' => $sess_data->user_id));
        $data = $query->row();
		$this->session->set_userdata("MiPlani_user_name",$data->username);
        $this->session->set_userdata("MiPlani_oauth_provider",$data->oauth_provider);
		$this->session->set_userdata("MiPlani_user_email",$data->user_email);
		$this->session->set_userdata("MiPlani_user_id",$data->user_id);
		redirect(base_url());			
		}else{
		$insert_data = array(
					'username' => $google_username,
                    'user_email' => $userData['email'],
                    'user_password' => 'Null',
                    'is_verify_email' => 'Yes',
                    'first_name'  => $userData['givenName'],
			        'last_name'  => $userData['familyName'],
			        'user_status' => 'active',
                    'oauth_provider' => 'gmail',
                    'oauth_uid' => $userData['id'],
                    'add_date' => time()
					);
			 $insert_result = $this->db->insert('tbl_users', $insert_data);
             $user_id = $this->db->insert_id();
             $query = $this->db->get_where('tbl_users', array('user_id' => $user_id));
             $data = $query->row();
             $this->session->set_userdata("MiPlani_user_name",$data->username);
          	 $this->session->set_userdata("MiPlani_oauth_provider",$data->oauth_provider);
			$this->session->set_userdata("MiPlani_user_email",$data->user_email);
			$this->session->set_userdata("MiPlani_user_id",$data->user_id);
			redirect(base_url());	
    	}
	}

	


	public function login_linkedin(){
		
		require_once APPPATH.'vendor/autoload.php';

		$provider = new League\OAuth2\Client\Provider\LinkedIn([
			
				'clientId'          => '86479evl1wzha7',
				'clientSecret'      => '0FJ9bghW1cJmNyC5',
				'redirectUri'       => 'https://appvelo.com/Miplani/users/linkedincallback',
				//'linkedin_scope'       => 'r_liteprofile w_member_social',
		]);
		$options = [
			    'state' => 'california',
			    'scope' => ['r_liteprofile','r_emailaddress'] // array or string
			];
			if (!isset($_GET['code'])) {
			// If we don't have an authorization code then get one
			$authUrl = $provider->getAuthorizationUrl($options);
			header('Location: '.$authUrl);
			exit;
			// Check given state against previously stored one to mitigate CSRF attack
		}
	}
		public function linkedincallback() {

		require_once APPPATH.'vendor/autoload.php';
    
		$provider = new League\OAuth2\Client\Provider\LinkedIn([
				'clientId'          => '86479evl1wzha7',
				'clientSecret'      => '0FJ9bghW1cJmNyC5',
				'redirectUri'       => 'https://appvelo.com/Miplani/users/linkedincallback',
		]);
		$options = [
			    'state' => 'california',
			    'scope' => ['r_liteprofile','r_emailaddress'] // array or string
			];
		$authUrl = $provider->getAuthorizationUrl($options);
			$token = $provider->getAccessToken('authorization_code', [
				'code' => $_GET['code']
			]);
			// We got an access token, let's now get the user's details
			$user = $provider->getResourceOwner($token);
			$userProfile = $user->toArray();
			$username="";
			if(!empty($userProfile['email'])) {
			//$password = mt_rand(10000000, 99999999);
			if (empty($userProfile['localizedFirstName'])) {
				$email_parts = explode("@", $userProfile['email']);
				$username = $email_parts[0];
			} else {
			// $username = preg_replace('/\s+/', '_', $userProfile['name']);
			$username = $userProfile['localizedFirstName']." ".$userProfile['localizedLastName'];
			}
	$this -> db -> select('user_id,username,user_email,first_name,last_name,is_verify_email,user_status');
			$this -> db -> from('tbl_users');
			$this -> db -> where('user_email', $userProfile['email']);
			//$this -> db -> where('password', md5($password));
			$this -> db -> limit(1);
			$query = $this->db->get(); 
			if($query -> num_rows() >= 1){
			$sess_data = $query->result();
			$sess_data = $sess_data[0];	
			$query = $this->db->get_where('tbl_users', array('user_id' => $sess_data->user_id));
        $data = $query->row();
		$this->session->set_userdata("MiPlani_user_name",$data->username);
        $this->session->set_userdata("MiPlani_oauth_provider",$data->oauth_provider);
		$this->session->set_userdata("MiPlani_user_email",$data->user_email);
		$this->session->set_userdata("MiPlani_user_id",$data->user_id);
		redirect(base_url());	
			}else
			{
			//$EmailVerification = md5($username.time());
				$insert_data = array(
					'username' => $username,
                    'user_email' => $userProfile['email'],
                    'user_password' => 'Null',
                    'is_verify_email' => 'Yes',
                    'first_name'  => $userProfile['localizedFirstName'],
			        'last_name'  => $userProfile['localizedLastName'],
			        'user_status' => 'active',
                    'oauth_provider' => 'linkedin',
                    'oauth_uid' => $userProfile['id'],
                    'add_date' => time()
				);
				 $insert_result = $this->db->insert('tbl_users', $insert_data);
             	$user_id = $this->db->insert_id();
             	$query = $this->db->get_where('tbl_users', array('user_id' => $user_id));
             	$data = $query->row();
             	$this->session->set_userdata("MiPlani_user_name",$data->username);
          	 	$this->session->set_userdata("MiPlani_oauth_provider",$data->oauth_provider);
				$this->session->set_userdata("MiPlani_user_email",$data->user_email);
				$this->session->set_userdata("MiPlani_user_id",$data->user_id);
				redirect(base_url());
			}   

		} else {

            $this->session->set_flashdata('error1', 'Unable to process, Please try again later!'); 	
			redirect('users/SignUp');        
		}
	}

public function login_twitter()
	{
		require_once APPPATH.'vendor/autoload.php';

		$server = new League\OAuth1\Client\Server\Twitter(array(

				'identifier' => 'XM1dk0IA1nJH7TKcKHAe1US20',

				'secret' => 'Cfehw8kIxiRqd4Bpsvk4SW78X9PUM8AkNMoZQznbcXrL65wklK',

				'callback_uri' => 'https://appvelo.com/Miplani/users/twitter_callback',
		));
		// Retrieve temporary credentials
		$temporaryCredentials = $server->getTemporaryCredentials();
		//echo "<pre>"; print_r($temporaryCredentials); exit;
		// Store credentials in the session, we'll need them later
		$_SESSION['temporary_credentials'] = serialize($temporaryCredentials);
		session_write_close();
		// Second part of OAuth 1.0 authentication is to redirect the
		// resource owner to the login screen on the server.
		$server->authorize($temporaryCredentials);
	}
	public function twitter_callback(){
		require_once APPPATH.'vendor/autoload.php';
		$server = new League\OAuth1\Client\Server\Twitter(array(
				'identifier' => 'XM1dk0IA1nJH7TKcKHAe1US20',

				'secret' => 'Cfehw8kIxiRqd4Bpsvk4SW78X9PUM8AkNMoZQznbcXrL65wklK',

				'callback_uri' => 'https://appvelo.com/Miplani/users/twitter_callback',
			));

		if (isset($_GET['oauth_token']) && isset($_GET['oauth_verifier'])) {

			// Retrieve the temporary credentials we saved before

			$temporaryCredentials = unserialize($_SESSION['temporary_credentials']);
				// We will now retrieve token credentials from the server

			$tokenCredentials = $server->getTokenCredentials($temporaryCredentials, $_GET['oauth_token'], $_GET['oauth_verifier']);
			unset($_SESSION['temporary_credentials']);
			$_SESSION['token_credentials'] = serialize($tokenCredentials);
			//session_write_close();
			$user = $server->getUserDetails($tokenCredentials);
			//$password = mt_rand(10000000, 99999999);
			$this -> db -> select('user_id,username,user_email,first_name,last_name,is_verify_email,user_status');

			$this -> db -> from('tbl_users');

			$this -> db -> where('username', $user->name);

			$this -> db -> limit(1);

			$query = $this->db->get(); 
			if($query -> num_rows() >= 1)
			{
				$sess_data = $query->result();
				$sess_data = $sess_data[0];	
				$query = $this->db->get_where('tbl_users', array('user_id' => $sess_data->user_id));
        		$data = $query->row();
				$this->session->set_userdata("MiPlani_user_name",$data->username);
        		$this->session->set_userdata("MiPlani_oauth_provider",$data->oauth_provider);
				//$this->session->set_userdata("MiPlani_user_email",$data->user_email);
				$this->session->set_userdata("MiPlani_user_id",$data->user_id);
				redirect(base_url());	
			}
			else
			{	
			if(!empty($user->email) || !empty($user->name)) {
			if (empty($user->name)) {
				$email_parts = explode("@", $user->email);
				$user->name = $email_parts[0];
			}
			$cnt = $this->db->query("select count(*) as cnt from tbl_users where username = '$user->name'")->row()->cnt;
			if($cnt > 0){
				$user->username = $user->name.mt_rand(10,100);
				}
				//$EmailVerification = md5($user->name.time());
					$insert_data = array(
					'username' => $user->name,
                   	'user_password' => 'Null',
                    'is_verify_email' => 'Yes',
                    'first_name'  => $user->name,
			        'user_status' => 'active',
                    'oauth_provider' => 'twitter',
                    'oauth_uid' => $user->uid,
                    'add_date' => time()
					);

					 $insert_result = $this->db->insert('tbl_users', $insert_data);
             $user_id = $this->db->insert_id();
             $query = $this->db->get_where('tbl_users', array('user_id' => $user_id));
             $data = $query->row();
             $this->session->set_userdata("MiPlani_user_name",$data->username);
          	 $this->session->set_userdata("MiPlani_oauth_provider",$data->oauth_provider);
			 // $this->session->set_userdata("MiPlani_user_email",$data->user_email);
			 $this->session->set_userdata("MiPlani_user_id",$data->user_id);
			 redirect(base_url());	
				}
				else
				{
				  $this->session->set_flashdata('error1', 'Unable to process, Please try again later!');redirect('users/SignUp');
				}	
			}			

		}else{

			$this->session->set_flashdata('error1', 'Unable to process, Please try again later!'); 	

			redirect('users/SignUp');
		} 
	}







}
