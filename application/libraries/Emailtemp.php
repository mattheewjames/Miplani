<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Emailtemp 
{
	public function WebSignupTemplate($username,$verification_link)  
	{ 
    
 		$html = '';
		$html .='<!DOCTYPE html>
		<html lang="en">
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="keywords" content="">
		<meta name="robots" content="all">
		<title>MIPLANi</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800" rel="stylesheet" type="text/css">
		</head>
		<body style="background-color:#F4F5FA;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#F4F5FA" id="bodyTable">
			<tbody>
				<tr>
					<td style="padding-right:10px;padding-left:10px;" align="center" valign="top" id="bodyCell">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperWebview" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tbody>
												<tr>
													<td style="padding-top: 20px; padding-bottom: 20px; padding-right: 0px;" align="center" valign="middle">';
													$html .='<a href="'.base_url().'"><img src="'.base_url('WebTheme/assets/img/logo/logo-eng.png').'" width="100px"/></a>';
													$html .='</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperBody" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableCard" style="background-color:#fff;border-color:#e5e5e5;border-style:solid;border-width:0 1px 1px 1px;">
											<tbody>
												<tr>
													<td style="background-color:#5697ac;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
												</tr>
												
												<tr>
													<td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
														
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
														
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="mainTitle">
														<h2 class="text" style="color:#000;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:28px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:36px;text-transform:none;text-align:center;padding:0;margin:0">Welcome to MIPLANi</h2>
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 30px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="subTitle">
														<h4 class="text" style="color:#999;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:16px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:24px;text-transform:none;text-align:center;padding:0;margin:0"></h4>
													</td>
												</tr>
												<tr>
													<td style="padding-left:20px;padding-right:20px" align="center" valign="top" class="containtTable ui-sortable">
														<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="">
															<tbody>
																<tr>
																	<td style="padding-bottom: 20px;" align="center" valign="top" class="description">
																		<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:22px;text-transform:none;text-align:center;padding:0;margin:0">
																			Hi '.$username.', <br>You have registered successfully!<br>
																			Please visit the link below to continue
																		</p>
																	</td>
																</tr>
															</tbody>
														</table>
														<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableButton" style="">
															<tbody>
																<tr>
																	<td style="padding-top:20px;padding-bottom:20px" align="center" valign="top">
																		<table border="0" cellpadding="0" cellspacing="0" align="center">
																			<tbody>
																				<tr>
																					<td style="background-color: #5697ac; padding: 12px 35px; border-radius: 50px;" align="center" class="ctaButton"> <a href="'.$verification_link.'" style="color:#fff;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:13px;font-weight:600;font-style:normal;letter-spacing:1px;line-height:20px;text-transform:uppercase;text-decoration:none;display:block" target="_blank" class="text">Please Verify Your Email</a>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
												<tr>
													<td style="font-size:1px;line-height:1px" height="20">&nbsp;</td>
												</tr>
											</tbody>
										</table>
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
											<tbody>
												<tr>
													<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperFooter" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="footer">
											<tbody>
												
												<tr>
													<td style="padding: 10px 10px 5px;" align="center" valign="top" class="brandInfo">
														<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">&copy; 2020 MIPLANi. All Rights Reserved.</p>
													</td>
												</tr>
												<tr>
													<td style="padding: 0px 10px 10px;" align="center" valign="top" class="footerEmailInfo">
														<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">If you have any question please contact us <a href="mailto: support@miplani.com" style="color:#0f6cb2;text-decoration:underline" target="_blank">support@miplani.com</a>
															</p>
													</td>
												</tr>
												<tr>
													<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
			</table>
		</body>
		</html>';
		return $html;
	}
 	public function WebContactUsAdminTemplate($receiver_name)  
	{ 
 		$web_link = base_url();
		$html = '';
		$html .='<!DOCTYPE html>
		<html lang="en">
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="keywords" content="">
		<meta name="robots" content="all">
		<title>MIPLANi</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800" rel="stylesheet" type="text/css">
		</head>
		<body style="background-color:#F4F5FA;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#F4F5FA" id="bodyTable">
			<tbody>
				<tr>
					<td style="padding-right:10px;padding-left:10px;" align="center" valign="top" id="bodyCell">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperWebview" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tbody>
												<tr>
													<td style="padding-top: 20px; padding-bottom: 20px; padding-right: 0px;" align="center" valign="middle">';
													$html .='<a href="'.base_url().'"><img src="'.base_url('WebTheme/assets/img/logo/logo-eng.png').'" width="100px"/></a>';
													$html .='</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperBody" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableCard" style="background-color:#fff;border-color:#e5e5e5;border-style:solid;border-width:0 1px 1px 1px;">
											<tbody>
												<tr>
													<td style="background-color:#5697ac;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
												</tr>
												
												<tr>
													<td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
														
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
														
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="mainTitle">
														<h2 class="text" style="color:#000;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:28px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:36px;text-transform:none;text-align:center;padding:0;margin:0">Welcome to MIPLANi</h2>
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 30px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="subTitle">
														<h4 class="text" style="color:#999;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:16px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:24px;text-transform:none;text-align:center;padding:0;margin:0"></h4>
													</td>
												</tr>
												<tr>
													<td style="padding-left:20px;padding-right:20px" align="center" valign="top" class="containtTable ui-sortable">
														<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="">
															<tbody>
																<tr>
																	<td style="padding-bottom: 20px;" align="center" valign="top" class="description">
																		<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:22px;text-transform:none;text-align:left;padding:0;margin:0">
																			Hi '.$receiver_name.', <br>A new message is send from MIPLANi with the following details:<br>
 																		</p>
                                                                        <ul style="float:left;width:100%;text-align:left;color:#666;">
                                                                        	<li>Full Name : '.$_POST['name'].'</li>
                                                                            <li>Email address: '.$_POST['email'].'</li>
                                                                            <li>Message: '.$_POST['message'].'</li>
                                                                         </ul>
																	</td>
																</tr>
															</tbody>
														</table>
														<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableButton" style="">
															<tbody>
																<tr>
																	<td style="padding-top:20px;padding-bottom:20px" align="center" valign="top">
																		<table border="0" cellpadding="0" cellspacing="0" align="center">
																			<tbody>
																				<tr>
																					<td style="background-color: #5697ac; padding: 12px 35px; border-radius: 50px;" align="center" class="ctaButton"> <a href="'.$web_link.'" style="color:#fff;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:13px;font-weight:600;font-style:normal;letter-spacing:1px;line-height:20px;text-transform:uppercase;text-decoration:none;display:block" target="_blank" class="text">Please Visit MIPLANi</a>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
												<tr>
													<td style="font-size:1px;line-height:1px" height="20">&nbsp;</td>
												</tr>
											</tbody>
										</table>
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
											<tbody>
												<tr>
													<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperFooter" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="footer">
											<tbody>
												
												<tr>
													<td style="padding: 10px 10px 5px;" align="center" valign="top" class="brandInfo">
														<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">&copy; 2019 MIPLANi. All Rights Reserved.</p>
													</td>
												</tr>
												<tr>
													<td style="padding: 0px 10px 10px;" align="center" valign="top" class="footerEmailInfo">
														<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">If you have any question please contact us <a href="mailto: support@miplani.com" style="color:#0f6cb2;text-decoration:underline" target="_blank">support@miplani.com</a>
															</p>
													</td>
												</tr>
												<tr>
													<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
			</table>
		</body>
		</html>';
		return $html;
	}
	public function WebContactUsUserTemplate($receiver_name)  
	{ 
 		$web_link = base_url();
		$html = '';
		$html .='<!DOCTYPE html>
		<html lang="en">
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="keywords" content="">
		<meta name="robots" content="all">
		<title>MIPLANi</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800" rel="stylesheet" type="text/css">
		</head>
		<body style="background-color:#F4F5FA;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#F4F5FA" id="bodyTable">
			<tbody>
				<tr>
					<td style="padding-right:10px;padding-left:10px;" align="center" valign="top" id="bodyCell">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperWebview" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tbody>
												<tr>
													<td style="padding-top: 20px; padding-bottom: 20px; padding-right: 0px;" align="center" valign="middle">';
													$html .='<a href="'.base_url().'"><img src="'.base_url('WebTheme/assets/img/logo/logo-eng.png').'" width="100px"/></a>';
													$html .='</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperBody" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableCard" style="background-color:#fff;border-color:#e5e5e5;border-style:solid;border-width:0 1px 1px 1px;">
											<tbody>
												<tr>
													<td style="background-color:#5697ac;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
												</tr>
												
												<tr>
													<td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
														
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
														
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="mainTitle">
														<h2 class="text" style="color:#000;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:28px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:36px;text-transform:none;text-align:center;padding:0;margin:0">Welcome to MIPLANi</h2>
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 30px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="subTitle">
														<h4 class="text" style="color:#999;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:16px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:24px;text-transform:none;text-align:center;padding:0;margin:0"></h4>
													</td>
												</tr>
												<tr>
													<td style="padding-left:20px;padding-right:20px" align="center" valign="top" class="containtTable ui-sortable">
														<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="">
															<tbody>
																<tr>
																	<td style="padding-bottom: 20px;" align="center" valign="top" class="description">
																		<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:22px;text-transform:none;text-align:left;padding:0;margin:0">
																			Hi '.$receiver_name.', <br>We have received your message.<br>
                                                                            If we have any soluction regarding your query. One of our team member will response you soon.<br>
                                                                            Thanks to visit MIPLANi
 																		</p>
 																	</td>
																</tr>
															</tbody>
														</table>
														<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableButton" style="">
															<tbody>
																<tr>
																	<td style="padding-top:20px;padding-bottom:20px" align="center" valign="top">
																		<table border="0" cellpadding="0" cellspacing="0" align="center">
																			<tbody>
																				<tr>
																					<td style="background-color: #5697ac; padding: 12px 35px; border-radius: 50px;" align="center" class="ctaButton"> <a href="'.$web_link.'" style="color:#fff;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:13px;font-weight:600;font-style:normal;letter-spacing:1px;line-height:20px;text-transform:uppercase;text-decoration:none;display:block" target="_blank" class="text">Please Visit MIPLANi</a>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
												<tr>
													<td style="font-size:1px;line-height:1px" height="20">&nbsp;</td>
												</tr>
											</tbody>
										</table>
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
											<tbody>
												<tr>
													<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperFooter" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="footer">
											<tbody>
												
												<tr>
													<td style="padding: 10px 10px 5px;" align="center" valign="top" class="brandInfo">
														<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">&copy; 2019 MIPLANi. All Rights Reserved.</p>
													</td>
												</tr>
												<tr>
													<td style="padding: 0px 10px 10px;" align="center" valign="top" class="footerEmailInfo">
														<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">If you have any question please contact us <a href="mailto: support@miplani.com" style="color:#0f6cb2;text-decoration:underline" target="_blank">support@miplani.com</a>
															</p>
													</td>
												</tr>
												<tr>
													<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
			</table>
		</body>
		</html>';
		return $html;
	}
 	public function WebForgotPasswordTemplate($receiver_full_name,$reset_link)  
	{ 
 		$html = '';
		$html .='<!DOCTYPE html>
		<html lang="en">
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="keywords" content="">
		<meta name="robots" content="all">
		<title>MIPLANi</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800" rel="stylesheet" type="text/css">
		</head>
		<body style="background-color:#F4F5FA;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#F4F5FA" id="bodyTable">
			<tbody>
				<tr>
					<td style="padding-right:10px;padding-left:10px;" align="center" valign="top" id="bodyCell">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperWebview" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tbody>
												<tr>
													<td style="padding-top: 20px; padding-bottom: 20px; padding-right: 0px;" align="center" valign="middle">';
													$html .='<a href="'.base_url().'"><img src="'.base_url('WebTheme/assets/img/logo/logo-eng.png').'" width="100px"/></a>';
													$html .='</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperBody" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableCard" style="background-color:#fff;border-color:#e5e5e5;border-style:solid;border-width:0 1px 1px 1px;">
											<tbody>
												<tr>
													<td style="background-color:#5697ac;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
												</tr>
												
												<tr>
													<td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
														
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
														
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="mainTitle">
														<h2 class="text" style="color:#000;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:28px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:36px;text-transform:none;text-align:center;padding:0;margin:0">Forgot Password Request</h2>
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 30px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="subTitle">
														<h4 class="text" style="color:#999;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:16px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:24px;text-transform:none;text-align:center;padding:0;margin:0"></h4>
													</td>
												</tr>
												<tr>
													<td style="padding-left:20px;padding-right:20px" align="center" valign="top" class="containtTable ui-sortable">
														<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="">
															<tbody>
																<tr>
																	<td style="padding-bottom: 20px;" align="center" valign="top" class="description">
																		<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:22px;text-transform:none;text-align:center;padding:0;margin:0">
																			Hi '.$receiver_full_name.', <br>We Received a Forgot Password Request from your email at MIPLANi!<br>
																			<br>Please visit the link below to Reset Your Password.<br>
                                                                            This link will expire in 5 hours
																		</p>
																	</td>
																</tr>
															</tbody>
														</table>
														<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableButton" style="">
															<tbody>
																<tr>
																	<td style="padding-top:20px;padding-bottom:20px" align="center" valign="top">
																		<table border="0" cellpadding="0" cellspacing="0" align="center">
																			<tbody>
																				<tr>
																					<td style="background-color: #5697ac; padding: 12px 35px; border-radius: 50px;" align="center" class="ctaButton"> <a href="'.$reset_link.'" style="color:#fff;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:13px;font-weight:600;font-style:normal;letter-spacing:1px;line-height:20px;text-transform:uppercase;text-decoration:none;display:block" target="_blank" class="text">Reset Your Password</a>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
												<tr>
													<td style="font-size:1px;line-height:1px" height="20">&nbsp;</td>
												</tr>
											</tbody>
										</table>
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
											<tbody>
												<tr>
													<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperFooter" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="footer">
											<tbody>
												
												<tr>
													<td style="padding: 10px 10px 5px;" align="center" valign="top" class="brandInfo">
														<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">&copy; 2019 MIPLANi. All Rights Reserved.</p>
													</td>
												</tr>
												<tr>
													<td style="padding: 0px 10px 10px;" align="center" valign="top" class="footerEmailInfo">
														<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">If you have any question please contact us <a href="mailto: support@miplani.com" style="color:#0f6cb2;text-decoration:underline" target="_blank">support@miplani.com</a>
															</p>
													</td>
												</tr>
												<tr>
													<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
			</table>
		</body>
		</html>';
		return $html;
	}
	public function WebResetPasswordTemplate($receiver_full_name,$link)  
	{ 
  		$html = '';
		$html .='<!DOCTYPE html>
		<html lang="en">
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="keywords" content="">
		<meta name="robots" content="all">
		<title>MIPLANi</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800" rel="stylesheet" type="text/css">
		</head>
		<body style="background-color:#F4F5FA;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#F4F5FA" id="bodyTable">
			<tbody>
				<tr>
					<td style="padding-right:10px;padding-left:10px;" align="center" valign="top" id="bodyCell">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperWebview" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tbody>
												<tr>
													<td style="padding-top: 20px; padding-bottom: 20px; padding-right: 0px;" align="center" valign="middle">';
													$html .='<a href="'.base_url().'"><img src="'.base_url('WebTheme/assets/img/logo/logo-eng.png').'" width="100px"/></a>';
													$html .='</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperBody" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableCard" style="background-color:#fff;border-color:#e5e5e5;border-style:solid;border-width:0 1px 1px 1px;">
											<tbody>
												<tr>
													<td style="background-color:#5697ac;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
												</tr>
												
												<tr>
													<td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
														
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
														
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="mainTitle">
														<h2 class="text" style="color:#000;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:28px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:36px;text-transform:none;text-align:center;padding:0;margin:0">Reset Password</h2>
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 30px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="subTitle">
														<h4 class="text" style="color:#999;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:16px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:24px;text-transform:none;text-align:center;padding:0;margin:0"></h4>
													</td>
												</tr>
												<tr>
													<td style="padding-left:20px;padding-right:20px" align="center" valign="top" class="containtTable ui-sortable">
														<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="">
															<tbody>
																<tr>
																	<td style="padding-bottom: 20px;" align="center" valign="top" class="description">
																		<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:22px;text-transform:none;text-align:center;padding:0;margin:0">
																			Hi '.$receiver_full_name.', <br>Your Password is Reset at MIPLANi!<br>
																			<br>Please visit the link below to continue<br>
 																		</p>
																	</td>
																</tr>
															</tbody>
														</table>
														<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableButton" style="">
															<tbody>
																<tr>
																	<td style="padding-top:20px;padding-bottom:20px" align="center" valign="top">
																		<table border="0" cellpadding="0" cellspacing="0" align="center">
																			<tbody>
																				<tr>
																					<td style="background-color: #5697ac; padding: 12px 35px; border-radius: 50px;" align="center" class="ctaButton"> <a href="'.$link.'" style="color:#fff;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:13px;font-weight:600;font-style:normal;letter-spacing:1px;line-height:20px;text-transform:uppercase;text-decoration:none;display:block" target="_blank" class="text">Please Login To Continue </a>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
												<tr>
													<td style="font-size:1px;line-height:1px" height="20">&nbsp;</td>
												</tr>
											</tbody>
										</table>
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
											<tbody>
												<tr>
													<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperFooter" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="footer">
											<tbody>
												
												<tr>
													<td style="padding: 10px 10px 5px;" align="center" valign="top" class="brandInfo">
														<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">&copy; 2019 MIPLANi. All Rights Reserved.</p>
													</td>
												</tr>
												<tr>
													<td style="padding: 0px 10px 10px;" align="center" valign="top" class="footerEmailInfo">
														<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">If you have any question please contact us <a href="mailto: support@miplani.com" style="color:#0f6cb2;text-decoration:underline" target="_blank">support@miplani.com</a>
															</p>
													</td>
												</tr>
												<tr>
													<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
			</table>
		</body>
		</html>';
		return $html;
	}
	public function WebUpdateProfileTemplate($username)  
	{ 
    	$visit_link = base_url();
 		$html = '';
		$html .='<!DOCTYPE html>
		<html lang="en">
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="keywords" content="">
		<meta name="robots" content="all">
		<title>MIPLANi</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800" rel="stylesheet" type="text/css">
		</head>
		<body style="background-color:#F4F5FA;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#F4F5FA" id="bodyTable">
			<tbody>
				<tr>
					<td style="padding-right:10px;padding-left:10px;" align="center" valign="top" id="bodyCell">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperWebview" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tbody>
												<tr>
													<td style="padding-top: 20px; padding-bottom: 20px; padding-right: 0px;" align="center" valign="middle">';
													$html .='<a href="'.base_url().'"><img src="'.base_url('WebTheme/assets/img/logo/logo-eng.png').'" width="100px"/></a>';
													$html .='</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperBody" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableCard" style="background-color:#fff;border-color:#e5e5e5;border-style:solid;border-width:0 1px 1px 1px;">
											<tbody>
												<tr>
													<td style="background-color:#5697ac;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
												</tr>
												
												<tr>
													<td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
														
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
														
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="mainTitle">
														<h2 class="text" style="color:#000;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:28px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:36px;text-transform:none;text-align:center;padding:0;margin:0">Welcome to MIPLANi</h2>
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 30px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="subTitle">
														<h4 class="text" style="color:#999;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:16px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:24px;text-transform:none;text-align:center;padding:0;margin:0"></h4>
													</td>
												</tr>
												<tr>
													<td style="padding-left:20px;padding-right:20px" align="center" valign="top" class="containtTable ui-sortable">
														<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="">
															<tbody>
																<tr>
																	<td style="padding-bottom: 20px;" align="center" valign="top" class="description">
																		<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:22px;text-transform:none;text-align:center;padding:0;margin:0">
																			Hi '.$username.', <br>Your profile is updated at Miplani!<br>
																			Please visit the link below to verify changes
																		</p>
																	</td>
																</tr>
															</tbody>
														</table>
														<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableButton" style="">
															<tbody>
																<tr>
																	<td style="padding-top:20px;padding-bottom:20px" align="center" valign="top">
																		<table border="0" cellpadding="0" cellspacing="0" align="center">
																			<tbody>
																				<tr>
																					<td style="background-color: #5697ac; padding: 12px 35px; border-radius: 50px;" align="center" class="ctaButton"> <a href="'.$visit_link.'" style="color:#fff;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:13px;font-weight:600;font-style:normal;letter-spacing:1px;line-height:20px;text-transform:uppercase;text-decoration:none;display:block" target="_blank" class="text">Please Visit Link</a>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
												<tr>
													<td style="font-size:1px;line-height:1px" height="20">&nbsp;</td>
												</tr>
											</tbody>
										</table>
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
											<tbody>
												<tr>
													<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperFooter" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="footer">
											<tbody>
												
												<tr>
													<td style="padding: 10px 10px 5px;" align="center" valign="top" class="brandInfo">
														<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">&copy; 2020 MIPLANi. All Rights Reserved.</p>
													</td>
												</tr>
												<tr>
													<td style="padding: 0px 10px 10px;" align="center" valign="top" class="footerEmailInfo">
														<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">If you have any question please contact us <a href="mailto: support@miplani.com" style="color:#0f6cb2;text-decoration:underline" target="_blank">support@miplani.com</a>
															</p>
													</td>
												</tr>
												<tr>
													<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
			</table>
		</body>
		</html>';
		return $html;
	} 
	public function WebChangeEmailTemplate($username,$new_email)  
	{ 
    	$visit_link = base_url();
 		$html = '';
		$html .='<!DOCTYPE html>
		<html lang="en">
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="keywords" content="">
		<meta name="robots" content="all">
		<title>MIPLANi</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800" rel="stylesheet" type="text/css">
		</head>
		<body style="background-color:#F4F5FA;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#F4F5FA" id="bodyTable">
			<tbody>
				<tr>
					<td style="padding-right:10px;padding-left:10px;" align="center" valign="top" id="bodyCell">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperWebview" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tbody>
												<tr>
													<td style="padding-top: 20px; padding-bottom: 20px; padding-right: 0px;" align="center" valign="middle">';
													$html .='<a href="'.base_url().'"><img src="'.base_url('WebTheme/assets/img/logo/logo-eng.png').'" width="100px"/></a>';
													$html .='</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperBody" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableCard" style="background-color:#fff;border-color:#e5e5e5;border-style:solid;border-width:0 1px 1px 1px;">
											<tbody>
												<tr>
													<td style="background-color:#5697ac;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
												</tr>
												
												<tr>
													<td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
														
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
														
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="mainTitle">
														<h2 class="text" style="color:#000;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:28px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:36px;text-transform:none;text-align:center;padding:0;margin:0">Welcome to MIPLANi</h2>
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 30px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="subTitle">
														<h4 class="text" style="color:#999;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:16px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:24px;text-transform:none;text-align:center;padding:0;margin:0"></h4>
													</td>
												</tr>
												<tr>
													<td style="padding-left:20px;padding-right:20px" align="center" valign="top" class="containtTable ui-sortable">
														<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="">
															<tbody>
																<tr>
																	<td style="padding-bottom: 20px;" align="center" valign="top" class="description">
																		<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:22px;text-transform:none;text-align:center;padding:0;margin:0">
																			Hi '.$username.', <br>Your email is updated at Miplani!<br>
																			New Email: '.$new_email.'<br>
 																			Please visit the link below to verify changes
																		</p>
																	</td>
																</tr>
															</tbody>
														</table>
														<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableButton" style="">
															<tbody>
																<tr>
																	<td style="padding-top:20px;padding-bottom:20px" align="center" valign="top">
																		<table border="0" cellpadding="0" cellspacing="0" align="center">
																			<tbody>
																				<tr>
																					<td style="background-color: #5697ac; padding: 12px 35px; border-radius: 50px;" align="center" class="ctaButton"> <a href="'.$visit_link.'" style="color:#fff;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:13px;font-weight:600;font-style:normal;letter-spacing:1px;line-height:20px;text-transform:uppercase;text-decoration:none;display:block" target="_blank" class="text">Please Visit Link</a>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
												<tr>
													<td style="font-size:1px;line-height:1px" height="20">&nbsp;</td>
												</tr>
											</tbody>
										</table>
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
											<tbody>
												<tr>
													<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperFooter" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="footer">
											<tbody>
												
												<tr>
													<td style="padding: 10px 10px 5px;" align="center" valign="top" class="brandInfo">
														<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">&copy; 2020 MIPLANi. All Rights Reserved.</p>
													</td>
												</tr>
												<tr>
													<td style="padding: 0px 10px 10px;" align="center" valign="top" class="footerEmailInfo">
														<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">If you have any question please contact us <a href="mailto: support@miplani.com" style="color:#0f6cb2;text-decoration:underline" target="_blank">support@miplani.com</a>
															</p>
													</td>
												</tr>
												<tr>
													<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
			</table>
		</body>
		</html>';
		return $html;
	}
	public function WebChangePasswordTemplate($username)  
	{ 
    	$visit_link = base_url();
 		$html = '';
		$html .='<!DOCTYPE html>
		<html lang="en">
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="keywords" content="">
		<meta name="robots" content="all">
		<title>MIPLANi</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800" rel="stylesheet" type="text/css">
		</head>
		<body style="background-color:#F4F5FA;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#F4F5FA" id="bodyTable">
			<tbody>
				<tr>
					<td style="padding-right:10px;padding-left:10px;" align="center" valign="top" id="bodyCell">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperWebview" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tbody>
												<tr>
													<td style="padding-top: 20px; padding-bottom: 20px; padding-right: 0px;" align="center" valign="middle">';
													$html .='<a href="'.base_url().'"><img src="'.base_url('WebTheme/assets/img/logo/logo-eng.png').'" width="100px"/></a>';
													$html .='</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperBody" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableCard" style="background-color:#fff;border-color:#e5e5e5;border-style:solid;border-width:0 1px 1px 1px;">
											<tbody>
												<tr>
													<td style="background-color:#5697ac;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
												</tr>
												
												<tr>
													<td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
														
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
														
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="mainTitle">
														<h2 class="text" style="color:#000;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:28px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:36px;text-transform:none;text-align:center;padding:0;margin:0">Welcome to MIPLANi</h2>
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 30px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="subTitle">
														<h4 class="text" style="color:#999;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:16px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:24px;text-transform:none;text-align:center;padding:0;margin:0"></h4>
													</td>
												</tr>
												<tr>
													<td style="padding-left:20px;padding-right:20px" align="center" valign="top" class="containtTable ui-sortable">
														<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="">
															<tbody>
																<tr>
																	<td style="padding-bottom: 20px;" align="center" valign="top" class="description">
																		<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:22px;text-transform:none;text-align:center;padding:0;margin:0">
																			Hi '.$username.', <br>Your password is changed successfully at Miplani!<br>
																			Please visit the link below to verify changes
																		</p>
																	</td>
																</tr>
															</tbody>
														</table>
														<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableButton" style="">
															<tbody>
																<tr>
																	<td style="padding-top:20px;padding-bottom:20px" align="center" valign="top">
																		<table border="0" cellpadding="0" cellspacing="0" align="center">
																			<tbody>
																				<tr>
																					<td style="background-color: #5697ac; padding: 12px 35px; border-radius: 50px;" align="center" class="ctaButton"> <a href="'.$visit_link.'" style="color:#fff;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:13px;font-weight:600;font-style:normal;letter-spacing:1px;line-height:20px;text-transform:uppercase;text-decoration:none;display:block" target="_blank" class="text">Please Visit Link</a>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
												<tr>
													<td style="font-size:1px;line-height:1px" height="20">&nbsp;</td>
												</tr>
											</tbody>
										</table>
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
											<tbody>
												<tr>
													<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperFooter" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="footer">
											<tbody>
												
												<tr>
													<td style="padding: 10px 10px 5px;" align="center" valign="top" class="brandInfo">
														<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">&copy; 2020 MIPLANi. All Rights Reserved.</p>
													</td>
												</tr>
												<tr>
													<td style="padding: 0px 10px 10px;" align="center" valign="top" class="footerEmailInfo">
														<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">If you have any question please contact us <a href="mailto: support@miplani.com" style="color:#0f6cb2;text-decoration:underline" target="_blank">support@miplani.com</a>
															</p>
													</td>
												</tr>
												<tr>
													<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
			</table>
		</body>
		</html>';
		return $html;
	} 
 	//Admin Email Template
	public function AdminForgotPasswordTemplate($receiver_full_name,$reset_link)  
	{ 
 		$html = '';
		$html .='<!DOCTYPE html>
		<html lang="en">
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="keywords" content="">
		<meta name="robots" content="all">
		<title>MIPLANi</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800" rel="stylesheet" type="text/css">
		</head>
		<body style="background-color:#F4F5FA;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#F4F5FA" id="bodyTable">
			<tbody>
				<tr>
					<td style="padding-right:10px;padding-left:10px;" align="center" valign="top" id="bodyCell">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperWebview" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tbody>
												<tr>
													<td style="padding-top: 20px; padding-bottom: 20px; padding-right: 0px;" align="center" valign="middle">';
													$html .='<a href="'.base_url().'"><img src="'.base_url('WebTheme/assets/img/logo/logo-eng.png').'" width="100px"/></a>';
													$html .='</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperBody" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableCard" style="background-color:#fff;border-color:#e5e5e5;border-style:solid;border-width:0 1px 1px 1px;">
											<tbody>
												<tr>
													<td style="background-color:#5697ac;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
												</tr>
												
												<tr>
													<td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
														
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
														
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="mainTitle">
														<h2 class="text" style="color:#000;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:28px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:36px;text-transform:none;text-align:center;padding:0;margin:0">Forgot Password Request</h2>
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 30px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="subTitle">
														<h4 class="text" style="color:#999;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:16px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:24px;text-transform:none;text-align:center;padding:0;margin:0"></h4>
													</td>
												</tr>
												<tr>
													<td style="padding-left:20px;padding-right:20px" align="center" valign="top" class="containtTable ui-sortable">
														<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="">
															<tbody>
																<tr>
																	<td style="padding-bottom: 20px;" align="center" valign="top" class="description">
																		<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:22px;text-transform:none;text-align:center;padding:0;margin:0">
																			Hi '.$receiver_full_name.', <br>We Received a Forgot Password Request from your email at MIPLANi!<br>
																			<br>Please visit the link below to Reset Your Password.<br>
                                                                            This link will expire in 5 hours
																		</p>
																	</td>
																</tr>
															</tbody>
														</table>
														<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableButton" style="">
															<tbody>
																<tr>
																	<td style="padding-top:20px;padding-bottom:20px" align="center" valign="top">
																		<table border="0" cellpadding="0" cellspacing="0" align="center">
																			<tbody>
																				<tr>
																					<td style="background-color: #5697ac; padding: 12px 35px; border-radius: 50px;" align="center" class="ctaButton"> <a href="'.$reset_link.'" style="color:#fff;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:13px;font-weight:600;font-style:normal;letter-spacing:1px;line-height:20px;text-transform:uppercase;text-decoration:none;display:block" target="_blank" class="text">Reset Your Password</a>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
												<tr>
													<td style="font-size:1px;line-height:1px" height="20">&nbsp;</td>
												</tr>
											</tbody>
										</table>
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
											<tbody>
												<tr>
													<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperFooter" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="footer">
											<tbody>
												
												<tr>
													<td style="padding: 10px 10px 5px;" align="center" valign="top" class="brandInfo">
														<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">&copy; 2019 MIPLANi. All Rights Reserved.</p>
													</td>
												</tr>
												<tr>
													<td style="padding: 0px 10px 10px;" align="center" valign="top" class="footerEmailInfo">
														<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">If you have any question please contact us <a href="mailto: support@miplani.com" style="color:#0f6cb2;text-decoration:underline" target="_blank">support@miplani.com</a>
															</p>
													</td>
												</tr>
												<tr>
													<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
			</table>
		</body>
		</html>';
		return $html;
	}
	public function AdminResetPasswordTemplate($receiver_full_name,$link)  
	{ 
  		$html = '';
		$html .='<!DOCTYPE html>
		<html lang="en">
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="keywords" content="">
		<meta name="robots" content="all">
		<title>MIPLANi</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800" rel="stylesheet" type="text/css">
		</head>
		<body style="background-color:#F4F5FA;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#F4F5FA" id="bodyTable">
			<tbody>
				<tr>
					<td style="padding-right:10px;padding-left:10px;" align="center" valign="top" id="bodyCell">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperWebview" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tbody>
												<tr>
													<td style="padding-top: 20px; padding-bottom: 20px; padding-right: 0px;" align="center" valign="middle">';
													$html .='<a href="'.base_url().'"><img src="'.base_url('WebTheme/assets/img/logo/logo-eng.png').'" width="100px"/></a>';
													$html .='</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperBody" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableCard" style="background-color:#fff;border-color:#e5e5e5;border-style:solid;border-width:0 1px 1px 1px;">
											<tbody>
												<tr>
													<td style="background-color:#5697ac;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
												</tr>
												
												<tr>
													<td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
														
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
														
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="mainTitle">
														<h2 class="text" style="color:#000;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:28px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:36px;text-transform:none;text-align:center;padding:0;margin:0">Reset Password</h2>
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 30px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="subTitle">
														<h4 class="text" style="color:#999;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:16px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:24px;text-transform:none;text-align:center;padding:0;margin:0"></h4>
													</td>
												</tr>
												<tr>
													<td style="padding-left:20px;padding-right:20px" align="center" valign="top" class="containtTable ui-sortable">
														<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="">
															<tbody>
																<tr>
																	<td style="padding-bottom: 20px;" align="center" valign="top" class="description">
																		<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:22px;text-transform:none;text-align:center;padding:0;margin:0">
																			Hi '.$receiver_full_name.', <br>Your Password is Reset at MIPLANi!<br>
																			<br>Please visit the link below to continue<br>
 																		</p>
																	</td>
																</tr>
															</tbody>
														</table>
														<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableButton" style="">
															<tbody>
																<tr>
																	<td style="padding-top:20px;padding-bottom:20px" align="center" valign="top">
																		<table border="0" cellpadding="0" cellspacing="0" align="center">
																			<tbody>
																				<tr>
																					<td style="background-color: #5697ac; padding: 12px 35px; border-radius: 50px;" align="center" class="ctaButton"> <a href="'.$link.'" style="color:#fff;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:13px;font-weight:600;font-style:normal;letter-spacing:1px;line-height:20px;text-transform:uppercase;text-decoration:none;display:block" target="_blank" class="text">Please Login To Continue </a>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
												<tr>
													<td style="font-size:1px;line-height:1px" height="20">&nbsp;</td>
												</tr>
											</tbody>
										</table>
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
											<tbody>
												<tr>
													<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperFooter" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="footer">
											<tbody>
												
												<tr>
													<td style="padding: 10px 10px 5px;" align="center" valign="top" class="brandInfo">
														<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">&copy; 2019 MIPLANi. All Rights Reserved.</p>
													</td>
												</tr>
												<tr>
													<td style="padding: 0px 10px 10px;" align="center" valign="top" class="footerEmailInfo">
														<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">If you have any question please contact us <a href="mailto: support@miplani.com" style="color:#0f6cb2;text-decoration:underline" target="_blank">support@miplani.com</a>
															</p>
													</td>
												</tr>
												<tr>
													<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
			</table>
		</body>
		</html>';
		return $html;
	}
	
	public function InviteProjection($key_url,$type)  
	{ 
		if($type=='main')
		{
			$web_link = base_url('guestProjection/index?key='.$key_url);
		}
		elseif($type=='dream')
		{
			$web_link = base_url('commonProjection/GuestProjection?key='.$key_url);
		}
 		else
		{
			$web_link = base_url('guestProjections/index?key='.$key_url);
		}
		$html = '';
		$html .='<!DOCTYPE html>
		<html lang="en">
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="keywords" content="">
		<meta name="robots" content="all">
		<title>MIPLANi</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800" rel="stylesheet" type="text/css">
		</head>
		<body style="background-color:#F4F5FA;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#F4F5FA" id="bodyTable">
			<tbody>
				<tr>
					<td style="padding-right:10px;padding-left:10px;" align="center" valign="top" id="bodyCell">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperWebview" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tbody>
												<tr>
													<td style="padding-top: 20px; padding-bottom: 20px; padding-right: 0px;" align="center" valign="middle">';
													$html .='<a href="'.base_url().'"><img src="'.base_url('WebTheme/assets/img/logo/logo-eng.png').'" width="100px"/></a>';
													$html .='</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperBody" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableCard" style="background-color:#fff;border-color:#e5e5e5;border-style:solid;border-width:0 1px 1px 1px;">
											<tbody>
												<tr>
													<td style="background-color:#5697ac;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
												</tr>
												
												<tr>
													<td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
														
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
														
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="mainTitle">
														<h2 class="text" style="color:#000;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:28px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:36px;text-transform:none;text-align:center;padding:0;margin:0">Welcome to MIPLANi</h2>
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 30px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="subTitle">
														<h4 class="text" style="color:#999;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:16px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:24px;text-transform:none;text-align:center;padding:0;margin:0"></h4>
													</td>
												</tr>
												<tr>
													<td style="padding-left:20px;padding-right:20px" align="center" valign="top" class="containtTable ui-sortable">
														<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="">
															<tbody>
																<tr>
																	<td style="padding-bottom: 20px;" align="center" valign="top" class="description">
																		<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:22px;text-transform:none;text-align:left;padding:0;margin:0">
																			Hello, <br>I hope this note finds you well.<br>
																			<br>
																			<br>
																			You have been invited by your friend to watch the financial goal projection he has achieved using MIPLANiAPP.
																			<br>
																			Please visit MIPLANi to see the projection in details.
																			<br>
																		</p>
 																	</td>
																</tr>
															</tbody>
														</table>
														<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableButton" style="">
															<tbody>
																<tr>
																	<td style="padding-top:20px;padding-bottom:20px" align="center" valign="top">
																		<table border="0" cellpadding="0" cellspacing="0" align="center">
																			<tbody>
																				<tr>
																					<td style="background-color: #5697ac; padding: 12px 35px; border-radius: 50px;" align="center" class="ctaButton"> <a href="'.$web_link.'" style="color:#fff;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:13px;font-weight:600;font-style:normal;letter-spacing:1px;line-height:20px;text-transform:uppercase;text-decoration:none;display:block" target="_blank" class="text">Please Visit MIPLANi</a>
																					<br>
																					<br>
																					<br>
MIPLANiAPP is a software that helps entrepreneurs simulate their revenue, maximize their profits, avoid costly marketing and investment mistakes, and grow their business successfully.
If you are an entrepreneur, I think it’s something that your organization might see immediate value in. 
Do not hesitate request your invite for a Free trial to know how this amazing software could help your business become more competitive.
Best wishes,
Viviane Komze
Founder of MIPLANiAPP (link this to miplani.com)
info@miplani.com (link this to: mailto://info@miplani.com)
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
												<tr>
													<td style="font-size:1px;line-height:1px" height="20">&nbsp;</td>
												</tr>
											</tbody>
										</table>
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
											<tbody>
												<tr>
													<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperFooter" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="footer">
											<tbody>
												
												<tr>
													<td style="padding: 10px 10px 5px;" align="center" valign="top" class="brandInfo">
														<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">&copy; 2019 MIPLANi. All Rights Reserved.</p>
													</td>
												</tr>
												<tr>
													<td style="padding: 0px 10px 10px;" align="center" valign="top" class="footerEmailInfo">
														<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">If you have any question please contact us <a href="mailto: support@miplani.com" style="color:#0f6cb2;text-decoration:underline" target="_blank">support@miplani.com</a>
															</p>
													</td>
												</tr>
												<tr>
													<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
			</table>
		</body>
		</html>';
		return $html;
	}
	public function WebNewsletterTemplate($receiver_name)  
	{ 
 		$web_link = base_url();
		$html = '';
		$html .='<!DOCTYPE html>
		<html lang="en">
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="keywords" content="">
		<meta name="robots" content="all">
		<title>MIPLANi</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800" rel="stylesheet" type="text/css">
		</head>
		<body style="background-color:#F4F5FA;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#F4F5FA" id="bodyTable">
			<tbody>
				<tr>
					<td style="padding-right:10px;padding-left:10px;" align="center" valign="top" id="bodyCell">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperWebview" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tbody>
												<tr>
													<td style="padding-top: 20px; padding-bottom: 20px; padding-right: 0px;" align="center" valign="middle">';
													$html .='<a href="'.base_url().'"><img src="'.base_url('WebTheme/assets/img/logo/logo-eng.png').'" width="100px"/></a>';
													$html .='</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperBody" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableCard" style="background-color:#fff;border-color:#e5e5e5;border-style:solid;border-width:0 1px 1px 1px;">
											<tbody>
												<tr>
													<td style="background-color:#5697ac;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
												</tr>
												
												<tr>
													<td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
														
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
														
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="mainTitle">
														<h2 class="text" style="color:#000;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:28px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:36px;text-transform:none;text-align:center;padding:0;margin:0">Welcome to MIPLANi</h2>
													</td>
												</tr>
												<tr>
													<td style="padding-bottom: 30px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="subTitle">
														<h4 class="text" style="color:#999;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:16px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:24px;text-transform:none;text-align:center;padding:0;margin:0"></h4>
													</td>
												</tr>
												<tr>
													<td style="padding-left:20px;padding-right:20px" align="center" valign="top" class="containtTable ui-sortable">
														<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="">
															<tbody>
																<tr>
																	<td style="padding-bottom: 20px;" align="center" valign="top" class="description">
																		<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:22px;text-transform:none;text-align:left;padding:0;margin:0">
																			Hi '.$receiver_name.', <br>You have successfully subscribed to the newsletter. Your subscription has been confirmed.<br>
                                                                            Thanks to visit MIPLANi
 																		</p>
 																	</td>
																</tr>
															</tbody>
														</table>
														<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableButton" style="">
															<tbody>
																<tr>
																	<td style="padding-top:20px;padding-bottom:20px" align="center" valign="top">
																		<table border="0" cellpadding="0" cellspacing="0" align="center">
																			<tbody>
																				<tr>
																					<td style="background-color: #5697ac; padding: 12px 35px; border-radius: 50px;" align="center" class="ctaButton"> <a href="'.$web_link.'" style="color:#fff;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:13px;font-weight:600;font-style:normal;letter-spacing:1px;line-height:20px;text-transform:uppercase;text-decoration:none;display:block" target="_blank" class="text">Please Visit MIPLANi</a>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
												<tr>
													<td style="font-size:1px;line-height:1px" height="20">&nbsp;</td>
												</tr>
											</tbody>
										</table>
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
											<tbody>
												<tr>
													<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperFooter" style="max-width:600px">
							<tbody>
								<tr>
									<td align="center" valign="top">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" class="footer">
											<tbody>
												
												<tr>
													<td style="padding: 10px 10px 5px;" align="center" valign="top" class="brandInfo">
														<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">&copy; 2019 MIPLANi. All Rights Reserved.</p>
													</td>
												</tr>
												<tr>
													<td style="padding: 0px 10px 10px;" align="center" valign="top" class="footerEmailInfo">
														<p class="text" style="color:#666;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">If you have any question please contact us <a href="mailto: support@miplani.com" style="color:#0f6cb2;text-decoration:underline" target="_blank">support@miplani.com</a>
															</p>
													</td>
												</tr>
												<tr>
													<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
			</table>
		</body>
		</html>';
		return $html;
	}
}