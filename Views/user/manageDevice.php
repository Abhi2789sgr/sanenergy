<!-- Header -->
<header class="w3-container w3-text-indigo" style="padding-top:22px">
	<h5><b><i class="fa fa-microchip"></i> Manage Device</b></h5>
</header>

<!-- Search box -->
<div class="w3-section w3-container">
	<form action="" class="form-inline" onsubmit="search(event)">
		<input type="text" id="searchByPoleId" name="searchByPoleId" placeholder="Search By Pole ID" class="form-control my-1 mr-sm-2 mx-1 my-1"style="width:150px;border-radius: 0;"  pattern=".{0}|[a-z0-9]{3,3}\/[a-z0-9]{3,3}\/[a-z0-9]{3,3}\/[a-z0-9]{3,3}\/[0-9]{3,3}" title="Either 0 OR 19 chars pro/dis/blo/pan/war (ward no. in place of war)">
		<input type="text" id="searchByImei" name="searchByImei" placeholder="Search By IMEI" class="form-control my-1 mr-sm-2 mx-1 my-1"style="width:150px;border-radius: 0;"  pattern=".{0}|[0-9]{15,15}" title="Enter 0 or 15 digits">
		<button type="submit" type="submit" class="btn btn-info mx-1 my-1" style="border-radius: 0;" ><i class="fa fa-search" aria-hidden="true"></i></button>
	</form>
</div>

<!-- tabs -->
<nav class="navbar">
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link" aria-current="page" href="?item=4&table=0" id="InactiveDevices">Inactive Devices</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="?item=4&table=1" id="ActiveDevices">Active Devices</a>
		</li>
	</ul>
</nav>
<!-- page content -->
<div>
	<?php
	$table = get("table");
	if ($table == '0')
		require "./user/inactiveDev.php";
	else if ($table == '1')
		require "./user/activeDev.php";
	else
		require "./user/inactiveDev.php";
	?>
</div>
<script>
	// let InactiveDevices = document.getElementById("InactiveDevices");
	// let ActiveDevices = document.getElementById("ActiveDevices");
</script>