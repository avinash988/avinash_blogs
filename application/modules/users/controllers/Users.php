<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

class Users extends MY_Controller 
{

	function __construct() 
	{
        parent::__construct();
        $this->load->model('Users_model');
        $this->session->set_userdata('page_title', 'Users');
        $this->session->set_userdata('page_title_icon', '<i class="icon-user mr-2"></i>');
    }

    public function index()
    {
        $data['res'] = $this->Users_model->get_blog_data();
    	$this->load->view("index", $data);
    }

    public function view($sr)
    {
        $data['res'] = $this->Users_model->get_view_blog_data($sr);
        $this->load->view("view", $data);
    }

    public function edit($sr)
    {
        $data['res'] = $this->Users_model->get_edit_blog_data($sr);
        $this->load->view("edit", $data);
    }

    public function edit_blog_process()
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

                $sr  = $this->input->post('sr');
                $added_on  = $this->input->post('added_on');
                $category  = $this->input->post('category');
                $title   = $this->input->post('title');
                $description = $this->input->post('description');
                $attachment = $_FILES['browse']['name'];

                if($attachment == "")
                {
                    $image_file = $this->input->post('old_user_image');
                }
                else
                {
                    $image_file = $_FILES['browse']['name'];
                }

                $data = array(
                    'category'      => $category,
                    'title'         => $title,
                    'description'   => $description,
                    'image'         => $image_file,
                    'status'        => "Active",
                    'added_by'      => $added_by,
                    'added_on'      => $added_on,
                    'update_on'     => $current_date
                );

                // echo "<pre>";print_r($data);exit;
                $result = $this->Users_model->edit_blog_data($data,$sr);

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

    public function delete($sr)
    {
        $result = $this->Users_model->get_delete_blog_data($sr);
        if($result)
        {
            redirect("users");
        }else
        {
            echo "Something is wrong";
        }
    }



}

?>
