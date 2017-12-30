<?php
	$file_name=$_FILES['input-file']['name'];
	$file_tmp=$_FILES['input-file']['tmp_name'];
	$file_size=$_FILES['input-file']['size'];
    
    $target_file = "../../assignment/" . basename($file_name);
    $tmp = explode(".", $file_name);
    $file_type = end($tmp);
    
    $data='';
    if($file_type != "pdf" && $file_type != "doc" && $file_type != "docx"){
	    $data='Only accept doc and pdf';
	}
	else {
	    if($file_size > 15996446){
	        $data='File size is too large';
	    }
	    else {
	        if(move_uploaded_file($file_tmp, $target_file)){
	            $data=$target_file;
	        }
	        else{
	            $data='File not found ';
	            
	        }
	    }
	}
	
    echo $data;
?>