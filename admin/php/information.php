<?php
    session_start();
    require 'lib.php';
    $object = new CRUD();
    $data = $object->Information_Header();
    $data .= $object->Information_Modal();
    // $informations = $object->Information_Data();
    if(count($informations)>0){
        $data .= $object->Information_Table_Start();
        foreach($informations as $information){
            // $data .= $object->Information_Body($information['id'], $information['image_url'], $information['title']);
        }
        $data .= $object->Information_Table_End();
    }
    echo $data;
?>
