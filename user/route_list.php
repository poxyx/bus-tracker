<?php

include '../class/mysql_class.php';

    $helper  = new sql();

    $sql     = "SELECT * FROM routes";

    $routes  = $helper->select($sql);

?>

<!DOCTYPE HTML>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>User | View Route </title>
</head>
<link rel="stylesheet" type="text/css" href="css/main.css"> 
<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>

<body>

    <div id="map"></div>
    <div id="right-panel">
        <b>Route Name List</b>
        <br><br>
        <center><select class="route_name">
        <option selected disabled>Pick Routes</option>
            <?php foreach($routes as $key): ?>
                <option value="<?php echo $key['codename'];?>"> <?php echo $key['route_name'];?> </option>
            <?php endforeach;?>
        </select></center>
        <br>
        <center><button id="nearest">FIND NEARBY STOP</button></center>
        <br>
        <center><div id="estimated"></div></center>
    <div>

    <script type="text/javascript" src="https://www.gstatic.com/firebasejs/4.8.0/firebase.js"></script>
    <script>
        var config = <?php echo $firebase_config;?>
        var mode   = <?php echo $mode_test;?>
    </script>
    <script type="text/javascript" src="js/main.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?sensor=false&key=<?php echo $api_key;?>&callback=initMap"></script>
</body>

</html>
