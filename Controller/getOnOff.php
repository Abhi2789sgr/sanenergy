<?php 
session_start();

$name		= "ON OFF REPORT";
$q			= $_GET["q"];
if ($q=="") die();

require './connection.php';
if( isSession("uid") && isSession("pass") )
{
$uid  = session("uid");
$pass = session("pass");
}
else
header("Location: index.php");

$chk=1;
$data = "";
$sql = "SELECT id FROM login where uname='{$uid}' and pass='{$pass}'";
$result = $conn->query($sql);
if ($result->num_rows > 0)
{
	$sql = "SELECT time,v11 FROM _g_data where device='{$q}' and v12 LIKE '_______1' ORDER BY id DESC";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
	{
		echo "Device ".$name.'
IMEI,="'.$q.'"

Time and Date,Status
';
		while($row = $result->fetch_assoc())
		{
		  $data=$row["time"].",".($row["v11"][7]=="1"?"ON":"OFF")."
".$data;
		}
	}
	else
	$chk = 0;
}
else
$chk = 0;

if($chk==0)
echo "<script>alert('Something Wrong');window.location.assign('index.php');</script>";
else
{
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="'.$name.'-'.$q.'.csv"');
echo $data; exit();
}

$conn->close();
?>