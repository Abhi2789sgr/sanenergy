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

$sql = "SELECT id FROM login where uname='{$uid}' and pass='{$pass}' and type='1' and active=1";
$result = $conn->query($sql);
if ($result->num_rows > 0)
{
	$id      = "id";
	$default = "default";
	
	if( isPost($id) && isPost($default) )
	{
		$id      = post($id);
		$default = post($default);
		
		$sql = "UPDATE _a_project SET isDefault=".$default." WHERE id='{$id}'";
		if ($conn->query($sql) === TRUE)
			echo "1";
		else
			echo "0";
	}
}
else
{
session_unset();
session_destroy();
header("Location: ../Views/index.php?err");
}
?>