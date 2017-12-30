<?php
    session_start();
    require 'lib.php';
    date_default_timezone_set("Asia/Brunei");
	$date_created = date("Y-m-d H:i:s");
    $assignment_id=$_POST['assignment_id'];
    $class_name=$_POST['class_name'];
    $class_id=$_POST['class_id'];
    $file_title=$_POST['file_title'];
    $user_id=$_SESSION['e_user_id'];
    $monarch=$_SESSION['e_monarch'];
    $old_target=$_POST['file_target'];
    $type=$_POST['type'];
    $object = new CRUD();
    date_default_timezone_set("Asia/Brunei");
	$date_uploaded = date("Y-m-d");
    $tmp = explode(".", $old_target);
    $file_type = end($tmp);
    $new_file_name = $class_name . "_" . $user_id . "_" . $file_title . "." . $file_type;
    $new_target = "../../assignment/" . $class_name . "_" . $monarch . "/answer/" . basename($new_file_name);
    $md5_filename = md5($new_file_name);
    
    $data='';
    if(rename($old_target, $new_target)){
    	$submitted_id = $object->Upload_Assignment($user_id, $new_file_name, $assignment_id, 0, $md5_filename, $date_uploaded);
    	$data='Upload success';
    	$notif_id = $object->Write_Notif($class_id, $type, $submitted_id, $date_created, $user_id);
        $datas = $object->Get_User_Id_Enrolled($class_id, $user_id);
        if(count($datas)>0){
        	foreach ($datas as $data) {
            	$object->Write_User_Notif($data['id_user'], $notif_id, 0);
            }
        }
    
    	$result=$object->Validate_Statistic($user_id, $class_id);
    	if($result==0){
    		$object->Save_Statistic($user_id, $class_id, 0, 0, 0, 1); // post, coment, download, upload
    	}
    	else{
    		$statistic_upload=$object->Get_Statistic_Upload($user_id, $class_id);
    		$statistic_upload++;
    		$object->Update_Statistic_Upload($user_id, $class_id, $statistic_upload);
    	}
    }
    else{
    	$data='Cannot upload file';
    	unlink($old_target);
    }
    
    echo $data;
?>