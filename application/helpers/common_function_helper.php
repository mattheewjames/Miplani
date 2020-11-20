<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('check_password_strength_ex'))
{
    function check_password_strength_ex($user_password) 
	{
		$response_msg = '';
   		if(!empty($user_password))
		{
  			$pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
			
 			$total_upper_case = strlen(preg_replace('![^A-Z]+!', '', $user_password));
			$total_lower_case = strlen(preg_replace('![^a-z]+!', '', $user_password));
			$total_number =strlen(preg_replace('![^0-9]+!', '', $user_password));
			$total_special_characters = 0;
			$msg = '';
			if(preg_match($pattern,$user_password))
			{
				$total_special_characters = 1;	
			}
 			if($total_upper_case<1) // lacking uppercase characters
			{
 				$response_msg = 'Password must contain at least one uppercase character(A-Z)';
			}
			elseif($total_lower_case<1) // lacking lowercase characters
			{
 				$response_msg = 'Password must contain at least one lowercase character(a-z)';
			}
			elseif($total_number<1) //  lacking numbers
			{
 				$response_msg = 'Password must contain at least one number(0-9)';
			}
			elseif($total_special_characters<1) //  lacking Special characters
			{
 				$response_msg = 'Password must contain at least one special character';
			}
			else
			{
				$response_msg = 'success';
			}
		}
		else
		{
			$response_msg = 'success';	
		}
		return $response_msg;
	}
}

