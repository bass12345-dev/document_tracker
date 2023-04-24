<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

    public $history_table = 'history';
    public $document_table = 'documents';
	public $role_table = 'roles';
    public $user_table = 'users';
    public $office_table = 'offices';
    public $type_table = 'document_types';
    public $flow_table = 'flow';
    public $admin_table = 'admin';
    public $log_table = 'action_history_logs';
	public $order_key_created = 'created';
	public $order_by_desc = 'desc';



	public function index()
	{
		$this->load->view('user/dashboard');
	}



    ////Authentication


    public function verifyuser(){


    $info = array('username' => $this->input->post('username'));
    $pass = $this->input->post('password');
    $verify = $this->UserModel->verifyuser($info,$this->user_table)->num_rows();

    if ($verify > 0) {
            $user = $this->UserModel->verifyuser($info,$this->user_table)->result_array()[0];
            $x = password_verify($pass,$user['password']); 
            if ($x) {
                      $data['response'] = true;
                      $this->session->set_userdata($user);
            }else {

                      $data['response'] = false; 
                      $data['message'] = 'Invalid Password'; 
            }
            // $data['response'] = true ; 
        }else {
            $data['response'] = false ;
          $data['message'] = 'Username Not Found'; 

        }

        echo json_encode($data);

  
    }


    
    function logout() {
       $this->load->library('session');
        $this->session->unset_userdata('user_id');
        // delete_cookie('SESSION_TOKEN',);
        redirect('login');
    }



public function load_user_data(){

    $user = array('user_id' => $this->session->userdata('user_id'));
    $user_row = $this->UserModel->get_user($this->user_table,$user)->result_array()[0];

    $data[] = [
                    'name' => $user_row['first_name'].' '.$user_row['middle_name'].' '.$user_row['last_name'].' '.$user_row['extension'],
                    'pic' => $user_row['profile_picture'] != NULL ? base_url().'uploads/profile_pic/'.$user_row['profile_picture'] : base_url().'assets/empty.png',
                    'office' => 'Office of the '.$user_row['office']
    ];

    echo json_encode($data);

}

	//Roles

	function getRoles(){

		$data['data'] = [];	
        			$results = $this->RoleModel->get_roles($this->role_table,$this->order_key_created,$this->order_by_desc)->result_array(); 
        				foreach($results as $row){
					$data['data'][] = array(
                		'role' => $row['role'],
                		'role_id' => $row['role_id'],
                	);
     
		}

		 echo json_encode($data);
	}

public function addRole(){
            $info = array
                        (
                            'role' => $this->input->post('role'),
                            'created' => date('Y-m-d H:i:s', time()), 
                        );             
            $this->condition($this->AddModel->add($info,$this->role_table));
    }


public function condition($check){

            if ($check > 0) {
                    $data['response'] = true;
                }else
                {
                    // $data['error'] = $this->db->_error_message();
                    $data['response'] = false;
                }

        echo json_encode($data);

   }

   ///users

   public function getUsers(){

        $data = [];

        $users = $this->UserModel->get_users($this->user_table,$this->order_key_created,$this->order_by_desc)->result_array(); 
        foreach($users as $row){

            $rids = explode(" ", $row['role']);
            $r = [];
            foreach ($rids as $r_row) {
                $where = array('role_id' => $r_row);
            
            $rr = $this->RoleModel->get_role($this->role_table,$where)->result_array();

           

                foreach ($rr as $rrow) {

                    $r[] = array('role' => $rrow['role']);

                }

          }


            

            $data['data'][] = array(

                'name' => $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'].' '.$row['extension'],
                'username' => $row['username'],
                'user_id' => $row['user_id'],
                'role' => $r,
                'office' => $row['office'],
                'created' => date('M-d-Y', strtotime($row['created']))
               


            );
            
            

        } 
        echo json_encode($data);
    }



     public function addUser(){

            
            $info = array
                        (
                            'id_number' => $this->input->post('employee_id'),
                            'first_name' => $this->input->post('first_name'),
                            'middle_name' => empty($this->input->post('middle_name')) ? '' : $this->input->post('middle_name'),
                            'last_name' => $this->input->post('last_name'),
                            'extension' => empty($this->input->post('extension')) ? '' : $this->input->post('extension'),
                            'email_address' => $this->input->post('email'),
                            'role' => $this->input->post('role'),
                            'of_id' => $this->input->post('office_id'),
                            'created' => date('Y-m-d H:i:s', time()), 
                             'profile_picture' => ($_FILES['userfile']['tmp_name'] === '' ) ? NULL : $this->upload_image(),
                            'username' => $this->input->post('username'),
                            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT) ,
                            'role' => join(" ",$_POST['check_list']),
                        );   

            $this->condition($this->AddModel->add($info,$this->user_table));
    }





