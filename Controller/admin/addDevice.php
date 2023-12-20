<?php
session_start();
require '../connection.php';
if (isSession("uid") && isSession("pass")) {
    $uid  = session("uid");
    $pass = session("pass");
} else {
    header("Location: index.php");
}

$sql = "SELECT id FROM login where uname='{$uid}' and pass='{$pass}' and type='1' and active=1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id = $row["id"];

    $tree = array("_a_project", "_b_district", "_c_block", "_d_panchayat", "_e_ward");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $projectId  = $_POST["projectId"];
        $districtId   = $_POST["districtId"];
        $blockId   = $_POST["blockId"];
        $panchId   = $_POST["panchId"];
        $wardId  = $_POST["wardId"];
        $enterImei   = $_POST["enterImei"];
        $enterName = $_POST["enterName"];
        $enterAddedBy   = $_POST["enterAddedBy"];
        $enterLuminary = $_POST["enterLuminary"];
        $enterBattery = $_POST["enterBattery"];
        $enterPanel = $_POST["enterPanel"];
        $enterLocation = $_POST["enterLocation"];
        $enterLatitude = $_POST["enterLatitude"];
        $enterLongitude = $_POST["enterLongitude"];
        $simNo = $_POST["simNo"];

        // if (isset($_FILES['file'])) {
        //     $file = $_FILES['file'];
        //     $tempFile = $file['tmp_name'];
        //     $tempName = $file['name'];
        //     $fileExtesion = explode(".", $tempName);
        //     $extName = $fileExtesion[count($fileExtesion) - 1];
        //     $targetDir = '../../upload/addDevice/' . $enterName . "." . $extName;
        //     $ImageSaveDb = 'upload/addDevice/' . $enterName . "." . $extName;
        // }
        $file = $_FILES['file'];
        $uploadDirectory = '../../upload/images/';
        if ($file['error'] === UPLOAD_ERR_OK) {
            $fileName = basename($file['name']);
            $targetDir = $uploadDirectory .$enterImei. $fileName;

            if (move_uploaded_file($file['tmp_name'], $targetDir)) {
                $sql = "INSERT INTO _f_device (parent,project,district,block,panchayat,ward,dev_id,name,updated_by,luminary_qr,battery_qr,panel_qr,remark,lat,lng,file,sim_no) VALUES('{$wardId}','{$projectId}','{$districtId}','{$blockId}','{$panchId}','{$wardId}','{$enterImei}','{$enterName}','{$enterAddedBy}','{$enterLuminary}','{$enterBattery}','{$enterPanel}','{$enterLocation}','{$enterLatitude}','{$enterLongitude}','{$targetDir}','{$simNo}')";
                if ($conn->query($sql) === TRUE) {
                    $response = ['status' => 'success', 'message' => 'Data and file uploaded successfully'];
                } else {
                    $response = ['status' => 'error', 'message' => 'File upload failed'];
                }
            } else {
                $response = ['status' => 'error', 'message' => 'File upload error'];
            }

            echo json_encode($response);
        }
    } else {
        http_response_code(400);
        echo 'Bad Request';
        session_unset();
        session_destroy();
        header("Location: ../Views/index.php?err");
    }
}
