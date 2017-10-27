<?php
	session_start();
    require("lib.php");
    date_default_timezone_set("Asia/Brunei");
	$date_created = date("Y-m-d h:i:sa");
	$description = $_POST['description'];
	$id_class = $_POST['post_to'];
	$id_user=$_SESSION['e_user_id'];
    $object = new CRUD();
    $object->Write_Post($description, $id_class, $date_created, $id_user);
		$result=$object->Validate_Statistic($id_user, $id_class);
		if($result==0)
			$object->Save_Statistic($id_user, $id_class, 1, 0, 0, 0); // post, coment, download, upload
		else{
			$statistic_post=$object->Get_Statistic_Post($id_user, $id_class);
			$statistic_post++;
			$object->Update_Statistic_Post($id_user, $id_class, $statistic_post);
		}
?>
