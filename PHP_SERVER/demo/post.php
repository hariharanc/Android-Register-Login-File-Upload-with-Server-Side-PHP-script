<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $data = json_decode(file_get_contents("php://input"));
    $operation = $data -> operation;
   
   if(!empty($operation)){	   
	   if($operation  == 'register'){		   
		if(isset($data -> user)&&!empty($data -> user) && !empty($data  -> user -> name) && 	
	     !empty($data ->  user -> email) && !empty($data ->  user -> password)){
        $response["result"] = "success";
        $response["message"] = "Your input data";
        $response["user"] = $data -> user;
		//$response["name"] = $data -> user -> name;
		//$response["email"] = $data -> user -> email;
		//$response["password"] = $data -> user -> password;
        $data = json_encode($response);
        echo "JSON data: $data\n\n\n";

    }
	else{
		$response["result"] = "error";
        $response["message"] = "Invaild Login Credentials";
		$data = json_encode($response);
		echo "JSON data: $data\n\n\n";
	}
	   }
	   else{
		$response["result"] = "success";
        $response["message"] = "This not a register";
		$data = json_encode($response);
		echo "JSON data: $data\n\n\n";
	   }
	   
   }
   else{
	   $response["result"] = "error";
        $response["message"] = "Parameter Not Empty!!!";
		$data = json_encode($response);
		echo "JSON data: $data\n\n\n";
   }


  
//$data = json_decode($data);

//print_r($data);

//$data = (array) $data; // cast (convert) the object to an array

//print_r($data);

//printf("Name: %s Age: %s\n\n", $data['name'], $data['age']);
}
 else if ($_SERVER['REQUEST_METHOD'] == 'GET'){
  
    $data = json_decode(file_get_contents("php://input"));
   
   $operation = $_GET['operation'];
   
   if(!empty($operation)){	   
	   if($operation  == 'login'){	
         $email=$_GET['email'];
		 $password=$_GET['password'];
		if(isset($email)&& isset($password)){
        $response["result"] = "success";
        $response["message"] = "Your Login data is";       
		$response["email"] = $email;
		$response["password"] = $password;
        $data = json_encode($response);
        echo "JSON data: $data\n\n\n";

    }
	else{
		$response["result"] = "error";
        $response["message"] = "Invaild Login Credentials";
		$data = json_encode($response);
		echo "JSON data: $data\n\n\n";
	}
	   }
	   else{
		$response["result"] = "success";
        $response["message"] = "This is not a login request";
		$data = json_encode($response);
		echo "JSON data: $data\n\n\n";
	   }
	   
   }
   else{
	   $response["result"] = "error";
        $response["message"] = "Parameter Not Empty!!!";
		$data = json_encode($response);
		echo "JSON data: $data\n\n\n";
   } 

}
?>