<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Track extends CI_Controller {

	 public $admin_table = 'admin';
	public function index()
	{	
		  $data['admin_access'] = $this->UserModel->verifyuser(array('us_id' =>$this->session->userdata('user_id')),$this->admin_table)->num_rows();
		$data['title'] = 'Track Document';
		$this->load->view('track',$data);
	}
}
