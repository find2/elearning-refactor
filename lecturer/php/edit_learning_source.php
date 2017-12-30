<?php
    session_start();
    require 'lib.php';
    date_default_timezone_set("Asia/Brunei");
	$date_created = date("Y-m-d H:i:s");
	$user_id=$_SESSION['e_user_id'];
    $learning_id=$_POST['learning_id'];
    $title=$_POST['u_title'];
    $link=$_POST['u_link'];
    $type=$_POST['type'];
    $class_id=$_POST['class_id'];
    $object = new CRUD();
    $data = $object->Edit_Learning_Source($learning_id, $title, $link);
    $notif_id = $object->Write_Notif($class_id, $type, $learning_id, $date_created, $user_id);
    $datas = $object->Get_User_Id_Enrolled($class_id, $user_id);
    if(count($datas)>0){
    	foreach ($datas as $data) {
        	$object->Write_User_Notif($data['id_user'], $notif_id, 0);
        }
    }
    // echo $data;
?>