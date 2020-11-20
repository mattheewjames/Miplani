<?php
class Admin_user_m extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
	public function update_user_profile()
	{
		$update_array = array(
			'username'  => $this->input->post('username'),
			'user_email'  => $this->input->post('user_email'),
			'user_full_name'  => $this->input->post('user_full_name'),
  		);
 		$this->db->set($update_array);
		$this->db->where("user_id",$this->session->userdata('MiPlani_admin_id'));
		$this->db->update('tbl_system_users');
	}
	public function get_login_user_credential()
	{
		if(!empty($_POST['username']) && !empty($_POST['password']))
		{
			$username = trim($this->input->post('username'));
 			$password = trim($this->input->post('password'));
			$this->db->select('user_id, user_type, user_full_name, username, user_email');
			$this->db->from('tbl_system_users');
			$this->db->where("(username='".$username."' or user_email='".$username."') and user_password='".md5($password)."' and user_status='active'");
			$query = $this->db->get();
			if($query->num_rows()>0)
			{
				return $query->row();
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	public function check_user_by_email($user_email)
	{
		$this->db->select("user_id");
		$this->db->from('tbl_system_users');
		$this->db->where("user_email",$user_email);
 		$this->db->where("user_status",'active');
  		$query = $this->db->get();
		return $query->num_rows();
	}
	public function get_user_row_by_email($user_email)
	{
		$this->db->select("user_id,user_full_name,user_email");
		$this->db->from('tbl_system_users');
		$this->db->where("user_email",$user_email);
 		$this->db->where("user_status",'active');
  		$query = $this->db->get();
   		if($query->num_rows()>0)
		{
			return $query->row();
		}
	}
	public function add_user_reset_password($email)
	{
		$reset_access_token = md5('MIPLANi'.time());
 		//Delete old Reset password
		$this->db->where('email',$email);
 		$this->db->delete('tbl_users_reset_password');
		//Add New Record
 		$expiry_timestamp = time()+60*60*5;
		$add_array = array(
			'email'  => $email,
			'user_type'  => 'admin user',
			'reset_access_token'  => $reset_access_token,
 			'add_timestamp' => time(),
			'expiry_timestamp'  => $expiry_timestamp,
 		);
		$this->db->set($add_array);
		$this->db->insert('tbl_users_reset_password');
		return $this->db->insert_id();
	}
	
	public function get_user_reset_password_row($id)
	{ 
		$this->db->select("r.id, r.email, r.add_timestamp, r.expiry_timestamp, u.user_id");
		$this->db->where("r.id",$id);
		$this->db->where("r.user_type",'admin user');
		$this->db->where("u.user_status","active");
		$this->db->from('tbl_users_reset_password as r');
		$this->db->join('tbl_system_users as u', 'r.email = u.user_email');
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			return $query->row();
		}
	}
	public function update_delete_user_reset_password($id,$user_id)
	{
 		//delete from reset table
		$this->db->where('id',$id);
		$this->db->where('user_type','admin user');
		$this->db->delete('tbl_users_reset_password');	
		//Reset Password
		$this->db->set('user_password', md5($this->input->post('password')));
		$this->db->where('user_id', $user_id);
		$this->db->update('tbl_system_users');
		//insert logs
		$add_log_data = array(
			'log_type' => 'Reset Password',
			'log_table_name' => 'tbl_system_users',
			'log_table_id' => $user_id,
			'log_add_date' => time(),
		);
		$this->db->set($add_log_data);
		$this->db->insert('tbl_logs');
	}
	public function update_user_password()
	{
 		$this->db->set('user_password',md5($this->input->post('new_password')));
		$this->db->where("user_id",$this->session->userdata('MiPlani_admin_id'));
		$this->db->update('tbl_system_users');
	}
	public function check_user_password($user_id,$password)
	{
		$this->db->select("user_id");
 		$this->db->where("user_id",$this->session->userdata('MiPlani_admin_id'));
		$this->db->where("user_password",md5($password));
  		$this->db->from('tbl_system_users');
 		$query = $this->db->get();
   		return $query->num_rows();
	}
  	public function get_login_user_row($user_id)
	{
		$this->db->select('user_id, user_type, user_full_name, username, user_email, user_picture');
		$this->db->from('tbl_system_users');
		$this->db->where("user_id='".$user_id."'");
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			return $query->row();
		}
 	} 
	public function check_user_name_email_record($record_type,$column_name,$column_value,$user_id)
	{
		$this->db->select("user_id");
		$this->db->from('tbl_system_users');
		if($record_type==='new')
		{
			if($column_name==='username')
			{
				$this->db->where("username",$column_value);
			}
			elseif($column_name==='user_email')
			{
				$this->db->where("user_email",$column_value);
			}
		}
		elseif($record_type==='update')
		{
			$this->db->where("user_id !=",$user_id);
			if($column_name==='username')
			{
				$this->db->where("username",$column_value);
			}
			elseif($column_name==='user_email')
			{
				$this->db->where("user_email",$column_value);
			}
		}
		$query = $this->db->get();
		return $query->num_rows();
	}
}
?>