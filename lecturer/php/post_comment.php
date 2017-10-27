<?php
session_start();
    require("lib.php");
    date_default_timezone_set("Asia/Brunei");
	$date_created = date("Y-m-d h:i:sa");
	$description = $_POST['comment'];
	$user_id=$_SESSION['e_user_id'];
	$posts_id=$_POST['post_id'];
  $id_class=$_POST['id_class'];

    $object = new CRUD();
    $object->Write_Comment($posts_id, $user_id, $date_created, $description);
    $result=$object->Validate_Statistic($user_id, $id_class);
		if($result==0)
			$object->Save_Statistic($user_id, $id_class, 0, 1, 0, 0); // post, coment, download, upload
		else{
			$statistic_comment=$object->Get_Statistic_Comment($user_id, $id_class);
			$statistic_comment++;
			$object->Update_Statistic_Comment($user_id, $id_class, $statistic_comment);
		}
?>
