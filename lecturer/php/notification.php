<?php
    session_start();
    require 'lib.php';
	$user_id=$_SESSION['e_user_id'];
	$monarch=$_SESSION['e_monarch'];
	$current_user=$_SESSION['e_name'];
	$notif_id=$_POST['notif_id'];
	$class_id=$_POST['class_id'];
	$class_name=$_POST['class_name'];
	$view=$_POST['view_all'];
    $object = new CRUD();
    
    $object->Update_User_Notif($notif_id, $user_id, 1);
    $type=$object->Notification_Type($notif_id);
    $type_id=$object->Notification_Type_Id($notif_id);
    $data='';
    switch($type){
        case 1:
        case 2:
            // $data=$object->Select_Post_Coment($notif_id, $type_id);
            $data.=$object->Header_Notif("Post", "Discussion");
            $data.=$object->Post_Content_Notif();
            $posts = $object->Read_Post_Notification($type_id);
            if(count($posts)>0){
                foreach ($posts as $post) {
                    $data.= $object->Post_Notification($post['username'], $post['date_created'], $post['description'], $post['post_id']);
                    $comments=$object->Read_Comment($type_id, $monarch);
                    if(count($comments>0)){
                        foreach($comments as $comment){
                            $data.=$object->Comment_post($comment['username'], $comment['date_created'], $comment['content'], $comment['comment_id'], $current_user);
                        }
                    }
                    $data.= $object->End_Post_Notification($type_id);
                }
            }
            $data.='</div></section>';
            break;
        case 3:
            break;
        case 4:
            break;
        case 5:
            break;
        case 6:
            break;
        case 7:
            break;
        case 8:
            break;
        case 9:
            $data.=$object->Input_Score_Modal_Notification($type_id);
            $data.=$object->Header_Notif("Assignment", "");
            $data.=$object->Assignment_Content_Notif();
            $data.=$object->Submitted_Assignment_Notification($type_id, $class_id, $user_id);
            $data.='</div></div></div></section>';
            break;
        case 10:
            $data.=$object->Header_Notif("Quiz", "");
            $data.=$object->Quiz_Content_Notif();
            $data.=$object->Quiz_Title_Notification($type_id);
            $data.=$object->Show_Essay_Notification($type_id);
            $data.='</div></div></div></section>';
            break;
        case 11:
            break;
        case 12:
            break;
        default:
            $data.=$object->Header_Notif("", "");
            $data.='No Record Found';
            $data.='</div></section>';
            break;
    }
    
    echo $data;
?>