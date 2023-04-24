<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RoleModel extends CI_Model
{

public function __construct()
    {
        parent::__construct();
    }



public function get_roles($table,$order_key,$order_by)
    {   
        $this->db->from($table);
	    $this->db->order_by($order_key,$order_by);
	    return $this->db->get();
    }

public function get_role($table,$where)
    {
        $this->db->from($table);
        $this->db->where($where);
        
        return $this->db->get();
    }   
   

}