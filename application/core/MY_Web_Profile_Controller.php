<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Web_Profile_Controller extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->lang->load('information','english');
		$this->checkLoginStatus();
  	}
	protected function checkLoginStatus() 
	{
		if(empty($this->session->userdata('MiPlani_user_id'))) 
		{
			redirect(base_url());
		}
	} 
}
?>