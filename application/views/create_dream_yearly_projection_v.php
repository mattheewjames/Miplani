 <?php
if(!empty($error_message))
{
	if(!empty($user_row))
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
	?>
		<?php $this->load->view('web-common-files/projection_menu');?>
		<div class="contact_area">
			<div class="container">
				<div class="col-md-12 content" id="user_form_data">
					<form id="dream_projection_form" name="dream_projection_form" method="" action="">	       
						<div class="col-lg-12 col-md-12" id="dream-projection-data">
							<div class="contact_message form form-bg">
								<h3>Your dreamed financial goals</h3>
								<div class="col-md-12">
											<div class="red-warning">
												<span class="float-right">
													<i class="fa fa-times" aria-hidden="true"></i>
												</span>
												<p>For the Freemium Plan, the maximum amount SHOULD NOT exceed 30,000 &euro;. Being the highest Billing to be considered in other plans: 100,000,000 &euro;. For higher values, <a target="_blank" href="<?php echo base_url('pages/PricingPlan');?>" class="upgrade-link">Upgrade</a><span></span> to a higher plan!</p>
											</div>
										</div>
								<div class="col-md-3">
									<input type="text" name="annual_billing" id="annual_billing" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="">
								</div>
								 <div class="col-md-12 row p-0 m-mb-0 m-0" id="financial-goals">
										<div class="col-md-2">
											<label class="fw-600">Number of years to achieve your dream goal</label>
											<input type="number"  name="achieve_goal_year" id="achieve_goal_year" onkeypress="return isNumbericKey(event);">
										</div>
										<div class="col-md-2">
											<label class="fw-600">Average price of your products or services</label>
											<input type="number" name="average_product_price" id="average_product_price" onkeypress="return isNumbericKey(event);">
										</div>
										<div class="col-md-2">
											<label class="fw-600">% of operating expenses over revenue</label>
											<input type="number" name="operating_expenses" id="operating_expenses" onkeypress="return isNumbericKey(event);" min="1" max="100">
										</div>
										<div class="col-md-2">
											<label class="fw-600 conversion-label">% conversion rate</label>
											<input type="number" name="conversion_rate" id="conversion_rate" onkeypress="return isNumbericKey(event);" min="1" max="100">
										</div>
										<div class="col-md-2">
											<label class="fw-600">% of cost of the products / services over</label>
											<input type="number" name="average_product_sold_cost" id="average_product_sold_cost"  onkeypress="return isNumbericKey(event);" min="1" max="100">
										</div>
										<div class="col-md-2">
											<label class="fw-600">% of advertising expenses over revenue </label>
											<input name="advertising_expenses" id="advertising_expenses" type="number" onkeypress="return isNumbericKey(event);" min="1" max="100">
										</div>
									</div>
								 <div class="col-md-12 text-right mb-3 p-0">
									<button class="expense-btn check-btn" type="button" onclick="get_dream_projection_calculation('<?php echo base64_encode('Yearly');?>');">Calculate</button>
								</div>
 							
								
								<div class="col-md-12 row m-0 p-0 mt-2">
									<div class="col-md-6 col-6 text-left p-0"></div>
									<div class="col-md-6 col-6 text-right p-0 ">
										<button type="button" class="save-btn m-0" onclick="create_dream_financial_goal('<?php echo base64_encode('Yearly');?>');"> <?php echo $this->lang->line('lang_save_label');?></button>
									</div>
								</div>
								<div class="row mt-2 mb-1" id="calculation-main-div" style="display:none;"></div>
							</div>
						</div>
					</form>
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
				<p class="alert alert-danger">
					<?php echo $this->lang->line('lang_sign_in_to_continue_error');?>
				</p>
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
