<?php
if(empty($error_message))
{
	if(!empty($row))
	{
 	?>
     <div class="unlimited_services m-0" id="pricing-plan">
        <div class="container">
        	<div class="col-md-12 text-center"><h1>SUMMARY</h1></div>
        </div>
    </div>
     <div class="priceing_table bg-white" id="pricing-home">
        <div class="container">
            <div class="row">
                <div class="col-12 row p-0 m-0">
                    <div class="col-md-10">
                        <div class="services_title text-left mb-2"></div>
                    </div>
                    <div class="col-md-2 text-right mb-2">
                    	<a href="javascript:;" onClick="printData();"><button type="button" class="print-btn">Print</button></a>
                    	<?php
						if(!empty($this->session->userdata('MiPlani_user_id')))
						{
						?>
							<a href="<?php echo base_url('projections');?>"><button type="button" class="print-btn">Back</button></a>
						<?php	
						}
						?>
                    </div>
                </div>
            </div>
            <div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="contact_message form form-bg" >
						<div id="projection-contents">
							<table id="expenses">
								<tr>
									<th colspan="2">Project summary</th>
								</tr>
								<tr>
									<td>Your established financial goal</td>
									<td><?php echo custom_number_format($row->annual_billing);?> €</td>
								</tr>
								<tr>
									<td>Your established average price for the products / services to be sold</td>
									<td><?php echo custom_number_format($row->average_product_price);?> €</td>
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
											<td><?php echo custom_number_format($row->daily_revenue);?> €</td>
										</tr>
										<tr>
											<td>Weekly revenue</td>
											<td><?php echo custom_number_format($row->weekly_revenue);?> €</td>
										</tr>
										<tr>
											<td>Monthly revenue</td>
											<td><?php echo custom_number_format($row->monthly_revenue);?> €</td>
										</tr>
										<tr>
											<td>Quarterly revenue</td>
											<td><?php echo custom_number_format($row->quaterly_revenue);?> €</td>
										</tr>
										<tr>
											<td>Annual revenue</td>
											<td><?php echo custom_number_format($row->annual_revenue);?> €</td>
										</tr>
									</table>
								</div>
								<?php
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
								?>
								<div class="col-md-6">
									<table id="expenses">
										<tr>
											<th colspan="2">Profits earned</th>
										</tr>
										<tr>
											<td>Daily benefits</td>
											<td><?php echo custom_number_format($daily_benefits);?> €</td>
										</tr>
										<tr>
											<td>Weekly benefits</td>
											<td><?php echo custom_number_format($weekly_benefits);?> €</td>
										</tr>
										<tr>
											<td>Monthly benefits</td>
											<td><?php echo custom_number_format($monthly_benefits);?> €</td>
										</tr>
										<tr>
											<td>Quarterly benefits</td>
											<td><?php echo custom_number_format($quaterly_benefits);?> €</td>
										</tr>
										<tr>
											<td>Annual benefits</td>
											<td><?php echo custom_number_format($annual_benefits);?> €</td>
										</tr>
									</table>
								</div>
							</div>
							<div class="col-dm-12">
								<table id="expenses">
									<tr>
										<th colspan="2">General expenses €</th>
									</tr>
									<tr>
										<td>Total expenses / day</td>
										<td><?php echo custom_number_format($row->total_daily_expenses);?> €</td>
									</tr>
									<tr>
										<td>Total expenses / week</td>
										<td><?php echo custom_number_format($row->total_weekly_expenses);?> €</td>
									</tr>
									<tr>
										<td>Total expenses / month</td>
										<td><?php echo $row->total_monthly_expenses;?> €</td>
									</tr>
									<tr>
										<td>Total expenses / quarter</td>
										<td><?php echo custom_number_format($row->total_quaterly_expenses);?> €</td>
									</tr>
									<tr>
										<td>Total expenses / year</td>
										<td><?php echo custom_number_format($row->total_annual_expenses);?> €</td>
									</tr>
									<tr>
										<td>ROI (Return on investment)</td>
										<td><?php echo round($roi);?>%</td>
									</tr>
									<tr>
										<td>ROI (Monetary value)</td>
										<td><?php echo  round($roi_monetary);?> €</td>
									</tr>
								</table>
							</div>
							<div class="col-dm-12">
								<table id="expenses">
									<tr>
										<td>Your established conversion rate</td>
										<td><?php echo round($row->conversion_rate);?>%</td>
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
											<td><?php echo custom_number_format($row->daily_qualified_web_traffic_volume);?></td>
										</tr>
										<tr>
											<td>Qualified weekly traffic</td>
											<td><?php echo custom_number_format($row->weekly_qualified_web_traffic_volume);?></td>
										</tr>
										<tr>
											<td>Qualified monthly traffic</td>
											<td><?php echo custom_number_format($row->monthly_qualified_web_traffic_volume);?></td>
										</tr>
										<tr>
											<td>Qualified quarterly traffic</td>
											<td><?php echo custom_number_format($row->quarterly_qualified_web_traffic_volume);?></td>
										</tr>
										<tr>
											<td>Qualified annual traffic</td>
											<td><?php echo custom_number_format($row->annual_qualified_web_traffic_volume);?></td>
										</tr>
									</table>
								</div>
								<div class="col-md-6">
									<table id="expenses">
										<tr>
											<th colspan="2">Number of paying customers needed</th>
										</tr>
										<tr>
											<td>Number of daily clients required</td>
											<td><?php echo custom_number_format($row->daily_potential_customer_buy_one_item);?></td>
										</tr>
										<tr>
											<td>Number of weekly clients required</td>
											<td><?php echo custom_number_format($row->weekly_potential_customer_buy_one_item);?></td>
										</tr>
										<tr>
											<td>Number of monthly clients required</td>
											<td><?php echo custom_number_format($row->monthly_potential_customer_buy_one_item);?></td>
										</tr>
										<tr>
											<td>Number of quarterly clients required</td>
											<td><?php echo custom_number_format($row->quarterly_potential_customer_buy_one_item);?></td>
										</tr>
										<tr>
											<td>Number of annual clients required</td>
											<td><?php echo custom_number_format($row->annual_potential_customer_buy_one_item);?></td>
										</tr>
									</table>
								</div>
							</div>
 					 	</div>
						<div class="col-md-12">
							<div class="comments_form">
								<h3>Leave a Comment</h3>
								<form action="" method="post" name="comment_form_data" id="comment_form_data" class="mb-4 col-md-12">
									<div class="row">
										<div class="col-lg-12 col-md-12 alert alert-danger" id="comment_error_div" style="display: none;"></div>
										<div class="col-lg-12 col-md-12 alert alert-success" id="comment_success_div" style="display: none;"></div>
										<div class="col-lg-6 col-md-6">
											<label for="author">Name</label>
											<input name="name" id="name" type="text">
										</div>
										<div class="col-lg-6 col-md-6">
											<label for="email">Email </label>
											<input id="email" name="email" type="text">
										</div>
									</div>
									<div class="col-12 p-0">
										<label for="review_comment">Comment </label>
										<textarea name="comments" id="comments"></textarea>
									</div>
									<div class="col-md-12 text-right p-0">
										<input type="hidden" id="projection_id" name="projection_id" value="<?php echo base64_encode($row->projection_id);?>">
										<button name="comment_form_btn" id="comment_form_btn" class="button check-btn" type="submit" onClick="projection_comment('<?php echo base64_encode('5');?>');">Submit</button>
									</div>
								</form>
							</div>
							<div class="comments_box" id="comment-data-div"></div>
						</div>
					</div>
				</div>
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
