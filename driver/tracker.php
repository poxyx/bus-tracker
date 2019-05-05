<?php

include '../class/mysql_class.php';

    $helper  = new sql();

?>

<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Driver | Location Tracker </title>
    
</head>
    <body>
        <button onclick="goBack()">STOP TRACKING</button>
    </body>
</html>


<script>
function goBack() 
{
     window.history.back();
}
</script>


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

