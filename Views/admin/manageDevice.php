<!-- Header -->
<header class="w3-container w3-text-indigo" style="padding-top:22px">
	<h5><b><i class="fa fa-microchip"></i> Manage Device</b></h5>
</header>
<div class="w3-container w3-margin-bottom">
	<button class="w3-right w3-button w3-color m8-fancy w3-margin-top" onclick="w3.show('#addDevice')">Add Device</button>
</div>

<div class="w3-container w3-margin-bottom">
	<div class="w3-animate-top w3-border w3-white w3-text-color" style="display:none;" id="addDevice">
		<div class="w3-row">
			<div class="w3-button w3-circle w3-red w3-right m8-fancy" onclick="w3.hide('#addDevice')">X</div>
			<div class="w3-color">
				<h3 style="padding-left:12px;">Add Device</h3>
				<hr>
			</div>
			<div class="w3-col s12 m6 l3" id="showProjListDevice">
				<div style="padding: 10px;">
					<label>Project:</label>
					<select class="w3-input w3-border w3-round m8-fancy" id="projectDeviceId" onchange="deviceFillItems('_b_district',this.value)">
						<option value="-1">Select Project</option>
						<option w3-repeat="project_list" value="{{id}}">{{name}}</option>
					</select>
				</div>
			</div>
			<div class="w3-col s12 m6 l3" id="showDistListDevice">
				<div style="padding: 10px;">
					<label>District:</label>
					<select class="w3-input w3-border w3-round m8-fancy" id="districtDeviceId" onchange="deviceFillItems('_c_block',this.value)">
						<option value="-1">Select District</option>
						<option w3-repeat="district_list" value="{{id}}">{{name}}</option>
					</select>
				</div>
			</div>
			<div class="w3-col s12 m6 l3" id="showBlockListDevice">
				<div style="padding: 10px;">
					<label>Block :</label>
					<select class="w3-input w3-border w3-round m8-fancy" id="blockDeviceId" onchange="deviceFillItems('_d_panchayat',this.value)">
						<option value="-1">Select Block</option>
						<option w3-repeat="block_list" value="{{id}}">{{name}}</option>
					</select>
				</div>
			</div>
			<div class="w3-col s12 m6 l3" id="showPanchListDevice">
				<div style="padding: 10px;">
					<label>Panchayat :</label>
					<select class="w3-input w3-border w3-round m8-fancy" id="panchDeviceId" onchange="deviceFillItems('_e_ward',this.value)">
						<option value="-1">Select Panchayat</option>
						<option w3-repeat="panchayat_list" value="{{id}}">{{name}}</option>
					</select>
				</div>
			</div>
			<div class="w3-col s12 m6 l3" id="showWardListDevice">
				<div style="padding: 10px;">
					<label>Ward :</label>
					<select class="w3-input w3-border w3-round m8-fancy" id="wardDeviceId" onclick="setWardId(this.value)">
						<option value="-1">Select Ward</option>
						<option w3-repeat="ward_list" value="{{id}}">{{name}}</option>
					</select>
				</div>
			</div>
			<div class="w3-col s12 m6 l3">
				<div style="padding: 10px;">
					<label>Enter Device Imei :</label>
					<input class="w3-input w3-border w3-round m8-fancy" id="enterImei" type="text">
				</div>
			</div>
			<div class="w3-col s12 m6 l3">
				<div style="padding: 10px;">
					<label>Enter Device Name :</label>
					<input class="w3-input w3-border w3-round m8-fancy" id="enterName" type="text">
				</div>
			</div>
			<div class="w3-col s12 m6 l3">
				<div style="padding: 10px;">
					<label>Luminary QR Name:</label>
					<input class="w3-input w3-border w3-round m8-fancy" id="enterLuminary" type="text">
				</div>
			</div>
			<div class="w3-col s12 m6 l3">
				<div style="padding: 10px;">
					<label>Battery QR Name:</label>
					<input class="w3-input w3-border w3-round m8-fancy" id="enterBattery" type="text">
				</div>
			</div>
			<div class="w3-col s12 m6 l3">
				<div style="padding: 10px;">
					<label>Panel QR Name:</label>
					<input class="w3-input w3-border w3-round m8-fancy" id="enterPanel" type="text">
				</div>
			</div>

			<div class="w3-col s12 m6 l3">
				<div style="padding: 10px;">
					<label>Latitude :</label>
					<input class="w3-input w3-border w3-round m8-fancy" id="enterLatitude" type="text">
				</div>
			</div>
			<div class="w3-col s12 m6 l3">
				<div style="padding: 10px;">
					<label>Longitude :</label>
					<input class="w3-input w3-border w3-round m8-fancy" id="enterLongitude" type="text">
				</div>
			</div>
			<div class="w3-col s12 m6 l3">
				<div style="padding: 10px;">
					<label>Location Remark :</label>
					<input class="w3-input w3-border w3-round m8-fancy" id="enterLocation" type="text">
				</div>
			</div>
			<div class="w3-col s12 m6 l3">
				<div style="padding: 10px;">
					<label>Updated By :</label>
					<input class="w3-input w3-border w3-round m8-fancy" id="enterAddedBy" type="text">
				</div>
			</div>
			<div class="w3-col s12 m6 l3">
				<div style="padding: 10px;">
					<label>Sim No :</label>
					<input class="w3-input w3-border w3-round m8-fancy" id="enterSimNo" type="text">
				</div>
			</div>
			<div class="w3-col s12 m6 l3">
				<div style="padding: 10px;">
					<label>Upload image :</label>
					<input class="w3-input w3-border w3-round m8-fancy" name="enterImage" id="enterImage" type="file">
				</div>
			</div>
		</div>
		<div class="w3-row" style="margin:10px">
			<button class="w3-col s12 m12 l12 w3-button w3-color w3-round m8-fancy" id="addUserBtn" onclick="addDevice()">Add Device</button>
		</div>
	</div>
