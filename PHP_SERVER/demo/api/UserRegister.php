<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class UserRegister{
 private $db_operation;
 
    public function __construct() {
         require_once('../config/DB_Operation.php');
         $this -> db_operation = new DB_Operation();
//  $this -> db_connect = $db -> dbConnect();        
}

function __destruct() {        
}

    public function registration($userName,$email,$mobileNo,$gender,$password) {
        $checkUserExit = $this -> db_operation -> chekUserAlreadyExit($email);          
        $value=$checkUserExit ? 'true' : 'false';
       // echo "check user register$value";
        if($checkUserExit){
            $response["result"] = "error";
            $response["message"] = "User Already Exist";	  
	    return json_encode($response);
        }
        else{
            $checkUserExit = $this -> db_operation -> register($userName,$email,$mobileNo,$gender,$password);
            $response["result"] = "success";
            $response["message"] = "User Registered Successfully";
	  
	    return json_encode($response);
        }
    }
    
    public function getMsgInvalidParam() {
            $response["result"] = "error";
            $response["message"] = "Invalid Paramert";	   
	    return json_encode($response);
    }
    public function getMsgParamNotEmpty(){
          $response["result"] = "error";
            $response["message"] = "Paramert should not be empty";	   
	    return json_encode($response);
    }
    
    public function loginUser($email,$password){
        $res = $this -> db_operation -> userLogin($email,$password);     
        if($res == "success"){
            $response["result"] = "success";
            $response["message"] = "User Login Success";
            return json_encode($response);
        }
        else if($res == "server_error"){
            $response["result"] = "error";
            $response["message"] = " Oops.Something went wrong. Please try again later!!";
            return json_encode($response);
        }
        else{
            $response["result"] = "error";
            $response["message"] = "Please check your login credential!!";
             return json_encode($response);
        }
       
    }
    
}
