<?php
    session_start();
    require 'lib.php';
    $quiz_id=$_POST['quiz_id_preview'];
    $quiz_name=$_POST['quiz_name_preview'];
    $object = new CRUD();
    $data=$object->Preview_Quiz($quiz_id, $quiz_name);
    echo $data;
?>
