<?php
    session_start();
    require 'lib.php';
    $username=$_SESSION['e_username'];
    $monarch=$_SESSION['e_monarch'];
    $object = new CRUD();
    $data=$object->Assignment_Modal($username, $monarch); 
    $data.=$object->Input_Score_Modal();
    $data.=$object->Update_Note_Modal();
    $data .=$object->Assignment_Header(); 
    echo $data;
?>