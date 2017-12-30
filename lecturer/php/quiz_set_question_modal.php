<?php
    session_start();
    require 'lib.php';
    $number=$_POST['number'];
    $type=$_POST['type'];
    $current_number_tf=$_POST['current_number_tf'];
    $current_number_mc=$_POST['current_number_mc'];
    $current_number_essay=$_POST['current_number_essay'];
    $object = new CRUD();
    if($type==1)
   		$data=$object->Question_Field_Mc($number, $current_number_mc);
   	else if($type==2)
   		$data=$object->Question_Field_Essay($number, $current_number_essay);
   	else
   	    $data=$object->Question_Field_Tf($number, $current_number_tf);
    echo $data;
?>