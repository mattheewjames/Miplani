<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Web_Controller extends CI_Controller 
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
  	}
}
?>