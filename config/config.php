<?php 

//GOOGLE MAP API KEY

$GLOBALS['api_key'] = "AIzaSyCFqYJJV5e95myYR2wBHxwP-YiO4KnMnE4";

//FIREBASE CONFIG

$GLOBALS['firebase_config'] = '{
        apiKey: "AIzaSyCNtEKwrOSmfi_wn21WQr0WS7Yl-TK_isk",
        authDomain: "driver-tracker-5c786.firebaseapp.com",
        databaseURL: "https://driver-tracker-5c786.firebaseio.com",
        projectId: "driver-tracker-5c786",
        storageBucket: "driver-tracker-5c786.appspot.com",
        messagingSenderId: "585118258922"
    };';

// 0 - disabled
// 1 - enabled
$GLOBALS['mode_test'] = 1;


//LOCATION FOR TESTING
$GLOBALS['test_lat'] = 6.0364908;
$GLOBALS['test_lng'] = 116.1203991;

//REFRESH RATE IN MILISECONDS
$GLOBALS['refresh']  = 2000;

$GLOBALS['url']  = "http://localhost:8080/bus-tracker/admin/";