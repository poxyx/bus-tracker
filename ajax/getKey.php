<?php 

include '../class/mysql_class.php';

$id = @$_POST['id'];

$helper = new sql();

$sql = "SELECT firebase_id FROM bus WHERE driver = $id";

$id_key = $helper->select($sql);

foreach($id_key as $key => $value) {
    echo $value['firebase_id'];
 }

?>