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
		<?php $this->load->view('web-common-files/projection_menu');?>
		<div class="contact_area">
			<div class="container">
				<form id="projection_form" name="projection_form" method="" action="">
					<div class="col-md-12 content" id="projection_data">
						<div class="col-lg-12 col-md-12">
							<div class="contact_message form form-bg">
								<h3><?php echo $this->lang->line('lang_personal_information_label');?></h3>

								<div class="row">
									<div class="col-lg-3 col-md-6">
										<p>
											<label class="fw-600"><?php echo $this->lang->line('lang_first_name_label');?></label>
											<input type="text" value="<?php echo $user_row->first_name;?>" class="view-input" readonly style=" border: 1px solid #efefef !important">
										</p>
									</div>
									<div class="col-lg-3 col-md-6">
										<p>
											<label class="fw-600"><?php echo $this->lang->line('lang_last_name_label');?></label>
										   <input type="text" value="<?php echo $user_row->last_name;?>" readonly class="view-input" style=" border: 1px solid #efefef !important">
										</p>
									</div>
									<div class="col-lg-3 col-md-6">
										<p>
											<label class="fw-600"><?php echo $this->lang->line('lang_lemail_address_label');?></label>
											 <input type="text" value="<?php echo $user_row->user_email;?>" readonly class="view-input" style=" border: 1px solid #efefef !important">
										</p>
									</div>
									 <div class="col-lg-3 col-md-6">
										<p>
											<label class="fw-600"><?php echo $this->lang->line('lang_type_of_subscription_label');?></label>
											<input value="<?php echo $current_subscription;?>" type="text" class="view-input" readonly style="border: 1px solid #efefef !important">
										</p>
									</div>
								</div>
								 <div class="col-md-12 p-0 text-left">
									<h4><?php echo $this->lang->line('lang_projection_name_label');?></h4>
								 </div>
								<div class="row">
									<div class="offset-md-3 col-md-6">
										<p>
											
											<label class="fw-600"></label>
											<input name="projection_name" id="projection_name" placeholder="<?php echo $this->lang->line('lang_enter_projection_name_label');?>" type="text">
										</p>
									</div>
								</div>

								<div class="col-md-12 text-right p-0">
									 <!-- <button type="button" class="save-btn" onclick="load_user_projection_wizard(1,0,'save')"> <?php echo $this->lang->line('lang_save_label');?></button> --> 
									<button type="button" onclick="load_user_projection_wizard(1,0,'next')"> <?php echo $this->lang->line('lang_next_label');?></button>
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 mt-3">
							<div class="contact_message form form-bg">
								<div class="col-md-12 p-0 text-left">
									<h4 class="theme-color-blue"><?php echo $this->lang->line('lang_help_label');?>:</h4>
								</div>
								<label><?php echo $this->lang->line('lang_before_start_projection_help_label');?> <a href="<?php echo base_url('pages/HowsItsWork');?>" class="color-blue" target="_blank"><?php echo $this->lang->line('lang_help_label');?></a>.</label>
							</div>
						</div>
					</div>
				</form>
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
