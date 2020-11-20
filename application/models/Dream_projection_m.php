<?php
class Dream_projection_m extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
	public function save_dream_financial_goal($projection_type)
	{
		$form_data = array();
		$conversion_rate_percentage = 0;
		$achieve_goal_year = 1;
		if(!empty($_POST['form_data']))
		{
			$form_array = parse_str($_POST['form_data'], $form_data);
		}
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			 $annual_billing  = 0; 
			$achieve_goal_year = 0;
			$average_product_price  = 0; 
			$operating_expenses  = 0; 
			$advertising_expenses  = 0; 
			$average_product_sold_cost  = 0; 
			$conversion_rate  = 0; 
			$conversion_rate_percentage = 0;
			if(!empty($form_data['annual_billing']))
			{
				$annual_billing = $form_data['annual_billing'];
				$annual_billing = str_replace(".","",$annual_billing);
				$annual_billing = intval($annual_billing);
			}
			if(!empty($projection_type))
			{
				if($projection_type=='Yearly')
				{
					$achieve_goal_year = $form_data['achieve_goal_year'];
				}
			}
			if(!empty($form_data['average_product_price']))
			{
				$average_product_price = $form_data['average_product_price'];
				$average_product_price = str_replace(".","",$average_product_price);
				$average_product_price = intval($average_product_price);
			}
			if(!empty($form_data['operating_expenses']))
			{
				$operating_expenses = $form_data['operating_expenses'];
			}
			if(!empty($form_data['advertising_expenses']))
			{
				$advertising_expenses = $form_data['advertising_expenses'];
			}
			if(!empty($form_data['average_product_sold_cost']))
			{
				$average_product_sold_cost = $form_data['average_product_sold_cost'];
			}
			if(!empty($form_data['conversion_rate']))
			{
				$conversion_rate = $form_data['conversion_rate'];

				$conversion_rate_percentage = $conversion_rate/100;
				$conversion_rate_percentage = number_format($conversion_rate_percentage, 2, '.', '');
			}
			$add_array = array(
				'user_id'  => $this->session->userdata('MiPlani_user_id'),
				'annual_billing'  => $annual_billing,
				'achieve_goal_year'  => $achieve_goal_year,
				'average_product_price'  => $average_product_price,
				'operating_expenses'  => $operating_expenses,
				'advertising_expenses'  => $advertising_expenses,
				'average_product_sold_cost'  => $average_product_sold_cost,
				'conversion_rate'  => $conversion_rate,
				'conversion_rate_percentage'  => $conversion_rate_percentage,
				'projection_status'  => 'active',
				'add_date' => time(),
				'projection_type'  => $projection_type,
				'currency' => 'EUR',
				
			);
			$this->db->set($add_array);
			$this->db->insert('tbl_dream_projections');
		}
 	}
	
	
	public function update_dream_financial_goal($projection_type)
	{
		$form_data = array();
		$projection_id = '';
		$conversion_rate_percentage = 0;
		$achieve_goal_year = 1;
		if(!empty($_POST['form_data']))
		{
			$form_array = parse_str($_POST['form_data'], $form_data);
		}
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$annual_billing  = 0; 
			$achieve_goal_year = 0;
			$average_product_price  = 0; 
			$operating_expenses  = 0; 
			$advertising_expenses  = 0; 
			$average_product_sold_cost  = 0; 
			$conversion_rate  = 0; 
			$conversion_rate_percentage = 0;
			if(!empty($form_data['pid']))
			{
				$projection_id = base64_decode($form_data['pid']);
			}
			if(!empty($form_data['annual_billing']))
			{
				$annual_billing = $form_data['annual_billing'];
				$annual_billing = str_replace(".","",$annual_billing);
				$annual_billing = intval($annual_billing);
			}
			if(!empty($projection_type))
			{
				if($projection_type=='Yearly')
				{
					$achieve_goal_year = $form_data['achieve_goal_year'];
				}
			}
			if(!empty($form_data['average_product_price']))
			{
				$average_product_price = $form_data['average_product_price'];
				$average_product_price = str_replace(".","",$average_product_price);
				$average_product_price = intval($average_product_price);
			}
			if(!empty($form_data['operating_expenses']))
			{
				$operating_expenses = $form_data['operating_expenses'];
			}
			if(!empty($form_data['advertising_expenses']))
			{
				$advertising_expenses = $form_data['advertising_expenses'];
			}
			if(!empty($form_data['average_product_sold_cost']))
			{
				$average_product_sold_cost = $form_data['average_product_sold_cost'];
			}
			if(!empty($form_data['conversion_rate']))
			{
				$conversion_rate = $form_data['conversion_rate'];

				$conversion_rate_percentage = $conversion_rate/100;
				$conversion_rate_percentage = number_format($conversion_rate_percentage, 2, '.', '');
			}
			if($projection_id>0)
			{
				$update_array = array(
					'annual_billing'  => $annual_billing,
					'achieve_goal_year'  => $achieve_goal_year,
					'average_product_price'  => $average_product_price,
					'operating_expenses'  => $operating_expenses,
					'advertising_expenses'  => $advertising_expenses,
					'average_product_sold_cost'  => $average_product_sold_cost,
					'conversion_rate'  => $conversion_rate,
					'conversion_rate_percentage'  => $conversion_rate_percentage,
				);
				$this->db->set($update_array);
				$this->db->where('user_id',$this->session->userdata('MiPlani_user_id'));
				$this->db->where('projection_type',$projection_type);
				$this->db->where('projection_id',$projection_id);
				$this->db->update('tbl_dream_projections');
			}
		}
 	}
	public function update_guest_dream_financial_goal($key_url)
	{
		$form_data = array();
		$projection_id = '';
		$conversion_rate_percentage = 0;
		$achieve_goal_year = 1;
		if(!empty($_POST['form_data']))
		{
			$form_array = parse_str($_POST['form_data'], $form_data);
		}
		$annual_billing  = 0; 
		$achieve_goal_year = 0;
		$average_product_price  = 0; 
		$operating_expenses  = 0; 
		$advertising_expenses  = 0; 
		$average_product_sold_cost  = 0; 
		$conversion_rate  = 0; 
		$conversion_rate_percentage = 0;
		if(!empty($form_data['pid']))
		{
			$projection_id = base64_decode($form_data['pid']);
		}
		if(!empty($form_data['annual_billing']))
		{
			$annual_billing = $form_data['annual_billing'];
			$annual_billing = str_replace(".","",$annual_billing);
			$annual_billing = intval($annual_billing);
		}
		if(!empty($projection_type))
		{
			if($projection_type=='Yearly')
			{
				$achieve_goal_year = $form_data['achieve_goal_year'];
			}
		}
		if(!empty($form_data['average_product_price']))
		{
			$average_product_price = $form_data['average_product_price'];
			$average_product_price = str_replace(".","",$average_product_price);
			$average_product_price = intval($average_product_price);
		}
		if(!empty($form_data['operating_expenses']))
		{
			$operating_expenses = $form_data['operating_expenses'];
		}
		if(!empty($form_data['advertising_expenses']))
		{
			$advertising_expenses = $form_data['advertising_expenses'];
		}
		if(!empty($form_data['average_product_sold_cost']))
		{
			$average_product_sold_cost = $form_data['average_product_sold_cost'];
		}
		if(!empty($form_data['conversion_rate']))
		{
			$conversion_rate = $form_data['conversion_rate'];

			$conversion_rate_percentage = $conversion_rate/100;
			$conversion_rate_percentage = number_format($conversion_rate_percentage, 2, '.', '');
		}
		if($projection_id>0)
		{
			$update_array = array(
				'annual_billing'  => $annual_billing,
				'achieve_goal_year'  => $achieve_goal_year,
				'average_product_price'  => $average_product_price,
				'operating_expenses'  => $operating_expenses,
				'advertising_expenses'  => $advertising_expenses,
				'average_product_sold_cost'  => $average_product_sold_cost,
				'conversion_rate'  => $conversion_rate,
				'conversion_rate_percentage'  => $conversion_rate_percentage,
				'update_key_url'  => $key_url,
			);
			$this->db->set($update_array);
			$this->db->where('projection_id',$projection_id);
			$this->db->update('tbl_dream_projections');
		}
  	}
	public function get_projection_row($projection_id,$user_id)
	{
		$this->db->select("*");
		$this->db->where("projection_id",$projection_id);
		$this->db->where("user_id",$user_id);
   		$this->db->from('tbl_dream_projections');
 		$query = $this->db->get();
 		if($query->num_rows())
		{
 			return $query->row();
		}
	}
	public function check_dream_projection_record($projection_id,$user_id)
	{
		$this->db->select("projection_id");
		$this->db->where("projection_id",$projection_id);
		$this->db->where("user_id",$user_id);
   		$this->db->from('tbl_dream_projections');
 		$query = $this->db->get();
 		return $query->num_rows(); 
	}
	public function get_user_wise_projection_list($user_id,$projection_type)
	{
		$this->db->select("*");
 		$this->db->where("user_id",$user_id);
		if($projection_type!='all')
		{
			$this->db->where("projection_type",$projection_type);
		}
		$this->db->from('tbl_dream_projections');
		$this->db->order_by('projection_id','desc');
 		$query = $this->db->get();
 		if($query->num_rows())
		{
 			return $query->result();
		}
	}
	public function get_projection_details($projection_id)
	{
		$this->db->select("*");
 		$this->db->where("projection_id",$projection_id);
   		$this->db->from('tbl_dream_projections');
  		$query = $this->db->get();
 		if($query->num_rows())
		{
 			return $query->row();
		}
	}
	public function check_active_projection_record($projection_id)
	{
		$this->db->select("projection_id");
		$this->db->where("projection_id",$projection_id);
		$this->db->where("projection_status",'active');
   		$this->db->from('tbl_dream_projections');
 		$query = $this->db->get();
 		return $query->num_rows(); 
	}
	public function delete_projection_record($projection_id,$user_id)
	{
 		$this->db->where("projection_id",$projection_id);
		$this->db->where("user_id",$user_id);
 		$this->db->delete('tbl_dream_projections');
	}
	public function check_projection_record($projection_id,$user_id)
	{
		$this->db->select("projection_id");
		$this->db->where("projection_id",$projection_id);
		$this->db->where("user_id",$user_id);
   		$this->db->from('tbl_dream_projections');
 		$query = $this->db->get();
		echo $this->db->last_query();
 		return $query->num_rows(); 
 	}
	public function invite_friend_projection()
	{
		$projection_id = base64_decode($this->input->post('pid', TRUE));
		$add_user_id = 0;
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$add_user_id = $this->session->userdata('MiPlani_user_id');
		}
		if($projection_id>0)
		{
			$save_array = array(
				'user_id'  => $add_user_id,
				'friend_email' => $this->input->post('email'),
				'projection_id'  => $projection_id,
				'projection_type' => 'dream',
				'permission' => $this->input->post('permission'),
 				'invite_date' => time(),
			);
			$this->db->set($save_array);
			$this->db->insert('tbl_invite_projection_friends');
			$main_id = $this->db->insert_id();
			
			$key_url = $add_user_id."-".$projection_id."-".$main_id;
			$key_url = base64_encode($key_url);
			
			$this->db->set('key_url',$key_url);
			$this->db->where('main_id', $main_id);
			$this->db->update('tbl_invite_projection_friends');
			return $key_url;
		}
	}
	public function get_guest_projection_details($projection_id,$key_url)
	{
		$this->db->select("p.*,i.permission");
 		$this->db->where("p.projection_id",$projection_id);
		$this->db->where("i.key_url",$key_url);
		$this->db->where("i.projection_type",'dream');
   		$this->db->from('tbl_dream_projections as p');
		$this->db->join('tbl_invite_projection_friends as i','p.projection_id=i.projection_id','inner');
  		$query = $this->db->get();
 		if($query->num_rows())
		{
 			return $query->row();
		}
	}
	public function get_projection_array_row($projection_id)
	{
		$this->db->select("*");
 		$this->db->where("projection_id",$projection_id);
   		$this->db->from('tbl_dream_projections');
  		$query = $this->db->get();
 		if($query->num_rows())
		{
 			return $query->row_array();
		}
	}
	public function CopyProjection($projection_id)
	{
		$data = array();
		$data = $this->get_projection_array_row($projection_id);
		array_shift($data);
		if(!empty($data))
		{
			$this->db->insert('tbl_dream_projections', $data);
			$insert_id = $this->db->insert_id();
			$update_array = array(
				'parent_id'  => $projection_id,
				'add_date'  => time(),
			);
			$this->db->set($update_array);
			$this->db->where('projection_id',$insert_id);
			$this->db->update('tbl_dream_projections');
		}
 	}
}
?>