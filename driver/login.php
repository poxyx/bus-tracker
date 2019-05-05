
<?php

include '../class/mysql_class.php';

    $helper  = new sql();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
         $driver_id =  @$_POST['driver_id'];
         $sql  = "SELECT * FROM bus WHERE firebase_id = '$driver_id'";

         foreach($helper->select($sql) as $key => $val) {

            $plate_number = $val['plate_number'];

            if ($val['firebase_id'] == $driver_id) {
                header("Location: http://localhost:8080/bus-tracker/driver/tracker.php?key=$driver_id&plate=$plate_number");
            }
         }
    }


?>

<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Driver | Location Tracker </title>    
</head>
    <body>
        <form method="POST" action="#">
            <label>DRIVER ID</label>
            <br>
                <input type="text" required name="driver_id"> 
            <hr>
            <input type="submit" value="START TRACKING">
        </form>
    </body>
</html>


