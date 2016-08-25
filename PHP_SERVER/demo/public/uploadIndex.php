<?php
 if ($_SERVER['REQUEST_METHOD'] == 'POST')
{    $target_path = "C:/wamp/www/project/demo/public/upload/";        
  if(!empty($_FILES)){
       if(isset($_FILES['uploadedfile'])){   
       $target_path = $target_path . basename( $_FILES['uploadedfile']['name']);
       if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
         $name="";$age="";
     if (($handle = fopen("$target_path", "r")) !== FALSE) {
        $response["response"] = "success";       
       while (($data = fgetcsv($handle, 1000, ":")) !== FALSE) {
         $temp =array();
         $name =$data[0];  
         $age = $data[$data[0]] = isset($data[1]) ? $data[1] : null;
         //if(isset($name) && $name !== ''&&isset($age) && $age !== ''){ 
            
              $employees[] = array('name'=> $name,'age'=> $age);  
        // }
          $response["employee_details"] = $employees;
        
}   echo json_encode($response); 
  fclose($handle);
}    
}      
    }
 else{
    $name =$_FILES['uploadedfile'];
      echo "parameter name is".$name;
    $response["result"] = "error";
    $response["message"] = "Invalid Parameter!!";	  
    echo json_encode($response); 
}  
    }
 else{   
          $response["result"] = "error";
          $response["message"] = "File Should Not be Empty!!";	  
	  echo json_encode($response); 
 }
}
?>




