 <div class="customer_login mt-32">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 offset-lg-3 offset-sm-3">
				<div class="account_form">
					<div class="heading-login">
						<h2 class="m-0"><?php echo $this->lang->line('lang_reset_password_label');?></h2>
					</div>
					<?php
                    if(empty($error_message))
                    {
                    ?>
						<form action="" method="post" id="reset_pass_form_data" name="reset_pass_form_data" enctype="multipart/form-data">
							<div class="col-md-12">
								<ul class="alert alert-danger pl-2 pr-2" id="reset_pass_error_div" style="display:none;"></ul>
								<div class="clearfix"></div>
								<ul class="alert alert-success pl-2 pr-2" id="reset_pass_success_div" style="display:none;"></ul>
							</div>
							<p>
								<label  class="fw-600"><?php echo $this->lang->line('lang_new_password_label');?><span>*</span></label>
								 <input type="password" name="password" id="password" placeholder="" tabindex="1" onkeypress="return RestrictSpace();" class="form-control input-lg" autocomplete="off">
							</p>
							<p>
								<label  class="fw-600"><?php echo $this->lang->line('lang_confirm_password_label');?><span>*</span></label>
								<input type="password" class="form-control input-lg" name="cpassword" id="cpassword" placeholder="" tabindex="2" onkeypress="return RestrictSpace();" autocomplete="off">
							</p>
							
							<div class="text-center">
							 	  <?php
								  if(!empty($data_link))
								  {
								  ?>
									  <input type="hidden" id="data_link" name="data_link" value="<?php echo $data_link;?>" />
								  <?php
								  }
								  ?>
								 <button type="submit" class="login-btn m-0" id="reset_pass_form_btn" name="reset_pass_form_btn" onclick="user_authentication('<?php echo base64_encode(7);?>','reset_pass')"><?php echo $this->lang->line('lang_recover_password_label');?></button>
							</div>
							<div class="col-lg-12  fw-600 text-center mt-2">
						   	   <?php
							  if(!empty($data_link))
							  {
							  ?>
								  <input type="hidden" id="data_link" name="data_link" value="<?php echo $data_link;?>" />
							  <?php
							  }
							  ?> 	
							   <?php echo $this->lang->line('lang_back_to_label');?> <a href="<?php echo base_url("users/SignIn");?>" class=" color-blue"><?php echo $this->lang->line('lang_login_label');?></a>
							</div>
						</form>
					<?php
					}
					else
					{
					?>
                    	<div class="col-12 alert alert-danger"><?php echo $error_message;?></div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12  fw-600 text-center mt-2">
						   <?php echo $this->lang->line('lang_back_to_label');?> <a href="<?php echo base_url("users/SignIn");?>" class=" color-blue"><?php echo $this->lang->line('lang_login_label');?></a>
						</div>
                    <?php	
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>