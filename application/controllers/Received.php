<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Received extends CI_Controller {

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

		if (isset($_GET['action'])) {


			if ($_GET['action'] === 'history') {
		
					$data['title'] = 'Received Documents';
					$this->load->view('user/action/view_received_docs',$data);

				}

		}else{

				$data['title'] = 'Received ';
			$this->load->view('user/pages/received',$data);
		}
	}
}
