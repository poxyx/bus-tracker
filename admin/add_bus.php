<?php

include '../class/mysql_class.php';
require 'include/header.php';

$helper = new sql();

$id = "'".@$_POST['driver']."'";

$query          = "SELECT * FROM routes";
$driver         = "SELECT * FROM driver WHERE is_assign = 0";
$assign         = "UPDATE driver set is_assign = 1 WHERE id = $id";

$routes         = $helper->select($query);
$driver_name    = $helper->select($driver);

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $sql = "INSERT INTO bus (driver,route_codename,plate_number, seat_total,firebase_id) VALUES 
    ("."'".@$_POST['driver']."'".","."'".@$_POST['route_name']."'".","."'".
    @$_POST['plate_number']."'".","."'".@$_POST['seat_total'].
    "'".","."'".@$_POST['fb_id']."'".")";
    
     $helper->insert($sql);
     $helper->update($assign);

}

?>      

        <!-- Begin Page Content -->
    <div class="container-fluid">
    <h1 class="h3 mb-0 text-gray-800">Add Bus</h1>
<br>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
            <form method="POST" action="#" id="bus_details">
                <label>PLATE NUMBER</label>
                <br>
                    <input type="text" required name="plate_number" id="plate_number" class="form-control form-control-user"> 
                <hr>
                <label>TOTAL SEAT</label>
                <br>
                    <input type="number" required name="seat_total" class="form-control form-control-user">
                <hr>
                <label>ROUTE NAME LIST</label>
                <br><br>
                <select  name="route_name" class="form-control form-control-user">
                    <option selected disabled>Pick Routes</option>
                    <!-- <option selected value="T5">TESTING5</option> -->
                        <?php foreach($routes as $key): ?>
                            <option value="<?php echo $key['codename'];?>"> <?php echo $key['route_name'];?> </option>
                        <?php endforeach;?>
                </select>
                <hr>
                <label>DRIVER</label>
                <br><br>
                <select  name="driver" class="form-control form-control-user">
                    <option selected disabled>Pick Driver</option>
            
                    <?php foreach($driver_name as $key): ?>
                            <option value="<?php echo $key['id'];?>"> <?php echo $key['name'];?> </option>
                    <?php endforeach;?>
                </select>
                <hr>
                <input type="hidden" name="fb_id" id="fb_id" >
                <button id="generate" class="btn btn-success btn-icon-split">                    
                    <span class="icon text-white-50">
                      <i class="fas fa-flag"></i>
                    </span>
                    <span class="text">GENERATE ID</span>
                </button>
                <button type="submit" class="btn btn-success btn-icon-split" id="submit" disabled>
                <span class="icon text-white-50">
                      <i class="fas fa-flag"></i>
                    </span>
                    <span class="text">SUBMIT</span>   
                </button>
            </form>   
            </div>
            <div class="col-md-3"></div>
        </div>
   <br><br>
    </div>
    <!-- /.container-fluid -->

    <script type="text/javascript" src="https://www.gstatic.com/firebasejs/4.8.0/firebase.js"></script>
        <script>

            // Initialize Firebase
            var config = <?php echo $firebase_config;?>

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
        
<?php require 'include/footer.php';?>



