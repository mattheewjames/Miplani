<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CommonProjection extends MY_Web_Controller 
{
	public function DreamProjectionValidation()
	{
		$html = '';
		$form_data = array();
		if($this->input->server('REQUEST_METHOD')=='POST')
		{
			$this->load->model("Dream_projection_m","projection");
			$this->load->model("Users_m","users");
			if(!empty($this->session->userdata('MiPlani_user_id')))
			{
				$user_row = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
				if(!empty($user_row))
				{
 					if(!empty($_POST['type']))
					{
						$type = base64_decode($_POST['type']);
						if(in_array($type,array('Yearly', '6 Months', '3 Months')))
						{
							if(!empty($_POST['form_data']))
							{
								$form_array = parse_str($_POST['form_data'], $form_data);
							}
							$annual_billing  = ''; 
							$achieve_goal_year = '';
							$average_product_price  = '';
							$operating_expenses  = '';
							$advertising_expenses  = '';
							$average_product_sold_cost  = ''; 
							$conversion_rate  = ''; 
							
							if($type=='Yearly')
							{
								if(!empty($form_data['achieve_goal_year']))
								{
									$achieve_goal_year = $form_data['achieve_goal_year'];
								}
							}
							else
							{
								$achieve_goal_year = 1;
							}
							if(!empty($form_data['annual_billing']))
							{
								$annual_billing = $form_data['annual_billing'];
								$annual_billing = str_replace(".","",$annual_billing);
								$annual_billing = intval($annual_billing);
							}
							if(!empty($form_data['average_product_price']))
							{
								$average_product_price = $form_data['average_product_price'];
								$average_product_price = str_replace(".","",$average_product_price);
								$average_product_price = intval($average_product_price);
							}
							if(!empty($form_data['operating_expenses']))
							{
								$operating_expenses = $form_data['operating_expenses'];
							}
							if(!empty($form_data['advertising_expenses']))
							{
								$advertising_expenses = $form_data['advertising_expenses'];
							}
							if(!empty($form_data['average_product_sold_cost']))
							{
								$average_product_sold_cost = $form_data['average_product_sold_cost'];
							}
							if(!empty($form_data['conversion_rate']))
							{
								$conversion_rate = $form_data['conversion_rate'];
							}
						}
						else
						{
							echo json_encode(array("response_code"=>'404',"response_message"=>'We are sorry, You are not allowed to access this page',"html"=>''));
							exit;
						}
					}
					else
					{
						echo json_encode(array("response_code"=>'404',"response_message"=>'We are sorry, You are not allowed to access this page',"html"=>''));
						exit;
					}
					if(empty($annual_billing) || !is_numeric($annual_billing))
					{
						echo json_encode(array("response_code"=>'404',"response_message"=>'Please enter valid financial goal',"html"=>''));
						exit;
					}
					elseif($annual_billing>30000 && $user_row->current_subscription_type=='Free')
					{
						echo json_encode(array("response_code"=>'404',"response_message"=>'For the Free Plan, the maximum financial goal SHOULD NOT exceed 30,000 €',"html"=>''));
						exit;
					}
					elseif(empty($achieve_goal_year) || !is_numeric($achieve_goal_year))
					{
						echo json_encode(array("response_code"=>'404',"response_message"=>'Please enter valid number of years to acheive goal',"html"=>''));
						exit;
					}
					elseif(empty($average_product_price) || !is_numeric($average_product_price))
					{
						echo json_encode(array("response_code"=>'404',"response_message"=>'Please enter valid Average price of your products or services',"html"=>''));
						exit;
					}
					elseif(empty($operating_expenses) || ($operating_expenses<1 || $operating_expenses>100))
					{
						echo json_encode(array("response_code"=>'404',"response_message"=>'Please enter valid operating expenses value between 1-100',"html"=>''));
						exit;
					}
					elseif(empty($conversion_rate) || ($conversion_rate<1 || $conversion_rate>100))
					{
						echo json_encode(array("response_code"=>'404',"response_message"=>'Please enter valid conversion rate value between 1-100',"html"=>''));
						exit;
					}
					elseif(empty($average_product_sold_cost) || ($average_product_sold_cost<1 || $average_product_sold_cost>100))
					{
						echo json_encode(array("response_code"=>'404',"response_message"=>'Please enter valid cost of the products / services value between 1-100',"html"=>''));
						exit;
					}
					elseif(empty($advertising_expenses) || ($advertising_expenses<1 || $advertising_expenses>100))
					{
						echo json_encode(array("response_code"=>'404',"response_message"=>'Please enter valid advertising expenses value between 1-100',"html"=>''));
						exit;
					}
					else
					{
						$this->projection->save_dream_financial_goal($type);
						if($type=='Yearly')
						{
							$html = base_url('dreamProjection');
						}
						elseif($type=='6 Months')
						{
							$html = base_url('dreamProjection/Biannual');
						}
						elseif($type=='3 Months')
						{
							$html = base_url('dreamProjection/Quarterly');
						}
						echo json_encode(array("response_code"=>'200',"response_message"=>'',"html"=> $html));
					}
				}
				else
				{
					 echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_sign_in_to_continue_error'),"html"=>''));exit;
				}
			}
			else
			{
				echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_sign_in_to_continue_error'),"html"=>''));exit;
			}
		}
	}
	public function DreamProjectionUpdateValidation()
	{
		$projection_id = '';
		$html = '';
		$form_data = array();
		if($this->input->server('REQUEST_METHOD')=='POST')
		{
			$this->load->model("Dream_projection_m","projection");
			$this->load->model("Users_m","users");
			if(!empty($this->session->userdata('MiPlani_user_id')))
			{
				$user_row = $this->users->get_active_user_row($this->session->userdata('MiPlani_user_id'));
				if(!empty($user_row))
				{
 					if(!empty($_POST['type']))
					{
						$type = base64_decode($_POST['type']);
						if(in_array($type,array('Yearly', '6 Months', '3 Months')))
						{
							if(!empty($_POST['form_data']))
							{
								$form_array = parse_str($_POST['form_data'], $form_data);
							}
							
							$annual_billing  = ''; 
							$achieve_goal_year = '';
							$average_product_price  = '';
							$operating_expenses  = '';
							$advertising_expenses  = '';
							$average_product_sold_cost  = ''; 
							$conversion_rate  = ''; 
							
							if(!empty($form_data['pid']))
							{
								$projection_id = base64_decode($form_data['pid']);
							}
							if($projection_id>0)
							{
								$row = $this->projection->get_projection_row($projection_id,$this->session->userdata('MiPlani_user_id'));
								if(!empty($row))
								{
									if($row->projection_type!=$type)
									{
										echo json_encode(array("response_code"=>'404',"response_message"=>'Please select valid record',"html"=>''));
										exit;
									}
								}
								else
								{
									echo json_encode(array("response_code"=>'404',"response_message"=>'Please select valid record',"html"=>''));
									exit;
								}
							}
							else
							{
								echo json_encode(array("response_code"=>'404',"response_message"=>'Please select valid record',"html"=>''));
								exit;
							}
							
							
							if($type=='Yearly')
							{
								if(!empty($form_data['achieve_goal_year']))
								{
									$achieve_goal_year = $form_data['achieve_goal_year'];
								}
							}
							else
							{
								$achieve_goal_year = 1;
							}
							if(!empty($form_data['annual_billing']))
							{
								$annual_billing = $form_data['annual_billing'];
								$annual_billing = str_replace(".","",$annual_billing);
								$annual_billing = intval($annual_billing);
							}
							if(!empty($form_data['average_product_price']))
							{
								$average_product_price = $form_data['average_product_price'];
								$average_product_price = str_replace(".","",$average_product_price);
								$average_product_price = intval($average_product_price);
							}
							if(!empty($form_data['operating_expenses']))
							{
								$operating_expenses = $form_data['operating_expenses'];
							}
							if(!empty($form_data['advertising_expenses']))
							{
								$advertising_expenses = $form_data['advertising_expenses'];
							}
							if(!empty($form_data['average_product_sold_cost']))
							{
								$average_product_sold_cost = $form_data['average_product_sold_cost'];
							}
							if(!empty($form_data['conversion_rate']))
							{
								$conversion_rate = $form_data['conversion_rate'];
							}
						}
						else
						{
							echo json_encode(array("response_code"=>'404',"response_message"=>'We are sorry, You are not allowed to access this page',"html"=>''));
							exit;
						}
					}
					else
					{
						echo json_encode(array("response_code"=>'404',"response_message"=>'We are sorry, You are not allowed to access this page',"html"=>''));
						exit;
					}
					if(empty($annual_billing) || !is_numeric($annual_billing))
					{
						echo json_encode(array("response_code"=>'404',"response_message"=>'Please enter valid financial goal',"html"=>''));
						exit;
					}
					elseif($annual_billing>30000 && $user_row->current_subscription_type=='Free')
					{
						echo json_encode(array("response_code"=>'404',"response_message"=>'For the Free Plan, the maximum financial goal SHOULD NOT exceed 30,000 €',"html"=>''));
						exit;
					}
					elseif(empty($achieve_goal_year) || !is_numeric($achieve_goal_year))
					{
						echo json_encode(array("response_code"=>'404',"response_message"=>'Please enter valid number of years to acheive goal',"html"=>''));
						exit;
					}
					elseif(empty($average_product_price) || !is_numeric($average_product_price))
					{
						echo json_encode(array("response_code"=>'404',"response_message"=>'Please enter valid Average price of your products or services',"html"=>''));
						exit;
					}
					elseif(empty($operating_expenses) || ($operating_expenses<1 || $operating_expenses>100))
					{
						echo json_encode(array("response_code"=>'404',"response_message"=>'Please enter valid operating expenses value between 1-100',"html"=>''));
						exit;
					}
					elseif(empty($conversion_rate) || ($conversion_rate<1 || $conversion_rate>100))
					{
						echo json_encode(array("response_code"=>'404',"response_message"=>'Please enter valid conversion rate value between 1-100',"html"=>''));
						exit;
					}
					elseif(empty($average_product_sold_cost) || ($average_product_sold_cost<1 || $average_product_sold_cost>100))
					{
						echo json_encode(array("response_code"=>'404',"response_message"=>'Please enter valid cost of the products / services value between 1-100',"html"=>''));
						exit;
					}
					elseif(empty($advertising_expenses) || ($advertising_expenses<1 || $advertising_expenses>100))
					{
						echo json_encode(array("response_code"=>'404',"response_message"=>'Please enter valid advertising expenses value between 1-100',"html"=>''));
						exit;
					}
					else
					{
						$this->projection->update_dream_financial_goal($type);
						if($type=='Yearly')
						{
							$html = base_url('dreamProjection');
						}
						elseif($type=='6 Months')
						{
							$html = base_url('dreamProjection/Biannual');
						}
						elseif($type=='3 Months')
						{
							$html = base_url('dreamProjection/Quarterly');
						}
						echo json_encode(array("response_code"=>'200',"response_message"=>'',"html"=> $html));
					}
				}
				else
				{
					 echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_sign_in_to_continue_error'),"html"=>''));exit;
				}
			}
			else
			{
				echo json_encode(array("response_code"=>'404',"response_message"=>$this->lang->line('lang_sign_in_to_continue_error'),"html"=>''));exit;
			}
		}
	}
	public function GuestDreamProjectionValidation()
	{
 		$projection_id = '';
		$html = '';
		$form_data = array();
		if($this->input->server('REQUEST_METHOD')=='POST')
		{
			$this->load->model("Dream_projection_m","projection");
			$this->load->model("Users_m","users");
			if(!empty($_POST['id']))
			{
				$key_url = $this->input->post('id', TRUE);
				$invite_row = $this->users->get_invite_projection_row($key_url);
				if(!empty($invite_row))
				{
					if($invite_row->projection_type=='dream' && in_array($invite_row->permission,array('all','update')))
					{
						$row = $this->projection->get_guest_projection_details($invite_row->projection_id,$key_url);
						if(!empty($row))
						{
							$user_row = $this->users->get_active_user_row($row->user_id);
							if(!empty($user_row))
							{
								if(!empty($_POST['type']))
								{
									$type = base64_decode($_POST['type']);
									if(in_array($type,array('Yearly', '6 Months', '3 Months')))
									{
										if(!empty($_POST['form_data']))
										{
											$form_array = parse_str($_POST['form_data'], $form_data);
										}

										$annual_billing  = ''; 
										$achieve_goal_year = '';
										$average_product_price  = '';
										$operating_expenses  = '';
										$advertising_expenses  = '';
										$average_product_sold_cost  = ''; 
										$conversion_rate  = ''; 

										if(!empty($form_data['pid']))
										{
											$projection_id = base64_decode($form_data['pid']);
										}
										if($row->projection_type!=$type)
										{
											echo json_encode(array("response_code"=>'404',"response_message"=>'Please select valid record',"html"=>''));
											exit;
										} 
										if($type=='Yearly')
										{
											if(!empty($form_data['achieve_goal_year']))
											{
												$achieve_goal_year = $form_data['achieve_goal_year'];
											}
										}
										else
										{
											$achieve_goal_year = 1;
										}
										if(!empty($form_data['annual_billing']))
										{
											$annual_billing = $form_data['annual_billing'];
											$annual_billing = str_replace(".","",$annual_billing);
											$annual_billing = intval($annual_billing);
										}
										if(!empty($form_data['average_product_price']))
										{
											$average_product_price = $form_data['average_product_price'];
											$average_product_price = str_replace(".","",$average_product_price);
											$average_product_price = intval($average_product_price);
										}
										if(!empty($form_data['operating_expenses']))
										{
											$operating_expenses = $form_data['operating_expenses'];
										}
										if(!empty($form_data['advertising_expenses']))
										{
											$advertising_expenses = $form_data['advertising_expenses'];
										}
										if(!empty($form_data['average_product_sold_cost']))
										{
											$average_product_sold_cost = $form_data['average_product_sold_cost'];
										}
										if(!empty($form_data['conversion_rate']))
										{
											$conversion_rate = $form_data['conversion_rate'];
										}
									}
									else
									{
										echo json_encode(array("response_code"=>'404',"response_message"=>'We are sorry, You are not allowed to access this page',"html"=>''));
										exit;
									}
								}
								else
								{
									echo json_encode(array("response_code"=>'404',"response_message"=>'We are sorry, You are not allowed to access this page',"html"=>''));
									exit;
								}
								if(empty($annual_billing) || !is_numeric($annual_billing))
								{
									echo json_encode(array("response_code"=>'404',"response_message"=>'Please enter valid financial goal',"html"=>''));
									exit;
								}
								elseif($annual_billing>30000 && $user_row->current_subscription_type=='Free')
								{
									echo json_encode(array("response_code"=>'404',"response_message"=>'For the Free Plan, the maximum financial goal SHOULD NOT exceed 30,000 €',"html"=>''));
									exit;
								}
								elseif(empty($achieve_goal_year) || !is_numeric($achieve_goal_year))
								{
									echo json_encode(array("response_code"=>'404',"response_message"=>'Please enter valid number of years to acheive goal',"html"=>''));
									exit;
								}
								elseif(empty($average_product_price) || !is_numeric($average_product_price))
								{
									echo json_encode(array("response_code"=>'404',"response_message"=>'Please enter valid Average price of your products or services',"html"=>''));
									exit;
								}
								elseif(empty($operating_expenses) || ($operating_expenses<1 || $operating_expenses>100))
								{
									echo json_encode(array("response_code"=>'404',"response_message"=>'Please enter valid operating expenses value between 1-100',"html"=>''));
									exit;
								}
								elseif(empty($conversion_rate) || ($conversion_rate<1 || $conversion_rate>100))
								{
									echo json_encode(array("response_code"=>'404',"response_message"=>'Please enter valid conversion rate value between 1-100',"html"=>''));
									exit;
								}
								elseif(empty($average_product_sold_cost) || ($average_product_sold_cost<1 || $average_product_sold_cost>100))
								{
									echo json_encode(array("response_code"=>'404',"response_message"=>'Please enter valid cost of the products / services value between 1-100',"html"=>''));
									exit;
								}
								elseif(empty($advertising_expenses) || ($advertising_expenses<1 || $advertising_expenses>100))
								{
									echo json_encode(array("response_code"=>'404',"response_message"=>'Please enter valid advertising expenses value between 1-100',"html"=>''));
									exit;
								}
								else
								{
									$this->projection->update_guest_dream_financial_goal($key_url);
									$url = base_url('commonProjection/GuestProjection?key='.$key_url); 
									echo json_encode(array("response_code"=>'200',"response_message"=>'',"html"=> $url));
								}
							}
							else
							{
								echo json_encode(array("response_code"=>'404',"response_message"=>'Please select valid record',"html"=>''));exit;
							}
						}
						else
						{
							echo json_encode(array("response_code"=>'404',"response_message"=>'Please select valid record',"html"=>''));exit;
						}
					}
					else
					{
						echo json_encode(array("response_code"=>'404',"response_message"=>'Please select valid record',"html"=>''));exit;
					}
 				
				}
				else
				{
					 echo json_encode(array("response_code"=>'404',"response_message"=>'Please select valid record',"html"=>''));exit;
				}
			}
			else
			{
				echo json_encode(array("response_code"=>'404',"response_message"=>'Please select valid record',"html"=>''));exit;
			}
		}
	}
	public function DreamProjectionCalculation()
	{
		$this->load->model("Users_m","users");
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$this->DreamProjectionHTML($this->session->userdata('MiPlani_user_id'));
		}
		else
		{
			echo json_encode(array("response_code"=>'404',"response_message"=>'We are sorry, you are trying inalid access',"html"=>''));
			exit;
		}
	}
	
	public function DreamGuestProjectionCalculation()
	{
		$this->load->model("Users_m","users");
		$this->load->model("Dream_projection_m","projection"); 
		if(!empty($_POST['id']))
		{
			$key_url = $this->input->post('id', TRUE);
			$invite_row = $this->users->get_invite_projection_row($key_url);
			if(!empty($invite_row))
			{
				if($invite_row->projection_type=='dream')
				{
					$row = $this->projection->get_guest_projection_details($invite_row->projection_id,$key_url);
					if(!empty($row))
					{
						$this->DreamProjectionHTML($row->user_id);
					}
					else
					{
						echo json_encode(array("response_code"=>'404',"response_message"=>'We are sorry, you are trying inalid access',"html"=>''));
						exit;
					}
				}
				else
				{
					echo json_encode(array("response_code"=>'404',"response_message"=>'We are sorry, you are trying inalid access',"html"=>''));
					exit;
				}
			}
			else
			{
				echo json_encode(array("response_code"=>'404',"response_message"=>'We are sorry, you are trying inalid access',"html"=>''));
				exit;
			}
		}
		else
		{
			echo json_encode(array("response_code"=>'404',"response_message"=>'We are sorry, you are trying inalid access',"html"=>''));
			exit;
		}
	}
	public function DreamProjectionHTML($user_id)
	{
		$this->load->model("Users_m","users");
		$this->load->model("Dream_projection_m","projection");
		$user_row = $this->users->get_active_user_row($user_id);
		$response_message = '';
		$html = '';
		$response_code = 404;
		
		$possible_type_values = array('Yearly','6 Months','3 Months');
		
		$annual_billing  = ''; 
		$achieve_goal_year = '';
		$average_product_price  = '';
		$operating_expenses  = '';
		$advertising_expenses  = '';
		$average_product_sold_cost  = ''; 
		$conversion_rate  = ''; 
		$type = '';
		
		if(!empty($_POST['type']))
		{
			$type  = base64_decode($_POST['type']);
 		}
		
 		if(!empty($_POST['annual_billing']))
		{
			$annual_billing  = $_POST['annual_billing'];
			$annual_billing = str_replace(".","",$annual_billing);
			$annual_billing = intval($annual_billing);
		}
		if($type=='Yearly')
		{
			if(!empty($_POST['achieve_goal_year']))
			{
				$achieve_goal_year  = $_POST['achieve_goal_year'];
			}
		}
		else
		{
			$achieve_goal_year = 1;
		}
		if(!empty($_POST['average_product_price']))
		{
			$average_product_price  = $_POST['average_product_price'];
			$average_product_price = str_replace(".","",$average_product_price);
			$average_product_price = intval($average_product_price);
		}
		if(!empty($_POST['operating_expenses']))
		{
			$operating_expenses  = $_POST['operating_expenses'];
		}
		if(!empty($_POST['advertising_expenses']))
		{
			$advertising_expenses  = $_POST['advertising_expenses'];
		}
		
		if(!empty($_POST['average_product_sold_cost']))
		{
			$average_product_sold_cost  = $_POST['average_product_sold_cost'];
		}
		
		if(!empty($_POST['conversion_rate']))
		{
			$conversion_rate  = $_POST['conversion_rate'];
		}
		if(empty($user_row))
		{
			$response_message = 'We are sorry, you are trying inalid access';
		}
 		if(!in_array($type,$possible_type_values) || $type=='')
		{
			echo json_encode(array("response_code"=>$response_code,"response_message"=>'We are sorry, you are trying inalid access',"html"=>$html));exit;
		}
		elseif(empty($annual_billing) || !is_numeric($annual_billing))
		{
 			$response_message = 'Please enter valid financial goal';
		}
		elseif($_POST['annual_billing']>30000 && $user_row->current_subscription_type=='Free')
		{
			$response_message =  'For the Free Plan, the maximum financial goal SHOULD NOT exceed 30,000 €.';
		}
		elseif(empty($achieve_goal_year) || !is_numeric($achieve_goal_year))
		{
 			$response_message = 'Please enter valid number of years to acheive goal';
		}
		elseif(empty($average_product_price) || !is_numeric($average_product_price))
		{
 			$response_message = 'Please enter valid Average price of your products or services';
		}
		elseif(empty($operating_expenses) || ($operating_expenses<1 || $operating_expenses>100))
		{
			$response_message = 'Please enter valid operating expenses value between 1-100';
		}
		elseif(empty($conversion_rate) || ($conversion_rate<1 || $conversion_rate>100))
		{
 			$response_message = 'Please enter valid conversion rate value between 1-100';
		}
		elseif(empty($average_product_sold_cost) || ($average_product_sold_cost<1 || $average_product_sold_cost>100))
		{
 			$response_message = 'Please enter valid cost of the products / services between 1-100';
		}
		elseif(empty($advertising_expenses) || ($advertising_expenses<1 || $advertising_expenses>100))
		{
 			$response_message = 'Please enter valid advertising expenses value between 1-100';
		}
		
		if(empty($response_message))
		{
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
				if($type=='3 Months')
				{
					$main_days= 122;
					$main_weeks = 17.428;
					$main_monthly = 4;
					$main_quarterly = 1;
				}
				elseif($type=='6 Months')
				{
					$main_days= 182.5;
					$main_weeks = 26;
					$main_monthly = 6;
					$main_quarterly = 2;
				}
				
				if($type=='Yearly')
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
					if($type=='year')
					{
						$semesterly_product_sold = number_format(($yearly_product_sold/2), 4, '.', '');
					}
					else
					{
						$semesterly_product_sold = $quartley_product_sold*2;
					}
				}
				if($yearly_product_sold!=0  && $average_product_price!=0)
				{
					$yearly_revenue = number_format($yearly_product_sold*$average_product_price, 4, '.', '');
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
				
				if($semesterly_product_sold!=0  && $average_product_price!=0)
				{
					if($type=='Yearly')
					{
						$semesterly_revenue = number_format($semesterly_product_sold*$average_product_price, 4, '.', '');
					}
					else
					{
						$semesterly_revenue = $quartley_revenue*2;
					}
				}

 				if($type=='Yearly')
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
					
					$semesterly_operating_expenses = number_format(($quartley_operating_expenses*2), 4, '.', '');
					$semesterly_cost_of_products = number_format(($quartley_cost_of_products*2), 4, '.', '');
					$semesterly_advertising_expenses = number_format(($quartley_advertising_expenses*2), 4, '.', '');
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
					if($type=='Yearly')
					{
						$semesterly_benefits = number_format(($yearly_benefits/2), 4, '.', '');
					}
					else
					{
						$semesterly_benefits = $semesterly_revenue-$semesterly_total_expenses;
					}
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

				if($type=='Yearly')
				{
					$semesterly_benefits = number_format(($yearly_benefits/2), 4, '.', '');
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
 					$quartley_traffic_volume = number_format((($first_traffic_value/$main_quarterly)/$crp), 4, '.', '');
					$monthly_traffic_volume = number_format((($first_traffic_value/$main_monthly)/$crp), 4, '.', '');
					$weekly_traffic_volume = number_format((($first_traffic_value/$main_weeks)/$crp), 4, '.', '');
					$daily_traffic_volume = number_format((($first_traffic_value/($main_days))/$crp), 4, '.', '');
					$semesterly_traffic_volume = number_format(($quartley_traffic_volume*2), 4, '.', '');
 				}


				$yearly_website_buyer_visitor = number_format($yearly_traffic_volume*$crp, 4, '.', '');
 				$quartley_website_buyer_visitor = number_format($quartley_traffic_volume*$crp, 4, '.', '');
				$monthly_website_buyer_visitor = number_format($monthly_traffic_volume*$crp, 4, '.', '');
				$weekly_website_buyer_visitor = number_format($weekly_traffic_volume*$crp, 4, '.', '');
				$daily_website_buyer_visitor = number_format($daily_traffic_volume*$crp, 4, '.', '');
				if(!empty($yearly_website_buyer_visitor) && $yearly_website_buyer_visitor!=0)
				{
					if($type=='Yearly')
					{
						$semesterly_website_buyer_visitor = number_format(($yearly_website_buyer_visitor/2), 4, '.', '');
					}
					else
					{
						$semesterly_website_buyer_visitor = number_format(($quartley_website_buyer_visitor*2), 4, '.', '');
					}
				}
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
  				
			$html .= '<div class="col-md-12 table-responsive">
						<table id="goals">
						  <tr>
							  <th></th>
							  <th>Day</th>
							  <th>Week</th>
							  <th>Monthly</th>
							  <th>Quarterly</th>';
							  // $html .= '<th>Semester</th>';	
							  if($type=='Yearly')
							  {
 								  $html .= '<th>Yearly</th>';
							  }
						  	
						  $html .= '</tr>';
 						  $html .= '<tr>
							<td>Total number of products to be sold</td>
							<td>'.custom_number_format(round($daily_product_sold)).'</td>
							<td>'.custom_number_format(round($weekly_product_sold)).'</td>
							<td>'.custom_number_format(round($monthly_product_sold)).'</td>
							<td>'.custom_number_format(round($quartley_product_sold)).'</td>';
			                // $html .= "<td>".custom_number_format(round($semesterly_product_sold))."</td>";
							if($type=='Yearly')
							{
 								$html .= "<td>".custom_number_format(round($yearly_product_sold))."</td>";
							}
 						   $html .= '</tr>';
 						   $html .= '<tr>
							<td>Total revenue</td>
							<td>'.custom_number_format(round($daily_revenue)).' &euro;</td>
							<td>'.custom_number_format(round($weekly_revenue)).' &euro;</td>
							<td>'.custom_number_format(round($monthly_revenue)).' &euro;</td>
							<td>'.custom_number_format(round($quartley_revenue)).' &euro;</td>';
			                // $html .= "<td>".custom_number_format(round($semesterly_revenue))." &euro;</td>";
							if($type=='Yearly')
							{
 								$html .= "<td>".custom_number_format(round($yearly_revenue))." &euro;</td>";
							}
			               
						   $html .= '</tr>';
 						   $html .= '<tr>
							<td>Advertising expenses</td>
							<td>'.custom_number_format(round($daily_advertising_expenses)).' &euro;</td>
							<td>'.custom_number_format(round($weekly_advertising_expenses)).' &euro;</td>
							<td>'.custom_number_format(round($monthly_advertising_expenses)).' &euro;</td>
							<td>'.custom_number_format(round($quartley_advertising_expenses)).' &euro;</td>';
			                // $html .= "<td>".custom_number_format(round($semesterly_advertising_expenses))." &euro;</td>";
							if($type=='Yearly')
							{
								$html .= "<td>".custom_number_format(round($yearly_advertising_expenses))." &euro;</td>";
							}
			             
						 $html .= '</tr>';
 						 $html .= '<tr>
							<td>Operating Expenses</td>
							<td>'.custom_number_format(round($daily_operating_expenses)).' &euro;</td>
							<td>'.custom_number_format(round($weekly_operating_expenses)).' &euro;</td>
							<td>'.custom_number_format(round($monthly_operating_expenses)).' &euro;</td>
							<td>'.custom_number_format(round($quartley_operating_expenses)).' &euro;</td>';
			                // $html .= "<td>".custom_number_format(round($semesterly_operating_expenses))." &euro;</td>";
						  	if($type=='Yearly')
							{
								$html .= "<td>".custom_number_format(round($yearly_operating_expenses))." &euro;</td>";
							}
			              
						  $html .= '</tr>';
 						  $html .= '<tr>
							<td>Cost of products / services</td>
							<td>'.custom_number_format(round($daily_cost_of_products)).' &euro;</td>
							<td>'.custom_number_format(round($weekly_cost_of_products)).' &euro;</td>
							<td>'.custom_number_format(round($monthly_cost_of_products)).' &euro;</td>
							<td>'.custom_number_format(round($quartley_cost_of_products)).' &euro;</td>';
							// $html .= "<td>".custom_number_format(round($semesterly_cost_of_products))." &euro;</td>";
						  	if($type=='Yearly')
							{
 								$html .= "<td>".custom_number_format(round($yearly_cost_of_products))." &euro;</td>";
							}
			               
						  $html .= '</tr>';
 						  $html .= '<tr>
							<td>Total expenses</td>
							<td>'.custom_number_format(round($daily_total_expenses)).' &euro;</td>
							<td>'.custom_number_format(round($weekly_total_expenses)).' &euro;</td>
							<td>'.custom_number_format(round($monthly_total_expenses)).' &euro;</td>
							<td>'.custom_number_format(round($quartley_total_expenses)).' &euro;</td>';
							// $html .= "<td>".custom_number_format(round($semesterly_total_expenses))." &euro;</td>";
						  	if($type=='Yearly')
							{
 								$html .= "<td>".custom_number_format(round($yearly_total_expenses))." &euro;</td>";
							}
			              
						  $html .= '</tr>';
 						  $html .= '<tr>
						  	<td>Benefits</td>
							<td>'.custom_number_format(round($daily_benefits)).' &euro;</td>
							<td>'.custom_number_format(round($weekly_benefits)).' &euro;</td>
							<td>'.custom_number_format(round($monthly_benefits)).' &euro;</td>
							<td>'.custom_number_format(round($quartley_benefits)).' &euro;</td>';
							// $html .= "<td>".custom_number_format(round($semesterly_benefits))." &euro;</td>";
						  	if($type=='Yearly')
							{
 								$html .= "<td>".custom_number_format(round($yearly_benefits))." &euro;</td>";
							}
			              
						  $html .= '</tr>';
 						  $html .= '<tr>
							<td>Qualified traffic volume to the website</td>
							<td>'.custom_number_format(round($daily_traffic_volume)).'</td>
							<td>'.custom_number_format(round($weekly_traffic_volume)).'</td>
							<td>'.custom_number_format(round($monthly_traffic_volume)).'</td>
							<td>'.custom_number_format(round($quartley_traffic_volume)).'</td>';
							// $html .= "<td>".custom_number_format(round($semesterly_traffic_volume))."</td>";
						    if($type=='Yearly')
							{
 								$html .= "<td>".custom_number_format(round($yearly_traffic_volume))."</td>";
							}
			              
						  $html .= '</tr>';
 						  $html .= '<tr>
							<td>Volume of web visitors that you should buy at least one product</td>
							<td>'.custom_number_format(round($daily_website_buyer_visitor)).'</td>
							<td>'.custom_number_format(round($weekly_website_buyer_visitor)).'</td>
							<td>'.custom_number_format(round($monthly_website_buyer_visitor)).'</td>
							<td>'.custom_number_format(round($quartley_website_buyer_visitor)).'</td>';
			                // $html .= "<td>".custom_number_format(round($semesterly_website_buyer_visitor))."</td>";
						    if($type=='Yearly')
							{
 								$html .= "<td>".custom_number_format(round($yearly_website_buyer_visitor))."</td>";
							}
			              
						  $html .= '</tr>';
 						  $html .= '<tr>
							<td>Benefits per customers</td>
							<td>'.custom_number_format(round($benefit_per_customer)).' &euro;</td>
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
					</div>';
			$response_code = 200;
		}
  		echo json_encode(array("response_code"=>$response_code,"response_message"=>$response_message,"html"=>$html));
	}
	
	public function ViewDreamProjection()
	{
		$header_data = array('page_title' => 'View Projection');
		$this->load->model("Dream_projection_m","projection");
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
   		load_web_main_template('view_dream_projection_v', $header_data,$data);
	}
	
	public function DownloadDreamProjection()
	{
		$html = '';
		$this->load->model("Dream_projection_m","projection");
		$this->load->helper('download');
		$this->load->helper('file');
 		if(!empty($_GET['key_id']))
		{
			$peojection_id = base64_decode($this->input->get('key_id', TRUE));
			$row = $this->projection->get_projection_details($peojection_id);
			if(!empty($row))
			{
				$this->load->library('pdf');
				//check and create folder
				$upload_folder = FCPATH.'uploads';
				$projection_folder = FCPATH.'uploads/DreamProjections';
				if(!file_exists($upload_folder)) 
				{
					mkdir($upload_folder, 0777, true);
				}
				if(!file_exists($projection_folder)) 
				{
					mkdir($projection_folder, 0777, true);
				}
				
				$upload_file_name = $row->projection_id.".pdf";
				$pdf_file_path = $projection_folder."/".$upload_file_name;
				$annual_billing  = $row->annual_billing; 
				$achieve_goal_year = $row->achieve_goal_year; 
				$average_product_price  = $row->average_product_price; 
				$operating_expenses  = $row->operating_expenses; 
				$advertising_expenses  = $row->advertising_expenses; 
				$average_product_sold_cost = $row->average_product_sold_cost; 
				$conversion_rate  = $row->conversion_rate; 
				$projection_type = $row->projection_type; 

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
					if($projection_type=='6 Months')
					{
						$main_days= 182.5;
						$main_weeks = 26;
						$main_monthly = 6;
						$main_quarterly = 2;
					}
					elseif($projection_type=='3 Months')
					{
						$main_days= 122;
						$main_weeks = 17.428;
						$main_monthly = 4;
						$main_quarterly = 1;
					}
					if($projection_type=='Yearly' && $achieve_goal_year>1)
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

					if($projection_type=='Yearly' && $achieve_goal_year>1)
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
						$semesterly_benefits = $semesterly_revenue-$semesterly_total_expenses;
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


					if($projection_type=='Yearly' && $achieve_goal_year>1)
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
		
				$html .= '<div class="col-md-12 table-responsive" id="projection-contents">
							<table id="goals">
							  <tr>
								  <th></th>
								  <th>Day</th>
								  <th>Week</th>
								  <th>Monthly</th>
								  <th>Quarterly</th>';
								  $html .= '<th>Semester</th>';	
								  if($projection_type=='Yearly')
								  {
									  $html .= '<th>Yearly</th>';
								  }

							  $html .= '</tr>';
							  $html .= '<tr>
								<td>Total number of products to be sold</td>
								<td>'.custom_number_format(round($daily_product_sold)).'</td>
								<td>'.custom_number_format(round($weekly_product_sold)).'</td>
								<td>'.custom_number_format(round($monthly_product_sold)).'</td>
								<td>'.custom_number_format(round($quartley_product_sold)).'</td>';
								$html .= "<td>".custom_number_format(round($semesterly_product_sold))."</td>";
								if($projection_type=='Yearly')
								{
									$html .= "<td>".custom_number_format(round($yearly_product_sold))."</td>";
								}
							   $html .= '</tr>';
							   $html .= '<tr>
								<td>Total revenue</td>
								<td>'.custom_number_format(round($daily_revenue)).' &euro;</td>
								<td>'.custom_number_format(round($weekly_revenue)).' &euro;</td>
								<td>'.custom_number_format(round($monthly_revenue)).' &euro;</td>
								<td>'.custom_number_format(round($quartley_revenue)).' &euro;</td>';
								$html .= "<td>".custom_number_format(round($semesterly_revenue))." &euro;</td>";
								if($projection_type=='Yearly')
								{
									$html .= "<td>".custom_number_format(round($yearly_revenue))." &euro;</td>";
								}

							   $html .= '</tr>';
							   $html .= '<tr>
								<td>Advertising expenses</td>
								<td>'.custom_number_format(round($daily_advertising_expenses)).' &euro;</td>
								<td>'.custom_number_format(round($weekly_advertising_expenses)).' &euro;</td>
								<td>'.custom_number_format(round($monthly_advertising_expenses)).' &euro;</td>
								<td>'.custom_number_format(round($quartley_advertising_expenses)).' &euro;</td>';
								$html .= "<td>".custom_number_format(round($semesterly_advertising_expenses))." &euro;</td>";
								if($projection_type=='Yearly')
								{
									$html .= "<td>".custom_number_format(round($yearly_advertising_expenses))." &euro;</td>";
								}

							 $html .= '</tr>';
							 $html .= '<tr>
								<td>Operating Expenses</td>
								<td>'.custom_number_format(round($daily_operating_expenses)).' &euro;</td>
								<td>'.custom_number_format(round($weekly_operating_expenses)).' &euro;</td>
								<td>'.custom_number_format(round($monthly_operating_expenses)).' &euro;</td>
								<td>'.custom_number_format(round($quartley_operating_expenses)).' &euro;</td>';
								$html .= "<td>".custom_number_format(round($semesterly_operating_expenses))." &euro;</td>";
								if($projection_type=='Yearly')
								{
									$html .= "<td>".custom_number_format(round($yearly_operating_expenses))." &euro;</td>";
								}

							  $html .= '</tr>';
							  $html .= '<tr>
								<td>Cost of products / services</td>
								<td>'.custom_number_format(round($daily_cost_of_products)).' &euro;</td>
								<td>'.custom_number_format(round($weekly_cost_of_products)).' &euro;</td>
								<td>'.custom_number_format(round($monthly_cost_of_products)).' &euro;</td>
								<td>'.custom_number_format(round($quartley_cost_of_products)).' &euro;</td>';
								$html .= "<td>".custom_number_format(round($semesterly_cost_of_products))." &euro;</td>";
								if($projection_type=='Yearly')
								{
									$html .= "<td>".custom_number_format(round($yearly_cost_of_products))." &euro;</td>";
								}

							  $html .= '</tr>';
							  $html .= '<tr>
								<td>Total expenses</td>
								<td>'.custom_number_format(round($daily_total_expenses)).' &euro;</td>
								<td>'.custom_number_format(round($weekly_total_expenses)).' &euro;</td>
								<td>'.custom_number_format(round($monthly_total_expenses)).' &euro;</td>
								<td>'.custom_number_format(round($quartley_total_expenses)).' &euro;</td>';
								$html .= "<td>".custom_number_format(round($semesterly_total_expenses))." &euro;</td>";
								if($projection_type=='Yearly')
								{
									$html .= "<td>".custom_number_format(round($yearly_total_expenses))." &euro;</td>";
								}

							  $html .= '</tr>';
							  $html .= '<tr>
								<td>Benefits</td>
								<td>'.custom_number_format(round($daily_benefits)).' &euro;</td>
								<td>'.custom_number_format(round($weekly_benefits)).' &euro;</td>
								<td>'.custom_number_format(round($monthly_benefits)).' &euro;</td>
								<td>'.custom_number_format(round($quartley_benefits)).' &euro;</td>';
								$html .= "<td>".custom_number_format(round($semesterly_benefits))." &euro;</td>";
								if($projection_type=='Yearly')
								{
									$html .= "<td>".custom_number_format(round($yearly_benefits))." &euro;</td>";
								}

							  $html .= '</tr>';
							  $html .= '<tr>
								<td>Qualified traffic volume to the website</td>
								<td>'.custom_number_format(round($daily_traffic_volume)).'</td>
								<td>'.custom_number_format(round($weekly_traffic_volume)).'</td>
								<td>'.custom_number_format(round($monthly_traffic_volume)).'</td>
								<td>'.custom_number_format(round($quartley_traffic_volume)).'</td>';
								$html .= "<td>".custom_number_format(round($semesterly_traffic_volume))."</td>";
								if($projection_type=='Yearly')
								{
									$html .= "<td>".custom_number_format(round($yearly_traffic_volume))."</td>";
								}

							  $html .= '</tr>';
							  $html .= '<tr>
								<td>Volume of web visitors that you should buy at least one product</td>
								<td>'.custom_number_format(round($daily_website_buyer_visitor)).'</td>
								<td>'.custom_number_format(round($weekly_website_buyer_visitor)).'</td>
								<td>'.custom_number_format(round($monthly_website_buyer_visitor)).'</td>
								<td>'.custom_number_format(round($quartley_website_buyer_visitor)).'</td>';
								$html .= "<td>".custom_number_format(round($semesterly_website_buyer_visitor))."</td>";
								if($projection_type=='Yearly')
								{
									$html .= "<td>".custom_number_format(round($yearly_website_buyer_visitor))."</td>";
								}

							  $html .= '</tr>';
							  $html .= '<tr>
								<td>Benefits for customers</td>
								<td>'.custom_number_format(round($benefit_per_customer)).' &euro;</td>
							  </tr>
							  <tr>
								<td>ROI (Return on investment)</td>
								<td>'.round($roi).'%</td>
							  </tr>
							  <tr>
								<td>ROI (Monetary value)</td>
								<td>'.custom_number_format(round($roi_monetary)).' &euro;</td>
							  </tr>
							</table>
						</div>';
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
	public function InviteDreamProjectionFriend()
	{
		$data['error_message'] ='';
		$data['page_title'] = 'Invite Friend';
 		$this->load->model("Users_m","users");
		$this->load->model("Dream_projection_m","projection");
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
    	$this->load->view("invite_dream_projection_friend_v",$data);
	}
	
	public function GuestProjection()
	{
		$header_data = array('page_title' => 'Projection');
		$data['error_message'] = '';
		$this->load->model("Users_m","users");
		$this->load->model("Dream_projection_m","projection");
		if(!empty($_GET['key']))
		{
			$key_url = $this->input->get('key', TRUE);
			$data['invite_row'] = $this->users->get_invite_projection_row($key_url);
			if(!empty($data['invite_row']))
			{
				if($data['invite_row']->projection_type=='dream')
				{
					$data['row'] = $this->projection->get_guest_projection_details($data['invite_row']->projection_id,$key_url);
					if(!empty($data['row']))
					{
						
					}
					else
					{
						$data['error_message'] = 'We are sorry, this projection is not available';
					}
				}
				else
				{
					$data['error_message'] = 'We are sorry, this projection is not available';
				}
			}
			else
			{
				$data['error_message'] = 'We are sorry, this projection is not available';
			}
		}
		else
		{
			$data['error_message'] = 'We are sorry, this projection is not available';
		}
		load_web_main_template('guest_dream_projections_v', $header_data,$data);
	}
}
