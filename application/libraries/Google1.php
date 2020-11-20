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




class Google 
{
    public function __construct()
    {
        $this->ci =& get_instance();
        include_once 'gmail_sdk/autoload.php';
        $this->ci->load->config('google');
        $this->ci->load->library('session');
        $this->client = new Google_Client();
        $this->client->setApplicationName($this->ci->config->item('applicationName'));
        $this->client->setClientId($this->ci->config->item('clientId'));
        $this->client->setClientSecret($this->ci->config->item('clientSecret'));
        $this->client->setRedirectUri($this->ci->config->item('redirectUri'));
        $this->client->setDeveloperKey($this->ci->config->item('apiKey'));
        $this->client->addScope('https://www.googleapis.com/auth/userinfo.email');
        $this->client->addScope('https://www.googleapis.com/auth/userinfo.profile');
        $this->client->setAccessType('offline');
        if($this->ci->session->userdata('refreshToken')!=null)
        {
            $this->loggedIn = true;
            if($this->client->isAccessTokenExpired())
            {
                $this->client->refreshToken($this->ci->session->userdata('refreshToken'));

                $accessToken = $this->client->getAccessToken();
                $this->client->setAccessToken($accessToken);
            }
        }
        else
        {
            $accessToken = $this->client->getAccessToken();
            if($accessToken!=null)
            {
                $this->client->revokeToken($accessToken);
            }
            $this->loggedIn = false;
        }
    }
    public function isLoggedIn()
    {
        return $this->loggedIn;
    }
    public function getLoginUrl()
    {
        return $this->client->createAuthUrl();
    }
    public function setAccessToken()
    {
		if(!empty($_GET['code']))
		{
			$this->client->authenticate($_GET['code']);
			$accessToken = $this->client->getAccessToken();
			$this->client->setAccessToken($accessToken);
			if(isset($accessToken['refresh_token']))
			{
				$this->ci->session->set_userdata('refreshToken', $accessToken['refresh_token']);
			}
		}
    }
    public function getUserInfo()
    {
        $service = new Google_Service_Oauth2($this->client);
        return $service->userinfo->get();
    }
    public function logout()
    {
        $this->ci->session->unset_userdata('refreshToken');
        $accessToken = $this->client->getAccessToken();
        if($accessToken!=null)
        {
            $this->client->revokeToken($accessToken);
        }
    }
}


