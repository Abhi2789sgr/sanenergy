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
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $updatedId = $data['id'];
        $updatedUname = $data['uname'];
        $updatedName = $data['Name'];
        $updatedEmail = $data['email'];
        $updatedpass = md5($data['pass']);
        $updatedmob1 = $data['mob1'];
        $updatedmob2 = $data['mob2'];
        $updatedType = $data['type'];
        $updatedProj = $data['proj'];
		$Updatesql = "UPDATE login SET name ='{$updatedName}', uname ='{$updatedUname}', email ='{$updatedEmail}',mob1 ='{$updatedmob1}', mob2 ='{$updatedmob2}',pass='{$updatedpass}' WHERE id = '{$updatedId}'";
		// echo $Updatesql;
        if ($conn->query($Updatesql) === TRUE){
			echo "1";
		}else{
			echo "2";
		}
	}
}
else
{
session_unset();
session_destroy();
header("Location: ../Views/index.php?err");
}
?>
