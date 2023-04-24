<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documents extends CI_Controller {

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
		// $data['title'] = 'My Documents';
		// $this->load->view('user/pages/documents',$data);
		 $data['types'] = $this->TypeModel->get_types($this->type_table,$this->order_key_created,$this->order_by_desc)->result_array(); 

          $data['admin_access'] = $this->UserModel->verifyuser(array('us_id' =>$this->session->userdata('user_id')),$this->admin_table)->num_rows();

		if (isset($_GET['action'])) {

            if ($_GET['action'] === 'print-tracking-slip') {
  
                // require_once(APPPATH.'helpers/TCPDF/tcpdf.php');
                $info = array('tracking_number' => $_GET['tracking-number'],'u_id'=> $_GET['user-id']);

                

                $data['doc'] = $this->DocModel->get_doc($this->document_table,$info)->result_array()[0];

      
                $data['title'] = $info['tracking_number'];
                 $this->load->view('user/action/print_tracking_slip',$data);
    
            }else if($_GET['action'] === 'view-history'){
                
            $data['title'] = 'History';
            $this->load->view('user/action/view_history',$data);

            }else if($_GET['action'] === 'add-document') {

           $data['title'] = 'Add Document';
            $this->load->view('user/action/add_document',$data);
        }else if($_GET['action'] === 'print-document') {

        	 $this->load->view('sample_pdf',$data);

            # code...
        }else if ($_GET['action'] === 'update-doc') {



             $data['title'] = 'Update';
            $this->load->view('user/action/update_doc',$data);
            // code...
        }
        }else {

             $data['title'] = 'Documents';
            $this->load->view('user/pages/documents',$data);

        }
	}


	
}
