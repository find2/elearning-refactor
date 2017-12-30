<?php
    session_start();
    require 'lib.php';
    $username=$_SESSION['e_username'];
    $monarch=$_SESSION['e_monarch'];
    $object = new CRUD();
    $data = $object->Quiz_Modal($username, $monarch);
    $data .= $object->Show_Quiz_Modal($username, $monarch);
    $data .= $object->Show_Score_Modal($username, $monarch);
    $data .= $object->Show_Student_Score_Modal($username, $monarch);
    $data .= $object->Preview_Quiz_Modal($username, $monarch);
    $data .= $object->Show_Student_Answer_Modal();
    $data .= $object->Quiz_Header();
    //Codes here
    echo $data;
?>
