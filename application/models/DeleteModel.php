<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DeleteModel extends CI_Model
{

public function __construct()
    {
        parent::__construct();
    }



public function delete($where,$table_name)
    {       
        $this->db->where($where);
        $this->db->delete($table_name);
        return $this->db->affected_rows();
    }



   

}