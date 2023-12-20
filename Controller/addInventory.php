<?php 
session_start();

$q = $_POST["imei"];
if ($q=="") die();

require './connection.php';
if( isSession("uid") && isSession("pass") ){
	$uid  = session("uid");
	$pass = session("pass");
} else {
	header("Location: index.php");
}
$sql = "SELECT id FROM login where uname='{$uid}' and pass='{$pass}'";
$result = $conn->query($sql);
if ($result->num_rows > 0){
	$q = explode(",", $q);

	for($i = 0; $i < count($q); $i++){
		if(strlen(trim($q[$i])) == 15){
			$sqlCheckinventory = "SELECT id FROM _i_inventory WHERE device_imei = '".trim($q[$i])."'";
			$resultInventory = $conn->query($sqlCheckinventory);
			if($resultInventory->num_rows == 0){
				$sqlCheckDevice ="SELECT id FROM _f_device WHERE dev_id = '".trim($q[$i])."'";
				$resultDevice = $conn->query($sqlCheckDevice);
				if($resultDevice->num_rows == 0){
					$sql = "INSERT INTO _i_inventory (id, device_imei) VALUES (NULL, '".trim($q[$i])."')";
					$conn->query($sql);
				}
			}
		}
	}
	echo "1";	
	$conn->close();
} else {
	header("Location: index.php");
}
?>