if(!function_exists('check_password_strength'))
{
    function check_password_strength($user_password) 
	{
		$response_msg = '';
   		if(!empty($user_password))
		{
			if(strlen($user_password)<8)
			{
 				$response_msg = 'Password must have minimum 8 characters or numbers';
			}
			elseif(strlen($user_password)>25)
			{
 				$response_msg = 'Password must have maximum 25 characters or numbers';
			}
			else
			{
				$response_msg = 'success';
			}
		}
		else
		{
			$response_msg = 'success';	
		}
		return $response_msg;
	}
}
if(!function_exists('check_phone_number'))
{
    function check_phone_number($phone_number) 
	{
		$response_msg = '';
   		if(!empty($phone_number))
		{
			if(!is_numeric($phone_number))
			{
				$response_msg = 'Please enter valid phone number';
			}
			elseif(strlen($phone_number)<8 || strlen($phone_number)>20)
			{
				$response_msg = 'Please enter valid phone number 8-20 digits';
			}
 			else
			{
				$response_msg = 'success';
			}
		}
		else
		{
			$response_msg = 'success';	
		}
		return $response_msg;
	}
}
if(!function_exists('get_session_user_row'))
{
    function get_session_user_row() 
	{ 
		$ci =& get_instance();
		$ci->load->model("Users_m","users");
  		return $ci->users->get_session_user_row();
	}
}
if(!function_exists('free_package_url'))
{
    function free_package_url() 
	{ 
		$ci =& get_instance();
  		if(!empty($ci->session->userdata('MiPlani_user_id')))
		{
			$url = base_url('projections');
		}
		else
		{
			$url = base_url('users/SignIn');
		}
		return $url;
	}
}
if(!function_exists('money_format'))
{
	function money_format($format, $number)
	{
		$regex  = '/%((?:[\^!\-]|\+|\(|\=.)*)([0-9]+)?'.
				  '(?:#([0-9]+))?(?:\.([0-9]+))?([in%])/';
		if (setlocale(LC_MONETARY, 0) == 'C') {
			setlocale(LC_MONETARY, '');
		}
		$locale = localeconv();
		preg_match_all($regex, $format, $matches, PREG_SET_ORDER);
		foreach ($matches as $fmatch) {
			$value = floatval($number);
			$flags = array(
				'fillchar'  => preg_match('/\=(.)/', $fmatch[1], $match) ?
							   $match[1] : ' ',
				'nogroup'   => preg_match('/\^/', $fmatch[1]) > 0,
				'usesignal' => preg_match('/\+|\(/', $fmatch[1], $match) ?
							   $match[0] : '+',
				'nosimbol'  => preg_match('/\!/', $fmatch[1]) > 0,
				'isleft'    => preg_match('/\-/', $fmatch[1]) > 0
			);
			$width      = trim($fmatch[2]) ? (int)$fmatch[2] : 0;
			$left       = trim($fmatch[3]) ? (int)$fmatch[3] : 0;
			$right      = trim($fmatch[4]) ? (int)$fmatch[4] : $locale['int_frac_digits'];
			$conversion = $fmatch[5];

			$positive = true;
			if ($value < 0) {
				$positive = false;
				$value  *= -1;
			}
			$letter = $positive ? 'p' : 'n';

			$prefix = $suffix = $cprefix = $csuffix = $signal = '';

			$signal = $positive ? $locale['positive_sign'] : $locale['negative_sign'];
			switch (true) {
				case $locale["{$letter}_sign_posn"] == 1 && $flags['usesignal'] == '+':
					$prefix = $signal;
					break;
				case $locale["{$letter}_sign_posn"] == 2 && $flags['usesignal'] == '+':
					$suffix = $signal;
					break;
				case $locale["{$letter}_sign_posn"] == 3 && $flags['usesignal'] == '+':
					$cprefix = $signal;
					break;
				case $locale["{$letter}_sign_posn"] == 4 && $flags['usesignal'] == '+':
					$csuffix = $signal;
					break;
				case $flags['usesignal'] == '(':
				case $locale["{$letter}_sign_posn"] == 0:
					$prefix = '(';
					$suffix = ')';
					break;
			}
			if (!$flags['nosimbol']) {
				$currency = '';
			} else {
				$currency = '';
			}
			
			$space  = $locale["{$letter}_sep_by_space"] ? ' ' : '';

			$value = number_format($value, $right, $locale['mon_decimal_point'],
					 $flags['nogroup'] ? '' : $locale['mon_thousands_sep']);
			$value = @explode($locale['mon_decimal_point'], $value);

			$n = strlen($prefix) + strlen($currency) + strlen($value[0]);
			if ($left > 0 && $left > $n) {
				$value[0] = str_repeat($flags['fillchar'], $left - $n) . $value[0];
			}
			$value = implode($locale['mon_decimal_point'], $value);
			if ($locale["{$letter}_cs_precedes"]) {
				$value = $prefix . $currency . $space . $value . $suffix;
			} else {
				$value = $prefix . $value . $space . $currency . $suffix;
			}
			if ($width > 0) {
				$value = str_pad($value, $width, $flags['fillchar'], $flags['isleft'] ?
						 STR_PAD_RIGHT : STR_PAD_LEFT);
			}

			$format = str_replace($fmatch[0], $value, $format);
		}
		return $format;
	}
}
if(!function_exists('custom_number_format'))
{
    function custom_number_format($number) 
	{ 
		if(strlen($number)>3)
		{
			setlocale(LC_MONETARY, 'it_IT');
  			$money = money_format('%.2n', $number);
			$money = str_replace("EUR","",$money);
			$last_three =  substr($money, -3);
			$last_three = trim($last_three); 
			
			$last_four =  substr($money, -4);
			$last_four = trim($last_four); 
			if($last_three==',00' || $last_four==',00')
			{
				$money = substr($money, 0, -3);
				$money = str_replace(",","",$money);
				return $money;
			}
			else
			{
				return $money;
			}
		}
		else
		{
			return $number;
		}
	}
	if(!function_exists('user_total_shares_projections'))
	{
		function user_total_shares_projections($user_id) 
		{
			$ci =& get_instance();
			$ci->load->model("Users_m","users");
  			return $ci->users->user_total_shares_projections($user_id);
		}
	}
	
	if(!function_exists('total_user_active_projections'))
	{
		function total_user_active_projections($user_id,$projection_type) 
		{
			$ci =& get_instance();
			$ci->load->model("Users_m","users");
  			return $ci->users->total_user_active_projections($user_id,$projection_type);
		}
	}
	if(!function_exists('start_test_link'))
	{
		function start_test_link() 
		{
			$ci =& get_instance();
   			$start_test_link = base_url('users/SignIn');
			if(!empty($ci->session->userdata('MiPlani_user_id')))
			{
				$start_test_link = base_url('projections/NewProjection');
			} 
			return $start_test_link;
		}
	}
	if(!function_exists('add_review_link'))
	{
		function add_review_link() 
		{
			$ci =& get_instance();
   			$add_review_link = base_url('reviews/Add');
			return $add_review_link;
		}
	}
}
?>