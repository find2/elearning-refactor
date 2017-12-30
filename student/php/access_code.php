<?php
    session_start();

    require 'lib.php';
    $object = new CRUD();
    $class_id=$_POST['class_id'];
    $data=$object->Access_Code($class_id);
    echo $data;

?>
