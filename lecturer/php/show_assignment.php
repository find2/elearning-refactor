<?php
    session_start();
    require 'lib.php';
    $user_id=$_SESSION['e_user_id'];
    $monarch=$_SESSION['e_monarch'];
    $class_id=$_POST['class_id'];
    $object = new CRUD();
    $data=$object->Show_Assignment($user_id, $class_id, $monarch); 
    echo $data;
?>