    <?php
	class MY_Controller extends CI_Controller 
	{
		function __construct()
		{
            parent::__construct();
            date_default_timezone_set("Asia/Calcutta");
        }
        
        public function auth_login()
        {
             if(!$this->session->has_userdata('bh_uid')){
                header('Location: '.base_url('login'));
                exit;
            } 
        }

		public function create_activity_log_old132($work_id, $added_by, $remark, $type)
		{
			$current_date = date("Y-m-d H:i:s");
			$insert_data = array(
				'work_id' 		=> $work_id,
				'added_by'		=> $added_by,
				'added_on'		=> $current_date,
				'remark'		=> $remark,
				"type"			=> $type
			);

			$this->db->insert('activity_log', $insert_data);
		}

		public function send_email($subject, $email_body, $to_email, $cc = '', $bcc = '', $attachments = '')
		{
			$smtp_host = 'ssl://smtp.googlemail.com';
			$smtp_port = '465';
			$smtp_user = 'cocktail@akbaroffshore.com';
			$smtp_pass = 'ATmail2020';


			$frm_email = $smtp_user;
			$frm_name = 'Cocktail Alert';

			$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => $smtp_host,
				'smtp_port' => $smtp_port,
				'smtp_user' => $smtp_user,
				'smtp_pass' => $smtp_pass,
				'SMTPSecure' => 'ssl',
				'mailtype' => 'html',
				'newline' => '\r\n',
				'smtp_timeout' => '120',
				'crlf' => '\r\n',
				'starttls'  => true,
				'charset' => 'utf-8',
				'wordwrap' => TRUE,
				'mailpath' =>'/usr/sbin/sendmail'
				);

	

				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				$this->email->from($frm_email, $frm_name);

				//$subject = "Welcome to Cocktail";

				//$to_email = "purvesh.b@akbaroffshore.com";

				//$cc = '';

				//$email_body = $this->email_body();

				$this->email->subject($subject);

				$this->email->to($to_email);

				if($cc <> "")
				{
					$this->email->cc($cc);
				}

				if($bcc <> "")
				{
					$this->email->bcc($bcc);
				}

				if($attachments <> "")
				{
					$this->email->attach($attachments);
				}
								
				$this->email->message($email_body);
				
				$this->email->send();

		}

	}

	?>


