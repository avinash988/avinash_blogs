<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_Model extends CI_Model {

    public function get_blog_data()
    {
        $query = $this->db->query("SELECT * FROM blogs");
        return $query->result_array();
    }

 }

?>