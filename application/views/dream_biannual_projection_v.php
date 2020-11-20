 <?php
if(empty($error_message))
{
	if(!empty($user_row))
	{
 	?>
		<?php $this->load->view('web-common-files/projection_menu');?>
		<div class="priceing_table" style="background: #fff;">
			<div class="container">
				<div class="row">
				   <table class="table table-striped table-bordered zero-configuration">
					  <thead>
						<tr>
						  <th class="text-center">Financial Goal</th>
						  <th class="text-center">Created</th>
						  <th class="text-center">Action</th>
						</tr>
					  </thead>
					  <tbody>
					  	<?php
						if(!empty($projection_list))
						{
							$counter = 0;
							foreach($projection_list as $val)
							{
								$counter++;
								$download_projection_path = base_url('commonProjection/DownloadDreamProjection?key_id='.base64_encode($val->projection_id));
							?>
								<tr id="row_<?php echo $counter;?>">
									<td class="text-center"><?php echo custom_number_format($val->annual_billing);?> &euro;</td>
									<td class="text-center"><?php echo date('M d, Y',$val->add_date);?></td>
									<td class="text-center icons">
								  	  <?php
									  if($val->projection_status=='active')
									  {
									  ?>
											<a href="<?php echo base_url('commonProjection/ViewDreamProjection?key_id='.base64_encode($val->projection_id));?>"><i class="fa fa-eye" aria-hidden="true" title="View Summary"></i></a>
											<a href="javascript:;" onClick="call_url_key_modal('commonProjection/InviteDreamProjectionFriend','<?php echo base64_encode($val->projection_id);?>')">
												<i class="fa fa-share-alt" aria-hidden="true" title="Share Friends"></i>
											</a>
											<a href="javascript:;" onClick="CopyDreamProjection('<?php echo base64_encode($val->projection_id);?>');"><i class="fa fa-copy" aria-hidden="true" title="Copy"></i></a>
 											<a href="<?php echo $download_projection_path;?>" target="_blank">
												<i class="fa fa-download" aria-hidden="true" title="Download"></i>
											</a>
										<?php
										}
										?>
										<a href="<?php echo base_url('dreamProjection/Update?key_id='.base64_encode($val->projection_id));?>">
											<i class="fa fa-edit" aria-hidden="true" title="Edit"></i>
										</a>
										<a href="javascript:;" onClick="record_deletion('<?php echo base64_encode($val->projection_id);?>','<?php echo base64_encode('dream projection');?>','<?php echo $counter;?>');"><i class="fa fa-trash" aria-hidden="true"></i></a>
									</td>
								</tr>
							<?php
							}
						}
						else
						{
						?>
							<tr><td colspan="3" align="center"><span class="red">No Record Found!</span></td></tr>
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