function upload_image(){

    if (isset($_FILES['userfile'])) {

        $extension = explode('.', $_FILES['userfile']['name']);
        $new_name = rand().'.' . $extension[1];
        $destination = './uploads/profile_pic/'. $new_name;
        move_uploaded_file($_FILES['userfile']['tmp_name'], $destination);
        return $new_name;
      # code...
    }

}


// Offices
     public function getOffices(){

      $data['data'] = [];   

        $offices = $this->OfficeModel->get_offices($this->office_table,$this->order_key_created,$this->order_by_desc)->result_array(); 
        foreach($offices as $row){
            
            $data['data'][] = array(

                'office' => $row['office'],
                'status' => $row['stat'],
                'office_id' => $row['office_id'],
                'color' => ($row['stat'] == 'active') ? 'bg-primary' : 'bg-danger',


            );
            
            

        } 
        echo json_encode($data);
    }


     public function addOffice(){




            
            $info = array
                        (
                            'office' => $this->input->post('office'),
                            'stat' => $this->input->post('status'),
                            'created' => date('Y-m-d H:i:s', time()), 
                            
                        );  

               if ($this->AddModel->add($info,$this->office_table)) {


                    $info2 = array(
                            'usr_id' => $this->session->userdata('user_id'),
                            'description' => 'User '.'<a href="javascript:;" data-id="'.$this->session->userdata('user_id').'" class="view-profile">'.$this->session->userdata('id_number').'</a> added '.'<a href="javascript:;" data-id="'.$this->db->insert_id().'" class="view-office">Office</a>',   
                            'date_time' => date('Y-m-d H:i:s', time()),
                    );
                    $this->AddModel->add($info2,$this->log_table);
                    $data['response'] = true;
                }else
                {
                   
                    $data['response'] = false;
                }

                echo json_encode($data);


           
      

              
    }



public function updateOffice(){


        $info = array('office' => $this->input->post('update_office_name'), 'stat' =>$this->input->post('update_status')  );   
        $where = array('office_id' =>  $this->input->post('office_id'));
        $this->condition($this->UpdateModel->update($where,$info,$this->office_table));
}

public function delete_office(){
    $where  = array('office_id' => $this->input->post('id'));
    $this->condition($this->DeleteModel->delete($where,$this->office_table));
}



public function search_office(){


        $key      = $_GET['key'];
        $offices = $this->OfficeModel->search_office($key);
        $data     = [];
        foreach ($offices as $row) {
            $data[] = $row;
        }

        echo json_encode($data);
    }



// Types


    function get_types(){

        $data['data'] = []; 
                    $types = $this->TypeModel->get_types($this->type_table,$this->order_key_created,$this->order_by_desc)->result_array(); 
                        foreach($types as $row){
                    $data['data'][] = array(
                        'type_name' => $row['type_name'],
                        'type_id' => $row['type_id'],
                    );
     
        }

         echo json_encode($data);
    }



public function AddType(){
    $info = array
                        (
                            'type_name' => $this->input->post('d_type'), 
                            'created' => date('Y-m-d H:i:s', time()), 
                            
                        );     

            
            $add =   $this->AddModel->add($info,$this->type_table);

            if ($add > 0) {

                $info1 = array(
                            'off_id' => '',
                            'd_type' => $this->db->insert_id(),
                            'number' => 1
                ); 

               

                $add1 = $this->AddModel->add($info1,$this->flow_table);

                if($add1 > 0){

                     $info2 = array(
                            'usr_id' => $this->session->userdata('user_id'),
                            'description' => 'User '.'<a href="javascript:;" data-id="'.$this->session->userdata('user_id').'" class="view-profile">'.$this->session->userdata('id_number').'</a> created Document '.'<a href="javascript:;" data-id="'.$info1['d_type'].'" class="view-type">Type</a>',   
                            'date_time' => date('Y-m-d H:i:s', time()),
                    );
                   $this->AddModel->add($info2,$this->log_table);
                    $data['type_id'] = $info1['d_type'];
                     $data['response'] = true;
                }
             

               
            }else{
                $data['response'] = false;
            }
           echo json_encode($data);
}


