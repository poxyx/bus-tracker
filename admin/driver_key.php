<?php

include '../class/mysql_class.php';
include 'include/header.php';

$helper = new sql();

$driver         = "SELECT * FROM driver WHERE is_assign = 1";
$driver_name    = $helper->select($driver);

?>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-0 text-gray-800">Get Tracking Key</h1>
    <br>
    <div class="row">
    <div class="col-md-3"></div>
        <div class="col-md-6">
        <select  name="driver" class="driver form-control form-control-user">
              <option selected disabled>Pick Driver</option>
      
              <?php foreach($driver_name as $key): ?>
                      <option value="<?php echo $key['id'];?>"> <?php echo $key['name'];?> </option>
              <?php endforeach;?>
        </select>
          <br>
          <br>
        <div>
          <input  id="key" type="text" class="form-control form-control-user" readonly>
        </div>
        <br>
        <button class="btn btn-success" onclick="copyText()">COPY TO CLIPBOARD</button>
        </div>
    <div class="col-md-3"></div>
    </div>

  </div><!-- /.container-fluid -->

<?php include 'include/footer.php';?>

<script>

function copyText() {
  var copyText = document.getElementById("key");
  copyText.select();
  document.execCommand("copy");
  alert("Copied the key: " + copyText.value);
}

$(".driver").change(function() {

 var driver = $(this)
    .children("option:selected")
    .val();

  $.ajax({
          url: "../ajax/getKey.php",
          type: "POST",
          data: jQuery.param({
            id: driver
          }),
          contentType: "application/x-www-form-urlencoded; charset=UTF-8",
          success: function(key) {
            $('#key').val(key);
          },
          error: function() {
            console.log("error");
          }
    });

});

</script>
