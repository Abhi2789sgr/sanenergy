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
   if(isset($_GET['imei']))
	$sql = "SELECT * FROM _f_device where dev_id = '".$_GET['imei']."'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		$outp = "";
		while($row = $result->fetch_assoc())
		{
			if ($outp != "") {$outp .= ",";}
			
			$outp .= '{"dev_id":"'.$row["dev_id"].'",';
			$outp .= '"name":"'. $row["name"]. '",';
            $outp .= '"parent":"'. $row["parent"]. '",';
			$outp .= '"ward":"'. $row["ward"]. '",';
			$outp .= '"panchayat":"'. $row["panchayat"]. '",';
			$outp .= '"block":"'. $row["block"]. '",';
			$outp .= '"district":"'. $row["district"]. '",';
			$outp .= '"project":"'. $row["project"]. '",';
			$outp .= '"luminary_qr":"'.$row["luminary_qr"].'",';
			$outp .= '"battery_qr":"'.$row["battery_qr"].'",';
			$outp .= '"panel_qr":"'.$row["panel_qr"].'",';
			$outp .= '"lat":"'.$row["lat"].'",';
			$outp .= '"lng":"'.$row["lng"].'",';
			$outp .= '"remark":"'.$row["remark"].'",';
			$outp .= '"updated_by":"'.$row["updated_by"].'",';
			$outp .= '"sim_no":"'.$row["sim_no"].'"}';
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