<div class="w3-container w3-responsive">
	<table id="id01" class="w3-table-all">
		<thead>
			<tr class="w3-color">
				<th>Pole ID</th>
				<th>IMEI</th>
				<th>Battery QR</th>
				<th>Panel QR</th>
				<th>Installer</th>
				<th>Remark</th>
				<th>Action</th>
			</tr>
		</thead>
		<tr w3-repeat="result">
			<td>{{Name}}</td>
			<td>{{Dev_id}}</td>
			<td>{{BatteryQr}}</td>
			<td>{{PanelQr}}</td>
			<td>{{Installer}}</td>
			<td>{{Remark}}</td>

			<td>
				<!-- <button class="w3-button w3-teal m8-fancy" style="width:100px;" onclick="authoriseDevice('{{Dev_id}}')">Accept</button><br><br> -->
				<!-- <button class="w3-button w3-red m8-fancy" style="width:100px;margin-right:10px;margin-bottom:4px;">Delete</button> -->
				<!-- <button class="w3-button w3-color m8-fancy" style="width:100px;margin-right:10px;margin-bottom:4px;">Block IMEI</button>
				<button type="button" class="w3-button w3-blue m8-fancy" style="width:100px;" data-toggle="modal" data-target="#myModal" id="{{Dev_id}}" onclick="setImei(event)">Edit</button> -->
			</td>
		</tr>
	</table>
</div>
<br>
<br>
<center><button id="prevBtn" class="btn btn-info mx-1 my-1" onclick="goToPreviousLogs()" style="cursor:pointer;">Previous</button>
	<button id="nextBtn" class="btn btn-info mx-1 my-1" onclick="goToNextLogs()" style="cursor:pointer;">Next</button>
</center>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg" role="document">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header ">
				<h4 class="modal-title">Edit Device Details</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form id="data" enctype="multipart/form-data" onsubmit="submitForm(event)">
				<input type="text" id="imei" name="imei" style="display: none;">

				<div class="row modal-body mx-3 d-flex justify-content-center">
					<div class="md-form mb-5 col-auto" style="width:200px; ">
						<i class="fas fa-envelope prefix grey-text"></i>
						<input type="text" id="deviceName" name="deviceName" class="form-control validate" placeholder="Pole ID" pattern=".{0}|[a-z0-9]{3,3}\/[a-z0-9]{3,3}\/[a-z0-9]{3,3}\/[a-z0-9]{3,3}\/[0-9]{3,3}" title="Either 0 OR 19 chars pro/dis/blo/pan/war (ward no. in place of war)">
					</div>
					<div class="md-form mb-4 col-auto" style="width:200px;">
						<i class="fas fa-lock prefix grey-text"></i>
						<input type="text" id="simNo" name="simNo" class="form-control validate" placeholder="SIM No.">
					</div>
					<div class="md-form mb-4 col-auto" style="width:200px;">
						<i class="fas fa-lock prefix grey-text"></i>
						<input type="number" id="wardNo" name="wardNo" class="form-control validate" placeholder="Ward No.">
					</div>
				</div>

				<div class="row modal-body mx-3 d-flex justify-content-center">
					<div class="md-form mb-5 col-auto" style="width:200px; ">
						<i class="fas fa-envelope prefix grey-text"></i>
						<input type="number" id="panchayatNo" name="panchayatNo" class="form-control validate" placeholder="Panchayat No.">
					</div>
					<div class="md-form mb-4 col-auto" style="width:200px;">
						<i class="fas fa-lock prefix grey-text"></i>
						<input type="number" id="blockNo" name="blockNo" class="form-control validate" placeholder="Block No.">
					</div>
					<div class="md-form mb-4 col-auto" style="width:200px;">
						<i class="fas fa-lock prefix grey-text"></i>
						<input type="number" id="districtNo" name="districtNo" class="form-control validate" placeholder="District No.">
					</div>
				</div>

				<div class="row modal-body mx-3 d-flex justify-content-center">
					<div class="md-form mb-5 col-auto" style="width:200px; ">
						<i class="fas fa-envelope prefix grey-text"></i>
						<input type="text" id="luminaryQR" name="luminaryQR" class="form-control validate" placeholder="Luminary QR">
					</div>
					<div class="md-form mb-4 col-auto" style="width:200px;">
						<i class="fas fa-lock prefix grey-text"></i>
						<input type="text" id="batteryQR" name="batteryQR" class="form-control validate" placeholder="Battery QR">
					</div>
					<div class="md-form mb-4 col-auto" style="width:200px;">
						<i class="fas fa-lock prefix grey-text"></i>
						<input type="text" id="panelQR" name="panelQR" class="form-control validate" placeholder="Panel QR">
					</div>
				</div>

				<div class="row modal-body mx-3 d-flex justify-content-center">
					<div class="md-form mb-5 col-auto" style="width:200px; ">
						<i class="fas fa-envelope prefix grey-text"></i>
						<input type="text" id="updatedBy" name="updatedBy" class="form-control validate" placeholder="Updated By">
					</div>
					<div class="md-form mb-4 col-auto" style="width:200px;">
						<i class="fas fa-lock prefix grey-text"></i>
						<input type="text" id="latitude" name="latitude" class="form-control validate" placeholder="Latitude">
					</div>
					<div class="md-form mb-4 col-auto" style="width:200px;">
						<i class="fas fa-lock prefix grey-text"></i>
						<input type="text" id="longitude" name="longitude" class="form-control validate" placeholder="Longitude">
					</div>
				</div>

				<div class="row modal-body mx-3 d-flex justify-content-center">
					<div class="md-form mb-4 col-auto" style="width:200px;">
						<i class="fas fa-lock prefix grey-text"></i>
						<input type="text" id="locRemark" name="locRemark" class="form-control validate" placeholder="Location Remark">
					</div>
					<div class="md-form mb-4 col-auto" style="width:200px;">
						<i class="fas fa-lock prefix grey-text"></i>
						<label data-error="wrong" data-success="right" for="uploadImage">Upload Image</label>
						<input type="file" id="fileUpload" name="fileUpload" class="form-control" accept="image/png, image/jpeg">
					</div>
				</div>
				<div class="modal-footer d-flex justify-content-center">
					<button type="submit" class="btn btn-default">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="maxEle" style="display: none;">
	<?php
	$sql = "SELECT COUNT(*) as totalItem FROM _f_device WHERE active=1 AND project={$branch_value}";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo $row["totalItem"];
		}
	}
	?>
