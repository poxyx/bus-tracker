<?php

include '../class/mysql_class.php';

    $helper  = new sql();

    $sql     = "SELECT * FROM routes";

    $routes  = $helper->select($sql);

    $bus_id = "-LdqVbSsr3mLpLYnZTpH";

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
        <select class="route_name">
        <option selected>Pick Routes</option>
            <?php foreach($routes as $key): ?>
                <option value="<?php echo $key['route_name'];?>"> <?php echo $key['route_name'];?> </option>
            <?php endforeach;?>
        </select>
        <br><br>
        <button id="nearest">FIND NEARBY STOP</button>
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
    const bus_id = "-LdqVbSsr3mLpLYnZTpH"
    const plate = "SAB7894"

    function insert(lat, long, id)
    {
      const result = ref.push(
      {
        latitude: lat,
        longitude: long,
        id: id
      })
      // console.log(result);
    }

    function update(lat, long, id)
    {
      ref.update(
      {
        "<?php echo $bus_id;?>":
        {
          latitude: lat,
          longitude: long,
          id: id
        }
      })
      console.log("updated" + key);
    }

    function deleteData(key)
    {
      ref.update(
      {
        key: null
      })
    }

    var count = 0;
    var fb_lat = 0;
    var fb_long = 0;

    function fetch()
    {
      count++;
      ref.once('value', function(data)
      {
        let objKey = Object.keys(data.val());
        for (obj in objKey)
        {
          let key = objKey[obj];
          if (key == bus_id)
          {
            fb_lat = data.val()[key].latitude;
            fb_long = data.val()[key].longitude
          }
        }
      })
    }

    var counter = -1

    function initMap()
    {
      
      var userPosition = new google.maps.LatLng(6.040731,116.12391); //GET FROM HTML5 GELOCATION
        
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
            if(nearestStop != null ) 
            {
                //getEstimatedArrival(fb_lat + "," + fb_long, nearestStop)
            }
        }, 2000);
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
            var estimated = '';
            for (var i = 0; i < originList.length; i++)
            {
              var results = response.rows[i].elements;
              for (var j = 0; j < results.length; j++)
              {
                estimated = results[j].duration.text;
              }
            }
            console.log("Estimated arrival time : " + estimated);
          }
        });
      }

      var map = new google.maps.Map(document.getElementById("map"), mapOptions);
      //infoWindow.open(map);

      directionsDisplay.setMap(map);

      var marker = new google.maps.Marker(
      {
        position: busPosition,
        icon: '../bus_color.PNG'
      });

      var userMarker = new google.maps.Marker(
      {
        position: userPosition,
        icon: '../happy.PNG',
        animation: google.maps.Animation.DROP
      });

      userMarker.setMap(map);

      window.setInterval(function()
      {
        marker.setMap(map);
      }, 1000);

      window.setInterval(function()
      {
        marker.setMap(null);
        changeMarkerPosition(marker, location)
      }, 3000);

      $("select.route_name")
        .on('change', function()
        {
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

                    var test = new google.maps.LatLng(_a,_b)
                        
                    var nearMarker = new google.maps.Marker(
                        {
                            position: test,
                            icon: '../happy.PNG',
                            animation: google.maps.Animation.BOUNCE
                        });

                        map.setZoom(20);
                        map.panTo(test);
                        nearMarker.setMap(map);
                }
            }
                             
        }
    }

    function changeMarkerPosition(marker, location)
    {
      var latlng = new google.maps.LatLng(fb_lat, fb_long);
    //   console.log(fb_lat + "," + fb_long)
      marker.setPosition(latlng);
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
