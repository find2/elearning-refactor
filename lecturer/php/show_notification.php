<?php
    session_start();
    require 'lib.php';
	$user_id=$_SESSION['e_user_id'];
	$type=$_POST['type'];
    $object = new CRUD();
    
    if($type==1)
        $data = $object->Show_Post_Comment($user_id);
    else
        $data = $object->Show_Assignment_Quiz($user_id);
    echo $data;
?>