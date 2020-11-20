<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Logout extends CI_Controller 
{
	public function index()
	{
 		$data = array('MiPlani_oauth_provider','MiPlani_user_name','MiPlani_user_id');
 		$this->session->unset_userdata($data);
		
 		$this->load->library('facebook');
		$this->facebook->destroy_session();
		
		
		//return redirect(base_url());
		?>
			<script>window.location.href = 'https://miplani.com/en/recommend-us-to-your-friends/';</script>
		<?php
	}
}
