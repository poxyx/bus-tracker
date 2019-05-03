<?php 

include '../class/mysql_class.php';

$helper = new sql();

$route = "'".@$_POST['route_name']."'";

$sql = "SELECT * FROM routes WHERE route_name = $route ";
    
$result = $helper->select($sql);
$route_string = null;
$route_start  = null;
$route_start  = null;
$way_points   = array();
$counter      = 0;

foreach($result as $key => $value) {
    $route_string =  $value['route_array'];
    $route_start  =  $value['route_end'];
    $route_start  =  $value['route_start'];
}

$route_array  = explode(",",$route_string);
$array_length = count($route_array);

array_push($way_points,$value['route_start']);

while($counter < $array_length){

    array_push($way_points,$route_array[$counter]);
    $counter++;
}

array_push($way_points,$value['route_end']);

$last_point = count($way_points);
echo json_encode(str_replace("-",",",$way_points));

?>