<?php

include '../class/mysql_class.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{

    $helper = new sql();

    $sql = "INSERT INTO waypoints (stop_name,stop_location) VALUES ("."'".@$_POST['waypoints_name']."'".","."'".@$_POST['latlng']."'".")";
    
    echo $helper->insert($sql);

}

?>

<!DOCTYPE HTML>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Admin | Add Waypoints </title>
</head>

<body>

<form method="POST" action="#">
        <label>WAYPOINTS NAME</label>
        <br>
            <input type="text" required name="waypoints_name" required> 
        <hr>
        <label>LOCATION ON MAP</label>
        <br>
            <input type="text" required name="latlng">
        <hr>
        <input type="submit">
    </form>

</body>

</html>