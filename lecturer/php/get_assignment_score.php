<?php
    require 'lib.php';
    $submitted_id = $_POST['submitted_id'];
 
    $object = new CRUD();
 
    echo $object->Get_Assignment_Score($submitted_id);
?>