<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

session_start();

class Home extends MY_Controller
{
	function __construct()
	{
        parent::__construct();
        //$this->auth_login();
        $this->load->model('Home_model');
        $this->session->set_userdata('page_title', 'Welcome To Blogs');
        $this->session->set_userdata('page_title_icon', '<i class="icon-home2 mr-2"></i>');
    }

    public function index()
    {
        redirect('home/blogs');
    }
    public function blogs($cat_type = 'all', $page_num = '')
    {
        $data['cat_type'] = $cat_type;

        $data['per_page_result'] = $per_page_result = 2;

        if($page_num == '' && $page_num <= 0)
        {
            $page_num = 0;
            $data['page_start'] = 1;
            $data['page_end'] = $per_page_result;
            $data['page_num_lbl'] = 1;
        }
        else
        {
            $data['page_num_lbl'] = $page_num;
            $page_num = ($per_page_result*($page_num-1));
            $data['page_start'] = $page_num;
            $data['page_end'] = ($page_num + $per_page_result)-1;
        }

        $sq = "SELECT distinct(category) as category FROM blogs WHERE status = 'Active'";
        $q = $this->db->query($sq);

        $data['cat_list'] = $q->result_array();

        $cat_cond = '';
        if($cat_type != 'all')
        {
            $cat_cond = " AND category = '".$cat_type."'";
        }


        $sq = "SELECT * FROM blogs WHERE status = 'Active' ".$cat_cond." order by sr desc limit ".$page_num.", ".$per_page_result;

        //print_r($sq);exit;

        $q = $this->db->query($sq);

        $data['blog_list'] = $q->result_array();

        $sq = "SELECT count(sr) as total_records FROM blogs WHERE status = 'Active' ".$cat_cond;

        $q = $this->db->query($sq);

        $total_records = $q->row()->total_records;

        $page_records = 1;

        if($total_records > 2)
        {
            $page_records = $total_records/$per_page_result;

            $page_records = ceil($page_records);
        }

        $data['page_records'] = $page_records;

        $this->load->view('blogs',$data);

    }

}

?>
