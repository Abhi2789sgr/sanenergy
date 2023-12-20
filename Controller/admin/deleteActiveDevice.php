<?php
session_start();
require '../connection.php';
if (isSession("uid") && isSession("pass")) {
	$uid  = session("uid");
	$pass = session("pass");
} else
	header("Location: index.php");
$sql = "SELECT id FROM login where uname='{$uid}' and pass='{$pass}' and type='1' and active=1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	if (isset($_GET["securityKey"])) {
		$receivedPassword = $_GET["securityKey"];
		if ($receivedPassword == $skey_top) {
			if (isset($_GET['imei'])) {
				$delQuery = "DELETE from _f_device WHERE dev_id = '".$_POST['imei']."' ";
				if ($conn->query($delQuery) === TRUE) {
				}
			}
			echo "1";
		} else {
			echo "2";
		}
	}
} else {
	session_unset();
	session_destroy();
	header("Location: ../Views/index.php?err");
}
