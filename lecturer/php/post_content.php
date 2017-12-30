<?php
	session_start();
    require("lib.php");
    date_default_timezone_set("Asia/Brunei");
	$date_created = date("Y-m-d H:i:s");
	$id_class = $_POST['class_id'];
	$description = $_POST['description'];
	//$id_class = $_POST['post_to'];
	$type=$_POST['type'];
	$id_user=$_SESSION['e_user_id'];
    $object = new CRUD();
    $post_id = $object->Write_Post($description, $id_class, $date_created, $id_user);
    $notif_id = $object->Write_Notif($id_class, $type, $post_id, $date_created, $id_user);
    $datas = $object->Get_User_Id_Enrolled($id_class, $id_user);
    if(count($datas)>0){
    	foreach ($datas as $data) {
        	$object->Write_User_Notif($data['id_user'], $notif_id, 0);
        }
    }
    
		$result=$object->Validate_Statistic($id_user, $id_class);
		if($result==0){
			$object->Save_Statistic($id_user, $id_class, 1, 0, 0, 0); // post, coment, download, upload
		}
		else{
			$statistic_post=$object->Get_Statistic_Post($id_user, $id_class);
			$statistic_post++;
			$object->Update_Statistic_Post($id_user, $id_class, $statistic_post);
		}
	echo $id_class;
?>
