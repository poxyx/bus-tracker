<?php

include '../class/mysql_class.php';

    $helper = new sql();

    $sql = "SELECT * FROM bus";

    $bus = $helper->select($sql);

?>

<!DOCTYPE HTML>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Admin | Add Route </title>
</head>

<body>


<label>BUS LIST</label><br>
<select>

<?php foreach($bus as $key): ?>

    <option value="<?php echo $key['plate_number'];?>"> <?php echo $key['plate_number'];?> </option>

<?php endforeach;?>

</select>

</body>

</html>

