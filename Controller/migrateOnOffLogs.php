<?php
require './connection.php';

$allOnOffLogsQuery = "SELECT * FROM _j_light_status ORDER BY id ASC";

$onOffRes = $conn->query($allOnOffLogsQuery);

if($onOffRes->num_rows > 0){
	while($row = $onOffRes->fetch_assoc()){
		if($row['status'] == 1 || $row['status'] == "1"){
			$insertQuery = "INSERT INTO `light_on_off` (`device_imei`,`on_status`, `on_time`) VALUES ('".$row["device"]."', 1, '".$row['created_at']."')";
			$conn->query($insertQuery);
			echo "Inserted for id ".$row['id']." <br>";
		}else if($row['status'] == 0 || $row['status'] == "0"){
			$updateQuery = "UPDATE `light_on_off` SET `off_status` = 1, `off_time` = '".$row['created_at']."' WHERE device_imei = '".$row["device"]."' ORDER BY id DESC LIMIT 1";
			$conn->query($updateQuery);
			echo "Updated for id ".$row['id']." <br>";
		}
	}
}

?>