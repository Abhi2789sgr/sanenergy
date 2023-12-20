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

if( isGet("imei") )
{
	$imei = get("imei");

	$sql = "SELECT * FROM _g_data_latest where device='{$imei}' ORDER BY id DESC LIMIT 1";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		$outp = '{"result":[';
		$row = $result->fetch_assoc();
		if(floatval($row["v8"]) >= 9.8){
			$row["v8"] = 9.8;
		}
		$row["v10"] = floatval($row["v8"]) * floatval($row["v9"]);
		$outp .= '{"a":"<b>Battery Percentage</b>","b":""},';
		$outp .= '{"a":"'.$row["v1"].' %","b":""},';
		$outp .= '{"a":"<b>Battery Voltage</b>","b":""},';
		$outp .= '{"a":"'.$row["v2"].' V","b":""},';
		$outp .= '{"a":"<b>Battery Current</b>","b":""},';
		$outp .= '{"a":"'.$row["v3"].' Amp.","b":""},';
		$outp .= '{"a":"<b>Battery Power</b>","b":""},';
		$outp .= '{"a":"'.$row["v4"].' Wt.","b":""},';
		$outp .= '{"a":"<b>Solar Voltage</b>","b":""},';
		$outp .= '{"a":"'.$row["v5"].' V","b":""},';
		$outp .= '{"a":"<b>Solar Current</b>","b":""},';
		$outp .= '{"a":"'.$row["v6"].' Amp.","b":""},';
		$outp .= '{"a":"<b>Solar Power</b>","b":""},';
		$outp .= '{"a":"'.$row["v7"].' Wt.","b":""},';
		$outp .= '{"a":"<b>Luminary Voltage</b>","b":""},';
		$outp .= '{"a":"'.$row["v8"].' V","b":""},';
		$outp .= '{"a":"<b>Luminary Current</b>","b":""},';
		$outp .= '{"a":"'.$row["v9"].' Amp.","b":""},';
		$outp .= '{"a":"<b>Luminary Power</b>","b":""},';
		$outp .= '{"a":"'.$row["v10"].' Wt.","b":""},';
		$outp .= '{"a":"<b>System Status</b>","b":""},';
		$outp .= '{"a":" Loading...","b":"system-status"},';
		$outp .= '{"a":"<b>Battery Fault</b>","b":""},';
		$outp .= '{"a":" Loading...","b":"battery-fault"},';
		$outp .= '{"a":"<b>Module Fault</b>","b":""},';
		$outp .= '{"a":" Loading...","b":"panel-fault"},';
		$outp .= '{"a":"<b>Luminary Fault</b>","b":""},';
		$outp .= '{"a":" Loading...","b":"luminary-fault"},';
		$outp .= '{"a":"<b>Battery Fault Date</b>","b":""},';
		$outp .= '{"a":"N/A","b":"Bfault"},';
		$outp .= '{"a":"<b>Module Fault Date</b>","b":""},';
		$outp .= '{"a":"N/A","b":"Pfault"},';
		$outp .= '{"a":"<b><small>Luminary Fault Date</small></b>","b":""},';
		$outp .= '{"a":"N/A","b":"LfaultD"},';
		$outp .= '{"a":"<b><small>Luminary Fault Time</small></b>","b":""},';
		$outp .= '{"a":"N/A","b":"LfaultT"},';
		$outp .= '{"a":"<b><small>Luminary ON Time</small></b>","b":""},';
		$outp .= '{"a":"--","b":"onTime"},';
		$outp .= '{"a":"<b><small>Luminary OFF Time</small></b>","b":""},';
		$outp .= '{"a":"--","b":"offTime"},';
		$outp .= '{"a":"<b>Fault Time Date</b>","b":""},';
		$outp .= '{"a":"N/A","b":"fault"},';
		$outp .= '{"a":"<b><small>Fault Rectification Date</small></b>","b":""},';
		$outp .= '{"a":"N/A","b":"resolved"},';
		$outp .= '{"a":"<b>Brightness Level</b>","b":""},';
		$lvl = "ZERO";
		if($row["v10"]>15)
		$lvl = "FULL";
		else if($row["v10"]>10)
		$lvl = "HALF";
		$outp .= '{"a":"'.$lvl.'","b":""},';
		$outp .= '{"a":"<b><small>Full Brightness Hour</small></b>","b":""},';
		$outp .= '{"a":"'.$row["v14"].'","b":""},';
		$outp .= '{"a":"<b><small>Half Brightness Hour</small></b>","b":""},';
		$outp .= '{"a":"'.$row["v15"].'","b":""},';
		$outp .= '{"a":"<b>Harvested Energy</b>","b":""},';
		$outp .= '{"a":"'.$row["v17"].'","b":""},';
		$outp .= '{"a":"<b><small>Battery State of Charge</small></b>","b":""},';
		$outp .= '{"a":"'.$row["v1"].' %","b":""},';
		$outp .= '{"a":"<b><small>Battery Depth of disch.</small></b>","b":""},';
		if($row["v1"]=="--")
		$outp .= '{"a":"'.$row["v1"].' %","b":""}';
		else
		$outp .= '{"a":"'.(100-$row["v1"]).' %","b":""}';
		$outp .= ']}';
		echo($outp);
	}
	else
	{
		echo '{"result":[{"a":"No Data","b":""}]}';
	}
}
?>
