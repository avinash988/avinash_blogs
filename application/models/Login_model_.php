<?php

class Login_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function verify_uname_pwd($uname,$password)
	{
		$q = $this->db->where(['username'=>$uname,'password'=>$password,'status'=>'active'])
		->get('users');

		if($q->num_rows() > 0)
		{
            //$q->row();
			$id = $q->row()->username;
           // echo $id; exit;
			$this->session->set_userdata('tm_uname', $id);
			$this->set_cookies_for_auth($id);
			return true;
		}
		else
		{
			return false;
		}
	}

	public function logged_in()
	{
		if(!$this->session->has_userdata('tm_uname'))
		{
			redirect('home');
		}
	}

	public function logged_out()
	{
		$this->session->sess_destroy();
		
		setcookie('user_details', '', time()-7000000, '/');
		setcookie('company_details', '', time()-7000000, '/');
		setcookie('finance_details', '', time()-7000000, '/');

		redirect('home');
	}

	public function set_cookies_for_auth($uname)
	{

		$q = $this->db->where('username',$uname)->get('users');

        $res = $q->row();

        $cid = $res->cid;
        $name = $res->name;
        $id = $res->id;
        $email = $res->email;
        $mbl = $res->mbl;
        $status = $res->status;

        $this->session->set_userdata('satish_admin_cid', $cid);

        $sq = $this->db->where('id',$cid)->get('company');
        $com = $sq->row();

        $cname = $com->company_name;
        $pname = $com->person_name;
        $address1 = $com->address1;
        $address2 = $com->address2;
        $city = $com->city;
        $pin_code = $com->pin_code;
        $com_mbl = $com->mbl;
        $ph_no = $com->ph_no;
        $com_email = $com->email;
        $website = $com->website;
        $currency = $com->currency;
        $com_date = $com->date;
        $com_status = $com->status;

        $this->session->set_userdata('satish_admin_cname', $cname);

        $fq = $this->db->where('cid',$cid)->get('fin_year');
        $fin = $fq->row();

       	$fin_start_date = $fin->start_date;
        $fin_end_date = $fin->end_date;
        $fin_status = $fin->status;
        
        $user_details = $id."~".$cid."~".$name."~".$email."~".$mbl."~".$status;
        $company_details = $cname."~".$pname."~".$address1."~".$address2."~".$city."~".$pin_code."~".$com_mbl."~".$ph_no."~".$com_email."~".$website."~".$currency."~".$com_date."~".$com_status;

        $finance_details = $fin_start_date."~".$fin_end_date."~".$fin_status;
  
		setcookie("user_details", $user_details, time() + (86400 * 30), "/");
		setcookie("company_details", $company_details, time() + (86400 * 30), "/");
		setcookie("finance_details", $finance_details, time() + (86400 * 30), "/");

	}

	public function user_details($uname)
	{
		// $this->session->userdata('tm_uname');

		$q = $this->db->where('cid',$id)->get('users');

       // if($q->num_rows() > 0)
       // {
            //$q->row();
            $data = $q->result_array();

            return $data;
       // }


	}

	public function rand_id()
	{
		$length = 20;
		$token = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet.= "0123456789";
		$max = strlen($codeAlphabet); // edited

		for ($i=0; $i < $length; $i++) 
		{
			$token .= $codeAlphabet[rand(0, $max-1)];
		}

		return $token;
	}

	public function amt_in_words($number)
	{
	    $decimal = round($number - ($no = floor($number)), 2) * 100;
	    $hundred = null;
	    $digits_length = strlen($no);
	    $i = 0;
	    $str = array();
	    $words = array(0 => '', 1 => 'one', 2 => 'two',
	        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
	        7 => 'seven', 8 => 'eight', 9 => 'nine',
	        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
	        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
	        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
	        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
	        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
	        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
	    $digits = array('', 'hundred','thousand','lakh', 'crore');
	    while( $i < $digits_length ) {
	        $divider = ($i == 2) ? 10 : 100;
	        $number = floor($no % $divider);
	        $no = floor($no / $divider);
	        $i += $divider == 10 ? 1 : 2;
	        if ($number) {
	            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
	            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
	            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
	        } else $str[] = null;
	    }
	    $Rupees = implode('', array_reverse($str));
	    $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
	    //return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
	    return ($Rupees ? $Rupees . ' ' : '') . $paise;
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

	public function avinash()
	{
		echo "hello";
	}


}

?>


