<?php
    session_start();
    require 'lib.php';
    $quiz_id=$_POST['quiz_id_update'];
    $object = new CRUD();
    $data=$object->Delete_Quiz($quiz_id);
    echo $data;
?>
