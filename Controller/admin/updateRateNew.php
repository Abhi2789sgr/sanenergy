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
	$row = $result->fetch_assoc();
	
	$urate   = "urate";
	$versn   = "versn";
	
	if( isPost($urate) && isPost($versn) )
	{
		$urate   = sprintf("%03u",post($urate));
		$urate_chk = "0";
		for($i=0;$i<3;$i++)
		  $urate_chk += $urate[$i];
		$urate_chk = sprintf("%02u",$urate_chk);
		
		$versn   = sprintf("%04u",post($versn));
		$versn_chk = "0";
		for($i=0;$i<4;$i++)
		  $versn_chk += $versn[$i];
		$versn_chk = sprintf("%02u",$versn_chk);
	
		$myfile3 = fopen("getRate.php", "w+") or die("Unable to open file getRate.php!");
		fputs($myfile3, "1".$urate.$versn);
		fclose($myfile3);
		
		$ver_ur = ','.$versn.','.$versn_chk.','.$urate.','.$urate_chk;
		$sql = "UPDATE _a_project SET ver_ur='".$ver_ur."' WHERE id=0";
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