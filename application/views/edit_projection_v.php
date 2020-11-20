 <?php
if(empty($error_message))
{
	if(!empty($user_row))
	{
		$current_subscription = $this->lang->line('lang_free_label');
		if(!empty($user_row->current_subscription_type))
		{
			if($user_row->current_subscription_type=='Free')
			{
				$current_subscription = $this->lang->line('lang_free_label');
			}
			elseif($user_row->current_subscription_type=='Annual')
			{
				$current_subscription = $this->lang->line('lang_free_label');
			}
			elseif($user_row->current_subscription_type=='Monthly')
			{
				$current_subscription = $this->lang->line('lang_free_label');
			}
			elseif($user_row->current_subscription_type=='Lifetime')
			{
				$current_subscription = $this->lang->line('lang_free_label');
			}
		}
	?>
		<div class="contact_area">
			<div class="container">
				<form id="projection_form" name="projection_form" method="" action="">
					<div class="col-md-12 content" id="projection_data"></div>
				</form>
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
