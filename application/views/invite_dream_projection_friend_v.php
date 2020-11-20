 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">&times;</span>
</button>
<div class="modal_body">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="modal_right">
					<div class="modal_title mb-10"><h2>Invite friend</h2></div>
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
												<label class="fw-600">Permission</label>
												<select id="permission" name="permission" class="form-control">
													<option value="">Please select permission</option>
													<option value="view">View</option>
													<option value="update">Edit</option>
												</select>
											</div>
											<div class="col-md-7">
												<label class="fw-600">Enter your friend email address to invite.</label>
												<input type="text" name="email" placeholder="Email"  class="form-control">
											</div>
											<div class="col-md-12" style="text-align: right;">
												<input type="hidden" id="pid" name="pid" value="<?php echo base64_encode($row->projection_id) ?>">
												<button id="invite_friend_form_btn" name="invite_friend_form_btn" type="submit" class="dark-btn" onClick="form_data_validation('<?php echo base64_encode(12);?>','invite friend','invite_friend');">Invite friend</button>
											</div>
										</div>
									</div>
								</form>
							<?php
							}
							else
							{
								echo '<p class="red">Please select valid record</p>';
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