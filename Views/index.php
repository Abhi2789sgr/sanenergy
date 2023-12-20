<?php 
session_start();
require '../Controller/connection.php';
if( isSession("type") && isSession("uid") && isSession("pass") )
header("Location: ../Controller/login.php");
?>
<!DOCTYPE html>
<html>
<title>Login | <?php echo $project_name; ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/w4.css">
<script src="../js/script.js"></script>

<!---favicon start--->
<link rel="apple-touch-icon-precomposed" href="../img/logo.png" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../img/logo.png" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../img/logo.png" />
<link rel="shortcut icon" href="../img/logo.png">
<!---favicon stop--->

<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif;}
body, html {
    height: 100%;
    color: #777;
    line-height: 1.8;
}
.bgimg-1 {
    background-attachment: fixed;
    background-position: top;
    background-repeat: no-repeat;
    background-size: cover;
    background-image: url('../img/bg.jpg');
    min-height: 100%;
}
</style>
<?php 
//background-color: #003769;//#ff9800;//
?>
<body class="bgimg-1">

<div class="w3-bar w3-top w3-large w3-card-4" style="z-index:4;background-color:#181d42;color:#181d42;">
  <img src="../img/logo.png" class="w3-bar-item w3-hide-small" style="width:70px;">
  <span class="w3-bar-item w3-hide-small" style="background-color:#f6f4ff;">&#9788; <b><?php echo $project_name; ?></b></span>
  <span class="w3-bar-item w3-hide-medium w3-hide-large" style="background-color:#f6f4ff;">&#9788; <b>SSLRMS</b></span>
  <img src="../img/line.png" style="height:48px;">
  <span class="w3-bar-item0 w3-right w3-hide-small w3-hide"><img src="../img/logo2.png" style="height:48px;"></span>
  <span class="w3-text-white w3-hide-small w3-right w3-xlarge w3-margin-right">मुख्यमंत्री ग्रामीण सोलर स्ट्रीट लाइट योजना</span>
</div>

<div class="w3-display-container" style="height:600px;margin-top:50px;">
    <div class="w3-display-middle w3-padding">
		<div class="w3-panel w3-card w3-round-xxlarge w3-text-white w3-center" style="background-color:#181d42;">
			<img src="../img/logo.png" alt="Avatar" style="min-width:150px;width:15%;" class="w3-margin-top w3-circle">
			<form class="" action="../Controller/login.php" method="POST">
				<div class="w3-section">
					<label><b>Login Type</b></label>
					<select class="w3-select w3-input w3-border w3-margin-bottom w3-round-xxlarge" name="type" required autofocus>
					  <option value="" disabled selected>Choose Login Type</option>
					  <option value="1">Master</option>
					  <option value="2">Admin</option>
					  <option value="4">User</option>
					</select>
					<label><b>User ID</b></label>
					<input class="w3-input w3-border w3-margin-bottom w3-round-xxlarge" type="text" placeholder="Enter User ID" name="uid" required>
					<label><b>Password</b></label>
					<input class="w3-input w3-border w3-margin-bottom w3-round-xxlarge" type="password" placeholder="Enter Password" name="pass" required>
					<button class="w3-btn w3-border w3-round-xxlarge w3-margin-top w3-center" style="width:300px;" type="submit">Login</button>
				</div>
			</form>
			<span class="w3-right w3-padding w3-hide">
				<a href="javascript:void(0)" class="w3-padding	" onclick="">Need Help?</a>
				<a href="javascript:void(0)" onclick="document.getElementById('login2').className='w3-hide';document.getElementById('forget').className='';document.getElementById('done').className='w3-hide';">Forgot password?</a>
			</span>
		</div>
	</div>
</div>

<?php require "./hiddenElements.php"; ?>

<script><?php if(isGet("err")) echo 'msg("Username or password missmatch");' ?></script>

</body>
</html>
