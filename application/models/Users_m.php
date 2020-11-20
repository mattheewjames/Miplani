<?php
class Users_m extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
	public function register_user()
	{
		$add_array = array(
			'username'  => $this->input->post('username'),
			'user_email'  => $this->input->post('user_email'),
			'user_password'  => md5($this->input->post('password')),
			'first_name'  => $this->input->post('first_name'),
			'last_name'  => $this->input->post('last_name'),
			'user_status'  => 'pending',
			'oauth_provider'  => 'website',
			'is_verify_email' => 'No',
			'current_subscription_type' => 'Free',
			'verification_code' => rand(),
			'add_date' => time()
  		);
		$this->db->set($add_array);
  		$this->db->insert('tbl_users');
		$user_id = $this->db->insert_id();
		if($user_id>0)
		{
			$hash = 'The quick brown fox jumps over the lazy dog';
			$verification_link = base64_encode($user_id.'MiPlani'.$hash.time());
			
			$this->db->set('verification_link', $verification_link);
			$this->db->where('user_id', $user_id);
			$this->db->update('tbl_users');
 			return $user_id;
		}
	}
	public function get_active_user_row($user_id)
	{
		return $this->get_user_row($user_id,'active');
	}
	public function get_pending_user_row($user_id)
	{
		return $this->get_user_row($user_id,'pending');
	}
	public function get_common_user_row($user_id)
	{
		return $this->get_user_row($user_id,'all');
	}
	public function get_user_row($user_id,$user_status)
	{
		$this->db->select("*");
		$this->db->where("user_id",$user_id);
		if($user_status!='all')
		{
			$this->db->where("user_status",$user_status);
		}
   		$this->db->from('tbl_users');
 		$query = $this->db->get();
 		if($query->num_rows())
		{
 			return $query->row();
		}
 	}
	public function get_login_user_row()
	{
		$this->db->select("*");
		$this->db->where("username='".$this->input->post('user_email')."' or user_email='".$this->input->post('user_email')."' ");
		$this->db->where("user_password",md5($this->input->post('password')));
		$this->db->where("user_status",'active');
   		$this->db->from('tbl_users');
 		$query = $this->db->get();
 		if($query->num_rows())
		{
 			return $query->row();
		}
 	}
	public function update_user_email_verification($user_id)
	{
		$save_array = array(
			'user_status'  => 'active',
			'is_verify_email'  => 'Yes',
			'verification_link'  => '',
			'verification_code'  => '',
   		);
 		$this->db->set($save_array);
  		$this->db->where('user_id', $user_id);
		$this->db->update('tbl_users');
	}
	public function check_user_columns($column_name,$column_value,$record_type,$update_id='')
	{
		$this->db->select("user_id");
 		$this->db->from('tbl_users');
		if($record_type=='add')
		{
			if($column_name=='username')
			{
				$this->db->where("username",$column_value);
			}
			elseif($column_name=='user_email')
			{
				$this->db->where("user_email",$column_value);
			}
		}
		elseif($record_type=='update')
		{
			if($column_name=='username')
			{
				$this->db->where("username",$column_value);
 			}
			elseif($column_name=='user_email')
			{
				$this->db->where("user_email",$column_value);
			}
			$this->db->where("user_id!= ",$update_id);
		}
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function add_user_payment($plan_id,$user_paid_amount,$user_id,$coupon_code)
	{
		$total_discount = 0;
		//get package row
		$this->db->select('*');
		$this->db->from('tbl_pricing_plans');
		$this->db->where("plan_id",$plan_id);
 		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			$plan_row = $query->row();
 			if(!empty($plan_row))
			{
				$expiry_date = '';
				if($plan_row->plan_type=='monthly')
				{
					$expiry_date = strtotime("+1 month",$this->config->item('current_default_time'));
				}
				elseif($plan_row->plan_type=='annual')
				{
					$expiry_date = strtotime("+1 year",$this->config->item('current_default_time'));
				}
				elseif($plan_row->plan_type=='life time')
				{
					$expiry_date = strtotime("+50 year",$this->config->item('current_default_time'));
				}
				else
				{
					$expiry_date = time();
				}
				if(!empty($coupon_code))
				{
					$this->db->select("*");
					$this->db->where("coupon_code",$coupon_code);
					$this->db->from('tbl_coupons');
					$query = $this->db->get();
					if($query->num_rows())
					{
						$coupon_row = $query->row();
						if(!empty($coupon_row))
						{
							$coupon_discount_amount = $coupon_row->coupon_discount_amount;
							$discount_percentage = number_format($coupon_discount_amount, 2, '.', '');
							$total_discount =  number_format($plan_row->plan_price/$discount_percentage, 2, '.', '');
						}
					}
				}
	$row = $this->db->select("*")->where('user_id',$user_id)->limit(1)->order_by('user_id',"DESC")->get("tbl_user_payments")->row();
		$update_payment_status = array(
					'payment_status' => 'inactive',
				);
				$this->db->set($update_payment_status);
				$this->db->where("payment_id",$row->payment_id);
				$this->db->update('tbl_user_payments');
		$add_payment_data = array(
					'user_id' => $user_id,
					'plan_id' => $plan_row->plan_id,
					'plan_type' => $plan_row->plan_type,
					'plan_price' => $plan_row->plan_price,
					'user_paid_amount' => $user_paid_amount,
					'promo_code'  => $coupon_code,
					'discount_amount' => $total_discount,
 					'payment_start_date' => time(),
					'payment_expiry_date' => $expiry_date,
 					'payment_date' => time(),
 					'payment_status'=> 'active',
				);
				$this->db->set($add_payment_data);
				$this->db->insert('tbl_user_payments');	
				$payment_id = $this->db->insert_id();
				$update_user_array = array(
					'current_subscription_type' => $plan_row->plan_type,
					'plan_id' => $plan_row->plan_id,
					'subscription_start_date' => time(),
					'subscription_end_date' => $expiry_date,
					'user_payment_status' => 'active',
				);
				$this->db->set($update_user_array);
				$this->db->where("user_id",$user_id);
				$this->db->update('tbl_users');
				if(!empty($coupon_row))
				{
					
					//update coupon usage
					$total_usage = $coupon_row->total_usage+1;

					$this->db->set('total_usage',$total_usage);
					$this->db->where('coupon_id',$coupon_row->coupon_id);
					$this->db->update('tbl_coupons');
					
					//insert coupon statics
					$add_coupon_statistics_data = array(
						'user_id' => $user_id,
						'coupon_id' => $coupon_row->coupon_id,
						'coupon_code' => $coupon_code,
 						'apply_date' => time(),
					);
					$this->db->set($add_coupon_statistics_data);
					$this->db->insert('tbl_user_coupon_statistics');	
				}
			}
		}
 	}
	public function get_user_payments_list($user_id)
	{
		$this->db->select("*");
 		$this->db->where("user_id",$user_id);
   		$this->db->from('tbl_user_payments');
		$this->db->order_by('payment_id','desc');
 		$query = $this->db->get();
 		if($query->num_rows())
		{
 			return $query->result();
		}	
	}
	public function get_user_list($user_id)
	{
		$this->db->select("*");
 		$this->db->where("user_id",$user_id);
   		$this->db->from('tbl_users');
		$this->db->order_by('user_id','desc');
 		$query = $this->db->get();
 		if($query->num_rows())
		{
 			return $query->result();
		}	
	}
	public function get_payments_list($user_id)
	{

		$this->db->select("*");
 		$this->db->where("user_id",$user_id);
 		$this->db->where("payment_status",'active');
 		$this->db->or_where("payment_status",'expired');
   		$this->db->from('tbl_user_payments');
		$this->db->order_by('payment_id','desc');
 		$query = $this->db->get();
 		if($query->num_rows())
		{
 			return $query->result();
		}	
	}
	public function get_invite_projection_friends_list($user_id)
	{
		$this->db->select("*");
 		$this->db->where("user_id",$user_id);
   		$this->db->from('tbl_invite_projection_friends');
		$this->db->order_by('main_id','desc');
 		$query = $this->db->get();
 		if($query->num_rows())
		{
 			return $query->result();
		}	
	}
	public function get_invite_projection_row($key_url)
	{
		$this->db->select("*");
 		$this->db->where("key_url",$key_url);
   		$this->db->from('tbl_invite_projection_friends');
 		$query = $this->db->get();
 		if($query->num_rows())
		{
 			return $query->row();
		}	
	}
	public function get_payments_count()
	{
		$this->db->select('payment_id');
		$this->db->from('tbl_user_payments');
    	$query = $this->db->get();
  		return $query->num_rows();
	}
	public function get_payments_data($limit,$start)
	{	
 		$this->db->select('*');
		$this->db->from('tbl_user_payments');
 		$this->db->order_by('payment_id','desc');
		$this->db->limit($start, $limit);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
	public function get_session_user_row()
	{
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$this->db->select("user_id,username,user_email,first_name,last_name");
			$this->db->where("user_id",$this->session->userdata('MiPlani_user_id'));
			$this->db->from('tbl_users');
			$query = $this->db->get();
			if($query->num_rows())
			{
				return $query->row();
			}
		}
	 }
  	public function check_user_password($user_id,$password)
	{
		$this->db->select("user_id");
 		$this->db->where("user_id",$user_id);
		$this->db->where("user_password",md5($password));
  		$this->db->from('tbl_users');
 		$query = $this->db->get();
   		return $query->num_rows();
	}

	public function check_user_email($user_id, $email) {

		$this->db->select("user_id");
		$this->db->where("user_email",$email);
		$this->db->where("user_id<>",$user_id);
   		$this->db->from('tbl_users');
		$query = $this->db->get();
		return $query->num_rows(); 
 	}

	public function verify_forgot_password_user_email($email) 
	{
 		$this->db->select("user_id");
		$this->db->where('user_email', $email);
		$this->db->where('oauth_provider', 'website');
   		$this->db->from('tbl_users');
		$query = $this->db->get();
		return $query->num_rows(); 
	}

	public function get_forgot_password_user($user_email) 
	{
		$this->db->select("user_id");
		$this->db->where('user_email', $user_email);
		$this->db->where('oauth_provider', 'website');
   		$this->db->from('tbl_users');
		$query = $this->db->get();
 		return $query->num_rows();
 	}

	public function check_username($user_id, $username) 
	{

		$this->db->select("user_id");
		$this->db->where("username",$username);
		$this->db->where("user_id",$user_id);
   		$this->db->from('tbl_users');
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function update_user_password()
	{
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$this->db->set('user_password',md5($this->input->post('new_password')));
			$this->db->where('user_id',$this->session->userdata('MiPlani_user_id'));
			$this->db->update('tbl_users');
		}
	}
	
	public function update_profile()
	{
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$update_array = array(
				'username'  => $this->input->post('username'),
				'user_email'  => $this->input->post('user_email'),
				'first_name'  => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
			);
			$this->db->set($update_array);
			$this->db->where('user_id',$this->session->userdata('MiPlani_user_id'));
			$this->db->update('tbl_users');
		}
	}
	public function check_user_by_email($user_email)
	{
		$this->db->select("user_id");
		$this->db->from('tbl_users');
		$this->db->where("user_email",$user_email);
 		$this->db->where("user_status",'active');
  		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			return $query->row()->user_id;
		}
	}
	
	public function get_user_row_by_email($user_email)
	{
		$this->db->select("user_id,first_name,last_name,user_email");
		$this->db->from('tbl_users');
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
			'user_type'  => 'user',
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
		$this->db->where("r.user_type",'user');
		$this->db->where("u.user_status","active");
		$this->db->from('tbl_users_reset_password as r');
		$this->db->join('tbl_users as u', 'r.email = u.user_email');
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
		$this->db->where('user_type','user');
		$this->db->delete('tbl_users_reset_password');	
		//Reset Password
		$this->db->set('user_password', md5($this->input->post('password')));
		$this->db->where('user_id', $user_id);
		$this->db->update('tbl_users');
	}
	
	public function AddGoogleUser($userData)
	{
		$user_id = 0;
		if(!empty($userData))
		{
			$oauth_uid = '';
			$name = '';
			$email = '';
			$picture = '';
			if(!empty($userData['email'])) 
			{
				$email_parts = explode("@", $userData['email']);
				if(!empty($email_parts))
				{
					$name = $email_parts[0];
				}
				$email = $userData['email'];
			}
			if(!empty($userData['name'])) 
			{
				$name = $userData['name'];
			}
			if(!empty($userData['picture'])) 
			{
				$picture = $userData['picture'];
			}
			if(!empty($userData['id'])) 
			{
				$oauth_uid = $userData['id'];
			}
			if(!empty($email))
			{
				$user_id = $this->check_user_by_email($email);
				if($user_id>0)
				{
					$update_array = array(
						'oauth_uid'  => $oauth_uid,
						'oauth_provider'  => 'gmail',
						'user_picture'  => $picture,
						'is_verify_email' => 'Yes',
						'user_status'  => 'active',
					);
					$this->db->set($update_array);
					$this->db->where('user_email', $email);
					$this->db->update('tbl_users');
				}
				else
				{
					$update_array = array(
						'username' => $email,
						'user_email' => $email,
						'first_name' => $name,
						'oauth_uid'  => $oauth_uid,
						'oauth_provider'  => 'gmail',
						'user_picture'  => $picture,
						'is_verify_email' => 'Yes',
						'user_status'  => 'active',
						'user_payment_status' => 'free',
						'current_subscription_type' => 'Free',
					);
					$this->db->set($update_array);
					$this->db->insert('tbl_users');
					$user_id = $this->db->insert_id();
				}
 			}
  		}
		return $user_id;
	}
	
	public function add_fb_user($fbdata)
	{
		$user_id = 0;
		if(!empty($fbdata))
		{
			if(!empty($fbdata['email']))
			{
				$user_id= $this->check_oauth_user($fbdata['email'],$fbdata['oauth_uid']);
			}
			else
			{
				$user_id = $this->check_oauth_uid($fbdata['oauth_uid']);
			} 
			if($user_id<1)
			{
				$user_id = $this->check_user_by_email($fbdata['email']);
				if($user_id<1)
				{
					$add_array = array(
						'first_name'  => $fbdata['first_name'],
						'last_name'  => $fbdata['last_name'],
						'user_email'  => $fbdata['email'],
						'oauth_uid'  => $fbdata['oauth_uid'],
						'user_picture' => $fbdata['picture'],
						'user_password'  => md5('12345678'),
						'is_verify_email' => 'Yes',
						'user_status'  => 'active',
						'user_payment_status' => 'free',
						'current_subscription_type' => 'Free',
						'add_date' => time()
					);
					$this->db->set($add_array);
					$this->db->insert('tbl_users');
					$user_id = $this->db->insert_id();

					$this->db->set('username',$user_id.$fbdata['oauth_uid']);
					$this->db->where('user_id', $user_id);
					$this->db->update('tbl_users');
				}
			}
  		}
		return $user_id;
	}
	
	public function check_oauth_user($user_email,$oauth_uid)
	{
		$this->db->select("user_id");
		$this->db->where("user_email",$user_email);
		$this->db->or_where("oauth_uid",$oauth_uid);
   		$this->db->from('tbl_users');
 		$query = $this->db->get();
 		if($query->num_rows())
		{
 			return $query->row()->user_id;
		}
 	}
	public function check_oauth_uid($oauth_uid)
	{
		$this->db->select("user_id");
		$this->db->where("oauth_uid",$oauth_uid);
		$this->db->from('tbl_users');
 		$query = $this->db->get();
 		if($query->num_rows())
		{
 			return $query->row()->user_id;
		}
 	}
	public function user_total_shares_projections($user_id)
	{
		$this->db->select("main_id");
		$this->db->where("user_id",$user_id);
		$this->db->from('tbl_invite_projection_friends');
 		$query = $this->db->get();
 		return $query->num_rows();
 	}
	public function total_user_active_projections($user_id,$projection_type)
	{
		if($projection_type=='annual')
		{
			$this->db->select("projection_id");
			$this->db->where("user_id",$user_id);
			$this->db->where("projection_status",'active');
 			$this->db->from('tbl_projections');
			$query = $this->db->get();
			return $query->num_rows();
		}
		else
		{
			if(in_array($projection_type,array('Yearly', '6 Months', '3 Months')))
			{
				$this->db->select("projection_id");
				$this->db->where("user_id",$user_id);
				$this->db->where("projection_type",$projection_type);
				$this->db->where("projection_status",'active');
				$this->db->from('tbl_dream_projections');
				$query = $this->db->get();
				return $query->num_rows();
			}
		}
 	}

 	 public function delete_record($table = "", $where = "" ,$where1 = "")
     {

       $this->db->where($where);
        $delete = $this->db->delete($table);
        if ($delete)
            return true;
        else
            return false;
     }

     public function download_invoice()
     {
     	$this->db->select("*");
 		$this->db->where("user_id",$this->session->userdata('MiPlani_user_id'));
 		$query =$this->db->get('tbl_user_payments');
 		return $query->result_array();
     }
}
?>