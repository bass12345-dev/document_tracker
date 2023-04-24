<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
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
		$data['title'] = 'Dashboard';
		  $data['admin_access'] = $this->UserModel->verifyuser(array('us_id' =>$this->session->userdata('user_id')),$this->admin_table)->num_rows();
		$this->load->view('user/pages/dashboard',$data);
	}


	public function pdf()
	{

			$this->load->view('sample_pdf');

	}

	public function table(){
		$data['title'] = 'Offices';
		$this->load->view('table',$data);
	}
}
