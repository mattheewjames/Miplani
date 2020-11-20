<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends MY_Admin_Controller {
	
	public function index() {
		
		$this->data['page_title']='Manage Transactions';
		$payments = $this->db->query("select * from tbl_user_payments order by payment_id desc")->result();
		foreach($payments as $p){
			$p->username = '';
			$res = $this->db->query("select username from tbl_users where user_id = '".$p->user_id."' ")->row();
			if($res){
				$p->username = $res->username;
			}
			$p->plan_name = '';
			$res1 = $this->db->query("select plan_name from tbl_pricing_plans where plan_id = '".$p->plan_id."' ")->row();
			if($res1){
				$p->plan_name = $res1->plan_name;
			}
			
			 
		}
		$this->data['payments'] = $payments;
		
		$header_data = array('page_title' => 'Manage Payments');
		load_admin_main_template('admin/list_payments', $header_data,$this->data);
	}

}

