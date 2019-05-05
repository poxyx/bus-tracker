
<?php

include '../class/mysql_class.php';

    $helper = new sql();

    $points = "SELECT * FROM waypoints";

    $point = $helper->select($points);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Admin | Add Route </title>
    <link rel="stylesheet" type="text/css" href="css/main.css"> 
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  </head>
  <body>
    <div id="map"></div>
    <div id="right-panel">
    <div>

    <b>Start:</b>
    <select class="start" id="start">
    <option selected>Starting Location</option>
      <?php foreach($point as $key): ?>
            <option value="<?php echo $key['stop_location'];?>"> <?php echo $key['stop_name'];?> </option>
        <?php endforeach;?>
    </select>
    <br>


    <b>Waypoints:</b> <br>
    <i>(Ctrl+Click or Cmd+Click for multiple selection)</i> <br>
    <select multiple id="waypoints" style="height:300px">
        <?php foreach($point as $key): ?>
            <option value="<?php echo $key['stop_location'];?>"> <?php echo $key['stop_name'];?> </option>
        <?php endforeach;?>
    </select>
    <br>

    <b>End:</b>
    <select class="end" id="end">
    <option selected>Ending Location</option>
        <?php foreach($point as $key): ?>
            <option value="<?php echo $key['stop_location'];?>"> <?php echo $key['stop_name'];?> </option>
        <?php endforeach;?>
    </select>
    <br>
    <b>Route Name</b><br>
        <input type="text" id="route_name" name="route_name" style="width:100%">
    <br>
    <b>Route Codename</b><br>
        <input type="text" id="route_codename" name="route_name" style="width:100%">
    <br>
    <br>
    <center>
      <button id="preview">Preview Route</button>
      <button id="clear">Clear Route</button>
      <button id="submit">Create Route</button>
    </center>

    </div>
    <div id="directions-panel" style="display:none"></div>
    </div>
   <script>
     
     var __lat = "<?php echo $test_lat;?>";
     var __lng = "<?php echo $test_lng;?>";

   </script>
   <script type="text/javascript" src="js/waypoints.js"></script>
   <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $api_key;?>&callback=initMap"></script>
  </body>
</html>