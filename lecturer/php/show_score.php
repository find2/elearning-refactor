<?php
    session_start();
    require 'lib.php';
    $attempt_id=$_POST['attempt_id'];
    $student_name=$_POST['student_name'];
    $object = new CRUD();
    $data=$object->Show_Score($attempt_id, $student_name);
    echo $data;
?>