</div>
<script>
	ActiveDevices.classList.add("active");
	InactiveDevices.classList.remove("active");
	//table
	active = 1;
	var logPageNo = 0;
	var maxEle = document.getElementById("maxEle").innerHTML;
	var maxpages = 0;
	var limit = 50;
	let prevBtn = document.getElementById("prevBtn");
	let nextBtn = document.getElementById("nextBtn");

	w3.getHttpObject(`../Controller/getManageDeviceLog.php?active=${active}&project=<?php echo $branch_value;?>`, myFunction);

	function goToNextLogs() {
		console.log("next is clicked: " + logPageNo + " " + parseInt(maxEle))
		if (logPageNo < maxpages) {
			logPageNo = logPageNo + 1;
			w3.getHttpObject(`../Controller/getManageDeviceLog.php?active=${active}&pageNo= ${logPageNo}&limit=${limit}&project=<?php echo $branch_value;?>`, myFunction);
		}
	}

	function goToPreviousLogs() {
		console.log("prev is clicked: " + logPageNo + " " + parseInt(maxpages))
		if (logPageNo > 0) {
			logPageNo = logPageNo - 1;
			w3.getHttpObject(`../Controller/getManageDeviceLog.php?active=${active}&pageNo= ${logPageNo} + &limit=${limit}&project=<?php echo $branch_value;?>`, myFunction);
		}
	}

	function myFunction(myObject) {
		//console.log("myFunction : " + typeof parseInt(maxEle));
		if (logPageNo == 0) {
			maxpages = Math.floor(parseInt(maxEle) / limit);
		}
		w3.displayObject("id01", myObject);
		// console.log(myObject.result);
	}

	function authoriseDevice(imei) {
		var param = "imei=" + imei;
		ajaxForActive("../Controller/admin/authoriseDevice.php", param, 1);
	}


	function ajaxForActive(url, params, reload) {
		sw();
		if (window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.open("POST", url, true);
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4)
				if (xmlhttp.status == 200) {
					if (xmlhttp.responseText == "1") {
						msg("Success!");
						if (reload > 0){
							reload_on_close = 1;
						}
						window.location.reload();
					} else
						msg("Some error occurred. Please try again later");
					sw();
				}
			else
				sw();
		}
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", params.length);
		xmlhttp.setRequestHeader("Connection", "close");
		xmlhttp.send(params);
	}


	// Edit Device  script
	function setImei(event) {
		let imei = document.getElementById("imei");
		imei.value = event.target.id;
		// console.log(imei.value);
	}

	async function submitForm(event) {
		event.preventDefault();
		// console.log("Form is submitted")
		let imei = document.getElementById("imei");
		// console.log(imei.value);
		const formData = new FormData();
		formData.append("device_image", fileUpload.files[0]);
		formData.append("imei", imei.value);
		formData.append("deviceName", deviceName.value);
		formData.append("simNo", simNo.value);
		formData.append("wardNo", wardNo.value);
		formData.append("panchayatNo", panchayatNo.value);
		formData.append("blockNo", blockNo.value);
		formData.append("districtNo", districtNo.value);
		formData.append("luminaryQR", luminaryQR.value);
		formData.append("batteryQR", batteryQR.value);
		formData.append("panelQR", panelQR.value);
		formData.append("updatedBy", updatedBy.value);
		formData.append("latitude", latitude.value);
		formData.append("longitude", longitude.value);
		formData.append("locRemark", locRemark.value);
		// console.log(deviceName.value);
		//console.log(fileUpload.files[0]);
		await fetch('../Controller/user/editDevice.php', {
			method: "POST",
			body: formData
		});
		$('#myModal').modal('toggle');
		alert("Changes Saved");
	}

	//search scripts
	let table_btn = document.getElementById("table_btn");
	let poleId = document.getElementById("searchByPoleId");
	let imei = document.getElementById("searchByImei");

	function search(event) {
		event.preventDefault();
		console.log("GO is clicked");

		if (poleId.value) {
			console.log(poleId.value);
			w3.getHttpObject(`../Controller/getManageDeviceLog.php?active=${active}&poleId=${poleId.value}&project=<?php echo $branch_value;?>`, myFunction);
		} else if (imei.value) {
			console.log(imei.value);
			w3.getHttpObject(`../Controller/getManageDeviceLog.php?active=${active}&imei=${imei.value}&project=<?php echo $branch_value;?>`, myFunction);
		}
	}
</script>