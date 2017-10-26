<?php
    session_start();
    require 'lib.php';
    $attempt_id=$_POST['attempt_id'];
    $total_score=$_POST['total_score'];
    $object = new CRUD();
    $data=$object->Update_Score($attempt_id, $total_score);
    echo $data;
?>
