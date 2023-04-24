<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public $role_table = 'roles';
     public $office_table = 'offices';
	public $order_key_created = 'created';
	public $order_by_desc = 'desc';
      public function __construct()
    {
        parent::__construct();
        
          if (!$this->session->userdata('user_id')) {
            redirect('login');
        }    
    }
	public function index()
	{	
		$data['title'] = 'Users';

		$data['roles'] = $this->RoleModel->get_roles($this->role_table,$this->order_key_created,$this->order_by_desc)->result_array(); 
        $data['offices'] = $this->OfficeModel->get_offices($this->office_table,$this->order_key_created,$this->order_by_desc)->result_array(); 

		 if (isset($_GET['action'])) {

            if ($_GET['action'] === 'add-user') {

                 $data['title'] = 'Add Users';
                $this->load->view('admin/actions/add_user',$data);
                # code...
            }else if ($_GET['action'] === 'edit-user') {

                $data['title'] = 'Update Users';                  
                $info = array('user_id' => $_GET['id']);
                
                $data['user'] = $this->UserModel->get_user($this->user_table,$info)->result_array()[0];

                $this->load->view('admin/actions/update_user',$data);

                # code...
            }
           
            
        }else {
            $data['title'] = 'Users';
            $this->load->view('admin/pages/users',$data);

        }

	}
}
