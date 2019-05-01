
<?php

include '../class/mysql_class.php';

    $helper = new sql();

    $sql   = "SELECT * FROM bus";

    $points = "SELECT * FROM waypoints";

    $bus   = $helper->select($sql);
    $point = $helper->select($points);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Admin | Add Route </title>
    <style>
      #right-panel {
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }

      #right-panel select, #right-panel input {
        font-size: 15px;
      }

      #right-panel select {
        width: 100%;
      }

      #right-panel i {
        font-size: 12px;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
        float: left;
        width: 70%;
        height: 100%;
      }
      #right-panel {
        margin: 20px;
        border-width: 2px;
        width: 20%;
        height: 400px;
        float: left;
        text-align: left;
        padding-top: 0;
      }
      #directions-panel {
        margin-top: 10px;
        background-color: #FFEE77;
        padding: 10px;
        overflow: scroll;
        height: 174px;
      }
    </style>
    <script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
  </head>
  <body>
    <div id="map"></div>
    <div id="right-panel">
    <div>

    <b>Bus list</b>
    <select class="bus_id">
    <option selected>Bus to Assign</option>
        <?php foreach($bus as $key): ?>
            <option value="<?php echo $key['plate_number'];?>"> <?php echo $key['plate_number'];?> </option>
        <?php endforeach;?>
    </select>


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
        <input type="text" class="route_name" name="route_name" style="width:100%" required>
    <br>
    <br>

    <center>
      <button id="preview">Preview Route</button>
      <button id="submit">Assign Route</button>
    </center>

    </div>
    <div id="directions-panel" style="display:none"></div>
    </div>

    <script>

      var waypts = [];

      function initMap() {
          
        var directionsService = new google.maps.DirectionsService;

        var directionsDisplay = new google.maps.DirectionsRenderer({
            polylineOptions: {
            strokeColor: "#2c82c9"
            }
        });

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: {lat: 6.041796, lng: 116.127658}
        });

        directionsDisplay.setMap(map);

        document.getElementById('preview').addEventListener('click', function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        });
       
      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {

        var checkboxArray = document.getElementById('waypoints');
        for (var i = 0; i < checkboxArray.length; i++) {
          if (checkboxArray.options[i].selected) {
            waypts.push({
              location: checkboxArray[i].value,
              stopover: true
            });
            
          }
        }

       
        directionsService.route({
          origin: document.getElementById('start').value,
          destination: document.getElementById('end').value,
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
            var route = response.routes[0];
            var summaryPanel = document.getElementById('directions-panel');
            summaryPanel.innerHTML = '';
            // For each route, display summary information.
            for (var i = 0; i < route.legs.length; i++) {
              var routeSegment = i + 1;
              summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
                  '</b><br>';
              summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
              summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
              summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
            }
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });

      }

      $("select.bus_id").change(function(){
            var _bus = $(this).children("option:selected").val();
               console.log(_bus);
      });

      $("select.start").change(function(){
            var _start = $(this).children("option:selected").val();
               console.log(_start);
      });

      $("select.end").change(function(){
            var _end = $(this).children("option:selected").val();
               console.log(_end);
      });

      var _name = $("select.route_name").val()

      function insertRouteData() {

        console.log(waypts);
        

      }

    </script>
   <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $api_key;?>&callback=initMap"></script>
  </body>
</html>