<?php
    session_start();
    require 'lib.php';
    $class_id=$_POST['class_id'];
    $assignment_id=$_POST['assignment_id'];
    $monarch=$_SESSION['e_monarch'];
    $object = new CRUD();
    $data=$object->Submitted_Assignment($class_id, $monarch, $assignment_id); 
    echo $data;
?>