//Flow



public function update_office_flow(){


        $info = array('off_id' => $this->input->post('department_id1'));   
        $where = array  ('flow_id' =>  $this->input->post('update_flow_id'));
        $this->condition($this->UpdateModel->update($where,$info,$this->flow_table));
}




    function delete_flow(){

        $where = array('flow_id' => $this->input->post('id'));     
        $this->condition($this->DeleteModel->delete($where,$this->flow_table));

    }


  public function update_flow(){

        $where1 = array('d_type' => $this->input->post('type_id'));
        $x = 0;
        $x = $this->FlowModel->get_flow_last_number($this->flow_table,$where1)->result_array()[0]['number'];

        $info = array(
            'd_type' => $this->input->post('type_id'),
            'off_id' => $this->input->post('department_id'),
            'number'=> $x + 1,
        );      


        $add = $this->AddModel->add($info,$this->flow_table);
        $flow_id = $this->db->insert_id();

        if($add) {

               
                $data['flow_id'] = $flow_id;
                $data['type_id'] = $info['d_type'];
                $where2 = array('office_id' => $info['off_id']);
                $office_row = $this->OfficeModel->get_office($this->office_table,$where2)->result_array()[0];

                $data['department_name'] = $office_row['office'];
                $data['response'] = true;

        }else{

            $data['response'] = false;

        }

        echo json_encode($data);
    }


public function GetFlow(){
    $where = array('d_type' => $_GET['type_id']);

    $flows = $this->FlowModel->get_flow($this->flow_table,$where)->result_array();


    // $user = array('user_id' => $this->session->userdata('user_id'));
    // $user_row = $this->UserModel->get_user($this->user_table,$user)->result_array()[0];

    $data = [];
    foreach ($flows as $row) {


           

                $data[] = array(

                        'department_name' => $row['office'],
                        'flow_id' => $row['flow_id'],
                        // 'x' => ($row['number'] == 1)? true : false,
                        'type_id' => $where['d_type']
                );
        # code...
    }

    echo json_encode($data);
}

//Documents




