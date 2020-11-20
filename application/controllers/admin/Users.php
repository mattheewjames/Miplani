<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Admin_Controller {
    
    public function index()
    {
		$data['page_title'] = 'Manage Users';
		$data['users'] = $this->db->query("select * from tbl_users order by user_id desc")->result();
		//$this->load->view('admin/user_management', $data);

		$header_data = array('page_title' => 'Manage Users');
		load_admin_main_template('admin/user_management', $header_data,$data);
        
	}
	
	public function add_user(){

		// $this->data['page_title'] = "Add User";
		// $this->data['property_type'] = $this->db->query("select * from property_type")->result();
		// $this->load->view('admin/add_user_view', $this->data);

		$data['page_title'] = 'Add User';
		$header_data = array('page_title' => 'Add User');
		load_admin_main_template('admin/add_user_view', $header_data,$data);

	}

	public function do_add_user(){

		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('user_email', 'Email Address', 'required');
		
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
		
		if ($this->form_validation->run() == FALSE)
			{
		         $error=validation_errors();
                 $this->session->set_flashdata('error', $error);    
				 redirect($_SERVER['HTTP_REFERER']);
			}
		  else
			{
				 $email = $this->input->post('user_email');
				 $cnt = $this->db->query("select count(*) as cnt from tbl_users where user_email = '$email'")->row()->cnt;
				 
				 if($cnt > 0){ 
					 $this->session->set_flashdata('error', "Account already register with this email");  
					 redirect($_SERVER['HTTP_REFERER']);
				 }
				 
				 $name = $this->input->post('first_name').' '.$this->input->post('last_name');
				 $pwd = $this->input->post('password');

				 $data['first_name'] = $this->input->post('first_name');
				 $data['last_name'] = $this->input->post('last_name');
				 $data['username'] = $this->input->post('username');
				 $data['user_email'] = $email;

				 
				 $data['user_password'] = md5($pwd);
				 $data['user_status'] = "active";
                
				 $data['is_verify_email'] = 'Yes';
                 $data['add_date'] = time();
				
         	     $this->db->insert('tbl_users', $data);
                 $id=$this->db->insert_id();
                 
                  // send activation link //
					$from=$this->config->config['admin_email'];
					$from_name='Admin';
					//$name=$name; 
					$name='Administrator';
					$to=$email;
					$subject='Account Creation';
					
					$username = $this->input->post('username');
					$verification_link_url = base_url().'users/SignIn';
					
					$this->load->library("Smtpemails");
					$this->load->library('Emailtemp');
					$message_subject = $this->lang->line('lang_registration_success_label');
					
					$message_body = $this->emailtemp->AdminRegisterUserTemplate($username,$pwd, $verification_link_url);
					$this->smtpemails->send($this->input->post('user_email'),$message_subject, $message_body);

					$this->session->set_flashdata('success', 'User Added Successfully');
					redirect('admin/users');	
			}

	}
	
	public function update_user_status(){
		
		$user_id = $this->input->post('user_id');
		$new_status = $this->input->post('new_status');
		
		$this->db->where("user_id", $user_id)->update("tbl_users", array("user_status"=>$new_status));
		echo 'success';
		
	}

	public function delete_user(){  // from multiple pages
		
		$id=$this->input->post('id');
		$this->db->where('user_id', $id)->delete('tbl_users');
		echo 'success';
		
	}
	
	public function view_user_management($id){

		// $this->data['page_title'] = "Edit User";
		// $user = $this->db->query("select * from users where ID = '".$id."' ")->row();		
		// $this->data['user'] = $user;
		// $this->data['membership'] = $this->db->query("select * from memberships where user_id = '".$id."' ")->row();
		// $this->data['countries'] = $this->db->query("select * from countries")->result();
		// $this->data['states'] = $this->db->query("select * from states")->result();
		// $this->load->view('admin/edit_user_view', $this->data);

		$data['page_title'] = 'Edit User';
		$data['user'] = $this->db->query("select * from tbl_users where user_id = '".$id."' ")->row();	
		$header_data = array('page_title' => 'Edit User');
		load_admin_main_template('admin/edit_user_view', $header_data,$data);
		
	}

	
	public function update_user(){
		
		$user_id = $this->input->post('user_id');

		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		
		
		if ($this->form_validation->run() == FALSE)
		{
			$error=validation_errors();
			$this->session->set_flashdata('error', $error);    
			redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
		
			$data['first_name'] = $this->input->post('first_name');
			$data['last_name'] = $this->input->post('last_name');
			$data['username'] = $this->input->post('username');
			
			$password = $this->input->post('password');
			$cpassword = $this->input->post('cpassword');

			if(strlen($password) > 5 && $password != $cpassword){
				$this->session->set_flashdata('error', "Password does not matched");    
				redirect($_SERVER['HTTP_REFERER']);
			}

			if(strlen($password) > 5 && $password == $cpassword){
				$data['user_password'] = md5($password);
			}
			
			$this->db->where("user_id", $user_id)->update("tbl_users", $data);
			$this->session->set_flashdata('success', 'Record Updated Successfully');	
			redirect('admin/users');
		}
		
	}
	 
}
