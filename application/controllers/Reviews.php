<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reviews extends MY_Web_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
  		$header_data = array('page_title' => 'Reviews');
  		load_web_main_template('reviews_v', $header_data,'');
	}
	
	public function Add()
	{
  		$header_data = array('page_title' => 'Add Review');
  		load_web_main_template('write_a_review_v', $header_data,'');
	}
	public function AjaxReviews()
	{
		$this->load->model("Web_setting_m","setting");
 		$data = array();
		$data['page_number'] = 0;
		$data['error_message'] = '';
 		
		if(!empty($_POST['page_number']))
		{
			$data['page_number'] = $_POST['page_number'];
		}
		if(!empty($_POST['page_number']))
		{
			$perPage = 10;
			$total_records = $this->setting->get_reviews_count();
			$data['total_pages'] = ceil($total_records/$perPage);
			$data['start'] = ceil(($data['page_number']-1) * $perPage);
			$data['results'] = $this->setting->get_reviews_data($data['start'],$perPage);
		}
		else
		{
			$data['error_message'] = 'No Record Found!';
		}
   		$this->load->view("web-ajax-views-files/ajax-reviews-list",$data);
	}
}
