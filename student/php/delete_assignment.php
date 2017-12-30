<?php
    session_start();
    require 'lib.php';
    $assignment_submitted_id=$_POST['assignment_submitted_id'];
    $monarch=$_SESSION['e_monarch'];
    $object = new CRUD();
    $data='';
    $file_name=$object->Get_File_Name($assignment_submitted_id);
    $class_name=$_POST['class_name'];
    $file_target = "../../assignment/" . $class_name . "_" . $monarch . "/answer/" . $file_name;
    
    if(file_exists($file_target)){
    	if(unlink($file_target)){
    	    $object->Delete_Assignment($assignment_submitted_id);
    	    $data=$file_name . ' has been deleted';
    	}
    	else {
    	    $data='Cannot delete file';
    	}
    }
    else{
        $object->Delete_Assignment($assignment_submitted_id);
    	$data=$file_name . ' has been deleted';
    }
    
    echo $data;
?>