<?php
header("Content-Type: application/json; charset=UTF-8");
session_start();
require './connection.php';
if (isSession("uid") && isSession("pass")) {
	$uid  = session("uid");
	$pass = session("pass");
} else {
	header("Location: index.php");
}

$offset = 0;
$limit = 50;
$search = "";
$active = 0;

if (isset($_GET['limit'])) {
	$limit = intval($_GET['limit']);
}
if (isset($_GET['pageNo'])) {
	$offset = intval($_GET['pageNo']) * $limit;
}
if (isset($_GET['active'])) {
	$active = intval($_GET['active']);
}

if (isset($_GET['poleId'])) {
	if (isset($_GET['project'])) {

		//this query is used when request is sent by admin
		$sql = "SELECT * FROM _f_device WHERE active=$active AND project ={$GET['project']} AND name='" . $_GET['poleId'] . "'";
	} else {

		//this query is used when request is sent by master
		$sql = "SELECT * FROM _f_device WHERE active=$active AND name='" . $_GET['poleId'] . "'";
	}
} else if (isset($_GET['imei'])) {
	if (isset($_GET['project'])) {

		//this query is used when request is sent by admin
		$sql = "SELECT * FROM _f_device WHERE active=$active AND project ={$GET['project']} AND dev_id='" . $_GET['imei'] . "'";
	} else {

		//this query is used when request is sent by master
		$sql = "SELECT * FROM _f_device WHERE active=$active AND dev_id='" . $_GET['imei'] . "'";
	}
} else {
	if (isset($_GET['project'])) {

		//this query is used when request is sent by admin
		$sql = "SELECT * FROM _f_device WHERE active=$active AND project={$_GET['project']} ORDER BY id  LIMIT $offset, $limit";
	} else {

		//this query is used when request is sent by master
		$sql = "SELECT * FROM _f_device WHERE active=$active ORDER BY id  LIMIT $offset, $limit";
	}
}
// echo $sql;
// exit;

if ($active) {
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$outp = "";
		while ($row = $result->fetch_assoc()) {
			if ($outp != "") {
				$outp .= ",";
			}
			$outp .= '{"ID":"' . $row["id"] . '",';
			$outp .= '"Name":"' . $row["name"] . '",';
			$outp .= '"BatteryQr":"' . $row["battery_qr"] . '",';
			$outp .= '"PanelQr":"' . $row["panel_qr"] . '",';
			$outp .= '"Installer":"' . $row["updated_by"] . '",';
			$outp .= '"Remark":"' . $row["remark"] . '",';
			$outp .= '"Dev_id":"' . $row["dev_id"] . '"}';
		}
		$outp = '{"result":[' . $outp . ']}';
		echo ($outp);
	} else {
		$outp = '{"ID":"--","Name":"--","BatteryQr":"--","PanelQr":"--","Installer":"--","Remark":"--","Dev_id":"--"}';
		echo '{"result":[' . $outp . ']}';
	}
} else {
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$outp = "";
		while ($row = $result->fetch_assoc()) {
			if ($outp != "") {
				$outp .= ",";
			}
			$sql1 = "SELECT name FROM _e_ward WHERE id={$row['ward']}";
			$result1 = $conn->query($sql1);
			while ($row1 = $result1->fetch_assoc()) {
				$row['ward'] = $row1['name'];
			}

			$sql1 = "SELECT name FROM _d_panchayat WHERE id={$row['panchayat']}";
			$result1 = $conn->query($sql1);
			while ($row1 = $result1->fetch_assoc()) {
				$row['panchayat'] = $row1['name'];
			}

			$sql1 = "SELECT name FROM _c_block WHERE id={$row['block']}";
			$result1 = $conn->query($sql1);
			while ($row1 = $result1->fetch_assoc()) {
				$row['block'] = $row1['name'];
			}

			$sql1 = "SELECT name FROM _b_district WHERE id={$row['district']}";
			$result1 = $conn->query($sql1);
			while ($row1 = $result1->fetch_assoc()) {
				$row['district'] = $row1['name'];
			}

			$outp .= '{"ID":"' . $row["id"] . '",';
			$outp .= '"Name":"' . $row["name"] . '",';
			$outp .= '"BatteryQr":"' . $row["battery_qr"] . '",';
			$outp .= '"PanelQr":"' . $row["panel_qr"] . '",';
			$outp .= '"Installer":"' . $row["updated_by"] . '",';
			$outp .= '"Ward":"' . $row["ward"] . '",';
			$outp .= '"Panchayat":"' . $row["panchayat"] . '",';
			$outp .= '"Block":"' . $row["block"] . '",';
			$outp .= '"District":"' . $row["district"] . '",';
			$outp .= '"LuminaryQr":"' . $row["luminary_qr"] . '",';
			$outp .= '"FilePath":"' . substr($row["file"] ,3). '",';
			$outp .= '"Lat":"' . $row["lat"] . '",';
			$outp .= '"Lng":"' . $row["lng"] . '",';
			$outp .= '"Remark":"' . $row["remark"] . '",';
			$outp .= '"Dev_id":"' . $row["dev_id"] . '"}';
		}
		$outp = '{"result":[' . $outp . ']}';
		echo ($outp);
	} else {
		$outp = '{"ID":"--","Name":"--","BatteryQr":"--","PanelQr":"--","Installer":"--","Ward":"--","Panchayat":"--","Block":"--","District":"--","LuminaryQr":"--","FilePath":"--","Lat":"--","Lng":"--",Remark":"--","Dev_id":"--"}';
		echo '{"result":[' . $outp . ']}';
	}
}
