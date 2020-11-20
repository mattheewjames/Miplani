  <div class="unlimited_services" id="pricing-plan">
	<div class="container">
	<div class="col-md-12 text-center"><h1>Checkout</h1></div>
	</div>
</div>
<?php
if(empty($error_message))
{
	if(!empty($user_row))
	{
		if(!empty($plan_row))
		{
			$sub_total = $plan_row->plan_price;
			$total = $plan_row->plan_price;	
		?>
	 	   		<div class="Checkout_section mt-32">
					<div class="container">
						<div class="checkout_form">
							<div class="row">
 								<div class="col-lg-6 col-md-6" id="checkout-data">
									<h3>Your package : <?php echo $plan_row->plan_name;?></h3>
									<div class="order_table table-responsive">
										<table>
 											<tfoot>
											<tr>
												<th>Package price</th>
												<td><strong>$<?php echo $plan_row->plan_price;?></strong></td>
 											</tr>
											<?php
											if(!empty($coupon_code))
											{
											?>
												<tr>
													<th>Coupon Code</th>
													<td><strong>$<?php echo $coupon_code;?></strong></td>
 												</tr>
												<?php
												if(!empty($total_discount))
												{
													$total = $plan_row->plan_price-$total_discount;
												?>
													<tr>
														<th>Discount</th>
														<td><strong>$<?php echo $total_discount;?></strong></td>
													</tr>
												<?php	
												}
												?>
											<?php	
											}
											?>
											<tr class="order_total">
												<th>Sub Total</th>
												<td><strong>$<?php echo $sub_total;?></strong></td>
											</tr>
											<tr>
												<th>Total</th>
												<td><strong>$<?php echo $total;?></strong></td>
 											</tr>
											</tfoot>
										</table>
									</div>
								</div>
								<div class="col-lg-6 col-md-6" id="checkout-data">
									 <div class="card-payment">
										<div id="paymentSection">
											<form method="post" id="paymentForm">
												<?php
												if(!empty($_GET['key_id']))
												{
												?>
													<input type="hidden" id="key_id" name="key_id" value="<?php echo $_GET['key_id'];?>">
												<?php
												}
												else
												{
												?>
													<input type="hidden" id="key_id" name="key_id">
												<?php	
												}
												?>
												<?php
												if(!empty($_GET['code']))
												{
												?>
													<input type="hidden" id="code" name="code" value="<?php echo $_GET['code'];?>">
												<?php
												}
												else
												{
												?>
													<input type="hidden" id="code" name="code">
												<?php	
												}
												?>
												<div class="coupon_inner row">
													<label for="expiry_month" class="checkout_label">Card number</label>&nbsp;&nbsp;
													<input type="text" placeholder="1234 5678 9012 3456" id="card_number">
												</div> 
												<div class="coupon_inner row">
													<label for="expiry_month" class="checkout_label">Expiry month</label>&nbsp;&nbsp;
													<input type="text" placeholder="MM" maxlength="5" id="expiry_month">
												</div> 
												<div class="coupon_inner row">
													<label for="expiry_year" class="checkout_label">Expiry year</label>&nbsp;&nbsp;
													<input type="text" placeholder="YYYY" maxlength="5" id="expiry_year">
												</div> 
												<div class="coupon_inner row">
													<label for="cvv" class="checkout_label">CVV</label>&nbsp;&nbsp;
													<input type="text" placeholder="123" maxlength="3" id="cvv" >
												</div> 
												<div class="coupon_inner row">
													<label for="name_on_card" class="checkout_label">Name on card</label>&nbsp;&nbsp;
													<input type="text" placeholder="John" id="name_on_card">
												</div>
												<div class="order_button pull-right">
													<button type="button" id="cardSubmitBtn" value="Proceed" class="payment-btn">Proceed</button>
												</div>
 											</form>
										</div>
										<div class="cardInfo" style="display: none;"></div>
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
			<div class="header_bottom bottom_two" id="bottom-header">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-md-12 row m-0 p-0 mb-2">
							<div class="register-btns"><p style="font-size:24px;">
								<a href="<?php echo base_url('pages/PricingPlan');?>">Please select valid pricing plan to continue!</a></p>
							</div>
						</div> 
					</div>
				</div>
			</div>
		<?php
		}
	}
	else
	{
	?>
		<div class="header_bottom bottom_two" id="bottom-header">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-12 row m-0 p-0 mb-2">
						<div class="register-btns"><p style="font-size:24px;">Please login or signup to continue</p></div>
					</div> 
					<div class="col-md-12 row m-0 p-0">
						<div class="register-btns">
							<a class="button" id="signup-btn" href="<?php echo base_url('users/SignUp');?>">Sign Up</a>
							<a class="button" id="signin-btn" href="<?php echo base_url('users/SignIn');?>">Sign In</a>
						</div>
 					</div>
 				</div>
			</div>
		</div>
	<?php
	}
}
else
{
?>
	<div class="header_bottom bottom_two" id="bottom-header">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-12 row m-0 p-0 mb-2">
					<div class="register-btns"><p style="font-size:24px;">Please login or signup to continue</p></div>
				</div>
				<div class="col-md-12 row m-0 p-0">
 					<div class="register-btns">
						<a class="button" id="signup-btn" href="<?php echo base_url('users/SignUp');?>">Sign Up</a>
						<a class="button" id="signin-btn" href="<?php echo base_url('users/SignIn');?>">Sign In</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
}
?>
	 