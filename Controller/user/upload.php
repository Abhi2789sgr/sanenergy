<?php
session_start();
require '../connection.php';
if( isSession("uid") && isSession("pass") )
{
$uid  = session("uid");
$pass = session("pass");
}
else
header("Location: index.php");

$uploadOk = 1;
$target_dir = "../../upload/";
$ftp_conn = ftp_connect("127.0.0.1") or die("Could not connect to server");
$login = ftp_login($ftp_conn, "ftp23", "Dex1599@tP");

$id = "";
$sql = "SELECT id FROM _a_project where id=(SELECT branch_value FROM login WHERE uname='".$uid."')";
$result = $conn->query($sql);
if ($result->num_rows > 0)
$id = $result->fetch_assoc()["id"];
$id = "4".str_pad($id, 3, '0', STR_PAD_LEFT);
	
ftp_mkdir($ftp_conn, $id);
ftp_chdir($ftp_conn, $id);
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
/*$myfile = fopen("getRate.php", "r") or die("Unable to open file!");
$target_file = $target_dir . substr(fgets($myfile),4) . ".bin";
fclose($myfile);*/

if(isset($_POST["version"]) && strlen($_POST["version"])==4)
  $target_file = $target_dir . $_POST["version"] . ".bin";
else
  $uploadOk = 0;

// Check if file already exists
if (file_exists($target_file)) {
  echo "Same firmware version already exist.\n";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 200000) {
  echo "Sorry, your file is too large.\n";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "bin") {
  echo "Sorry, only BIN files are allowed.\n";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  //echo "Sorry, your file was not uploaded.";
  echo "$$0";
// if everything is ok, try to upload file
} else {

  move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
  //if (ftp_put($ftp_conn, $_POST["version"] . ".bin", $target_file, FTP_ASCII)) {
  if (ftp_put($ftp_conn, "FOTA1.bin", $target_file, FTP_ASCII)) {
	unlink($target_file);
	echo "$$1";
  } else {
	echo "Something missing$$0";
  }
}
?>