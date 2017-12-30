<?php
    require 'lib.php';
    $id = $_POST['id'];
    $object = new CRUD();
    $object->Delete_Comment($id);
?>