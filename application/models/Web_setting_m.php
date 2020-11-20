<?php
class Web_setting_m extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
	public function get_pricing_plan_row($plan_id)
	{
		$this->db->select("*");
		$this->db->where("plan_id",$plan_id);
		$this->db->where("plan_type!=",'free');
 		$this->db->from('tbl_pricing_plans');
 		$query = $this->db->get();
 		if($query->num_rows())
		{
 			return $query->row();
		}
	}
	public function get_sub_coupon_row($coupon_code)
	{
		$this->db->select("*");
		$this->db->where("coupon_code",$coupon_code);
 		$this->db->from('tbl_coupons');
 		$query = $this->db->get();
 		if($query->num_rows())
		{
 			return $query->row();
		}
	}
	public function is_user_already_used_coupon_code($coupon_code,$user_id)
	{
		$this->db->select("stat_id");
		$this->db->where("coupon_code",$coupon_code);
		$this->db->where("user_id",$user_id);
 		$this->db->from('tbl_user_coupon_statistics');
 		$query = $this->db->get();
		return $query->num_rows();
	}
	public function ceck_coupon_usage($coupon_code)
	{
		$this->db->select("total_usage");
		$this->db->where("coupon_code",$coupon_code);
 		$this->db->from('tbl_coupons');
 		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			return $query->row()->total_usage;
		}
	}
	public function is_user_post_review($user_id)
	{
		$this->db->select("review_id");
		$this->db->where("user_id",$user_id);
 		$this->db->from('tbl_reviews');
 		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function PostReview()
	{
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$add_array = array(
				'user_id'  => $this->session->userdata('MiPlani_user_id'),
				'rating'  => $this->input->post('rating'),
				'review_details'  => $this->input->post('review'),
				'review_date' => time()
			);
			$this->db->set($add_array);
			$this->db->insert('tbl_reviews');
		}
	}
	public function get_reviews_count()
	{
		$this->db->select('r.review_id');
		$this->db->from('tbl_reviews as r');
		$this->db->join('tbl_users as u','r.user_id=u.user_id','inner');
   		$query = $this->db->get();
  		return $query->num_rows();
	}
	public function get_reviews_data($limit,$start)
	{	
		$this->db->select("r.*, CONCAT(u.first_name, ' ', u.last_name) as name");
		$this->db->from('tbl_reviews as r');
		$this->db->join('tbl_users as u','r.user_id=u.user_id','inner');
 		$this->db->order_by('r.review_id','desc');
		$this->db->limit($start, $limit);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
	public function is_user_subscribe_newsletter($email)
	{
		$this->db->select("sub_news_id");
		$this->db->where("email",$email);
 		$this->db->from('tbl_newsletter_subscriptions');
 		$query = $this->db->get();
		return $query->num_rows();
	}
	public function NewsletterSubscriptions()
	{
		$add_array = array(
 			'name'  => $this->input->post('sub_name'),
			'email' => $this->input->post('sub_email'),
			'sub_date' => time()
		);
		$this->db->set($add_array);
		$this->db->insert('tbl_newsletter_subscriptions');
 	}
	
	public function check_coupon_code($coupon_code)
	{
		$this->db->select("coupon_id");
		$this->db->where("coupon_code",$coupon_code);
 		$this->db->from('tbl_coupons');
 		$query = $this->db->get();
		return $query->num_rows();
	}
}
?>