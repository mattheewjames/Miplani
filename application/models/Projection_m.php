<?php
class Projection_m extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
	public function save_projection()
	{
		$form_data = array();
		if(!empty($_POST['form_data']))
		{
			$form_array = parse_str($_POST['form_data'], $form_data);
		}
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			if($this->input->post('form_pid')==0 && $this->input->post('form_step')==1)
			{
				$add_array = array(
					'user_id'  => $this->session->userdata('MiPlani_user_id'),
					'projection_name'  => $form_data['projection_name'],
					'completed_step'  => '1',
					'projection_status'  => 'draft',
					'add_date' => time()
				);
				$this->db->set($add_array);
				$this->db->insert('tbl_projections');
				return $this->db->insert_id();
			}
			else
			{
				if($this->input->post('form_pid')>0)
				{
					$projection_row = $this->get_projection_row($this->input->post('form_pid'),$this->session->userdata('MiPlani_user_id'));
					if(!empty($projection_row))
					{
						$step_number = $projection_row->completed_step;
						if($step_number>0)
						{
							if($step_number>$this->input->post('form_step'))
							{
								$step_number = $step_number;
							}
							else
							{
								$step_number = $this->input->post('form_step');
							}
						}
						else
						{
							$step_number = $this->input->post('form_step');
						}
						if($this->input->post('form_step')==1 && ($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next'))
						{
							$save_array = array(
								'projection_name'  => $form_data['projection_name'],
								'completed_step'  => $step_number,
								'update_date' => time()
							);
							$this->db->set($save_array);
							$this->db->where('user_id', $this->session->userdata('MiPlani_user_id'));
							$this->db->where('projection_id', $this->input->post('form_pid'));
							$this->db->update('tbl_projections');
							return $projection_row->projection_id;
						}
						elseif($this->input->post('form_step')==2 && ($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next'))
						{
							$annual_billing = $form_data['annual_billing'];
							$annual_billing = str_replace(".","",$annual_billing);
							$annual_billing = intval($annual_billing);
							$save_array = array(
								'annual_billing'  => $annual_billing,
								'completed_step'  => $step_number,
								'update_date' => time()
							);
							$this->db->set($save_array);
							$this->db->where('user_id', $this->session->userdata('MiPlani_user_id'));
							$this->db->where('projection_id', $this->input->post('form_pid'));
							$this->db->update('tbl_projections');
							return $projection_row->projection_id;
						}
						elseif($this->input->post('form_step')==3 && ($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next'))
						{
 							$average_product_price = $form_data['average_product_price'];
							$average_product_price = str_replace(".","",$average_product_price);
							$average_product_price = intval($average_product_price);
 							$save_array = array(
								'average_product_price'  => $average_product_price,
								'completed_step'  => $step_number,
								'update_date' => time()
							);
							$this->db->set($save_array);
							$this->db->where('user_id', $this->session->userdata('MiPlani_user_id'));
							$this->db->where('projection_id', $this->input->post('form_pid'));
							$this->db->update('tbl_projections');
							return $projection_row->projection_id;
						}
						elseif($this->input->post('form_step')==4 && ($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next'))
						{
							$operating_calculation_annual_expenses = 0;
							$operating_annual_expenses = 0;
							$operating_quaterly_expenses = 0;
							$operating_monthly_expenses = 0;
							$operating_weekly_expenses = 0;
							$operating_daily_expenses = 0;
							$operating_expenses_percentage = 1;
							
							$advertising_calculation_annual_expenses = 0;
							$advertising_annual_expenses = 0;
							$advertising_quaterly_expenses = 0;
							$advertising_monthly_expenses = 0;
							$advertising_weekly_expenses = 0;
							$advertising_daily_expenses = 0;
							$advertising_expenses_percentage = 1;
							
							$annual_calculation_product_sold_cost = 0;
							$annual_product_sold_cost = 0;
							$quaterly_product_sold_cost = 0;
							$monthly_product_sold_cost = 0;
							$weekly_product_sold_cost = 0;
							$daily_product_sold_cost = 0;
							$average_product_sold_cost_percentage = 1;
							
							if(!empty($form_data['operating_expenses']))
							{
								if($form_data['operating_expenses']!=0)
								{
									$operating_expenses_percentage = $form_data['operating_expenses']/100;
									$operating_expenses_percentage = number_format($operating_expenses_percentage, 2, '.', '');
								}
							}
							if(!empty($form_data['advertising_expenses']))
							{
								if($form_data['advertising_expenses']!=0)
								{
									$advertising_expenses_percentage = $form_data['advertising_expenses']/100;
									$advertising_expenses_percentage = number_format($advertising_expenses_percentage, 2, '.', '');
								}
							}
							if(!empty($form_data['average_product_sold_cost']))
							{
								if($form_data['average_product_sold_cost']!=0)
								{
									$average_product_sold_cost_percentage = $form_data['average_product_sold_cost']/100;
									$average_product_sold_cost_percentage = number_format($average_product_sold_cost_percentage, 2, '.', '');
								}
							}
							// Operating Expense
							if($operating_expenses_percentage!=0)
							{
								$operating_annual_expenses = $projection_row->annual_billing*$operating_expenses_percentage;
								$operating_annual_expenses = number_format($operating_annual_expenses, 2, '.', '');
								$operating_calculation_annual_expenses = round($operating_annual_expenses,3);
							}
							
							if($operating_calculation_annual_expenses!=0)
							{
								$operating_annual_expenses = round($operating_annual_expenses);
								
								$operating_quaterly_expenses = $operating_calculation_annual_expenses/4;
								$operating_quaterly_expenses = number_format($operating_quaterly_expenses, 2, '.', '');
								$operating_quaterly_expenses = round($operating_quaterly_expenses);
								
								$operating_monthly_expenses = $operating_calculation_annual_expenses/12;
								$operating_monthly_expenses = number_format($operating_monthly_expenses, 2, '.', '');
								$operating_monthly_expenses = round($operating_monthly_expenses);
								
								$operating_weekly_expenses = $operating_calculation_annual_expenses/52;
								$operating_weekly_expenses = number_format($operating_weekly_expenses, 2, '.', '');
								$operating_weekly_expenses = round($operating_weekly_expenses);
								
								
								$operating_daily_expenses = $operating_calculation_annual_expenses/365;
								$operating_daily_expenses = number_format($operating_daily_expenses, 2, '.', '');
								$operating_daily_expenses = round($operating_daily_expenses);
							}
							
							
 							// Advertising Expenses
							if($advertising_expenses_percentage!=0)
							{
								$advertising_annual_expenses = $projection_row->annual_billing*$advertising_expenses_percentage;
								$advertising_annual_expenses = number_format($advertising_annual_expenses, 2, '.', '');
								$advertising_calculation_annual_expenses = round($advertising_annual_expenses,3);
							}
							if($advertising_calculation_annual_expenses!=0)
							{
								$advertising_annual_expenses = round($advertising_annual_expenses);
								
								$advertising_quaterly_expenses = $advertising_calculation_annual_expenses/4;
								$advertising_quaterly_expenses = number_format($advertising_quaterly_expenses, 2, '.', '');
								$advertising_quaterly_expenses = round($advertising_quaterly_expenses);

								$advertising_monthly_expenses = $advertising_calculation_annual_expenses/12; 
								$advertising_monthly_expenses = number_format($advertising_monthly_expenses, 2, '.', '');
								$advertising_monthly_expenses = round($advertising_monthly_expenses);

								$advertising_weekly_expenses = $advertising_calculation_annual_expenses/52;
								$advertising_weekly_expenses = number_format($advertising_weekly_expenses, 2, '.', '');
								$advertising_weekly_expenses = round($advertising_weekly_expenses);

								$advertising_daily_expenses = $advertising_calculation_annual_expenses/365;
								$advertising_daily_expenses = number_format($advertising_daily_expenses, 2, '.', '');
								$advertising_daily_expenses = round($advertising_daily_expenses);
							}
							//cost of product sold
							if($average_product_sold_cost_percentage!=0)
							{
								$annual_product_sold_cost = $projection_row->annual_billing*$average_product_sold_cost_percentage;
								$annual_product_sold_cost = number_format($annual_product_sold_cost, 2, '.', '');
								$annual_calculation_product_sold_cost = round($annual_product_sold_cost,3);
							}
							if($annual_calculation_product_sold_cost!=0)
							{
								$annual_product_sold_cost = round($annual_product_sold_cost);
								
  								$quaterly_product_sold_cost = $annual_calculation_product_sold_cost/4;
								$quaterly_product_sold_cost = number_format($quaterly_product_sold_cost, 2, '.', '');
								$quaterly_product_sold_cost = round($quaterly_product_sold_cost);
								
								$monthly_product_sold_cost = $annual_calculation_product_sold_cost/12;
								$monthly_product_sold_cost = number_format($monthly_product_sold_cost, 2, '.', '');
								$monthly_product_sold_cost = round($monthly_product_sold_cost);
								
 								$weekly_product_sold_cost = $annual_calculation_product_sold_cost/52;
								$weekly_product_sold_cost = number_format($weekly_product_sold_cost, 2, '.', '');
								$weekly_product_sold_cost = round($weekly_product_sold_cost);
								
								$daily_product_sold_cost = $annual_calculation_product_sold_cost/365;
								$daily_product_sold_cost = number_format($daily_product_sold_cost, 2, '.', '');
								$daily_product_sold_cost = round($daily_product_sold_cost);
							}
 							$total_daily_expenses = $operating_daily_expenses + $advertising_daily_expenses + $daily_product_sold_cost;
							$total_weekly_expenses = $operating_weekly_expenses + $advertising_weekly_expenses + $weekly_product_sold_cost;
							$total_monthly_expenses  = $operating_monthly_expenses + $advertising_monthly_expenses+ $monthly_product_sold_cost;
							$total_quaterly_expenses = $operating_quaterly_expenses + $advertising_quaterly_expenses+ $quaterly_product_sold_cost;
							$total_annual_expenses = $operating_annual_expenses + $advertising_annual_expenses+ $annual_product_sold_cost; 
							
							$save_array = array(
								'operating_expenses'  => $form_data['operating_expenses'],
								'advertising_expenses'  => $form_data['advertising_expenses'],
								'average_product_sold_cost'  => $form_data['average_product_sold_cost'],
								'operating_daily_expenses'  => $operating_daily_expenses,
								'operating_weekly_expenses'  => $operating_weekly_expenses,
								'operating_monthly_expenses'  => $operating_monthly_expenses,
								'operating_quaterly_expenses'  => $operating_quaterly_expenses,
								'operating_annual_expenses'  => $operating_annual_expenses,
 								'advertising_daily_expenses'  => $advertising_daily_expenses,
								'advertising_weekly_expenses'  => $advertising_weekly_expenses,
								'advertising_monthly_expenses'  => $advertising_monthly_expenses,
								'advertising_quaterly_expenses'  => $advertising_quaterly_expenses,
								'advertising_annual_expenses'  => $advertising_annual_expenses,
 								'daily_product_sold_cost'  => $daily_product_sold_cost,
								'weekly_product_sold_cost'  => $weekly_product_sold_cost,
								'monthly_product_sold_cost'  => $monthly_product_sold_cost,
								'quaterly_product_sold_cost'  => $quaterly_product_sold_cost,
								'annual_product_sold_cost'  => $annual_product_sold_cost,
								'total_daily_expenses'  => $total_daily_expenses,
								'total_weekly_expenses'  => $total_weekly_expenses,
								'total_monthly_expenses'  => $total_monthly_expenses,
								'total_quaterly_expenses'  => $total_quaterly_expenses,
								'total_annual_expenses'  => $total_annual_expenses,
								'completed_step'  => $step_number,
								'update_date' => time()
							);
							$this->db->set($save_array);
							$this->db->where('user_id', $this->session->userdata('MiPlani_user_id'));
							$this->db->where('projection_id', $this->input->post('form_pid'));
							$this->db->update('tbl_projections');
							return $projection_row->projection_id;
						}
						elseif($this->input->post('form_step')==5 && ($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next'))
						{
							$total = 0;
							$conversion_rate_percentage = 0;
							$annual_qualified_web_traffic_volume = 0;
							$quarterly_qualified_web_traffic_volume = 0;
							$monthly_qualified_web_traffic_volume = 0;
							$weekly_qualified_web_traffic_volume = 0;
							$daily_qualified_web_traffic_volume = 0;
							
							if($form_data['conversion_rate']>0)
							{
 								$conversion_rate_percentage = $form_data['conversion_rate']/100;
								$conversion_rate_percentage = number_format($conversion_rate_percentage, 2, '.', '');
							}
							
							$annual_billing = $projection_row->annual_billing;
							$average_product_price = $projection_row->average_product_price;
							if($annual_billing>0 && $average_product_price>0)
							{
								$total = $annual_billing/$average_product_price;
								$total = number_format($total, 3, '.', '');
								if($total>0)
								{
									//Annual volume of qualified web traffic
									$annual_qualified_web_traffic_volume = $total/$conversion_rate_percentage;
									$annual_qualified_web_traffic_volume = number_format($annual_qualified_web_traffic_volume, 0, '.', '');
									$annual_qualified_web_traffic_volume = round($annual_qualified_web_traffic_volume);  
									
									if($annual_qualified_web_traffic_volume>0)
									{
										$quarterly_qualified_web_traffic_volume = round($annual_qualified_web_traffic_volume/4);
										$monthly_qualified_web_traffic_volume = round($annual_qualified_web_traffic_volume/12);
										$weekly_qualified_web_traffic_volume = round($annual_qualified_web_traffic_volume/52);
										$daily_qualified_web_traffic_volume = round($annual_qualified_web_traffic_volume/365);
									}
								}
								$annual_potential_customer_buy_one_item = 0;
								$quarterly_potential_customer_buy_one_item = 0;
								$monthly_potential_customer_buy_one_item = 0;
								$weekly_potential_customer_buy_one_item = 0;
								$daily_potential_customer_buy_one_item = 0;
								
								
								if($annual_qualified_web_traffic_volume>0)
								{
									//Annual number of potential customers
									$annual_potential_customer_buy_one_item = $annual_qualified_web_traffic_volume * $conversion_rate_percentage;
 									$annual_potential_customer_buy_one_item = number_format($annual_potential_customer_buy_one_item, 2, '.', '');
									$annual_potential_customer_buy_one_item = round($annual_potential_customer_buy_one_item);
									if($annual_potential_customer_buy_one_item>0)
									{
										$quarterly_potential_customer_buy_one_item = round($annual_potential_customer_buy_one_item/4);
										$monthly_potential_customer_buy_one_item = round($annual_potential_customer_buy_one_item/12);
										$weekly_potential_customer_buy_one_item = round($annual_potential_customer_buy_one_item/52);
										$daily_potential_customer_buy_one_item = round($annual_potential_customer_buy_one_item/365);
									}
								}
							}
							
							$save_array = array(
								'conversion_rate'  => $form_data['conversion_rate'],
								'conversion_rate_percentage'  => $conversion_rate_percentage,
								'annual_qualified_web_traffic_volume'  => $annual_qualified_web_traffic_volume,
								'quarterly_qualified_web_traffic_volume'  => $quarterly_qualified_web_traffic_volume,
								'monthly_qualified_web_traffic_volume'  => $monthly_qualified_web_traffic_volume,
								'weekly_qualified_web_traffic_volume'  => $weekly_qualified_web_traffic_volume,
								'daily_qualified_web_traffic_volume'  => $daily_qualified_web_traffic_volume,
								'annual_potential_customer_buy_one_item'  => $annual_potential_customer_buy_one_item,
								'quarterly_potential_customer_buy_one_item' => $quarterly_potential_customer_buy_one_item,
								'monthly_potential_customer_buy_one_item'  => $monthly_potential_customer_buy_one_item,
								'weekly_potential_customer_buy_one_item'  => $weekly_potential_customer_buy_one_item,
								'daily_potential_customer_buy_one_item'  => $daily_potential_customer_buy_one_item,
								'completed_step'  => $step_number,
								'update_date' => time()
							);
							$this->db->set($save_array);
							$this->db->where('user_id', $this->session->userdata('MiPlani_user_id'));
							$this->db->where('projection_id', $this->input->post('form_pid'));
							$this->db->update('tbl_projections');
							return $projection_row->projection_id;
						}
						elseif($this->input->post('form_step')==6 && ($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next'))
						{
							$daily_revenue = round(($projection_row->annual_billing/365));
							$weekly_revenue = round(($projection_row->annual_billing/52));
							$monthly_revenue = round(($projection_row->annual_billing/12));
							$quaterly_revenue = round(($projection_row->annual_billing/4));
							$annual_revenue = $projection_row->annual_billing;
							
							$save_array = array(
								'daily_revenue'  => $daily_revenue,
								'weekly_revenue'  => $weekly_revenue,
								'monthly_revenue'  => $monthly_revenue,
								'quaterly_revenue'  => $quaterly_revenue,
								'annual_revenue'  => $annual_revenue,
								'completed_step'  => $step_number,
								'update_date' => time()
							);
							$this->db->set($save_array);
							$this->db->where('user_id', $this->session->userdata('MiPlani_user_id'));
							$this->db->where('projection_id', $this->input->post('form_pid'));
							$this->db->update('tbl_projections');
							return $projection_row->projection_id;
						}
						elseif($this->input->post('form_step')==7 && ($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next'))
						{
							$save_array = array(
								'completed_step'  => $step_number,
								'update_date' => time()
							);
							$this->db->set($save_array);
							$this->db->where('user_id', $this->session->userdata('MiPlani_user_id'));
							$this->db->where('projection_id', $this->input->post('form_pid'));
							$this->db->update('tbl_projections');
							return $projection_row->projection_id;
						}
						elseif($this->input->post('form_step')==8 && ($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next'))
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
								if($annual_profit>0)
								{
									$quarterly_profit = round($annual_profit/4);
									$monthly_profit = round($annual_profit/12);
									$weekly_profit = round($annual_profit/52);
									$daily_profit = round($annual_profit/365);
									if($projection_row->total_annual_expenses!=0)
									{
										$rio = round(($annual_profit/$projection_row->total_annual_expenses) * 100);
									}
								}
							}
							$save_array = array(
								'global_analysis_annual_profit'  => $annual_profit,
								'global_analysis_monthly_profit'  => $monthly_profit,
								'global_analysis_quarterly_profit'  => $quarterly_profit,
								'global_analysis_weekly_profit'  => $weekly_profit,
								'global_analysis_daily_profit'  => $daily_profit,
								'global_analysis_rio'  => $rio,
								'completed_step'  => $step_number,
								'update_date' => time()
							);
							$this->db->set($save_array);
							$this->db->where('user_id', $this->session->userdata('MiPlani_user_id'));
							$this->db->where('projection_id', $this->input->post('form_pid'));
							$this->db->update('tbl_projections');
							return $projection_row->projection_id;
						}
						elseif($this->input->post('form_step')==9 && ($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next'))
						{
							$save_array = array(
								'completed_step'  => $step_number,
								'update_date' => time()
							);
							$this->db->set($save_array);
							$this->db->where('user_id', $this->session->userdata('MiPlani_user_id'));
							$this->db->where('projection_id', $this->input->post('form_pid'));
							$this->db->update('tbl_projections');
							return $projection_row->projection_id;
						}
						elseif($this->input->post('form_step')==10 && ($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next'))
						{
							$scenario_one_expense = '';	
							$scenario_two_conversion = '';	
							$additional_product_buyer_ratio = '';	
							$additional_product_price = '';	
							$multiple_product_buyer_ratio = '';	
							$multiple_product_buyer_ratio = '';	
							$multiple_product_price = '';	
							if(!empty($form_data['scenario_one_expense']))
							{
								$scenario_one_expense = $form_data['scenario_one_expense'];
							}
							if(!empty($form_data['scenario_two_conversion']))
							{
								$scenario_two_conversion = $form_data['scenario_two_conversion'];
							}
							if(!empty($form_data['additional_product_buyer_ratio']))
							{
								$additional_product_buyer_ratio = $form_data['additional_product_buyer_ratio'];
							}
							if(!empty($form_data['additional_product_price']))
							{
								$additional_product_price = $form_data['additional_product_price'];
							}
							if(!empty($form_data['multiple_product_buyer_ratio']))
							{
								$multiple_product_buyer_ratio = $form_data['multiple_product_buyer_ratio'];
							}
							if(!empty($form_data['multiple_product_price']))
							{
								$multiple_product_price = $form_data['multiple_product_price'];
							}
							$save_array = array(
								'scenario_one_total_expenses_ratio' => $scenario_one_expense,
								'scenario_two_conversion' => $scenario_two_conversion,
								'scenario_three_product_buyer_ratio' => $additional_product_buyer_ratio,
								'scenario_three_additional_product_price' => $additional_product_price,
								'scenario_multiple_product_buyer_ratio' => $multiple_product_buyer_ratio,
								'scenario_multiple_product_price' => $multiple_product_price,
								'completed_step'  => $step_number,
								'update_date' => time()
							);
							$this->db->set($save_array);
							$this->db->where('user_id', $this->session->userdata('MiPlani_user_id'));
							$this->db->where('projection_id', $this->input->post('form_pid'));
							$this->db->update('tbl_projections');
							return $projection_row->projection_id;
						}
						elseif($this->input->post('form_step')==11 && ($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next'))
						{
 							$save_array = array(
								'completed_step'  => $step_number,
								'update_date' => time(),
								'projection_status' => 'active'
							);
							$this->db->set($save_array);
							$this->db->where('user_id', $this->session->userdata('MiPlani_user_id'));
							$this->db->where('projection_id', $this->input->post('form_pid'));
							$this->db->update('tbl_projections');
							return $projection_row->projection_id;
						}
						elseif($this->input->post('form_step')==12 && ($this->input->post('action_type')=='save' || $this->input->post('action_type')=='submit'))
						{
 							$currency  = 'EUR'; 
							if(!empty($form_data['currency']))
							{
								$currency = $form_data['currency'];
							}
 							$save_array = array(
 								'currency'  => $currency,
 								'completed_step'  => $step_number,
								'projection_status' => 'active'
							);
							$this->db->set($save_array);
							$this->db->where('user_id', $this->session->userdata('MiPlani_user_id'));
							$this->db->where('projection_id', $this->input->post('form_pid'));
							$this->db->update('tbl_projections');
							return $projection_row->projection_id;
						}
						else
						{
							return $projection_row->projection_id;
						}
					}
				}
			}
		}
 	}
	public function save_guest_projection($key_url)
	{
		if(!empty($key_url))
		{
			$form_data = array();
			if(!empty($_POST['form_data']))
			{
				$form_array = parse_str($_POST['form_data'], $form_data);
			}
			if($this->input->post('form_pid')>0)
			{
 				$projection_row = $this->get_guest_projection_details($this->input->post('form_pid'),$key_url);
				if(!empty($projection_row))
				{
					$projection_guest_permission = $projection_row->permission;
					$step_number = $projection_row->completed_step;
					if(in_array($projection_guest_permission,array('update','all')))	
					{
						if($step_number>0)
						{
							if($step_number>$this->input->post('form_step'))
							{
								$step_number = $step_number;
							}
							else
							{
								$step_number = $this->input->post('form_step');
							}
						}
						else
						{
							$step_number = $this->input->post('form_step');
						}
						if($this->input->post('form_step')==1 && ($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next'))
						{
							$save_array = array(
								'projection_name'  => $form_data['projection_name'],
								'completed_step'  => $step_number,
								'update_date' => time(),
								'update_key_url' => $key_url,
							);
							$this->db->set($save_array);
							$this->db->where('projection_id', $this->input->post('form_pid'));
							$this->db->update('tbl_projections');
							return $projection_row->projection_id;
						}
						elseif($this->input->post('form_step')==2 && ($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next'))
						{
							$annual_billing = $form_data['annual_billing'];
							$annual_billing = str_replace(".","",$annual_billing);
							$annual_billing = intval($annual_billing);
							$save_array = array(
								'annual_billing'  => $annual_billing,
								'completed_step'  => $step_number,
								'update_date' => time(),
								'update_key_url' => $key_url,
							);
							$this->db->set($save_array);
							$this->db->where('projection_id', $this->input->post('form_pid'));
							$this->db->update('tbl_projections');
							return $projection_row->projection_id;
						}
						elseif($this->input->post('form_step')==3 && ($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next'))
						{
							$average_product_price = $form_data['average_product_price'];
							$average_product_price = str_replace(".","",$average_product_price);
							$average_product_price = intval($average_product_price);
							
 							$save_array = array(
								'average_product_price'  => $average_product_price,
								'completed_step'  => $step_number,
								'update_date' => time(),
								'update_key_url' => $key_url,
							);
							$this->db->set($save_array);
							$this->db->where('projection_id', $this->input->post('form_pid'));
							$this->db->update('tbl_projections');
							return $projection_row->projection_id;
						}
						elseif($this->input->post('form_step')==4 && ($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next'))
						{
							$operating_calculation_annual_expenses = 0;
							$operating_annual_expenses = 0;
							$operating_quaterly_expenses = 0;
							$operating_monthly_expenses = 0;
							$operating_weekly_expenses = 0;
							$operating_daily_expenses = 0;
							$operating_expenses_percentage = 1;
							
							$advertising_calculation_annual_expenses = 0;
							$advertising_annual_expenses = 0;
							$advertising_quaterly_expenses = 0;
							$advertising_monthly_expenses = 0;
							$advertising_weekly_expenses = 0;
							$advertising_daily_expenses = 0;
							$advertising_expenses_percentage = 1;
							
							$annual_calculation_product_sold_cost = 0;
							$annual_product_sold_cost = 0;
							$quaterly_product_sold_cost = 0;
							$monthly_product_sold_cost = 0;
							$weekly_product_sold_cost = 0;
							$daily_product_sold_cost = 0;
							$average_product_sold_cost_percentage = 1;
							
							if(!empty($form_data['operating_expenses']))
							{
								if($form_data['operating_expenses']!=0)
								{
									$operating_expenses_percentage = $form_data['operating_expenses']/100;
									$operating_expenses_percentage = number_format($operating_expenses_percentage, 2, '.', '');
								}
							}
							if(!empty($form_data['advertising_expenses']))
							{
								if($form_data['advertising_expenses']!=0)
								{
									$advertising_expenses_percentage = $form_data['advertising_expenses']/100;
									$advertising_expenses_percentage = number_format($advertising_expenses_percentage, 2, '.', '');
								}
							}
							if(!empty($form_data['average_product_sold_cost']))
							{
								if($form_data['average_product_sold_cost']!=0)
								{
									$average_product_sold_cost_percentage = $form_data['average_product_sold_cost']/100;
									$average_product_sold_cost_percentage = number_format($average_product_sold_cost_percentage, 2, '.', '');
								}
							}
							// Operating Expense
							if($operating_expenses_percentage!=0)
							{
								$operating_annual_expenses = $projection_row->annual_billing*$operating_expenses_percentage;
								$operating_annual_expenses = number_format($operating_annual_expenses, 2, '.', '');
								$operating_calculation_annual_expenses = round($operating_annual_expenses,3);
							}
							
							if($operating_calculation_annual_expenses!=0)
							{
								$operating_annual_expenses = round($operating_annual_expenses);
								
								$operating_quaterly_expenses = $operating_calculation_annual_expenses/4;
								$operating_quaterly_expenses = number_format($operating_quaterly_expenses, 2, '.', '');
								$operating_quaterly_expenses = round($operating_quaterly_expenses);
								
								$operating_monthly_expenses = $operating_calculation_annual_expenses/12;
								$operating_monthly_expenses = number_format($operating_monthly_expenses, 2, '.', '');
								$operating_monthly_expenses = round($operating_monthly_expenses);
								
								$operating_weekly_expenses = $operating_calculation_annual_expenses/52;
								$operating_weekly_expenses = number_format($operating_weekly_expenses, 2, '.', '');
								$operating_weekly_expenses = round($operating_weekly_expenses);
								
								
								$operating_daily_expenses = $operating_calculation_annual_expenses/365;
								$operating_daily_expenses = number_format($operating_daily_expenses, 2, '.', '');
								$operating_daily_expenses = round($operating_daily_expenses);
							}
							
							
 							// Advertising Expenses
							if($advertising_expenses_percentage!=0)
							{
								$advertising_annual_expenses = $projection_row->annual_billing*$advertising_expenses_percentage;
								$advertising_annual_expenses = number_format($advertising_annual_expenses, 2, '.', '');
								$advertising_calculation_annual_expenses = round($advertising_annual_expenses,3);
							}
							if($advertising_calculation_annual_expenses!=0)
							{
								$advertising_annual_expenses = round($advertising_annual_expenses);
								
								$advertising_quaterly_expenses = $advertising_calculation_annual_expenses/4;
								$advertising_quaterly_expenses = number_format($advertising_quaterly_expenses, 2, '.', '');
								$advertising_quaterly_expenses = round($advertising_quaterly_expenses);

								$advertising_monthly_expenses = $advertising_calculation_annual_expenses/12; 
								$advertising_monthly_expenses = number_format($advertising_monthly_expenses, 2, '.', '');
								$advertising_monthly_expenses = round($advertising_monthly_expenses);

								$advertising_weekly_expenses = $advertising_calculation_annual_expenses/52;
								$advertising_weekly_expenses = number_format($advertising_weekly_expenses, 2, '.', '');
								$advertising_weekly_expenses = round($advertising_weekly_expenses);

								$advertising_daily_expenses = $advertising_calculation_annual_expenses/365;
								$advertising_daily_expenses = number_format($advertising_daily_expenses, 2, '.', '');
								$advertising_daily_expenses = round($advertising_daily_expenses);
							}
							//cost of product sold
							if($average_product_sold_cost_percentage!=0)
							{
								$annual_product_sold_cost = $projection_row->annual_billing*$average_product_sold_cost_percentage;
								$annual_product_sold_cost = number_format($annual_product_sold_cost, 2, '.', '');
								$annual_calculation_product_sold_cost = round($annual_product_sold_cost,3);
							}
							if($annual_calculation_product_sold_cost!=0)
							{
								$annual_product_sold_cost = round($annual_product_sold_cost);
								
  								$quaterly_product_sold_cost = $annual_calculation_product_sold_cost/4;
								$quaterly_product_sold_cost = number_format($quaterly_product_sold_cost, 2, '.', '');
								$quaterly_product_sold_cost = round($quaterly_product_sold_cost);
								
								$monthly_product_sold_cost = $annual_calculation_product_sold_cost/12;
								$monthly_product_sold_cost = number_format($monthly_product_sold_cost, 2, '.', '');
								$monthly_product_sold_cost = round($monthly_product_sold_cost);
								
 								$weekly_product_sold_cost = $annual_calculation_product_sold_cost/52;
								$weekly_product_sold_cost = number_format($weekly_product_sold_cost, 2, '.', '');
								$weekly_product_sold_cost = round($weekly_product_sold_cost);
								
								$daily_product_sold_cost = $annual_calculation_product_sold_cost/365;
								$daily_product_sold_cost = number_format($daily_product_sold_cost, 2, '.', '');
								$daily_product_sold_cost = round($daily_product_sold_cost);
							}
 							$total_daily_expenses = $operating_daily_expenses + $advertising_daily_expenses + $daily_product_sold_cost;
							$total_weekly_expenses = $operating_weekly_expenses + $advertising_weekly_expenses + $weekly_product_sold_cost;
							$total_monthly_expenses  = $operating_monthly_expenses + $advertising_monthly_expenses+ $monthly_product_sold_cost;
							$total_quaterly_expenses = $operating_quaterly_expenses + $advertising_quaterly_expenses+ $quaterly_product_sold_cost;
							$total_annual_expenses = $operating_annual_expenses + $advertising_annual_expenses+ $annual_product_sold_cost; 

							$save_array = array(
								'operating_expenses'  => $form_data['operating_expenses'],
								'advertising_expenses'  => $form_data['advertising_expenses'],
								'average_product_sold_cost'  => $form_data['average_product_sold_cost'],
								'operating_daily_expenses'  => $operating_daily_expenses,
								'operating_weekly_expenses'  => $operating_weekly_expenses,
								'operating_monthly_expenses'  => $operating_monthly_expenses,
								'operating_quaterly_expenses'  => $operating_quaterly_expenses,
								'operating_annual_expenses'  => $operating_annual_expenses,
								'advertising_daily_expenses'  => $advertising_daily_expenses,
								'advertising_weekly_expenses'  => $advertising_weekly_expenses,
								'advertising_monthly_expenses'  => $advertising_monthly_expenses,
								'advertising_quaterly_expenses'  => $advertising_quaterly_expenses,
								'advertising_annual_expenses'  => $advertising_annual_expenses,
								'daily_product_sold_cost'  => $daily_product_sold_cost,
								'weekly_product_sold_cost'  => $weekly_product_sold_cost,
								'monthly_product_sold_cost'  => $monthly_product_sold_cost,
								'quaterly_product_sold_cost'  => $quaterly_product_sold_cost,
								'annual_product_sold_cost'  => $annual_product_sold_cost,
								'total_daily_expenses'  => $total_daily_expenses,
								'total_weekly_expenses'  => $total_weekly_expenses,
								'total_monthly_expenses'  => $total_monthly_expenses,
								'total_quaterly_expenses'  => $total_quaterly_expenses,
								'total_annual_expenses'  => $total_annual_expenses,
								'completed_step'  => $step_number,
								'update_date' => time(),
								'update_key_url' => $key_url,
							);
							$this->db->set($save_array);
							$this->db->where('projection_id', $this->input->post('form_pid'));
							$this->db->update('tbl_projections');
							return $projection_row->projection_id;
						}
						elseif($this->input->post('form_step')==5 && ($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next'))
						{
							$total = 0;
							$conversion_rate_percentage = 0;
							$annual_qualified_web_traffic_volume = 0;
							$quarterly_qualified_web_traffic_volume = 0;
							$monthly_qualified_web_traffic_volume = 0;
							$weekly_qualified_web_traffic_volume = 0;
							$daily_qualified_web_traffic_volume = 0;

							if($form_data['conversion_rate']>0)
							{
								$conversion_rate_percentage = $form_data['conversion_rate']/100;
								$conversion_rate_percentage = number_format($conversion_rate_percentage, 2, '.', '');
							}

							$annual_billing = $projection_row->annual_billing;
							$average_product_price = $projection_row->average_product_price;
							if($annual_billing>0 && $average_product_price>0)
							{
								$total = $annual_billing/$average_product_price;
								$total = number_format($total, 3, '.', '');
								if($total>0)
								{
									//Annual volume of qualified web traffic
									$annual_qualified_web_traffic_volume = $total/$conversion_rate_percentage;
									$annual_qualified_web_traffic_volume = number_format($annual_qualified_web_traffic_volume, 0, '.', '');
									$annual_qualified_web_traffic_volume = round($annual_qualified_web_traffic_volume);  

									if($annual_qualified_web_traffic_volume>0)
									{
										$quarterly_qualified_web_traffic_volume = round($annual_qualified_web_traffic_volume/4);
										$monthly_qualified_web_traffic_volume = round($annual_qualified_web_traffic_volume/12);
										$weekly_qualified_web_traffic_volume = round($annual_qualified_web_traffic_volume/52);
										$daily_qualified_web_traffic_volume = round($annual_qualified_web_traffic_volume/365);
									}
								}
								$annual_potential_customer_buy_one_item = 0;
								$quarterly_potential_customer_buy_one_item = 0;
								$monthly_potential_customer_buy_one_item = 0;
								$weekly_potential_customer_buy_one_item = 0;
								$daily_potential_customer_buy_one_item = 0;


								if($annual_qualified_web_traffic_volume>0)
								{
									//Annual number of potential customers
									$annual_potential_customer_buy_one_item = $annual_qualified_web_traffic_volume * $conversion_rate_percentage;
									$annual_potential_customer_buy_one_item = number_format($annual_potential_customer_buy_one_item, 2, '.', '');
									$annual_potential_customer_buy_one_item = round($annual_potential_customer_buy_one_item);
									if($annual_potential_customer_buy_one_item>0)
									{
										$quarterly_potential_customer_buy_one_item = round($annual_potential_customer_buy_one_item/4);
										$monthly_potential_customer_buy_one_item = round($annual_potential_customer_buy_one_item/12);
										$weekly_potential_customer_buy_one_item = round($annual_potential_customer_buy_one_item/52);
										$daily_potential_customer_buy_one_item = round($annual_potential_customer_buy_one_item/365);
									}
								}
							}

							$save_array = array(
								'conversion_rate'  => $form_data['conversion_rate'],
								'conversion_rate_percentage'  => $conversion_rate_percentage,
								'annual_qualified_web_traffic_volume'  => $annual_qualified_web_traffic_volume,
								'quarterly_qualified_web_traffic_volume'  => $quarterly_qualified_web_traffic_volume,
								'monthly_qualified_web_traffic_volume'  => $monthly_qualified_web_traffic_volume,
								'weekly_qualified_web_traffic_volume'  => $weekly_qualified_web_traffic_volume,
								'daily_qualified_web_traffic_volume'  => $daily_qualified_web_traffic_volume,
								'annual_potential_customer_buy_one_item'  => $annual_potential_customer_buy_one_item,
								'quarterly_potential_customer_buy_one_item' => $quarterly_potential_customer_buy_one_item,
								'monthly_potential_customer_buy_one_item'  => $monthly_potential_customer_buy_one_item,
								'weekly_potential_customer_buy_one_item'  => $weekly_potential_customer_buy_one_item,
								'daily_potential_customer_buy_one_item'  => $daily_potential_customer_buy_one_item,
								'completed_step'  => $step_number,
								'update_date' => time(),
								'update_key_url' => $key_url,
							);
							$this->db->set($save_array);
							$this->db->where('projection_id', $this->input->post('form_pid'));
							$this->db->update('tbl_projections');
							return $projection_row->projection_id;
						}
						elseif($this->input->post('form_step')==6 && ($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next'))
						{
							$daily_revenue = round(($projection_row->annual_billing/365));
							$weekly_revenue = round(($projection_row->annual_billing/52));
							$monthly_revenue = round(($projection_row->annual_billing/12));
							$quaterly_revenue = round(($projection_row->annual_billing/4));
							$annual_revenue = $projection_row->annual_billing;

							$save_array = array(
								'daily_revenue'  => $daily_revenue,
								'weekly_revenue'  => $weekly_revenue,
								'monthly_revenue'  => $monthly_revenue,
								'quaterly_revenue'  => $quaterly_revenue,
								'annual_revenue'  => $annual_revenue,
								'completed_step'  => $step_number,
								'update_date' => time(),
								'update_key_url' => $key_url,
							);
							$this->db->set($save_array);
							$this->db->where('projection_id', $this->input->post('form_pid'));
							$this->db->update('tbl_projections');
							return $projection_row->projection_id;
						}
						elseif($this->input->post('form_step')==7 && ($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next'))
						{
							$save_array = array(
								'completed_step'  => $step_number,
								'update_date' => time(),
								'update_key_url' => $key_url,
							);
							$this->db->set($save_array);
							$this->db->where('projection_id', $this->input->post('form_pid'));
							$this->db->update('tbl_projections');
							return $projection_row->projection_id;
						}
						elseif($this->input->post('form_step')==8 && ($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next'))
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
								if($annual_profit>0)
								{
									$quarterly_profit = round($annual_profit/4);
									$monthly_profit = round($annual_profit/12);
									$weekly_profit = round($annual_profit/52);
									$daily_profit = round($annual_profit/365);
									$rio = round(($annual_profit/$projection_row->total_annual_expenses) * 100);
								}
							}
							$save_array = array(
								'global_analysis_annual_profit'  => $annual_profit,
								'global_analysis_monthly_profit'  => $monthly_profit,
								'global_analysis_quarterly_profit'  => $quarterly_profit,
								'global_analysis_weekly_profit'  => $weekly_profit,
								'global_analysis_daily_profit'  => $daily_profit,
								'global_analysis_rio'  => $rio,
								'completed_step'  => $step_number,
								'update_date' => time(),
								'update_key_url' => $key_url,
							);
							$this->db->set($save_array);
							$this->db->where('projection_id', $this->input->post('form_pid'));
							$this->db->update('tbl_projections');
							return $projection_row->projection_id;
						}
						elseif($this->input->post('form_step')==9 && ($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next'))
						{
							$save_array = array(
								'completed_step'  => $step_number,
								'update_date' => time(),
								'update_key_url' => $key_url,
							);
							$this->db->set($save_array);
							$this->db->where('projection_id', $this->input->post('form_pid'));
							$this->db->update('tbl_projections');
							return $projection_row->projection_id;
						}
						elseif($this->input->post('form_step')==10 && ($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next'))
						{
							$scenario_one_expense = '';	
							$scenario_two_conversion = '';	
							$additional_product_buyer_ratio = '';	
							$additional_product_price = '';	
							$multiple_product_buyer_ratio = '';	
							$multiple_product_buyer_ratio = '';	
							$multiple_product_price = '';	
							if(!empty($form_data['scenario_one_expense']))
							{
								$scenario_one_expense = $form_data['scenario_one_expense'];
							}
							if(!empty($form_data['scenario_two_conversion']))
							{
								$scenario_two_conversion = $form_data['scenario_two_conversion'];
							}
							if(!empty($form_data['additional_product_buyer_ratio']))
							{
								$additional_product_buyer_ratio = $form_data['additional_product_buyer_ratio'];
							}
							if(!empty($form_data['additional_product_price']))
							{
								$additional_product_price = $form_data['additional_product_price'];
							}
							if(!empty($form_data['multiple_product_buyer_ratio']))
							{
								$multiple_product_buyer_ratio = $form_data['multiple_product_buyer_ratio'];
							}
							if(!empty($form_data['multiple_product_price']))
							{
								$multiple_product_price = $form_data['multiple_product_price'];
							}
							$save_array = array(
								'scenario_one_total_expenses_ratio' => $scenario_one_expense,
								'scenario_two_conversion' => $scenario_two_conversion,
								'scenario_three_product_buyer_ratio' => $additional_product_buyer_ratio,
								'scenario_three_additional_product_price' => $additional_product_price,
								'scenario_multiple_product_buyer_ratio' => $multiple_product_buyer_ratio,
								'scenario_multiple_product_price' => $multiple_product_price,
								'completed_step'  => $step_number,
								'update_date' => time(),
								'update_key_url' => $key_url,
							);
							$this->db->set($save_array);
							$this->db->where('projection_id', $this->input->post('form_pid'));
							$this->db->update('tbl_projections');
							return $projection_row->projection_id;
						}
						elseif($this->input->post('form_step')==11 && ($this->input->post('action_type')=='save' || $this->input->post('action_type')=='next'))
						{
							$save_array = array(
								'completed_step'  => $step_number,
								'update_date' => time(),
								'update_key_url' => $key_url,
								'projection_status' => 'active'
							);
							$this->db->set($save_array);
							$this->db->where('projection_id', $this->input->post('form_pid'));
							$this->db->update('tbl_projections');
							return $projection_row->projection_id;
						}
						elseif($this->input->post('form_step')==12 && ($this->input->post('action_type')=='save' || $this->input->post('action_type')=='submit'))
						{
							$currency  = 'EUR'; 
							if(!empty($form_data['currency']))
							{
								$currency = $form_data['currency'];
							}
							$save_array = array(
								'currency'  => $currency,
								'completed_step'  => $step_number,
								'projection_status' => 'active',
								'update_key_url' => $key_url,
							);
							$this->db->set($save_array);
							$this->db->where('projection_id', $this->input->post('form_pid'));
							$this->db->update('tbl_projections');
							return $projection_row->projection_id;
						}
						else
						{
							return $projection_row->projection_id;
						}
					}
					else
					{
						return $this->input->post('form_pid');
					}
				}
 			}
		}
 	}
	public function get_projection_row($projection_id,$user_id)
	{
		$this->db->select("*");
		$this->db->where("projection_id",$projection_id);
		$this->db->where("user_id",$user_id);
   		$this->db->from('tbl_projections');
 		$query = $this->db->get();
 		if($query->num_rows())
		{
 			return $query->row();
		}
	}
	public function check_projection_record($projection_id,$user_id)
	{
		$this->db->select("projection_id");
		$this->db->where("projection_id",$projection_id);
		$this->db->where("user_id",$user_id);
   		$this->db->from('tbl_projections');
 		$query = $this->db->get();
  		return $query->num_rows(); 
 	}
	
	public function get_user_wise_projection_list($user_id)
	{
		$this->db->select("*");
 		$this->db->where("user_id",$user_id);
   		$this->db->from('tbl_projections');
		$this->db->order_by('projection_id','desc');
 		$query = $this->db->get();
 		if($query->num_rows())
		{
 			return $query->result();
		}
	}
	public function get_projection_details($projection_id)
	{
		$this->db->select("*");
 		$this->db->where("projection_id",$projection_id);
   		$this->db->from('tbl_projections');
  		$query = $this->db->get();
 		if($query->num_rows())
		{
 			return $query->row();
		}
	}
	public function check_active_projection_record($projection_id)
	{
		$this->db->select("projection_id");
		$this->db->where("projection_id",$projection_id);
		$this->db->where("projection_status",'active');
   		$this->db->from('tbl_projections');
 		$query = $this->db->get();
 		return $query->num_rows(); 
	}
	public function SaveComment()
	{
		$projection_id = base64_decode($this->input->post('projection_id', TRUE));
		$add_user_id = 0;
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$add_user_id = $this->session->userdata('MiPlani_user_id');
		}
		$save_array = array(
			'projection_id'  => $projection_id,
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'comments'  => $this->input->post('comments'),
			'projection_type' => 'sub',
			'add_user_id'  => $add_user_id,
			'comment_date' => time()
		);
		$this->db->set($save_array);
		$this->db->insert('tbl_comments');
	}
	
	public function get_projection_count($projection_id,$projection_type)
	{
		$this->db->select('comment_id');
		$this->db->from('tbl_comments');
		$this->db->where("projection_id",$projection_id);
		$this->db->where("projection_type",$projection_type);
   		$query = $this->db->get();
  		return $query->num_rows();
	}
	public function get_projection_data($limit,$start,$projection_id,$projection_type)
	{	
 		$this->db->select('*');
		$this->db->from('tbl_comments');
		$this->db->where("projection_id",$projection_id);
		$this->db->where("projection_type",$projection_type);
 		$this->db->order_by('comment_id','desc');
		$this->db->limit($start, $limit);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
	public function delete_projection_record($projection_id,$user_id)
	{
 		$this->db->where("projection_id",$projection_id);
		$this->db->where("user_id",$user_id);
 		$this->db->delete('tbl_projections');
	}
	public function invite_friend_projection()
	{
		$projection_id = base64_decode($this->input->post('pid', TRUE));
		$add_user_id = 0;
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{
			$add_user_id = $this->session->userdata('MiPlani_user_id');
		}
		if($projection_id>0)
		{
			$save_array = array(
				'user_id'  => $add_user_id,
				'friend_email' => $this->input->post('email'),
				'projection_id'  => $projection_id,
				'projection_type' => 'sub',
				'permission' => $this->input->post('permission'),
 				'invite_date' => time(),
			);
			$this->db->set($save_array);
			$this->db->insert('tbl_invite_projection_friends');
			$main_id = $this->db->insert_id();
			
			$key_url = $add_user_id."-".$projection_id."-".$main_id;
			$key_url = base64_encode($key_url);
			
			$this->db->set('key_url',$key_url);
			$this->db->where('main_id', $main_id);
			$this->db->update('tbl_invite_projection_friends');
			return $key_url;
		}
	}
	public function get_guest_projection_details($projection_id,$key_url)
	{
		$this->db->select("p.*,i.permission");
 		$this->db->where("p.projection_id",$projection_id);
		$this->db->where("i.key_url",$key_url);
		$this->db->where("i.projection_type",'sub');
   		$this->db->from('tbl_projections as p');
		$this->db->join('tbl_invite_projection_friends as i','p.projection_id=i.projection_id','inner');
  		$query = $this->db->get();
 		if($query->num_rows())
		{
 			return $query->row();
		}
	}
	public function get_projection_array_row($projection_id)
	{
		$this->db->select("*");
 		$this->db->where("projection_id",$projection_id);
   		$this->db->from('tbl_projections');
  		$query = $this->db->get();
 		if($query->num_rows())
		{
 			return $query->row_array();
		}
	}
	public function CopyProjection($projection_id)
	{
		$data = array();
		$data = $this->get_projection_array_row($projection_id);
		array_shift($data);
		if(!empty($data))
		{
			$total_projection_childs = $this->total_projection_child($projection_id);
			 
			$this->db->insert('tbl_projections', $data);
			$insert_id = $this->db->insert_id();
			
 			if($total_projection_childs>0)
			{
				$new = $total_projection_childs+1;
				$projection_name = $data['projection_name'].' Copy '.$new;
			}
			else
			{
				$projection_name = $data['projection_name'].' Copy 1';
			}
			
			$update_array = array(
				'parent_id'  => $projection_id,
				'projection_name'  => $projection_name,
				'add_date'  => time(),
			);
			$this->db->set($update_array);
			$this->db->where('projection_id',$insert_id);
			$this->db->update('tbl_projections');
		}
 	}
	
	public function total_projection_child($projection_id)
	{
		$this->db->select("count(projection_id) as total");
 		$this->db->where("parent_id",$projection_id);
   		$this->db->from('tbl_projections');
  		$query = $this->db->get();
 		if($query->num_rows())
		{
 			return $query->row()->total;
		}
	}
}
?>