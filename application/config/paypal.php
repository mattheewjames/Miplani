<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------
// Paypal library configuration
// ------------------------------------------------------------------------

// PayPal environment, Sandbox or Live
$config['sandbox'] = TRUE; // FALSE for live environment

// PayPal business email
$config['business'] = 'james.noah1172-facilitator@gmail.com';

// What is the default currency?
$config['paypal_lib_currency_code'] = 'USD';

// Where is the button located at?
$config['paypal_lib_button_path'] = base_url('WebTheme/images/pay.png');

// If (and where) to log ipn response in a file
$config['paypal_lib_ipn_log'] = TRUE;
$config['paypal_lib_ipn_log_file'] = BASEPATH . 'logs/paypal_ipn.log';

//Set Paypal Pro version and credentials.
$config['paypal_pro_api_version'] = '85.0'; 
$config['paypal_pro_api_endpoint'] = 'https://api-3t.sandbox.paypal.com/nvp'; //https://api-3t.paypal.com/nvp 
$config['paypal_pro_api_username'] = 'james.noah1172-facilitator_api1.gmail.com';
$config['paypal_pro_api_password'] = 'NTVU882UFU3875NQ';
$config['paypal_pro_api_signature'] = 'A1ea9sxwoswgycPtTIqmBquASl43AhS9RE1IzGLJ2lvhZgXJXj9BTlyT';