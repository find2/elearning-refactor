<?php
    session_start();
    require 'lib.php';
    $user_id=$_SESSION['e_user_id'];
    $class_id=$_POST['class_id'];
    $object = new CRUD();
    $data = $object->Learning_Modal();
    $data .= $object->Learning_Header();
    $data .= $object->Data_Learning_Table($class_id, $user_id);
    $data .= '</tbody>
			  </table>
			  </div>
			  </div>
			  </section>';
    echo $data;
?>