public function addDoc(){


            require_once(APPPATH.'helpers/phpqrcode/qrlib.php');
            $tempDir = './uploads/qr_codes/'; 
            // we building raw data
            $fileName = 'QR-'.rand().'.png';

            $info = array
                        (
                            // 'document_name' => $this->input->post('file_name'),
                            // 'document_description' => $this->input->post('file_description'),
                            'created' => date('Y-m-d H:i:s', time()), 
                            'tracking_number' => mt_rand(),
                            'qr_code' => $fileName,
                            'u_id' => $this->session->userdata('user_id'),
                            'offi_id' => $this->session->userdata('of_id'),
                            'doc_type' => $this->input->post('type_id')
                        );   

            $codeContents = $info['tracking_number'];
                // generating
            QRcode::png($codeContents, $tempDir.$fileName, QR_ECLEVEL_L, 3); 



            if ($this->AddModel->add($info,$this->document_table)) {
                    

             

                $where = array('document_id' =>$this->db->insert_id());
                $row = $this->DocModel->get_doc($this->document_table,$where)->result_array()[0];


                $order_key = 'number';
                $order_by = 'asc';

                $where1 = array('d_type' => $row['doc_type']);
                $frow = $this->FlowModel->get_flow_id($this->flow_table,$where1,$order_key,$order_by)->result_array()[0];
                $info1 = array(
                                't_number' =>  $row['tracking_number'],
                                'user1'        =>  $row['user_id'],
                                'office1'        =>  $row['of_id'],
                                'user2'      =>  $row['user_id'],
                                'office2'        =>  $row['of_id'],
                                'status'        =>  'received',
                                'received_status'        =>  '1',
                                'received_date' => date('Y-m-d H:i:s', time()), 
                                'release_status'        =>  '0',
                                'release_date' => date('Y-m-d H:i:s', time()), 
                                'f_id'                  => $frow['flow_id'],
                                'typ_id'               => $row['doc_type']


                );

                $this->AddModel->add($info1,$this->history_table);

                $data['response'] = true;
                $data['id'] = $this->db->insert_id();
                $data['tracking_code'] = $row['tracking_number'];
                $data['user_id'] = $row['user_id'];
                // creating Qr Code

                

                # code...
            }else{
                 $data['response'] = false;
            }

            // $this->condition($this->AddModel->add($info,$this->file_table));
             echo json_encode($data);
    }



       function GetDocument(){

        $where = array
                        (
                            'document_id' => $_GET['id'],
                           
                        );    
         
        $doc = $this->DocModel->get_doc($this->document_table,$where)->result_array()[0];

        $data = ['type_id' => $doc['type_id']];


        echo json_encode($data);

    }



    function delete_document(){

        $where = array
                        (
                            'document_id' => $this->input->post('id'),
                           
                        );    
         
        $this->condition($this->DeleteModel->delete($where,$this->document_table));

    }


        public function getAllDocuments(){

        $data['data'] = [];

        $files = $this->DocModel->get_all_docs($this->document_table,$this->order_key_created,$this->order_by_desc)->result_array(); 
        foreach($files as $row){
            
    
            // $data['data'][] = $row; 

            $data['data'][] = array(

                'tracking_code' => $row['tracking_number'],
                // 'document_name' => $row['document_name'],
                // 'document_description' => $row['document_description'],
                'document_type' => $row['type_name'],
                'doc_id' => $row['document_id'],
                'created' => date('M-d-Y', strtotime($row['created_on'])),
                'time' => date('h:i a', strtotime($row['created_on']))
            );
            
            

        } 
        echo json_encode($data);
    }



    public function getMyDocs(){

        $data['data'] = [];
        $where = array('offi_id'=>$this->session->userdata('of_id'));
        $files = $this->DocModel->get_my_docs($this->document_table,$where,$this->order_key_created,$this->order_by_desc)->result_array();
        foreach($files as $row){



            $where1  = array('t_number' => $row['tra_number']);
            $hrow = $this->HistoryModel->history_last_rec($this->history_table,$where1)->result_array()[0];
            $hlrow = $this->HistoryModel->history_first_rec($this->history_table,$where1)->result_array()[0];
            $where2 = array('type_id'=>$row['doc_type']);
            $trow = $this->TypeModel->get_type($this->type_table,$where2)->result_array()[0];
    
            // $data['data'][] = $row; 

            $data['data'][] = array(

                'tracking_number' => $row['tra_number'],
                'document_id' => $row['document_id'],
                'created' => date('M-d-Y', strtotime($row['created_on'])),
                'time' => date('h:i A', strtotime($row['created_on'])),
                'user_id' => $row['u_id'],
                'qr_code' => $row['qr_code'],
                'document_type' => $trow['type_name'],        
                'upde' => ($hlrow['release_status'] == 1) ? true : false,
                'status' => ($hrow['status'] == 'completed') ? 'completed' : 'pending',
                'color' => ($hrow['status'] == 'completed') ? 'btn-primary' : 'btn-warning',
            );
            
            

        } 
        echo json_encode($data);
    }





        public function getMyRecDocs(){

            $user = array('user_id' => $this->session->userdata('user_id'));
            $user_row = $this->UserModel->get_user($this->user_table,$user)->result_array()[0];
            // $where1 = array('user2' => $user_row['user_id']);
            // $where2 = array('office2' =>$user_row['of_id']);
            $where3 = array('received_status' => 1);
            $where4 = array('release_status' => 0);  
            $where5 = array('status' => 'received');
            $r = $this->DocModel->get_received_docs($this->history_table,$where3,$where4,$where5)->result_array();
            $data['data'] = [];

            $r_action = false;
            $role = $this->session->userdata('role');
                        $rids = explode(" ", $role);
                       
                        foreach ($rids as $r_row) {
                                $where = array('role_id' => $r_row);
                            
                            $rr = $this->RoleModel->get_role($this->role_table,$where)->result_array();

                           

                                foreach ($rr as $rrow) {

                                        if ($rrow['role'] == 'Releaser'  ) {

                                            $r_action = true;


                                        }

                                    }

                            }




            foreach ($r as $row) {
       
            $where6 = array('type_id' => $row['doc_type']);
            $type_row = $this->TypeModel->get_type($this->type_table,$where6)->result_array()[0];
            $data['data'][] = array(


                            'history_id' => $row['history_id'],
                            't_number' => $row['t_number'],
                            'document_type' => $type_row['type_name'],
                            'type_id' => $type_row['type_id'],
                             'date' => date('m-d-Y', strtotime($row['received_date'])),
                            'time' => date('h:i A', strtotime($row['received_date'])),
                            'r_action' => $r_action
            );


            
            }
      
            
            

    
        echo json_encode($data);


}




