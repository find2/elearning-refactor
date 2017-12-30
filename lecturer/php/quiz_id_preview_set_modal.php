<?php
    session_start();
    require 'lib.php';
    $class_id=$_POST['class_id'];
    $object = new CRUD();
    $data=$object->Quiz_Id_Preview_Set($class_id);
    echo $data;
?>