<?php
  session_start();

  require 'lib.php';
  $object = new CRUD();
  $student_id=$_POST['student_id'];
  $id_class=$_POST['class_id'];
  $data="";
  // delete attempt_quiz
  $data.=$object->Delete_Student_Attempt_Quiz($id_class, $student_id);
  // assignment
  //$data.=$object->Delete_Student_Assignment($id_class, $student_id);
  // badges
  //$data.=$object->Delete_Student_Badges($id_class, $student_id);
  // comment quiz
  //$data.=$object->Delete_Student_Comment_Quiz($id_class, $student_id);
  // comment tb
  $data.=$object->Delete_Student_Comment($id_class, $student_id);
  // enrolled user
  $data.=$object->Delete_Student_Enrolled_User($id_class, $student_id);
  // rating
  //$data.=$object->Delete_Student_Rating($id_class, $student_id);
  // statistic
  //$data.=$object->Delete_Student_Statistic($id_class, $student_id);
  echo $data;
?>
