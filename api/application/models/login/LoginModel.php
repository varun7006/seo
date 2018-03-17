<?php

class loginModel extends CI_Model {
    
    public function verifyUserLoginDetails($email,$password) {
     
        $this->db->select("*");
        $result = $this->db->get_where("users",array("email"=>$email,"password"=>$password,"status"=>"TRUE"))->row_array();
        if(count($result)>0){
            return array("status"=>"SUCCESS","value"=>$result,"msg"=>"user login details are correct.");
        }else{
            return array("status"=>"ERR","value"=>"-1","msg"=>"user login details are in-correct.");
        }
    }
}