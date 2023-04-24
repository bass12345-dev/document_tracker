<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Track_document extends CI_Controller {

	 public $admin_table = 'admin';
	  public function __construct()
    {
    	parent::__construct();
        
    	  if (!$this->session->userdata('user_id')) {
            redirect('login');
        }    
    }

	public function index()
	{	
		  $data['admin_access'] = $this->UserModel->verifyuser(array('us_id' =>$this->session->userdata('user_id')),$this->admin_table)->num_rows();
		$data['title'] = 'Track Document';
		$this->load->view('user/pages/track_document',$data);
	}
}