public function releaseDoc(){

    //update history release_status to 1
    $where1 = array('t_number' =>  $this->input->post('tracking_number'));
    $where2 = array('received_status' => 1  );
    $info = array('release_status' => 1);
    $update_release = $this->UpdateModel->update2($where1,$where2,$info,$this->history_table);


    if($update_release){


         //get user info row
    $user = array('user_id' => $this->session->userdata('user_id'));
    $user_row = $this->UserModel->get_user($this->user_table,$user)->result_array()[0];

    
    $where3 = array('release_status' => 1);
    $order_key = 'history_id';
    $hrow = $this->HistoryModel->getHistoryData($this->history_table,$where1,$where2,$where3,$order_key,$this->order_by_desc)->result_array()[0];

    //get next department
    $where4 = array('d_type' => $hrow['typ_id']); 
    $flow_id   = $hrow['f_id'];

    $frow = $this->HistoryModel->get_nextDepartment($this->flow_table,$where4,$flow_id)->result_array();

        if ($frow) {



                    $info = array(
                                    't_number' => $this->input->post('tracking_number'),
                                    'user1' => $user_row['user_id'],
                                    'office1' => $user_row['of_id'],
                                    'user2' => '',
                                    'office2' =>  $frow[0]['off_id'],
                                    'typ_id'   => $frow[0]['d_type'],
                                    'f_id'  => $frow[0]['flow_id'],
                                    'status' => 'to-received',
                                    'release_date' => date('Y-m-d H:i:s', time()), 

                    );


                    $this->condition($this->AddModel->add($info,$this->history_table));
        }else {



        $hnrow = $this->HistoryModel->getHistoryData($this->history_table,$where1,$where2,$where3,$order_key,$this->order_by_asc)->result_array()[0];

       

          $info = array(
                            't_number' => $this->input->post('tracking_number'),
                            'user1' => $user_row['user_id'],
                            'office1' => $user_row['of_id'],
                            'user2' => '',
                            'office2' =>  $hnrow['office2'],
                            'typ_id'   => $hnrow['typ_id'],
                            'f_id'  => $hnrow['f_id'],
                            'status1' => 'completed',
                            'release_date' => date('Y-m-d H:i:s', time()), 
            );




           $this->condition($this->AddModel->add($info,$this->history_table));


        }



    }
   


    }


  



  public function getIncomingDocs(){

    $user = array('user_id' => $this->session->userdata('user_id'));
    $user_row = $this->UserModel->get_user($this->user_table,$user)->result_array()[0];
    $where1 = array('received_status' => 0);
    $where2 = array('office2' =>$user_row['of_id']);
    $incoming = $this->DocModel->get_incoming_docs($this->history_table,$where1,$where2)->result_array();
    $data['data'] = [];

    $r_action = false;



    $role = $this->session->userdata('role');
                        $rids = explode(" ", $role);
                        $r = [];
                        foreach ($rids as $r_row) {
                                $where = array('role_id' => $r_row);
                            
                            $rr = $this->RoleModel->get_role($this->role_table,$where)->result_array();

                           

                                foreach ($rr as $rrow) {

                                        if ($rrow['role'] == 'Receiver'  ) {

                                            $r_action = true;


                                        }

                                    }

                            }









     foreach($incoming as $row){

            $where3 = array('office_id' => $row['office1']);
            $department = $this->OfficeModel->get_office($this->office_table,$where3)->result_array()[0];
            $where4 = array('user_id' => $row['user1']);
            $user_row = $this->UserModel->get_user($this->user_table,$where4)->result_array()[0];
        
            $data['data'][] = array(
                                't_number' => $row['t_number'],
                                'document_type' => $row['type_name'],
                                'history_id' => $row['history_id'],
                                'office' => $department['office'],
                                'sender'    => $user_row['first_name'].' '.$user_row['middle_name'].' '.$user_row['last_name'].' '.$user_row['extension'],
                                'r_action' => $r_action
            );;
            
            

        } 
        echo json_encode($data);

}
    