</div>

<div id="message"></div>
<!-- Search box -->
<div class="w3-section w3-container">
	<form action="" class="form-inline" onsubmit="search(event)">
		<input type="text" id="searchByPoleId" name="searchByPoleId" placeholder="Search By Pole ID" class="form-control my-1 mr-sm-2 mx-1 my-1" style="width:150px;border-radius: 0;" pattern=".{0}|[a-z0-9]{3,3}\/[a-z0-9]{3,3}\/[a-z0-9]{3,3}\/[a-z0-9]{3,3}\/[0-9]{3,3}" title="Either 0 OR 19 chars pro/dis/blo/pan/war (ward no. in place of war)">
		<input type="text" id="searchByImei" name="searchByImei" placeholder="Search By IMEI" class="form-control my-1 mr-sm-2 mx-1 my-1" style="width:150px;border-radius: 0;" pattern=".{0}|[0-9]{15,15}" title="Enter 0 or 15 digits">
		<button type="submit" type="submit" class="btn btn-info mx-1 my-1" style="border-radius: 0;"><i class="fa fa-search" aria-hidden="true"></i></button>
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
		require "./admin/inactiveDev.php";
	else if ($table == '1')
		require "./admin/activeDev.php";
	else
		require "./admin/inactiveDev.php";
	?>
