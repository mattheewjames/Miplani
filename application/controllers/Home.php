<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends MY_Web_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
 	public function index()
	{
		 // print_r($this->session->userdata());
			//  exit();
  		$header_data = array('page_title' => $this->lang->line('lang_home_label'));
		$data['add_review_link'] = add_review_link();
		$data['start_test_link'] = start_test_link();
  		load_web_main_template('home_v', $header_data,$data);
	}
}
