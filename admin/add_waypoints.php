<?php

include '../class/mysql_class.php';
require 'include/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{

    $helper = new sql();

    $sql = "INSERT INTO waypoints (stop_name,stop_location) VALUES ("."'".@$_POST['waypoints_name']."'".","."'".@$_POST['latlng']."'".")";
    
    $helper->insert($sql);

}

?>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-0 text-gray-800">Add Waypoints</h1>
    <br>
    <div class="row">
    <div class="col-md-3"></div>
        <div class="col-md-6">
        <form method="POST" action="#">
            <label>WAYPOINTS NAME</label>
            <br>
                <input type="text" required name="waypoints_name" required class="form-control form-control-user"> 
            <hr>
            <label>LOCATION ON MAP</label>
            <br>
                <input type="text" required name="latlng" class="form-control form-control-user">
            <hr>
            <button type="submit" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                      <i class="fas fa-flag"></i>
                    </span>
                    <span class="text">SUBMIT</span>   
                </button>
        </form>
        </div>
    <div class="col-md-3"></div>
    </div>

  </div><!-- /.container-fluid -->

    <?php include 'include/footer.php';?>