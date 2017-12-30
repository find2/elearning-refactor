<?php
	if (isset($_POST['id']) && isset($_POST['id']) != "") {
		session_start();
	    require 'lib.php';
	    $id= $_POST['id'];
		$monarch= $_SESSION['e_monarch'];
		$user_id= $_SESSION['e_user_id'];
		
	    $object = new CRUD();
	    $classes = $object->Get_Class_Name($id);
	    foreach($classes as $class){
	    	$class_id=explode("_", $class['class_name'])[1];
    		$class_name=explode("_", $class['class_name'])[0];
	    }
	    
	    $assignments = $object->Assignment_Id_Delete_Enroll($class_id);
	    foreach($assignments as $assignment){
	    	$file_name= $object->File_Name_Delete_Enroll($assignment['id'], $user_id);
	    	$folder='../../assignment/'.$class_name.'_'.$class_id.'_'.$monarch.'/answer/'.$file_name;
	    	if(file_exists($folder)){
		    	if(unlink($folder)){
		    	    $object->Delete_Assignment_Enroll($assignment['id'], $user_id);
		    	}
		    }
		    else{
		    	$object->Delete_Assignment_Enroll($assignment['id'], $user_id);
		    }
	    }
	    
	    $object->Enroll_Delete($id);
	    
	}
?>
