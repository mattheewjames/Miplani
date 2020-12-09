<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Web_Profile_Controller extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
		if (!isset($_SESSION['lng'])) {
			$this->session->set_userdata('lng', 'EN');
		}
		if($_SESSION['lng']=='EN')
		{
       $this->lang->load('information','english');
   }
   else
   {
   	$this->lang->load('information','spanish');
   }
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