public function receive_doc(){


            $where1 = array  ('t_number' => $this->input->post('tracking_number'));
            $where2 = array('release_status' => 0);
            $where3 = array('received_status' => 0);


          
            $hrow = $this->HistoryModel->getHistoryData1($this->history_table,$where1,$where2)->result_array()[0];
            $where4 = array('d_type' => $hrow['typ_id']);
            $frow = $this->FlowModel->get_flow_last_number($this->flow_table,$where4)->result_array()[0];

            if ($frow['flow_id'] == $hrow['f_id'] ) {


                    $info = array
                        (
                            'received_status' => 1,
                            'user2' => $this->session->userdata('user_id'),
                            'status' => 'completed',
                            'received_date' => date('Y-m-d H:i:s', time()), 
                        );
                        
      
            $update = $this->UpdateModel->update2($where1,$where3,$info,$this->history_table);


                if ($update) {

                             $data['message'] = 'Completed Successfully';
                            $data['response'] = true;
                            # code...
                        }else{
                            $data['response'] = false;
                        }


                       




                // code...
            }else {



                  $info = array
                        (
                            'received_status' => 1,
                            'user2' => $this->session->userdata('user_id'),
                            'status' => 'received',
                            'received_date' => date('Y-m-d H:i:s', time()), 
                        );
                        
      
            $update = $this->UpdateModel->update2($where1,$where3,$info,$this->history_table);


                if ($update) {

                            $data['message'] = 'Receive Successfully';
                            $data['response'] = true;
                            # code...
                        }else{
                            $data['response'] = false;
                        }


                       
            }



           echo json_encode($data);




          
}


//History

public function getHistory(){

    $where1 = array('t_number' => $this->input->post('tracking_number'));


    $histor = $this->HistoryModel->get_history($this->history_table,$where1)->result_array();

    $data['data'] = [];
    foreach ($histor as $row) {
                
                $where1 = array('user_id' => $row['user1'] );
                $user1 = $this->UserModel->get_user($this->user_table,$where1)->result_array();

                $where2 = array('user_id' => $row['user2']);
                $user2 = $this->UserModel->get_user($this->user_table,$where2)->result_array();



                $date1 = new DateTime($row['received_date']);
                $date2 = new DateTime($row['release_date']);
                $interval = $date1->diff($date2);


                
                $min_ext = $interval->i > 1 ? 'minutes' : 'minute';
                $hour_ext = $interval->h > 1 ? 'hours' : 'hour';
                $days_ext = $interval->d > 1 ? 'days' : 'day';
                $month_ext = $interval->m > 1 ? 'months' : 'month';
        


               

                $data['data'][] = array(

                            'user1' => $user1[0]['first_name'].' '.$user1[0]['middle_name'].' '.$user1[0]['last_name'],
                            'office1' => $user1[0]['office'],
                            'user2' => $row['user2'] != 0 ?  $user2[0]['first_name'].' '.$user2[0]['middle_name'].' '.$user2[0]['last_name'] : ' - ',
                            'office2' => $row['user2'] != 0 ?  $user2[0]['office'] : ' - ',
                            'tracking_number' => $row['t_number'],
                            'date_released' => date('M d Y', strtotime($row['release_date'])).' - '.date('h:i a', strtotime($row['release_date']))  ,
                            'date_received' => $row['received_date'] != '0000-00-00 00:00:00' ? date('M d Y', strtotime($row['received_date'])).' - '.date('h:i a', strtotime($row['received_date'])) : ' - ',
                            // 'duration' => $row['received_date'] != '0000-00-00 00:00:00' ?   $this->duration($interval) : ' - ',


                            'duration' => $row['received_date'] != '0000-00-00 00:00:00' ?   $interval->m.' '.$month_ext.', '.$interval->d.' '.$days_ext.', '.$interval->h.' '.$hour_ext.', '.$interval->i.' '.$min_ext : ' - ',
                      
               );


    }

    echo json_encode($data);


}


// function duration($interval){

//     $duration = '';


    // $min_ext = $interval->i > 1 ? 'minutes' : 'minute';
    // $hour_ext = $interval->h > 1 ? 'hours' : 'hour';
    // $days_ext = $interval->d > 1 ? 'days' : 'day';
    // $month_ext = $interval->m > 1 ? 'months' : 'month';
//             $data = [];

