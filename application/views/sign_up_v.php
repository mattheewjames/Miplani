

<!-- <a href="<?php echo base_url("users/test")?>">Myfunciton</a> -->

<div class="customer_login mt-32">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-12 offset-lg-2">
				<div class="account_form">
					<div class="heading-login">
						<h2 class="m-0"><?php echo $this->lang->line('lang_create_your_account_label');?></h2>
					</div>
					<form action="" method="post" id="signup_form_data" name="signup_form_data" enctype="multipart/form-data">
						<div class="col-md-12 row m-0 p-mb-0">
						 	<div class="col-md-12">
								<ul class="alert alert-danger pl-2 pr-2" id="signup_error_div" style="display:none;"></ul>
								<div class="clearfix"></div>
								<ul class="alert alert-success pl-2 pr-2" id="signup_success_div" style="display:none;"></ul>
							</div>
							<div class="col-md-12 text-center">
							  <label class="fw-600 color-blue"><?php echo $this->lang->line('lang_with_social_media_label');?></label>
							</div>
							<div class="col-md-12 row social-icons m-0 p-0" id="social-btns">
								<div class="omb_socialButtons">
									<?php
									if(empty($authURL))
									{
										$authURL = '#';
 									}
									if(empty($gmail_url))
									{
										$gmail_url = '#';
 									}
 									if(empty($oauth2URL))
									{
										$oauth2URL = '#';
 									}
 									
 									?>
									<a href="<?php echo $authURL;?>" class="btn btn-lg btn-block omb_btn-facebook"  title="<?php echo $this->lang->line('lang_facebook_label');?>"><i class="fa fa-facebook visible-xs"></i></a>
									<a href="<?php echo base_url('users/login_twitter');?>" class="btn btn-lg btn-block omb_btn-twitter" title="<?php echo $this->lang->line('lang_twitter_label');?>">
										<i class="fa fa-twitter visible-xs" ></i>
									</a>
									<a href="<?php echo $gmail_url; ?>" class="btn btn-lg btn-block omb_btn-google g-signin2"  title="<?php echo $this->lang->line('lang_google_label');?>"><i class="fa fa-google visible-xs" ></i></a>
									<a href="<?php echo base_url('users/login_linkedin'); ?>" class="btn btn-lg btn-block omb_btn-linkedin" title="<?php echo $this->lang->line('lang_linkedIn_label');?>">
										 <i class="fa fa-linkedin visible-xs" ></i>
									</a>
									<!-- <a href="#" class="btn btn-lg btn-block omb_btn-yahoo"  title="<?php echo $this->lang->line('lang_yahoo_label');?>">
										<i class="fa fa-yahoo visible-xs"></i>
									</a> -->
								</div>
							</div>
							<div class="col-md-12 text-center  mt-1 mb-1">
								<label class="fw-600 color-blue"><?php echo $this->lang->line('lang_OR_label');?></label>
							</div>
							<div class="col-md-12 p-0-mb p-mb-0">
								<div class="row m-0">
									<div class="col-md-6">
										<p>
											<label  class="fw-600"><?php echo $this->lang->line('lang_first_name_label');?></label>
											<input type="text" id="first_name" name="first_name" autocomplete="off">
										</p>
									</div>
									<div class="col-md-6">
										<p>
											<label  class="fw-600"><?php echo $this->lang->line('lang_last_name_label');?></label>
											<input type="text" id="last_name" name="last_name" autocomplete="off">
										</p>
									</div>
								</div>
								<div class="row m-0">
									<div class="col-md-6">
										<p>
											<label  class="fw-600"><?php echo $this->lang->line('lang_username_label');?></label>
											<input type="text" id="username" name="username" onkeypress="return RestrictSpace();" autocomplete="off">
										</p>
									</div>
									<div class="col-md-6">
										<p>
											<label  class="fw-600"><?php echo $this->lang->line('lang_email_address_label');?></label>
											<input type="text" id="user_email" name="user_email" onkeypress="return RestrictSpace();" autocomplete="off">
										</p>
									</div>
								</div>
								<div class="row m-0">
									<div class="col-md-6">
										<p>
											<label  class="fw-600"><?php echo $this->lang->line('lang_password_label');?></label>
											<input type="password" id="password" name="password" onkeypress="return RestrictSpace();" autocomplete="off">
										</p>
									</div>
									<div class="col-md-6">
										<p>
											 <label  class="fw-600"><?php echo $this->lang->line('lang_confirm_password_label');?></label>
											 <input type="password" id="cpassword" name="cpassword" onkeypress="return RestrictSpace();" autocomplete="off">
										</p>
									</div>
								</div>
								 <div class="row m-0 col-md-12 ">
									<span class="checkbox-span">
										 <input type="checkbox" class="form-control checkbox" id="is_agree" name="is_agree" value="Yes"><?php echo $this->lang->line('lang_Please_confirm_that_you_agree_to_our_label');?> &nbsp;<a target="_blank" href="<?php echo base_url("pages/PrivacyPolicy");?>" class="color-blue"> <?php echo $this->lang->line('lang_privacy_policy_label');?></a>
									</span>
								</div>

								<div class="text-center">
								  <button type="submit" class="login-btn" id="signup_form_btn" name="signup_form_btn" onclick="user_authentication('<?php echo base64_encode(1);?>','signup')"><?php echo $this->lang->line('lang_sign_up_label');?></button>
								</div>
							   <div class="col-lg-12  fw-600 text-center mt-2">
							   <?php echo $this->lang->line('lang_already_have_an_account_label');?> <a href="<?php echo base_url("users/SignIn");?>" class="color-blue"><?php echo $this->lang->line('lang_sign_in_label');?></a>
							</div>
							</div>

						</div>
					</form>
				</div>
			</div>
 		</div>
	</div>
</div>