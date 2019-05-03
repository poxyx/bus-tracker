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
	<title>Admin | View Waypoints </title>
</head>
<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>

<body>

<b>Route Name List</b>
<br><br>
    <select class="route_name">
    <option selected>Pick Routes</option>
        <?php foreach($routes as $key): ?>
            <option value="<?php echo $key['route_name'];?>"> <?php echo $key['route_name'];?> </option>
        <?php endforeach;?>
    </select>

    <div id="directions" style="width:200px;height:100px;float:left"></div>
    <div id="map" style="width:800px;height:500px;"></div>
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


      function insert(lat, long, id) {

          const result = ref.push({

              latitude: lat,
              longitude: long,
              id: id

          })

          // console.log(result);
      }

      function update(lat, long, id) {

          ref.update({
              "<?php echo $bus_id;?>": {

                  latitude: lat,
                  longitude: long,
                  id: id
              }
          })

          console.log("updated" + key);
      }

      function deleteData(key) {

          ref.update({
              key: null
          })

      }

      var count = 0;

      var fb_lat = 0;
      var fb_long = 0;

      function fetch() {

          count++;

          ref.once('value', function(data) {
              let objKey = Object.keys(data.val());
              for (obj in objKey) {
                  let key = objKey[obj];

                  if (key == bus_id) {

                      fb_lat = data.val()[key].latitude;
                      fb_long = data.val()[key].longitude

                  }
              }
          })
      }

    
      window.setInterval(function() {

          fetch()

      }, 2000);

      var counter = -1

      function initMap() {

          var myLatlng = new google.maps.LatLng(6.0401551, 116.1270994);
          var endLatlng = new google.maps.LatLng(6.037920, 116.125129);
          var directionsDisplay = new google.maps.DirectionsRenderer();
          var directionsService = new google.maps.DirectionsService();
          var bounds = new google.maps.LatLngBounds;
          var geocoder = new google.maps.Geocoder;

          var mapOptions = {
              zoom: 15,
              center: myLatlng
          }

          //FETCH THIS FROM ROUTES [ ROUTES ARRAY] FILTER BY ROUTE NAME

          var waypts = [
                {location:'6.0364908,116.1203991',stopover:true},
                {location:'6.033250,116.118115',stopover:true},
                {location:'6.032428,116.115643',stopover:true},
                {location:'6.033450,116.113050',stopover:true},
                {location:'6.035582,116.113230',stopover:true}
            ]

        //  console.log(waypts)

          calculateAndDisplayRoute(directionsService, directionsDisplay);

          function calculateAndDisplayRoute(directionsService, directionsDisplay,way_array = []) {

            directionsService.route({
                origin: "6.0364908,116.1203991",        //FETCH THIS FROM DB ROUTES[ROUTE_START]
                destination: "6.035582,116.113230",     //FETCH THIS FROM DB ROUTES[ROUTE_END]
                waypoints: way_array,
                optimizeWaypoints: true,
                travelMode: 'DRIVING'
                }, function(response, status) {
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);                   
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
          }

          var service = new google.maps.DistanceMatrixService;

          function getEstimatedArrival(start, end) {

              service.getDistanceMatrix({
                  origins: [start],
                  destinations: [end],
                  travelMode: 'WALKING',
                  unitSystem: google.maps.UnitSystem.METRIC,
                  avoidHighways: false,
                  avoidTolls: false
              }, function(response, status) {
                  if (status !== 'OK') {
                      console.log('Error was: ' + status);
                  }
                  else {

                      var originList = response.originAddresses;
                      var estimated = '';

                      for (var i = 0; i < originList.length; i++) {
                          var results = response.rows[i].elements;

                          for (var j = 0; j < results.length; j++) {
                              estimated = results[j].duration.text;
                          }
                      }

                      console.log("Estimated arrival time : " + estimated);
                  }

              });

          }

          var map = new google.maps.Map(document.getElementById("map"), mapOptions);

          directionsDisplay.setMap(map);

          var start = '6.0401551,116.1270994';
          var end   = '6.037920,116.125129';

          var marker = new google.maps.Marker({
              position: myLatlng,
              icon: '../bus_color.PNG'
          });

          marker.setMap(map);

          window.setInterval(function() {

              marker.setMap(map);

          }, 1000);


          window.setInterval(function() {

              marker.setMap(null);

              if (counter <= location.length) {

                  counter = counter + 1;
              }

              changeMarkerPosition(marker, location)
              //getEstimatedArrival(fb_lat + "," + fb_long, "6.051005,116.128783")

          }, 3000);

          $("select.route_name").on('change', function() {
            $.ajax({
                url: '../ajax/pickRoute.php',
                type: 'POST',
                data: jQuery.param({ route_name: this.value}) ,
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                success: function (json_data) {
                    
                    var result = [];
                    var json_data = JSON.parse(json_data);

                    for (var i = 0; i < json_data.length; i++) {
                    result.push({
                        location: json_data[i],
                        stopover: true
                    });      
                    
                }

                    console.log(result);
                    calculateAndDisplayRoute(directionsService, directionsDisplay,result)
                },
                error: function () {
                    console.log("error");
                }
            });     
      });

      }

      function changeMarkerPosition(marker, location) {

          var latlng = new google.maps.LatLng(fb_lat, fb_long);

          console.log(fb_lat + "," + fb_long)

          marker.setPosition(latlng);
      }



    </script>
   <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFqYJJV5e95myYR2wBHxwP-YiO4KnMnE4&callback=initMap"></script>

</body>

</html>
