<?php

include '../class/mysql_class.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{

    $helper = new sql();

    $sql = "INSERT INTO bus (plate_number, seat_total) VALUES ("."'".@$_POST['plate_number']."'".","."'".@$_POST['seat_total']."'".")";
    
    echo $helper->insert($sql);

}

?>

<!DOCTYPE HTML>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Admin | Add Bus </title>
</head>

    <form method="POST" action="#">
        <label>PLATE NUMBER</label>
        <br>
            <input type="text" required name="plate_number"> 
        <hr>
        <label>TOTAL SEAT</label>
        <br>
            <input type="text" required name="seat_total">
        <hr>
        <input type="submit">
    </form>

<body>

</body>

</html>