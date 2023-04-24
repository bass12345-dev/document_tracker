<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UpdateModel extends CI_Model
{

public function __construct()
    {
        parent::__construct();
    }



public function update($where,$data,$table_name)
    {       
        $this->db->where($where);
        $this->db->update($table_name, $data);
        return $this->db->affected_rows();
    }


public function update2($where1,$where2,$data,$table_name){

        $this->db->where($where1);
        $this->db->where($where2);
        $this->db->update($table_name, $data);
        return $this->db->affected_rows();

}

public function update3($where1,$where2,$where3,$data,$table_name){

        $this->db->where($where1);
        $this->db->where($where2);
        $this->db->where($where3);
        $this->db->update($table_name, $data);
        return $this->db->affected_rows();

}


   

}