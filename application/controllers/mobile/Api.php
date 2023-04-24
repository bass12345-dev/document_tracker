<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public $_statusOK = 200;
    public $_statusErr = 500;
    public $_unAuth = 403;
    public $_OKmessage = 'Success';
    public $_Errmessage = 'Error';
    public $_table_login_array = ['username','password'];
    public $user_table = 'users';
    public $required = ['id'];
	  public function __construct()
    {
    	parent::__construct();
        $this->load->library('authorizations');
        $this->load->library('json');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization, Basic");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
    


    }
	public function index()
	{
         

	}

    public function loginUser(){

         $agent = $this->input->request_headers();
         $auth  = $this->input->get_request_header('Basic');
          if($auth && $auth == $this->config->item('encryption_key')){
             $data = $this->check_array_values($_POST,$this->_table_login_array);
             if(isset($data) && !empty($data)){
                echo $this->json->response($data,$this->_Errmessage,$this->_statusErr);
            }else{

                $info = array('username' => $this->input->post('username'));
                $pass = $this->input->post('password');


                $verify = $this->UserModel->verifyuser($info,$this->user_table)->num_rows();
                if ($verify > 0) {

                     $user = $this->UserModel->verifyuser($info,$this->user_table)->result_array()[0];
                    $x = password_verify($pass,$user['password']); 

                     if ($x) {

                        $token =$this->authorizations->generate($user['user_id'],'3');
                                $modified = [
                                            'token'=>$token['token'],
                                            'data'=>$user,
                                            'success'=>true,
                                        ];
                               echo $this->json->response($modified,$this->_OKmessage,$this->_statusOK);


                     }else{
                          echo $this->json->response(['message'=>'invalid password.'],$this->_Errmessage,$this->_statusErr);

                          }
                     }else{

                            echo $this->json->response(['message'=>'invalid Username.'],$this->_Errmessage,$this->_statusErr);

                          }


                }

            }else{
            echo $this->json->response('No Token Found',$this->_Errmessage,$this->_statusErr);
        }

    }


        public function edit_profile(){
        $token = $this->authorizations->getBearerToken();
        $tokenStatus = $this->authorizations->verify($token);
        if($tokenStatus == 200){
            
            $data = $this->check_array_values($_POST,$this->required);
            
            if(isset($data) && !empty($data)){
                echo $this->json->response($data,$this->_Errmessage,$this->_statusErr);
            }else{


            $info = array
                        (
                            'token' => $this->input->post('token'),
                           
                        );   
                        
            $where = array  (
                            'user_id' =>  $this->input->post('id'),
                        );

            if ($this->UpdateModel->update($where,$info,$this->user_table)) {

                echo json_encode(array('status' => $this->_statusOK));;
                // code...
            }else{
                 echo $this->json->response(['error'=>'something went wrong.'],$this->_Errmessage,$this->_statusErr);
            }

               
            }
        }else{
            $response = [
                'status'=>$tokenStatus,
            ];
            echo $this->json->response($response,$this->_Errmessage,$this->_unAuth);
        }
    }




        public function check_array_values($array,$table_array){
        if(isset($array) && !empty($array)){
            $keys = [];
            foreach($array as $key => $value){
                array_push($keys,$key);
            }
            $data = array_diff($table_array,$keys);
            if(isset($data) && !empty($data)){
                $result = [ 
                    'Error_message' => "your post request mising some data.",
                    'Missing_data' => array_values($data)
                ];
                return $result;
            }else{
                return [];
            }
        }else{
            $result = [
                'Error_message' => "your post request is empty.",
                'Missing_data' => $table_array
            ];
            return $result;
        }
    }



}
