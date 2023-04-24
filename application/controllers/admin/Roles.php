<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {

	  public function __construct()
    {
    	parent::__construct();
        
    	  if (!$this->session->userdata('user_id')) {
            redirect('login');
        }    
    }

	public function index()
	{

		$data['title'] = 'Roles';
		$this->load->view('admin/pages/roles',$data);
	}
}