//                 echo json_encode(['total_duration' => $interval->m.' '.$month_ext.', '.$interval->d.' '.$days_ext.', '.$interval->h.' '.$hour_ext.', '.$interval->i.' '.$min_ext]);

//     if ($interval->m < 1) {

//             $duration = $interval->d." days ".$interval->h." hours ".$interval->i." minutes";
//         // code...
//     }else if ($interval->d  < 1) {

//         $duration = $interval->h." hours ".$interval->i." minutes";
//         // code...
//     }else if ($interval->h < 1) {

//         $duration = $interval->i." minutes";
//         // code...
//     }else {

//           $duration = $interval->m." months, ".$interval->d." days ".$interval->h." hours ".$interval->i." minutes";

//     }


//     return $duration;  

// }

public function getReceivedDocs(){

    $where1 = array('user_id' => $this->session->userdata('user_id'));
    $user = $this->UserModel->get_user($this->user_table,$where1)->result_array()[0];

    
    $where2 = array('office2' => $user['of_id']);
    // $where3 = array('status' => 'received');
    $where4 = array('received_status' => 1);

    $recs = $this->HistoryModel->received_history($this->history_table,$where2,$where4)->result_array();
    $data['data'] = [];
    foreach ($recs as $row) {

        $data['data'][] = array(

                    'tracking_number' => $row['t_number'],
                    'document_type' => $row['type_name'],
                    'date_received' => date('M d Y', strtotime($row['received_date'])),
                    'office' => $row['office'],
                    'user' =>  $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'].' '.$row['extension']
        );
        // code...
    }

    echo json_encode($data);

}



public function doc_history(){

    // $tracking_code = $this->input->post('tracking_code');
    $where1 = array(
                    't_number' => trim($this->input->post('tracking_code'))
    );

    $where2 = array('received_status' => 1);

    $count_history = $this->HistoryModel->get_doc_history($this->history_table,$where1,$where2)->num_rows();


    if ($count_history > 0) {


         $history = $this->HistoryModel->get_doc_history($this->history_table,$where1,$where2)->result_array();
    $data = [];

    $where3 = array('tracking_number' => trim($this->input->post('tracking_code')));
    $document = $this->DocModel->get_do($this->document_table,$where3)->result_array()[0];


    $last_rec  = $this->HistoryModel->history_last_rec($this->history_table,$where1)->result_array()[0];


    $user = false;





    foreach ($history as $row) {

        $str = 'abcdef';
        $shuffled = str_shuffle($str);


        if ($this->session->userdata('user_id') === $document['u_id']) {

            $user = true;
            # code...
        }




        $data[] = array(
                        'history_id' => $row['history_id'],
                        'i' => $shuffled,
                        'department_name' => $row['office'],
                        'received_by' =>  $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'].' '.$row['extension'],
                        'tracking_code' => $row['tracking_number'],
                        'status' => $row['status'],
                        'color' => ($row['status'] === 'hold') ? 'bg-yellow' : 'bg-green',
                        'remarks' => $row['remarks'],
                        'user' => $user,
                        'last_rec' => $last_rec['history_id'] == $row['history_id'] ? true : false,


        );
        # code...
    }

    echo json_encode($data);

        # code...
    }else {


        echo json_encode(['response' => 'Nothing']);

    }

   
    
   
}




public function getOutgoingDocs(){

    $user = array('user_id' => $this->session->userdata('user_id'));
    $user_row = $this->UserModel->get_user($this->user_table,$user)->result_array()[0];
    $where1 = array('user1' =>$user_row['user_id']);
    $where2 = array('office1' =>$user_row['of_id']);
    $where3 = array('received_status' => 0);
    
    $outgoing = $this->HistoryModel->get_outgoing_docs($this->history_table,$where1,$where2,$where3)->result_array();
    $data['data'] = [];
     foreach($outgoing as $row){

            $where3 = array('office_id' => $row['office2']);
            $department = $this->OfficeModel->get_office($this->office_table,$where3)->result_array()[0];
            $where4 = array('user_id' => $row['user1']);
            $user_row = $this->UserModel->get_user($this->user_table,$where4)->result_array()[0];
        
            $data['data'][] = array(
                                't_number' => $row['t_number'],
                                // 'document_name' => $row['document_name'],
                                'history_id' => $row['history_id'],
                                'office' => $department['office'],
                                'sender'    => $user_row['first_name'].' '.$user_row['middle_name'].' '.$user_row['last_name'].' '.$user_row['extension']
            );;
            
            

        } 
        echo json_encode($data);

}



