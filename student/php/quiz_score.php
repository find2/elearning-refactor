<?php
    session_start();
    require 'lib.php';
    $user_id=$_SESSION['e_user_id'];
    $class_id=$_POST['class_id'];
    $class_name=$_POST['class_name'];
    $object = new CRUD();
    $quiz_ids=$object->Select_Id_Quiz($class_id);
    $data='<h3 class="text-center">'. $class_name .'</h3>
            <table class="table table-striped table-bordered">
	              <thead>
	                <tr>
	                  <th>No.</th>
	                  <th>Quiz Name</th>
	                  <th>True or False</th>
	                  <th>Multiple Choice</th>
	                  <th>Essay</th>
	                </tr>
	              </thead>
	              <tbody>';
	if (count($quiz_ids)>0) {
	    $get_score=0; 
	    $number=1;
	    foreach ($quiz_ids as $quiz_id) {
	        $attempt_id=$object->Get_Id_Attempt($quiz_id['id'], $user_id);
	        $result=$object->Validate_Score($attempt_id);
	        if($result==1){ // jika sudah prnh mensubmit
	            $data.=$object->Show_Quiz_Score($number, $attempt_id, $quiz_id['quiz_name'], $quiz_id['id']);
	            $get_score=1;
	            $number++;
	        }
	    }
	    if($result==0 && $get_score==0){ // Tidak memiliki data nilai
	        $data.='<tr>
                        <td colspan="5">Record Not Found. </td>
                    </tr>';
	    }
	}
	else{ // Tidak ada kuis
	    $data.='<tr>
                    <td colspan="5">Record Not Found. </td>
                </tr>';
	}
    //
    $data.='</tbody>
            </table>';
    echo $data;
?>