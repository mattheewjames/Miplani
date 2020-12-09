<?php defined('BASEPATH') OR exit('No direct script access allowed');?> 
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $page_title;?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
     <link rel=" icon" type="image/x-icon" href="<?php echo base_url('WebTheme/assets/img/logo/logo-eng.png');?>">
     <?php $this->load->view("web-common-files/css-files");?>
</head>
<body>
     <div class='thetop'></div>
	<header class="header_area header_padding " id="header">
		<div class="header_top">
			<div class="container">
				<div class="top_inner">
					<div class="row align-items-center">
					   <div class="col-lg-12 col-md-12 text-right p-0">
							<div class="top_right text-right">
								<ul>
									<li class="language">
										<a href="<?php echo base_url() ?>home/changeLanguage/EN" style="color: #fff !important"><img src="<?php echo base_url("WebTheme/assets/img/languages/en.png");?>">EN</a>
									</li>
									<li class="language">
										<a href="<?php echo base_url() ?>home/changeLanguage/ES" style="color: #fff !important"><img src="<?php echo base_url("WebTheme/assets/img/languages/es.png");?>">ES</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--header middel start-->
		<div class="header_middle middle_two">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-2 col-md-2">
						<div class="logo">
							<a href="<?php echo base_url();?>"><img class="main-logo" src="<?php echo base_url("WebTheme/assets/img/logo/logo-eng.png");?>" alt=""></a>
						</div>
					</div>
					<div class="col-lg-10 col-md-10 p-0">
						 <div class="header_bottom_container pull-right">
							<div class="main_menu">
								<nav>
									<ul>
										<?php
										$home_active_tab = 'active';
										$pricing_plan_active_tab = '';
										if(($this->router->class=='pages' || $this->router->class=='Pages') && $this->router->method=='PricingPlan')
										{
											$home_active_tab = '';
											$pricing_plan_active_tab = 'active';
										}
										?>
										<li><a href="<?php echo base_url();?>" class="<?php echo $home_active_tab;?>"><?php echo $this->lang->line('lang_home_label'); ?></a></li>
										<li><a href="<?php echo base_url('pages/PricingPlan');?>" class="<?php echo $pricing_plan_active_tab;?>"><?php echo $this->lang->line('pricing_plan'); ?></a></li>
										<li><a target="_blank" href="https://miplani.com/en/what-is-miplaniapp/"><?php echo $this->lang->line('what_is_this'); ?></a></li>
										<li><a target="_blank" href="https://miplani.com/en/who-is-miplaniapp-for/"><?php echo $this->lang->line('who_is_it_for'); ?></a></li>
										<li><a target="_blank" href="https://miplani.com/en/how-it-works/"><?php echo $this->lang->line('how_it_works'); ?></a></li>
										<li><a target="_blank" href="https://miplani.com/en/faq/"><?php echo $this->lang->line('faq'); ?></a></li>
										<li><a target="_blank" href="https://miplani.com/en/contact-us/"><?php echo $this->lang->line('contact_us'); ?></a></li>
 										<?php
										if(!empty($this->session->userdata('MiPlani_user_id')))
										{
											// print_r('aa gaya');
											// exit();
											// print_r($this->session->userdata());
											$mian_user_row = get_session_user_row();
											if(!empty($mian_user_row))
											{
												$session_user_name = $mian_user_row->first_name." ".$mian_user_row->last_name;
											}
											else
											{
												$session_user_name = $this->lang->line('lang_empty_user_name_label');
											}
										?>
											<li class="profile_li" id="profile_li"><a href="<?php echo base_url('panel/ProfileView');?>" class="profile_a"><?php echo $this->lang->line('lang_profile_label'); ?></a></li>
											<li class="logout_li" id="logout_li"><a href="<?php echo base_url('logout');?>" class="logout_a"><?php echo $this->lang->line('lang_logout_label'); ?></a></li>
											<li>
												<div class="top_right">
													<ul>
														<li class="top_links"><a href="javascript:;"><i class="ion-android-person"></i> <?php echo substr($session_user_name,0,100);?><i class="fa fa-chevron-down"></i></a>
															<ul class="dropdown_links">
																<li><a href="<?php echo base_url('panel/ProfileView');?>"><?php echo $this->lang->line('lang_profile_label');?></a></li>
																<li><a href="<?php echo base_url('projections');?>"><?php echo $this->lang->line('lang_view_saved_project_label'); ?></a></li>
																<li><a href="<?php echo base_url('projections/NewProjection');?>"><?php echo $this->lang->line('lang_create_fin_goals_label'); ?></a></li>
																<li><a href="<?php echo base_url('panel/Payments');?>"><?php echo $this->lang->line('lang_my_plans_label'); ?></a></li>
																<li><a href="<?php echo base_url('panel/InviteFriends');?>"><?php echo $this->lang->line('lang_shared_with_friends_label'); ?></a></li>
																<li><a target="_blank" href="https://miplani.com/en/contact-us/"><?php echo $this->lang->line('lang_contact_us_label'); ?></a></li>
																<li><a href="<?php echo base_url('logout');?>"><?php echo $this->lang->line('lang_logout_label');?> </a></li>
															</ul>
														</li>
													</ul>
												</div>
											</li>
										<?php
										}
										else
										{
										?>
											<li class="signup_li" ><a href="<?php echo base_url("users/SignUp");?>" class="signup_a"><?php echo $this->lang->line('lang_sign_up_label'); ?></a></li>
											<li class="signin_li" id="signin_li"><a href="<?php echo base_url("users/SignIn");?>" class="signin_a"><?php echo $this->lang->line('lang_sign_in_label'); ?></a></li>
										<?php	
										}
										?>
									</ul>
								</nav>
							</div>
						</div>


					</div>
				</div>
			</div>
		</div>
 	</header>
	<div class="off_canvars_overlay"></div>
	<div class="Offcanvas_menu canvas_padding">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="canvas_open">
						<span></span>
						<a href="javascript:void(0)"><i class="ion-navicon"></i></a>
					</div>
					<div class="Offcanvas_menu_wrapper">

						<div class="canvas_close">
							<a href="#"><i class="ion-android-close"></i></a>
						</div>
						<div class="top_right">
							<ul>
								<?php
								if(!empty($this->session->userdata('MiPlani_user_id')))
								{
									$mian_user_row = get_session_user_row();
									if(!empty($mian_user_row))
									{
										$session_user_name = $mian_user_row->first_name." ".$mian_user_row->last_name;
									}
									else
									{
										$session_user_name = $this->lang->line('lang_empty_user_name_label');
									}
								?>
									<li class="profile_li"><a href="<?php echo base_url('panel/ProfileView');?>" class="profile_a">Profile</a></li>
									<li class="logout_li"><a href="<?php echo base_url('logout');?>" class="logout_a">Logout</a></li>
									<li class="top_links">
										<a href="#"><i class="ion-android-person"></i> <?php echo substr($session_user_name,0,100);?><i class="fa fa-chevron-down"></i></a>
										<ul class="dropdown_links">
											<li><a href="<?php echo base_url('panel');?>"><?php echo $this->lang->line('lang_profile_label');?></a></li>
											<li><a href="<?php echo base_url('projections');?>">View Saved Projects</a></li>
											<li><a href="<?php echo base_url('projections/NewProjection');?>">Create New Finan. Goals</a></li>
											<li><a href="<?php echo base_url('panel/Payments');?>">My plans</a></li>
											<li><a href="<?php echo base_url('panel/InviteFriends');?>">Share Friends</</a></li>
											<li><a target="_blank" href="https://miplani.com/en/contact-us/">Contact Us</a></li>
											<li><a href="<?php echo base_url('logout');?>"><?php echo $this->lang->line('lang_logout_label');?> </a></li>
										</ul>
									</li>
								<?php
								}
								else
								{
								?>
									<li class="signup_li"><a href="<?php echo base_url("users/SignUp");?>" class="signup_a">SIGN UP</a></li>
									<li class="signin_li"><a href="<?php echo base_url("users/SignIn");?>" class="signin_a">SIGN IN</a></li>
								<?php
								}
								?>
								<li class="language">
									<a href="#" style="color: #fff !important"><img src="<?php echo base_url("WebTheme/assets/img/languages/en.png");?>">EN</a>
								</li>
								<li class="language">
									<a href="#" style="color: #fff !important"><img src="<?php echo base_url("WebTheme/assets/img/languages/es.png");?>">ES</a>
								</li>
							</ul>
						</div>
						<div id="menu" class="text-left ">
							<ul class="offcanvas_main_menu">
								<li><a href="<?php echo base_url();?>"><?php echo $this->lang->line('lang_home_label'); ?></a></li>
 								<li><a href="<?php echo base_url('pages/PricingPlan');?>">Pricing plan</a></li>
								<li><a target="_blank" href="https://miplani.com/en/what-is-miplaniapp/">What is this</a></li>
								<li><a target="_blank" href="https://miplani.com/en/who-is-miplaniapp-for/">Who is it for</a></li>
								<li><a target="_blank" href="https://miplani.com/en/how-it-works/">How it works</a></li>
								<li><a target="_blank" href="https://miplani.com/en/faq/">FAQs</a></li>
								<li><a target="_blank" href="https://miplani.com/en/contact-us/">Contact Us</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	