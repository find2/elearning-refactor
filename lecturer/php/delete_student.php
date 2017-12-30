<?php
  session_start();

  require 'lib.php';
  $object = new CRUD();
  $student_id=$_POST['student_id'];
  $class=$_POST['class_name'];
  
  $id_class=explode("_", $class)[1];
  $class_name=explode("_", $class)[0];
  
  $data="";
  // delete attempt_quiz
  $data.=$object->Delete_Student_Attempt_Quiz($id_class, $student_id);
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
  // assignment
  $assignments = $object->Assignment_Id_Delete_Enroll($id_class);
	foreach($assignments as $assignment){
	   $file_name= $object->File_Name_Delete_Enroll($assignment['id'], $student_id);
	   $folder='../../assignment/'.$class_name.'_'.$id_class.'_'.$monarch.'/answer/'.$file_name;
	   if(file_exists($folder)){
		    if(unlink($folder)){
		    	 $object->Delete_Assignment_Enroll($assignment['id'], $student_id);
		    }
		  }
		  else{
		    $object->Delete_Assignment_Enroll($assignment['id'], $student_id);
		  }
	}
  echo $data;
?>
