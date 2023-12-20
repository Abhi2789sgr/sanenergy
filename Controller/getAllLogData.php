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
        $sql = "SELECT _g_data_latest.*, _f_device.name, _f_device.updated_by FROM _g_data_latest INNER JOIN _f_device ON    _f_device.dev_id=_g_data_latest.device where TRUE ORDER BY time DESC LIMIT 200";
    } else if ($_GET['filter'] == '1') {

        $sql2 = "";
        if ($_GET['project_id'] != "") {
            $sql2 = "SELECT _f_device.dev_id FROM _f_device WHERE _f_device.project = '" . $_GET['project_id'] . "'";
        }
        if ($_GET['district_id'] != "") {
            $sql2 .= " AND _f_device.district = '" . $_GET["district_id"] . "'";
        }
        if ($_GET['block_id'] != "") {
            $sql2 .= " AND _f_device.block = '" . $_GET["block_id"] . "'";
        }
        if ($_GET['panchayat_id'] != "") {
            $sql2 .= " AND _f_device.panchayat = '" . $_GET["panchayat_id"] . "'";
        }
        if ($_GET['ward_id'] != "") {
            $sql2 .= " AND _f_device.ward = '" . $_GET["ward_id"] . "'";
        }
        $sql = "SELECT _g_data_latest.*, _f_device.name, _f_device.updated_by FROM _g_data_latest INNER JOIN _f_device ON    _f_device.dev_id=_g_data_latest.device where _g_data_latest.device IN ({$sql2}) ORDER BY _g_data_latest.time DESC LIMIT 200";
    } else if ($_GET['filter'] == '2') {
        if ($_GET['project_id'] != "") {

            //for admin and user
            $sql = "SELECT _g_data_latest.*, _f_device.name, _f_device.updated_by FROM _g_data_latest INNER JOIN _f_device ON    _f_device.dev_id=_g_data_latest.device where _f_device.dev_id={$_GET['imei']} AND _f_device.project={$_GET['project_id']} ORDER BY _g_data_latest.time DESC LIMIT 200";
            // echo $sql;
            // exit;
        } else {
            //for master
            $sql = "SELECT _g_data_latest.*, _f_device.name, _f_device.updated_by FROM _g_data_latest INNER JOIN _f_device ON    _f_device.dev_id=_g_data_latest.device where _f_device.dev_id={$_GET['imei']} ORDER BY _g_data_latest.time DESC LIMIT 200";
        }
    } else if ($_GET['filter'] == '3') {
        if (isset($GET['project_id'])) {

            //for admin and user
            $sql = "SELECT _g_data_latest.*, _f_device.name, _f_device.updated_by FROM _g_data_latest INNER JOIN _f_device ON    _f_device.dev_id=_g_data_latest.device where _f_device.name='{$_GET['pole_id']}' AND _f_device.project={$_GET['project_id']} ORDER BY _g_data_latest.time DESC LIMIT 200";
        } else {

            //for master
            $sql = "SELECT _g_data_latest.*, _f_device.name, _f_device.updated_by FROM _g_data_latest INNER JOIN _f_device ON    _f_device.dev_id=_g_data_latest.device where _f_device.name='{$_GET['pole_id']}' ORDER BY _g_data_latest.time DESC LIMIT 200";
        }
    }


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $outp = array();
        while ($row = $result->fetch_assoc()) {
            $outp[] = $row;
        }
        $jsonData = json_encode($outp);
        // Send JSON response
        echo $jsonData;
        header('Content-Type: application/json');
    }else {
        echo "Error while fetching the data";
    }
}
