<?php
    session_start();
    require 'lib.php';
    date_default_timezone_set("Asia/Brunei");
	$date_created = date("Y-m-d H:i:s");
    $note_id = $_POST['note_id'];
    $note = $_POST['assignment_note'];
    $type=$_POST['type'];
    $user_id=$_SESSION['e_user_id'];
    $class_id=$_POST['class_id'];
    $object = new CRUD();
 
    $object->Update_Assignment_Note($note_id, $note);
    $notif_id = $object->Write_Notif($class_id, $type, $note_id, $date_created, $user_id);
    $datas = $object->Get_User_Id_Enrolled($class_id, $user_id);
    if(count($datas)>0){
        foreach ($datas as $data) {
        	$object->Write_User_Notif($data['id_user'], $notif_id, 0);
        }
    }
?>