<?php
    session_start();

    require 'lib.php';
    $object = new CRUD();
    $username=$_SESSION['e_username'];
    $monarch=$_SESSION['e_monarch'];
    //$data.=$object->Show_Post_Modal($username, $monarch);
    $data.=$object->Header_Post();
    echo $data;

?>
