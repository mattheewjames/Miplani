 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">&times;</span>
</button>
<div class="modal_body">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="modal_right">
					<div class="modal_title mb-10"><h2>Share on social media</h2></div>
					<?php
					if(empty($error_message))
					{
						if(!empty($row))
						{
							$actual_link = base_url('pages/ViewProjection?key_id='.$row->projection_id);
							$fb_link = 'https://www.facebook.com/sharer/sharer.php?u='.$actual_link;
							$twitter_link = 'https://twitter.com/share?url=='.$actual_link;
							$instagram_link = 'http://instagram.com/sharer.php?u'.$actual_link;
							$linkedin_link = 'https://www.linkedin.com/shareArticle?mini=true&url='.$actual_link.'&title='.'projection';
						?>
							<div class="variants_selects">
								<div class="row">
									<div class="col-md-12">
										<div class="footer_payment text-center">
											<div class="follow_us">
												<ul class="follow_link">
													<li>
														<a href="<?php echo $fb_link;?>" target="_blank"><i class="ion-social-facebook" title="Facebook"></i></a>
													</li>
													<li>
														<a href="<?php echo $twitter_link;?>" target="_blank"><i class="ion-social-twitter" title="Twitter"></i></a> 
													</li>
													<li>
														<a href="<?php echo $instagram_link;?>" target="_blank"><i class="ion-social-instagram" title="Instagram"></i></a>
													</li>
													<li>
														<a href="<?php echo $linkedin_link;?>" target="_blank"><i class="ion-social-linkedin" title="LinkedIn"></i></a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php
						}
						else
						{
							echo '<p class="red">Please select valid record</p>';
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