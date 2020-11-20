<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pages extends MY_Web_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
	public function PrivacyPolicy()
	{
  		$header_data = array('page_title' => $this->lang->line('lang_privacy_policy_label'));
  		load_web_main_template('pages/privacy_policy_v', $header_data,'');
	}
	
	public function HowsItsWork()
	{
  		$header_data = array('page_title' => 'How Its Work');
  		load_web_main_template('pages/how_its_work_v', $header_data,'');
	}
	public function PricingPlan()
	{
		$header_data = array('page_title' => 'Pricing plan');
		$data['add_review_link'] = add_review_link(); 
		$data['start_test_link'] = start_test_link();
  		load_web_main_template('pages/pricing_plan_v', $header_data,$data);
	}
	public function Characteristics()
	{
		$header_data = array('page_title' => 'Characteristics');
  		load_web_main_template('pages/characteristics_v', $header_data,'');
	}
	public function Faq()
	{
		$header_data = array('page_title' => 'Faq');
  		load_web_main_template('pages/faq_v', $header_data,'');
	}
	public function AboutUs()
	{
		$header_data = array('page_title' => 'About Us');
  		load_web_main_template('pages/about_us_v', $header_data,'');
	}
	
	public function ContactUs()
	{
		$header_data = array('page_title' => 'Contact Us');
  		load_web_main_template('pages/contact_us_v', $header_data,'');
	}
	public function AboutApp()
	{
		$header_data = array('page_title' => 'About the application');
  		load_web_main_template('pages/about_app_v', $header_data,'');
	}
	public function Affiliate()
	{
		$header_data = array('page_title' => 'Affiliate');
  		load_web_main_template('pages/affiliate_v', $header_data,'');
	}
	public function Features()
	{
		$header_data = array('page_title' => 'Features');
  		load_web_main_template('pages/features_v', $header_data,'');
	}
	public function Tutorials()
	{
		$header_data = array('page_title' => 'Tutorials');
  		load_web_main_template('pages/tutorials_v', $header_data,'');
	}
	public function WhatsNew()
	{
		$header_data = array('page_title' => 'Whats New');
  		load_web_main_template('pages/whats_new_v', $header_data,'');
	}
	public function Applicationstatus()
	{
		$header_data = array('page_title' => 'Application Status');
  		load_web_main_template('pages/application_status_v', $header_data,'');
	}
	
	public function HelpCenter()
	{
		$header_data = array('page_title' => 'Help Center');
  		load_web_main_template('pages/help_center_v', $header_data,'');
	}
	
	public function Customers()
	{
		$header_data = array('page_title' => 'Customers');
  		load_web_main_template('pages/customers_v', $header_data,'');
	}
	
	public function Recommendations()
	{
		$header_data = array('page_title' => 'Recommendations');
  		load_web_main_template('pages/recommendations_v', $header_data,'');
	}
	
	public function MediaRelations()
	{
		$header_data = array('page_title' => 'MediaRelations');
  		load_web_main_template('pages/media_relations_v', $header_data,'');
	}
	
	public function SiteMap()
	{
		$header_data = array('page_title' => 'Site Map');
  		load_web_main_template('pages/site_map_v', $header_data,'');
	}
	public function Blog()
	{
		$header_data = array('page_title' => 'Site Map');
  		load_web_main_template('pages/blog_v', $header_data,'');
	}
	public function Books()
	{
		$header_data = array('page_title' => 'Books');
  		load_web_main_template('pages/books_v', $header_data,'');
	}
	public function Community()
	{
		$header_data = array('page_title' => 'Community');
  		load_web_main_template('pages/community_v', $header_data,'');
	}
	public function Resources()
	{
		$header_data = array('page_title' => 'Resources');
  		load_web_main_template('pages/resources_v', $header_data,'');
	}
	
	public function LoyaltyPrograms()
	{
		$header_data = array('page_title' => 'Loyalty Program');
  		load_web_main_template('pages/loyalty_programs_v', $header_data,'');
	}
	
	public function InfluencersPrograms()
	{
		$header_data = array('page_title' => 'Influencers Program');
  		load_web_main_template('pages/influencers_programs_v', $header_data,'');
	}
	
	
	public function AppComparision()
	{
		$header_data = array('page_title' => 'AppComparision');
  		load_web_main_template('pages/app_comparision_v', $header_data,'');
	}
	public function Competition()
	{
		$header_data = array('page_title' => 'Competition');
  		load_web_main_template('pages/competition_v', $header_data,'');
	}
	public function BecomeAPartner()
	{
		$header_data = array('page_title' => 'Become A Partner');
  		load_web_main_template('pages/bacome_a_partner_v', $header_data,'');
	}
	
	public function RecommendToFriends()
	{
		$header_data = array('page_title' => 'Recommend us to your friends');
  		load_web_main_template('pages/recommend_to_friends_v', $header_data,'');
	}
	public function CollaboratorsBiography()
	{
		$header_data = array('page_title' => 'Latest contributor articles');
  		load_web_main_template('pages/latest_contributor_articles_v', $header_data,'');
	}
	
	public function LatestArticles()
	{
		$header_data = array('page_title' => 'Collaborators Biography');
  		load_web_main_template('pages/collaborators_biography_v', $header_data,'');
	}
	public function verification()
	{
		$header_data = array('page_title' => $this->lang->line('lang_email_verification_label'));
		$this->load->model("Users_m","users");
		$data['error_message'] ='';
		if(!empty($_GET['link']))
		{
			$link = base64_decode($_GET['link']);
			$user_id = strtok($link,'The');
			if($user_id>0)
			{
				$data['user_row'] = $this->users->get_pending_user_row($user_id);
				if(!empty($data['user_row']))
				{
					$this->users->update_user_email_verification($user_id);
					if($data['user_row']->is_verify_email=='Yes')
					{
						$data['error_message'] = $this->lang->line('lang_email_already_verified_label');
					}
				}
				else
				{
					$data['error_message'] = $this->lang->line('lang_invalid_link_access_error');
				}
			}
			else
			{
				$data['error_message'] = $this->lang->line('lang_invalid_link_access_error');
			}
		}
		load_web_main_template('verify_user_v', $header_data,$data);
	}
	
	
	public function ViewProjection()
	{
 		$header_data = array('page_title' => 'View Projection');
		$this->load->model("Projection_m","projection");
		$data['error_message'] ='';
		if(!empty($_GET['key_id']))
		{
			$projection_id = base64_decode($this->input->get('key_id', TRUE));
			if($this->projection->check_active_projection_record($projection_id)>0)
			{
				$data['row'] = $this->projection->get_projection_details($projection_id);
				if(empty($data['row']))
				{
					$data['error_message'] = 'Please select valid record';
				}
			}
			else
			{
				$data['error_message'] = 'The projection does not exist or this projection is not active';
			}
		}
 		else
		{
			$data['error_message'] = 'Please select valid record';
		}
   		load_web_main_template('view_projection_v', $header_data,$data);
	}
	public function ViewMainProjection()
	{
 		$header_data = array('page_title' => 'View Projection');
		$this->load->model("ProjectionMain_m","projection");
		$data['error_message'] ='';
		if(!empty($_GET['key_id']))
		{
			$projection_id = base64_decode($this->input->get('key_id', TRUE));
			if($this->projection->check_active_projection_record($projection_id)>0)
			{
				$data['row'] = $this->projection->get_projection_details($projection_id);
				if(empty($data['row']))
				{
					$data['error_message'] = 'Please select valid record';
				}
			}
			else
			{
				$data['error_message'] = 'The projection does not exist or this projection is not active';
			}
		}
 		else
		{
			$data['error_message'] = 'Please select valid record';
		}
   		load_web_main_template('view_main_projection_v', $header_data,$data);
	}
	public function ProjectionAjaxComments()
	{
		$this->load->model("Projection_m","projection");
 		$data = array();
		$data['page_number'] = 0;
		$data['error_message'] = '';
 		
		if(!empty($_POST['page_number']))
		{
			$data['page_number'] = $_POST['page_number'];
		}
		if(!empty($_POST['type']))
		{
			$data['type'] = $_POST['type'];
		}
		if(!empty($_POST['id']))
		{
			$data['id'] = $_POST['id'];
		}
		if(!empty($_POST['page_number']) && !empty($_POST['type']) && !empty($_POST['id']))
		{
			$projection_id = base64_decode($this->input->post('id'));
			$projection_type = $this->input->post('type');
			$perPage = 10;
			$total_records = $this->projection->get_projection_count($projection_id,$projection_type);
			$data['total_pages'] = ceil($total_records/$perPage);
			$data['start'] = ceil(($data['page_number']-1) * $perPage);
			$data['results'] = $this->projection->get_projection_data($data['start'],$perPage,$projection_id,$projection_type);
			$data['total_comments'] = $total_records;
			$data['id'] = $this->input->post('id');
		}
		else
		{
			$data['error_message'] = 'No Record Found!';
		}
   		$this->load->view("web-ajax-views-files/ajax-projection-comments-list",$data);
	}
	public function checkout()
	{
		$header_data = array('page_title' => 'Checkout');
		$this->load->model("Users_m","users");
		$this->load->model("Web_setting_m","setting");
 		$data['error_message'] ='';
		$plan_id = 0;
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			if(!empty($_GET['key_id']))
			{
				$plan_id = base64_decode($this->input->get('key_id', TRUE));
 			}
			if($plan_id>0)
			{
 				$data['user_row'] = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
				if(!empty($data['user_row']))
				{
					$data['plan_row'] = $this->setting->get_pricing_plan_row($plan_id);
				}
				else
				{
					$data['error_message'] = $this->lang->line('lang_sign_in_to_continue_error');
				}
			}
			else
			{
				$data['error_message'] = 'Please select valid plan';
			}
		}
		else
		{
			$data['error_message'] = $this->lang->line('lang_sign_in_to_continue_error');
		}
  		load_web_main_template('checkout_v', $header_data,$data);
	}
	public function UseCouponCode()
	{
		$response_code = 404;
		$response_message = '';
		$html = '';
		$this->load->model("Users_m","users");
		$this->load->model("Web_setting_m","setting");
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$user_row = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(!empty($user_row))
			{
				if(!empty($_POST['code']) && !empty($_POST['pid']))
				{
					$pricing_plan_id = base64_decode($this->input->post('pid', TRUE));
					$plan_row = $this->setting->get_pricing_plan_row($pricing_plan_id);
					if(!empty($plan_row))
					{
						$coupon_code = $this->input->post('code', TRUE);
						$coupon_row = $this->setting->get_sub_coupon_row($coupon_code);
						if(!empty($coupon_row))
						{
							if(time()>$coupon_row->coupon_expiry_date)
							{
								$response_message = 'This coupon code is expired';
							}
							elseif(time()<=$coupon_row->coupon_start_date)
							{
								$response_message = 'This coupon code is not valid';
							}
							elseif($this->setting->ceck_coupon_usage($coupon_code)>=$coupon_row->frequency)
							{
								$response_message = 'This coupon code is no more valid';
							}
							else
							{
								$total_discount = 0;
								$plan_price = $plan_row->plan_price;
								$total_amount = $plan_price;
								if($plan_price>0)
								{
									$coupon_discount_amount = $coupon_row->coupon_discount_amount;
									$discount_percentage = number_format($coupon_discount_amount, 2, '.', '');
									$total_discount =  $plan_price/$discount_percentage;
									$total_amount = number_format($plan_price-$total_discount, 2, '.', '');
								}
								$html .='<h3>Your package : '.$plan_row->plan_name.'</h3>
										<div class="order_table table-responsive">
										<table>
											<thead>
												<tr>
													<th>Product</th>
													<th>Total</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>Package price</th>
													<td><strong>$'.$plan_price.'</strong></td>
												</tr>
												<tr>
													<th>Discount</th>
													<td><strong>'.$coupon_row->coupon_discount_amount.'%</strong></td>
												</tr>
												<tr class="order_total">
													<th>Total</th>
													<td><strong>$'.$total_amount.'</strong></td>
												</tr></tfoot>
									</table>
								</div>';
								$html .= '<div class="order_button pull-right">
										<a href="'.base_url('pages/Order?key_id='.base64_encode($plan_row->plan_id).'&code='.base64_encode($coupon_code)).'"><button type="button">Proceed</button></a>
									</div>';
								$response_code = 200;
							}
						}
						else
						{
							$response_message = 'please enter valid coupon code';
						}
					}
					else
					{
						$response_message = 'please select valid plan';
					}
				}
				else
				{
					$response_message = 'please enter coupon code';
				}
			}
			else
			{
				$response_message = $this->lang->line('lang_sign_in_to_continue_error');
			}
 		}
		else
		{
			$response_message = $this->lang->line('lang_sign_in_to_continue_error');
		}
		echo json_encode(array("response_code"=>$response_code,"response_message"=>$response_message,"html"=>$html));
		exit;
	}
	 
	public function Order()
	{
		
 		$status_flag = 0;
		$plan_id = 0;
		$coupon_code = '';
		$total_discount = 0;
		$total_amount = 0;
		$plan_price = 0;
		$data['error_message'] = '';
		$this->load->model("Users_m","users");
		$this->load->model("Web_setting_m","setting");
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$user_row = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(!empty($user_row))
			{
				if(!empty($_GET['key_id']))
				{
					$pricing_plan_id = base64_decode($this->input->get('key_id', TRUE));
					$plan_row = $this->setting->get_pricing_plan_row($pricing_plan_id);
					if(!empty($plan_row))
					{
 						if(!empty($_GET['code']))
						{
							$coupon = base64_decode($this->input->get('code', TRUE));
							$coupon_row = $this->setting->get_sub_coupon_row($coupon);
							if(!empty($coupon_row))
							{
								$coupon_code = $coupon_row->coupon_code;
 								if(time()>$coupon_row->coupon_expiry_date)
								{
									$data['error_message'] = 'This coupon code is expired';
								}
								elseif(time()<=$coupon_row->coupon_start_date)
								{
									$data['error_message'] = 'This coupon code is not valid';
								}
								elseif($this->setting->ceck_coupon_usage($coupon_code)>=$coupon_row->frequency)
								{
									$data['error_message'] = 'This coupon code is no more valid';
								}
								else
								{
									$plan_price = $plan_row->plan_price;
									$total_amount = $plan_price;
									if($plan_price>0)
									{
										$coupon_discount_amount = $coupon_row->coupon_discount_amount;
										$discount_percentage = number_format($coupon_discount_amount, 2, '.', '');
										$total_discount =  number_format($plan_price/$discount_percentage, 2, '.', '');
										$total_amount = number_format($plan_price-$total_discount, 2, '.', '');
									}
									if($total_amount>0)
									{
										$status_flag = 1;
									}
									else
									{
										$data['error_message'] = 'We cannot proceed with 0 amount';
									}
								}
							}
							else
							{
								$data['error_message'] = 'please enter valid coupon code';
							}
						}
						else
						{
							$total_amount = $plan_row->plan_price;
							if($total_amount>0)
							{
								$status_flag = 1;
							}
							else
							{
								$data['error_message'] = 'We cannot proceed with 0 amount';
							}
						}
						
					}
					else
					{
						$data['error_message'] = 'please select valid plan';
					}
				}
				else
				{
					$data['error_message'] = 'please enter coupon code';
				}
			}
			else
			{
				$data['error_message'] = $this->lang->line('lang_sign_in_to_continue_error');
			}
 		}
		else
		{
			$data['error_message'] = $this->lang->line('lang_sign_in_to_continue_error');
		}
		if($status_flag==1)
		{
			$payment_method = 'paypal';
			if(!empty($_POST['payment_method']))
			{
				if($_POST['payment_method']=='card')
				{
					$payment_method = 'card';
				}
			}
			if($payment_method=='card')
			{
				$data['amount'] = $total_amount;
				$data['plan_row'] = $plan_row;
				$data['coupon_code'] = $coupon_code;
				$data['total_discount'] = $total_discount;
				$data['currency_code'] = 'USD';
				$data['user_row'] = $user_row;
				$header_data = array('page_title' => 'Credt card Payment');
				load_web_main_template('checkout_card_v', $header_data, $data);
			}
			else
			{
				$this->load->library('paypal_lib');
				// Set variables for paypal form
				$returnURL = base_url('pages/ConfirmPayment');
				$cancelURL = base_url('pages/cancel');
				$notifyURL = base_url('pages/ipn');

				// Add fields to paypal form
				$this->paypal_lib->add_field('return', $returnURL);
				$this->paypal_lib->add_field('cancel_return', $cancelURL);
				$this->paypal_lib->add_field('notify_url', $notifyURL);
				//$this->paypal_lib->add_field('user_id', $this->session->userdata('MiPlani_user_id'));
				$this->paypal_lib->add_field('custom', $this->session->userdata('MiPlani_user_id'));
				$this->paypal_lib->add_field('amount',  $total_amount);
				$this->paypal_lib->add_field('item_name',  $plan_row->plan_id);
				$this->paypal_lib->add_field('item_number', $coupon_code);
				$this->paypal_lib->add_field('currency_code',  'USD');
				// Render paypal form
				$this->paypal_lib->paypal_auto_form();
			}
 		}
		else
		{
			$header_data = array('page_title' => '404 Page');
			load_web_main_template('checkout_error_v', $header_data, '');	
		}
	}
	public function ConfirmPayment()
	{
		$this->load->library('paypal_lib');
        // Get the transaction data
  		if(!empty($_POST))
		{
			$paypalInfo = $this->input->post();
			// echo "<pre>";
			// print_r($paypalInfo['custom']);
			// echo "</pre>";
			// exit();
   			if(!empty($paypalInfo))
			{
				if($paypalInfo['payment_status']=='Completed')
				{
					$coupon_code = '';
					if(!empty($paypalInfo['item_number']))
					{
						$coupon_code = $paypalInfo['item_number'];
					}
					elseif(!empty($paypalInfo['item_number1']))
					{
						$coupon_code = $paypalInfo['item_number1'];
					}
					$this->load->model("Users_m","user");
					if(!empty($paypalInfo['item_name']))
					{
						$this->user->add_user_payment($paypalInfo['item_name'],$paypalInfo['mc_gross'],$paypalInfo['custom'],$coupon_code);
					}
					elseif(!empty($paypalInfo['item_name1']))
					{
						$this->user->add_user_payment($paypalInfo['item_name1'],$paypalInfo['mc_gross'],$paypalInfo['custom'],$coupon_code);
					}
					unset($paypalInfo);
					redirect("pages/success");
				}
			}
		}
		else
		{
			$this->cancel();
		}
    }
     
	public function cancel()
	{
		$header_data = array('page_title' => 'Cancel Payment');
 		load_web_main_template('cancel_payment_v', $header_data, '');	
	}
	public function success()
	{
		$header_data = array('page_title' => 'Payment successful');
 		load_web_main_template('sucess_payment_v', $header_data, '');	
	}
	
	public function ShareProjectionSocialMedia()
	{
		$data['error_message'] ='';
		$data['page_title'] = 'Share';
		$this->load->model("Projection_m","projection");
		if(!empty($_GET['key_id']))
		{
			$peojection_id = base64_decode($this->input->get('key_id', TRUE));
			$data['row'] = $this->projection->get_projection_details($peojection_id);
			if(empty($data['row']))
			{
				$data['error_message'] = 'Please select valid record';
			}
		}
		else
		{
			$data['error_message'] = 'Please select valid record';
		}
    	$this->load->view("share_projection_social_media_v",$data);
 	}
	public function ShareMainProjectionSocialMedia()
	{
		$data['error_message'] ='';
		$data['page_title'] = 'Share';
		$this->load->model("ProjectionMain_m","projection");
		if(!empty($_GET['key_id']))
		{
			$peojection_id = base64_decode($this->input->get('key_id', TRUE));
			$data['row'] = $this->projection->get_projection_details($peojection_id);
			if(empty($data['row']))
			{
				$data['error_message'] = 'Please select valid record';
			}
		}
		else
		{
			$data['error_message'] = 'Please select valid record';
		}
    	$this->load->view("share_main_projection_social_media_v",$data);
 	}
	public function InviteProjectionFriend()
	{
		$data['error_message'] ='';
		$data['page_title'] = 'Invite Friend';
 		$this->load->model("Users_m","users");
		$this->load->model("Projection_m","projection");
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$data['user_row'] = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(!empty($data['user_row']))
			{
				if(!empty($_GET['key_id']))
				{
					$peojection_id = base64_decode($this->input->get('key_id', TRUE));
					$data['row'] = $this->projection->get_projection_row($peojection_id,$this->session->userdata('MiPlani_user_id'));
					if(empty($data['row']))
					{
						$data['error_message'] = 'Please select valid record';
					}
				}
				else
				{
					$data['error_message'] = 'Please select valid record';
				}
 			}
			else
			{
				$data['error_message'] = $this->lang->line('lang_sign_in_to_continue_error');
			}
		}
		else
		{
			$data['error_message'] = $this->lang->line('lang_sign_in_to_continue_error');
		}
    	$this->load->view("invite_projection_friend_v",$data);
	}
	
	public function InviteMainProjectionFriend()
	{
		$data['error_message'] ='';
		$data['page_title'] = 'Invite Friend';
 		$this->load->model("Users_m","users");
		$this->load->model("Projection_m","projection");
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$data['user_row'] = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(!empty($data['user_row']))
			{
				if(!empty($_GET['key_id']))
				{
					$peojection_id = base64_decode($this->input->get('key_id', TRUE));
					$data['row'] = $this->projection->get_projection_row($peojection_id,$this->session->userdata('MiPlani_user_id'));
					if(empty($data['row']))
					{
						$data['error_message'] = 'Please select valid record';
					}
				}
				else
				{
					$data['error_message'] = 'Please select valid record';
				}
 			}
			else
			{
				$data['error_message'] = $this->lang->line('lang_sign_in_to_continue_error');
			}
		}
		else
		{
			$data['error_message'] = $this->lang->line('lang_sign_in_to_continue_error');
		}
    	$this->load->view("invite_main_projection_friend_v",$data);
	}
	
	public function DownloadProjection()
	{
		$html = '';
		$this->load->model("Projection_m","projection");
		$this->load->helper('download');
		$this->load->helper('file');
 		if(!empty($_GET['key_id']))
		{
			$peojection_id = base64_decode($this->input->get('key_id', TRUE));
			$row = $this->projection->get_projection_details($peojection_id);
			if(!empty($row))
			{
				$annual_profit = 0;
				$monthly_profit = 0;
				$quarterly_profit = 0;
				$weekly_profit = 0;
				$daily_profit = 0;
				$rio = 0;
				
				$annual_profit = $row->annual_billing-$row->total_annual_expenses;
				if($annual_profit!=0)
				{
					$quarterly_profit = $annual_profit/4;
					$quarterly_profit = number_format($quarterly_profit, 2, '.', '');
					$quarterly_profit = round($quarterly_profit);


					$monthly_profit = $annual_profit/12;
					$monthly_profit = number_format($monthly_profit, 2, '.', '');
					$monthly_profit = round($monthly_profit);

					$weekly_profit = $annual_profit/52;
					$weekly_profit = number_format($weekly_profit, 2, '.', '');
					$weekly_profit = round($weekly_profit);

					$daily_profit = $annual_profit/365;
					$daily_profit = number_format($daily_profit, 2, '.', '');
					$daily_profit = round($daily_profit);
					if($projection_row->total_annual_expenses!=0)
					{
						$rio = ($annual_profit/$projection_row->total_annual_expenses) * 100;
						$rio = number_format($rio, 2, '.', '');
						$rio = round($rio);
					}
				}
				
				$annual_qualified_web_traffic_volume = $row->annual_qualified_web_traffic_volume;
						
				$quarterly_qualified_web_traffic_volume = 0;
				$monthly_qualified_web_traffic_volume = 0;
				$weekly_qualified_web_traffic_volume = 0;
				$daily_qualified_web_traffic_volume = 0;
				if($annual_qualified_web_traffic_volume>0)
				{
					$quarterly_qualified_web_traffic_volume = round($annual_qualified_web_traffic_volume/4);
					$monthly_qualified_web_traffic_volume = round($annual_qualified_web_traffic_volume/12);
					$weekly_qualified_web_traffic_volume = round($annual_qualified_web_traffic_volume/52);
					$daily_qualified_web_traffic_volume = round($annual_qualified_web_traffic_volume/365);
				}

				$annual_potential_customer_buy_one_item  = $row->annual_potential_customer_buy_one_item;

				$quarterly_potential_customer_buy_one_item = 0;
				$monthly_potential_customer_buy_one_item = 0;
				$weekly_potential_customer_buy_one_item = 0;
				$daily_potential_customer_buy_one_item = 0;
				if($annual_potential_customer_buy_one_item>0)
				{
					$quarterly_potential_customer_buy_one_item = round($annual_potential_customer_buy_one_item/4);
					$monthly_potential_customer_buy_one_item = round($annual_potential_customer_buy_one_item/12);
					$weekly_potential_customer_buy_one_item = round($annual_potential_customer_buy_one_item/52);
					$daily_potential_customer_buy_one_item = round($annual_potential_customer_buy_one_item/365);
				}
				
				$daily_benefits = $row->daily_revenue-$row->total_daily_expenses;
				$weekly_benefits = $row->weekly_revenue-$row->total_weekly_expenses;
				$monthly_benefits = $row->monthly_revenue-$row->total_monthly_expenses;
				$quaterly_benefits = $row->quaterly_revenue-$row->total_quaterly_expenses;
				$annual_benefits = $row->annual_revenue-$row->total_annual_expenses;
				$roi = 0;
				$roi_monetary = 0;
				if($annual_benefits!=0 && $row->total_annual_expenses!=0)
				{
					$roi = number_format((($annual_benefits/$row->total_annual_expenses) *100), 4, '.', '');
					$roi_monetary = number_format(((($annual_benefits/$row->total_annual_expenses) *100)*$row->total_annual_expenses), 4, '.', '');	
				}
				
				$this->load->library('pdf');
				$upload_file_name = $row->projection_id.".pdf";
				$pdf_file_path = FCPATH.'uploads/projections/'.$upload_file_name;
				$html .= '<style>table,tr,th,td{ border:1px solid #ddd;border-collapse: collapse !important;} .main_bg{#:#4CAF50; .sub_bg{background-color:#4CAF50; .gray_bg{background-color:#f2f2f2;}</style>';
				$html .= '<table cellpadding="5" cellspacing="5" style="width: 90%; border: 1px sol #ddd;padding: 5%;">
							<tr>
								<td>
									<table cellpadding="5" cellspacing="5" style="width: 100%; border: 1px sol #ddd;">
										<tr>
											<th colspan="2">Summary of global expense</th>
										</tr>
										<tr class="sub_bg">
											<th colspan="2">Section I: Summary of advertising expenses</th>
										</tr>
										<tr>
											<td>Annual advertising expense</td>
											<td>'.$row->advertising_annual_expenses.' &euro;</td>
										</tr>
										<tr class="gray_bg">
											<td>Quarterly advertising expense</td>
											<td>'.$row->advertising_quaterly_expenses.' &euro;</td>
										</tr>
										<tr>
											<td>Monthly advertising expense</td>
											<td>'.$row->advertising_monthly_expenses.' &euro;</td>
										</tr>
										<tr class="gray_bg">
											<td>Weekly advertising expense</td>
											<td>'.$row->advertising_weekly_expenses.' &euro;</td>
										</tr>
										<tr>
											<td>Daily advertising expense</td>
											<td>'.$row->advertising_weekly_expenses.' &euro;</td>
										</tr>
									</table>
								</td>
							 </tr>
							 
							 <tr>
								<td>
									<table cellpadding="5" cellspacing="5" style="width: 100%; border: 1px sol #ddd;">
										<tr>
											<th colspan="2">Section II: Summary of operating expenses</th>
										</tr>
										<tr>
											<td>Annual operating expenses</td>
											<td>'.$row->operating_annual_expenses.' &euro;</td>
										</tr>
										<tr>
											<td>Quarterly operating expenses</td>
											<td>'.$row->operating_quaterly_expenses.' &euro;</td>
										</tr>
										<tr>
											<td>Monthly operating expenses</td>
											<td>'.$row->operating_monthly_expenses.' &euro;</td>
										</tr>
										<tr>
											<td>Weekly operating expenses</td>
											<td>'.$row->operating_weekly_expenses.' &euro;</td>
										</tr>
										<tr>
											<td>Daily operating expenses</td>
											<td>'.$row->operating_daily_expenses.' &euro;</td>
										</tr>
									</table>
								</td>
							 </tr>
							 
							 <tr>
								<td>
									<table cellpadding="5" cellspacing="5" style="width: 100%; border: 1px sol #ddd;">
										<tr>
											<th colspan="2">Section III:Summary of the cost of products or services sold</th>
										</tr>
										<tr>
											<td>Annual cost of products or services sold</td>
											<td>'.$row->annual_product_sold_cost.' &euro;</td>
										</tr>
										<tr>
											<td>Quarterly cost of products or services sold</td>
											<td>'.$row->quaterly_product_sold_cost.' &euro;</td>
										</tr>
										<tr>
											<td>Monthly cost of products or services sold</td>
											<td>'.$row->monthly_product_sold_cost.' &euro;</td>
										</tr>
										<tr>
											<td>Weekly cost of products or services sold</td>
											<td>'.$row->weekly_product_sold_cost.' &euro;</td>
										</tr>
										<tr>
											<td>Daily cost of products or services sold</td>
											<td>'.$row->daily_product_sold_cost .' &euro;</td>
										</tr>
									</table>
								</td>
							 </tr>
							 
							 <tr>
								<td>
									<table cellpadding="5" cellspacing="5" style="width: 100%; border: 1px sol #ddd;">
										<tr>
											<th colspan="2">Section IV: Summary of all expenses</th>
										</tr>
										<tr>
											<td>Total annual expenses</td>
											<td>'.$row->total_annual_expenses.' &euro;</td>
										</tr>
										<tr>
											<td>Total quarterly expenses</td>
											<td>'.$row->total_quaterly_expenses.' &euro;</td>
										</tr>
										<tr>
											<td>Total monthly expenses</td>
											<td>'.$row->total_monthly_expenses.' &euro;</td>
										</tr>
										<tr>
											<td>Total weekly expenses</td>
											<td>'.$row->total_weekly_expenses.' &euro;</td>
										</tr>
										<tr>
											<td>Total daily expenses</td>
											<td>'.$row->total_daily_expenses .' &euro;</td>
										</tr>
									</table>
								</td>
							 </tr>
							 
							 <tr>
								<td>
									<table cellpadding="5" cellspacing="5" style="width: 100%; border: 1px sol #ddd;">
										<tr>
											<th colspan="2">Summary of the global analysis of your business</th>
										</tr>
										<tr class="sub_bg">
											<td colspan="2">Summary of your profits</td>
										</tr>
										<tr>
											<td>Here is the annual billing you established that you desired</td>
											<td>'.$row->annual_billing.' €</td>
										  </tr>
										  <tr>
											<td>Total annual expenses (€) found is</td>
											<td>'.$row->total_annual_expenses.' €</td>
										  </tr>
										  <tr>
											<td>Your annual profits is</td>
											<td>'.$annual_profit.' €</td>
										  </tr>
										  <tr>
											<td>Your quarterly profits is</td>
											<td>'.$quarterly_profit.' €</td>
										  </tr>
										  <tr>
											<td>Your monthlhy profits is</td>
											<td>'.$monthly_profit.' €</td>
										  </tr>
										  <tr>
											<td>Your weekly profits is</td>
											<td>'.$weekly_profit.' €</td>
										  </tr>
										  <tr>
											<td>Your daily profits is</td>
											<td>'.$daily_profit.' €</td>
										  </tr>
										  <tr>
											<td>Your ROI (Return on investment) is</td>
											<td>'.$rio.'%</td>
										  </tr>
									</table>
								</td>
							 </tr>
							 
							 
							 <tr>
								<td>
									<table cellpadding="5" cellspacing="5" style="width: 100%; border: 1px sol #ddd;">
										<tr>
											<th colspan="2">Qualified web traffic & number 0f customers needed to achieve the desired financial goals</th>
										</tr>
										<tr class="sub_bg">
											<th colspan="2">Relevant data to achieve the desired billing</th>
										</tr>
										<tr>
											<td>Number of daily qualified visitors needed to your website</td>
											<td>'.$daily_qualified_web_traffic_volume.'</td>
										  </tr>
										  <tr>
											<td>Number of potential customers that must buy  at least one product per day</td>
											<td>'.$daily_potential_customer_buy_one_item.'</td>
										  </tr>
										  <tr>
											<td>Number of weekly qualified visitors needed to your website</td>
											<td>'.$weekly_qualified_web_traffic_volume.'</td>
										  </tr>
										  <tr>
											<td>Number of potential customers that must buy  at least one product per week</td>
											<td>'.$weekly_potential_customer_buy_one_item.'</td>
										  </tr>
										  <tr>
											<td>Number of monthly qualified visitors needed to your website</td>
											<td>'.$monthly_qualified_web_traffic_volume.'</td>
										  </tr>
										  <tr>
											<td>Number of potential customers that must buy  at least one product per month</td>
											<td>'.$monthly_potential_customer_buy_one_item.'</td>
										  </tr>
										  <tr>
											<td>Number of qualified visitors needed to your website quaterly</td>
											<td>'.$quarterly_qualified_web_traffic_volume.'</td>
										  </tr>
										  <tr>
											<td>Number of potential customers that must buy  at least one product quaterly</td>
											<td>'.$quarterly_potential_customer_buy_one_item.'</td>
										  </tr>
										  <tr>
											<td>Number of qualified visitors needed to your website per year</td>
											<td>'.$annual_qualified_web_traffic_volume.'</td>
										  </tr>
										  <tr>
											<td>Number of potential customers that must buy  at least one product per year</td>
											<td>'.$annual_potential_customer_buy_one_item.'</td>
										  </tr>
									</table>
								</td>
							 </tr>
							 
							 
							 <tr>
								<td>
									<table cellpadding="5" cellspacing="5" style="width: 100%; border: 1px sol #ddd;">
										<tr>
											<th colspan="2">Summary</th>
										</tr>
										<tr class="sub_bg">
											<th colspan="2">Project summary</th>
										</tr>
										<tr>
											<td>Your established financial goal</td>
											<td>'.$row->annual_billing.' &euro;</td>
										 </tr>
										 <tr>
											<td>Your established average price for the products / services to be sold</td>
											<td>'.$row->average_product_price.' &euro;</td>
										 </tr>
										 <tr class="sub_bg">
											<td colspan="2">Ideal revenue to reach your desired financial goal</td>
 										</tr>
										<tr>
											<td>Daily revenue</td>
 											<td>'.$row->daily_revenue.'</td>
										 </tr>
										 <tr>
											<td>Weekly revenue</td>
											<td>'.$row->weekly_revenue.'</td>
										 </tr>
										 <tr>
											<td>Monthly revenue</td>
 											<td>'.$row->monthly_revenue.'</td>
										 </tr>
										 <tr>
											<td>Quarterly revenue</td>
											<td>'.$row->quaterly_revenue.'</td>
										 </tr>
										 <tr>
											<td>Annual revenue</td>
											<td>'.$row->annual_revenue.'</td>
										 </tr>
										 <tr>
											<td colspan="2">Profits earned</td>
										  </tr>
										  <tr>
											<td>Daily benefits</td>
											<td>'.round($daily_benefits).' €</td>
										  </tr>
										  <tr>
											<td>Weekly benefits</td>
											<td>'.round($weekly_benefits).' €</td>
										  </tr>
										  <tr>
											<td>Monthly benefits</td>
											<td>'.round($monthly_benefits).' €</td>
										  </tr>
										  <tr>
											<td>Quarterly benefits</td>
											<td>'.round($quaterly_benefits).' €</td>
										  </tr>
										  <tr>
											<td>Annual benefits</td>
											<td>'.round($annual_benefits).' €</td>
										  </tr>
 									</table>
								</td>
							 </tr>
							 
							 <tr>
								<td>
									<table cellpadding="5" cellspacing="5" style="width: 100%; border: 1px sol #ddd;">
										<tr>
											<th colspan="2">General expenses &euro;</th>
										</tr>
										<tr>
												<td>Total expenses / day</td>
												<td>'.$row->total_daily_expenses.' €</td>
											  </tr>
											  <tr>
												<td>Total expenses / week</td>
												<td>'.$row->total_weekly_expenses.' €</td>
											  </tr>
											  <tr>
												<td>Total expenses / month</td>
												<td>'.$row->total_monthly_expenses.' €</td>
											  </tr>
											  <tr>
												<td>Total expenses / quarter</td>
												<td>'.$row->total_quaterly_expenses.' €</td>
											  </tr>
											  <tr>
												<td>Total expenses / year</td>
												<td>'.$row->total_annual_expenses.' €</td>
											  </tr>
											  <tr>
												<td>ROI (Return on investment)</td>
												<td>'.round($roi).'%</td>
											  </tr>
											  <tr>
												<td>ROI (Monetary value)</td>
												<td>'.round($roi_monetary).' €</td>
											  </tr>
									</table>
								</td>
							 </tr>
							 
							 <tr>
								<td>
									<table cellpadding="5" cellspacing="5" style="width: 100%; border: 1px sol #ddd;">
										<tr>
											<th colspan="2">Qualified web traffic needed</th>
										</tr>
										<tr>
												<td>Qualified daily traffic</td>
												<td>'.$row->daily_qualified_web_traffic_volume.'</td>
											  </tr>
											  <tr>
												<td>Qualified weekly traffic</td>
												<td>'.$row->weekly_qualified_web_traffic_volume.'</td>
											  </tr>
											  <tr>
												<td>Qualified monthly traffic</td>
												<td>'.$row->monthly_qualified_web_traffic_volume.'</td>
											  </tr>
											  <tr>
												<td>Qualified quarterly traffic</td>
												<td>'.$row->quarterly_qualified_web_traffic_volume.'</td>
											  </tr>
											  <tr>
												<td>Qualified annual traffic</td>
												<td>'.$row->annual_qualified_web_traffic_volume.'</td>
											  </tr>
									</table>
								</td>
							 </tr>
							 
							 <tr>
								<td>
									<table cellpadding="5" cellspacing="5" style="width: 100%; border: 1px sol #ddd;">
										<tr>
											<th colspan="2">Number Of paying customers needed</th>
										</tr>
										<tr>
												<td>Number of daily clients required</td>
												<td>'.$row->daily_potential_customer_buy_one_item.'</td>
											  </tr>
											  <tr>
												<td>Number of weekly clients required</td>
												<td>'.$row->weekly_potential_customer_buy_one_item.'</td>
											  </tr>
											  <tr>
												<td>Number of monthly clients required</td>
												<td>'.$row->monthly_potential_customer_buy_one_item.'</td>
											  </tr>
											  <tr>
												<td>Number of quarterly clients required</td>
												<td>'.$row->quarterly_potential_customer_buy_one_item.'</td>
											  </tr>
											  <tr>
												<td>Number of annual clients required</td>
												<td>'.$row->annual_potential_customer_buy_one_item.'</td>
											  </tr>
									</table>
								</td>
							 </tr>
							 
							 
  					</table>';
				$this->pdf->pdf->WriteHTML($html);
				$this->pdf->pdf->Output($pdf_file_path,'F');
				force_download($pdf_file_path, NULL);
			}
			else
			{
				$header_data = array('page_title' => '404 Page');
 				load_web_main_template('404_v', $header_data,'');
			}
		}
		else
		{
			$header_data = array('page_title' => '404 Page');
 			load_web_main_template('404_v', $header_data,'');
		}
	}
	
 	public function DownloadMainProjection()
	{
		$html = '';
		$this->load->model("ProjectionMain_m","projection");
		$this->load->helper('download');
		$this->load->helper('file');
 		if(!empty($_GET['key_id']))
		{
			$peojection_id = base64_decode($this->input->get('key_id', TRUE));
			$row = $this->projection->get_projection_details($peojection_id);
			if(!empty($row))
			{
				$this->load->library('pdf');
				$upload_file_name = $row->projection_id.".pdf";
				$pdf_file_path = FCPATH.'uploads/projections/'.$upload_file_name;
				//html first step start
				$html = '';
				$step  = '1';
				$type  = 'year';
				$annual_billing  = $row->annual_billing; 
				$achieve_goal_year = $row->achieve_goal_year; 
				$average_product_price  = $row->average_product_price; 
				$operating_expenses  = $row->operating_expenses; 
				$advertising_expenses  = $row->advertising_expenses; 
				$average_product_sold_cost = $row->average_product_sold_cost; 
				$conversion_rate  = $row->conversion_rate; 

				$advertising_expenses_percentage = $advertising_expenses/100;
				$advertising_expenses_percentage = number_format($advertising_expenses_percentage, 2, '.', '');

				$conversion_rate_percentage = $conversion_rate/100;
				$conversion_rate_percentage = number_format($conversion_rate_percentage, 2, '.', '');
				$crp = 1;
				if(!empty($conversion_rate_percentage) && $conversion_rate_percentage!==0)
				{
					$crp = $conversion_rate_percentage;
				}

				$operating_expenses_percentage = $operating_expenses/100;
				$operating_expenses_percentage = number_format($operating_expenses_percentage, 2, '.', '');

				$average_product_sold_cost_percentage = $average_product_sold_cost/100;
				$average_product_sold_cost_percentage = number_format($average_product_sold_cost_percentage, 2, '.', '');

				$main_days= 365;
				$main_weeks = 52;
				$main_monthly = 12;
				$main_quarterly = 4;

				$yearly_product_sold = 0;
				$semesterly_product_sold = 0;
				$quartley_product_sold	= 0;
				$monthly_product_sold = 0;	
				$weekly_product_sold = 0;	
				$daily_product_sold = 0;	

				$yearly_revenue = 0;
				$semesterly_revenue = 0;
				$quartley_revenue	= 0;
				$monthly_revenue = 0;	
				$weekly_revenue = 0;	
				$daily_revenue = 0;	

				$yearly_advertising_expenses = 0;
				$semesterly_advertising_expenses = 0;
				$quartley_advertising_expenses = 0;
				$monthly_advertising_expenses = 0;
				$weekly_advertising_expenses = 0;
				$daily_advertising_expenses = 0;

				$yearly_operating_expenses = 0;
				$semesterly_operating_expenses = 0;
				$quartley_operating_expenses = 0;
				$monthly_operating_expenses = 0;
				$weekly_operating_expenses = 0;
				$daily_operating_expenses = 0;

				$yearly_cost_of_products = 0;
				$semesterly_cost_of_products = 0;
				$quartley_cost_of_products = 0;
				$monthly_cost_of_products = 0;
				$weekly_cost_of_products = 0;
				$daily_cost_of_products = 0;

				$yearly_total_expenses = 0;
				$semesterly_total_expenses = 0;
				$quartley_total_expenses = 0;
				$monthly_total_expenses = 0;
				$weekly_total_expenses = 0;
				$daily_total_expenses = 0;

				$yearly_benefits = 0;
				$semesterly_benefits = 0;
				$quartley_benefits = 0;
				$monthly_benefits = 0;
				$weekly_benefits = 0;
				$daily_benefits = 0;

				$yearly_traffic_volume = 0;
				$semesterly_traffic_volume = 0;
				$quartley_traffic_volume = 0;
				$monthly_traffic_volume = 0;
				$weekly_traffic_volume = 0;
				$daily_traffic_volume = 0;

				$yearly_website_buyer_visitor = 0;
				$semesterly_website_buyer_visitor = 0;
				$quartley_website_buyer_visitor = 0;
				$monthly_website_buyer_visitor = 0;
				$weekly_website_buyer_visitor = 0;
				$daily_website_buyer_visitor = 0;
				$benefit_per_customer = 0;
				$roi = 0;
				$roi_percentage = 0;
				$roi_monetary = 0;
				if($annual_billing!=0 && $average_product_price!=0)
				{
					if($type=='3 months')
					{
						$main_days= 122;
						$main_weeks = 17.428;
						$main_monthly = 4;
						$main_quarterly = 1;
					}
					elseif($type=='6 months')
					{
						$main_days= 183;
						$main_weeks = 26;
						$main_monthly = 6;
						$main_quarterly = 2;
					}

					if($type=='year' && $achieve_goal_year>1)
					{
						$yearly_product_sold =  number_format(($annual_billing/$average_product_price/$achieve_goal_year), 4, '.', '');
						$quartley_product_sold = number_format(($annual_billing/$average_product_price/($main_quarterly*$achieve_goal_year)), 4, '.', '');
						$monthly_product_sold = number_format(($annual_billing/$average_product_price/($main_monthly*$achieve_goal_year)), 4, '.', '');
						$weekly_product_sold = number_format(($annual_billing/$average_product_price/($main_weeks*$achieve_goal_year)), 4, '.', '');
						$daily_product_sold = number_format(($annual_billing/$average_product_price/($main_days*$achieve_goal_year)), 4, '.', '');
					}
					else
					{
						$yearly_product_sold =  number_format($annual_billing/$average_product_price, 4, '.', '');
						$quartley_product_sold = number_format(($yearly_product_sold/$main_quarterly), 4, '.', '');
						$monthly_product_sold = number_format(($yearly_product_sold/$main_monthly), 4, '.', '');
						$weekly_product_sold = number_format(($yearly_product_sold/$main_weeks), 4, '.', '');
						$daily_product_sold = number_format(($yearly_product_sold/$main_days), 4, '.', '');
					}
					if(!empty($yearly_product_sold) && $yearly_product_sold!=0)
					{
						$semesterly_product_sold = number_format(($yearly_product_sold/2), 4, '.', '');
					}
					if($yearly_product_sold!=0  && $average_product_price!=0)
					{
						$yearly_revenue = number_format($yearly_product_sold*$average_product_price, 4, '.', '');
					}
					if($semesterly_product_sold!=0  && $average_product_price!=0)
					{
						$semesterly_revenue = number_format($semesterly_product_sold*$average_product_price, 4, '.', '');
					}
					if($quartley_product_sold!=0 && $average_product_price!=0)
					{
						$quartley_revenue	= number_format($quartley_product_sold*$average_product_price, 4, '.', '');
					}
					if($monthly_product_sold!=0 && $average_product_price!=0)
					{
						$monthly_revenue = number_format($monthly_product_sold*$average_product_price, 4, '.', '');
					}
					if($weekly_product_sold!=0 && $average_product_price!=0)
					{
						$weekly_revenue = number_format($weekly_product_sold*$average_product_price, 4, '.', '');
					}
					if($daily_product_sold!=0 && $average_product_price!=0)
					{
						$daily_revenue = number_format($daily_product_sold*$average_product_price, 4, '.', '');
					}



					if($type=='year' && $achieve_goal_year>1)
					{
						//Operating Expenses
						$yearly_operating_expenses =  number_format((($operating_expenses_percentage*$annual_billing)/$achieve_goal_year), 4, '.', '');
						$quartley_operating_expenses = number_format((($operating_expenses_percentage*$annual_billing)/ ($achieve_goal_year*$main_quarterly)), 4, '.', '');
						$monthly_operating_expenses = number_format((($operating_expenses_percentage*$annual_billing)/ ($achieve_goal_year*$main_monthly)), 4, '.', '');
						$weekly_operating_expenses = number_format((($operating_expenses_percentage*$annual_billing)/ ($achieve_goal_year*$main_weeks)), 4, '.', '');
						$daily_operating_expenses = number_format((($operating_expenses_percentage*$annual_billing)/ ($achieve_goal_year*$main_days)), 4, '.', '');

						//Advertising Expenses
						$yearly_advertising_expenses =  number_format((($advertising_expenses_percentage*$annual_billing)/ $achieve_goal_year), 4, '.', '');
						$quartley_advertising_expenses = number_format((($advertising_expenses_percentage*$annual_billing)/ ($achieve_goal_year*$main_quarterly)), 4, '.', '');
						$monthly_advertising_expenses = number_format((($advertising_expenses_percentage*$annual_billing)/ ($achieve_goal_year*$main_monthly)), 4, '.', '');
						$weekly_advertising_expenses = number_format((($advertising_expenses_percentage*$annual_billing)/ ($achieve_goal_year*$main_weeks)), 4, '.', '');
						$daily_advertising_expenses = number_format((($advertising_expenses_percentage*$annual_billing)/ ($achieve_goal_year*$main_days)), 4, '.', '');

						//cost of product sold
						$yearly_cost_of_products = number_format((($average_product_sold_cost_percentage*$annual_billing)/ $achieve_goal_year), 4, '.', '');
						$quartley_cost_of_products = number_format((($average_product_sold_cost_percentage*$annual_billing)/ ($achieve_goal_year*$main_quarterly)), 4, '.', '');
						$monthly_cost_of_products = number_format((($average_product_sold_cost_percentage*$annual_billing)/ ($achieve_goal_year*$main_monthly)), 4, '.', '');
						$weekly_cost_of_products = number_format((($average_product_sold_cost_percentage*$annual_billing)/ ($achieve_goal_year*$main_weeks)), 4, '.', '');
						$daily_cost_of_products = number_format((($average_product_sold_cost_percentage*$annual_billing)/ ($achieve_goal_year*$main_days)), 4, '.', '');
					}
					else
					{
						//Operating Expenses
						$yearly_operating_expenses =  number_format($operating_expenses_percentage*$yearly_revenue, 4, '.', '');
						$quartley_operating_expenses = number_format($operating_expenses_percentage*$quartley_revenue, 4, '.', '');
						$monthly_operating_expenses = number_format($operating_expenses_percentage*$monthly_revenue, 4, '.', '');
						$weekly_operating_expenses = number_format($operating_expenses_percentage*$weekly_revenue, 4, '.', '');
						$daily_operating_expenses = number_format($operating_expenses_percentage*$daily_revenue, 4, '.', '');

						//Advertising Expenses
						$yearly_advertising_expenses = number_format($advertising_expenses_percentage*$yearly_revenue, 4, '.', '');
						$quartley_advertising_expenses = number_format($advertising_expenses_percentage*$quartley_revenue, 4, '.', '');
						$monthly_advertising_expenses = number_format($advertising_expenses_percentage*$monthly_revenue, 4, '.', '');
						$weekly_advertising_expenses = number_format($advertising_expenses_percentage*$weekly_revenue, 4, '.', '');
						$daily_advertising_expenses = number_format($advertising_expenses_percentage*$daily_revenue, 4, '.', '');

						//cost of product sold
						$yearly_cost_of_products = number_format($average_product_sold_cost_percentage*$yearly_revenue, 4, '.', '');
						$quartley_cost_of_products = number_format($average_product_sold_cost_percentage*$quartley_revenue, 4, '.', '');
						$monthly_cost_of_products = number_format($average_product_sold_cost_percentage*$monthly_revenue, 4, '.', '');
						$weekly_cost_of_products = number_format($average_product_sold_cost_percentage*$weekly_revenue, 4, '.', '');
						$daily_cost_of_products = number_format($average_product_sold_cost_percentage*$daily_revenue, 4, '.', '');
					}
					if(!empty($yearly_operating_expenses) && $yearly_operating_expenses!=0)
					{
						$semesterly_operating_expenses = number_format(($yearly_operating_expenses/2), 4, '.', '');
					}
					if(!empty($yearly_cost_of_products) && $yearly_cost_of_products!=0)
					{
						$semesterly_cost_of_products = number_format(($yearly_cost_of_products/2), 4, '.', '');
					}
					if(!empty($yearly_advertising_expenses) && $yearly_advertising_expenses!=0)
					{
						$semesterly_advertising_expenses = number_format(($yearly_advertising_expenses/2), 4, '.', '');
					}
					$yearly_total_expenses = $yearly_advertising_expenses+$yearly_operating_expenses+$yearly_cost_of_products;
					$semesterly_total_expenses = $semesterly_advertising_expenses+ $semesterly_operating_expenses+ $semesterly_cost_of_products;
					$quartley_total_expenses = $quartley_advertising_expenses+$quartley_operating_expenses+$quartley_cost_of_products;
					$monthly_total_expenses = $monthly_advertising_expenses+$monthly_operating_expenses+$monthly_cost_of_products;
					$weekly_total_expenses = $weekly_advertising_expenses+$weekly_operating_expenses+$weekly_cost_of_products;
					$daily_total_expenses = $daily_advertising_expenses+$daily_operating_expenses+$daily_cost_of_products;

					if($yearly_revenue>$yearly_total_expenses)
					{
						$yearly_benefits = number_format($yearly_revenue-$yearly_total_expenses, 4, '.', '');
					}
					if(!empty($yearly_benefits) && $yearly_benefits!=0)
					{
						$semesterly_benefits = number_format(($yearly_benefits/2), 4, '.', '');
					}
					if($quartley_revenue>$quartley_total_expenses)
					{
						$quartley_benefits = number_format($quartley_revenue-$quartley_total_expenses, 4, '.', '');
					}
					if($monthly_revenue>$monthly_total_expenses)
					{
						$monthly_benefits = number_format($monthly_revenue-$monthly_total_expenses, 4, '.', '');
					}
					if($weekly_revenue>$weekly_total_expenses)
					{
						$weekly_benefits = number_format($weekly_revenue-$weekly_total_expenses, 4, '.', '');
					}
					if($daily_revenue>$daily_total_expenses)
					{
						$daily_benefits = number_format($daily_revenue-$daily_total_expenses, 4, '.', '');
					}


					if($type=='year' && $achieve_goal_year>1)
					{
						$first_traffic_value = number_format($annual_billing/$average_product_price, 4, '.', '');	
						$yearly_traffic_volume = number_format((($first_traffic_value/($achieve_goal_year))/$crp), 4, '.', '');
						if(!empty($yearly_traffic_volume) && $yearly_traffic_volume!=0)
						{
							$semesterly_traffic_volume = number_format(($yearly_traffic_volume/2), 4, '.', '');
						}
						$quartley_traffic_volume = number_format((($first_traffic_value/($main_quarterly*$achieve_goal_year))/$crp), 4, '.', '');
						$monthly_traffic_volume = number_format((($first_traffic_value/($main_monthly*$achieve_goal_year))/$crp), 4, '.', '');
						$weekly_traffic_volume = number_format((($first_traffic_value/($main_weeks*$achieve_goal_year))/$crp), 4, '.', '');
						$daily_traffic_volume = number_format((($first_traffic_value/($main_days*$achieve_goal_year))/$crp), 4, '.', '');
					}
					else
					{
						$first_traffic_value = number_format($annual_billing/$average_product_price, 4, '.', '');	

						$yearly_traffic_volume = number_format((($first_traffic_value)/$crp), 4, '.', '');
						if(!empty($yearly_traffic_volume) && $yearly_traffic_volume!=0)
						{
							$semesterly_traffic_volume = number_format(($yearly_traffic_volume/2), 4, '.', '');
						}
						$quartley_traffic_volume = number_format((($first_traffic_value/$main_quarterly)/$crp), 4, '.', '');
						$monthly_traffic_volume = number_format((($first_traffic_value/$main_monthly)/$crp), 4, '.', '');
						$weekly_traffic_volume = number_format((($first_traffic_value/$main_weeks)/$crp), 4, '.', '');
						$daily_traffic_volume = number_format((($first_traffic_value/($main_days))/$crp), 4, '.', '');
					}


					$yearly_website_buyer_visitor = number_format($yearly_traffic_volume*$crp, 4, '.', '');
					if(!empty($yearly_website_buyer_visitor) && $yearly_website_buyer_visitor!=0)
					{
						$semesterly_website_buyer_visitor = number_format(($yearly_website_buyer_visitor/2), 4, '.', '');
					}
					$quartley_website_buyer_visitor = number_format($quartley_traffic_volume*$crp, 4, '.', '');
					$monthly_website_buyer_visitor = number_format($monthly_traffic_volume*$crp, 4, '.', '');
					$weekly_website_buyer_visitor = number_format($weekly_traffic_volume*$crp, 4, '.', '');
					$daily_website_buyer_visitor = number_format($daily_traffic_volume*$crp, 4, '.', '');

					if($yearly_benefits>$yearly_website_buyer_visitor)
					{
						$benefit_per_customer = number_format($yearly_benefits/$yearly_website_buyer_visitor, 4, '.', '');
					}
					if($yearly_benefits>$yearly_total_expenses)
					{
						$roi = ($yearly_benefits/$yearly_total_expenses)*100;
						$roi_percentage = number_format($roi/100, 2, '.', '');

						$roi_monetary = number_format((((($yearly_benefits/$yearly_total_expenses)*100)/100)*$yearly_total_expenses), 4, '.', '');
					}


				}
			$html .= '<style>table,tr,th,td{ border:1px solid #ddd;border-collapse: collapse !important;} </style>';	
			$html .= '<p>Year Wise Plan</p><br><table id="goals" style="border:1px solid #ddd;">
						  <tr style="background-color:#4CAF50;">
							  <th></th>
							  <th>Day</th>
							  <th>Week</th>
							  <th>Monthly</th>
							  <th>Quarterly</th>';
							  $html .= '<th>Semester</th>';	
							  if($type=='year')
							  {
 								  $html .= '<th>Yearly</th>';
							  }

						  $html .= '</tr>';
						  $html .= '<tr>
							<td>Total number of products to be sold</td>
							<td>'.round($daily_product_sold).'</td>
							<td>'.round($weekly_product_sold).'</td>
							<td>'.round($monthly_product_sold).'</td>
							<td>'.round($quartley_product_sold).'</td>';
							$html .= "<td>".round($semesterly_product_sold)."</td>";
							if($type=='year')
							{
 								$html .= "<td>".round($yearly_product_sold)."</td>";
							}
						   $html .= '</tr>';
						   $html .= '<tr>
							<td>Total revenue</td>
							<td>'.round($daily_revenue).' €</td>
							<td>'.round($weekly_revenue).' €</td>
							<td>'.round($monthly_revenue).' €</td>
							<td>'.round($quartley_revenue).' €</td>';
							$html .= "<td>".round($semesterly_revenue)." €</td>";
							if($type=='year')
							{
								$html .= "<td>".round($yearly_revenue)." €</td>";
							}

						   $html .= '</tr>';
						   $html .= '<tr>
							<td>Advertising expenses</td>
							<td>'.round($daily_advertising_expenses).' €</td>
							<td>'.round($weekly_advertising_expenses).' €</td>
							<td>'.round($monthly_advertising_expenses).' €</td>
							<td>'.round($quartley_advertising_expenses).' €</td>';
							if($type=='year')
							{
 								$html .= "<td>".round($yearly_advertising_expenses)." €</td>";
							}

						 $html .= '</tr>';
						 $html .= '<tr>
							<td>Operating Expenses</td>
							<td>'.round($daily_operating_expenses).' €</td>
							<td>'.round($weekly_operating_expenses).' €</td>
							<td>'.round($monthly_operating_expenses).' €</td>
							<td>'.round($quartley_operating_expenses).' €</td>';
							$html .= "<td>".round($semesterly_operating_expenses)." €</td>";
							if($type=='year')
							{
 								$html .= "<td>".round($yearly_operating_expenses)." €</td>";
							}

						  $html .= '</tr>';
						  $html .= '<tr>
							<td>Cost of products / services</td>
							<td>'.round($daily_cost_of_products).' €</td>
							<td>'.round($weekly_cost_of_products).' €</td>
							<td>'.round($monthly_cost_of_products).' €</td>
							<td>'.round($quartley_cost_of_products).' €</td>';
							$html .= "<td>".round($semesterly_cost_of_products)." €</td>";
							if($type=='year')
							{
 								$html .= "<td>".round($yearly_cost_of_products)." €</td>";
							}

						  $html .= '</tr>';
						  $html .= '<tr>
							<td>Total expenses</td>
							<td>'.round($daily_total_expenses).' €</td>
							<td>'.round($weekly_total_expenses).' €</td>
							<td>'.round($monthly_total_expenses).' €</td>
							<td>'.round($quartley_total_expenses).' €</td>';
							$html .= "<td>".round($semesterly_total_expenses)." €</td>";
							if($type=='year')
							{
 								$html .= "<td>".round($yearly_total_expenses)." €</td>";
							}

						  $html .= '</tr>';
						  $html .= '<tr>
							<td>Benefits</td>
							<td>'.round($daily_benefits).' €</td>
							<td>'.round($weekly_benefits).' €</td>
							<td>'.round($monthly_benefits).' €</td>
							<td>'.round($quartley_benefits).' €</td>';
							$html .= "<td>".round($semesterly_benefits)." €</td>";
							if($type=='year')
							{
 								$html .= "<td>".round($yearly_benefits)." €</td>";
							}

						  $html .= '</tr>';
						  $html .= '<tr>
							<td>Qualified traffic volume to the website</td>
							<td>'.round($daily_traffic_volume).' €</td>
							<td>'.round($weekly_traffic_volume).' €</td>
							<td>'.round($monthly_traffic_volume).' €</td>
							<td>'.round($quartley_traffic_volume).' €</td>';
							$html .= "<td>".round($semesterly_traffic_volume)." €</td>";	
							if($type=='year')
							{
 								$html .= "<td>".round($yearly_traffic_volume)." €</td>";
							}

						  $html .= '</tr>';
						  $html .= '<tr>
							<td>Volume of web visitors that you should buy at least one product</td>
							<td>'.round($daily_website_buyer_visitor).' €</td>
							<td>'.round($weekly_website_buyer_visitor).' €</td>
							<td>'.round($monthly_website_buyer_visitor).' €</td>
							<td>'.round($quartley_website_buyer_visitor).' €</td>';
							$html .= "<td>".round($semesterly_website_buyer_visitor)." €</td>";
							if($type=='year')
							{
 								$html .= "<td>".round($yearly_website_buyer_visitor)." €</td>";
							}

						  $html .= '</tr>';
						  $html .= '<tr>
							<td>Benefits for customers</td>
							<td>'.round($benefit_per_customer).' €</td>
						  </tr>
						  <tr>
							<td>ROI (Return on investment)</td>
							<td>'.round($roi).'%</td>
						  </tr>
						  <tr>
							<td>ROI (Monetary value)</td>
							<td>'.round($roi_monetary).' €</td>
						  </tr>
						</table>';
 				
				
				$html .= $this->main_projection_step_two_html($row);
				$html .= $this->main_projection_step_three_html($row);
 				$this->pdf->pdf->WriteHTML($html);
				$this->pdf->pdf->Output($pdf_file_path,'F');
				force_download($pdf_file_path, NULL);
			}
			else
			{
				$header_data = array('page_title' => '404 Page');
 				load_web_main_template('404_v', $header_data,'');
			}
		}
		else
		{
			$header_data = array('page_title' => '404 Page');
 			load_web_main_template('404_v', $header_data,'');
		}
	}
	private function main_projection_step_two_html($row)
	{
		$html = '';
 		if(!empty($row))
		{
			$step  = '2';
			$type  = '3 months';
			$annual_billing  = $row->second_annual_billing; 
			$achieve_goal_year = 1; 
			$average_product_price  = $row->second_average_product_price; 
			$operating_expenses  = $row->second_operating_expenses; 
			$advertising_expenses  = $row->second_advertising_expenses; 
			$average_product_sold_cost = $row->second_average_product_sold_cost; 
			$conversion_rate  = $row->second_conversion_rate; 

			$advertising_expenses_percentage = $advertising_expenses/100;
			$advertising_expenses_percentage = number_format($advertising_expenses_percentage, 2, '.', '');

			$conversion_rate_percentage = $conversion_rate/100;
			$conversion_rate_percentage = number_format($conversion_rate_percentage, 2, '.', '');
			$crp = 1;
			if(!empty($conversion_rate_percentage) && $conversion_rate_percentage!==0)
			{
				$crp = $conversion_rate_percentage;
			}

			$operating_expenses_percentage = $operating_expenses/100;
			$operating_expenses_percentage = number_format($operating_expenses_percentage, 2, '.', '');

			$average_product_sold_cost_percentage = $average_product_sold_cost/100;
			$average_product_sold_cost_percentage = number_format($average_product_sold_cost_percentage, 2, '.', '');

			$main_days= 365;
			$main_weeks = 52;
			$main_monthly = 12;
			$main_quarterly = 4;

			$yearly_product_sold = 0;
			$semesterly_product_sold = 0;
			$quartley_product_sold	= 0;
			$monthly_product_sold = 0;	
			$weekly_product_sold = 0;	
			$daily_product_sold = 0;	

			$yearly_revenue = 0;
			$semesterly_revenue = 0;
			$quartley_revenue	= 0;
			$monthly_revenue = 0;	
			$weekly_revenue = 0;	
			$daily_revenue = 0;	

			$yearly_advertising_expenses = 0;
			$semesterly_advertising_expenses = 0;
			$quartley_advertising_expenses = 0;
			$monthly_advertising_expenses = 0;
			$weekly_advertising_expenses = 0;
			$daily_advertising_expenses = 0;

			$yearly_operating_expenses = 0;
			$semesterly_operating_expenses = 0;
			$quartley_operating_expenses = 0;
			$monthly_operating_expenses = 0;
			$weekly_operating_expenses = 0;
			$daily_operating_expenses = 0;

			$yearly_cost_of_products = 0;
			$semesterly_cost_of_products = 0;
			$quartley_cost_of_products = 0;
			$monthly_cost_of_products = 0;
			$weekly_cost_of_products = 0;
			$daily_cost_of_products = 0;

			$yearly_total_expenses = 0;
			$semesterly_total_expenses = 0;
			$quartley_total_expenses = 0;
			$monthly_total_expenses = 0;
			$weekly_total_expenses = 0;
			$daily_total_expenses = 0;

			$yearly_benefits = 0;
			$semesterly_benefits = 0;
			$quartley_benefits = 0;
			$monthly_benefits = 0;
			$weekly_benefits = 0;
			$daily_benefits = 0;

			$yearly_traffic_volume = 0;
			$semesterly_traffic_volume = 0;
			$quartley_traffic_volume = 0;
			$monthly_traffic_volume = 0;
			$weekly_traffic_volume = 0;
			$daily_traffic_volume = 0;

			$yearly_website_buyer_visitor = 0;
			$semesterly_website_buyer_visitor = 0;
			$quartley_website_buyer_visitor = 0;
			$monthly_website_buyer_visitor = 0;
			$weekly_website_buyer_visitor = 0;
			$daily_website_buyer_visitor = 0;
			$benefit_per_customer = 0;
			$roi = 0;
			$roi_percentage = 0;
			$roi_monetary = 0;
			if($annual_billing!=0 && $average_product_price!=0)
			{
				if($type=='3 months')
				{
					$main_days= 122;
					$main_weeks = 17.428;
					$main_monthly = 4;
					$main_quarterly = 1;
				}
				elseif($type=='6 months')
				{
					$main_days= 183;
					$main_weeks = 26;
					$main_monthly = 6;
					$main_quarterly = 2;
				}

				if($type=='year' && $achieve_goal_year>1)
				{
					$yearly_product_sold =  number_format(($annual_billing/$average_product_price/$achieve_goal_year), 4, '.', '');
					$quartley_product_sold = number_format(($annual_billing/$average_product_price/($main_quarterly*$achieve_goal_year)), 4, '.', '');
					$monthly_product_sold = number_format(($annual_billing/$average_product_price/($main_monthly*$achieve_goal_year)), 4, '.', '');
					$weekly_product_sold = number_format(($annual_billing/$average_product_price/($main_weeks*$achieve_goal_year)), 4, '.', '');
					$daily_product_sold = number_format(($annual_billing/$average_product_price/($main_days*$achieve_goal_year)), 4, '.', '');
				}
				else
				{
					$yearly_product_sold =  number_format($annual_billing/$average_product_price, 4, '.', '');
					$quartley_product_sold = number_format(($yearly_product_sold/$main_quarterly), 4, '.', '');
					$monthly_product_sold = number_format(($yearly_product_sold/$main_monthly), 4, '.', '');
					$weekly_product_sold = number_format(($yearly_product_sold/$main_weeks), 4, '.', '');
					$daily_product_sold = number_format(($yearly_product_sold/$main_days), 4, '.', '');
				}
				if(!empty($yearly_product_sold) && $yearly_product_sold!=0)
				{
					$semesterly_product_sold = number_format(($yearly_product_sold/2), 4, '.', '');
				}
				if($yearly_product_sold!=0  && $average_product_price!=0)
				{
					$yearly_revenue = number_format($yearly_product_sold*$average_product_price, 4, '.', '');
				}
				if($semesterly_product_sold!=0  && $average_product_price!=0)
				{
					$semesterly_revenue = number_format($semesterly_product_sold*$average_product_price, 4, '.', '');
				}
				if($quartley_product_sold!=0 && $average_product_price!=0)
				{
					$quartley_revenue	= number_format($quartley_product_sold*$average_product_price, 4, '.', '');
				}
				if($monthly_product_sold!=0 && $average_product_price!=0)
				{
					$monthly_revenue = number_format($monthly_product_sold*$average_product_price, 4, '.', '');
				}
				if($weekly_product_sold!=0 && $average_product_price!=0)
				{
					$weekly_revenue = number_format($weekly_product_sold*$average_product_price, 4, '.', '');
				}
				if($daily_product_sold!=0 && $average_product_price!=0)
				{
					$daily_revenue = number_format($daily_product_sold*$average_product_price, 4, '.', '');
				}



				if($type=='year' && $achieve_goal_year>1)
				{
					//Operating Expenses
					$yearly_operating_expenses =  number_format((($operating_expenses_percentage*$annual_billing)/$achieve_goal_year), 4, '.', '');
					$quartley_operating_expenses = number_format((($operating_expenses_percentage*$annual_billing)/ ($achieve_goal_year*$main_quarterly)), 4, '.', '');
					$monthly_operating_expenses = number_format((($operating_expenses_percentage*$annual_billing)/ ($achieve_goal_year*$main_monthly)), 4, '.', '');
					$weekly_operating_expenses = number_format((($operating_expenses_percentage*$annual_billing)/ ($achieve_goal_year*$main_weeks)), 4, '.', '');
					$daily_operating_expenses = number_format((($operating_expenses_percentage*$annual_billing)/ ($achieve_goal_year*$main_days)), 4, '.', '');

					//Advertising Expenses
					$yearly_advertising_expenses =  number_format((($advertising_expenses_percentage*$annual_billing)/ $achieve_goal_year), 4, '.', '');
					$quartley_advertising_expenses = number_format((($advertising_expenses_percentage*$annual_billing)/ ($achieve_goal_year*$main_quarterly)), 4, '.', '');
					$monthly_advertising_expenses = number_format((($advertising_expenses_percentage*$annual_billing)/ ($achieve_goal_year*$main_monthly)), 4, '.', '');
					$weekly_advertising_expenses = number_format((($advertising_expenses_percentage*$annual_billing)/ ($achieve_goal_year*$main_weeks)), 4, '.', '');
					$daily_advertising_expenses = number_format((($advertising_expenses_percentage*$annual_billing)/ ($achieve_goal_year*$main_days)), 4, '.', '');

					//cost of product sold
					$yearly_cost_of_products = number_format((($average_product_sold_cost_percentage*$annual_billing)/ $achieve_goal_year), 4, '.', '');
					$quartley_cost_of_products = number_format((($average_product_sold_cost_percentage*$annual_billing)/ ($achieve_goal_year*$main_quarterly)), 4, '.', '');
					$monthly_cost_of_products = number_format((($average_product_sold_cost_percentage*$annual_billing)/ ($achieve_goal_year*$main_monthly)), 4, '.', '');
					$weekly_cost_of_products = number_format((($average_product_sold_cost_percentage*$annual_billing)/ ($achieve_goal_year*$main_weeks)), 4, '.', '');
					$daily_cost_of_products = number_format((($average_product_sold_cost_percentage*$annual_billing)/ ($achieve_goal_year*$main_days)), 4, '.', '');
				}
				else
				{
					//Operating Expenses
					$yearly_operating_expenses =  number_format($operating_expenses_percentage*$yearly_revenue, 4, '.', '');
					$quartley_operating_expenses = number_format($operating_expenses_percentage*$quartley_revenue, 4, '.', '');
					$monthly_operating_expenses = number_format($operating_expenses_percentage*$monthly_revenue, 4, '.', '');
					$weekly_operating_expenses = number_format($operating_expenses_percentage*$weekly_revenue, 4, '.', '');
					$daily_operating_expenses = number_format($operating_expenses_percentage*$daily_revenue, 4, '.', '');

					//Advertising Expenses
					$yearly_advertising_expenses = number_format($advertising_expenses_percentage*$yearly_revenue, 4, '.', '');
					$quartley_advertising_expenses = number_format($advertising_expenses_percentage*$quartley_revenue, 4, '.', '');
					$monthly_advertising_expenses = number_format($advertising_expenses_percentage*$monthly_revenue, 4, '.', '');
					$weekly_advertising_expenses = number_format($advertising_expenses_percentage*$weekly_revenue, 4, '.', '');
					$daily_advertising_expenses = number_format($advertising_expenses_percentage*$daily_revenue, 4, '.', '');

					//cost of product sold
					$yearly_cost_of_products = number_format($average_product_sold_cost_percentage*$yearly_revenue, 4, '.', '');
					$quartley_cost_of_products = number_format($average_product_sold_cost_percentage*$quartley_revenue, 4, '.', '');
					$monthly_cost_of_products = number_format($average_product_sold_cost_percentage*$monthly_revenue, 4, '.', '');
					$weekly_cost_of_products = number_format($average_product_sold_cost_percentage*$weekly_revenue, 4, '.', '');
					$daily_cost_of_products = number_format($average_product_sold_cost_percentage*$daily_revenue, 4, '.', '');
				}
				if(!empty($yearly_operating_expenses) && $yearly_operating_expenses!=0)
				{
					$semesterly_operating_expenses = number_format(($yearly_operating_expenses/2), 4, '.', '');
				}
				if(!empty($yearly_cost_of_products) && $yearly_cost_of_products!=0)
				{
					$semesterly_cost_of_products = number_format(($yearly_cost_of_products/2), 4, '.', '');
				}
				if(!empty($yearly_advertising_expenses) && $yearly_advertising_expenses!=0)
				{
					$semesterly_advertising_expenses = number_format(($yearly_advertising_expenses/2), 4, '.', '');
				}
				$yearly_total_expenses = $yearly_advertising_expenses+$yearly_operating_expenses+$yearly_cost_of_products;
				$semesterly_total_expenses = $semesterly_advertising_expenses+ $semesterly_operating_expenses+ $semesterly_cost_of_products;
				$quartley_total_expenses = $quartley_advertising_expenses+$quartley_operating_expenses+$quartley_cost_of_products;
				$monthly_total_expenses = $monthly_advertising_expenses+$monthly_operating_expenses+$monthly_cost_of_products;
				$weekly_total_expenses = $weekly_advertising_expenses+$weekly_operating_expenses+$weekly_cost_of_products;
				$daily_total_expenses = $daily_advertising_expenses+$daily_operating_expenses+$daily_cost_of_products;

				if($yearly_revenue>$yearly_total_expenses)
				{
					$yearly_benefits = number_format($yearly_revenue-$yearly_total_expenses, 4, '.', '');
				}
				if(!empty($yearly_benefits) && $yearly_benefits!=0)
				{
					$semesterly_benefits = number_format(($yearly_benefits/2), 4, '.', '');
				}
				if($quartley_revenue>$quartley_total_expenses)
				{
					$quartley_benefits = number_format($quartley_revenue-$quartley_total_expenses, 4, '.', '');
				}
				if($monthly_revenue>$monthly_total_expenses)
				{
					$monthly_benefits = number_format($monthly_revenue-$monthly_total_expenses, 4, '.', '');
				}
				if($weekly_revenue>$weekly_total_expenses)
				{
					$weekly_benefits = number_format($weekly_revenue-$weekly_total_expenses, 4, '.', '');
				}
				if($daily_revenue>$daily_total_expenses)
				{
					$daily_benefits = number_format($daily_revenue-$daily_total_expenses, 4, '.', '');
				}


				if($type=='year' && $achieve_goal_year>1)
				{
					$first_traffic_value = number_format($annual_billing/$average_product_price, 4, '.', '');	
					$yearly_traffic_volume = number_format((($first_traffic_value/($achieve_goal_year))/$crp), 4, '.', '');
					if(!empty($yearly_traffic_volume) && $yearly_traffic_volume!=0)
					{
						$semesterly_traffic_volume = number_format(($yearly_traffic_volume/2), 4, '.', '');
					}
					$quartley_traffic_volume = number_format((($first_traffic_value/($main_quarterly*$achieve_goal_year))/$crp), 4, '.', '');
					$monthly_traffic_volume = number_format((($first_traffic_value/($main_monthly*$achieve_goal_year))/$crp), 4, '.', '');
					$weekly_traffic_volume = number_format((($first_traffic_value/($main_weeks*$achieve_goal_year))/$crp), 4, '.', '');
					$daily_traffic_volume = number_format((($first_traffic_value/($main_days*$achieve_goal_year))/$crp), 4, '.', '');
				}
				else
				{
					$first_traffic_value = number_format($annual_billing/$average_product_price, 4, '.', '');	

					$yearly_traffic_volume = number_format((($first_traffic_value)/$crp), 4, '.', '');
					if(!empty($yearly_traffic_volume) && $yearly_traffic_volume!=0)
					{
						$semesterly_traffic_volume = number_format(($yearly_traffic_volume/2), 4, '.', '');
					}
					$quartley_traffic_volume = number_format((($first_traffic_value/$main_quarterly)/$crp), 4, '.', '');
					$monthly_traffic_volume = number_format((($first_traffic_value/$main_monthly)/$crp), 4, '.', '');
					$weekly_traffic_volume = number_format((($first_traffic_value/$main_weeks)/$crp), 4, '.', '');
					$daily_traffic_volume = number_format((($first_traffic_value/($main_days))/$crp), 4, '.', '');
				}


				$yearly_website_buyer_visitor = number_format($yearly_traffic_volume*$crp, 4, '.', '');
				if(!empty($yearly_website_buyer_visitor) && $yearly_website_buyer_visitor!=0)
				{
					$semesterly_website_buyer_visitor = number_format(($yearly_website_buyer_visitor/2), 4, '.', '');
				}
				$quartley_website_buyer_visitor = number_format($quartley_traffic_volume*$crp, 4, '.', '');
				$monthly_website_buyer_visitor = number_format($monthly_traffic_volume*$crp, 4, '.', '');
				$weekly_website_buyer_visitor = number_format($weekly_traffic_volume*$crp, 4, '.', '');
				$daily_website_buyer_visitor = number_format($daily_traffic_volume*$crp, 4, '.', '');

				if($yearly_benefits>$yearly_website_buyer_visitor)
				{
					$benefit_per_customer = number_format($yearly_benefits/$yearly_website_buyer_visitor, 4, '.', '');
				}
				if($yearly_benefits>$yearly_total_expenses)
				{
					$roi = ($yearly_benefits/$yearly_total_expenses)*100;
					$roi_percentage = number_format($roi/100, 2, '.', '');

					$roi_monetary = number_format((((($yearly_benefits/$yearly_total_expenses)*100)/100)*$yearly_total_expenses), 4, '.', '');
				}
				$html .= '<br><br><p>3 Months Plan</p><br>
							<table id="goals" style="border:1px solid #ddd;">
							  <tr style="background-color:#4CAF50;">
								  <th></th>
								  <th>Day</th>
								  <th>Week</th>
								  <th>Monthly</th>
								  <th>Quarterly</th>';
								  if($type=='year')
								  {
									  $html .= '<th>Semester</th>';
									  $html .= '<th>Yearly</th>';
								  }

							  $html .= '</tr>';
							  $html .= '<tr>
								<td>Total number of products to be sold</td>
								<td>'.round($daily_product_sold).'</td>
								<td>'.round($weekly_product_sold).'</td>
								<td>'.round($monthly_product_sold).'</td>
								<td>'.round($quartley_product_sold).'</td>';
								$html .= "<td>".round($semesterly_product_sold)."</td>";
								if($type=='year')
								{
									$html .= "<td>".round($yearly_product_sold)."</td>";
								}
							   $html .= '</tr>';
							   $html .= '<tr>
								<td>Total revenue</td>
								<td>'.round($daily_revenue).' €</td>
								<td>'.round($weekly_revenue).' €</td>
								<td>'.round($monthly_revenue).' €</td>
								<td>'.round($quartley_revenue).' €</td>';
				                $html .= "<td>".round($semesterly_revenue)." €</td>";
								if($type=='year')
								{
 									$html .= "<td>".round($yearly_revenue)." €</td>";
								}

							   $html .= '</tr>';
							   $html .= '<tr>
								<td>Advertising expenses</td>
								<td>'.round($daily_advertising_expenses).' €</td>
								<td>'.round($weekly_advertising_expenses).' €</td>
								<td>'.round($monthly_advertising_expenses).' €</td>
								<td>'.round($quartley_advertising_expenses).' €</td>';
								$html .= "<td>".round($semesterly_advertising_expenses)." €</td>";
								if($type=='year')
								{
 									$html .= "<td>".round($yearly_advertising_expenses)." €</td>";
								}

							 $html .= '</tr>';
							 $html .= '<tr>
								<td>Operating Expenses</td>
								<td>'.round($daily_operating_expenses).' €</td>
								<td>'.round($weekly_operating_expenses).' €</td>
								<td>'.round($monthly_operating_expenses).' €</td>
								<td>'.round($quartley_operating_expenses).' €</td>';
								if($type=='year')
								{
									$html .= "<td>".round($semesterly_operating_expenses)." €</td>";
									$html .= "<td>".round($yearly_operating_expenses)." €</td>";
								}

							  $html .= '</tr>';
							  $html .= '<tr>
								<td>Cost of products / services</td>
								<td>'.round($daily_cost_of_products).' €</td>
								<td>'.round($weekly_cost_of_products).' €</td>
								<td>'.round($monthly_cost_of_products).' €</td>
								<td>'.round($quartley_cost_of_products).' €</td>';
								if($type=='year')
								{
									$html .= "<td>".round($semesterly_cost_of_products)." €</td>";
									$html .= "<td>".round($yearly_cost_of_products)." €</td>";
								}

							  $html .= '</tr>';
							  $html .= '<tr>
								<td>Total expenses</td>
								<td>'.round($daily_total_expenses).' €</td>
								<td>'.round($weekly_total_expenses).' €</td>
								<td>'.round($monthly_total_expenses).' €</td>
								<td>'.round($quartley_total_expenses).' €</td>';
								if($type=='year')
								{
									$html .= "<td>".round($semesterly_total_expenses)." €</td>";
									$html .= "<td>".round($yearly_total_expenses)." €</td>";
								}

							  $html .= '</tr>';
							  $html .= '<tr>
								<td>Benefits</td>
								<td>'.round($daily_benefits).' €</td>
								<td>'.round($weekly_benefits).' €</td>
								<td>'.round($monthly_benefits).' €</td>
								<td>'.round($quartley_benefits).' €</td>';
								if($type=='year')
								{
									$html .= "<td>".round($semesterly_benefits)." €</td>";
									$html .= "<td>".round($yearly_benefits)." €</td>";
								}

							  $html .= '</tr>';
							  $html .= '<tr>
								<td>Qualified traffic volume to the website</td>
								<td>'.round($daily_traffic_volume).' €</td>
								<td>'.round($weekly_traffic_volume).' €</td>
								<td>'.round($monthly_traffic_volume).' €</td>
								<td>'.round($quartley_traffic_volume).' €</td>';
								if($type=='year')
								{
									$html .= "<td>".round($semesterly_traffic_volume)." €</td>";
									$html .= "<td>".round($yearly_traffic_volume)." €</td>";
								}

							  $html .= '</tr>';
							  $html .= '<tr>
								<td>Volume of web visitors that you should buy at least one product</td>
								<td>'.round($daily_website_buyer_visitor).' €</td>
								<td>'.round($weekly_website_buyer_visitor).' €</td>
								<td>'.round($monthly_website_buyer_visitor).' €</td>
								<td>'.round($quartley_website_buyer_visitor).' €</td>';
								if($type=='year')
								{
									$html .= "<td>".round($semesterly_website_buyer_visitor)." €</td>";
									$html .= "<td>".round($yearly_website_buyer_visitor)." €</td>";
								}

							  $html .= '</tr>';
							  $html .= '<tr>
								<td>Benefits for customers</td>
								<td>'.round($benefit_per_customer).' €</td>
							  </tr>
							  <tr>
								<td>ROI (Return on investment)</td>
								<td>'.round($roi).'%</td>
							  </tr>
							  <tr>
								<td>ROI (Monetary value)</td>
								<td>'.round($roi_monetary).' €</td>
							  </tr>
							</table>
						';
			 }
		}
		return $html;
	}
	private function main_projection_step_three_html($row)
	{
		$html = '';
		if(!empty($row))
		{
			$step  = '3';
			$type  = '6 months';
			$annual_billing  = $row->third_annual_billing; 
			$achieve_goal_year = 1; 
			$average_product_price  = $row->third_average_product_price; 
			$operating_expenses  = $row->third_operating_expenses; 
			$advertising_expenses  = $row->third_advertising_expenses; 
			$average_product_sold_cost = $row->third_average_product_sold_cost; 
			$conversion_rate  = $row->third_conversion_rate; 

			$advertising_expenses_percentage = $advertising_expenses/100;
			$advertising_expenses_percentage = number_format($advertising_expenses_percentage, 2, '.', '');

			$conversion_rate_percentage = $conversion_rate/100;
			$conversion_rate_percentage = number_format($conversion_rate_percentage, 2, '.', '');
			$crp = 1;
			if(!empty($conversion_rate_percentage) && $conversion_rate_percentage!==0)
			{
				$crp = $conversion_rate_percentage;
			}

			$operating_expenses_percentage = $operating_expenses/100;
			$operating_expenses_percentage = number_format($operating_expenses_percentage, 2, '.', '');

			$average_product_sold_cost_percentage = $average_product_sold_cost/100;
			$average_product_sold_cost_percentage = number_format($average_product_sold_cost_percentage, 2, '.', '');

			$main_days= 365;
			$main_weeks = 52;
			$main_monthly = 12;
			$main_quarterly = 4;

			$yearly_product_sold = 0;
			$semesterly_product_sold = 0;
			$quartley_product_sold	= 0;
			$monthly_product_sold = 0;	
			$weekly_product_sold = 0;	
			$daily_product_sold = 0;	

			$yearly_revenue = 0;
			$semesterly_revenue = 0;
			$quartley_revenue	= 0;
			$monthly_revenue = 0;	
			$weekly_revenue = 0;	
			$daily_revenue = 0;	

			$yearly_advertising_expenses = 0;
			$semesterly_advertising_expenses = 0;
			$quartley_advertising_expenses = 0;
			$monthly_advertising_expenses = 0;
			$weekly_advertising_expenses = 0;
			$daily_advertising_expenses = 0;

			$yearly_operating_expenses = 0;
			$semesterly_operating_expenses = 0;
			$quartley_operating_expenses = 0;
			$monthly_operating_expenses = 0;
			$weekly_operating_expenses = 0;
			$daily_operating_expenses = 0;

			$yearly_cost_of_products = 0;
			$semesterly_cost_of_products = 0;
			$quartley_cost_of_products = 0;
			$monthly_cost_of_products = 0;
			$weekly_cost_of_products = 0;
			$daily_cost_of_products = 0;

			$yearly_total_expenses = 0;
			$semesterly_total_expenses = 0;
			$quartley_total_expenses = 0;
			$monthly_total_expenses = 0;
			$weekly_total_expenses = 0;
			$daily_total_expenses = 0;

			$yearly_benefits = 0;
			$semesterly_benefits = 0;
			$quartley_benefits = 0;
			$monthly_benefits = 0;
			$weekly_benefits = 0;
			$daily_benefits = 0;

			$yearly_traffic_volume = 0;
			$semesterly_traffic_volume = 0;
			$quartley_traffic_volume = 0;
			$monthly_traffic_volume = 0;
			$weekly_traffic_volume = 0;
			$daily_traffic_volume = 0;

			$yearly_website_buyer_visitor = 0;
			$semesterly_website_buyer_visitor = 0;
			$quartley_website_buyer_visitor = 0;
			$monthly_website_buyer_visitor = 0;
			$weekly_website_buyer_visitor = 0;
			$daily_website_buyer_visitor = 0;
			$benefit_per_customer = 0;
			$roi = 0;
			$roi_percentage = 0;
			$roi_monetary = 0;
			if($annual_billing!=0 && $average_product_price!=0)
			{
				if($type=='3 months')
				{
					$main_days= 122;
					$main_weeks = 17.428;
					$main_monthly = 4;
					$main_quarterly = 1;
				}
				elseif($type=='6 months')
				{
					$main_days= 183;
					$main_weeks = 26;
					$main_monthly = 6;
					$main_quarterly = 2;
				}

				if($type=='year' && $achieve_goal_year>1)
				{
					$yearly_product_sold =  number_format(($annual_billing/$average_product_price/$achieve_goal_year), 4, '.', '');
					$quartley_product_sold = number_format(($annual_billing/$average_product_price/($main_quarterly*$achieve_goal_year)), 4, '.', '');
					$monthly_product_sold = number_format(($annual_billing/$average_product_price/($main_monthly*$achieve_goal_year)), 4, '.', '');
					$weekly_product_sold = number_format(($annual_billing/$average_product_price/($main_weeks*$achieve_goal_year)), 4, '.', '');
					$daily_product_sold = number_format(($annual_billing/$average_product_price/($main_days*$achieve_goal_year)), 4, '.', '');
				}
				else
				{
					$yearly_product_sold =  number_format($annual_billing/$average_product_price, 4, '.', '');
					$quartley_product_sold = number_format(($yearly_product_sold/$main_quarterly), 4, '.', '');
					$monthly_product_sold = number_format(($yearly_product_sold/$main_monthly), 4, '.', '');
					$weekly_product_sold = number_format(($yearly_product_sold/$main_weeks), 4, '.', '');
					$daily_product_sold = number_format(($yearly_product_sold/$main_days), 4, '.', '');
				}
				if(!empty($yearly_product_sold) && $yearly_product_sold!=0)
				{
					$semesterly_product_sold = number_format(($yearly_product_sold/2), 4, '.', '');
				}
				if($yearly_product_sold!=0  && $average_product_price!=0)
				{
					$yearly_revenue = number_format($yearly_product_sold*$average_product_price, 4, '.', '');
				}
				if($semesterly_product_sold!=0  && $average_product_price!=0)
				{
					$semesterly_revenue = number_format($semesterly_product_sold*$average_product_price, 4, '.', '');
				}
				if($quartley_product_sold!=0 && $average_product_price!=0)
				{
					$quartley_revenue	= number_format($quartley_product_sold*$average_product_price, 4, '.', '');
				}
				if($monthly_product_sold!=0 && $average_product_price!=0)
				{
					$monthly_revenue = number_format($monthly_product_sold*$average_product_price, 4, '.', '');
				}
				if($weekly_product_sold!=0 && $average_product_price!=0)
				{
					$weekly_revenue = number_format($weekly_product_sold*$average_product_price, 4, '.', '');
				}
				if($daily_product_sold!=0 && $average_product_price!=0)
				{
					$daily_revenue = number_format($daily_product_sold*$average_product_price, 4, '.', '');
				}



				if($type=='year' && $achieve_goal_year>1)
				{
					//Operating Expenses
					$yearly_operating_expenses =  number_format((($operating_expenses_percentage*$annual_billing)/$achieve_goal_year), 4, '.', '');
					$quartley_operating_expenses = number_format((($operating_expenses_percentage*$annual_billing)/ ($achieve_goal_year*$main_quarterly)), 4, '.', '');
					$monthly_operating_expenses = number_format((($operating_expenses_percentage*$annual_billing)/ ($achieve_goal_year*$main_monthly)), 4, '.', '');
					$weekly_operating_expenses = number_format((($operating_expenses_percentage*$annual_billing)/ ($achieve_goal_year*$main_weeks)), 4, '.', '');
					$daily_operating_expenses = number_format((($operating_expenses_percentage*$annual_billing)/ ($achieve_goal_year*$main_days)), 4, '.', '');

					//Advertising Expenses
					$yearly_advertising_expenses =  number_format((($advertising_expenses_percentage*$annual_billing)/ $achieve_goal_year), 4, '.', '');
					$quartley_advertising_expenses = number_format((($advertising_expenses_percentage*$annual_billing)/ ($achieve_goal_year*$main_quarterly)), 4, '.', '');
					$monthly_advertising_expenses = number_format((($advertising_expenses_percentage*$annual_billing)/ ($achieve_goal_year*$main_monthly)), 4, '.', '');
					$weekly_advertising_expenses = number_format((($advertising_expenses_percentage*$annual_billing)/ ($achieve_goal_year*$main_weeks)), 4, '.', '');
					$daily_advertising_expenses = number_format((($advertising_expenses_percentage*$annual_billing)/ ($achieve_goal_year*$main_days)), 4, '.', '');

					//cost of product sold
					$yearly_cost_of_products = number_format((($average_product_sold_cost_percentage*$annual_billing)/ $achieve_goal_year), 4, '.', '');
					$quartley_cost_of_products = number_format((($average_product_sold_cost_percentage*$annual_billing)/ ($achieve_goal_year*$main_quarterly)), 4, '.', '');
					$monthly_cost_of_products = number_format((($average_product_sold_cost_percentage*$annual_billing)/ ($achieve_goal_year*$main_monthly)), 4, '.', '');
					$weekly_cost_of_products = number_format((($average_product_sold_cost_percentage*$annual_billing)/ ($achieve_goal_year*$main_weeks)), 4, '.', '');
					$daily_cost_of_products = number_format((($average_product_sold_cost_percentage*$annual_billing)/ ($achieve_goal_year*$main_days)), 4, '.', '');
				}
				else
				{
					//Operating Expenses
					$yearly_operating_expenses =  number_format($operating_expenses_percentage*$yearly_revenue, 4, '.', '');
					$quartley_operating_expenses = number_format($operating_expenses_percentage*$quartley_revenue, 4, '.', '');
					$monthly_operating_expenses = number_format($operating_expenses_percentage*$monthly_revenue, 4, '.', '');
					$weekly_operating_expenses = number_format($operating_expenses_percentage*$weekly_revenue, 4, '.', '');
					$daily_operating_expenses = number_format($operating_expenses_percentage*$daily_revenue, 4, '.', '');

					//Advertising Expenses
					$yearly_advertising_expenses = number_format($advertising_expenses_percentage*$yearly_revenue, 4, '.', '');
					$quartley_advertising_expenses = number_format($advertising_expenses_percentage*$quartley_revenue, 4, '.', '');
					$monthly_advertising_expenses = number_format($advertising_expenses_percentage*$monthly_revenue, 4, '.', '');
					$weekly_advertising_expenses = number_format($advertising_expenses_percentage*$weekly_revenue, 4, '.', '');
					$daily_advertising_expenses = number_format($advertising_expenses_percentage*$daily_revenue, 4, '.', '');

					//cost of product sold
					$yearly_cost_of_products = number_format($average_product_sold_cost_percentage*$yearly_revenue, 4, '.', '');
					$quartley_cost_of_products = number_format($average_product_sold_cost_percentage*$quartley_revenue, 4, '.', '');
					$monthly_cost_of_products = number_format($average_product_sold_cost_percentage*$monthly_revenue, 4, '.', '');
					$weekly_cost_of_products = number_format($average_product_sold_cost_percentage*$weekly_revenue, 4, '.', '');
					$daily_cost_of_products = number_format($average_product_sold_cost_percentage*$daily_revenue, 4, '.', '');
				}
				if(!empty($yearly_operating_expenses) && $yearly_operating_expenses!=0)
				{
					$semesterly_operating_expenses = number_format(($yearly_operating_expenses/2), 4, '.', '');
				}
				if(!empty($yearly_cost_of_products) && $yearly_cost_of_products!=0)
				{
					$semesterly_cost_of_products = number_format(($yearly_cost_of_products/2), 4, '.', '');
				}
				if(!empty($yearly_advertising_expenses) && $yearly_advertising_expenses!=0)
				{
					$semesterly_advertising_expenses = number_format(($yearly_advertising_expenses/2), 4, '.', '');
				}
				$yearly_total_expenses = $yearly_advertising_expenses+$yearly_operating_expenses+$yearly_cost_of_products;
				$semesterly_total_expenses = $semesterly_advertising_expenses+ $semesterly_operating_expenses+ $semesterly_cost_of_products;
				$quartley_total_expenses = $quartley_advertising_expenses+$quartley_operating_expenses+$quartley_cost_of_products;
				$monthly_total_expenses = $monthly_advertising_expenses+$monthly_operating_expenses+$monthly_cost_of_products;
				$weekly_total_expenses = $weekly_advertising_expenses+$weekly_operating_expenses+$weekly_cost_of_products;
				$daily_total_expenses = $daily_advertising_expenses+$daily_operating_expenses+$daily_cost_of_products;

				if($yearly_revenue>$yearly_total_expenses)
				{
					$yearly_benefits = number_format($yearly_revenue-$yearly_total_expenses, 4, '.', '');
				}
				if(!empty($yearly_benefits) && $yearly_benefits!=0)
				{
					$semesterly_benefits = number_format(($yearly_benefits/2), 4, '.', '');
				}
				if($quartley_revenue>$quartley_total_expenses)
				{
					$quartley_benefits = number_format($quartley_revenue-$quartley_total_expenses, 4, '.', '');
				}
				if($monthly_revenue>$monthly_total_expenses)
				{
					$monthly_benefits = number_format($monthly_revenue-$monthly_total_expenses, 4, '.', '');
				}
				if($weekly_revenue>$weekly_total_expenses)
				{
					$weekly_benefits = number_format($weekly_revenue-$weekly_total_expenses, 4, '.', '');
				}
				if($daily_revenue>$daily_total_expenses)
				{
					$daily_benefits = number_format($daily_revenue-$daily_total_expenses, 4, '.', '');
				}


				if($type=='year' && $achieve_goal_year>1)
				{
					$first_traffic_value = number_format($annual_billing/$average_product_price, 4, '.', '');	
					$yearly_traffic_volume = number_format((($first_traffic_value/($achieve_goal_year))/$crp), 4, '.', '');
					if(!empty($yearly_traffic_volume) && $yearly_traffic_volume!=0)
					{
						$semesterly_traffic_volume = number_format(($yearly_traffic_volume/2), 4, '.', '');
					}
					$quartley_traffic_volume = number_format((($first_traffic_value/($main_quarterly*$achieve_goal_year))/$crp), 4, '.', '');
					$monthly_traffic_volume = number_format((($first_traffic_value/($main_monthly*$achieve_goal_year))/$crp), 4, '.', '');
					$weekly_traffic_volume = number_format((($first_traffic_value/($main_weeks*$achieve_goal_year))/$crp), 4, '.', '');
					$daily_traffic_volume = number_format((($first_traffic_value/($main_days*$achieve_goal_year))/$crp), 4, '.', '');
				}
				else
				{
					$first_traffic_value = number_format($annual_billing/$average_product_price, 4, '.', '');	

					$yearly_traffic_volume = number_format((($first_traffic_value)/$crp), 4, '.', '');
					if(!empty($yearly_traffic_volume) && $yearly_traffic_volume!=0)
					{
						$semesterly_traffic_volume = number_format(($yearly_traffic_volume/2), 4, '.', '');
					}
					$quartley_traffic_volume = number_format((($first_traffic_value/$main_quarterly)/$crp), 4, '.', '');
					$monthly_traffic_volume = number_format((($first_traffic_value/$main_monthly)/$crp), 4, '.', '');
					$weekly_traffic_volume = number_format((($first_traffic_value/$main_weeks)/$crp), 4, '.', '');
					$daily_traffic_volume = number_format((($first_traffic_value/($main_days))/$crp), 4, '.', '');
				}


				$yearly_website_buyer_visitor = number_format($yearly_traffic_volume*$crp, 4, '.', '');
				if(!empty($yearly_website_buyer_visitor) && $yearly_website_buyer_visitor!=0)
				{
					$semesterly_website_buyer_visitor = number_format(($yearly_website_buyer_visitor/2), 4, '.', '');
				}
				$quartley_website_buyer_visitor = number_format($quartley_traffic_volume*$crp, 4, '.', '');
				$monthly_website_buyer_visitor = number_format($monthly_traffic_volume*$crp, 4, '.', '');
				$weekly_website_buyer_visitor = number_format($weekly_traffic_volume*$crp, 4, '.', '');
				$daily_website_buyer_visitor = number_format($daily_traffic_volume*$crp, 4, '.', '');

				if($yearly_benefits>$yearly_website_buyer_visitor)
				{
					$benefit_per_customer = number_format($yearly_benefits/$yearly_website_buyer_visitor, 4, '.', '');
				}
				if($yearly_benefits>$yearly_total_expenses)
				{
					$roi = ($yearly_benefits/$yearly_total_expenses)*100;
					$roi_percentage = number_format($roi/100, 2, '.', '');

					$roi_monetary = number_format((((($yearly_benefits/$yearly_total_expenses)*100)/100)*$yearly_total_expenses), 4, '.', '');
				}
				$html .= '<br><br><p>6 Months Plan</p><br>
							<table id="goals" style="border:1px solid #ddd;">
							  <tr style="background-color:#4CAF50;">
								  <th></th>
								  <th>Day</th>
								  <th>Week</th>
								  <th>Monthly</th>
								  <th>Quarterly</th>';
								  if($type=='year')
								  {
									  $html .= '<th>Semester</th>';
									  $html .= '<th>Yearly</th>';
								  }

							  $html .= '</tr>';
							  $html .= '<tr>
								<td>Total number of products to be sold</td>
								<td>'.round($daily_product_sold).'</td>
								<td>'.round($weekly_product_sold).'</td>
								<td>'.round($monthly_product_sold).'</td>
								<td>'.round($quartley_product_sold).'</td>';
								if($type=='year')
								{
									$html .= "<td>".round($semesterly_product_sold)."</td>";
									$html .= "<td>".round($yearly_product_sold)."</td>";
								}
							   $html .= '</tr>';
							   $html .= '<tr>
								<td>Total revenue</td>
								<td>'.round($daily_revenue).' €</td>
								<td>'.round($weekly_revenue).' €</td>
								<td>'.round($monthly_revenue).' €</td>
								<td>'.round($quartley_revenue).' €</td>';
								if($type=='year')
								{
									$html .= "<td>".round($semesterly_revenue)." €</td>";
									$html .= "<td>".round($yearly_revenue)." €</td>";
								}

							   $html .= '</tr>';
							   $html .= '<tr>
								<td>Advertising expenses</td>
								<td>'.round($daily_advertising_expenses).' €</td>
								<td>'.round($weekly_advertising_expenses).' €</td>
								<td>'.round($monthly_advertising_expenses).' €</td>
								<td>'.round($quartley_advertising_expenses).' €</td>';
								if($type=='year')
								{
									$html .= "<td>".round($semesterly_advertising_expenses)." €</td>";
									$html .= "<td>".round($yearly_advertising_expenses)." €</td>";
								}

							 $html .= '</tr>';
							 $html .= '<tr>
								<td>Operating Expenses</td>
								<td>'.round($daily_operating_expenses).' €</td>
								<td>'.round($weekly_operating_expenses).' €</td>
								<td>'.round($monthly_operating_expenses).' €</td>
								<td>'.round($quartley_operating_expenses).' €</td>';
								if($type=='year')
								{
									$html .= "<td>".round($semesterly_operating_expenses)." €</td>";
									$html .= "<td>".round($yearly_operating_expenses)." €</td>";
								}

							  $html .= '</tr>';
							  $html .= '<tr>
								<td>Cost of products / services</td>
								<td>'.round($daily_cost_of_products).' €</td>
								<td>'.round($weekly_cost_of_products).' €</td>
								<td>'.round($monthly_cost_of_products).' €</td>
								<td>'.round($quartley_cost_of_products).' €</td>';
								if($type=='year')
								{
									$html .= "<td>".round($semesterly_cost_of_products)." €</td>";
									$html .= "<td>".round($yearly_cost_of_products)." €</td>";
								}

							  $html .= '</tr>';
							  $html .= '<tr>
								<td>Total expenses</td>
								<td>'.round($daily_total_expenses).' €</td>
								<td>'.round($weekly_total_expenses).' €</td>
								<td>'.round($monthly_total_expenses).' €</td>
								<td>'.round($quartley_total_expenses).' €</td>';
								if($type=='year')
								{
									$html .= "<td>".round($semesterly_total_expenses)." €</td>";
									$html .= "<td>".round($yearly_total_expenses)." €</td>";
								}

							  $html .= '</tr>';
							  $html .= '<tr>
								<td>Benefits</td>
								<td>'.round($daily_benefits).' €</td>
								<td>'.round($weekly_benefits).' €</td>
								<td>'.round($monthly_benefits).' €</td>
								<td>'.round($quartley_benefits).' €</td>';
								if($type=='year')
								{
									$html .= "<td>".round($semesterly_benefits)." €</td>";
									$html .= "<td>".round($yearly_benefits)." €</td>";
								}

							  $html .= '</tr>';
							  $html .= '<tr>
								<td>Qualified traffic volume to the website</td>
								<td>'.round($daily_traffic_volume).' €</td>
								<td>'.round($weekly_traffic_volume).' €</td>
								<td>'.round($monthly_traffic_volume).' €</td>
								<td>'.round($quartley_traffic_volume).' €</td>';
								if($type=='year')
								{
									$html .= "<td>".round($semesterly_traffic_volume)." €</td>";
									$html .= "<td>".round($yearly_traffic_volume)." €</td>";
								}

							  $html .= '</tr>';
							  $html .= '<tr>
								<td>Volume of web visitors that you should buy at least one product</td>
								<td>'.round($daily_website_buyer_visitor).' €</td>
								<td>'.round($weekly_website_buyer_visitor).' €</td>
								<td>'.round($monthly_website_buyer_visitor).' €</td>
								<td>'.round($quartley_website_buyer_visitor).' €</td>';
								if($type=='year')
								{
									$html .= "<td>".round($semesterly_website_buyer_visitor)." €</td>";
									$html .= "<td>".round($yearly_website_buyer_visitor)." €</td>";
								}

							  $html .= '</tr>';
							  $html .= '<tr>
								<td>Benefits for customers</td>
								<td>'.round($benefit_per_customer).' €</td>
							  </tr>
							  <tr>
								<td>ROI (Return on investment)</td>
								<td>'.round($roi).'%</td>
							  </tr>
							  <tr>
								<td>ROI (Monetary value)</td>
								<td>'.round($roi_monetary).' €</td>
							  </tr>
							</table>
						';
			 }
		}
		return $html;
	}
	public function SignUpSuccess()
	{
		$header_data = array('page_title' => 'Thanks');
 		load_web_main_template('signup_success_v', $header_data, '');	
	}
	public function CreditCardValidation()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$this->load->model("Users_m","users");
			$this->load->model("Web_setting_m","setting");
			$coupon_discount_amount = 0;
			$total_discount = 0;
			$total_amount = 0;
			$plan_id = '';
			$coupon_code = '';
			if(!empty($this->session->userdata('MiPlani_user_id')))
			{
				$user_row = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
				if(!empty($user_row))
				{
					if(!empty($_POST['key_id']) && !empty($_POST['card_number']) && !empty($_POST['cvv']) && !empty($_POST['expiry_month']) && !empty($_POST['expiry_year'] && !empty($_POST['card_name']) ))
					{
						$plan_row =  array();
						if(!empty($_POST['key_id']))
						{
							$pricing_plan_id = base64_decode($this->input->post('key_id', TRUE));
							$plan_row = $this->setting->get_pricing_plan_row($pricing_plan_id);
						}
						if(!empty($plan_row))
						{
							$plan_id = $plan_row->plan_id;
							$total_amount = $plan_row->plan_price;
							if($total_amount<1)
							{
								echo 'We cannot proceed with 0 amount'; exit;
							}
							
							if(!empty($_POST['code']))
							{
								$coupon = base64_decode($this->input->post('code', TRUE));
								$coupon_row = $this->setting->get_sub_coupon_row($coupon);
								if(!empty($coupon_row))
								{
									$coupon_code = $coupon_row->coupon_code;
									if(time()>$coupon_row->coupon_expiry_date)
									{
										echo 'This coupon code is expired'; exit;
									}
									elseif(time()<=$coupon_row->coupon_start_date)
									{
										echo 'This coupon code is not valid'; exit;
									}
									elseif($this->setting->ceck_coupon_usage($coupon_code)>=$coupon_row->frequency)
									{
										echo 'This coupon code is no more valid'; exit;
									}
									else
									{
										$plan_price = $plan_row->plan_price;
										$total_amount = $plan_price;
										if($plan_price>0)
										{
											$coupon_discount_amount = $coupon_row->coupon_discount_amount;
											$discount_percentage = number_format($coupon_discount_amount, 2, '.', '');
											$total_discount =  number_format($plan_price/$discount_percentage, 2, '.', '');
											$total_amount = number_format($plan_price-$total_discount, 2, '.', '');
										}
										if($total_amount<1)
										{
											echo 'We cannot proceed with 0 amount'; exit;
										}
									}
								}
								else
								{
									echo 'please enter valid coupon code';exit;
 								}
							}
							$ci = get_instance(); 
							$ci->load->config('paypal');
							$api_version = $this->config->item('paypal_pro_api_version'); 
							$api_endpoint = $this->config->item('paypal_pro_api_endpoint');
							$api_username = $this->config->item('paypal_pro_api_username');
							$api_password = $this->config->item('paypal_pro_api_password');
							$api_signature = $this->config->item('paypal_pro_api_signature');

							$request_params = array
							(
								'METHOD' => 'DoDirectPayment', 
								'USER' => $api_username, 
								'PWD' => $api_password, 
								'SIGNATURE' => $api_signature, 
								'VERSION' => $api_version, 
								'PAYMENTACTION' => 'Sale',                   
								'IPADDRESS' => $_SERVER['REMOTE_ADDR'],
								'ACCT' => $_POST['card_number'],                        
								'EXPDATE' => $_POST['expiry_month'].$_POST['expiry_year'],       
								'CVV2' => $_POST['cvv'], 
								'FIRSTNAME' => 'Tester', 
								'LASTNAME' => 'Testerson', 
								'STREET' => '707 W. Bay Drive', 
								'CITY' => 'Largo', 
								'STATE' => 'FL',                     
								'COUNTRYCODE' => 'US', 
								'ZIP' => '33770', 
								'AMT' => '100.00', 
								'CURRENCYCODE' => 'USD', 
								'DESC' => 'Testing Payments Pro'
							);

							$nvp_string = '';
							foreach($request_params as $var=>$val)
							{
								$nvp_string .= '&'.$var.'='.urlencode($val);    
							}
							// Send NVP string to PayPal and store response
							$curl = curl_init();
									curl_setopt($curl, CURLOPT_VERBOSE, 1);
									curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
									curl_setopt($curl, CURLOPT_TIMEOUT, 30);
									curl_setopt($curl, CURLOPT_URL, $api_endpoint);
									curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
									curl_setopt($curl, CURLOPT_POSTFIELDS, $nvp_string);

							$result = curl_exec($curl); 
							curl_close($curl);
							if(!empty($result))
							{
								$payment_data = $this->NVPToArray($result);
								if(!empty($payment_data))
								{
									$payment_status = $payment_data['ACK'];
									if($payment_status=='Success')
									{
										//insert payment
										$this->users->add_user_payment($plan_id,$total_amount,$coupon_code);
										echo $payment_status;
									}
									else
									{
										if(!empty($payment_data['L_LONGMESSAGE0']))
										{
											echo $payment_data['L_LONGMESSAGE0'];
										}
										else
										{
											echo 'Payment failed, please refresh page and try again';
										}
									}
								}
								else
								{
									echo 'Payment failed, please refresh page and try again';
								}
							}
							else
							{
								echo 'Payment failed, please refresh page and try again';
							}
						}
						else
						{
							echo 'Payment failed, please refresh page and try again';
						}
					}
					else
					{
						echo 'Please filled all information and then try again';
					}
				}
				else
				{
					echo $this->lang->line('lang_sign_in_to_continue_error');
				}
			}
			else
			{
				echo $this->lang->line('lang_sign_in_to_continue_error');
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	private function NVPToArray($NVPString)
	{
		$proArray = array();
		while(strlen($NVPString))
		{
			// name
			$keypos= strpos($NVPString,'=');
			$keyval = substr($NVPString,0,$keypos);
			// value
			$valuepos = strpos($NVPString,'&') ? strpos($NVPString,'&'): strlen($NVPString);
			$valval = substr($NVPString,$keypos+1,$valuepos-$keypos-1);
			// decoding the respose
			$proArray[$keyval] = urldecode($valval);
			$NVPString = substr($NVPString,$valuepos+1,strlen($NVPString));
		}
		return $proArray;
	}



}
