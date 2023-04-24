<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FlowModel extends CI_Model
{

public function __construct()
    {
        parent::__construct();
    }



public function get_flow($table,$where){


        $this->db->from($table);
        $this->db->where($where);
        $this->db->join('document_types','document_types.type_id = flow.d_type');
        $this->db->join('offices','offices.office_id = flow.off_id');
        $this->db->order_by('flow.number','asc');
        return $this->db->get();


}



public function get_flow_last_number($table,$where1){

        $this->db->from($table);
        $this->db->where($where1);
        $this->db->order_by('number','desc');
        $this->db->limit('1');
        return $this->db->get();
}


public function get_flow_id($table,$where1,$order_key,$order_by){

        $this->db->from($table);
        $this->db->where($where1);
        $this->db->order_by($order_key,$order_by);
        $this->db->limit('1');
        return $this->db->get();


}


   

}