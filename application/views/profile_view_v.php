<div class="unlimited_services" id="pricing-plan">
	<div class="container">
	<div class="col-md-12 text-center"><h1><?php echo  $this->lang->line('lang_my_profile_label'); ?></h1></div>
	</div>
</div>
<?php $this->load->view('web-common-files/profile_menu');?>
<!--contact area start-->
<div class="contact_area">
	<div class="container">
		<?php
		if(empty($error_message))
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
			<div class="profile-card">
				<div class="row">
					 <div class="col-lg-12 col-md-12">
						<div class="col-md-12 p-0">
							<h3 class="p-0-mb"><?php echo $this->lang->line('lang_personal_information_label');?></h3>
						</div>
						<div class="col-lg-12 col-md-12  m-0 p-0 profile-field">
						  <div class="row m-0">
								<div class="col-md-4 p-0">
									<label  class="fw-600"><?php echo $this->lang->line('lang_first_name_label');?>:</label>
									<span ><?php echo $user_row->first_name;?></span>
								</div>
								<div class="col-md-4 p-0">
									<label  class="fw-600"><?php echo $this->lang->line('lang_last_name_label');?>:</label>
									<?php echo $user_row->last_name;?>
								</div>
								<div class="col-md-4 p-0">
									<label  class="fw-600"><?php echo $this->lang->line('lang_username_label');?>:</label>
									<?php echo $user_row->username;?>
								</div>
								<div class="col-md-4 p-0">
									<label class="fw-600"><?php echo $this->lang->line('lang_email_address_label');?>:</label>
									<?php echo $user_row->user_email;?>
								</div>
						   </div>
					   </div>
 					</div>
					<div class="col-lg-12 col-md-12 mt-3 border-top">&nbsp;&nbsp;&nbsp;</div>
 					<div class="col-lg-12 col-md-12">
						<h3><?php echo $this->lang->line('lang_current_plan_info_label');?></h3>
						<div class="row m-0">
						<div class="col-md-4 p-0">
							<label  class="fw-600"><?php echo $this->lang->line('lang_type_of_subscription_label');?>:</label>
							<?php echo $current_subscription;?>
						</div> 
						<?php
						if(!empty($user_row->current_subscription_type))
						{
							if($user_row->current_subscription_type!='Free' && $user_row->current_subscription_type!='Lifetime')
							{
							?>
								<div class="col-md-4 p-0">
									<label  class="fw-600">Start Date:</label>
									<?php echo date('d M,Y',$user_row->subscription_start_date);?>
								</div> 
								<div class="col-md-4 p-0">
									<label  class="fw-600">Expiry Date:</label>
									<?php echo date('d M,Y',$user_row->subscription_end_date);?>
								</div> 
							<?php	
							}
						}
						?>
						</div>
 					</div>
					<div class="col-lg-12 col-md-12 mt-3 border-top">&nbsp;&nbsp;&nbsp;</div>
					<div class="col-lg-12 col-md-12">
						<h3><?php echo $this->lang->line('lang_Projection_Details_label');?> </h3>
						<div class="row m-0">
						<div class="col-md-3 p-0">
							<label  class="fw-600"> <?php echo $this->lang->line('lang_Total_Annual_Financial_Goals_label');?>:</label>
							<?php echo total_user_active_projections($user_row->user_id,'annual');?>
						</div> 
						<div class="col-md-3 p-0">
							<label  class="fw-600"><?php echo $this->lang->line('lang_Total_Dream_Financial_Goals_label');?>:</label>
							<?php echo total_user_active_projections($user_row->user_id,'Yearly');?>
						</div> 
						<div class="col-md-3 p-0">
							<label  class="fw-600"><?php echo $this->lang->line('lang_Total_Dream_Bi-Annual_Goals_label');?>:</label>
							<?php echo total_user_active_projections($user_row->user_id,'6 Months');?>
						</div> 
						<div class="col-md-3 p-0">
							<label  class="fw-600"><?php echo $this->lang->line('lang_Total_Dream_Quarterly_Goals_label');?>:</label>
							<?php echo total_user_active_projections($user_row->user_id,'3 Months');?>
						</div>  
						</div>
					</div>
					<div class="col-lg-12 col-md-12 mt-3 border-top">&nbsp;&nbsp;&nbsp;</div>
					<div class="col-lg-12 col-md-12">
						<h3><?php echo $this->lang->line('lang_shared_with_friends_label');?></h3>
						<div class="col-md-12 p-0">
							<label  class="fw-600"><?php echo $this->lang->line('lang_Total_Share_label');?>:</label>
							<?php echo user_total_shares_projections($user_row->user_id);?>
						</div> 
					</div>
			
				</div>
			</div>
			<?php
			}
			else
			{
				echo '<p class="alert alert-danger">'.$this->lang->line('lang_sign_in_to_continue_error').'</p>';
			}
		}
		else
		{
			echo '<p class="alert alert-danger">'.$error_message.'</p>'; 
		}
		?>
	</div>
</div>