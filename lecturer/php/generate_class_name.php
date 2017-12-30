<?php
    session_start();
    require 'lib.php';
    // $code_id=$_POST['code_id'];
    $code_name=$_POST['code_name'];
    $object = new CRUD();
    $data=$object->Generate_Class_Name($code_name);
    echo $data;
?>