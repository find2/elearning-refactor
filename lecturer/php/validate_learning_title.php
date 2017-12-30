<?php
    session_start();
    require 'lib.php';
    $learning_id=$_POST['learning_id'];
    $class_id=$_POST['class_id'];
    $title=$_POST['title'];
    $type=$_POST['type'];
    $object = new CRUD();
    if($type==1)
        $result = $object->Validate_Upload_Learning($class_id, $title);
    else
        $result = $object->Validate_Edit_Learning($learning_id, $title);
    echo $result;
?>