<?php
    session_start();
    require 'lib.php';
    $object = new CRUD();
    date_default_timezone_set("Asia/Brunei");
	$current_date = date("Y-m-d H:i:s");
    $class_id=$_POST['class_id'];
    $assignment_number=$_POST['assignment_number'];
    
    $data=$object->Get_Assignment_Id($class_id, $assignment_number, $current_date);
    
    echo $data;
?>