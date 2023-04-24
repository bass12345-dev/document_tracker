<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{

public function __construct()
    {
        parent::__construct();
    }



public function get_users($table,$order_key,$order_by)
    {   
        $this->db->from($table);
        $this->db->join('offices','users.of_id = offices.office_id');
        $this->db->order_by('users.created',$order_by);
        return $this->db->get();
    }


   public function verifyuser($data,$table)
    {   
        $this->db->where($data);
        return $this->db->get($table);
    
    }

public function get_user($table,$info)
    {
        $this->db->from($table);
        $this->db->where($info);
         $this->db->join('offices','users.of_id = offices.office_id');
        return $this->db->get();
    }

public function search_user($data)
    {
        $this->db->like('first_name', $data);
         $this->db->or_like('middle_name', $data);
         $this->db->or_like('last_name', $data);
         $this->db->or_like('id_number', $data);
       $this->db->or_like('username', $data);
        return $this->db->get('users')->result_array();
    }




///Admin


    public function get_admins($table,$order_key,$order_by){

          $this->db->from($table);
        $this->db->join('users','admin.us_id = users.user_id');
        $this->db->order_by('admin.created_on',$order_by);
        return $this->db->get();

    }


    public function get_admin($table,$where){

        $this->db->from($table);
        $this->db->join('users','admin.us_id = users.user_id');
        $this->db->where($where);
        return $this->db->get();

    }
}