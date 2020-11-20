<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Logout extends CI_Controller 
{
	public function index()
	{
 		$data = array('MiPlani_admin_id','MiPlani_admin_user_type');
 		$this->session->unset_userdata($data);
		return redirect(base_admin_url('login'));
	}
}
