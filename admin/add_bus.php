<?php

include '../class/mysql_class.php';

$helper = new sql();

$query     = "SELECT * FROM routes";

$routes    =  $helper->select($query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $sql = "INSERT INTO bus (driver,route_codename,plate_number, seat_total,firebase_id) VALUES 
    ("."'".@$_POST['driver']."'".","."'".@$_POST['route_name']."'".","."'".
    @$_POST['plate_number']."'".","."'".@$_POST['seat_total'].
    "'".","."'".@$_POST['fb_id']."'".")";
    
    echo $helper->insert($sql);

}

?>

<!DOCTYPE HTML>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Admin | Add Bus </title>
    <script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
</head>

    <form method="POST" action="#" id="bus_details">
        <label>PLATE NUMBER</label>
        <br>
            <input type="text" required name="plate_number" id="plate_number"> 
        <hr>
        <label>TOTAL SEAT</label>
        <br>
            <input type="number" required name="seat_total">
        <hr>
        <label>ROUTE NAME LIST</label>
        <br><br>
        <select  name="route_name">
            <option selected disabled>Pick Routes</option>
            <!-- <option selected value="T5">TESTING5</option> -->
                <?php foreach($routes as $key): ?>
                    <option value="<?php echo $key['codename'];?>"> <?php echo $key['route_name'];?> </option>
                <?php endforeach;?>
        </select>
        <hr>
        <label>DRIVER</label>
        <br><br>
        <select  name="driver">
            <option selected disabled>Pick Driver</option>
            <option selected  value="john" >John</option>
            <option selected  value="ahmad">Ahmed</option>
            <option selected  value="marvin">Marvin</option>
            <option selected  value="gillaleo">Gillaleo</option>
        </select>
        <hr>
        <input type="hidden" name="fb_id" id="fb_id">
        <button id="generate">GENERATE ID</button>
        <input type="submit" id="submit" disabled>
    </form>

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
    const database = firebase.database()
    const ref = database.ref('location');
    var count = 0;
   
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

    function fetch()
    {
      count++;
      ref.once('value', function(data)
      {
        let objKey = Object.keys(data.val());
        for (obj in objKey)
        {
          let key = objKey[obj];
          console.log(data.val()[key].id)
          if (data.val()[key].id == $('#plate_number').val())
          {
            $('#fb_id').val(key)
                // console.log($('#fb_id').val())
          }
        }
      })
    }

    $('#generate').click(function(e){
        e.preventDefault();
        try { 

            insert(0, 0, $('#plate_number').val()) 
            fetch()
        }
        catch(err) {
            console.log(err)
            return false
        }
        finally {

            $("#submit").attr("disabled", false)
            $("#bus_details :input").not("#submit").prop('readonly', true);
        }
    }) 
    
</script>