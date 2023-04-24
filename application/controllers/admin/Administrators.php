<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrators extends CI_Controller {

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
		$data['title'] = 'Administrators';
		$where = array('us_id' => $this->session->userdata('user_id'));
		$data['admin'] = $this->UserModel->get_admin($this->admin_table,$where)->result_array()[0];
		
		$this->load->view('admin/pages/administrator',$data);
	}
}
