<?php
    session_start();
    require 'lib.php';
    $learning_id=$_POST['learning_id'];
    $object = new CRUD();
    $data = $object->Get_Learning_Source($learning_id);
    echo $data;
?>