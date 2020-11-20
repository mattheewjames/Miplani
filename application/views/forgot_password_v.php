 <div class="customer_login mt-32">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 offset-lg-3 offset-sm-3">
				<div class="account_form">
					<div class="heading-login">
						<h2 class="m-0"><?php echo $this->lang->line('lang_forgot_password_label');?></h2>
					</div>
					<form action="" method="post" id="fpass_form_data" name="fpass_form_data" enctype="multipart/form-data">
						<p class="m-0"><?php echo $this->lang->line('lang_forgot_password_page_text');?></p>
						<div class="col-md-12">
							<ul class="alert alert-danger pl-2 pr-2" id="fpass_error_div" style="display:none;"></ul>
							<div class="clearfix"></div>
							<ul class="alert alert-success pl-2 pr-2" id="fpass_success_div" style="display:none;"></ul>
						</div>
						<p>
							<label  class="fw-600"><?php echo $this->lang->line('lang_email_address_label');?><span>*</span></label>
							<input type="text" id="user_email" name="user_email" autocomplete="off">
						</p>
						<div class="text-center">
							 <button type="submit" class="login-btn m-0" id="fpass_form_btn" name="fpass_form_btn" onclick="user_authentication('<?php echo base64_encode(6);?>','fpass')"><?php echo $this->lang->line('lang_recover_password_label');?></button>
						</div>
						<div class="col-lg-12  fw-600 text-center mt-2">
						   <?php echo $this->lang->line('lang_back_to_label');?> <a href="<?php echo base_url("users/SignIn");?>" class=" color-blue"><?php echo $this->lang->line('lang_login_label');?></a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>