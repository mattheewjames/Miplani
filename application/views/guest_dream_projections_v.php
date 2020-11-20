 <?php
if(empty($error_message))
{
	if(!empty($invite_row))
	{
		if(!empty($row))
		{
			if($invite_row->permission=='view')
			{
			?>
				<?php $this->load->view('web-common-files/projection_menu');?>
				<div class="contact_area">
					<div class="container">
						<div class="col-md-12 content" id="user_form_data">
							<div class="col-lg-12 col-md-12" id="dream-projection-data">
								<div class="contact_message form form-bg">
									<?php
									if($row->projection_type=='Yearly')
									{
									?>
										<h3>Your dreamed financial goals</h3>
									<?php
									}
									elseif($row->projection_type=='6 Months')
									{
									?>
										<h3>Your dreamed financial goal in 6 months</h3>
									<?php
									}
									elseif($row->projection_type=='3 Months')
									{
									?>
										<h3>Your dreamed financial goal in 3 months</h3>
									<?php
									}
									?>
									<div class="col-md-3">
										<input type="text" name="annual_billing" id="annual_billing" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" value="<?php echo $row->annual_billing;?>" disabled>
									</div>
									 <div class="col-md-12 row p-0 m-mb-0 m-0" id="financial-goals">
											<?php
											if($row->projection_type=='Yearly')
											{
											?>
												<div class="col-md-2">
													<label class="fw-600">Number of years to achieve your dream goal</label>
													<input type="number" name="achieve_goal_year" id="achieve_goal_year" onkeypress="return isNumbericKey(event);" value="<?php echo $row->achieve_goal_year;?>" disabled>
												</div>
											<?php
											}
											?>
											<div class="col-md-2">
												<label class="fw-600">Average price of your products or services</label>
												<input type="text" name="average_product_price" id="average_product_price" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" value="<?php echo $row->average_product_price;?>" disabled>
											</div>
											<div class="col-md-2">
												<label class="fw-600">% of operating expenses over revenue</label>
												<input type="number" name="operating_expenses" id="operating_expenses" onkeypress="return isNumbericKey(event);" min="1" max="100" value="<?php echo $row->operating_expenses;?>" disabled>
											</div>
											<div class="col-md-2">
												<label class="fw-600 conversion-label">% conversion rate</label>
												<input type="number" name="conversion_rate" id="conversion_rate" onkeypress="return isNumbericKey(event);" min="1" max="100" value="<?php echo $row->conversion_rate;?>" disabled>
											</div>
											<div class="col-md-2">
												<label class="fw-600">% of cost of the products / services over</label>
												<input type="number" name="average_product_sold_cost" id="average_product_sold_cost" placeholder="" onkeypress="return isNumbericKey(event);" min="1" max="100" value="<?php echo $row->average_product_sold_cost;?>" disabled>
											</div>
											<div class="col-md-2">
												<label class="fw-600">% of advertising expenses over revenue </label>
												<input type="number" name="advertising_expenses" id="advertising_expenses" onkeypress="return isNumbericKey(event);" min="1" max="100" value="<?php echo $row->advertising_expenses;?>" disabled>
											</div>
										</div>
									 <div class="col-md-12 text-right mb-3 p-0">
										<button class="expense-btn check-btn" type="button" onclick="get_guest_dream_projection_calculation('<?php echo base64_encode($row->projection_type);?>','<?php echo $_GET['key'];?>')">Calculate</button>
									</div>
									<div class="row mt-1 mb-1" id="calculation-main-div" style="display:none;"></div>
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
						<div class="col-md-12 content" id="user_form_data">
							<form id="dream_projection_form" name="dream_projection_form" method="" action="">	       
								<div class="col-lg-12 col-md-12" id="dream-projection-data">
									<div class="contact_message form form-bg">
										<?php
										if($row->projection_type=='Yearly')
										{
										?>
											<h3>Your dreamed financial goals</h3>
										<?php
										}
										elseif($row->projection_type=='6 Months')
										{
										?>
											<h3>Your dreamed financial goal in 6 months</h3>
										<?php
										}
										elseif($row->projection_type=='3 Months')
										{
										?>
											<h3>Your dreamed financial goal in 3 months</h3>
										<?php
										}
										?>
										<div class="col-md-3">
											<input type="text" name="annual_billing" id="annual_billing" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" value="<?php echo $row->annual_billing;?>">
										</div>
										 <div class="col-md-12 row p-0 m-mb-0 m-0" id="financial-goals">
												<?php
												if($row->projection_type=='Yearly')
												{
												?>
													<div class="col-md-2">
														<label class="fw-600">Number of years to achieve your dream goal</label>
														<input type="number" name="achieve_goal_year" id="achieve_goal_year" onkeypress="return isNumbericKey(event);" value="<?php echo $row->achieve_goal_year;?>">
													</div>
												<?php
												}
												?>
												<div class="col-md-2">
													<label class="fw-600">Average price of your products or services</label>
													<input type="text" name="average_product_price" id="average_product_price" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" value="<?php echo $row->average_product_price;?>">
												</div>
												<div class="col-md-2">
													<label class="fw-600">% of operating expenses over revenue</label>
													<input type="number" name="operating_expenses" id="operating_expenses" onkeypress="return isNumbericKey(event);" min="1" max="100" value="<?php echo $row->operating_expenses;?>">
												</div>
												<div class="col-md-2">
													<label class="fw-600 conversion-label">% conversion rate</label>
													<input type="number" name="conversion_rate" id="conversion_rate" onkeypress="return isNumbericKey(event);" min="1" max="100" value="<?php echo $row->conversion_rate;?>">
												</div>
												<div class="col-md-2">
													<label class="fw-600">% of cost of the products / services over</label>
													<input type="number" name="average_product_sold_cost" id="average_product_sold_cost" onkeypress="return isNumbericKey(event);" min="1" max="100" value="<?php echo $row->average_product_sold_cost;?>">
												</div>
												<div class="col-md-2">
													<label class="fw-600">% of advertising expenses over revenue </label>
													<input type="number" name="advertising_expenses" id="advertising_expenses" onkeypress="return isNumbericKey(event);" min="1" max="100" value="<?php echo $row->advertising_expenses;?>">
												</div>
											</div>
										 <div class="col-md-12 text-right mb-3 p-0">
											<button class="expense-btn check-btn" type="button" onclick="get_guest_dream_projection_calculation('<?php echo base64_encode($row->projection_type);?>','<?php echo $_GET['key'];?>')">Calculate</button>
										</div>
										<div class="col-md-12 row m-0 p-0">
											<div class="col-md-6 col-6 text-left p-0"></div>
											<div class="col-md-6 col-6 text-right p-0 form-btns">
												<input type="hidden" id="pid" name="pid" value="<?php echo base64_encode($row->projection_id);?>">
												<button type="button" class="save-btn" onclick="guest_dream_financial_goal('<?php echo $invite_row->key_url;?>','<?php echo base64_encode($row->projection_type);?>');"> <?php echo $this->lang->line('lang_save_label');?></button>
											</div>
										</div>
										<div class="row mt-1 mb-1" id="calculation-main-div" style="display:none;"></div>
									</div>
								</div>
							</form>
						</div>
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
				<p class="alert alert-danger">We are sorry, You are trying to access invalid page</p>
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
