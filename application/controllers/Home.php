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
		$header_data = array('page_title' => $this->lang->line('lang_home_label'));
		$data['add_review_link'] = add_review_link();
		$data['start_test_link'] = start_test_link();
  		load_web_main_template('home_v', $header_data,$data);
	}

		public function changeLanguage($lang)
	{
		if (isset($_SESSION['lng'])) {
			$_SESSION['lng'] = $lang;
		} else {

			$this->session->set_userdata('lng', $lang);
		}

		redirect('home', 'refresh');
	}

}
