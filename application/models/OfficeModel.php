<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OfficeModel extends CI_Model
{

public function __construct()
    {
        parent::__construct();
    }



public function get_offices($table,$order_key,$order_by)
    {   
        $this->db->from($table);
	    $this->db->order_by($order_key,$order_by);
	    return $this->db->get();
    }


public function search_office($data)
    {
        $this->db->like('office', $data);
        $this->db->where('stat','active');
        return $this->db->get('offices')->result_array();
    }


public function get_office($table,$where)
    {
        $this->db->from($table);
        $this->db->where($where);
        
        return $this->db->get();
    }   
   

}