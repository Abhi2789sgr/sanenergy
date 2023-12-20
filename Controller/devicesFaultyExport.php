<?php
require './connection.php';

$sqlQuery = "SELECT _h_fault_data.* ,_f_device.* FROM _h_fault_data LEFT JOIN _f_device ON _h_fault_data.device = _f_device.dev_id WHERE panel_fault = 1 OR luminary_fault = 1 OR battery_fault = 1";
$dataResult = $conn->query($sqlQuery);

$locDataArr["project"] = array();
$locDataArr["district"] = array();
$locDataArr["block"] = array();
$locDataArr["panchayat"] = array();
$locDataArr["ward"] = array();
$devData = array();
while ($deviceRow = $dataResult->fetch_assoc()) {
	if (!in_array($deviceRow['project'], $locDataArr['project'])) {
		$locDataArr['project'][] =  $deviceRow['project'];
	}
	if (!in_array($deviceRow['district'], $locDataArr['district'])) {
		$locDataArr["district"][] = $deviceRow['district'];
	}
	if (!in_array($deviceRow['block'], $locDataArr['block'])) {
		$locDataArr["block"][] = $deviceRow['block'];
	}
	if (!in_array($deviceRow['panchayat'], $locDataArr['panchayat'])) {
		$locDataArr["panchayat"][] = $deviceRow['panchayat'];
	}
	if (!in_array($deviceRow['ward'], $locDataArr['ward'])) {
		$locDataArr["ward"][] = $deviceRow['ward'];
	}
	$devData[] = $deviceRow;
}

$projectStr = "'" . implode("','", $locDataArr['project']) . "'";
$distStr = "'" . implode("','", $locDataArr['district']) . "'";
$blockStr = "'" . implode("','", $locDataArr['block']) . "'";
$panchStr = "'" . implode("','", $locDataArr['panchayat']) . "'";
$wardStr = "'" . implode("','", $locDataArr['ward']) . "'";

$sqlProject = "SELECT * FROM _a_project WHERE id IN (" . $projectStr . ")";
$projectResult = $conn->query($sqlProject);
$projectArr = array();
if ($projectResult->num_rows > 0) {
	while ($row = $projectResult->fetch_assoc()) {
		$projectArr[$row['id']] = $row['name'];
	}
}

$sqlDist = "SELECT * FROM _b_district WHERE id IN (" . $distStr . ")";
$distResult = $conn->query($sqlDist);
$distArr = array();
if ($distResult->num_rows > 0) {
	while ($row = $distResult->fetch_assoc()) {
		$distArr[$row['id']] = $row['name'];
	}
}

$sqlBlock = "SELECT * FROM _c_block where id IN (" . $blockStr . ")";
$blockResult = $conn->query($sqlBlock);
$blockArr = array();
if ($distResult->num_rows > 0) {
	while ($row = $blockResult->fetch_assoc()) {
		$blockArr[$row['id']] = $row['name'];
	}
}

$sqlPanchayat = "SELECT * FROM _d_panchayat WHERE id IN (" . $panchStr . ")";
$panchResult = $conn->query($sqlPanchayat);
$panchArr = array();
if ($panchResult->num_rows > 0) {
	while ($row = $panchResult->fetch_assoc()) {
		$panchArr[$row['id']] = $row['name'];
	}
}

$sqlWard = "SELECT * FROM _e_ward WHERE id IN (" . $wardStr . ")";
$wardResult = $conn->query($sqlWard);
$wardArr = array();
if ($wardResult->num_rows > 0) {
	while ($row = $wardResult->fetch_assoc()) {
		$wardArr[$row['id']] = $row['name'];
	}
}

$csvData = "";

echo 'IMEI' . "\t" . 'Pole Id' . "\t" . 'Panel Fault' . "\t" . 'Panel Fault Date' . "\t" . 'Luminary Fault' . "\t" . 'Luminary Fault Date' . "\t" . 'Battery Fault' . "\t" . 'Battery Fault Date' . "\t" . 'Project Name' . "\t" . 'District' . "\t" . 'Block' . "\t" . 'Panchayat' . "\t" . 'Ward' . "\t" . 'Luminary QR' . "\t" . 'Battery QR' . "\t" . 'Panel QR' . "\t" . 'Latitude' . "\t" . 'Longitude' . "\t" . 'GoogleMap' . "\t" . 'Remark' . "\t" . 'Installed By' . "\t" . 'Date' . "\t" . 'Time' . "\t" . 'Approved Status' . "\n";

foreach ($devData as $dRow) {

	$panelFault = intval($dRow["panel_fault"]) == 1 ? "Yes" : "No";
	$panelFaultDate = $panelFault == "Yes" ? $dRow["panel_fault_reported"] : "NA";

	$luminaryFault = intval($dRow["luminary_fault"]) == 1 ? "Yes" : "No";
	$luminaryFaultDate = $luminaryFault == "Yes" ? $dRow["luminary_fault_reported"] : "NA";

	$batteryFault = intval($dRow["battery_fault"]) == 1 ? "Yes" : "No";
	$batteryFaultDate = $batteryFault == "Yes" ? $dRow["battery_fault_reported"] : "NA";

	$projeName = " ";
	if (isset($projectArr[$dRow['project']])) {
		$projeName = $projectArr[$dRow['project']];
	}
	$distName = " ";
	if (isset($distArr[$dRow['district']])) {
		$distName = $distArr[$dRow['district']];
	}
	$blockName = " ";
	if (isset($blockArr[$dRow['block']])) {
		$blockName = $blockArr[$dRow['block']];
	}
	$panchName = " ";
	if (isset($panchArr[$dRow['panchayat']])) {
		$panchName = $panchArr[$dRow['panchayat']];
	}
	$wardName = " ";
	if (isset($wardArr[$dRow['ward']])) {
		$wardName = $wardArr[$dRow['ward']];
	}

	$approvedStatus = "Pending";
	if ($dRow["active"] == "1") {
		$approvedStatus = "Approved";
	}
	$dateTimeArr = explode(" ", $dRow["time"]);
	$ucRemark = ucfirst($dRow['remark']);
	$urInstaller = ucfirst($dRow['updated_by']);
	$upperBattery = strtoupper($dRow['battery_qr']);
	if (!empty($dRow['lat']) && !empty($dRow['lng'])) {
		$googleLink = "https://www.google.com/maps/search/?api=1&query=" . $dRow["lat"] . ',' . $dRow["lng"];
	} else {
		$googleLink = "";
	}
	$googleLink = '"' . $googleLink . '"';
	if (trim($projeName) != "") {
		$csvData = $dRow['device'] . "\t" . $dRow['name'] . "\t" . $panelFault . "\t" . $panelFaultDate . "\t" . $luminaryFault . "\t" . $luminaryFaultDate . "\t" . $batteryFault . "\t" . $batteryFaultDate . "\t" . $projeName . "\t" . $distName . "\t" . $blockName . "\t" . $panchName . "\t" . $wardName . "\t" . $dRow['luminary_qr'] . "\t" . $upperBattery . "\t" . $dRow['panel_qr'] . "\t" . $dRow['lat'] . "\t" . $dRow['lng'] . "\t" . $googleLink . "\t" . $ucRemark . "\t" . $urInstaller . "\t" . $dateTimeArr[0] . "\t" . $dateTimeArr[1] . "\t" . $approvedStatus . "\n" . $csvData;
	}
}
date_default_timezone_set('Asia/Kolkata');
header("Content-disposition: attachment; filename=FaultyListReport_" . date('d-m-y h:i:s') . ".xls");
echo $csvData;
exit();
