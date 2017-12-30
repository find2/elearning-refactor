<?php
    session_start();
    require 'lib.php';
    date_default_timezone_set("Asia/Brunei");
	  $current_date = date("Y-m-d");
    $quiz_id=$_POST['quiz_id'];
    $quiz_name=$_POST['quiz_name'];
    $user_id=$_SESSION['e_user_id'];
    $object = new CRUD();
    $is_in_date=$object->Validate_Quiz_Date($quiz_id, $current_date);
    $data=$object->Show_Available_Date($quiz_id, $quiz_name);
    if($is_in_date==0){
      $data.='<h3 class="text-center">Please make quiz between date above.</h3>';
    }
    else{
      $result=$object->Validate_Quiz_Attempt($quiz_id, $user_id);
      if($result==0){
        $duration=$object->Get_Quiz_Duration($quiz_id);
        $object->Insert_Attempt($quiz_id, $user_id, 1, 0, $duration); // attempt, is scored, duration
        $data.=$object->Show_Quiz_Question(1, $quiz_id, $duration);
      }
      else if($result==1){
        $attempt=$object->Get_Attempt($quiz_id, $user_id);
        $duration=$object->Get_Attempt_Duration($quiz_id, $user_id);
        $object->Update_Attempt($attempt, $quiz_id, $user_id);
        $attempt+=1;
        $data.=$object->Show_Quiz_Question($attempt, $quiz_id, $duration);
      }
      else {
        $data .='<h3 class="text-center">Cannot Answer Quiz Anymore.</h3>';
      }
    }
    echo $data;
?>
