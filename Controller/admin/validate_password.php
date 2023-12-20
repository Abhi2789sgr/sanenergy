<?php
session_start();
require '../connection.php';
if (isSession("uid") && isSession("pass")) {
	$uid  = session("uid");
	$pass = session("pass");
} else
	header("Location: index.php");
    if($_POST['password']){
   $userPassword = trim($_POST['password']);
//    echo $userPassword;

if ($userPassword == $skey_top) {
    echo 'valid';
} else {
    echo 'invalid';
}}else {
	session_unset();
	session_destroy();
	header("Location: ../Views/index.php?err");
}

?>