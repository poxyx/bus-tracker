<?php 

include '../class/mysql_class.php';


$route_array = "";

foreach($_POST['stop'] as $key) {
    
    $route_array .= ",";
    $route_array .= (str_replace(',', '-',str_replace(' ', '',$key['location'])));
}

$helper = new sql();

$sql = "INSERT INTO routes (bus_id,route_array,route_name,route_start,route_end) VALUES ("."'".@$_POST['bus_id']."'".",
            "."'".substr($route_array,1)."'".",
            "."'".str_replace(' ', '',@$_POST['name'])."'".",
            "."'".str_replace(' ', '',@$_POST['start'])."'".",
            "."'".str_replace(' ', '',@$_POST['end'])."'".")";
    
echo $helper->insert($sql);


?>