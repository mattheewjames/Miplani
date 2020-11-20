<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projections extends MY_Admin_Controller {
	
	public function index() {
		
		$this->data['page_title']='Manage Projections';
		$projections = $this->db->query("select * from tbl_projections order by projection_id desc")->result();
		foreach($projections as $p){
			$p->username = '';
			$res = $this->db->query("select username from tbl_users where user_id = '".$p->user_id."' ")->row();
			if($res){
				$p->username = $res->username;
			}
			 
		}
		$this->data['projections'] = $projections;
		
		$header_data = array('page_title' => 'Manage Projections');
		load_admin_main_template('admin/list_projections', $header_data,$this->data);
	}

}

