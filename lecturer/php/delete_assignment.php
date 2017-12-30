<?php
    session_start();
    require 'lib.php';
    $assignment_id=$_POST['assignment_id'];
    $monarch=$_SESSION['e_monarch'];
    
    $object = new CRUD();
    $data='File Not Found';
    $file_name=$object->Get_File_Name($assignment_id);
    $class_name=explode("_", $file_name)[0] . '_' . explode("_", $file_name)[1];
    $file_target = "../../assignment/" . $class_name . '_' . $monarch . "/question/" . $file_name;
    
    if(file_exists($file_target)){
    	if(unlink($file_target)){
    	    $object->Delete_Assignment($assignment_id);
    	    $data=$file_name . ' has been deleted';
    	}
    	else {
    	    $data='Cannot delete file';
    	}
    }
    
    echo $class_name;
?>