<div class="customer_login mt-32">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-12 offset-lg-2">
				<div class="account_form">
					<div class="heading-login">
						<h2 class="m-0">404 Page</h2>
					</div>
					<?php
					if(empty($error_message))
					{
						$error_message ='We are sorry, this link is expired or not valid';
					}
					?>
					<div class="col-md-12 row mt-2 mb-2">
						<p class="red" style="font-size:24px;"><?php echo $error_message;?></p>
					</div>
					<div class="col-md-12 row m-0 p-mb-0">
					   <div class="col-lg-6 fw-600">
						   <?php echo $this->lang->line('lang_already_have_an_account_label');?> <a href="<?php echo base_url("users/SignIn");?>" class="color-blue"><?php echo $this->lang->line('lang_sign_in_label');?></a>
						</div>
						 <div class="col-lg-6 fw-600 text-right">
							<?php echo $this->lang->line('lang_do_not_have_an_account_label');?> <a href="<?php echo base_url("users/SignUp");?>" class="color-blue"><?php echo $this->lang->line('lang_sign_up_label');?></a>
					   </div>
 					</div>
 				</div>
			</div>
 		</div>
	</div>
</div>