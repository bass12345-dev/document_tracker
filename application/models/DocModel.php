<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DocModel extends CI_Model
{

public function __construct()
    {
        parent::__construct();
    }



public function get_all_docs($table,$order_key,$order_by)
    {   
        $this->db->select("documents.created AS 'created_on'");
        $this->db->select("documents.tracking_number AS 'tracking_number'");
        $this->db->select("document_types.type_name AS 'type_name'");
        $this->db->select("documents.document_id AS 'document_id'");
        $this->db->from($table);
         $this->db->join('document_types','document_types.type_id = documents.doc_type');
        $this->db->order_by('documents.'.$order_key,$order_by);
        return $this->db->get();
    }




public function get_my_docs($table,$where,$order_key,$order_by)
    {   

        $this->db->select("documents.created AS 'created_on'");
        $this->db->select("documents.tracking_number AS 'tra_number'");
        $this->db->select("documents.document_id AS 'document_id'");
        $this->db->select("documents.u_id AS 'u_id'");
        $this->db->select("documents.qr_code AS 'qr_code'");
        $this->db->select("documents.doc_type AS 'doc_type'");

        $this->db->from($table,'document_types');
        $this->db->join('users','users.user_id = documents.u_id');
        // $this->db->where('documents.doc_type = document_types.type_id');
        $this->db->where($where);
        $this->db->order_by('documents.'.$order_key,$order_by);
        return $this->db->get();
    }


public function get_doc($table,$info)
    {
        $this->db->from($table);
        $this->db->where($info);
        $this->db->join('users','users.user_id = documents.u_id');
         $this->db->join('document_types','document_types.type_id = documents.doc_type');
        return $this->db->get();
    }

public function get_do($table,$info)
    {
        $this->db->from($table);
        $this->db->where($info);
        return $this->db->get();
    }



public function get_received_docs($table,$where3,$where4,$where5){

        $this->db->from($table);
        $this->db->join('documents','documents.tracking_number = history.t_number');
        // $this->db->where($where1);
        // $this->db->where($where2);
        $this->db->where($where3);
        $this->db->where($where4);
        $this->db->where($where5);
        $this->db->order_by('history_id','desc');
        return $this->db->get();

}


public function get_received_docs1($table,$where3,$where4,$where5){

        $this->db->from($table);
        $this->db->join('documents','documents.tracking_number = history.t_number');
        // $this->db->where($where1);
        // $this->db->where($where2);
        $this->db->where($where3);
        $this->db->where($where4);
        $this->db->where($where5);
        $this->db->where('history.status != "completed"');
        $this->db->order_by('history_id','desc');
        return $this->db->get();

}



public function get_incoming_docs($table,$where1,$where2){

        $this->db->from($table);
        $this->db->join('documents','documents.tracking_number = history.t_number');
        $this->db->join('document_types','document_types.type_id = documents.doc_type');
        $this->db->where($where1);
        $this->db->where($where2);
        $this->db->order_by('history.history_id','desc');
        $this->db->limit('1');
        return $this->db->get();

}

   

}