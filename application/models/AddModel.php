<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AddModel extends CI_Model
{

public function __construct()
    {
        parent::__construct();
    }



public function add($data,$table_name)
    {
        $this->db->insert($table_name, $data);
        return $this->db->affected_rows();
    }



   

}