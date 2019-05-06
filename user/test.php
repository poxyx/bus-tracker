<?php

include '../class/mysql_class.php';

    $helper  = new sql();

    $sql     = "SELECT * FROM routes";

    $routes  = $helper->select($sql);

?>
<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>

    <nav>
        <div class="nav-wrapper blue accent-2">
        <a href="#!" class="center brand-logo"><i class="large material-icons">face</i></a>
        </div>
    </nav>
 
    <div class="row">
        <div class="col s12" style="padding:0px;margin:0px;">
            <div id="map"></div>
        </div>
    </div>
    <div class="container">
    <div class="row">
        <div class="input-field col s12">
            <select class="icons route_name">
                <option value="" disabled selected>ROUTE</option>
                <?php foreach($routes as $key): ?>
                    <option data-icon="https://image.flaticon.com/icons/png/512/143/143978.png" value="<?php echo $key['codename'];?>"> <?php echo $key['route_name'];?> </option>
                <?php endforeach;?>
            </select>
                <label>PICK ROUTE</label>
                <br>
                <ul class="collection">
                    <li class="collection-item avatar">
                    <img src="https://image.flaticon.com/icons/png/512/171/171255.png" alt="" class="circle">
                    <span class="title"><small><b>ROUTE : <span id="bus_route_name">∞</span></b></small></span>
                    <p><small><b><span id="bus_plate_no">CAMPUS BUS</span></b></small><br>
                    <small>ESTIMATED ARRIVAL : <b><span id="estimated">∞</span> MINUTES</b></small>
                    </p>
                    <!-- <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a> -->
                    </li>
                </ul>
        </div>
      </div>
    </div>

    <div class="fixed-action-btn">
        <a class="btn-floating btn-large waves-effect waves-light blue accent-2" id="nearest"><i class="material-icons">search</i></a>
    </div>
    
    <script
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
      <!--JavaScript at end of body for optimized loading-->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    </body>
  </html>

 <script>
    $( document ).ready(function() {

        var newHeight = $( window ).height();

        $("#map").height(newHeight - (newHeight / 2.2));
        $('select').formSelect();  
        $('.fixed-action-btn').floatingActionButton();
    });
    
    </script>

    <script type="text/javascript" src="https://www.gstatic.com/firebasejs/4.8.0/firebase.js"></script>
    <script>
        var config = <?php echo $firebase_config;?>
        var mode   = <?php echo $mode_test;?>
    </script>
    <script type="text/javascript" src="js/main.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?sensor=false&key=<?php echo $api_key;?>&callback=initMap"></script>