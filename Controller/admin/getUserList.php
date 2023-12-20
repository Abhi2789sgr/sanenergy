<?php 
header("Content-Type: application/json; charset=UTF-8");
session_start();
require '../../Controller/connection.php';
if( isSession("uid") && isSession("pass") )
{
$uid  = session("uid");
$pass = session("pass");
}
else
header("Location: index.php");

$sql = "SELECT branch, branch_value FROM login where uname='{$uid}' and pass='{$pass}' and type='1' and active=1";
$result = $conn->query($sql);
if ($result->num_rows > 0)
{
	$row = $result->fetch_assoc();
	
	$tree = array("_g_data", "_f_device", "_e_ward", "_d_panchayat", "_c_block", "_b_district", "_a_project");
	
	$branchID = $row["branch"];
	if($branchID>6)$branchID = 6;
	$branch = $tree[$branchID];
	$parent = $row["branch_value"];
	
	if( isGet("branch") && isGet("parent") )
	{
		$branchID = get("branch");
		$branch = $tree[$branchID];
		$parent = get("parent");
	}
	
	$lastData = "";
	if($branch == "_f_device")
	$lastData = ", dev_id";
	
	$sql = "SELECT id, name, uname, type FROM login where 1";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		$outp = "";
		while($row = $result->fetch_assoc())
		{
			if ($outp != "") {$outp .= ",";}
			
			$outp .= '{"Name":"'.$row["name"].'",';
			$outp .= '"id":"'. $row["id"]. '",';
			$outp .= '"uname":"'. $row["uname"]. '",';
			$outp .= '"Type":"'.$row["type"].'"}';
		}
		$outp ='{"result":['.$outp.']}';
		echo($outp);
	}
}
else
{
session_unset();
session_destroy();
header("Location: ../Views/index.php?err");
}
?>
