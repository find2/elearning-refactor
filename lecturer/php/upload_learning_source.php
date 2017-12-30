<?php
    session_start();
    require 'lib.php';
    date_default_timezone_set("Asia/Brunei");
	$date_created = date("Y-m-d H:i:s");
    $user_id=$_SESSION['e_user_id'];
    $class_id=$_POST['class_id'];
    $title=$_POST['title'];
    $link=$_POST['link'];
    $type=$_POST['type'];
    $object = new CRUD();
    $learning_id = $object->Upload_Learning_Source($class_id, $user_id, $title, $link);
    $notif_id = $object->Write_Notif($class_id, $type, $learning_id, $date_created, $user_id);
    $datas = $object->Get_User_Id_Enrolled($class_id, $user_id);
    if(count($datas)>0){
    	foreach ($datas as $data) {
        	$object->Write_User_Notif($data['id_user'], $notif_id, 0);
        }
    }
    // echo $data;
?>