<?php

class Login_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function verify_uname_pwd($uname,$password)
	{
		$q = $this->db->where(['username'=>$uname,'pwd'=>$password,'status'=>'1'])->get('user');

		if($q->num_rows() > 0)
		{
			$a = $q->row();
			// echo "<pre>";print_r($a);exit;

			$this->session->sess_expiration = '3600';// expires in 1 hours
			$this->session->set_userdata('bh_full_name', $a->username);
			$this->session->set_userdata('bh_uid', $a->userid);
			$this->session->set_userdata('bh_u_sr', $a->sr);

			$current_date = date("Y-m-d H:i:s");
			
			return true;
		}
		else
		{
			return false;
		}
	}

	public function date_diff_in_days($date1)  
	{ 
		// Calulating the difference in timestamps
		
		$current_date = date('Y-m-d');

		$current_date_str = strtotime($current_date);

		$date1_str = strtotime($date1);

		if($date1_str > $current_date_str)
		{
			$diff = $date1_str - $current_date_str; 
		
			// 1 day = 24 hours 
			// 24 * 60 * 60 = 86400 seconds 
			return abs(round($diff / 86400)); 
		}
		else 
		{
			return 0;
		}

		
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


