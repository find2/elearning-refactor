<?php
  session_start();

  require 'lib.php';
  $object = new CRUD();
  $id_class=$_POST['class_id'];
  $monarch=$_SESSION['e_monarch'];
  $id_user=$_SESSION['e_user_id'];
  $data="";
  $data.=$object->Show_Student_Name($id_class, $monarch, $id_user);
  echo $data;
?>
