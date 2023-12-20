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
   if(isset($_GET['id']))
	$sql = "SELECT *FROM login where id = '".$_GET['id']."'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		$outp = "";
		while($row = $result->fetch_assoc())
		{
			if ($outp != "") {$outp .= ",";}
			
			$outp .= '{"Name":"'.$row["name"].'",';
			$outp .= '"uname":"'. $row["uname"]. '",';
            $outp .= '"email":"'. $row["email"]. '",';
			$outp .= '"mob1":"'. $row["mob1"]. '",';
			$outp .= '"mob2":"'. $row["mob2"]. '",';
			$outp .= '"pass":"'. $row["pass"]. '",';
			$outp .= '"branch":"'. $row["branch"]. '",';
			$outp .= '"project":"'. $row["branch_value"]. '",';
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