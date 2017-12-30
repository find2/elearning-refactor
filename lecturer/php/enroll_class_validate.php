<?php
session_start();
if (isset($_POST)) {
    require 'lib.php';
    $username=$_SESSION['e_username'];
    $id_user=$_SESSION['e_user_id'];
    $monarch=$_SESSION['e_monarch'];
    $code_id = $_POST['code_id'];
    $password = $_POST['password'];
    $class_name = $_POST['class_name'];
    $class_id = end(explode("_", $class_name));
    $enroll_key=mt_rand(100000,999999);
    $object = new CRUD();
    date_default_timezone_set("Asia/Brunei");
	$date = date("Y-m-d H:i:s");
    $result=$object->Enroll_Class_Validate($code_id, $password, $username, $class_name, $monarch);
    $folder="../../assignment/". $class_name . "_". $monarch;
    if($result=="1"){
        // $id_enrolls=$object->Get_Id_Enroll($code);
        // foreach ($id_enrolls as $id) {
        //     $id_enroll=$id['id'];
        // }
        if(!is_dir($folder)){
            mkdir($folder, 0777, true);
            mkdir($folder."/answer", 0777, true);
            mkdir($folder."/question", 0777, true);
        }
        $object->Create_Class_Name($class_id, $code_id, $class_name, $id_user, $monarch, $enroll_key);
        $object->Enroll_Class($code_id, $id_user, $date, $class_id, $monarch);
    }
    echo $result;
    // echo $enroll_key;
	}
?>