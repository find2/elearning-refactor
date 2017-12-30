<?php
    $status = $_POST['status'];
    $type = $_POST['type'];
    
    if($type == 'danger'){
        $data = '
            <div id="alert_box" class="alert alert-danger alert-dismissible">
                <button type="button" class="close" onClick="alert_hide()" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                '. $status .'
              </div>
        ';
    }
    
    else if ($type == 'warning'){
        $data = '
            <div id="alert_box" class="alert alert-warning alert-dismissible">
                <button type="button" class="close" onClick="alert_hide()" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                '. $status .'
              </div>
        ';
    }
    
    else if ($type == 'info'){
        $data = '
            <div id="alert_box" class="alert alert-info alert-dismissible">
                <button type="button" class="close" onClick="alert_hide()" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Alert!</h4>
                '. $status .'
              </div>
        ';
    }
    
    else{
        $data = '
            <div id="alert_box" class="alert alert-success alert-dismissible">
                <button type="button" onClick="alert_hide()" class="close" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                '. $status .'
              </div>';  
    }
    
    echo $data;
?>