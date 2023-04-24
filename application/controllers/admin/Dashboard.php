<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	  public $history_table = 'history';
    public $document_table = 'documents';
	public $role_table = 'roles';
    public $user_table = 'users';
    public $office_table = 'offices';
    public $type_table = 'document_types';
    public $flow_table = 'flow';
    public $admin_table = 'admin';
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
		$data['title'] = 'Dashboard';

		$data['count_all_documents'] = $this->DocModel->get_all_docs($this->document_table,$this->order_key_created,$this->order_by_desc)->num_rows(); 
		$data['count_all_user'] = $this->UserModel->get_users($this->user_table,$this->order_key_created,$this->order_by_desc)->num_rows();
		 $data['count_all_office'] = $this->OfficeModel->get_offices($this->office_table,$this->order_key_created,$this->order_by_desc)->num_rows();

		$data['count_all_admin'] = $this->UserModel->get_admins($this->admin_table,$this->order_key_created,$this->order_by_desc)->num_rows();
		$this->load->view('admin/pages/dashboard',$data);
	}
}
