<?php

include '../class/mysql_class.php';
include 'include/header.php';

$helper = new sql();

$driver_name = "'".@$_POST['driver']."'";

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $sql = "INSERT INTO  driver (name) VALUES ($driver_name)";
    
    $helper->insert($sql);

}

?>
  <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-0 text-gray-800">Add Driver</h1>
    <br>
    <div class="row">
    <div class="col-md-3"></div>
        <div class="col-md-6">
          <form action="#" method="post">
          <label>DRIVER</label><br>
          <input class="form-control form-control-user" id="driver" name="driver" required="" type="text">
          <br>
          <button class="btn btn-success btn-icon-split" type="submit"><span class="icon text-white-50"><i class="fas fa-check"></i></span> <span class="text">Submit</span></button>
          </form>
        </div>
    <div class="col-md-3"></div>
    </div>

  </div><!-- /.container-fluid -->

<?php include 'include/footer.php';?>


