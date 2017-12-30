<?php
    session_start();
    require 'lib.php';
    date_default_timezone_set("Asia/Brunei");
	$u_date_created = date("Y-m-d H:i:s");
    $u_monarch = $_SESSION['e_monarch'];
    $u_user_id=$_SESSION['e_user_id'];
    $u_quiz_id = $_POST['u_quiz_id'];
    $u_class_id = $_POST['u_class_code'];
	$u_quiz_name = $_POST['u_title'];
	$u_duration = $_POST['u_duration'];
	$u_number_tf = $_POST['u_number_tf'];
	$u_number_mc = $_POST['u_number_mc'];
	$u_number_e = $_POST['u_number_e'];
	$u_date_started = $_POST['u_start_date'];
	$u_date_ended = $_POST['u_end_date'];
	$u_attempt = $_POST['u_attempt'];
	$u_type=$_POST['u_type'];
	
	if($u_number_tf > 0){
		$u_qtf = $_POST['u_qtf'];
		$u_ktf = $_POST['u_ktf'];
	}
	
	if($u_number_mc > 0){
		$u_qm = $_POST['u_qm'];
		$u_km = $_POST['u_km'];
		$u_ama = $_POST['u_ama'];
		$u_amb = $_POST['u_amb'];
		$u_amc = $_POST['u_amc'];
		$u_amd = $_POST['u_amd'];
	}
	
	if($u_number_e > 0){
		$u_qe = $_POST['u_qe'];
		$u_ke = $_POST['u_ke'];
		$u_se = $_POST['u_se'];
	}
	
    $object = new CRUD();
    $u_result = $object->Validate_Quiz_Update($u_quiz_name, $u_class_id, $u_monarch, $u_quiz_id); // Melakukan validasi apakah nama kuis sudah ad pda kelas dan monarch yg sama (0 belum ada, 1 sdh ada)
    if($u_result==0){
	    $object->Update_Quiz($u_quiz_name, $u_duration, $u_date_started, $u_date_ended, $u_number_mc, $u_number_e, $u_quiz_id, $u_attempt, $u_number_tf);
	    $notif_id = $object->Write_Notif($u_class_id, $u_type, $u_quiz_id, $u_date_created, $u_user_id);
	    $datas = $object->Get_User_Id_Enrolled($u_class_id, $u_user_id);
	    if(count($datas)>0){
	        foreach ($datas as $data) {
	        	$object->Write_User_Notif($data['id_user'], $notif_id, 0);
	        }
	    }
	    
	    $object->Delete_QA_MC($u_quiz_id);
	    $object->Delete_QA_Essay($u_quiz_id);
	    $object->Delete_QA_TF($u_quiz_id);
	    
	    if($u_number_tf > 0){
	    	for($i = 1; $i <= $u_number_tf; $i++){
				$object->Write_QA_TF($u_quiz_id, $i, $u_qtf[$i], $u_ktf[$i]);
			}
	    }

	    if($u_number_mc>0){
		    for($i = 1; $i <= $u_number_mc; $i++){
				$u_qa_mc_id = $object->Write_QA_MC($u_quiz_id, $i, $u_qm[$i], $u_km[$i]);
				$object->Write_MC_Quiz($u_qa_mc_id, $u_ama[$i], $u_amb[$i], $u_amc[$i], $u_amd[$i]);
			}
	    }

	    if($u_number_e>0){
		    for($i = 1; $i <= $u_number_e; $i++){
				$object->Write_QA_Essay($u_quiz_id, $i, $u_qe[$i], $u_ke[$i], $u_se[$i]);
			}
	    }
	}
    
    echo $u_result;
?>
