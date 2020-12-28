<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

session_start();

class Add_blog extends MY_Controller 
{

	function __construct() 
	{
        parent::__construct();
        $this->load->model('Add_blog_model');
        $this->session->set_userdata('page_title', 'Add Blog');
        $this->session->set_userdata('page_title_icon', '<i class="icon-bookmark mr-2"></i>');
    }

    public function index()
    {
    	$this->load->view("index");
    }

    public function add_new_blog_process()
    {
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('category', 'Blog Category', 'required');
            $this->form_validation->set_rules('title', 'Blog title', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('description', 'Blog Description', 'trim|required|min_length[5]');

            if($this->form_validation->run() == false)
            {
                $this->load->view("index");
            }
            else
            {
                date_default_timezone_set('Asia/Kolkata');
                $current_date = date('Y-m-d H:i:s');

                $added_by = $this->session->userdata('bh_full_name');

                $category  = $this->input->post('category');
                $title   = $this->input->post('title');
                $description = $this->input->post('description');
                $attachment = $_FILES['browse']['name'];

                $data = array(
                    'category'      => $category,
                    'title'         => $title,
                    'description'   => $description,
                    'image'         => $attachment,
                    'status'        => "Active",
                    'added_by'      => $added_by,
                    'added_on'      => $current_date,
                    'update_on'     => ""
                );

                // echo "<pre>";print_r($data);exit;
                $this->db->insert('blogs', $data);

                // file upload in folder

                if(!empty($_FILES['browse']['name']))
                {
                    $folder_name = './uploads/';
                    $config['upload_path'] = $folder_name;
                    $config['allowed_types'] = "jpg|png|jpeg|gif";
                    $config['file_name'] = $_FILES['browse']['name'];
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if($this->upload->do_upload('browse'))
                    {
                        $uploadData = $this->upload->data();
                        $browse = $uploadData['file_name'];
                    }
                }
                else
                {
                    $browse = '';
                }

                redirect("users");
            }
        }
        else
        {
            redirect("users");
        }
    }

}

?>
