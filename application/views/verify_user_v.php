  <div class="customer_login mt-32">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-12 offset-lg-3">
				<div class="account_form">
					<div class="heading-login">
						<h2 class="m-0"><?php echo $this->lang->line('lang_email_verification_label');?></h2>
					</div>
					<section class="main_container">
						<div class="col-md-12 row m-0 p-mb-0">
 							<div class="col-md-12 p-0-mb p-mb-0">
							   <?php
								if(!empty($error_message))
								{
									echo '<p class="alert alert-danger">'.$error_message.'</p>';
								}
								else
								{
									if(empty($user_row))
									{
										echo '<p class="alert alert-danger">'.$this->lang->line('lang_invalid_link_access_error').'</p>';
									}
									else
									{
									?>
										<p class="success"><?php echo $this->lang->line('lang_user_email_verified_text');?></p>
 									<?php
									}
								}
								?>
								<?php
								if(empty($this->session->userdata('MiPlani_user_id'))) 
								{
								?>
									<div class="col-lg-12  fw-600 text-center mt-2">
									   <?php echo $this->lang->line('lang_back_to_label');?> <a href="<?php echo base_url("users/SignIn");?>" class=" color-blue"><?php echo $this->lang->line('lang_login_label');?></a>
									</div>
								<?php
								}
								else
								{
								?>

								<?php	
								}
								?>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
</div>