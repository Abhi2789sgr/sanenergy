<?php
header("Content-Type: application/json; charset=UTF-8");
session_start();
require './connection.php';
if (isSession("uid") && isSession("pass")) {
	$uid  = session("uid");
	$pass = session("pass");
} else
	header("Location: index.php");

if (true) //isGet("imei") )
{
	if ($_GET['filter'] == '0') {
		$sql = "SELECT _g_data_latest.*, _f_device.name, _f_device.updated_by FROM _g_data_latest INNER JOIN _f_device ON _f_device.dev_id=_g_data_latest.device where TRUE ORDER BY time DESC LIMIT 200";
	} else if ($_GET['filter'] == '1') {

		$sql = "";
		if ($_GET['project_id'] != "") {
			$sql = "SELECT _f_device.*, _g_data_latest.* FROM _f_device INNER JOIN _g_data_latest ON _f_device.dev_id = _g_data_latest.device  WHERE _f_device.project = '" . $_GET['project_id'] . "'";
		}
		if ($_GET['district_id'] != "") {
			$sql .= " AND _f_device.district = '" . $_GET["district_id"] . "'";
		}
		if ($_GET['block_id'] != "") {
			$sql .= " AND _f_device.block = '" . $_GET["block_id"] . "'";
		}
		if ($_GET['panchayat_id'] != "") {
			$sql .= " AND _f_device.panchayat = '" . $_GET["panchayat_id"] . "'";
		}
		if ($_GET['ward_id'] != "") {
			$sql .= " AND _f_device.ward = '" . $_GET["ward_id"] . "'";
		}
		// $sql = "SELECT _g_data_latest.*, _f_device.name, _f_device.updated_by FROM _g_data_latest INNER JOIN _f_device ON _f_device.dev_id=_g_data_latest.device where _g_data_latest.device IN ({$sql2}) ORDER BY _g_data_latest.time DESC LIMIT 200";
		$sql .= " ORDER BY _g_data_latest.time DESC LIMIT 200";
	} else if ($_GET['filter'] == '2') {
		if ($_GET['project_id'] != "") {

			//for admin and user
			$sql = "SELECT _g_data_latest.*, _f_device.name, _f_device.updated_by FROM _g_data_latest INNER JOIN _f_device ON _f_device.dev_id=_g_data_latest.device where _f_device.dev_id={$_GET['imei']} AND _f_device.project={$_GET['project_id']} ORDER BY _g_data_latest.time DESC LIMIT 200";
			// echo $sql;
			// exit;
		} else {
			//for master
			$sql = "SELECT _g_data_latest.*, _f_device.name, _f_device.updated_by FROM _g_data_latest INNER JOIN _f_device ON _f_device.dev_id=_g_data_latest.device where _f_device.dev_id={$_GET['imei']} ORDER BY _g_data_latest.time DESC LIMIT 200";
		
		}
	} else if ($_GET['filter'] == '3') {
		if (isset($GET['project_id'])) {

			//for admin and user
			$sql = "SELECT _g_data_latest.*, _f_device.name, _f_device.updated_by FROM _g_data_latest INNER JOIN _f_device ON _f_device.dev_id=_g_data_latest.device where _f_device.name='{$_GET['pole_id']}' AND _f_device.project={$_GET['project_id']} ORDER BY _g_data_latest.time DESC LIMIT 200";
		} else {

			//for master
			$sql = "SELECT _g_data_latest.*, _f_device.name, _f_device.updated_by FROM _g_data_latest INNER JOIN _f_device ON _f_device.dev_id=_g_data_latest.device where _f_device.name='{$_GET['pole_id']}' ORDER BY _g_data_latest.time DESC LIMIT 200";
		}
	}

// echo $sql;
// exit;
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$outp = "";
		while ($row = $result->fetch_assoc()) {
			if ($outp != "") {
				$outp .= ",";
			}

			$outp .= '{"Time":"' . $row["time"] . '",';
			$outp .= '"PoleID":"' . $row["name"] . '",';
			$outp .= '"Installer":"' . ucfirst($row["updated_by"]) . '",';
			$outp .= '"IMEI":"' . $row["device"] . '",';
			$outp .= '"V1":"' . $row["v1"] . '",';
			$outp .= '"V2":"' . $row["v2"] . '",';
			$outp .= '"V3":"' . $row["v3"] . '",';
			$outp .= '"V4":"' . $row["v4"] . '",';
			$outp .= '"V5":"' . $row["v5"] . '",';
			$outp .= '"V6":"' . $row["v6"] . '",';
			$outp .= '"V7":"' . $row["v7"] . '",';
			$outp .= '"V8":"' . $row["v8"] . '",';
			$outp .= '"V9":"' . $row["v9"] . '",';
			$outp .= '"V10":"' . $row["v10"] . '",';

			//$v11 = str_pad(decbin($row["v11"]), 8, 0, STR_PAD_LEFT);
			$v11 = $row["v11"];
			if (strlen($v11) != 8) $v11 = "00000000";
			$outp .= '"V11[2,3,4]":"' . ($v11[2] . $v11[3] . $v11[4] == "000" ? "green" : "red") . '",';
			$outp .= '"V11[2]":"' . ($v11[2] > 0 ? "red" : "green") . '",';
			$outp .= '"V11[3]":"' . ($v11[3] > 0 ? "red" : "green") . '",';
			$outp .= '"V11[4]":"' . ($v11[4] > 0 ? "red" : "green") . '",';
			$outp .= '"V11[5]":"' . ($v11[5] > 0 ? "fa-battery-1 w3-text-red" : "fa-battery w3-text-green") . '",';
			$outp .= '"V11[6]":"' . ($v11[6] > 0 ? "fa-moon-o w3-text-grey" : "fa-sun-o w3-text-orange") . '",';
			$outp .= '"V11[7]":"' . ($v11[7] > 0 ? "fa-lightbulb-o w3-text-orange" : "fa-lightbulb-o w3-text-grey") . '",';
			/*
			$outp .= '"V11":"'.$row["v11"].'",';
			$outp .= '"V12":"'.$row["v12"].'",';
			$outp .= '"V13":"'.$row["v13"].'",';
			*/
			$outp .= '"V14":"' . hoursandmins($row["v14"], '%02d:%02d') . '",';
			$outp .= '"V15":"' . hoursandmins($row["v15"], '%02d:%02d') . '",';
			$outp .= '"V16":"' . $row["v16"] . '",';
			$outp .= '"V17":"' . $row["v17"] . '",';
			$outp .= '"V18":"' . $row["v18"] . '"}';
		}
		$outp = '{"result":[' . $outp . ']}';
		echo ($outp);
	} else {
		$outp = '{"Time":"--","V1":"--","V2":"--","V3":"--","V4":"--","V5":"--","V6":"--","V7":"--","V8":"--","V9":"--","V10":"--","V11[2,3,4]":"--","V11[2]":"--","V11[3]":"--","V11[4]":"--","V11[5]":"--","V11[6]":"--","V11[7]":"--","V12":"--","V13":"--","V14":"--","V15":"--","V16":"--","V17":"--","V18":"--","V19":"--","V20":"--"}';
		echo '{"result":[' . $outp . ']}';
	}
}
?>
