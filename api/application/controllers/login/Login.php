<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("login/LoginModel", "modelObj");
    }

    public function index() {
        $this->load->view('login/login_view');
    }

    public function checkUserLogin() {
        $email = $this->input->post("email");
        $password = $this->input->post("password");
        $encodedPassword = base64_encode("varun7006");
        $loginResult = $this->modelObj->verifyUserLoginDetails($email, $password);
        if ($loginResult['status'] == 'SUCCESS') {
            $sessionData = array(
                "user_id" => $loginResult['value']['id'],
                "name" => $loginResult['value']['name'],
                "email" => $loginResult['value']['email'],
                "mobile_no" => $loginResult['value']['mobile_no'],
                "address" => $loginResult['value']['address'],
                "country" => $loginResult['value']['country_id'],
                "user_type" => $loginResult['value']['user_type']
            );
            $this->session->set_userdata($sessionData);
           
            echo json_encode($loginResult);
        }else{
           echo json_encode($loginResult);
        }
    }
    
    public function logOutUser() {
        
        $this->session->sess_destroy();
       
        echo '{"status":"SUCCESS","msg":"Logout Successfully","value":"1"}';
    }

}
