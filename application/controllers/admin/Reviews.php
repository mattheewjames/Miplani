<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reviews extends MY_Admin_Controller {
    
    public function index()
    {
		$header_data = array('page_title' => 'List of Reviews');
		$this->data['reviews'] = $this->db->query("select tbl_reviews.*, tbl_users.first_name, tbl_users.last_name from tbl_reviews left join tbl_users on tbl_reviews.user_id = tbl_users.user_id order by tbl_reviews.review_id desc")->result();
		//echo '<pre>'; print_r($this->data['reviews']); exit;
		load_admin_main_template('admin/list_review', $header_data,$this->data);
    }
	
	public function delete_review(){  
		
		$review_id = $this->input->post('review_id');
		$this->db->where('review_id', $review_id)->delete('tbl_reviews');
		echo "success";
		exit;
		
	}

}
