<div class="unlimited_services" id="pricing-plan">
	<div class="container">
	<div class="col-md-12 text-center"><h1>My Plans</h1></div>
	</div>
</div>
 <?php
if(empty($error_message))
{
	if(!empty($payment_list))
	{
 	?>
 		
 		<div class="priceing_table" style="background: #fff;">
			<div class="container">
				<div class="row">
				   <table class="table table-striped table-bordered zero-configuration">
					  <thead>
						<tr>
						  <th>Payment Type</th>
						  <th>Start Date</th>
						  <th>End date</th>
						  <th>Paid Amount</th>
						  <th>Discount</th>
						  <th>Status</th>
						  
						</tr>
					  </thead>
					  <tbody>
					  	<?php
						if(!empty($payment_list))
						{
							foreach($payment_list as $val)
							{
								if($val->plan_type=='free')
								{
									$pl_name = 'Free';
									$expiry_date = 'Free';
								}
								elseif($val->plan_type=='monthly')
								{
									$pl_name = 'Monthly';
									$expiry_date = date('D m, Y',$val->payment_expiry_date);
								}
								elseif($val->plan_type=='annual')
								{
									$pl_name = 'Annual';
									$expiry_date = date('D m, Y',$val->payment_expiry_date);
								}
								elseif($val->plan_type=='life time')
								{
									$pl_name = 'Life Time';
									$expiry_date = 'Life Time';
								}
							?>
								<tr>
									<td><?php echo $pl_name;?></td>
									<td><?php echo date('D m, Y',$val->payment_start_date);?></td>
									<td><?php echo $expiry_date;?></td>
									<td>$<?php echo $val->user_paid_amount;?></td>
									<td>$<?php echo $val->discount_amount;?></td>
									<td><?php echo $val->payment_status;?></td>
								</tr>
								<div class="col-md-12 border-bottom" id="bottom-header">
								<div class="row m-0 align-items-center">
								<div class="col-12">
								<div class="middel_right">
								<div class="text-center">
								<a href="<?php echo base_url('pages/PricingPlan');?>"
									class="btn btn-primary">Change Plan</a>
									<a href="<?php echo base_url('panel/downloadinvoice');?>"
									class="btn btn-success">Download Invoice</a>
									<a class="btn btn-primary" href="<?php echo base_url('panel/Payments');?>">My Plans</a>
									<a href="<?php echo base_url('panel/cancelplan/'.$val->payment_id);?>"
									class="btn btn-danger">Cancel Plan</a>
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
							<tr><td colspan="6" align="center"><span class="red">No Record Found!</span></td></tr>
						<?php	
						}
						?>
					  </tbody>
					</table>
				</div>
			</div>
		</div>
	<?php
	}
	else
	{
	?>
		<div class="priceing_table" style="background: #fff;">
			<div class="container">
				<div class="row">
				   <table class="table table-striped table-bordered zero-configuration">
					  <thead>
						<tr>
						  <th>Payment Type</th>
						  <th>Start Date</th>
						  <th>End date</th>
						  <th>Paid Amount</th>
						  <th>Discount</th>
						  <th>Status</th>
						  
						</tr>
					  </thead>
					  <tbody>
					  	<?php
						if(!empty($user_list))
						{
							foreach($user_list as $val)
							{
								
							?>
								<tr>
									<td><?php echo $val->current_subscription_type;?></td>
									<td>NULL</td>
									<td>NULL</td>
									<td>NULL</td>
									<td>NULL</td>
									<td><?php echo $val->user_payment_status;?></td>
								</tr>
								<div class="col-md-12 border-bottom" id="bottom-header">
								<div class="row m-0 align-items-center">
								<div class="col-12">
								<div class="middel_right">
								<div class="text-center">
								<a href="<?php echo base_url('pages/PricingPlan');?>"
									class="btn btn-primary">Change Plan</a>
									<a href="<?php echo base_url('panel/downloadinvoice');?>"
									class="btn btn-success">Download Invoice</a>
									<a class="btn btn-primary" href="<?php echo base_url('panel/Payments');?>">My Plans</a>
								
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
							<tr><td colspan="6" align="center"><span class="red">No Record Found!</span></td></tr>
						<?php	
						}
						?>
					  </tbody>
					</table>
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
			<p class="alert alert-danger"><?php echo $error_message;?></p>
		</div>
	</div>
<?php
}
?>
