<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * Code Igniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		Rick Ellis
 * @copyright	Copyright (c) 2006, pMachine, Inc.
 * @license		http://www.codeignitor.com/user_guide/license.html
 * @link		http://www.codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * PayPal_Lib Controller Class (Paypal IPN Class)
 *
 * This CI library is based on the Paypal PHP class by Micah Carrick
 * See www.micahcarrick.com for the most recent version of this class
 * along with any applicable sample files and other documentaion.
 *
 * This file provides a neat and simple method to interface with paypal and
 * The paypal Instant Payment Notification (IPN) interface.  This file is
 * NOT intended to make the paypal integration "plug 'n' play". It still
 * requires the developer (that should be you) to understand the paypal
 * process and know the variables you want/need to pass to paypal to
 * achieve what you want.  
 *
 * This class handles the submission of an order to paypal as well as the
 * processing an Instant Payment Notification.
 * This class enables you to mark points and calculate the time difference
 * between them.  Memory consumption can also be displayed.
 *
 * The class requires the use of the PayPal_Lib config file.
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Commerce
 * @author      Ran Aroussi <ran@aroussi.com>
 * @copyright   Copyright (c) 2006, http://aroussi.com/ci/
 *
 */

// ------------------------------------------------------------------------



$config['clientId'] = '813346140332-t70fdtvatsgeiehkm89tqsqqlfb9jjij.apps.googleusercontent.com'; //add your client id
$config['clientSecret'] = 'U_q25jl1ExGE33Elpu0HEczp'; //add your client secret
//$config['redirectUri'] = 'http://goalwebs.com/rewarding_program/login/google_callback'; //add your redirect uri
$config['redirectUri'] = 'https://appvelo.com/Miplani/users/google_callback'; //add your redirect uri
//$config['redirectUri'] = 'http://localhost/consultancy/signup/google_callback'; //add your redirect uri
$config['apiKey'] = 'AIzaSyAVB7ckYPl3tGeI_WioONzHU9dGCe6WGz4'; //add your api key here
$config['applicationName'] ='miplani'; //application name for the api


?>