</div>
<script>
	// let InactiveDevices = document.getElementById("InactiveDevices");
	// let ActiveDevices = document.getElementById("ActiveDevices");
	// var id = wardId;
	deviceFillItems('_a_project', '');

	function deviceFillItems(table_name, id) {
		sw();
		w3.getHttpObject("../Controller/getParentChildList.php?branch=" + table_name + "&parent=" + id, function(result) {
			if (table_name == '_a_project') {
				var project_list = {
					'project_list': result
				};
				w3.displayObject("showProjListDevice", project_list);
				w3.id('districtDeviceId').value = -1;
				w3.id('blockDeviceId').value = -1;
				w3.id('panchDeviceId').value = -1;
				w3.id('wardDeviceId').value = -1;

			}
			if (table_name == '_b_district') {
				var district_list = {
					'district_list': result
				};
				w3.displayObject("showDistListDevice", district_list);
				w3.id('blockDeviceId').value = -1;
				w3.id('panchDeviceId').value = -1;
				w3.id('wardDeviceId').value = -1;
			}
			if (table_name == '_c_block') {
				var block_list = {
					'block_list': result
				};
				w3.displayObject("showBlockListDevice", block_list);
				w3.id('panchDeviceId').value = -1;
				w3.id('wardDeviceId').value = -1;

			}
			if (table_name == '_d_panchayat') {
				var panchayat_list = {
					'panchayat_list': result
				};
				w3.displayObject("showPanchListDevice", panchayat_list);
				w3.id('wardDeviceId').value = -1;
			}
			if (table_name == '_e_ward') {
				var ward_list = {
					'ward_list': result
				};
				w3.displayObject("showWardListDevice", ward_list);
			}
			sw();
			// console.log(project_list);
		});
	}


	function setWardId(id) {
		ward_id = id;
	}

	function addDevice() {
		// var projectId = document.getElementById("projectDeviceId").value;
		var projectId = w3.id("projectDeviceId").value;
		var districtId = w3.id("districtDeviceId").value;
		var blockId = w3.id("blockDeviceId").value;
		var panchId = w3.id("panchDeviceId").value;
		var wardId = w3.id("wardDeviceId").value;
		var enterImei = w3.id("enterImei").value;
		var enterName = w3.id("enterName").value;
		var enterAddedBy = w3.id("enterAddedBy").value;
		var enterLuminary = w3.id("enterLuminary").value;
		var enterBattery = w3.id("enterBattery").value;
		var enterPanel = w3.id("enterPanel").value;
		var enterLocation = w3.id("enterLocation").value;
		var enterLatitude = w3.id("enterLatitude").value;
		var enterLongitude = w3.id("enterLongitude").value;
		var simNo = w3.id("enterSimNo").value;
		var fileValue = w3.id("enterImage");
		var file = fileValue.files[0];

		if (projectId == "" || districtId == "" || blockId == "" || panchId == "" || wardId == "" || enterImei == "" || enterName == "" || enterAddedBy == "" || enterLuminary == "" || enterBattery == "" || enterPanel == "" || enterLocation == "" || enterLatitude == "" || enterLongitude == "" || simNo == "") {
			msg("Please fill all the fields");
			return 0;
		}

		var formData = new FormData();

		formData.append('projectId', projectId);
		formData.append('districtId', districtId);
		formData.append('blockId', blockId);
		formData.append('panchId', panchId);
		formData.append('wardId', wardId);
		formData.append('enterImei', enterImei);
		formData.append('enterName', enterName);
		formData.append('enterAddedBy', enterAddedBy);
		formData.append('enterLuminary', enterLuminary);
		formData.append('enterBattery', enterBattery);
		formData.append('enterPanel', enterPanel);
		formData.append('enterLocation', enterLocation);
		formData.append('enterLatitude', enterLatitude);
		formData.append('enterLongitude', enterLongitude);
		formData.append('simNo', simNo);
		formData.append('file', file);

		$.ajax({
			url: '../Controller/admin/addDevice.php',
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			success: function(response) {
				// console.log("status is", response);
				const parsedResponse = JSON.parse(response);
				console.log("parsed data is",parsedResponse);
				if (parsedResponse.status === "success") {
					console.log('Success');
					msg('Success');
					w3.hide('#addDevice');
				} else {
					console.log('Error: ' + parsedResponse.message);
					msg("Error");
				}
			}
		});
	}

</script>
