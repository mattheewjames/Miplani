<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Projections extends MY_Web_Profile_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
 	public function index()
	{
		$header_data = array('page_title' => 'Projections');
		$this->load->model("Users_m","users");
		$this->load->model("Projection_m","projection");
		$data['error_message'] ='';
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$data['user_row'] = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(!empty($data['user_row']))
			{
				$data['projection_list'] = $this->projection->get_user_wise_projection_list($this->session->userdata('MiPlani_user_id'));
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
  		load_web_main_template('projection_v', $header_data,$data);
 	}
 	
	public function NewProjection()
	{
  		$header_data = array('page_title' => $this->lang->line('lang_new_projection_label'));
		$this->load->model("Users_m","users");
 		$data['error_message'] ='';
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$data['user_row'] = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(empty($data['user_row']))
			{
				$data['error_message'] = $this->lang->line('lang_sign_in_to_continue_error');
			}
		}
		else
		{
			$data['error_message'] = $this->lang->line('lang_sign_in_to_continue_error');
		}
  		load_web_main_template('new_projection_v', $header_data,$data);
	}
	public function ProjectionStep()
	{
		if($this->input->server('REQUEST_METHOD')=='POST')
		{
			$html ='';
			$this->load->model("Projection_m","projection");
			$this->load->model("Users_m","users");
			if(!empty($this->session->userdata('MiPlani_user_id')))
			{
				$user_row = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
				if(!empty($user_row))
				{
					$form_data = array();
					$projection_id  = 0;
					$form_step  = 0;
					$action_type = 'save';
					if(!empty($_POST['action_type']))
					{
						$action_type  = $_POST['action_type'];
					}
					if(!empty($_POST['form_step']))
					{
						$form_step  = $_POST['form_step'];
					}
					if(!empty($_POST['form_pid']))
					{
						$projection_id  = $_POST['form_pid'];
					}

					if(!empty($_POST['form_data']))
					{
						$form_array = parse_str($_POST['form_data'], $form_data);
					}
					if(!in_array($action_type,array('save','next','previous','submit')))
					{
						echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_projection_step_type_error'),"html"=>''));
					}
					else
					{
						if($form_step>0 && $form_step<=12)
						{
							if($projection_id>0)
							{
								$check_projection_record = $this->projection->check_projection_record($projection_id,$this->session->userdata('MiPlani_user_id'));
								if($check_projection_record<1)
								{
									echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_select_valid_projection_record_error'),"html"=>''));
								}
								else
								{
 									if($this->input->post('form_step')==1)
									{
										if($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next')
										{
											$projection_name = trim($form_data['projection_name']);
											if(empty($projection_name))
											{
												echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_please_enter_projection_name_error'),"html"=>''));
												exit;
											}
											else
											{
												$projection_id = $this->projection->save_projection();
												$html = $this->load_projection_step_one_html($projection_id,$action_type);
											}
										}
										else
										{
											$projection_id = $this->projection->save_projection();
											$html = $this->load_projection_step_one_html($projection_id,$action_type);
										}
									}
									elseif($this->input->post('form_step')==2)
									{
										if($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next')
										{
											$annual_billing = $form_data['annual_billing'];
											if(empty($annual_billing))
											{
												$annual_billing = str_replace(".","",$annual_billing);
												$annual_billing = intval($annual_billing);
											}
											if(empty($annual_billing))
											{
												echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_please_enter_annual_billing_error'),"html"=>''));
												exit;
											}
											elseif(!is_numeric($annual_billing))
											{
												echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_please_enter_valid_annual_billing_error'),"html"=>''));
												exit;
											}
											elseif($annual_billing>30000 && $user_row->current_subscription_type=='Free')
											{
												echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_free_package_annual_billing_limit_error'),"html"=>''));
												exit;
											}
											else
											{
												$projection_id = $this->projection->save_projection();
												$html = $this->load_projection_step_two_html($projection_id,$action_type);
											}
										}
										else
										{
											$projection_id = $this->projection->save_projection();
											$html = $this->load_projection_step_two_html($projection_id,$action_type);	
  										}
									}
									elseif($this->input->post('form_step')==3)
									{
										if($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next')
										{
											$average_product_price = $form_data['average_product_price'];
											if(empty($average_product_price))
											{
												$average_product_price = str_replace(".","",$average_product_price);
												$average_product_price = intval($average_product_price);
											}
											if(empty($average_product_price))
											{
												echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_please_enter_average_product_price_error'),"html"=>''));
												exit;
											}
											elseif(!is_numeric($average_product_price))
											{
												echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_please_enter_valid_average_product_price_error'),"html"=>''));
												exit;
											}
											else
											{
												$projection_id = $this->projection->save_projection();
												$html = $this->load_projection_step_three_html($projection_id,$action_type);
											}
										}
										else
										{
											$projection_id = $this->projection->save_projection();
											$html = $this->load_projection_step_three_html($projection_id,$action_type);	
  										}
									}
									elseif($this->input->post('form_step')==4)
									{
										if($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next')
										{
											$operating_expenses = $form_data['operating_expenses'];
											$advertising_expenses = $form_data['advertising_expenses'];
											$average_product_sold_cost = $form_data['average_product_sold_cost'];
											if(empty($operating_expenses))
											{
												echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_please_enter_operating_expenses_error'),"html"=>''));
												exit;
											}
											elseif($operating_expenses<1 || $operating_expenses>100)
											{
												echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_please_enter_valid_operating_expenses_error'),"html"=>''));
												exit;
											}
											elseif(empty($advertising_expenses))
											{
												echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_please_enter_advertising_expenses_error'),"html"=>''));
												exit;
											}
											elseif($advertising_expenses<1 || $advertising_expenses>100)
											{
												echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_please_enter_valid_advertising_expenses_error'),"html"=>''));
												exit;
											}
											elseif(empty($average_product_sold_cost))
											{
												echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_please_enter_average_product_sold_cost_error'),"html"=>''));
												exit;
											}
											elseif($average_product_sold_cost<1 || $average_product_sold_cost>100)
											{
												echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_please_enter_valid_average_product_sold_cost_error'),"html"=>''));
												exit;
											}
											else
											{
												$projection_id = $this->projection->save_projection();
												$html = $this->load_projection_step_four_html($projection_id,$action_type);
											}
										}
										else
										{
											$projection_id = $this->projection->save_projection();
											$html = $this->load_projection_step_four_html($projection_id,$action_type);	
  										}
									}
									elseif($this->input->post('form_step')==5)
									{
										if($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next')
										{
											$conversion_rate = $form_data['conversion_rate'];
											if(empty($conversion_rate))
											{
												echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_please_enter_conversion_rate_error'),"html"=>''));
												exit;
											}
											elseif($conversion_rate<1 || $conversion_rate>100)
											{
												echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_please_enter_valid_conversion_rate_error'),"html"=>''));
												exit;
											}
											else
											{
												$projection_id = $this->projection->save_projection();
												$html = $this->load_projection_step_five_html($projection_id,$action_type);
											}
										}
										else
										{
											$projection_id = $this->projection->save_projection();
											$html = $this->load_projection_step_five_html($projection_id,$action_type);	
  										}
									}
									elseif($this->input->post('form_step')==6)
									{
										if($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next')
										{
											$projection_id = $this->projection->save_projection();
											$html = $this->load_projection_step_six_html($projection_id,$action_type);
										}
										else
										{
											$projection_id = $this->projection->save_projection();
											$html = $this->load_projection_step_six_html($projection_id,$action_type);	
  										}
									}
									elseif($this->input->post('form_step')==7)
									{
										if($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next')
										{
											$projection_id = $this->projection->save_projection();
											$html = $this->load_projection_step_seven_html($projection_id,$action_type);
										}
										else
										{
											$projection_id = $this->projection->save_projection();
											$html = $this->load_projection_step_seven_html($projection_id,$action_type);	
  										}
									}
									elseif($this->input->post('form_step')==8)
									{
										if($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next')
										{
											$projection_id = $this->projection->save_projection();
											$html = $this->load_projection_step_eight_html($projection_id,$action_type);
										}
										else
										{
											$projection_id = $this->projection->save_projection();
											$html = $this->load_projection_step_eight_html($projection_id,$action_type);	
  										}
									}
									elseif($this->input->post('form_step')==9)
									{
										if($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next')
										{
											$projection_id = $this->projection->save_projection();
											$html = $this->load_projection_step_nine_html($projection_id,$action_type);
										}
										else
										{
											$projection_id = $this->projection->save_projection();
											$html = $this->load_projection_step_nine_html($projection_id,$action_type);	
  										}
									}
									elseif($this->input->post('form_step')==10)
									{
										if($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next')
										{
											$projection_id = $this->projection->save_projection();
											$html = $this->load_projection_step_ten_html($projection_id,$action_type);
										}
										else
										{
											$projection_id = $this->projection->save_projection();
											$html = $this->load_projection_step_ten_html($projection_id,$action_type);	
  										}
									}
									elseif($this->input->post('form_step')==11)
									{
										if($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next')
										{
											$projection_id = $this->projection->save_projection();
											$html = $this->load_projection_step_eleven_html($projection_id,$action_type);
 										}
										else
										{
											$projection_id = $this->projection->save_projection();
											$html = $this->load_projection_step_eleven_html($projection_id,$action_type);
   										}
									}
									elseif($this->input->post('form_step')==12)
									{
										if($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next')
										{
											$projection_id = $this->projection->save_projection();
 										}
										else
										{
											$projection_id = $this->projection->save_projection();
   										}
										
										if($this->input->post('action_type')=='save' || $this->input->post('action_type')=='submit')
										{
											$currency_list = array('USD','GBP','EUR');
 											$currency  = ''; 
 											if(!empty($form_data['currency']))
											{
												$currency = $form_data['currency'];
											}
 				
											if(empty($currency) || !in_array($currency,$currency_list))
											{
												echo json_encode(array("response_code"=>'404',"response_message"=>'Please select currency',"html"=>''));
												exit;
											}
											else
											{
												
												$projection_id = $this->projection->save_projection();
  												if($this->input->post('action_type')=='submit')
												{
													$html = 'completed';
												}
												else
												{
													$html = $this->load_projection_step_twelve_html($projection_id,$action_type);	
												}
											}
										}
										else
										{
											$projection_id = $this->projection->save_projection();
											$html = $this->load_projection_step_twelve_html($projection_id,$action_type);	
  										}
									}
									
									if(!empty($html))
									{
										if($html=='completed')
										{
											$response_id = base64_encode($projection_id);
											echo json_encode(array("response_code"=>'204',"response_message"=>'',"html"=>$response_id));
										}
										else
										{
											echo json_encode(array("response_code"=>'200',"response_message"=>'',"html"=> $html));
										}
									}
									else
									{
										echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_step_html_error'),"html"=>''));
									}
  								}
							}
							else
							{
								if($this->input->post('form_pid')==0 && $this->input->post('form_step')==1)
								{
									//here add new projection
									$projection_name = trim($form_data['projection_name']);
									if(empty($projection_name))
									{
										echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_please_enter_projection_name_error'),"html"=>''));
									}
									else
									{
										$projection_id = $this->projection->save_projection();
										$html = $this->load_projection_step_one_html($projection_id,$action_type);		
										if(!empty($html))
										{
											echo json_encode(array("response_code"=>'200',"response_message"=>'',"html"=> $html));
										}
										else
										{
											echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_step_html_error'),"html"=>''));
										}
									}
								}
								else
								{
									//$projection_id is only 0 for 1st time
									echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_select_valid_projection_record_error'),"html"=>''));
								}
							}
						}
						else
						{
							echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_projection_valid_step_error'),"html"=>''));
						}
					}
				}
				else
				{
					echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_sign_in_to_continue_error'),"html"=>''));
				}
			}
			else
			{
				echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_sign_in_to_continue_error'),"html"=>''));
			}
		}
		else
		{
			//404 page fro get request from browser
			redirect(base_url());
		}
	}
	public function EditProjectionStep()
	{
		if($this->input->server('REQUEST_METHOD')=='POST')
		{
			
			$html ='';
			$form_data = array();
			$projection_id  = 0;
			$form_step  = 0;
			$action_type = 'save';
			if(!empty($_POST['form_step']))
			{
				$form_step  = $_POST['form_step'];
			}
			if(!empty($_POST['form_pid']))
			{
				$projection_id  = base64_decode($_POST['form_pid']);
			}
			$this->load->model("Projection_m","projection");
			$this->load->model("Users_m","users");
			if(!empty($this->session->userdata('MiPlani_user_id')))
			{
				$user_row = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
				if(!empty($user_row))
				{
					if($form_step>0 && $form_step<=12)
					{
						$row = $this->projection->get_projection_row($projection_id,$this->session->userdata('MiPlani_user_id'));
						if(!empty($row))
						{
 							if($this->input->post('form_step')==1)
							{
								 $html = $this->load_projection_step_one_html($projection_id,$action_type);
							}
							elseif($this->input->post('form_step')==2)
							{
								$html = $this->load_projection_step_two_html($projection_id,$action_type);	
							}
							elseif($this->input->post('form_step')==3)
							{
								$html = $this->load_projection_step_three_html($projection_id,$action_type);
							}
							elseif($this->input->post('form_step')==4)
							{
 								$html = $this->load_projection_step_four_html($projection_id,$action_type);	
							}
							elseif($this->input->post('form_step')==5)
							{
								$html = $this->load_projection_step_five_html($projection_id,$action_type);	
							}
							elseif($this->input->post('form_step')==6)
							{
								$html = $this->load_projection_step_six_html($projection_id,$action_type);	
							}
							elseif($this->input->post('form_step')==7)
							{
								$html = $this->load_projection_step_seven_html($projection_id,$action_type);	
							}
							elseif($this->input->post('form_step')==8)
							{
								$html = $this->load_projection_step_eight_html($projection_id,$action_type);
							}
							elseif($this->input->post('form_step')==9)
							{
								$html = $this->load_projection_step_nine_html($projection_id,$action_type);	
							}
							elseif($this->input->post('form_step')==10)
							{
								$html = $this->load_projection_step_ten_html($projection_id,$action_type);	
							}
							elseif($this->input->post('form_step')==11)
							{
								$html = $this->load_projection_step_eleven_html($projection_id,$action_type);
							}
							elseif($this->input->post('form_step')==12)
							{
								$html = $this->load_projection_step_twelve_html($projection_id,$action_type);
							}

							if(!empty($html))
							{
								if($html=='completed')
								{
									$response_id = base64_encode($projection_id);
									echo json_encode(array("response_code"=>'204',"response_message"=>'',"html"=>$response_id));
								}
								else
								{
									echo json_encode(array("response_code"=>'200',"response_message"=>'',"html"=> $html));
								}
							}
							else
							{
								echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_step_html_error'),"html"=>''));
							}
 						}
						else
						{
							//$projection_id is only 0 for 1st time
							echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_select_valid_projection_record_error'),"html"=>''));
						}
					}
					else
					{
						echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_projection_valid_step_error'),"html"=>''));
					}
				}
				else
				{
					echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_sign_in_to_continue_error'),"html"=>''));
				}
			}
			else
			{
				echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_sign_in_to_continue_error'),"html"=>''));
			}
		}
		else
		{
			//404 page fro get request from browser
			redirect(base_url());
		}
	}
	private function load_projection_step_one_html($projection_id,$action_type)
	{
		$this->load->model("Users_m","users");
		$this->load->model("Projection_m","projection");
		$html = '';
		$new_step = 2;
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			if($projection_id>0)
			{
 				$user_row = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
				$projection_row = $this->projection->get_projection_row($projection_id,$this->session->userdata('MiPlani_user_id'));
				if(!empty($projection_row) && !empty($user_row))
				{
 					$current_subscription = $this->lang->line('lang_free_label');
					if(!empty($user_row->current_subscription_type))
					{
						if($user_row->current_subscription_type=='Free')
						{
							$current_subscription = $this->lang->line('lang_free_label');
						}
						elseif($user_row->current_subscription_type=='Annual')
						{
							$current_subscription = $this->lang->line('lang_free_label');
						}
						elseif($user_row->current_subscription_type=='Monthly')
						{
							$current_subscription = $this->lang->line('lang_free_label');
						}
						elseif($user_row->current_subscription_type=='Lifetime')
						{
							$current_subscription = $this->lang->line('lang_free_label');
						}
					}
					if($action_type=='save'  || $action_type=='previous')
					{
						$new_step = 1;
 						$html = '<div class="col-lg-12 col-md-12">
								<div class="contact_message form form-bg">
									<h3>'.$this->lang->line('lang_personal_information_label').'</h3>
									<div class="row">
										<div class="col-lg-3 col-md-6">
											<p>
												<label class="fw-600">'.$this->lang->line('lang_first_name_label').'</label>
												<input type="text" value="'.$user_row->first_name.'" class="view-input" readonly style=" border: 1px solid #efefef !important">
											</p>
										</div>
										<div class="col-lg-3 col-md-6">
											<p>
												<label class="fw-600">'.$this->lang->line('lang_last_name_label').'</label>
											   <input type="text" value="'.$user_row->last_name.'" readonly class="view-input" style=" border: 1px solid #efefef !important">
											</p>
										</div>
										<div class="col-lg-3 col-md-6">
											<p>
												<label class="fw-600">'.$this->lang->line('lang_lemail_address_label').'</label>
												 <input type="text" value="'.$user_row->user_email.'" readonly class="view-input" style=" border: 1px solid #efefef !important">
											</p>
										</div>
										 <div class="col-lg-3 col-md-6">
											<p>
												<label class="fw-600">'.$this->lang->line('lang_type_of_subscription_label').'</label>
												<input value="'.$current_subscription.'" type="text" class="view-input" readonly style="border: 1px solid #efefef !important">
											</p>
										</div>
									</div>
									 <div class="col-md-12 p-0 text-left">
										<h4>'.$this->lang->line('lang_projection_name_label').'</h4>
									 </div>
									<div class="row">
										<div class="offset-md-3 col-md-6">
											<p>
												<label class="fw-600"></label>
												<input name="projection_name" id="projection_name" value="'.$projection_row->projection_name.'" placeholder="'.$this->lang->line('lang_enter_projection_name_label').'" type="text">
											</p>
										</div>
									</div>

									<div class="col-md-12 text-right p-0">
										
										<button type="button" onclick="load_user_projection_wizard(\'1\',\''.$projection_id.'\',\'next\')"> '.$this->lang->line('lang_next_label').'</button>
									</div>
								</div>
							</div>';
						
							$html .='<div class="col-lg-12 col-md-12 mt-3">
								<div class="contact_message form form-bg">
									<div class="col-md-12 p-0 text-left">
										<h4 class="theme-color-blue">'.$this->lang->line('lang_help_label').':</h4>
									</div>
									<label>'.$this->lang->line('lang_before_start_projection_help_label').' <a href="'. base_url('pages/HowsItsWork').'" class="color-blue" target="_blank">'.$this->lang->line('lang_help_label').'</a>.</label>
								</div>
							</div>';
					}
					elseif($action_type=='next')
					{
						$new_step = 2;
						$html = '<div class="col-lg-12 col-md-12">
							<div class="contact_message form form-bg">
								<h3>'.$this->lang->line('lang_desire_financial_goal_label').'</h3>
								<form id="contact-form" method="" action="">
									<div class="row mb-4 m-mb-0">
										<div class="col-md-12">
											<div class="red-warning">
												<span class="float-right">
													<i class="fa fa-times" aria-hidden="true"></i>
												</span>
												'.$this->lang->line('lang_projection_step_two_premium_plan_label').' <a target="_blank" href="'.base_url("pages/PricingPlan").'" class="upgrade-link">'.$this->lang->line('lang_upgrade_label').'</a> '.$this->lang->line('lang_to_a_higher_plan_label').'
											</div>
										</div>
										<div class="offset-md-3 col-md-6">
												<label class="fw-600"> What is your desired annual billing (&euro;) ? </label> <br>
												<input class="mt-1" name="annual_billing" id="annual_billing" value="'.$projection_row->annual_billing.'" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="">
										</div>
									</div>

									<div class="col-md-12 row m-0 p-0">
										<div class="col-md-6 col-6 text-left p-0">
											<button type="button"  onclick="load_user_projection_wizard(\'1\',\''.$projection_id.'\',\'previous\')"> '.$this->lang->line('lang_previous_label').'</button> 
										</div>
										<div class="col-md-6 col-6 text-right p-0 form-btns">
											 
											<button type="button" onclick="load_user_projection_wizard(\''.$new_step.'\',\''.$projection_id.'\',\'next\')"> '.$this->lang->line('lang_next_label').'</button>
										</div>
									</div>
								</form>
							</div>
						</div>';
					}
				}
			}
		}
		return $html;
	}
	private function load_projection_step_two_html($projection_id,$action_type)
	{
		$this->load->model("Projection_m","projection");
		$html = '';
		$new_step = 3;
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			if($projection_id>0)
			{
				$projection_row = $this->projection->get_projection_row($projection_id,$this->session->userdata('MiPlani_user_id'));
				if(!empty($projection_row))
				{
					if($action_type=='save')
					{
 						$html = $this->load_projection_step_one_html($projection_id,'next');
					}
					elseif($action_type=='previous')
					{
						$html = $this->load_projection_step_one_html($projection_id,'next');
					}
					elseif($action_type=='next')
					{
						$new_step = 3;
						$html = '<div class="col-lg-12 col-md-12">
									<div class="contact_message form form-bg">
										<h3>Average product price</h3>
										<form id="contact-form" method="" action="">
											<div class="row mb-4 m-mb-0">
												<div class="offset-md-3 col-md-6">
														<label class="fw-600"> Please enter average price of all your products or services.</label>
														<input type="text" name="average_product_price" id="average_product_price" value="'.$projection_row->average_product_price.'" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency">
												</div>
											</div>
											<div class="col-md-12 row m-0 p-0">
												<div class="col-md-6 col-6 text-left p-0">
													 <button type="button"  onclick="load_user_projection_wizard(\'2\',\''.$projection_id.'\',\'previous\')"> '.$this->lang->line('lang_previous_label').'</button>
												</div>
												<div class="col-md-6 col-6 text-right p-0 form-btns">
													
													<button type="button" onclick="load_user_projection_wizard(\''.$new_step.'\',\''.$projection_id.'\',\'next\')"> '.$this->lang->line('lang_next_label').'</button>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 mt-3">
									<div class="contact_message form form-bg">
										<div class="col-md-12 p-0 text-left">
												<h4 class="theme-color-blue">Note:</h4>
											</div>
										<label>For now, do not worry! Set an average price that seems representative of all the products or services of your company. Later, once you will become familiar with the tool, you can make as many changes as you want.    </label>
										<label>Remember that the Average Price is the sum of all prices of your company divided by the number of products / services of your company. For example, lets say there are 5 pair of shoes for sale in your business at prices of 175 &euro;, 200 &euro;, 250 &euro;, 350 &euro;, and 600 &euro;. The average price would be 315 &euro;. (175 &euro; + 200 &euro; + 250 &euro; + 350 &euro; + 600 &euro;) / 5   </label>
									</div>
								</div>';
					}
				}
			}
		}
		return $html;
	}
	
	private function load_projection_step_three_html($projection_id,$action_type)
	{
		$this->load->model("Projection_m","projection");
		$html = '';
		$new_step = 4;
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			if($projection_id>0)
			{
				$projection_row = $this->projection->get_projection_row($projection_id,$this->session->userdata('MiPlani_user_id'));
				if(!empty($projection_row))
				{
					if($action_type=='save')
					{
 						$html = $this->load_projection_step_two_html($projection_id,'next');
					}
					elseif($action_type=='previous')
					{
						$html = $this->load_projection_step_two_html($projection_id,'next');
					}
					elseif($action_type=='next')
					{
						$new_step = 4;
						$html = '<div class="col-lg-12 col-md-12">
							<div class="contact_message form form-bg" id="expense">
								<h3>Global expenses analysis</h3>
								<form id="contact-form" method="" action="">
									<div class="col-md-12 p-0 text-left">
										<h4 class="theme-color-blue">Operating expenses</h4>
									</div>
									<div class="row">
										<div class=" col-md-6">
												<label class="fw-600">What percentage of your daily income will cover the OPERATING expenses of your business? Insert a value between (1% - 100%).</label>
												<div class="col-md-12 row p-0 mb-3 m-mb-0">
													<div class="col-md-9">
														<input name="operating_expenses" id="operating_expenses" value="'.$projection_row->operating_expenses.'" placeholder="" type="number">
													</div>
													<div class="col-md-3">
														<button class="expense-btn check-btn" type="button"  onclick="get_global_expenses_analysis(\''.base64_encode($projection_row->projection_id).'\',\'operating expenses\');">Calculate</button>
													</div>
												</div>
										</div>
										<div class=" col-md-6" style="display:none" id="operating_expense_cal_data"></div>
									</div>

									<div class="col-md-12 p-0 text-left">
										<h4 class="theme-color-blue">Advertising expenses</h4>
									</div>
									<div class="row">
										<div class=" col-md-6">
												<label class="fw-600">What percentage of your daily income will cover the ADVERTISING expenses of your business? Insert a value between (1% - 100%)</label>
												<div class="col-md-12 row p-0 mb-3 m-mb-0">
													<div class="col-md-9">
													  <input name="advertising_expenses" id="advertising_expenses" value="'.$projection_row->advertising_expenses.'" placeholder="" type="number">
													</div>
													<div class="col-md-3">
														<button class="expense-btn  check-btn" type="button"   onclick="get_global_expenses_analysis(\''.base64_encode($projection_row->projection_id).'\',\'advertising expenses\');">Calculate</button>
													</div>
												</div>
										</div>
										<div class=" col-md-6" style="display:none" id="adv_expense_cal_data"></div>
									</div>

									<div class="col-md-12 p-0 text-left">
										<h4 class="theme-color-blue">Average cost of the product or service sold</h4>
									</div>
									 <div class="row mb-4">
										<div class=" col-md-6">
												<label class="fw-600">What percentage of your daily income corresponds to the COST of your products or services. Insert a value between (1% - 100%)</label>
												<div class="col-md-12 row p-0 mb-3 m-mb-0">
													<div class="col-md-9">
													  <input name="average_product_sold_cost" id="average_product_sold_cost" value="'.$projection_row->average_product_sold_cost.'" placeholder="" type="number">
													</div>
													<div class="col-md-3">
 														<button class="expense-btn  check-btn" type="button"  onclick="get_global_expenses_analysis(\''.base64_encode($projection_row->projection_id).'\',\'average sold cost\');">Calculate</button>
													</div>
												</div>
										</div>
										<div class=" col-md-6" style="display:none" id="cost_of_good_sold_cal_data"></div>
									</div>
									<div class="col-md-12 row m-0 p-0">
										<div class="col-md-6 col-6 text-left p-0">
											 <button type="button"  onclick="load_user_projection_wizard(\'3\',\''.$projection_id.'\',\'previous\')"> '.$this->lang->line('lang_previous_label').'</button>
										</div>
										<div class="col-md-6 col-6 text-right p-0 form-btns">
											  
											  <button type="button" onclick="load_user_projection_wizard(\''.$new_step.'\',\''.$projection_id.'\',\'next\')"> '.$this->lang->line('lang_next_label').'</button>
										</div>
									</div>
								</form>
							</div>
						</div>';
					}
				}
			}
		}
		return $html;
	}
	
	private function load_projection_step_four_html($projection_id,$action_type)
	{
		$this->load->model("Projection_m","projection");
		$html = '';
		$new_step = 5;
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			if($projection_id>0)
			{
				$projection_row = $this->projection->get_projection_row($projection_id,$this->session->userdata('MiPlani_user_id'));
				if(!empty($projection_row))
				{
					if($action_type=='save')
					{
 						$html = $this->load_projection_step_three_html($projection_id,'next');
					}
					elseif($action_type=='previous')
					{
						$html = $this->load_projection_step_three_html($projection_id,'next');
					}
					elseif($action_type=='next')
					{
						$new_step = 5;
						$html = '<div class="col-lg-12 col-md-12">
							<div class="contact_message form form-bg" id="expense">
								<h3>Conversion rate</h3>
								<form id="contact-form" method="" action="">
									<div class="row mb-4">
										<div class="offset-md-3 col-md-6">
												<label>To reach the desired annual financial goal lets see how much qualified traffic and buyers are needed? </label>
												<label class="fw-600">Insert a conversion rate  * (%) (Between 1% - 100%)</label>
											  <div class="col-md-12 row p-0 mb-3 m-mb-0">
												  <div class="col-md-9">
														<input name="conversion_rate" id="conversion_rate" value="'.$projection_row->conversion_rate.'"  placeholder="" type="number">
												  </div>
												  <div class="col-md-3">
													  <button class="expense-btn check-btn" type="button" id="conversion-rate" onclick="get_conversion_rate_calculation(\''.base64_encode($projection_row->projection_id).'\');">Calculate</button>
												  </div>

											  </div>
									   </div>
									</div>
									<div class="row mb-4" style="display:none" id="conversion-rate-div"></div>

									<div class="col-md-12 row m-0 p-0">
										<div class="col-md-6 col-6 text-left p-0">
											 <button type="button"  onclick="load_user_projection_wizard(\'4\',\''.$projection_id.'\',\'previous\')"> '.$this->lang->line('lang_previous_label').'</button>
										</div>
										<div class="col-md-6 col-6 text-right p-0 form-btns">
											  
											  <button type="button" onclick="load_user_projection_wizard(\''.$new_step.'\',\''.$projection_id.'\',\'next\')"> '.$this->lang->line('lang_next_label').'</button>
										</div>
									</div>

								</form>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 mt-3">
							<div class="contact_message form form-bg">
								<div class="col-md-12 p-0 text-left">
										<h4 class="theme-color-blue">Note:</h4>
									</div>
								<label>* The conversion rate here is the % of visitors that  will make a purchase on your website.</label>
							</div>
						</div>';
					}
				}
			}
		}
		return $html;
	}
	
	private function load_projection_step_five_html($projection_id,$action_type)
	{
		$this->load->model("Projection_m","projection");
		$html = '';
		$new_step = 6;
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			if($projection_id>0)
			{
				$projection_row = $this->projection->get_projection_row($projection_id,$this->session->userdata('MiPlani_user_id'));
				if(!empty($projection_row))
				{
					if($action_type=='save')
					{
 						$html = $this->load_projection_step_four_html($projection_id,'next');
					}
					elseif($action_type=='previous')
					{
						$html = $this->load_projection_step_four_html($projection_id,'next');
					}
					elseif($action_type=='next')
					{
						$daily_revenue = round(($projection_row->annual_billing/365));
						$weekly_revenue = round(($projection_row->annual_billing/52));
						$monthly_revenue = round(($projection_row->annual_billing/12));
						$quaterly_revenue = round(($projection_row->annual_billing/4));
						$annual_revenue = $projection_row->annual_billing;
						
 						$new_step = 6;
						$html = '<div class="col-lg-12 col-md-12">
							<div class="contact_message form form-bg">
								<h3>Revenue per period</h3>
								 <label class="fw-600">Total revenue necessary to achieve your desire financial goals listed per period</label>
								<form id="contact-form" method="" action="">
									<div class="row mb-4">
										<div class="col-md-4 mb-2 m-mb-0">
											<label class="fw-600">Daily revenue necessary</label>
												<input name="daily_revenue" id="daily_revenue" value="'.custom_number_format($daily_revenue).' &euro;" class="view-input" readonly style=" border: 1px solid #efefef !important">
										</div>
										<div class="col-md-4">
											<label class="fw-600">Weekly revenue necessary</label>
											<input name="weekly_revenue" id="weekly_revenue" value="'.custom_number_format($weekly_revenue).' &euro;" class="view-input" readonly style=" border: 1px solid #efefef !important">
										</div>
										<div class="col-md-4">
											<label class="fw-600">Monthly revenue necessary</label>
												<input name="monthly_revenue" id="monthly_revenue" value="'.custom_number_format($monthly_revenue).' &euro;" class="view-input" readonly style=" border: 1px solid #efefef !important">
										</div>
										<div class="offset-md-2 col-md-4">
											<label class="fw-600">Quaterly revenue necessary</label>
												<input name="quaterly_revenue" id="quaterly_revenue" value="'.custom_number_format($quaterly_revenue).' &euro;" class="view-input" readonly style=" border: 1px solid #efefef !important">
										</div>
										<div class="col-md-4">
											<label class="fw-600">Annual revenue necessary</label>
												<input name="annual_revenue" id="annual_revenue" value="'.custom_number_format($annual_revenue).' &euro;" class="view-input" readonly style=" border: 1px solid #efefef !important">
										</div>
 									</div>
									<div class="row">

									</div>
									<div class="col-md-12 row m-0 p-0">
										<div class="col-md-6 col-6 text-left p-0">
											<button type="button"  onclick="load_user_projection_wizard(\'5\',\''.$projection_id.'\',\'previous\')"> '.$this->lang->line('lang_previous_label').'</button>
										</div>
										<div class="col-md-6 col-6 text-right p-0 form-btns">
											   
											  <button type="button" onclick="load_user_projection_wizard(\''.$new_step.'\',\''.$projection_id.'\',\'next\')"> '.$this->lang->line('lang_next_label').'</button>
										</div>
									</div>
								</form>
							</div>
						</div>';
					}
				}
			}
		}
		return $html;
	}
	
	private function load_projection_step_six_html($projection_id,$action_type)
	{
		$this->load->model("Projection_m","projection");
		$html = '';
		$new_step = 7;
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			if($projection_id>0)
			{
				$projection_row = $this->projection->get_projection_row($projection_id,$this->session->userdata('MiPlani_user_id'));
				if(!empty($projection_row))
				{
					if($action_type=='save')
					{
 						$html = $this->load_projection_step_five_html($projection_id,'next');
					}
					elseif($action_type=='previous')
					{
						$html = $this->load_projection_step_five_html($projection_id,'next');
					}
					elseif($action_type=='next')
					{
						$new_step = 7;
						$html = '<div class="col-lg-12 col-md-12">
							<div class="contact_message form form-bg">
								<h3>Summary of global expense</h3>
								<form id="contact-form" method="" action="">
									<table id="expenses">
										  <tr>
											<th colspan="2">Section I: Summary of advertising expenses</th>
										  </tr>
										  <tr>
											<td>Annual advertising expense</td>
											<td>'.custom_number_format($projection_row->advertising_annual_expenses).' &euro;</td>
										  </tr>
										  <tr>
											<td>Quarterly advertising expense</td>
											<td>'.custom_number_format($projection_row->advertising_quaterly_expenses).' &euro;</td>
										  </tr>
										  <tr>
											<td>Monthly advertising expense</td>
											<td>'.custom_number_format($projection_row->advertising_monthly_expenses).' &euro;</td>
										  </tr>
										  <tr>
											<td>Weekly advertising expense</td>
											<td>'.custom_number_format($projection_row->advertising_weekly_expenses).' &euro;</td>
										  </tr>
										  <tr>
											<td>Daily advertising expense</td>
											<td>'.custom_number_format($projection_row->advertising_daily_expenses).' &euro;</td>
										  </tr>
									</table>
									<table id="expenses">
										  <tr>
											<th colspan="2">Section II: Summary of operating expenses</th>
										  </tr>
										  <tr>
											<td>Annual operating expenses</td>
											<td>'.custom_number_format($projection_row->operating_annual_expenses).' &euro;</td>
										  </tr>
										  <tr>
											<td>Quarterly operating expenses</td>
											<td>'.custom_number_format($projection_row->operating_quaterly_expenses).' &euro;</td>
										  </tr>
										  <tr>
											<td>Monthly operating expenses</td>
											<td>'.custom_number_format($projection_row->operating_monthly_expenses).' &euro;</td>
										  </tr>
										  <tr>
											<td>Weekly operating expenses</td>
											<td>'.custom_number_format($projection_row->operating_weekly_expenses).' &euro;</td>
										  </tr>
										  <tr>
											<td>Daily operating expenses</td>
											<td>'.custom_number_format($projection_row->operating_daily_expenses).' &euro;</td>
										  </tr>
									</table>
									<table id="expenses">
										  <tr>
											<th colspan="2">Section III:Summary of the cost of products or services sold</th>
										  </tr>
										  <tr>
											<td>Annual cost of products or services sold</td>
											<td>'.custom_number_format($projection_row->annual_product_sold_cost).' &euro;</td>
										  </tr>
										  <tr>
											<td>Quarterly cost of products or services sold</td>
											<td>'.custom_number_format($projection_row->quaterly_product_sold_cost).' &euro;</td>
										  </tr>
										  <tr>
											<td>Monthly cost of products or services sold</td>
											<td>'.custom_number_format($projection_row->monthly_product_sold_cost).' &euro;</td>
										  </tr>
										  <tr>
											<td>Weekly cost of products or services sold</td>
											<td>'.custom_number_format($projection_row->weekly_product_sold_cost).' &euro;</td>
										  </tr>
										  <tr>
											<td>Daily cost of products or services sold</td>
											<td>'.custom_number_format($projection_row->daily_product_sold_cost).' &euro;</td>
										  </tr>
									</table>
									<table id="expenses">
										  <tr>
											<th colspan="2">Section IV: Summary of all expenses</th>
										  </tr>
										  <tr>
											<td>Total annual expenses</td>
											<td>'.custom_number_format($projection_row->total_annual_expenses).' &euro;</td>
										  </tr>
										  <tr>
											<td>Total quarterly expenses</td>
											<td>'.custom_number_format($projection_row->total_quaterly_expenses).' &euro;</td>
										  </tr>
										  <tr>
											<td>Total monthly expenses</td>
											<td>'.custom_number_format($projection_row->total_monthly_expenses).' &euro;</td>
										  </tr>
										  <tr>
											<td>Total weekly expenses</td>
											<td>'.custom_number_format($projection_row->total_weekly_expenses).' &euro;</td>
										  </tr>
										  <tr>
											<td>Total daily expenses</td>
											<td>'.custom_number_format($projection_row->total_daily_expenses).' &euro;</td>
										  </tr>
									</table>
									<div class="row"></div>
									<div class="col-md-12 row m-0 p-0">
										<div class="col-md-6 col-6 text-left p-0">
											 <button type="button"  onclick="load_user_projection_wizard(\'6\',\''.$projection_id.'\',\'previous\')"> '.$this->lang->line('lang_previous_label').'</button>
										</div>
										<div class="col-md-6 col-6 text-right p-0 form-btns">
											  
											  <button type="button" onclick="load_user_projection_wizard(\''.$new_step.'\',\''.$projection_id.'\',\'next\')"> '.$this->lang->line('lang_next_label').'</button>
										</div>
									</div>
								</form>
							</div>
						</div>';
					}
				}
			}
		}
		return $html;
	}
	
	private function load_projection_step_seven_html($projection_id,$action_type)
	{
		$this->load->model("Projection_m","projection");
		$html = '';
		$new_step = 8;
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			if($projection_id>0)
			{
				$projection_row = $this->projection->get_projection_row($projection_id,$this->session->userdata('MiPlani_user_id'));
				if(!empty($projection_row))
				{
					if($action_type=='save')
					{
 						$html = $this->load_projection_step_six_html($projection_id,'next');
					}
					elseif($action_type=='previous')
					{
						$html = $this->load_projection_step_six_html($projection_id,'next');
					}
					elseif($action_type=='next')
					{
						$new_step = 8;
						$annual_profit = 0;
						$monthly_profit = 0;
						$quarterly_profit = 0;
						$weekly_profit = 0;
						$daily_profit = 0;
						$rio = 0;
						if($projection_row->annual_billing>$projection_row->total_annual_expenses)
						{
							$annual_profit = $projection_row->annual_billing-$projection_row->total_annual_expenses;
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
						}
						$html = '<div class="col-lg-12 col-md-12">
							<div class="contact_message form form-bg">
								<h3>Summary of the global analysis of your business</h3>
								<form id="contact-form" method="" action="">
									<table id="expenses">
										  <tr>
											<th colspan="2">Summary of your profits</th>
										  </tr>
										  <tr>
											<td>Here is the annual billing you established that you desired</td>
											<td>'.custom_number_format($projection_row->annual_billing).' &euro;</td>
										  </tr>
										  <tr>
											<td>Total annual expenses (&euro;) found is</td>
											<td>'.custom_number_format($projection_row->total_annual_expenses).' &euro;</td>
										  </tr>
										  <tr>
											<td>Your annual profits is</td>
											<td>'.custom_number_format($annual_profit).' &euro;</td>
										  </tr>
										  <tr>
											<td>Your quarterly profits is</td>
											<td>'.custom_number_format($quarterly_profit).' &euro;</td>
										  </tr>
										  <tr>
											<td>Your monthlhy profits is</td>
											<td>'.custom_number_format($monthly_profit).' &euro;</td>
										  </tr>
										  <tr>
											<td>Your weekly profits is</td>
											<td>'.custom_number_format($weekly_profit).' &euro;</td>
										  </tr>
										  <tr>
											<td>Your daily profits is</td>
											<td>'.custom_number_format($daily_profit).' &euro;</td>
										  </tr>
										  <tr>
											<td>Your ROI (Return on investment) is</td>
											<td>'.custom_number_format($rio).'%</td>
										  </tr>
									</table>
									<div class="row">

									</div>
									<div class="col-md-12 row m-0 p-0">
										<div class="col-md-6 col-6 text-left p-0">
											  <button type="button"  onclick="load_user_projection_wizard(\'7\',\''.$projection_id.'\',\'previous\')"> '.$this->lang->line('lang_previous_label').'</button>
										</div>
										<div class="col-md-6 col-6 text-right p-0 form-btns">
											  
											  <button type="button" onclick="load_user_projection_wizard(\''.$new_step.'\',\''.$projection_id.'\',\'next\')"> '.$this->lang->line('lang_next_label').'</button>
										</div>
									</div>
								</form>
							</div>
						</div>';
					}
				}
			}
		}
		return $html;
	}
	
	private function load_projection_step_eight_html($projection_id,$action_type)
	{
		$this->load->model("Projection_m","projection");
		$html = '';
		$new_step = 9;
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			if($projection_id>0)
			{
				$projection_row = $this->projection->get_projection_row($projection_id,$this->session->userdata('MiPlani_user_id'));
				if(!empty($projection_row))
				{
					if($action_type=='save')
					{
 						$html = $this->load_projection_step_seven_html($projection_id,'next');
					}
					elseif($action_type=='previous')
					{
						$html = $this->load_projection_step_seven_html($projection_id,'next');
					}
					elseif($action_type=='next')
					{
						$new_step = 9;
						
						$annual_qualified_web_traffic_volume = $projection_row->annual_qualified_web_traffic_volume;
						
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
						
						$annual_potential_customer_buy_one_item  = $projection_row->annual_potential_customer_buy_one_item;
						
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
						$html = '<div class="col-lg-12 col-md-12">
							<div class="contact_message form form-bg">
								<h3>Qualified web traffic & number 0f customers needed to achieve the desired financial goals</h3>
								<form id="contact-form" method="" action="">
									<table id="expenses">
										  <tr>
											<th colspan="2">Relevant data to achieve the desired billing</th>
										  </tr>
										  <tr>
											<td>Number of daily qualified visitors needed to your website</td>
											<td>'.custom_number_format($daily_qualified_web_traffic_volume).'</td>
										  </tr>
										  <tr>
											<td>Number of potential customers that must buy  at least one product per day</td>
											<td>'.custom_number_format($daily_potential_customer_buy_one_item).'</td>
										  </tr>
										  <tr>
											<td>Number of weekly qualified visitors needed to your website</td>
											<td>'.custom_number_format($weekly_qualified_web_traffic_volume).'</td>
										  </tr>
										  <tr>
											<td>Number of potential customers that must buy  at least one product per week</td>
											<td>'.custom_number_format($weekly_potential_customer_buy_one_item).'</td>
										  </tr>
										  <tr>
											<td>Number of monthly qualified visitors needed to your website</td>
											<td>'.custom_number_format($monthly_qualified_web_traffic_volume).'</td>
										  </tr>
										  <tr>
											<td>Number of potential customers that must buy  at least one product per month</td>
											<td>'.custom_number_format($monthly_potential_customer_buy_one_item).'</td>
										  </tr>
										  <tr>
											<td>Number of qualified visitors needed to your website quaterly</td>
											<td>'.custom_number_format($quarterly_qualified_web_traffic_volume).'</td>
										  </tr>
										  <tr>
											<td>Number of potential customers that must buy  at least one product quaterly</td>
											<td>'.custom_number_format($quarterly_potential_customer_buy_one_item).'</td>
										  </tr>
										  <tr>
											<td>Number of qualified visitors needed to your website per year</td>
											<td>'.$annual_qualified_web_traffic_volume.'</td>
										  </tr>
										  <tr>
											<td>Number of potential customers that must buy  at least one product per year</td>
											<td>'.custom_number_format($annual_potential_customer_buy_one_item).'</td>
										  </tr>
									</table>
									<div class="row"></div>
									<div class="col-md-12 row m-0 p-0">
										<div class="col-md-6 col-6 text-left p-0">
											 <button type="button"  onclick="load_user_projection_wizard(\'8\',\''.$projection_id.'\',\'previous\')"> '.$this->lang->line('lang_previous_label').'</button>
										</div>
										<div class="col-md-6 col-6 text-right p-0 form-btns">
											  
											  <button type="button" onclick="load_user_projection_wizard(\''.$new_step.'\',\''.$projection_id.'\',\'next\')"> '.$this->lang->line('lang_next_label').'</button>
										</div>
									</div>
								</form>
							</div>
						</div>';
					}
				}
			}
		}
		return $html;
	}
	
	private function load_projection_step_nine_html($projection_id,$action_type)
	{
		$this->load->model("Projection_m","projection");
		$html = '';
		$new_step = 10;
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			if($projection_id>0)
			{
				$projection_row = $this->projection->get_projection_row($projection_id,$this->session->userdata('MiPlani_user_id'));
				if(!empty($projection_row))
				{
					if($action_type=='save')
					{
 						$html = $this->load_projection_step_eight_html($projection_id,'next');
					}
					elseif($action_type=='previous')
					{
						$html = $this->load_projection_step_eight_html($projection_id,'next');
					}
					elseif($action_type=='next')
					{
 						$new_step = 10;
						$annual_profit = 0;
						if($projection_row->annual_billing!=0 && $projection_row->total_annual_expenses!=0)
						{
							$annual_profit = $projection_row->annual_billing-$projection_row->total_annual_expenses;
						}
						$html = '<div class="col-lg-12 col-md-12">
							<div class="contact_message form form-bg" id="expense">
								<h3>Let´s maximize your profit</h3>
								<div class="col-md-12 p-0 text-left">
										<h4 class="theme-color-blue">Scenario 1</h4>
									</div>
								<form id="contact-form" method="" action="">
									<div class="row mb-2">
										<div class="col-md-6 mb-4">
											<div class="scenario-heading col-md-12">
												<h4>Current scenario</h4>
											</div>
											<div class="col-md-12 p-0">
												<label class="fw-600">Total current income</label>
												<input name="" value="'.custom_number_format($projection_row->annual_billing).' &euro;" class="view-input" readonly style=" border: 1px solid #efefef !important">
											</div>
											 <div class="col-md-12 p-0">
												<label class="fw-600">Total expenses per year</label>
												<input name="" value="'.custom_number_format($projection_row->total_annual_expenses).' &euro;" class="view-input" readonly style=" border: 1px solid #efefef !important">
											</div>
											<div class="col-md-12 p-0">
												<label class="fw-600">Annual Profit</label>
												<input name="" value="'.custom_number_format($annual_profit).' &euro;" class="view-input" readonly style=" border: 1px solid #efefef !important">
											</div>
											 <div class="col-md-12 p-0">
												<label class="fw-600">ROI (Return on investment)</label>
												<input name="" value="'.$projection_row->global_analysis_rio.'%" class="view-input" readonly style=" border: 1px solid #efefef !important">
											</div>
										</div>
										<div class="col-md-6">
											<div class="scenario-heading col-md-12">
												<h4>Possible scenario</h4>
											</div>
											<div class="col-md-12 p-0">
												<label class="fw-600">In case of reducing total current expenses. Insert a determind value (1% - 100%)</label>
												<div class="col-md-12 row p-0 m-mb-0">
													<div class="col-md-9">
														<input name="scenario_one_expense" id="scenario_one_expense" value="'.$projection_row->scenario_one_total_expenses_ratio.'" type="number">
													</div>
													<div class="col-md-3">
														   <button class="expense-btn  check-btn" type="button" onclick="get_scenario_one_calculation(\''.base64_encode($projection_row->projection_id).'\');">Calculate</button>
													</div>
												</div>
										   </div>
											<div class="col-md-12 p-0 mb-2" id="scenario-one-data" style="display:none;"></div>
										</div>
									</div>
									 <div class="col-md-12 p-0 text-left"><h4 class="theme-color-blue">Scenario 2</h4></div>
									 <div class="row">
										<div class="col-md-6 mb-4">
											<div class="scenario-heading col-md-12">
												<h4>Current scenario</h4>
											</div>
											<div class="col-md-12 p-0">
												<label class="fw-600">When the conversion rate is</label>
												<input name="" value="'.$projection_row->conversion_rate.'%" class="view-input" readonly style=" border: 1px solid #efefef !important">
											</div>
											 <div class="col-md-12 p-0">
												<label class="fw-600">Annual total revenue is</label>
												<input name="" value="'.custom_number_format($projection_row->annual_billing).' &euro;" class="view-input" readonly style=" border: 1px solid #efefef !important">
											</div>
											<div class="col-md-12 p-0">
												<label class="fw-600">Total annual expenses is equal to</label>
												<input name="" value="'.custom_number_format($projection_row->total_annual_expenses).' &euro;" class="view-input" readonly style=" border: 1px solid #efefef !important">
											</div>
											<div class="col-md-12 p-0">
												<label class="fw-600">The profit is</label>
												<input name="" value="'.custom_number_format($projection_row->global_analysis_annual_profit).' &euro;" class="view-input" readonly style=" border: 1px solid #efefef !important">
											</div>
											 <div class="col-md-12 p-0">
												<label class="fw-600">ROI (Return on investment)</label>
												<input name="" value="'.$projection_row->global_analysis_rio.'%" class="view-input" readonly style=" border: 1px solid #efefef !important">
											</div>
										</div>
										<div class="col-md-6">
											<div class="scenario-heading col-md-12">
												<h4>Possible scenario</h4>
											</div>
											<div class="col-md-12 p-0">
												<label class="fw-600">If the conversion could change to</label>
												<div class="col-md-12 row p-0 m-mb-0">
													<div class="col-md-9">
														<input name="scenario_two_conversion" id="scenario_two_conversion" value="'.$projection_row->scenario_two_conversion.'" type="number">
													</div>
													<div class="col-md-3">
														   <button class="expense-btn check-btn" type="button" onclick="get_scenario_two_calculation(\''.base64_encode($projection_row->projection_id).'\');">Calculate</button>
													</div>
												</div>
										   </div>
											<div class="col-md-12 p-0 mb-2" id="scenario-two-data" style="display:none"></div>
										</div>
									</div>
									<div class="col-md-12 p-0 text-left">
										<h4 class="theme-color-blue">Scenario 3</h4>
										</div>
									 <div class="row mb-2">
										<div class="col-md-6 mb-4">
											<div class="scenario-heading col-md-12">
												<h4>Current scenario</h4>
											</div>
											<div class="col-md-12 p-0">
												<label class="fw-600">Total income is</label>
												<input name="" value="'.custom_number_format($projection_row->annual_billing).' &euro;" class="view-input" readonly style=" border: 1px solid #efefef !important">
											</div>
											 <div class="col-md-12 p-0">
												<label class="fw-600">Actual number of customers in your database is</label>
												<input name="" value="'.custom_number_format($projection_row->annual_potential_customer_buy_one_item).'" class="view-input" readonly style=" border: 1px solid #efefef !important">
											</div>
											 <div class="col-md-12 p-0">
												<label class="fw-600">ROI (Return on investment)</label>
												<input name="" value="'.$projection_row->global_analysis_rio.'%" class="view-input" readonly style=" border: 1px solid #efefef !important">
											</div>
										</div>
										<div class="col-md-6">
											<div class="scenario-heading col-md-12">
												<h4>Possible scenario</h4>
											</div>
											<div class="col-md-12 p-0 mb-2">
												<label class="fw-600">Insert the percentage of current customers who could buy an additional product or contract an additional service</label>
												<div class="col-md-12 row p-0 m-mb-0">
													<div class="col-md-9">
														<input name="additional_product_buyer_ratio" id="additional_product_buyer_ratio" value="'.$projection_row->scenario_three_product_buyer_ratio.'" type="number">
													</div>
													<div class="col-md-3">
														   <button class="expense-btn check-btn" type="button" onclick="get_additional_product_buyer_ratio_calculation(\''.base64_encode($projection_row->projection_id).'\');">Calculate</button>
													</div>
												</div>
										   </div>
											<div class="col-md-12 p-0 mb-2" id="additional-product-buyer-ration-data" style="display:none;"></div>
											<div class="col-md-12 p-0">
												<label class="fw-600">What would be the price of the additional product / service</label>
												<div class="col-md-12 row p-0 m-mb-0">
													<div class="col-md-9">
														<input name="additional_product_price" id="additional_product_price" value="'.$projection_row->scenario_three_additional_product_price.'" type="number">
													</div>
													<div class="col-md-3">
													   <button class="expense-btn check-btn" type="button" onclick="get_additional_product_price_calculation(\''.base64_encode($projection_row->projection_id).'\');">Calculate</button>
													</div>
												</div>
										   </div>
										   <div class="col-md-12 p-0 mb-2" id="additional-product-price-data" style="display:none;"></div>
										   <div class="col-md-12 p-0">
												<label class="fw-600">Insert the percentage of current customers who could buy another additional product or contract an additional service</label>
												<div class="col-md-12 row p-0 mb-2">
													<div class="col-md-9">
														<input name="multiple_product_buyer_ratio" id="multiple_product_buyer_ratio" value="'.$projection_row->scenario_multiple_product_buyer_ratio.'" type="number">
													</div>
													<div class="col-md-3">
														   <button class="expense-btn check-btn" type="button" onclick="get_multiple_product_buyer_ratio_calculation(\''.base64_encode($projection_row->projection_id).'\');">Calculate</button>
													</div>
												</div>
										   </div>
											<div class="col-md-12 p-0 mb-2" id="multiple-product-buyer-ratio-data" style="display:none">
 											</div>
											 <div class="col-md-12 p-0">
												<label class="fw-600">What would be the price of that additional product / service  </label>
												<div class="col-md-12 row p-0 m-mb-0">
													<div class="col-md-9">
														<input name="multiple_product_price" id="multiple_product_price" value="'.$projection_row->scenario_multiple_product_price.'" type="number">
													</div>
													<div class="col-md-3">
														  <button class="expense-btn check-btn" type="button" onclick="get_multiple_product_price_calculation(\''.base64_encode($projection_row->projection_id).'\');">Calculate</button>
													</div>
												</div>
										   </div>
										   <div class="col-md-12 p-0 mb-2" id="multiple-product-price-data" style="display:none;"></div>
 										</div>
									</div>
									<div class="col-md-12 row m-0 p-0">
										<div class="col-md-6 col-6 text-left p-0">
											  <button type="button"  onclick="load_user_projection_wizard(\'9\',\''.$projection_id.'\',\'previous\')"> '.$this->lang->line('lang_previous_label').'</button>
										</div>
										<div class="col-md-6 col-6 text-right p-0 form-btns">
										   
										  <button type="button" onclick="load_user_projection_wizard(\''.$new_step.'\',\''.$projection_id.'\',\'next\')"> '.$this->lang->line('lang_next_label').'</button>
										</div>
									</div>
								</form>
							</div>
						</div>';
					}
				}
			}
		}
		return $html;
	}
	private function load_projection_step_ten_html($projection_id,$action_type)
	{
		$this->load->model("Projection_m","projection");
		$html = '';
		$new_step = 11;
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			if($projection_id>0)
			{
				$projection_row = $this->projection->get_projection_row($projection_id,$this->session->userdata('MiPlani_user_id'));
				if(!empty($projection_row))
				{
					if($action_type=='save')
					{
 						$html = $this->load_projection_step_nine_html($projection_id,'next');
					}
					elseif($action_type=='previous')
					{
						$html = $this->load_projection_step_nine_html($projection_id,'next');
					}
					elseif($action_type=='next')
					{
						$daily_benefits = $projection_row->daily_revenue-$projection_row->total_daily_expenses;
						$weekly_benefits = $projection_row->weekly_revenue-$projection_row->total_weekly_expenses;
						$monthly_benefits = $projection_row->monthly_revenue-$projection_row->total_monthly_expenses;
						$quaterly_benefits = $projection_row->quaterly_revenue-$projection_row->total_quaterly_expenses;
						$annual_benefits = $projection_row->annual_revenue-$projection_row->total_annual_expenses;
						$roi = 0;
						$roi_monetary = 0;
						if($annual_benefits!=0 && $projection_row->total_annual_expenses!=0)
						{
							$roi = number_format((($annual_benefits/$projection_row->total_annual_expenses) *100), 4, '.', '');
							$roi_monetary = number_format(((($annual_benefits/$projection_row->total_annual_expenses) *100)*$projection_row->total_annual_expenses), 4, '.', '');	
						}
  						$new_step = 11;
						$html = '<div class="col-lg-12 col-md-12">
							<div class="contact_message form form-bg">
								<h3>Summary</h3>
								<form id="contact-form" method="" action="">
									<table id="expenses">
										  <tr>
											<th colspan="2">Project summary</th>
										  </tr>
										  <tr>
											<td>Your established financial goal</td>
											<td>'.custom_number_format($projection_row->annual_billing).' &euro;</td>
										  </tr>
										  <tr>
											<td>Your established average price for the products / services to be sold</td>
											<td>'.custom_number_format($projection_row->average_product_price).' &euro;</td>
										  </tr>
									</table>
									<div class="row">
										<div class="col-md-6">
											<table id="expenses">
											  <tr>
												<th colspan="2">Ideal revenue to reach your desired financial goal</th>
											  </tr>
											  <tr>
												<td>Daily revenue</td>
												<td>'.custom_number_format($projection_row->daily_revenue).' &euro;</td>
											  </tr>
											  <tr>
												<td>Weekly revenue</td>
												<td>'.custom_number_format($projection_row->weekly_revenue).' &euro;</td>
											  </tr>
											  <tr>
												<td>Monthly revenue</td>
												<td>'.custom_number_format($projection_row->monthly_revenue).' &euro;</td>
											  </tr>
											  <tr>
												<td>Quarterly revenue</td>
												<td>'.custom_number_format($projection_row->quaterly_revenue).' &euro;</td>
											  </tr>
											  <tr>
												<td>Annual revenue</td>
												<td>'.custom_number_format($projection_row->annual_revenue).' &euro;</td>
											  </tr>
											</table>
										</div>
										<div class="col-md-6">
											<table id="expenses">
											  <tr>
												<th colspan="2">Profits earned</th>
											  </tr>
											  <tr>
												<td>Daily benefits</td>
												<td>'.custom_number_format(round($daily_benefits)).' &euro;</td>
											  </tr>
											  <tr>
												<td>Weekly benefits</td>
												<td>'.custom_number_format(round($weekly_benefits)).' &euro;</td>
											  </tr>
											  <tr>
												<td>Monthly benefits</td>
												<td>'.custom_number_format(round($monthly_benefits)).' &euro;</td>
											  </tr>
											  <tr>
												<td>Quarterly benefits</td>
												<td>'.custom_number_format(round($quaterly_benefits)).' &euro;</td>
											  </tr>
											  <tr>
												<td>Annual benefits</td>
												<td>'.custom_number_format(round($annual_benefits)).' &euro;</td>
											  </tr>
											</table>
										</div>
									</div>
									<div class="col-dm-12">
										 <table id="expenses">
											  <tr>
												<th colspan="2">General expenses &euro;</th>
											  </tr>
											  <tr>
												<td>Total expenses / day</td>
												<td>'.custom_number_format($projection_row->total_daily_expenses).' &euro;</td>
											  </tr>
											  <tr>
												<td>Total expenses / week</td>
												<td>'.custom_number_format($projection_row->total_weekly_expenses).' &euro;</td>
											  </tr>
											  <tr>
												<td>Total expenses / month</td>
												<td>'.custom_number_format($projection_row->total_monthly_expenses).' &euro;</td>
											  </tr>
											  <tr>
												<td>Total expenses / quarter</td>
												<td>'.custom_number_format($projection_row->total_quaterly_expenses).' &euro;</td>
											  </tr>
											  <tr>
												<td>Total expenses / year</td>
												<td>'.custom_number_format($projection_row->total_annual_expenses).' &euro;</td>
											  </tr>
											  <tr>
												<td>ROI (Return on investment)</td>
												<td>'.custom_number_format(round($roi)).'%</td>
											  </tr>
											  <tr>
												<td>ROI (Monetary value)</td>
												<td>'.custom_number_format(round($roi_monetary)).' &euro;</td>
											  </tr>
										</table>
									</div>
									<div class="col-dm-12">
										 <table id="expenses">
											  <tr>
												<td>Your established conversion rate</td>
												<td>'.$projection_row->conversion_rate.' %</td>
											  </tr>
										</table>
									</div>
									<div class="row">
										<div class="col-md-6">
											<table id="expenses">
											  <tr>
												<th colspan="2">Qualified web traffic needed</th>
											  </tr>
											  <tr>
												<td>Qualified daily traffic</td>
												<td>'.custom_number_format($projection_row->daily_qualified_web_traffic_volume).'</td>
											  </tr>
											  <tr>
												<td>Qualified weekly traffic</td>
												<td>'.custom_number_format($projection_row->weekly_qualified_web_traffic_volume).'</td>
											  </tr>
											  <tr>
												<td>Qualified monthly traffic</td>
												<td>'.custom_number_format($projection_row->monthly_qualified_web_traffic_volume).'</td>
											  </tr>
											  <tr>
												<td>Qualified quarterly traffic</td>
												<td>'.custom_number_format($projection_row->quarterly_qualified_web_traffic_volume).'</td>
											  </tr>
											  <tr>
												<td>Qualified annual traffic</td>
												<td>'.custom_number_format($projection_row->annual_qualified_web_traffic_volume).'</td>
											  </tr>
											</table>
										</div>
										<div class="col-md-6">
											<table id="expenses">
											  <tr>
												<th colspan="2">Number Of paying customers needed</th>
											  </tr>
											  <tr>
												<td>Number of daily clients required</td>
												<td>'.custom_number_format($projection_row->daily_potential_customer_buy_one_item).'</td>
											  </tr>
											  <tr>
												<td>Number of weekly clients required</td>
												<td>'.custom_number_format($projection_row->weekly_potential_customer_buy_one_item).'</td>
											  </tr>
											  <tr>
												<td>Number of monthly clients required</td>
												<td>'.custom_number_format($projection_row->monthly_potential_customer_buy_one_item).'</td>
											  </tr>
											  <tr>
												<td>Number of quarterly clients required</td>
												<td>'.custom_number_format($projection_row->quarterly_potential_customer_buy_one_item).'</td>
											  </tr>
											  <tr>
												<td>Number of annual clients required</td>
												<td>'.custom_number_format($projection_row->annual_potential_customer_buy_one_item).'</td>
											  </tr>
											</table>
										</div>
									</div>
									<div class="col-md-12 row m-0 p-0">
										<div class="col-md-6 col-6 text-left p-0">
											 <button type="button"  onclick="load_user_projection_wizard(\'10\',\''.$projection_id.'\',\'previous\')"> '.$this->lang->line('lang_previous_label').'</button>
										</div>
										<div class="col-md-6 col-6 text-right p-0 form-btns">
											 
										  	<button type="button" onclick="load_user_projection_wizard(\''.$new_step.'\',\''.$projection_id.'\',\'next\')"> '.$this->lang->line('lang_next_label').'</button>
										</div>
									</div>
								</form>
							</div>
						</div>';
					}
				}
			}
		}
		return $html;
	}
	public function load_projection_step_eleven_html($projection_id,$action_type)
	{
		$this->load->model("Projection_m","projection");
		$html = '';
 		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$new_step = 12;
			if($projection_id>0)
			{
				$projection_row = $this->projection->get_projection_row($projection_id,$this->session->userdata('MiPlani_user_id'));
				if(!empty($projection_row))
				{
					if($action_type=='save')
					{
 						$html = $this->load_projection_step_ten_html($projection_id,'next');
					}
					elseif($action_type=='previous')
					{
						$html = $this->load_projection_step_ten_html($projection_id,'next');
					}
					elseif($action_type=='next')
					{
 						$currency_usd_selected = '';
						$currency_gbp_selected = '';
						$currency_eur_selected = '';
						if($projection_row->currency=='USD')
						{
							$currency_usd_selected = 'selected';
						}
						elseif($projection_row->currency=='GBP')
						{
							$currency_gbp_selected = 'selected';
						}
						elseif($projection_row->currency=='EUR')
						{
							$currency_eur_selected = 'selected';
						}
						$new_step = 12;
						$social_media_path = 'pages/ShareProjectionSocialMedia';
						$invite_friend_path = 'pages/InviteProjectionFriend';
						$download_projection_path = base_url('pages/DownloadProjection?key_id='.base64_encode($projection_id));
						$rate_app_path = base_url('reviews/Add');
 						$html .= '<div class="col-md-12">
									<div class="success">
										<span class="float-right"><i class="fa fa-times" aria-hidden="true"></i></span>The projection is saved successfully.
									</div>
								</div>';
							$html .= '<div class="col-lg-12 col-md-12">
									<div class="contact_message form form-bg">
										<div class="row mt-3 mb-3">
											<div class="col-md-12 text-right">
												<a href="'.$rate_app_path.'" target="_blank" class="color-blue fw-600">Rate this app</a>
											</div>
											<div class="offset-md-2 col-md-10 text-center last-step-btns">
												<a href="'.$download_projection_path.'" target="_blank"><button type="button" class="dark-btn"> <i class="fa fa-download" aria-hidden="true"></i> Download</button></a>
												<button type="button" class="save-btn" onclick="load_user_projection_wizard(\''.$new_step.'\',\''.$projection_id.'\',\'save\')"> <i class="fa fa-save" aria-hidden="true"></i> Save</button>
												<a href="javascript:;" onclick="call_url_key_modal(\''.$social_media_path.'\',\''.base64_encode($projection_id).'\');"><button type="button" class="save-btn"><i class="fa fa-share" aria-hidden="true" ></i> Share</button></a>
												<a href="javascript:;" onclick="call_url_key_modal(\''.$invite_friend_path.'\',\''.base64_encode($projection_id).'\');"><button type="button" class="check-btn"> <i class="fa fa-user-plus" aria-hidden="true"></i> Invite </button></a>
												<select id="currency" name="currency" class="form-control">
													<option value="">Select currency</option>
													<option value="USD" '.$currency_usd_selected.'>&dollar; - USD</option>
													<option value="GBP" '.$currency_gbp_selected.'>&pound; - GBP</option>
													<option value="EUR" '.$currency_eur_selected.'>&euro; - EUR</option>
												</select>
											</div>
										</div>
										<div class="col-md-12 row m-0 p-0">
											<div class="col-md-6 col-6 text-left p-0">
												<button type="button"  onclick="load_user_projection_wizard(\'11\',\''.$projection_id.'\',\'previous\')"> '.$this->lang->line('lang_previous_label').'</button>
											</div>
											<div class="col-md-6 col-6 text-right p-0">
												<button type="button" onclick="load_user_projection_wizard(\''.$new_step.'\',\''.$projection_id.'\',\'submit\')"> '.$this->lang->line('lang_submit_label').'</button>
											</div>
										</div>
									</div>
								</div>';
					}
				}
			}
		}
		return $html;
	}
	public function load_projection_step_twelve_html($projection_id,$action_type)
	{
		$this->load->model("Projection_m","projection");
		$html = '';
 		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			if($projection_id>0)
			{
				$projection_row = $this->projection->get_projection_row($projection_id,$this->session->userdata('MiPlani_user_id'));
				if(!empty($projection_row))
				{
					if($action_type=='save')
					{
 						$html = $this->load_projection_step_eleven_html($projection_id,'next');
					}
					elseif($action_type=='previous')
					{
						$html = $this->load_projection_step_eleven_html($projection_id,'next');
					}
					elseif($action_type=='submit')
					{ 
						$html = 'completed';
					}
				}
			}
		}
		return $html;
	}
	public function EditProjection()
	{
		$header_data = array('page_title' => 'Edit Projection');
		$this->load->model("Users_m","users");
		$this->load->model("Projection_m","projection");
		$data['error_message'] ='';
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$data['user_row'] = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(!empty($data['user_row']))
			{
				if(!empty($_GET['key_id']))
				{
					$projection_id = base64_decode($this->input->get('key_id', TRUE));
					$data['row'] = $this->projection->get_projection_row($projection_id,$this->session->userdata('MiPlani_user_id'));
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
    	load_web_main_template('edit_projection_v', $header_data,$data);
	}
	public function CopyProjection()
	{
 		$this->load->model("Users_m","users");
		$this->load->model("Projection_m","projection");
 		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$user_row = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
			if(!empty($user_row))
			{
				if(!empty($_POST['pid']))
				{
					$projection_id = base64_decode($this->input->post('pid', TRUE));
					$row = $this->projection->get_projection_row($projection_id,$this->session->userdata('MiPlani_user_id'));
					if(!empty($row))
					{
						$this->projection->CopyProjection($projection_id);
						echo 'Projection copied successfully!';
					}
					else
					{
						echo 'Please select valid record';
					}
				}
				else
				{
					echo 'Please select valid record';
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
}
