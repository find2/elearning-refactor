<?php
    session_start();
    require 'lib.php';
    $class_id=$_POST['class_id'];
    $object = new CRUD();
    //$data = $object->Material_Modal($username);
    $data = $object->Material_Header();
    $data .= $object->Data_Material_Table($class_id);
    $data .='</tbody>
			 </table>
			 </div>
			 </div>
			 </section>';
    echo $data;
?>