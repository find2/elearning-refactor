<?php
    session_start();
    require 'lib.php';
    $object = new CRUD();
    $class_id=$_POST['class_id'];
    $user_id=$_SESSION['e_user_id'];
    
    $data=$object->Get_Assignment_Number($class_id, $user_id);
    
    echo $data;
?>