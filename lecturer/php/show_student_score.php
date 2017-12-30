<?php
    session_start();
    require 'lib.php';
    $quiz_id=$_POST['quiz_id_score'];
    $quiz_name=$_POST['quiz_name_score'];
    $object = new CRUD();
    $data=$object->Show_Student_Score($quiz_id, $quiz_name);
    echo $data;
?>
