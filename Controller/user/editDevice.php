<?php
session_start();
require '../connection.php';
if (isSession("uid") && isSession("pass")) {
    $uid  = session("uid");
    $pass = session("pass");
} else
header("Location: index.php");

$col_set = "";
if ($_POST['simNo'] != "") {
    $col_set .= "sim_no='{$_POST['simNo']}'";
}
if ($_POST['deviceName'] != "") {
    $col_set .= $col_set == "" ? "name='{$_POST['deviceName']}'" : ",name='{$_POST['deviceName']}'";
}
if ($_POST['wardNo'] != "") {
    $col_set .= $col_set == "" ? "ward='{$_POST['wardNo']}'" : ",ward='{$_POST['wardNo']}'";
}
if ($_POST['panchayatNo'] != "") {
    $col_set .= $col_set == "" ? "panchayat='{$_POST['panchayatNo']}'" : ",panchayat='{$_POST['panchayatNo']}'";
}
if ($_POST['blockNo'] != "") {
    $col_set .= $col_set == "" ? "block='{$_POST['blockNo']}'" : ",block='{$_POST['blockNo']}'";
}
if ($_POST['districtNo'] != "") {
    $col_set .= $col_set == "" ? "district='{$_POST['districtNo']}'" : ",district='{$_POST['districtNo']}'";
}
if ($_POST['luminaryQR'] != "") {
    $col_set .= $col_set == "" ? "luminary_qr='{$_POST['luminaryQR']}'" : ",luminary_qr='{$_POST['luminaryQR']}'";
}
if ($_POST['batteryQR'] != "") {
    $col_set .= $col_set == "" ? "battery_qr='{$_POST['batteryQR']}'" : ",battery_qr='{$_POST['batteryQR']}'";
}
if ($_POST['panelQR'] != "") {
    $col_set .= $col_set == "" ? "panel_qr='{$_POST['panelQR']}'" : ",panel_qr='{$_POST['panelQR']}'";
}
if ($_POST['updatedBy'] != "") {
    $col_set .= $col_set == "" ? "updated_by='{$_POST['updatedBy']}'" : ",updated_by='{$_POST['updatedBy']}'";
}
if (!empty($_FILES['device_image'])) {
    $filename = $_FILES['device_image']['name'];
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $filename = $_POST['imei'].".";
    $folder = "../../img/deviceImages/".$filename.$extension;

    if (move_uploaded_file($_FILES['device_image']['tmp_name'], $folder)) {
        echo "success ";
    } else {
        echo "failed\n";
    }

    $col_set .= $col_set == "" ? "file_path='{$folder}'" : ",updated_by='{$folder}'";
}
if ($_POST['latitude'] != "") {
    $col_set .= $col_set == "" ? "lat='{$_POST['latitude']}'" : ",lat='{$_POST['latitude']}'";
}
if ($_POST['longitude'] != "") {
    $col_set .= $col_set == "" ? "lng='{$_POST['longitude']}'" : ",lng='{$_POST['longitude']}'";
}
if ($_POST['locRemark'] != "") {
    $col_set .= $col_set == "" ? "remark='{$_POST['locRemark']}'" : ",remark='{$_POST['locRemark']}'";
}

$sql = "UPDATE _f_device SET {$col_set} WHERE dev_id='{$_POST['imei']}'";

if ($conn->query($sql) === TRUE) {
    echo "successful";
} else {
    echo "failed";
    session_unset();
    session_destroy();
    header("Location: ../Views/index.php?err");
}
