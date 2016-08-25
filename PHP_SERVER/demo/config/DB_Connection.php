<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 class DB_Connect{
    private $server_name ="localhost";
    private $user_name="root";
    private $password="";
    private $db_name="just_register";
    private $db_connect;
     
    public function dbConnect() {    
      $this ->db_connect =  new PDO("mysql:host=".$this -> server_name.";dbname=".$this -> db_name,
       $this -> user_name, $this -> password);
      return $this ->db_connect; 
          
     }
 }
