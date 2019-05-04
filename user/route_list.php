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
      // Initialize Firebase
    var config = {
        apiKey: "AIzaSyCNtEKwrOSmfi_wn21WQr0WS7Yl-TK_isk",
        authDomain: "driver-tracker-5c786.firebaseapp.com",
        databaseURL: "https://driver-tracker-5c786.firebaseio.com",
        projectId: "driver-tracker-5c786",
        storageBucket: "driver-tracker-5c786.appspot.com",
        messagingSenderId: "585118258922"
      };

    firebase.initializeApp(config);
    const database = firebase.database()
    const ref = database.ref('location');
    var routes_driver_plate = [];
    var routes_driver_name = [];
    var routes_driver_key = [];
    var driver_current_lat = [];
    var driver_current_long = [];
    var count = 0;

    function fetch()
    {
      count++;

      driver_current_lat = [];
      driver_current_long = [];

      for (var i = 0; i < routes_driver_key.length; i++) {

        getLoc(routes_driver_key[i])

      }
    }

    function getLoc(ids) {

      ref.once('value', function(data)
            {
              let objKey = Object.keys(data.val());
              for (obj in objKey)
              {
                let key = objKey[obj];
                if (key == ids)
                {

                  driver_current_lat.push(data.val()[key].latitude);
                  driver_current_long.push(data.val()[key].longitude);

                }
              }
          })
    }

    var counter = -1

    function initMap()
    {
      
      var userPosition = new google.maps.LatLng(6.050227,116.131466); //GET FROM HTML5 GELOCATION
        
      var busPosition = new google.maps.LatLng(6.0364908, 116.1203991); //GET FROM FIREBASE

      var endLatlng = new google.maps.LatLng(6.037920, 116.125129);
      var directionsDisplay = new google.maps.DirectionsRenderer();
      var directionsService = new google.maps.DirectionsService();
      var bounds = new google.maps.LatLngBounds;
      var geocoder = new google.maps.Geocoder;
      var infoWindow = new google.maps.InfoWindow;
      var markers = [];
      var nearestStop = null;

      var mapOptions = {
        zoom: 18,
        center: userPosition
      }

      var pos = {
              lat: 6.040731,
              lng: 116.12391
            };

     infoWindow.setPosition(pos);
     infoWindow.setContent('You');

     function startTracking() 
      {
        window.setInterval(function()
        {
        fetch()

        }, 3000);
      }

      function calculateAndDisplayRoute(start, end, directionsService, directionsDisplay, way_array = [])
      {
        directionsService.route(
        {
          origin: start,
          destination: end,
          waypoints: way_array,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status)
        {
          if (status === 'OK')
          {
            directionsDisplay.setDirections(response);
          }
          else
          {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }

      var service = new google.maps.DistanceMatrixService;

      var timing    = []

      function getEstimatedArrival(start, end)
      {
        service.getDistanceMatrix(
        {
          origins: [start],
          destinations: [end],
          travelMode: 'DRIVING',
          unitSystem: google.maps.UnitSystem.METRIC,
          avoidHighways: false,
          avoidTolls: false
        }, function(response, status)
        {
          if (status !== 'OK')
          {
            console.log('Error was: ' + status);
          }
          else
          {
            var originList = response.originAddresses;
            var estimated = "";

            for (var i = 0; i < originList.length; i++)
            {
              var results = response.rows[i].elements;
              for (var j = 0; j < results.length; j++)
              {
                estimated = results[j].duration.text;
                var minutes = estimated.split(" ")
                timing.push(minutes[0])
              }
            }
            // console.log("Estimated arrival time : " + estimated);
            var timer = estimated.split(" ")

            $("#estimated").html("Next bus estimated arrival time : " + min(timing) );
            
            // console.log(estimated)
                console.log(timer[0])
                if(timer[0] == 1 ) {
                  alert("Your bus is almost here")
              }
          }
        });
      }

      var map = new google.maps.Map(document.getElementById("map"), mapOptions);
      //infoWindow.open(map);

      directionsDisplay.setMap(map);

      var userMarker = new google.maps.Marker(
      {
        position: userPosition,
        icon: '../happy.PNG',
        animation: google.maps.Animation.DROP
      });

      userMarker.setMap(map);

      window.setInterval(function()
      {
          insertBusMarkerPosition()
      }, 2000);

      $("select.route_name")
        .on('change', function()
        {

          var target_route = this.value
          routes_driver_plate = [];
          routes_driver_name = [];
          routes_driver_key = [];

          $.ajax(
          {
            url: '../ajax/pickRoute.php',
            type: 'POST',
            data: jQuery.param(
            {
              route_name: this.value
            }),
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            success: function(json_data)
            {
              $.ajax(
                {
                      url: '../ajax/pickBus.php',
                      type: 'POST',
                      data: jQuery.param(
                      {
                        route_name: target_route
                      }),
                      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                      success: function(bus_data)
                      {
                          var route_driver = [];
                          var json_driver  = JSON.parse(bus_data)
   
                          for (var i = 0; i < json_driver.length; i++)
                          {
                            route_driver.push(
                              {
                                  driver_name: json_driver[i],
                                  plate_number: json_driver[i + 2],
                                  firebase_id: json_driver[i + 1]
                              });
                          }

                          for (var i = 0; i < route_driver.length; i++)
                          {

                            if((i % 3) == 0 ) 
                            {                              
                              routes_driver_name.push(route_driver[i].driver_name)
                              routes_driver_plate.push(route_driver[i].plate_number)
                              routes_driver_key.push(route_driver[i].firebase_id)
                            }
                           
                          }
                      },
                      error: function()
                      {
                        console.log("error");
                  }
              });

              var result = [];
              var json_data = JSON.parse(json_data);
              for (var i = 0; i < json_data.length; i++)
              {
                result.push(
                {
                  location: json_data[i],
                  stopover: true
                });
              }
              var route_start = result[0]
              var route_end = result.slice(-1)
                .pop()
              result.shift()
              result.pop()

              markers = result;
              
                startTracking()
                calculateAndDisplayRoute(route_start.location, route_end.location, directionsService, directionsDisplay, result)

            },
            error: function()
            {
              console.log("error");
            }
          });
        });

        $('#nearest').click(function(){
            // console.log(markers);
            find_closest_marker() 
        })

        function find_closest_marker() 
        {   

            markers.shift()
            markers.pop()

            var distances = []
            var lowest    = []

            for (i = 0; i < markers.length; i++) 
            {   
                var loc = markers[i].location
                var res = loc.split(",");
                var _lstart = parseFloat(res[0])
                var _lend   = parseFloat(res[1])
                var _lstart_end =  _lstart + "," + _lend
                var route_mark =  new google.maps.LatLng(_lstart,_lend)
                var d = google.maps.geometry.spherical.computeDistanceBetween(route_mark,userPosition);

                distances.push(
                {
                  range: d,
                  location: _lstart_end
                });
   
            }

            for (i = 0; i < distances.length; i++) 
            {  
                lowest.push(distances[i].range)
            }

            for (i = 0; i < distances.length; i++) 
            {  
                if(distances[i].range == min(lowest))
                {
                    nearestStop = distances[i].location
                    console.log(nearestStop)
                    var ares = nearestStop.split(",");
                    var _a = parseFloat(ares[0])
                    var _b   = parseFloat(ares[1])

                    var target = new google.maps.LatLng(_a,_b)
                        
                    map.setZoom(19);
                    map.panTo(target);
                }
            }
                             
        }

        var placeholder = [];

        function insertBusMarkerPosition()
        {
            
            // var latlng = new google.maps.LatLng(driver_current_lat[0], driver_current_long[0]);
            // marker.setPosition(latlng);

          removeMarkers()

          for (var i = 0; i < driver_current_lat.length; i++)
            {
              addMarker(new google.maps.LatLng(driver_current_lat[i], driver_current_long[i]))
              if(nearestStop != null ) 
              {   
                  getEstimatedArrival(driver_current_lat[i] + "," +  driver_current_long[i], nearestStop)
                  timing = [];
              }
            }

        } 

        function addMarker(location) {
            mark = new google.maps.Marker({
                position: location,
                icon: '../bus_color.PNG',
                map: map
            });

            placeholder.push(mark);
        }

        function removeMarkers() {

            for (var i = 0; i < placeholder.length; i++) {
              placeholder[i].setMap(null);
            }
        }

    }

    function min(input) {
     if (toString.call(input) !== "[object Array]")  
       return false;
         return Math.min.apply(null, input);
	}
   
   </script>
   <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFqYJJV5e95myYR2wBHxwP-YiO4KnMnE4&callback=initMap"></script>

</body>

</html>
