<?php
    session_start();
    require 'lib.php';
	$user_id=$_SESSION['e_user_id'];
	$view=$_POST['view_all'];
    $object = new CRUD();
    
    $data='';
    if($view==0){
        $data.=$object->Header_Notif("All Notification", "");
        $data.=$object->View_Content_Notif();
        $data.=$object->Show_All_Post_Comment($user_id);
        $data.='</div></section>';
    } else if($view==1){
        $data.=$object->Header_Notif("All Notification", "");
        $data.=$object->View_Content_Notif();
        $data.=$object->Show_All_Assignment_Quiz($user_id);
        $data.='</div></section>';
    } else {
        $data.=$object->Header_Notif("", "");
        $data.='No Record Found';
        $data.='</div></section>';
    }
    
    echo $data;
?>