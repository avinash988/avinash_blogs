<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

session_start();
	
class Login extends MY_Controller {

	function __construct() 
	{
        parent::__construct();
        $this->load->model("login_model");
    }

	public function index()
	{
		
		if(isset($_POST['submit']))
        {
			$this->form_validation->set_rules('username','User Name','required');
			$this->form_validation->set_rules('password','Password','required');

			if($this->form_validation->run())
			{
				$uname = $this->input->post('username');
				$password = $this->input->post('password');

				if($this->login_model->verify_uname_pwd($uname,$password))
				{
					//echo "<pre>";print_r("login success");exit;
					redirect('users');
				}
				else
				{
					$this->session->set_flashdata('login_message', '<div class="alert alert-danger">Invalid Username / Password</div>');
					$this->load->view('login');
					//echo "login failed";
				}
			}
			else
			{
				$this->load->view('login');
			}
		}
		else
		{
			$this->load->view("login");
		}
	}

	public function test()
	{
		echo $this->session->userdata('bh_uid');
	}

}
?>
