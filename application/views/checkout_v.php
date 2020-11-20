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
		?>
		 	 <form name="payment" id="payment" method="post" action="<?php echo base_url('pages/Order?key_id='.base64_encode($plan_row->plan_id));?>">
				 <div class="Checkout_section mt-32">
					<div class="container">
						<div class="checkout_form">
							<div class="row">
								<div class="col-lg-6 col-md-6">
									<div class="coupon_area ">
										<div class="row">
											<div class=" col-lg-12 col-md-12">
												<div class="coupon_code left">
													<h3>Coupon</h3>
													<div class="coupon_inner row">
														<input type="text" placeholder="Enter your coupon code" id="coupon_code" id="coupon_code">
														<a class="coupon_href" href="javascript:;" onClick="get_checkout_coupon('<?php echo $_GET['key_id'];?>')"><button type="button" class="check-btn">Apply coupon</button></a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="payment_method">
										<div class="panel-default">
											<h4>Payment method:</h4>
											<input type="radio" name="payment_method" id="payment_paypal" checked value="paypal" />
											<label>PayPal <img src="<?php echo base_url('WebTheme/assets/img/icon/paypal2.jpg');?>" style="width: auto;"></label>
										 </div>
										<div class="panel-default">
											<input type="radio" name="payment_method" id="payment_card" value="card"/>
											<label>Credit Card <img src="<?php echo base_url('WebTheme/assets/img/icon/papyel.png');?>"></label>
										 </div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6" id="checkout-data">
									<h3>Your package : <?php echo $plan_row->plan_name;?></h3>
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
												<td><strong>$<?php echo $plan_row->plan_price;?></strong></td>
											</tr>
											<tr class="order_total">
												<th>Total</th>
												<td><strong>$<?php echo $plan_row->plan_price;?></strong></td>
											</tr>
											</tfoot>
										</table>
									</div>
									<div class="order_button pull-right">
										<button type="submit" id="sub" name="sub">Proceed</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
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
	 