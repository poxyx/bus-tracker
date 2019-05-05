<?php

include '../class/mysql_class.php';

$helper = new sql();

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $sql = "INSERT INTO bus (driver,route_codename,plate_number, seat_total,firebase_id) VALUES 
    ("."'".@$_POST['driver']."'".","."'".@$_POST['route_name']."'".","."'".
    @$_POST['plate_number']."'".","."'".@$_POST['seat_total'].
    "'".","."'".@$_POST['fb_id']."'".")";
    
    echo $helper->insert($sql);

}

?>

<!DOCTYPE HTML>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Admin | Add Driver </title>
</head>

    <form method="POST" action="#">
        <label>DRIVER</label>
        <br>
            <input type="text" required name="driver" id="driver"> 
        <hr>
        <input type="submit" id="submit">
    </form>

<body>

</body>

</html>


