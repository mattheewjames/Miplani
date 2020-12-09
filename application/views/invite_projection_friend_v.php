 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">&times;</span>
</button>
<div class="modal_body">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="modal_right">
					<div class="modal_title mb-10"><h2> <?php echo  $this->lang->line('Invite_Friend'); ?> </h2></div>
					<?php
					if(empty($error_message))
					{
						if(!empty($user_row))
						{
							if(!empty($row))
							{
							?>
								<form name="invite_friend_form_data" id="invite_friend_form_data" method="post" action="">
									<div class="variants_selects">
									   <div class="row">
										   <div class="col-md-12 alert alert-danger" id="invite_friend_error_div" style="display: none;"></div>
										   <div class="col-md-12 alert alert-success" id="invite_friend_success_div" style="display: none;"></div>
									   </div>
									   <div class="row">
											<div class="col-md-5">
												<label class="fw-600"><?php echo  $this->lang->line('Permission'); ?></label>
												<select id="permission" name="permission" class="form-control">
													<option value=""><?php echo  $this->lang->line('Please_select_permission'); ?></option>
													<option value="view"><?php echo  $this->lang->line('View'); ?></option>
													<option value="update"><?php echo  $this->lang->line('Edit'); ?></option>
												</select>
											</div>
											<div class="col-md-7">
												<label class="fw-600"><?php echo  $this->lang->line('Enter_your_friend_email_address_to_invite'); ?>.</label>
												<input type="text" name="email" placeholder="Email"  class="form-control">
											</div>
											
											<div class="col-md-12" style="text-align: right;">
												<input type="hidden" id="pid" name="pid" value="<?php echo base64_encode($row->projection_id) ?>">
												<button id="invite_friend_form_btn" name="invite_friend_form_btn" type="submit" class="dark-btn" onClick="form_data_validation('<?php echo base64_encode(8);?>','invite friend','invite_friend');"><?php echo  $this->lang->line('Invite_friend'); ?></button>
											</div>
										</div>
									</div>
								</form>
							<?php
							}
							else
							{
								echo '<p class="red">'.$this->lang->line('Please_select_valid_record').'</p>';
							}
						}
						else
						{
							echo '<p class="red">'.$this->lang->line('lang_sign_in_to_continue_error').'</p>';
						}
					}
					else
					{
						echo '<p class="red">'.$error_message.'</p>';	
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>