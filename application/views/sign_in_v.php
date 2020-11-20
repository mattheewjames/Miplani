 <div class="customer_login mt-32">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-12 offset-lg-3">
				<div class="account_form">
					<div class="heading-login">
						<h2 class="m-0"><?php echo $this->lang->line('lang_sign_in_label');?></h2>
					</div>
					<form action="" method="post" id="login_form_data" name="login_form_data" enctype="multipart/form-data">
						<div class="col-md-12 row m-0 p-mb-0">
							<div class="col-md-12">
								<ul class="alert alert-danger pl-2 pr-2" id="login_error_div" style="display:none;"></ul>
								<div class="clearfix"></div>
								<ul class="alert alert-success pl-2 pr-2" id="login_success_div" style="display:none;"></ul>
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
 									?>
									<a href="<?php echo $authURL;?>" class="btn btn-lg btn-block omb_btn-facebook"  title="<?php echo $this->lang->line('lang_facebook_label');?>"><i class="fa fa-facebook visible-xs"></i></a>
									<a href="<?php echo base_url('users/login_twitter')?>" class="btn btn-lg btn-block omb_btn-twitter" title="<?php echo $this->lang->line('lang_twitter_label');?>">
										<i class="fa fa-twitter visible-xs" ></i>
									</a>
									<a href="<?php echo $gmail_url;?>" class="btn btn-lg btn-block omb_btn-google g-signin2"  title="<?php echo $this->lang->line('lang_google_label');?>"><i class="fa fa-google visible-xs" ></i></a>
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
								<p>
									<label  class="fw-600"><?php echo $this->lang->line('lang_email_address_label');?><span>*</span></label>
									<input type="text" id="user_email" name="user_email" onkeypress="return RestrictSpace();" autocomplete="off">
								</p>
								<p class="m-0">
									<label  class="fw-600"><?php echo $this->lang->line('lang_password_label');?> <span>*</span></label>
									<input type="password" id="password" name="password" onkeypress="return RestrictSpace();" autocomplete="off">
								</p>
								<!--<div class="row mt-4 m-0 col-md-12 p-0 ">
									<span class="checkbox-span">
										 <input type="checkbox" class="form-control " id="checkbox"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> <?php echo $this->lang->line('lang_keep_me_connected_label');?>
									</font></font></span>
								</div>-->
								<div class="text-center mt-4">
								  <button type="submit" class="login-btn" id="login_form_btn" name="login_form_btn" onclick="user_authentication('<?php echo base64_encode(2);?>','login')"><?php echo $this->lang->line('lang_sign_in_label');?></button>
								</div>
							   <div class="col-lg-12  row fw-600 text-center mt-2 m-0 p-0">
								   <div class="col-md-4 login_submit fw-600 p-0">
									 <a href="<?php echo base_url("users/ForgotPassword");?>" class="color-blue fp-link"><?php echo $this->lang->line('lang_forgot_password_label');?></a>
								   </div>
								   <div class="col-md-8 p-0 text-right sign-in-text">
									<?php echo $this->lang->line('lang_do_not_have_an_account_label');?> <a href="<?php echo base_url("users/SignUp");?>" class=" color-blue fp-link"><?php echo $this->lang->line('lang_sign_up_label');?></a>
								   </div>
							</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>