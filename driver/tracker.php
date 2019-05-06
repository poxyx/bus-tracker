<?php

session_start();

include '../class/mysql_class.php';
include 'include/header.php';

/**
 * Check if the user is logged in.
 */
if(!isset($_SESSION['user_key']) || !isset($_SESSION['logged_in'])){
    //User not logged in. Redirect them back to the login.php page.
    header('Location: login.php');
    exit;
}


?>

    <div class="container">
    <br><br>
        <div class="row">

            <div class="center input-field col s12">
            <br><br>
            <a class="btn-floating btn-large pulse green accent-3" href="#">
                <i class="material-icons">navigation</i></a>
            </div>
            <div class="center input-field col s12">         
            <br><br><br>
                <a href="logout.php" class="btn btn-large blue accent-2">STOP TRACKING</a>
            </div>
        </div>
        
    </div>

    </body>
</html>


<script type="text/javascript" src="https://www.gstatic.com/firebasejs/4.8.0/firebase.js"></script>
<script>
// Initialize Firebase
var config = <?php echo $firebase_config;?>
var mode   = <?php echo $mode_test;?>

firebase.initializeApp(config);

const database  = firebase.database()
const ref       = database.ref('location');
const refresh   = <?php echo  $refresh;?>;
const bus_id    = <?php echo  "'".$_GET['key']."'";?>  

function showPosition(position) {

var lat  =  position.coords.latitude;
var long =  position.coords.longitude;

    update(lat.toFixed(7),long.toFixed(7), <?php echo  "'".$_GET['plate']."'";?>)
}

function update(lat, long, id) {

    ref.update({
        "<?php echo $_GET['key'];?>": {

            latitude: lat,
            longitude: long,
            id: id
        }
    })

    console.log("Location updated");
}

if(mode) {

        var _lat    = <?php echo $test_lat;?>     //simulation
        var _long   = <?php echo $test_lng;?>   //simulation

        window.setInterval(function() {

            _lat    = _lat + 0.00010    //simulation
            _long   = _long + 0.00010   //simulation

            update(_lat.toFixed(7), _long.toFixed(7), <?php echo  "'".$_GET['plate']."'";?>)

        }, refresh);

} else {


        window.setInterval(function() {

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else { 
            alert("Geolocation is not supported by this browser.");
        }

        }, refresh);

}

</script>

