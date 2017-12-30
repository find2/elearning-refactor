<?php
    session_start();
    require 'lib.php';
    date_default_timezone_set("Asia/Brunei");
	$date_created = date("Y-m-d H:i:s");
    $quiz_id=$_POST['quiz_id'];
    $user_id=$_SESSION['e_user_id'];
    $duration=$_POST['duration'];
    $total_tf=$_POST['total_tf'];
    $tf=$_POST['tf'];
    $total_mc=$_POST['total_mc'];
    $mc = $_POST['mc'];
    $total_essay=$_POST['total_essay'];
    $essay = $_POST['essay'];
    $total_score_mc=0;
    $total_score_essay=0;
    $total_score_tf=0;
    $class_id=$_POST['class_id'];
    $type=$_POST['type'];
    $object = new CRUD();
    
    //Scoring Tf
    if($total_tf>0){
      $score_tf=100/$total_tf;
      for($i=1; $i<=$total_tf; $i++){
        $answer_tf=$object->Get_Answer_TF($quiz_id, $i, $tf[$i]);
        if($answer_tf==1){
          $total_score_tf += $score_tf;
        }
      }
    }//End tf
    
    // Scoring mc
    if($total_mc>0){
      $score_mc=100/$total_mc;
      for($i=1; $i<=$total_mc; $i++){
        $answer=$object->Get_Answer($quiz_id, $i, $mc[$i]);
        if($answer==1){
          $total_score_mc += $score_mc;
        }
      }
    }//end mc
    
    $id_attempt=$object->Get_Id_Attempt($quiz_id, $user_id);
    $notif_id = $object->Write_Notif($class_id, $type, $id_attempt, $date_created, $user_id);
    $datas = $object->Get_User_Id_Enrolled($class_id, $user_id);
    if(count($datas)>0){
    	foreach ($datas as $data) {
        	$object->Write_User_Notif($data['id_user'], $notif_id, 0);
        }
    }
    
    $result=$object->Validate_Score($id_attempt);
    if($result==0){// Jika tidak prnah submit
      $object->Save_Score($id_attempt, $total_score_mc, $total_score_essay, $total_score_tf);
      //Save answer tf
      if($total_tf>0){
        for($t=1; $t<=$total_tf; $t++){
          $object->Save_Tf($t, $tf[$t], $id_attempt);
        }
      }//end tf
      //Save answer mc
      if($total_mc>0){
        for($m=1; $m<=$total_mc; $m++){
          $object->Save_Mc($m, $mc[$m], $id_attempt);
        }
      }//end mc
      //Save answer essay
      if($total_essay>0){
        for($x=1; $x<=$total_essay; $x++){
          $object->Save_Essay($x, $essay[$x], $id_attempt);
        }
      }//end essay
    }
    else{//Sdah prnah submit
      $object->Delete_Tf($id_attempt);
      $object->Delete_Mc($id_attempt);
      $object->Delete_Essay($id_attempt);
      $object->Update_Score($id_attempt, $total_score_mc, $total_score_essay, $total_score_tf);
      //Save answer tf
      if($total_tf>0){
        for($t=1; $t<=$total_tf; $t++){
          $object->Save_Tf($t, $tf[$t], $id_attempt);
        }
      }//end tf
      //Save answer mc
      if($total_mc>0){
        for($m=1; $m<=$total_mc; $m++){
          $object->Save_Mc($m, $mc[$m], $id_attempt);
        }
      }//end mc
      //Save answer essay
      if($total_essay>0){
        for($x=1; $x<=$total_essay; $x++){
          $object->Save_Essay($x, $essay[$x], $id_attempt);
        }
      }//end essay
    }
    
    $object->Update_Attempt_Duration($quiz_id, $user_id, $duration);
    $object->Update_Attempt_Submit($id_attempt, 1);

    echo $id_attempt;
?>
