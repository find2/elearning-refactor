<?php
	// if (isset($_POST['enrolled_id']) && isset($_POST['enrolled_id']) != "") {
	    
	// }
	session_start();
	require 'lib.php';
	$enrolled_id= $_POST['enrolled_id'];
	$monarch=$_SESSION['e_monarch'];
	$object = new CRUD();
	$classes=$object->Get_Id_Class($enrolled_id);
    foreach ($classes as $class) {
    	$class_id=explode("_", $class['class_name'])[1];
    	$class_name=explode("_", $class['class_name'])[0];
    }
    
    
    $folder='../../assignment/'.$class_name.'_'.$class_id.'_'.$monarch;
    
    if(is_dir($folder)){
    	if(is_dir($folder.'/answer')){
    	    $scn=scandir($folder.'/answer');
    	    foreach($scn as $file){
    	        if($file !== '.'){
    	            if($file !== '..'){
    	                unlink($folder.'/answer/'.$file);
    	            }
    	        }
    	    }
    	    rmdir($folder.'/answer');
    	}
    	if(is_dir($folder.'/question')){
    	    $scn=scandir($folder.'/question');
    	    foreach($scn as $file){
    	        if($file !== '.'){
    	            if($file !== '..'){
    	                unlink($folder.'/question/'.$file);
    	            }
    	        }
    	    }
    	    rmdir($folder.'/question');
    	}
    	if(rmdir($folder)){
    		$object->Delete_Class($class_id);
    		$object->Enroll_Delete($enrolled_id);
    		$data=$class_name.'_'.$class_id.' is deleted';
    	}
    }
    else{
        $data='Cannot delete '.$class_name.'_'.$class_id;
    }
    
    echo $data;
?>