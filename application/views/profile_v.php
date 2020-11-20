<div class="unlimited_services" id="pricing-plan">
	<div class="container">
	<div class="col-md-12 text-center"><h1>Profile Setting</h1></div>
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
			?>
				<div class="row">
					 <div class="col-lg-6 col-md-12">
						<div class="contact_message main_profile" id="">
							<div class="col-md-12">
							<h3 class="p-0-mb"><?php echo $this->lang->line('lang_personal_information_label');?></h3>
							</div>
							<form name="profile_form_data" id="profile_form_data" method="post" action="">
							  <div class="col-lg-12 col-md-12  m-0 p-0 profile-field">
								  <div class="row m-0">
								  		<ul class="col-md-12 alert alert-danger" id="profile_error_div" style="display: none;"></ul>
							   			<ul class="col-md-12 alert alert-success" id="profile_success_div" style="display: none;"></ul>
										<div class="col-md-6">
											<p>
												<label  class="fw-600"><?php echo $this->lang->line('lang_first_name_label');?></label>
												<input type="text" id="first_name" name="first_name" value="<?php echo $user_row->first_name;?>">
											</p>
										</div>
										<div class="col-md-6">
											<p>
												<label  class="fw-600"><?php echo $this->lang->line('lang_last_name_label');?></label>
												<input type="text" id="last_name" name="last_name" value="<?php echo $user_row->last_name;?>">
											</p>
										</div>
								   </div>
								   <div class="row m-0">
										<div class="col-md-6">
											<p>
												<label  class="fw-600"><?php echo $this->lang->line('lang_username_label');?></label>
												<input type="text" id="username" name="username" value="<?php echo $user_row->username;?>" onkeypress="return RestrictSpace();">
											</p>
										</div>
										<div class="col-md-6">
											<p>
												<label  class="fw-600"><?php echo $this->lang->line('lang_email_address_label');?></label>
												<input type="text" id="user_email" name="user_email" value="<?php echo $user_row->user_email;?>" onkeypress="return RestrictSpace();">
											</p>
										</div>
								   </div>
							   </div>
							  <div class="col-md-12 text-right">
									<button id="profile_form_btn" name="profile_form_btn" type="submit" class="dark-btn" onClick="form_data_validation('<?php echo base64_encode(2);?>','profile','profile');"><?php echo $this->lang->line('lang_update_label');?></button>
							</div>
							</form>
						</div>
					</div>
 					<div class="col-lg-6 col-md-12">
						<div class="contact_message content main_profile">
							<h3>Change password</h3>
							<form name="change_password_form_data" id="change_password_form_data" method="post" action="">
							   <ul class="col-md-12 alert alert-danger" id="change_password_error_div" style="display: none;"></ul>
							   <ul class="col-md-12 alert alert-success" id="change_password_success_div" style="display: none;"></ul>
 							   <p>
									<label><?php echo $this->lang->line('lang_old_password_label');?></label>
									<input type="password" id="old_password" name="old_password" placeholder="" onkeypress="return RestrictSpace();" autocomplete="off">
								</p>
								<p>
									<label><?php echo $this->lang->line('lang_new_password_label');?></label>
									<input type="password" id="new_password" name="new_password" placeholder="" onkeypress="return RestrictSpace();" autocomplete="off">
								</p>
								<p>
									<label> <?php echo $this->lang->line('lang_confirm_password_label');?></label>
									<input type="password" id="confirm_password" name="confirm_password" placeholder="" onkeypress="return RestrictSpace();" autocomplete="off">
								</p>
								<div class="col-md-12 text-right p-0">
									<button id="change_password_form_btn" name="change_password_form_btn" type="submit" class="dark-btn" onClick="form_data_validation('<?php echo base64_encode(3);?>','change password','change_password');"><?php echo $this->lang->line('lang_update_label');?></button>
								</div>
							</form>
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