public function count(){

    //count documents
    $where = array('offi_id'=>$this->session->userdata('of_id'));
    $count_doc = $this->DocModel->get_my_docs($this->document_table,$where,$this->order_key_created,$this->order_by_desc)->num_rows();

    //count received
    $where1 = array('user_id' => $this->session->userdata('user_id'));
    $user = $this->UserModel->get_user($this->user_table,$where1)->result_array()[0];
    $where2 = array('office2' => $user['of_id']);
    $where3 = array('received_status' => 1);

      //count my received


    $wher1 = array('user2' => $user['user_id']);
    $wher2 = array('release_status' => 0);  
    $wher3 = array('status' => 'received');
    $count_received = $this->DocModel->get_received_docs1($this->history_table,$where2,$where3,$wher2)->num_rows();

    //count incoming 
    $where4 = array('received_status' => 0);
    $incoming = $this->DocModel->get_incoming_docs($this->history_table,$where4,$where2)->num_rows();

    //count outgoing 
    $where5 = array('user1' =>$this->session->userdata('user_id'));
    $where6 = array('office1' =>$user['of_id']);

    
    $outgoing = $this->HistoryModel->get_outgoing_docs($this->history_table,$where5,$where6,$where4)->num_rows();


    $data = ['documents'=>$count_doc,'received' => $count_received,'incoming'=>$incoming, 'outgoing'=> $outgoing];

    echo json_encode($data);


}


public function total_duration(){


            $where1  = array('t_number' => $this->input->post('tracking_number'));
            $hlrow = $this->HistoryModel->history_last_rec($this->history_table,$where1)->result_array()[0];
            $hfrow = $this->HistoryModel->history_first_rec($this->history_table,$where1)->result_array()[0];
           

            if ($hlrow['received_date'] == '0000-00-00 00:00:00') {

                echo json_encode(['total_duration' => ' --- ']);
                # code...
            }else {


                 $date1 = new DateTime($hlrow['received_date']);
            $date2 = new DateTime($hfrow['release_date']);
            $interval = $date1->diff($date2);


            $min_ext = $interval->i > 1 ? 'minutes' : 'minute';
            $hour_ext = $interval->h > 1 ? 'hours' : 'hour';
            $days_ext = $interval->d > 1 ? 'days' : 'day';
            $month_ext = $interval->m > 1 ? 'months' : 'month';
            $data = [];

                echo json_encode(['total_duration' => $interval->m.' '.$month_ext.', '.$interval->d.' '.$days_ext.', '.$interval->h.' '.$hour_ext.', '.$interval->i.' '.$min_ext]);
            }
            

}


//Admins

public function getAdmins(){


    $data['data'] = [];

        $admins = $this->UserModel->get_admins($this->admin_table,$this->order_key_created,$this->order_by_desc)->result_array();
        foreach($admins as $row){
            
    
            // $data['data'][] = $row; 

            $data['data'][] = array(

                'id' => $row['admin_id'],
                'name' => $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'].' '.$row['extension'],
                'role' => $row['admin_role'],
                'created' => date('M-d-Y', strtotime($row['created_on'])).' - '.date('h:i a', strtotime($row['created_on'])),
                'x' => $row['admin_role'] == 'superadmin' ? true : false,
                'y' => $row['us_id'] == $this->session->userdata('user_id') ? true : false,
        
            );
            
            

        } 
        echo json_encode($data);

}



    public function search_user(){


        $key      = $_GET['key'];
        $users = $this->UserModel->search_user($key);
        $data     = [];
        foreach ($users as $row) {
            $data[] = $row;
        }

        echo json_encode($data);
    }



public function addAdmin(){


       $info = array
                        (
                            'us_id' => $this->input->post('user_id'),
                            'admin_role' => 'admin',
                            'created_on' => date('Y-m-d H:i:s', time()), 
                        );             
            $this->condition($this->AddModel->add($info,$this->admin_table));
}



 function delete_admin(){

        $where = array
                        (
                            'admin_id' => $this->input->post('id'),
                           
                        );    
         
        $this->condition($this->DeleteModel->delete($where,$this->admin_table));

    }





}
