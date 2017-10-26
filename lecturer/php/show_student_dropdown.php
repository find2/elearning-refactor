<?php
    session_start();
    require 'lib.php';
    $quiz_id=$_POST['quiz_id'];
    $quiz_name=$_POST['quiz_name'];
    $object = new CRUD();
    $data=$object->Student_Dropdown($quiz_id, $quiz_name);
    echo $data;
?>
