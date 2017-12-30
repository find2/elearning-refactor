<?php
	session_start();
    require("lib.php");
    date_default_timezone_set("Asia/Brunei");
	$date_created = date("Y-m-d H:i:s");
	$user_id=$_SESSION['e_user_id'];
	$class_id = $_POST['class_code'];
	$quiz_name = $_POST['title'];
	$duration = $_POST['duration'];
	$monarch = $_SESSION['e_monarch'];
	$number_tf = $_POST['number_tf'];
	$number_mc = $_POST['number_mc'];
	$number_e = $_POST['number_e'];
	$date_started = $_POST['start_date'];
	$date_ended = $_POST['end_date'];
	$attempt=$_POST['attempt'];
	$type=$_POST['type'];
	
	if($number_tf > 0){
		$qtf = $_POST['qtf'];
		$ktf = $_POST['ktf'];
	}
	
	if($number_mc > 0){
		$qm = $_POST['qm'];
		$km = $_POST['km'];
		$ama = $_POST['ama'];
		$amb = $_POST['amb'];
		$amc = $_POST['amc'];
		$amd = $_POST['amd'];
	}
	
	if($number_e > 0){
		$qe = $_POST['qe'];
		$ke = $_POST['ke'];
		$se = $_POST['se'];
	}

	$object = new CRUD();
	$result = $object->Validate_Quiz($quiz_name, $class_id, $monarch); // Melakukan validasi apakah nama kuis sudah ad pda kelas dan monarch yg sama (0 belum ada, 1 sdh ada)
	if($result==0){
	    $quiz_id = $object->Write_Quiz($user_id, $class_id, $quiz_name, $duration, $date_created, $date_started, $date_ended, $monarch, $number_mc, $number_e, $attempt, $number_tf);
	    $notif_id = $object->Write_Notif($class_id, $type, $quiz_id, $date_created, $user_id);
	    $datas = $object->Get_User_Id_Enrolled($class_id, $user_id);
	    if(count($datas)>0){
	        foreach ($datas as $data) {
	        	$object->Write_User_Notif($data['id_user'], $notif_id, 0);
	        }
	    }
	    
	    if($number_tf>0){
	    	for($i = 1; $i <= $number_tf; $i++){
				$object->Write_QA_TF($quiz_id, $i, $qtf[$i], $ktf[$i]);
			}
	    }

	    if($number_mc>0){
		    for($i = 1; $i <= $number_mc; $i++){
				$qa_mc_id = $object->Write_QA_MC($quiz_id, $i, $qm[$i], $km[$i]);
				$object->Write_MC_Quiz($qa_mc_id, $ama[$i], $amb[$i], $amc[$i], $amd[$i]);
			}
	    }

	    if($number_e>0){
		    for($i = 1; $i <= $number_e; $i++){
				$object->Write_QA_Essay($quiz_id, $i, $qe[$i], $ke[$i], $se[$i]);
			}
	    }
	}
	echo $result;




?>
