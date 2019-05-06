<?php

include '../class/mysql_class.php';
require 'include/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{

    $helper = new sql();

    $sql = "INSERT INTO waypoints (stop_name,stop_location) VALUES ("."'".@$_POST['waypoints_name']."'".","."'".substr(@$_POST['latlng'], 1, -1)."'".")";
    
    $helper->insert($sql);

}

?>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 600px;
        width: 100%;
      }
      /* Optional: Makes the sample page fill the window. */


    </style>

            <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-md-6">
                <div id="map"></div>
                <br>
                </div>
                <div class="col-md-6">
                <form method="POST" action="#">
                    <label>WAYPOINTS NAME</label>
                    <br>
                        <input type="text" required name="waypoints_name" required class="form-control form-control-user"> 
                    <hr>
                    <label>LOCATION ON MAP</label>
                    <br>
                        <input type="text" required name="latlng" class="form-control form-control-user" id="location">
                    <hr>
                    <button type="submit" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                              <i class="fas fa-flag"></i>
                            </span>
                            <span class="text">SUBMIT</span>   
                        </button>
                </form>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    <script>

      var _lat = "<?php echo $test_lat;?>"
      var _lng = "<?php echo $test_lng;?>"

      function initMap() {
        var origin = {lat: parseFloat(_lat), lng: parseFloat(_lng)};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: origin,
          draggableCursor:'crosshair'
        });
        var clickHandler = new ClickEventHandler(map, origin);
      }

      /**
       * @constructor
       */
      var ClickEventHandler = function(map, origin) {
        this.origin = origin;
        this.map = map;
        this.directionsService = new google.maps.DirectionsService;
        this.directionsDisplay = new google.maps.DirectionsRenderer;
        this.directionsDisplay.setMap(map);
        
        // Listen for clicks on the map.
        this.map.addListener('click', this.handleClick.bind(this));
      };

      ClickEventHandler.prototype.handleClick = function(event) {        
        $('#location').val(event.latLng);
        // If the event has a placeId, use it.
        if (event.placeId) {
          // console.log('You clicked on place:' + event.placeId);

          // Calling e.stop() on the event prevents the default info window from
          // showing.
          // If you call stop here when there is no placeId you will prevent some
          // other map click event handlers from receiving the event.
          event.stop();

        }
      };

    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $api_key;?>&callback=initMap"></script>
  </body>
</html>

<?php include 'include/footer.php';?>