<?php
    session_start();
    require 'lib.php';
    date_default_timezone_set("Asia/Brunei");
	$current_date = date("Y-m-d H:i:s");
    $user_id=$_SESSION['e_user_id'];
    $monarch=$_SESSION['e_monarch'];
    $class_id=$_POST['class_id'];
    $object = new CRUD();
    $data=$object->Submitted_Assignment($user_id, $class_id, $monarch, $current_date); 
    echo $data;
?>