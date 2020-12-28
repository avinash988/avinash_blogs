<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logout extends MY_Controller 
{

	function __construct() 
	{
        parent::__construct();
        // $this->auth_model->logged_in();
    }

	public function index()
	{
		

		session_destroy();
		redirect(base_url().'login');
	}

	public function get_ip()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
		{
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} 
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
		{
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} 
		else 
		{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
}

?>
