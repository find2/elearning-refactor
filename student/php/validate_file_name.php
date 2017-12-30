<?php
    session_start();
    require 'lib.php';
    $object=new CRUD();
    $class_name=$_POST['class_name'];
    $file_title=$_POST['file_title'];
    $user_id=$_SESSION['e_user_id'];
    $file_name=$_POST['file_name'];
    $assignment_id=$_POST['assignment_id'];
    $monarch=$_SESSION['e_monarch'];
    
    $tmp = explode(".", $file_name);
    $file_type = end($tmp);
    $new_file_name = $class_name . "_" . $user_id . "_" . $file_title . "." . $file_type;
    $file_target = "../../assignment/" . $class_name . "_" . $monarch . "/answer/" . $new_file_name;
    
    $result=$object->Validate_Assignment_Number($assignment_id, $user_id);
    
    $data='';
    if(strtolower($file_type) != "pdf" && strtolower($file_type) != "doc" && strtolower($file_type) != "docx"){
        $data='3';
    }
    else{
        if(file_exists($file_target)){
        	$data='1'; // file exist
        }
        else{
            if($result==0){
                $data='0'; // file dont exist
            }
        	else{
        	    $data='2'; // Already upload assignment
        	}
        }
    }
    
    echo $data;
?>