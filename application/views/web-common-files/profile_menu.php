<div class="col-md-12 border-bottom" id="bottom-header">
	<div class="row m-0 align-items-center">
		<div class="col-12">
			<div class="middel_right">
				<div class="text-center">
					<?php
					$bg_view_class = 'blue-color-bg';
					$bg_setting_class = 'blue-color-bg';
					$bg_payment_class = 'blue-color-bg';
					$bg_share_class = 'blue-color-bg';
					$bg_invite_class = 'blue-color-bg';
					if(($this->router->class=='Panel' || $this->router->class=='panel') && $this->router->method=='index')
					{
						$bg_setting_class = 'green-color-bg';
					}
					elseif(($this->router->class=='Panel' || $this->router->class=='panel') && $this->router->method=='Payments')
					{
						$bg_payment_class = 'green-color-bg';
					}
					elseif(($this->router->class=='Panel' || $this->router->class=='panel') && $this->router->method=='InviteFriends')
					{
						$bg_share_class = 'green-color-bg';
					}
					elseif(($this->router->class=='Panel' || $this->router->class=='panel') && $this->router->method=='ProfileView')
					{
						$bg_view_class = 'green-color-bg';
					}
					?>
					<a class="btn btn-primary <?php echo $bg_view_class;?>" href="<?php echo base_url('panel/ProfileView');?>"><?php echo  $this->lang->line('lang_my_profile_label'); ?></a>
					<a class="btn btn-dark <?php echo $bg_setting_class;?>" href="<?php echo base_url('panel');?>"><?php echo  $this->lang->line('lang_profile_settings_label'); ?></a>
					
					<!-- <a class="btn btn-dark <?php echo $bg_payment_class;?>" href="<?php echo base_url('panel/Payments');?>">My Plans</a> -->
					<a class="btn btn-dark <?php echo $bg_share_class;?>" href="<?php echo base_url('panel/InviteFriends');?>"><?php echo  $this->lang->line('lang_shared_with_friends_label'); ?></a>
					<a class="btn btn-dark <?php echo $bg_invite_class;?>" href="javascript:;" onClick="call_url_key_modal('pages/InviteProjectionFriend')"><?php echo  $this->lang->line('lang_invite_friends_label'); ?>   </a>
 				</div>
			</div>
		</div>
	</div>
</div>