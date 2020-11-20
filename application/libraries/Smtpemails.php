<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Smtpemails
{
 	public function send($receiver_email,$subject,$message)
	{
		//'protocol' => 'smtp', remove first line
   		 $config = Array(
 		  'smtp_host' => 'smtp.hostinger.com',
		  'smtp_port' => 587,
		  'smtp_user' => 'support@appvelo.com', // change it to yours
		  'smtp_pass' => 'support', // change it to yours
		  'mailtype' => 'html',
		  'charset'  => 'utf-8',
		  'wordwrap' => TRUE
		);
        $sender_email = "support@appvelo.com";
        $sender_name = "MIPLANi";
		$ci =& get_instance();
		$ci->load->library('email');
		$ci->email->initialize($config);
		$ci->email->set_newline("\r\n");
		$ci->email->from($sender_email,$sender_name);
 
 		$ci->email->to($receiver_email); 
		$ci->email->subject($subject);
		$ci->email->message($message);
		$ci->email->send();
 	}
}
