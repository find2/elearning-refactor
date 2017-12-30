<?php
    session_start();
    require 'lib.php';
    date_default_timezone_set("Asia/Brunei");
	$current_date = date("Y-m-d H:i:s");
    $class_id=$_POST['class_id'];
    $monarch=$_SESSION['e_monarch'];
    $object = new CRUD();
    $data=$object->Show_Assignment($class_id, $monarch, $current_date); 
    echo $data;
?>