<div class="unlimited_services" id="pricing-plan">
	<div class="container">
	<div class="col-md-12 text-center"><h1>Shared with Friends</h1></div>
	</div>
</div>
<?php
if(empty($error_message))
{
	if(!empty($user_row))
	{
 	?>
 		<?php $this->load->view('web-common-files/profile_menu');?>
		<div class="priceing_table" style="background: #fff;">
			<div class="container">
				<div class="row">
				   <table class="table table-striped table-bordered zero-configuration">
					  <thead>
						<tr>
						  <th>Email</th>
						  <th>Date</th>
						  <th>Permission</th>
						  <th style="text-align: center;">Action</th>
						</tr>
					  </thead>
					  <tbody>
					  	<?php
						if(!empty($invite_friends_list))
						{
							foreach($invite_friends_list as $val)
							{
								if($val->projection_type=='dream')
								{
									$url = base_url('commonProjection/GuestProjection?key='.$val->key_url);
								}
								elseif($val->projection_type=='main')
								{
									$url = base_url('guestProjection/index?key='.$val->key_url);
								}
								else
								{
									$url = base_url('guestProjections/index?key='.$val->key_url);
								}
							?>
								<tr>
									<td><?php echo $val->friend_email;?></td>
									<td><?php echo date('D m, Y',$val->invite_date);?></td>
									<td><?php echo $val->permission;?></td>
									<td align="center"><a href="<?php echo $url;?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
		<a href="<?php echo base_url('panel/delete/'.$val->main_id);?>" onclick="return confirm('Are You sure you want to delete this permission?');"><i class="fa fa-trash" aria-hidden="true"></i></a>	
								</td>
								</tr>
							<?php
							}
						}
						else
						{
						?>
							<tr><td colspan="4" align="center"><span class="red">No Record Found!</span></td></tr>
						<?php	
						}
						?>
					  </tbody>
					</table>
				</div>
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
