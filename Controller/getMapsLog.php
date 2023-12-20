<?php 
header("Content-Type: application/json; charset=UTF-8");
session_start();
require './connection.php';
if( isSession("uid") && isSession("pass") )
{
$uid  = session("uid");
$pass = session("pass");
}
else
header("Location: index.php");

if( true )//isGet("imei") )
{
	//$imei = get("imei");

	//$sql = "SELECT * FROM _g_data where device='{$imei}' ORDER BY id DESC LIMIT 200";
	//$sql = "SELECT * FROM _g_data RIGHT JOIN _f_device on device=dev_id ORDER BY _g_data.id DESC LIMIT 200;";
	$sql = "SELECT name,dev_id,lat,lng,active FROM _f_device where TRUE";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		$outp = "";
		while($row = $result->fetch_assoc())
		{
			if ($outp != "") {$outp .= ",";}
			
			$outp .= '{"IMEI":"'. $row["dev_id"]. '",';
			$outp .= '"name":"'.$row["name"].'",';
			$outp .= '"lat":"'.$row["lat"].'",';
			$outp .= '"lng":"'.$row["lng"].'",';
			$outp .= '"fault":"'.$row["active"].'"}';
		}
		$outp ='{"result":['.$outp.']}';
		echo($outp);
	}
	else
	{
		$outp = '{"Time":"--","V1":"--","V2":"--","V3":"--","V4":"--","V5":"--","V6":"--","V7":"--","V8":"--","V9":"--","V10":"--","V11[2,3,4]":"--","V11[2]":"--","V11[3]":"--","V11[4]":"--","V11[5]":"--","V11[6]":"--","V11[7]":"--","V12":"--","V13":"--","V14":"--","V15":"--","V16":"--","V17":"--","V18":"--","V19":"--","V20":"--"}';
		echo '{"result":['.$outp.']}';
	}
}
?>