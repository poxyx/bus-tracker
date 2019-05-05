
<?php

include '../class/mysql_class.php';
require 'include/header.php';

    $helper = new sql();

    $points = "SELECT * FROM waypoints";

    $point = $helper->select($points);

?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="row">
              <div class="col-md-9"> 

                <div id="map"></div>
        
              </div>
              <div class="col-md-3">    
               
                
    <b>Start:</b>
    <select  id="start" class="start form-control form-control-user">
    <option selected>Starting Location</option>
      <?php foreach($point as $key): ?>
            <option value="<?php echo $key['stop_location'];?>"> <?php echo $key['stop_name'];?> </option>
        <?php endforeach;?>
    </select>
    <br>


    <b>Waypoints:</b> <br>
    <select multiple id="waypoints" class="form-control form-control-user">
        <?php foreach($point as $key): ?>
            <option value="<?php echo $key['stop_location'];?>"> <?php echo $key['stop_name'];?> </option>
        <?php endforeach;?>
    </select>
    <br>

    <b>End:</b>
    <select id="end" class="end form-control form-control-user">
    <option selected>Ending Location</option>
        <?php foreach($point as $key): ?>
            <option value="<?php echo $key['stop_location'];?>"> <?php echo $key['stop_name'];?> </option>
        <?php endforeach;?>
    </select>
    <br>
    <b>Route Name</b><br>
        <input type="text" id="route_name" name="route_name" style="width:100%" class="form-control form-control-user">
    <br>
    <b>Route Codename</b><br>
        <input type="text" id="route_codename" name="route_name" style="width:100%" class="form-control form-control-user">
    <br>

      <button class="btn btn-success" id="preview">
        Preview Route
      </button>
      <button class="btn btn-success" id="clear">
        Clear Route
      </button>
      <hr>
      <button class="btn btn-success" id="submit">
        Create Route
      </button>

    </div>
    <div id="directions-panel" style="display:none"></div>
    </div>

              </div>
          </div>
        
        </div>
        <!-- /.container-fluid -->


    <link rel="stylesheet" type="text/css" href="css/main.css"> 

   
 

   <script>
     
     var __lat = "<?php echo $test_lat;?>";
     var __lng = "<?php echo $test_lng;?>";

   </script>
   <script type="text/javascript" src="js/waypoints.js"></script>
   <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $api_key;?>&callback=initMap"></script>
  </body>
</html>

<?php require 'include/footer.php';?>