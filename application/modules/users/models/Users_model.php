<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model {

	public function get_blog_data()
	{
		$query = $this->db->query('SELECT * FROM blogs');
        return $query->result_array();
	}

	public function get_view_blog_data($sr)
	{
		$query = $this->db->query("SELECT * FROM blogs WHERE sr = '".$sr."'");
        return $query->row_array();
	}

	public function get_edit_blog_data($sr)
	{
		$query = $this->db->query("SELECT * FROM blogs WHERE sr = '".$sr."'");
        return $query->row_array();
	}

	public function edit_blog_data($data, $sr)
	{
		$this->db->where('sr',$sr);
		$query = $this->db->update('blogs',$data);
	    if($query)
	    {
	      return true;
	    }
	    else
	    {
	      return false;
	    }
	}

	public function get_delete_blog_data($sr)
	{
		$query = $this->db->query("DELETE FROM blogs WHERE sr = '".$sr."'");
        if($query)
        {
        	return true;
        }else
        {
        	return false;
        }
	}
	

 }

?>
