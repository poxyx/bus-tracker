<?php 

include '../class/mysql_class.php';

$helper = new sql();

$route = "'".@$_POST['route_name']."'";

$bus = "SELECT * FROM bus WHERE route_codename = $route ";
    
$route_bus = $helper->select($bus);

// var_dump($route_bus);
$bus_in_route = array();

foreach($route_bus as $key => $value) {
   array_push($bus_in_route, $value['driver']);
   array_push($bus_in_route, $value['firebase_id']);
   array_push($bus_in_route, $value['plate_number']);
}

echo json_encode($bus_in_route);

?>