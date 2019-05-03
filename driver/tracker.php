<!--

AFTER DRIVER LOGIN
GET DRIVER BUS PLATE FROM DATABASE

GET COLLECTION KEY FROM FIREBASE
USING BUS PLATE NUMBER

-->


<?php

include '../class/mysql_class.php';

    $helper  = new sql();

    // $sql     = "SELECT * FROM routes";

    // $routes  = $helper->select($sql);

    $bus_id = "-LdqVbSsr3mLpLYnZTpH";

?>

<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Driver | Location Tracker </title>
    
</head>
    <body>
    </body>
</html>


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

const database  = firebase.database()
const ref       = database.ref('location');

const refresh   = 3000;

const bus_id    = "-LdqVbSsr3mLpLYnZTpH"  //FETCH THIS FROM FIREBASE WHERE ID = DRIVER PLATE
const plate     = "SAB7894"               //FETCH FROM DATABASE

function showPosition(position) {

var lat  =  position.coords.latitude;
var long =  position.coords.longitude;

    update(lat.toFixed(7),long.toFixed(7), plate)
}

function update(lat, long, id) {

    ref.update({
        "<?php echo $bus_id;?>": {

            latitude: lat,
            longitude: long,
            id: id
        }
    })

    console.log("Location updated");
}

var _lat    = 6.0401551     //simulation
var _long   = 116.1203991   //simulation

window.setInterval(function() {

    _lat    = _lat + 0.00020    //simulation
    _long   = _long + 0.00020   //simulation

    update(_lat.toFixed(7), _long.toFixed(7), plate)

}, refresh);

/*
window.setInterval(function() {

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
} else { 
    alert("Geolocation is not supported by this browser.");
}

}, refresh);
*/

</script>

