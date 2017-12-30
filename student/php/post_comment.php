<?php
session_start();
    require("lib.php");
    date_default_timezone_set("Asia/Brunei");
	$date_created = date("Y-m-d H:i:s");
	$desciption = $_POST['comment'];
	$user_id=$_SESSION['e_user_id'];
	$posts_id=$_POST['post_id'];
	$id_class=$_POST['id_class'];
	$type=$_POST['type'];

    $object = new CRUD();
    $comment_id = $object->Write_Comment($posts_id, $user_id, $date_created, $desciption);
    $notif_id = $object->Write_Notif($id_class, $type, $comment_id, $date_created, $user_id);
    $datas = $object->Get_User_Id_Enrolled($id_class, $user_id);
    if(count($datas)>0){
    	foreach ($datas as $data) {
        	$object->Write_User_Notif($data['id_user'], $notif_id, 0);
        }
    }
    
    $result=$object->Validate_Statistic($user_id, $id_class);
	if($result==0){
		$object->Save_Statistic($user_id, $id_class, 0, 1, 0, 0); // post, coment, download, upload
	}
	else{
		$statistic_comment=$object->Get_Statistic_Comment($user_id, $id_class);
		$statistic_comment++;
		$object->Update_Statistic_Comment($user_id, $id_class, $statistic_comment);
	}
?>
