<?php
    session_start();
    require 'lib.php';
    $quiz_id=$_POST['quiz_id'];
    $user_id=$_SESSION['e_user_id'];
    $duration=$_POST['duration'];
    $object = new CRUD();
    $object->Update_Attempt_Duration($quiz_id, $user_id, $duration);
?>