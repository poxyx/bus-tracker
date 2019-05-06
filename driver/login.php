
<?php

session_start();

include '../class/mysql_class.php';
include 'include/header.php';

    $helper  = new sql();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
         $driver_id =  @$_POST['driver_id'];
         $sql  = "SELECT * FROM bus WHERE firebase_id = '$driver_id'";

         foreach($helper->select($sql) as $key => $val) {

            $plate_number = $val['plate_number'];

            if ($val['firebase_id'] == $driver_id) {

                $_SESSION['user_key'] = $plate_number;
                $_SESSION['logged_in'] = time();

                header("Location: http://localhost:8080/bus-tracker/driver/tracker.php?key=$driver_id&plate=$plate_number");
            }
         }
    }


?>

    <div class="container">
        <div class="row">

    <br><br>
    <form method="POST" action="#">

        <div class="input-field col s12">
        <br>
          <input placeholder="example : -Le5bm9bdpN20YJAjw-T" name="driver_id" id="driver_id" type="text" class="validate">
          <label for="first_name"><b>DRIVER ID</b></label>
        </div>
        <br>

        <div class="center input-field col s12">
        <br>
        <button class="btn waves-effect waves-light blue accent-2" type="submit" name="action">START TRACKING
            <i class="material-icons right">send</i>
        </button>
        </div>

      </form>

        </div>
      </div>

<?php include 'include/footer.php';?>
        



