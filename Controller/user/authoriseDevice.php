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

$sql = "SELECT id FROM login where uname='{$uid}' and pass='{$pass}' and type='2' and active=1";
$result = $conn->query($sql);
if ($result->num_rows > 0)
{
	$row = $result->fetch_assoc();
	
	// $imei   = "imei";
	
	if( $_POST['imei'])
	{
		$imei   =  $_POST['imei'];
	
		$sql = "UPDATE _f_device SET active='1' WHERE dev_id='{$imei}'";
		if ($conn->query($sql) === TRUE)
			echo "1";
		else
			echo "2";
	
	}
}
else
{
session_unset();
session_destroy();
header("Location: ../Views/index.php?err");
}
?>
