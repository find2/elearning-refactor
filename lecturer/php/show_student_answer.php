<?php
    session_start();
    require 'lib.php';
    $quiz_id=$_POST['quiz_id_answer'];
    $attempt_id=$_POST['attempt_id_answer'];
    $type=$_POST['type'];
    $object = new CRUD();
    if($type==1)
        $data=$object->Show_Answer_TF($quiz_id, $attempt_id);
    else if($type==2)
        $data=$object->Show_Answer_MC($quiz_id, $attempt_id);
    else
        $data=$object->Show_Answer_Essay($quiz_id, $attempt_id);
    echo $data;
?>