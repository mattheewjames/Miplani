<?php
if(empty($error_message))
{
	$back_url = '';
	if(!empty($row))
	{
		if($row->projection_type=='Yearly')
		{
			$back_url = base_url('dreamProjection');
		}
		elseif($row->projection_type=='6 Months')
		{
			$back_url = base_url('dreamProjection/Biannual');
		}
		elseif($row->projection_type=='3 Months')
		{
			$back_url = base_url('dreamProjection/Quarterly');
		}
		$html = '';
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
				$main_days= 183;
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
						<td>'.custom_number_format(round($daily_revenue)).' €</td>
						<td>'.custom_number_format(round($weekly_revenue)).' €</td>
						<td>'.custom_number_format(round($monthly_revenue)).' €</td>
						<td>'.custom_number_format(round($quartley_revenue)).' €</td>';
						$html .= "<td>".custom_number_format(round($semesterly_revenue))." €</td>";
						if($projection_type=='Yearly')
						{
							$html .= "<td>".custom_number_format(round($yearly_revenue))." €</td>";
						}

					   $html .= '</tr>';
					   $html .= '<tr>
						<td>Advertising expenses</td>
						<td>'.custom_number_format(round($daily_advertising_expenses)).' €</td>
						<td>'.custom_number_format(round($weekly_advertising_expenses)).' €</td>
						<td>'.custom_number_format(round($monthly_advertising_expenses)).' €</td>
						<td>'.custom_number_format(round($quartley_advertising_expenses)).' €</td>';
						$html .= "<td>".custom_number_format(round($semesterly_advertising_expenses))." €</td>";
						if($projection_type=='Yearly')
						{
							$html .= "<td>".custom_number_format(round($yearly_advertising_expenses))." €</td>";
						}

					 $html .= '</tr>';
					 $html .= '<tr>
						<td>Operating Expenses</td>
						<td>'.custom_number_format(round($daily_operating_expenses)).' €</td>
						<td>'.custom_number_format(round($weekly_operating_expenses)).' €</td>
						<td>'.custom_number_format(round($monthly_operating_expenses)).' €</td>
						<td>'.custom_number_format(round($quartley_operating_expenses)).' €</td>';
						$html .= "<td>".custom_number_format(round($semesterly_operating_expenses))." €</td>";
						if($projection_type=='Yearly')
						{
							$html .= "<td>".custom_number_format(round($yearly_operating_expenses))." €</td>";
						}

					  $html .= '</tr>';
					  $html .= '<tr>
						<td>Cost of products / services</td>
						<td>'.custom_number_format(round($daily_cost_of_products)).' €</td>
						<td>'.custom_number_format(round($weekly_cost_of_products)).' €</td>
						<td>'.custom_number_format(round($monthly_cost_of_products)).' €</td>
						<td>'.custom_number_format(round($quartley_cost_of_products)).' €</td>';
						$html .= "<td>".custom_number_format(round($semesterly_cost_of_products))." €</td>";
						if($projection_type=='Yearly')
						{
							$html .= "<td>".custom_number_format(round($yearly_cost_of_products))." €</td>";
						}

					  $html .= '</tr>';
					  $html .= '<tr>
						<td>Total expenses</td>
						<td>'.custom_number_format(round($daily_total_expenses)).' €</td>
						<td>'.custom_number_format(round($weekly_total_expenses)).' €</td>
						<td>'.custom_number_format(round($monthly_total_expenses)).' €</td>
						<td>'.custom_number_format(round($quartley_total_expenses)).' €</td>';
						$html .= "<td>".custom_number_format(round($semesterly_total_expenses))." €</td>";
						if($projection_type=='Yearly')
						{
							$html .= "<td>".custom_number_format(round($yearly_total_expenses))." €</td>";
						}

					  $html .= '</tr>';
					  $html .= '<tr>
						<td>Benefits</td>
						<td>'.custom_number_format(round($daily_benefits)).' €</td>
						<td>'.custom_number_format(round($weekly_benefits)).' €</td>
						<td>'.custom_number_format(round($monthly_benefits)).' €</td>
						<td>'.custom_number_format(round($quartley_benefits)).' €</td>';
						$html .= "<td>".custom_number_format(round($semesterly_benefits))." €</td>";
						if($projection_type=='Yearly')
						{
							$html .= "<td>".custom_number_format(round($yearly_benefits))." €</td>";
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
						<td>'.custom_number_format(round($benefit_per_customer)).' €</td>
					  </tr>
					  <tr>
						<td>ROI (Return on investment)</td>
						<td>'.round($roi).'%</td>
					  </tr>
					  <tr>
						<td>ROI (Monetary value)</td>
						<td>'.custom_number_format(round($roi_monetary)).' €</td>
					  </tr>
					</table>
				</div>';
 			?>
			<div class="unlimited_services m-0" id="pricing-plan">
				<div class="container">
					<div class="col-md-12 text-center"><h1>SUMMARY</h1></div>
				</div>
			</div>
			<div class="priceing_table bg-white" id="pricing-home">
				<div class="container">
					<div class="row">
						<div class="col-md-12 text-right mb-2">
							<a href="javascript:;" onClick="printData();"><button type="button" class="print-btn">Print</button></a>
							<?php
							if(!empty($this->session->userdata('MiPlani_user_id')))
							{
							?>
								<a href="<?php echo $back_url;?>"><button type="button" class="print-btn">Back</button></a>
							<?php	
							}
							?>
 						</div>
 						<?php echo $html;?> 
					</div>
				</div>
			</div>
 	<?php
	}
	else
	{
	?>
		<div class="contact_area">
			<div class="container">
				<p class="alert alert-danger">Please select valid record!</p>
			</div>
		</div>
	<?php
	}
}
else
{
?>
	<div class="contact_area">
		<div class="container">
			<p class="alert alert-danger"><?php echo $error_message;?></p>
		</div>
	</div>
<?php
}
?>
