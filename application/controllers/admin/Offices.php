<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Offices extends CI_Controller {
	  public function __construct()
    {
    	parent::__construct();
        
    	  if (!$this->session->userdata('user_id')) {
            redirect('login');
        }    
    }

	public function index()
	{

		$data['title'] = 'Offices';
		$this->load->view('admin/pages/offices',$data);
	}
}
