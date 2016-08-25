<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class DB_Operation{    
    private $db_connect="";
    public  $response="";
    function __construct() {
        require_once('../config/DB_Connection.php');
        $db = new DB_Connect();
        $this -> db_connect = $db -> dbConnect();        
    }
    
    function __destruct() {
        
    }
    
function register($userName,$email,$mobileNo,$gender,$password) { 
              date_default_timezone_set('Asia/Kolkata');
              $time = date("y/m/d h:i:sa-l");	
	     $sql ="INSERT INTO user_register (username, email, mobileno, gender, password, time)"
                 . " VALUES ('".$userName."', '".$email."', '".$mobileNo."', '".$gender."', '".$password."', NOW())";	  
	     $this -> db_connect->exec($sql);
	     $lastInsertId = $this -> db_connect ->lastInsertId();
              //echo "password is::".$password."</br>";
	     //echo "Lastly inserted Id is::".$lastInsertId;
             $response ="success";
             return $response;
    }    
    
    function userLogin($email,$password){        
        $sql = "SELECT COUNT(*) from user_register WHERE email = '$email' AND password = '$password'";
        $query = $this -> db_connect->prepare($sql);
        $query -> execute(array('email' => $email));
        if($query){
              $row_count = $query -> fetchColumn();
	  //    echo "User count is:::".$row_count."<br>";
          if ($row_count == 0){			
                 return "error";
             } else {
                 return "success";
             }
            } else {
                return "server_error";
               } 
    }
    
    
    
    function chekUserAlreadyExit($email){
         // echo "chekcUserAlreadyExist email ID is::".$email."<br>";
          $sql = 'SELECT COUNT(*) from user_register WHERE email =:email';
          $query =  $this -> db_connect -> prepare($sql);
          $query -> execute(array('email' => $email));

        if($query){
              $row_count = $query -> fetchColumn();
	  //    echo "User count is:::".$row_count."<br>";
          if ($row_count == 0){			
                 return false;
             } else {
                 return true;
             }
            } else {
                return false;
               }        
    }      

    }

