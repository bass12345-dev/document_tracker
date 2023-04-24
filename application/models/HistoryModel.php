<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HistoryModel extends CI_Model
{

public function __construct()
    {
        parent::__construct();
    }



public function getHistoryData($table,$where1,$where2,$where3,$order_key,$order_by)
    {       
            

        $this->db->from($table);
        $this->db->where($where1);
        $this->db->where($where2);
        $this->db->where($where3);
        $this->db->order_by($order_key,$order_by);
        $this->db->limit('1');
        return $this->db->get();
    }


public function getHistoryData1($table,$where1,$where2,)
    {       
            

        $this->db->from($table);
        $this->db->where($where1);
        $this->db->where($where2);
        return $this->db->get();
    }


public function get_nextDepartment($table,$where4,$flow_id)
    {

        $this->db->from($table);
        $this->db->where($where4);
        $this->db->where('flow_id > "'.$flow_id.'"');
        $this->db->limit('1');
        return $this->db->get();

    }



public function history_last_rec($table,$where1){

        $this->db->from($table);
        $this->db->where($where1);
        $this->db->order_by('history_id','desc');
        $this->db->limit('1');
        return $this->db->get();

}

public function history_first_rec($table,$where1){

        $this->db->from($table);
        $this->db->where($where1);
        $this->db->order_by('history_id','asc');
        $this->db->limit('1');
        return $this->db->get();

}


public function get_history($table,$where1){

        $this->db->from($table);
        $this->db->where($where1);
       
        return $this->db->get();
}

public function received_history($table,$where1,$where3){

        $this->db->from($table);
         $this->db->join('offices','history.office1 = offices.office_id');
          $this->db->join('users','history.user1 = users.user_id');
           $this->db->join('document_types','history.typ_id = document_types.type_id');
           $this->db->join('documents','history.t_number = documents.tracking_number');
        $this->db->where($where1);
         $this->db->where('history.status','received');
         $this->db->or_where('history.status','completed');
        $this->db->where($where3);
         $this->db->order_by('history.history_id','desc');
        return $this->db->get();

}



public function get_doc_history($table,$where1,$where2){

    $this->db->from($table);
    $this->db->join('documents','documents.tracking_number = history.t_number');
    $this->db->join('offices','office_id = history.office2');
    $this->db->join('users','users.user_id = history.user2');
    $this->db->where($where1);
    $this->db->where($where2);
    $this->db->order_by('history_id','desc');
    return $this->db->get();

}




public function get_outgoing_docs($table,$where1,$where2,$where3){

        $this->db->from($table);
        $this->db->join('documents','documents.tracking_number = history.t_number');
        $this->db->where($where1);
        $this->db->where($where2);
        $this->db->where($where3);
        $this->db->order_by('history_id','desc');
        return $this->db->get();

}
   

}