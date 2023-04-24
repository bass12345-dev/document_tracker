<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TypeModel extends CI_Model
{

public function __construct()
    {
        parent::__construct();
    }



public function get_types($table,$order_key,$order_by)
    {   
        $this->db->from($table);
	    $this->db->order_by($order_key,$order_by);
	    return $this->db->get();
    }


public function get_type($table,$info)
    {
        $this->db->from($table);
        $this->db->where($info);
        return $this->db->get();
    }
    
}