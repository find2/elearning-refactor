<?php
    session_start();
    require 'lib.php';
    date_default_timezone_set("Asia/Brunei");
	$date_created = date("Y-m-d H:i:s");
    $attempt_id=$_POST['attempt_id'];
    $user_id=$_SESSION['e_user_id'];
    $total_score=$_POST['total_score'];
    $is_Scored=$_POST['is_Scored'];
    $score=$_POST['score'];
    $total_essay=$_POST['total_essay'];
    $class_id=$_POST['class_id'];
    $type = $_POST['type'];
    $quiz_id=$_POST['quiz_id'];
    
    $object = new CRUD();
    $object->Update_Score($attempt_id, $total_score);
    $data=$object->Update_Attempt($attempt_id, $is_Scored);
    for($i=1; $i<=$total_essay; $i++){
        $object->Update_Score_Essay($attempt_id, $score, $i);
    }
    $notif_id = $object->Write_Notif($class_id, $type, $attempt_id, $date_created, $user_id);
	$datas = $object->Get_User_Id_Enrolled($class_id, $user_id);
    if(count($datas)>0){
        foreach ($datas as $data) {
	        $object->Write_User_Notif($data['id_user'], $notif_id, 0);
	    }
    }
    echo $data;
?>
