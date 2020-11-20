<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Calculations extends MY_Web_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
	private function index()
	{
 
 	}
	public function global_expenses_analysis_calculation()
	{
		$this->load->model("Projection_m","projection");
		$response_message = '';
		$html = '';
		$response_code = 404;
		$projection_id = 0;
		$input_text = '';
		$possible_values = array('operating expenses','advertising expenses','average sold cost');
		
		if(!empty($_POST['id']))
		{
			$projection_id  = base64_decode($_POST['id']);
		}
		if(!empty($_POST['type']))
		{
			$type  = $_POST['type'];
		}
		if(!empty($_POST['input_text']))
		{
			$input_text  = $_POST['input_text'];
		}
		if($input_text<1 || $input_text>100)
		{
			$response_message = 'Please enter value between 1-100';
 		}
		else
		{
 			if($projection_id<1)
			{
				$response_message = 'We are sorry, you are trying inalid access';
 			}
			elseif(!in_array($type,$possible_values))
			{
				$response_message = 'We are sorry, you are trying inalid access';
 			}
			else
			{
				$row = $this->projection->get_projection_details($projection_id);
				if(!empty($row))
				{
					$total_amount = 0;
					$input_percentage = $input_text/100;
					$input_percentage = number_format($input_percentage, 2, '.', '');
					$annual_billing = $row->annual_billing;
					
					if($type=='operating expenses')
					{
 						if($annual_billing>0)
						{
							$total_amount = round(($annual_billing/365)*$input_percentage);
						}
						$html .= '<label class="fw-600">The monetary value that represents the total amount of the daily operating expenses of your business is.</label><input name="" value="'.custom_number_format($total_amount).' &euro;" class="view-input" readonly="" style=" border: 1px solid #efefef !important">';
						$response_code = 200;
					}
					elseif($type=='advertising expenses')
					{
						if($annual_billing>0)
						{
							$total_amount = round(($annual_billing/365)*$input_percentage);
						}
						$html .= '<label class="fw-600">The monetary value that represents the total amount of the daily ADVERTISING expenses of your business is.</label><input name="" value="'.custom_number_format($total_amount).' &euro;" class="view-input" readonly="" style=" border: 1px solid #efefef !important">';
						$response_code = 200;
 					}
					elseif($type=='average sold cost')
					{
						if($annual_billing>0)
						{
							$total_amount = round(($annual_billing/365)*$input_percentage);
						}
						$html .= '<label class="fw-600">The monetary value that represents the total amount of the daily COST of your business´ products or services is.</label><input name="" value="'.custom_number_format($total_amount).' &euro;" class="view-input" readonly="" style=" border: 1px solid #efefef !important">';
						$response_code = 200;
					}
					else
					{
						$response_message = 'We are sorry, you are trying inalid access';
 					}
				}
				else
				{
					$response_message = 'We are sorry, you are trying inalid access';
				}
			}
		}
  		echo json_encode(array("response_code"=>$response_code,"response_message"=>$response_message,"html"=>$html));
	}
	public function conversion_rate_calculation()
	{
		$this->load->model("Projection_m","projection");
		$response_message = '';
		$html = '';
		$response_code = 404;
		$projection_id = 0;
		$input_text = '';
		
		if(!empty($_POST['id']))
		{
			$projection_id  = base64_decode($_POST['id']);
		}
 		if(!empty($_POST['input_text']))
		{
			$input_text  = $_POST['input_text'];
		}
		if($input_text<1 || $input_text>100)
		{
			$response_message = 'Please enter value between 1-100';
 		}
		else
		{
			
			if($projection_id<1)
			{
				$response_message = 'We are sorry, you are trying inalid access';
 			}
 			else
			{
				$row = $this->projection->get_projection_details($projection_id);
				if(!empty($row))
				{
					$total = 0;
					$annual_qualified_web_traffic_volume = 0;
					$annual_potential_customer_buy_one_item = 0;
					$annual_revenue = 0;
					
					$conversion_rate_percentage = $input_text/100;
					$conversion_rate_percentage = number_format($conversion_rate_percentage, 2, '.', '');
					
					$annual_billing = $row->annual_billing;
					$average_product_price = $row->average_product_price;
					
					if($row->annual_billing>0 && $average_product_price>0)
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
								//Annual number of potential customers
								$annual_potential_customer_buy_one_item = $annual_qualified_web_traffic_volume*$conversion_rate_percentage;
								$annual_potential_customer_buy_one_item = number_format($annual_potential_customer_buy_one_item, 2, '.', '');
								$annual_potential_customer_buy_one_item = round($annual_potential_customer_buy_one_item);
								
								if($annual_potential_customer_buy_one_item>0)
								{
									//Annual of Revenue (Annual number of potential customers* average price come from sheet E ($row->average_product_price))
									$annual_revenue = $annual_potential_customer_buy_one_item*$row->average_product_price;
									$annual_revenue = number_format($annual_revenue, 0, '.', '');
									$annual_revenue = round($annual_revenue);
								}
							}
						}
					}
					
					//average price come from sheet E ($row->average_product_price)
					
					$html .= '<div class="col-md-6 mb-2">
                             <label class="fw-600">According to the provided conversion rate, If you wish to reach your proyected financial goals, the annual volume of qualified web traffic should be.</label>
								<input name="" value="'.custom_number_format($annual_qualified_web_traffic_volume).'" class="view-input" readonly="" style=" border: 1px solid #efefef !important">
						</div>
                        <div class="col-md-6">
                             <label class="fw-600">The annual number of potential customers that must buy at least one item will be.</label>
								<input name="" value="'.custom_number_format($annual_potential_customer_buy_one_item).'" class="view-input" readonly="" style=" border: 1px solid #efefef !important">
						</div>
                         <div class="col-md-6 mb-2">
                             <label class="fw-600">At the average price you provided at the beginning of this simulation which was.</label>
								<input name="" value="'.custom_number_format($row->average_product_price).' &euro;" class="view-input" readonly="" style=" border: 1px solid #efefef !important">
						</div>
                        <div class="col-md-6">
                             <label class="fw-600">If all the above conditions happen;  only then, the total annual of Revenue will be equal to the desired annual billing, which is.</label>
								<input name="" value="'.custom_number_format($annual_revenue).' &euro;" class="view-input" readonly="" style=" border: 1px solid #efefef !important">
						</div>'; 
					$response_code = 200;	
				}
				else
				{
					$response_message = 'We are sorry, you are trying inalid access';
				}
			}
		}
  		echo json_encode(array("response_code"=>$response_code,"response_message"=>$response_message,"html"=>$html));
	}
 	public function scenario_one_expense_calculation()
	{
		$this->load->model("Projection_m","projection");
		$response_message = '';
		$html = '';
		$response_code = 404;
		$projection_id = 0;
		$input_text = '';
		
		if(!empty($_POST['id']))
		{
			$projection_id  = base64_decode($_POST['id']);
		}
 		if(!empty($_POST['input_text']))
		{
			$input_text  = $_POST['input_text'];
		}
		if($input_text<1 || $input_text>100)
		{
			$response_message = 'Please enter value between 1-100';
 		}
		else
		{
			
			if($projection_id<1)
			{
				$response_message = 'We are sorry, you are trying inalid access';
 			}
 			else
			{
				$row = $this->projection->get_projection_details($projection_id);
				if(!empty($row))
				{
					$total_expenses_per_year = 0;
					$current_annual_profit = 0;
					$roi = 0;
					$annual_billing = $row->annual_billing;
					if($annual_billing>0)
					{
						$input_percentage = $input_text/100;
						$input_percentage = number_format($input_percentage, 2, '.', '');
						$total_expenses_per_year =  round($annual_billing*$input_percentage);
						if($annual_billing>$total_expenses_per_year)
						{
							$current_annual_profit = $annual_billing-$total_expenses_per_year;
							
							$roi = round(($current_annual_profit/$total_expenses_per_year)*100);
						}
					}
 					$html .='<div class="col-md-12 p-0">
									<label class="fw-600">Total expenses updated / year would be</label>
									<input name="" value="'.custom_number_format($total_expenses_per_year).' &euro;" class="view-input" readonly="" style=" border: 1px solid #efefef !important">
								</div>
								<div class="col-md-12 p-0">
									<label class="fw-600">Current annual benefit would be now</label>
									<input name="" value="'.custom_number_format($current_annual_profit).' &euro;" class="view-input" readonly="" style=" border: 1px solid #efefef !important">
								</div>
								 <div class="col-md-12 p-0">
									<label class="fw-600">ROI (Return on investment)</label>
									<input name="" value="'.$roi.'%" class="view-input" readonly="" style=" border: 1px solid #efefef !important">
							  </div>'; 
					$response_code = 200;	
				}
				else
				{
					$response_message = 'We are sorry, you are trying inalid access';
				}
			}
		}
  		echo json_encode(array("response_code"=>$response_code,"response_message"=>$response_message,"html"=>$html));
	}
	public function scenario_two_conversion_calculation()
	{
		$this->load->model("Projection_m","projection");
		$response_message = '';
		$html = '';
		$response_code = 404;
		$projection_id = 0;
		$input_text = '';
		
		if(!empty($_POST['id']))
		{
			$projection_id  = base64_decode($_POST['id']);
		}
 		if(!empty($_POST['input_text']))
		{
			$input_text  = $_POST['input_text'];
		}
		if($input_text<1 || $input_text>100)
		{
			$response_message = 'Please enter value between 1-100';
 		}
		else
		{
			
			if($projection_id<1)
			{
				$response_message = 'We are sorry, you are trying inalid access';
 			}
 			else
			{
				$row = $this->projection->get_projection_details($projection_id);
				if(!empty($row))
				{
						$total = 0;
						$annual_revenue = 0;
						$annual_qualified_web_traffic_volume = 0;
 						$roi = 0;
						$annual_profit = 0;
						if($input_text>0)
						{
							$conversion_rate_percentage = $input_text/100;
							$conversion_rate_percentage = number_format($conversion_rate_percentage, 2, '.', '');
						}
						$total = $row->annual_qualified_web_traffic_volume*$conversion_rate_percentage;
						$total = number_format($total, 2, '.', '');
						$total = round($total);
						
						$annual_revenue = $total * $row->average_product_price;
						
						if($annual_revenue>$row->total_annual_expenses)
						{
 							$annual_profit = $annual_revenue-$row->total_annual_expenses;
							$roi = ($annual_profit/$row->total_annual_expenses)*100;
							$roi = number_format($roi, 2, '.', '');
							$roi = round($roi);
 						}
						
 						$html .='<div class="col-md-12 p-0">
								<label class="fw-600">The annual revenue would then be</label>
								<input name="" value="'.custom_number_format($annual_revenue).' &euro;" class="view-input" readonly style=" border: 1px solid #efefef !important">
							</div>
							<div class="col-md-12 p-0">
								<label class="fw-600">On other hands, the total annual expenses would still be equal to</label>
								<input name="" value="'.custom_number_format($row->total_annual_expenses).' &euro;" class="view-input" readonly style=" border: 1px solid #efefef !important">
							</div>
							<div class="col-md-12 p-0">
								<label class="fw-600">The profit would now be</label>
								<input name="" value="'.custom_number_format($annual_profit).' &euro;" class="view-input" readonly style=" border: 1px solid #efefef !important">
							</div>
							<div class="col-md-12 p-0">
								<label class="fw-600">ROI (Return on investment)</label>
								<input name="" value="'.$roi.'%" class="view-input" readonly style=" border: 1px solid #efefef !important">
							</div>'; 
					$response_code = 200;	
				}
				else
				{
					$response_message = 'We are sorry, you are trying inalid access';
				}
			}
		}
  		echo json_encode(array("response_code"=>$response_code,"response_message"=>$response_message,"html"=>$html));
	}
	public function get_additional_product_buyer_ratio_calculation()
	{
		$this->load->model("Projection_m","projection");
		$response_message = '';
		$html = '';
		$response_code = 404;
		$projection_id = 0;
		$input_text = '';
		$additional_product_price = '';
		if(!empty($_POST['id']))
		{
			$projection_id  = base64_decode($_POST['id']);
		}
 		if(!empty($_POST['input_text']))
		{
			$input_text  = $_POST['input_text'];
		}
 		
		if($input_text<1 || $input_text>100)
		{
			$response_message = 'Please enter value between 1-100';
 		}
 		else
		{
			
			if($projection_id<1)
			{
				$response_message = 'We are sorry, you are trying inalid access';
 			}
 			else
			{
				$total = 1110;
				$row = $this->projection->get_projection_details($projection_id);
				if(!empty($row))
				{
					
 					$annual_potential_customer_buy_one_item = $row->annual_potential_customer_buy_one_item;
 					if($input_text>0)
					{
						$input_percentage = $input_text/100;
						$input_percentage = number_format($input_percentage, 2, '.', '');
						$toal = $annual_potential_customer_buy_one_item*$input_percentage;
						$toal = number_format($toal, 0, '.', '');
     				}
 					$html .='<div class="col-md-12 p-0">
								<input name="" value="'.$toal.'" class="view-input" readonly="" style=" border: 1px solid #efefef !important">
                            </div>'; 
					$response_code = 200;	
				}
				else
				{
					$response_message = 'We are sorry, you are trying inalid access';
				}
			}
		}
  		echo json_encode(array("response_code"=>$response_code,"response_message"=>$response_message,"html"=>$html));
	}
	public function get_additional_product_price_calculation()
	{
		$this->load->model("Projection_m","projection");
		$response_message = '';
		$html = '';
		$response_code = 404;
		$projection_id = 0;
		$input_text = '';
		$additional_product_buyer_ratio = '';
		
		if(!empty($_POST['id']))
		{
			$projection_id  = base64_decode($_POST['id']);
		}
 		if(!empty($_POST['input_text']))
		{
			$input_text  = $_POST['input_text'];
		}
		if(!empty($_POST['additional_product_buyer_ratio']))
		{
			$additional_product_buyer_ratio  = $_POST['additional_product_buyer_ratio'];
		}
		
		if(!is_numeric($input_text))
		{
			$response_message = 'Please enter valid value';
 		}
		elseif($additional_product_buyer_ratio<1 || $additional_product_buyer_ratio>100)
		{
			$response_message = 'Please enter percentage of current customers between 1-100';
 		}
		else
		{
			
			if($projection_id<1)
			{
				$response_message = 'We are sorry, you are trying inalid access';
 			}
 			else
			{
				$row = $this->projection->get_projection_details($projection_id);
				if(!empty($row))
				{
					$toal = 0;
					$sub_total = 0;
					$roi = 0;
					$current_annual_profit = 0;
					$annual_potential_customer_buy_one_item = $row->annual_potential_customer_buy_one_item;
 					if($input_text>0)
					{
						$input_percentage = $additional_product_buyer_ratio/100;
						$input_percentage = number_format($input_percentage, 2, '.', '');
						$toal = $annual_potential_customer_buy_one_item*$input_percentage;
						$toal = number_format($toal, 0, '.', '');


						
						$annual_potential_customer_buy_one_item = $row->annual_potential_customer_buy_one_item;
						$average_product_price = $row->average_product_price;
						$sub_total = $annual_potential_customer_buy_one_item*$average_product_price;
						$sub_total = number_format($sub_total, 2, '.', '');
						$sub_total = round($sub_total);
						
						$total_income = $sub_total + ($toal*$input_text);
						$main_total = number_format($total_income, 2, '.', '');
						$total_income = round($total_income);
						$total_annual_expenses = $row->total_annual_expenses;
						if($total_income>$total_annual_expenses)
						{
							$current_annual_profit = $total_income-$total_annual_expenses;
						}
						
						$roi = round(($current_annual_profit/$total_annual_expenses)*100);
     				}
					
					
 					
 					$html .='<div class="col-md-12 p-0">
                                 <label class="fw-600">The annual income would be</label>
								<input name="" value="'.custom_number_format($total_income).' &euro;" class="view-input" readonly="" style=" border: 1px solid #efefef !important">
                            </div>
                                <div class="col-md-12 p-0">
                                <label class="fw-600">ROI (Return on investment)</label>
								<input name="" value="'.$roi.'%" class="view-input" readonly="" style=" border: 1px solid #efefef !important">
                            </div>'; 
					$response_code = 200;	
				}
				else
				{
					$response_message = 'We are sorry, you are trying inalid access';
				}
			}
		}
  		echo json_encode(array("response_code"=>$response_code,"response_message"=>$response_message,"html"=>$html));
	}
	public function get_multiple_product_buyer_ratio_calculation()
	{
		$this->load->model("Projection_m","projection");
		$response_message = '';
		$html = '';
		$response_code = 404;
		$projection_id = 0;
		$input_text = '';
		
		if(!empty($_POST['id']))
		{
			$projection_id  = base64_decode($_POST['id']);
		}
 		if(!empty($_POST['input_text']))
		{
			$input_text  = $_POST['input_text'];
		}
		if($input_text<1 || $input_text>100)
		{
			$response_message = 'Please enter value between 1-100';
 		}
		else
		{
			
			if($projection_id<1)
			{
				$response_message = 'We are sorry, you are trying inalid access';
 			}
 			else
			{
				$row = $this->projection->get_projection_details($projection_id);
				if(!empty($row))
				{
					$annual_potential_customer_buy_one_item = $row->annual_potential_customer_buy_one_item;
					if($input_text>0)
					{
						$input_percentage = $input_text/100;
						$input_percentage = number_format($input_percentage, 2, '.', '');
						$toal = $annual_potential_customer_buy_one_item*$input_percentage;
						$toal = number_format($toal, 0, '.', '');
     				}
 					$html .='<div class="col-md-12 p-0">
								<input name="" value="'.$toal.'" class="view-input" readonly="" style=" border: 1px solid #efefef !important">
                            </div>'; 
					$response_code = 200;	
				}
				else
				{
					$response_message = 'We are sorry, you are trying inalid access';
				}
			}
		}
  		echo json_encode(array("response_code"=>$response_code,"response_message"=>$response_message,"html"=>$html));
	}
	public function get_multiple_product_price_calculation()
	{
		$this->load->model("Projection_m","projection");
		$response_message = '';
		$html = '';
		$response_code = 404;
		$projection_id = 0;
		$input_text = '';
		$multiple_product_buyer_ratio = 6;
		$additional_product_buyer_ratio = 5;
		$additional_product_price = 155;
		
		if(!empty($_POST['id']))
		{
			$projection_id  = base64_decode($_POST['id']);
		}
 		if(!empty($_POST['input_text']))
		{
			$input_text  = $_POST['input_text'];
		}
		if(!empty($_POST['multiple_product_buyer_ratio']))
		{
			$multiple_product_buyer_ratio  = $_POST['multiple_product_buyer_ratio'];
		}
		
		if(!is_numeric($input_text))
		{
			$response_message = 'Please enter valid value';
 		}
		elseif($multiple_product_buyer_ratio<1 || $multiple_product_buyer_ratio> 100)
		{
			$response_message = 'Please enter percentage of current customers another additional product percentage between 1-100';
 		}
		elseif($additional_product_buyer_ratio<1 || $additional_product_buyer_ratio>100)
		{
			$response_message = 'Please enter percentage of current customers additional product percentage between 1-100';
 		}
		elseif(!is_numeric($additional_product_price))
		{
			$response_message = 'Please enter price of additional product';
 		}
		else
		{
			
			if($projection_id<1)
			{
				$response_message = 'We are sorry, you are trying inalid access';
 			}
 			else
			{
				$row = $this->projection->get_projection_details($projection_id);
				if(!empty($row))
				{
					$toal = 0;
					$sub_total = 0;
					$roi = 0;
					$second_roi = 0;
					$current_annual_profit = 0;
					$first_scenatrio_total = 0;
					$second_scenatrio_total = 0;
					$total_scenario_value = 0;
					$potential_plus_average_price = 0;
					$second_annual_profit = 0;
					$annual_potential_customer_buy_one_item = $row->annual_potential_customer_buy_one_item;
					
					if($additional_product_buyer_ratio>0)
					{
						$additional_product_buyer_ratio_percentage = $additional_product_buyer_ratio/100;
						$additional_product_buyer_ratio_percentage = number_format($additional_product_buyer_ratio_percentage, 2, '.', '');
						$additional_product_buyer_ratio_total = $annual_potential_customer_buy_one_item* $additional_product_buyer_ratio_percentage;
						$additional_product_buyer_ratio_total = number_format($additional_product_buyer_ratio_total, 0, '.', '');
     					$first_scenatrio_total = $additional_product_buyer_ratio_total*$additional_product_price;
					}
					
 					if($input_text>0)
					{
						$input_percentage = $multiple_product_buyer_ratio/100;
						$input_percentage = number_format($input_percentage, 2, '.', '');
						$toal = $annual_potential_customer_buy_one_item*$input_percentage;
						$toal = number_format($toal, 0, '.', '');
						
						$annual_potential_customer_buy_one_item = $row->annual_potential_customer_buy_one_item;
						$average_product_price = $row->average_product_price;
						$sub_total = $annual_potential_customer_buy_one_item*$average_product_price;
						$sub_total = number_format($sub_total, 2, '.', '');
						$sub_total = round($sub_total);
						
						$total_income = $sub_total + ($toal*$input_text);
						$main_total = number_format($total_income, 2, '.', '');
						$total_income = round($total_income);
						$total_annual_expenses = $row->total_annual_expenses;
						if($total_income>$total_annual_expenses)
						{
							$current_annual_profit = $total_income-$total_annual_expenses;
						}
						
						$roi = round(($current_annual_profit/$total_annual_expenses)*100);
						
						$second_scenatrio_total = $toal*$input_text;
						
 						$potential_plus_average_price = $annual_potential_customer_buy_one_item*$average_product_price;
						$total_scenario_value = $first_scenatrio_total+$second_scenatrio_total+$potential_plus_average_price;
						$total_scenario_value = number_format($total_scenario_value, 2, '.', '');
						$total_scenario_value = round($total_scenario_value);
						if($total_scenario_value>$total_annual_expenses)
						{
 							$second_annual_profit = $total_scenario_value-$total_annual_expenses;
							$second_roi = round(($second_annual_profit/$total_annual_expenses)*100);
						}
     				}
 					$html .='<div class="col-md-12 p-0">
                                 <label class="fw-600">The annual income now would be</label>
								<input name="" value="'.custom_number_format($total_income).' &euro;" class="view-input" readonly="" style=" border: 1px solid #efefef !important">
                            </div>
                            <div class="col-md-12 p-0">
                                <label class="fw-600">ROI (Return on investment)</label>
								<input name="" value="'.$roi.'%" class="view-input" readonly="" style=" border: 1px solid #efefef !important">
                            </div>
                            <div class="col-md-12 p-0">
                                 <label class="fw-600">The total annual income updated would be</label>
								<input name="" value="'.custom_number_format($total_scenario_value).' &euro;" class="view-input" readonly="" style=" border: 1px solid #efefef !important">
                            </div>
                            <div class="col-md-12 p-0">
                                <label class="fw-600">ROI (Return on investment)</label>
								<input name="" value="'.$second_roi.'%" class="view-input" readonly="" style=" border: 1px solid #efefef !important">
                            </div>'; 
					$response_code = 200;	
				}
				else
				{
					$response_message = 'We are sorry, you are trying inalid access';
				}
			}
		}
  		echo json_encode(array("response_code"=>$response_code,"response_message"=>$response_message,"html"=>$html));
	}
	public function MainProjectionCalculation()
	{
		$this->load->model("ProjectionMain_m","projection");
		$response_message = '';
		$html = '';
		$response_code = 404;
		$possible_step_values = array('1','2','3');
		$possible_type_values = array('year','3 months','6 months');
		
		$step  = '';
		$type  = '';
		$annual_billing  = ''; 
		$achieve_goal_year = '';
		$average_product_price  = '';
		$operating_expenses  = '';
		$advertising_expenses  = '';
		$average_product_sold_cost  = ''; 
		$conversion_rate  = ''; 
		
		if(!empty($_POST['type']))
		{
			$type  = $_POST['type'];
 		}
		
		if(!empty($_POST['step']))
		{
			$step  = $_POST['step'];
		}
		
 		if(!empty($_POST['annual_billing']))
		{
			$annual_billing  = $_POST['annual_billing'];
		}
		if(!empty($_POST['achieve_goal_year']))
		{
			$achieve_goal_year  = $_POST['achieve_goal_year'];
		}
		if(!empty($_POST['average_product_price']))
		{
			$average_product_price  = $_POST['average_product_price'];
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
		
 		if(!in_array($type,$possible_type_values) || $type=='')
		{
			$response_message = 'We are sorry, you are trying inalid access';
		}
		elseif(!in_array($step,$possible_step_values)  || $step=='')
		{
			$response_message = 'We are sorry, you are trying inalid access';
		}
		elseif(empty($annual_billing) || !is_numeric($annual_billing))
		{
 			$response_message = 'Please enter valid financial goal';
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
		else
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
				
				if($type=='year')
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
					if($type=='year')
					{
						$semesterly_revenue = number_format($semesterly_product_sold*$average_product_price, 4, '.', '');
					}
					else
					{
						$semesterly_revenue = $quartley_revenue*2;
					}
				}

 				if($type=='year')
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
					if($type=='year')
					{
						$semesterly_benefits = number_format(($yearly_benefits/2), 4, '.', '');
					}
					else
					{
						$semesterly_benefits = number_format(($quartley_revenue/2), 4, '.', '');
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

				if($type=='year')
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
					if($type=='year')
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
							<td>'.round($daily_revenue).' &euro;</td>
							<td>'.round($weekly_revenue).' &euro;</td>
							<td>'.round($monthly_revenue).' &euro;</td>
							<td>'.round($quartley_revenue).' &euro;</td>';
			                $html .= "<td>".round($semesterly_revenue)." &euro;</td>";
							if($type=='year')
							{
 								$html .= "<td>".round($yearly_revenue)." &euro;</td>";
							}
			               
						   $html .= '</tr>';
 						   $html .= '<tr>
							<td>Advertising expenses</td>
							<td>'.round($daily_advertising_expenses).' &euro;</td>
							<td>'.round($weekly_advertising_expenses).' &euro;</td>
							<td>'.round($monthly_advertising_expenses).' &euro;</td>
							<td>'.round($quartley_advertising_expenses).' &euro;</td>';
			                $html .= "<td>".round($semesterly_advertising_expenses)." &euro;</td>";
							if($type=='year')
							{
								$html .= "<td>".round($yearly_advertising_expenses)." &euro;</td>";
							}
			             
						 $html .= '</tr>';
 						 $html .= '<tr>
							<td>Operating Expenses</td>
							<td>'.round($daily_operating_expenses).' &euro;</td>
							<td>'.round($weekly_operating_expenses).' &euro;</td>
							<td>'.round($monthly_operating_expenses).' &euro;</td>
							<td>'.round($quartley_operating_expenses).' &euro;</td>';
			                $html .= "<td>".round($semesterly_operating_expenses)." &euro;</td>";
						  	if($type=='year')
							{
								$html .= "<td>".round($yearly_operating_expenses)." &euro;</td>";
							}
			              
						  $html .= '</tr>';
 						  $html .= '<tr>
							<td>Cost of products / services</td>
							<td>'.round($daily_cost_of_products).' &euro;</td>
							<td>'.round($weekly_cost_of_products).' &euro;</td>
							<td>'.round($monthly_cost_of_products).' &euro;</td>
							<td>'.round($quartley_cost_of_products).' &euro;</td>';
							$html .= "<td>".round($semesterly_cost_of_products)." &euro;</td>";
						  	if($type=='year')
							{
 								$html .= "<td>".round($yearly_cost_of_products)." &euro;</td>";
							}
			               
						  $html .= '</tr>';
 						  $html .= '<tr>
							<td>Total expenses</td>
							<td>'.round($daily_total_expenses).' &euro;</td>
							<td>'.round($weekly_total_expenses).' &euro;</td>
							<td>'.round($monthly_total_expenses).' &euro;</td>
							<td>'.round($quartley_total_expenses).' &euro;</td>';
							$html .= "<td>".round($semesterly_total_expenses)." &euro;</td>";
						  	if($type=='year')
							{
 								$html .= "<td>".round($yearly_total_expenses)." &euro;</td>";
							}
			              
						  $html .= '</tr>';
 						  $html .= '<tr>
						  	<td>Benefits</td>
							<td>'.round($daily_benefits).' &euro;</td>
							<td>'.round($weekly_benefits).' &euro;</td>
							<td>'.round($monthly_benefits).' &euro;</td>
							<td>'.round($quartley_benefits).' &euro;</td>';
							$html .= "<td>".round($semesterly_benefits)." &euro;</td>";
						  	if($type=='year')
							{
 								$html .= "<td>".round($yearly_benefits)." &euro;</td>";
							}
			              
						  $html .= '</tr>';
 						  $html .= '<tr>
							<td>Qualified traffic volume to the website</td>
							<td>'.round($daily_traffic_volume).'</td>
							<td>'.round($weekly_traffic_volume).'</td>
							<td>'.round($monthly_traffic_volume).'</td>
							<td>'.round($quartley_traffic_volume).'</td>';
							$html .= "<td>".round($semesterly_traffic_volume)."</td>";
						    if($type=='year')
							{
 								$html .= "<td>".round($yearly_traffic_volume)."</td>";
							}
			              
						  $html .= '</tr>';
 						  $html .= '<tr>
							<td>Volume of web visitors that you should buy at least one product</td>
							<td>'.round($daily_website_buyer_visitor).'</td>
							<td>'.round($weekly_website_buyer_visitor).'</td>
							<td>'.round($monthly_website_buyer_visitor).'</td>
							<td>'.round($quartley_website_buyer_visitor).'</td>';
			                $html .= "<td>".round($semesterly_website_buyer_visitor)."</td>";
						    if($type=='year')
							{
 								$html .= "<td>".round($yearly_website_buyer_visitor)."</td>";
							}
			              
						  $html .= '</tr>';
 						  $html .= '<tr>
							<td>Benefits per customers</td>
							<td>'.round($benefit_per_customer).' &euro;</td>
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
			$response_code = 200;
		}
  		echo json_encode(array("response_code"=>$response_code,"response_message"=>$response_message,"html"=>$html));
	}
}
