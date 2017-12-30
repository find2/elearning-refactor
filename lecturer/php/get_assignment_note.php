<?php
    require 'lib.php';
    $note_id = $_POST['note_id'];
 
    $object = new CRUD();
 
    echo $object->Get_Assignment_Note($note_id);
?>