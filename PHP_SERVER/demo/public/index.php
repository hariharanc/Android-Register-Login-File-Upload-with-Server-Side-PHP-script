<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$user = $name = $email = $mobNo = $gender = $password="";
 require_once('../api/UserRegister.php'); 
  $userReg = new UserRegister();
 
 if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $data = json_decode(file_get_contents("php://input"));

    if(isset($data -> operation)){
  	$operation = $data -> operation;
  	 if(!empty($operation)){
  		  if($operation == 'register'){
  			if(isset($data -> user ) && !empty($data -> user) 
                                && isset($data -> user -> name)&&!empty($data -> user -> name)
  				&& isset($data -> user -> email)&&!empty($data -> user -> email)
                                && isset($data -> user -> mobileNo)&&!empty($data -> user -> mobileNo)
                                && isset($data -> user -> gender)&&!empty($data -> user -> gender)
                                && isset($data -> user -> password)&&!empty($data -> user -> password)){

  				$user = $data -> user;
  				$name = $user -> name;
  				$email = $data -> user -> email;
                                $mobNo = $data -> user -> mobileNo;
                                $gender = $data -> user -> gender;                                
  				$password = $data -> user -> password;
                               // echo "user name is$user";
                                echo $userReg -> registration($name,$email,$mobNo,$gender,$password);
  			} else {    
                                $user = $data -> user;
  				$name = $user -> name;
  				$email = $data -> user -> email;
                                $mobNo = $data -> user -> mobileNo;
                                $gender = $data -> user -> gender;                                
  				$password = $data -> user -> password;
                            
                            echo "user email id is".$data -> user -> email;
                               if(isset($name) === true && $name === ''){
                                   $response["result"] = "error";
                                   $response["message"] = "User Name must not be empty.";	  
	                            echo json_encode($response); 
                               }
                               else if(isset($email) === true && $email === ''){
                                  $response["result"] = "error";
                                  $response["message"] = "Email must not be empty.";	  
	                          echo json_encode($response);   
                               }
                               else if(empty($mobNo)){
                                  $response["result"] = "error";
                                  $response["message"] = "Mobile number must not be empty.";	  
	                          echo json_encode($response); 
                               }
                               else if(empty($gender)){
                                  $response["result"] = "error";
                                  $response["message"] = "Gener must not be empty.";	  
	                          echo json_encode($response); 
                               }
                               else if(empty($password)){
                                  $response["result"] = "error";
                                  $response["message"] = "Password must not be empty.";	  
	                          echo json_encode($response); 
                               }
                               else{
                                   echo $userReg -> getMsgInvalidParam();
                               }  				
  			}
  		}               
                
       else if ($operation == 'login') {
        if(isset($data -> user ) && !empty($data -> user) && isset($data -> user -> email) && isset($data -> user -> password)){
          $user = $data -> user;
          $email = $user -> email;
          $password = $user -> password;
          echo $userReg -> loginUser($email, $password);
        } else {
          echo $fun -> getMsgInvalidParam();
        }
      } 
      else if ($operation == 'chgPass') {
        if(isset($data -> user ) && !empty($data -> user) && isset($data -> user -> email) && isset($data -> user -> old_password) 
          && isset($data -> user -> new_password)){
          $user = $data -> user;
          $email = $user -> email;
          $old_password = $user -> old_password;
          $new_password = $user -> new_password;
          echo $fun -> changePassword($email, $old_password, $new_password);
        } else {
          echo $fun -> getMsgInvalidParam();
        }
      }
  	}else{
            echo $userReg -> getMsgParamNotEmpty();
  	}
      } else {
      echo $userReg -> getMsgInvalidParam();
  }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET'){

  echo "Register and login Api";

}




