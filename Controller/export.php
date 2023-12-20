<?php
require './connection.php';
if(isset($_GET['project_id'])){
	$sql = "SELECT id,dev_id FROM _f_device WHERE project = '".$_GET['project_id']."'";
}
if(isset($_GET['district_id'])){
	$sql .= " AND district = '".$_GET["district_id"]."'";
}
if(isset($_GET['block_id'])){
	$sql .= " AND block = '".$_GET["block_id"]."'";
}
if(isset($_GET['panchayat_id'])){
	$sql .= " AND panchayat = '".$_GET["panchayat_id"]."'";
}
if(isset($_GET['ward_id'])){
	$sql .= " AND ward = '".$_GET["ward_id"]."'";
}

$final_result = array();
$device_result = "";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$final_result[] = $row;
	$device_result .= "'".$row["dev_id"]."',";
}

$fin_devs = substr($device_result, 0, -1);

$dataSql = "SELECT * FROM _g_data_latest WHERE device IN (".$fin_devs.")";

$dataResult = $conn->query($dataSql);

$csvData = "";

$finalDataRes = array();

echo 'IMEI'."\t".'Time and Date'."\t".'Battery Percent'."\t".'Battery Voltage'."\t".'BatteryCurrent'."\t".'Battery Power'."\t".'Solar Voltage'."\t".'Solar Current'."\t".'Solar Power'."\t".'SSL V'."\t".'SSl A'."\t".'SSL P'."\t".'Full Working Minutes'."\t".'Dim Working Minutes'."\t".'Total Working Hour'."\t".'kWh'."\t".'Total kWh'."\t".'System Status'."\n";

while ($dRow = $dataResult->fetch_assoc()){
	$finalDataRes[] = $dRow;
	$csvData=$dRow['device']."\t".$dRow["time"]."\t".$dRow["v1"]."\t".$dRow["v2"]."\t".$dRow["v3"]."\t".$dRow["v4"]."\t".$dRow["v5"]."\t".$dRow["v6"]."\t".$dRow["v7"]."\t".$dRow["v8"]."\t".$dRow["v9"]."\t".$dRow["v10"]."\t".$dRow["v11"]."\t".$dRow["v12"]."\t".$dRow["v13"]."\t".$dRow["v14"]."\t".$dRow["v15"]."\t".$dRow["v16"]."\n".$csvData;
}
date_default_timezone_set('Asia/Kolkata');
header("Content-disposition: attachment; filename=DeviceDataReport_".date('d-m-y h:i:s').".xls");
echo $csvData; exit();

?>