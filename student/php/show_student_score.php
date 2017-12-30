<?php
    session_start();
    require 'lib.php';
    $id_attempt=$_POST['id_attempt'];
    $object = new CRUD();
    $data=$object->Student_Score($id_attempt);
    //$data.=$object->Student_Submit_Answer($quiz_id);
    echo $data;
?>
