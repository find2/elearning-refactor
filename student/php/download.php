<?php
    session_start();
    require 'lib.php';
 //   $class_id=$_POST['class_id'];
 //   $user_id=$_SESSION['e_user_id'];
 //   $object = new CRUD();
 //   $result=$object->Validate_Statistic($user_id, $class_id);
	// if($result==0){
	// 	$object->Save_Statistic($user_id, $id_class, 0, 0, 1, 0); // post, coment, download, upload
	// }
	// else{
	// 	$statistic_download=$object->Get_Statistic_Download($user_id, $class_id);
	// 	$statistic_download++;
	// 	$object->Update_Statistic_Download($user_id, $class_id, $statistic_download);
	// }
	// echo $statistic_download;
	
	$md5_filename=$_POST['md5_filename'];
	$type=$_POST['type'];
	$monarch=$_SESSION['e_monarch'];
	$user_id=$_SESSION['e_user_id'];
	$class_id=$_POST['class_id']; // Get from link
	$object = new CRUD();
	if($type==1){
		$data=$object->Link_Download_Assignment($md5_filename, $monarch);
	}
	else{
		$data=$object->Link_Download_Submitted($md5_filename, $monarch);
	}
	$result=$object->Validate_Statistic($user_id, $class_id);
	if($result==0){
		$object->Save_Statistic($user_id, $id_class, 0, 0, 1, 0); // post, coment, download, upload
	}
	else{
		$statistic_download=$object->Get_Statistic_Download($user_id, $class_id);
		$statistic_download++;
		$object->Update_Statistic_Download($user_id, $class_id, $statistic_download);
	}
	echo $data;
?>