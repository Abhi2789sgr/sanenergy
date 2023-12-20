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
				<button class="w3-button w3-red m8-fancy" style="width:100px;margin-right:10px;margin-bottom:4px;" onclick="deleteDevice('{{Dev_id}}')">Delete</button>
				<button class="w3-button w3-color m8-fancy" style="width:100px;margin-right:10px;margin-bottom:4px;">Block IMEI</button>
				<button type="button" class="w3-button w3-blue m8-fancy" style="width:100px;" data-toggle="modal" data-target="#myModal" id="{{Dev_id}}" onclick="setImei(event)">Edit</button>
			</td>
		</tr>
	</table>
</div>
<br>
<br>
<center><button id="prevBtn" class="btn btn-info mx-1 my-1" onclick="goToPreviousLogs()" style="cursor:pointer;">Previous</button>
	<button id="nextBtn" class="btn btn-info mx-1 my-1" onclick="goToNextLogs()" style="cursor:pointer;">Next</button>
</center>
<!-- delete modal -->

<div id="deleteDevice" class="w3-modal">
	<div class="w3-modal-content w3-animate-top w3-card-4" style="width:400px;height:auto;">
		<header class="w3-container w3-color">
			<span onclick="w3.hide('#deleteDevice')" class="w3-button w3-display-topright">&times;</span>
			<h2>Delete Active Device?</h2>
		</header>
		<h4 id="askQuestion" class="w3-center"></h4>
		<div class="w3-padding">
			<label class="w3-text-red">Type security Key</label>
			<input class="w3-input w3-border m8-fancy" id="passwordInput" placeholder="Security Key Here" type="text" required>
			<div class="w3-row" w3-repeat="result" style="margin-top:2vh" id="deleteDeviceButton">
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg" role="document">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header w3-color">
				<h4 class="modal-title" id="editDeviceDetails"></h4>
				<button type="button" class="close w3-red m8-fancy" data-dismiss="modal">&times;</button>
			</div>
			<input type="text" id="imei" name="imei" style="display: none;">
			<div class="row modal-body mx-3 d-flex justify-content-center">
				<div class="w3-col s12 m6 l3" id="dataDistrict">
					<div style="padding: 10px;">
						<label>District:</label>
						<select class="w3-input w3-border w3-round m8-fancy" id="districtNo" onchange="deviceFillData('_c_block',this.value,'')">
							<option value="-1">Select District</option>
							<option w3-repeat="district_list" id="districtNum" name="districtNo" value="{{id}}">{{name}}</option>
						</select>
					</div>
				</div>
				<div class="w3-col s12 m6 l3" id="dataBlock">
					<div style="padding: 10px;">
						<label>Block :</label>
						<select class="w3-input w3-border w3-round m8-fancy" id="blockNo" onchange="deviceFillData('_d_panchayat',this.value, '')">
							<option value="-1">Select Block</option>
							<option w3-repeat="block_list" id="blockNum" name="blockNo" value="{{id}}">{{name}}</option>
						</select>
					</div>
				</div>
				<div class="w3-col s12 m6 l3" id="dataPanchayat">
					<div style="padding: 10px;">
						<label>Panchayat :</label>
						<select class="w3-input w3-border w3-round m8-fancy" id="panchNo" onchange="deviceFillData('_e_ward',this.value, '')">
							<option value="-1">Select Panchayat</option>
							<option w3-repeat="panchayat_list" name="panchNo" value="{{id}}">{{name}}</option>
						</select>
					</div>
				</div>
				<div class="w3-col s12 m6 l3" id="dataWard">
					<div style="padding: 10px;">
						<label>Ward :</label>
						<select class="w3-input w3-border w3-round m8-fancy" id="wardNo" onclick="setWardId(this.value)">
							<option value="-1">Select Ward</option>
							<option w3-repeat="ward_list" id="wardNum" name="wardNo" value="{{id}}">{{name}}</option>
						</select>
					</div>
				</div>
				<div id="dData">
					<div class="w3-col s12 m6 l3" style="padding: 10px;">
						<label for="simNo">Sim-No :</label>
						<i class="fas fa-lock prefix grey-text"></i>
						<input type="text" id="simNo" name="simNo" class="form-control validate m8-fancy" />
					</div>
					<div class="w3-col s12 m6 l3" style="padding: 10px;">
						<i class="fas fa-envelope prefix grey-text"></i>
						<label for="deviceName">Pole-Id :</label>
						<input type="text" id="deviceName" name="deviceName" class="form-control validate m8-fancy" placeholder="Pole ID" pattern=".{0}|[a-z0-9]{3,3}\/[a-z0-9]{3,3}\/[a-z0-9]{3,3}\/[a-z0-9]{3,3}\/[a-z0-9]{3,3}\/[0-9]{3,3}" title="Either 0 OR 23 chars pro/dis/blo/pan/war/number (number should be of 3 digits)">
					</div>
					<div class="w3-col s12 m6 l3" style="padding: 10px;">
						<label for="luminaryQR">Luminary-QR :</label>
						<i class="fas fa-envelope prefix grey-text"></i>
						<input type="text" id="luminaryQR" name="luminaryQR" class="form-control validate m8-fancy" placeholder="Luminary QR">
					</div>
					<div class="w3-col s12 m6 l3" style="padding: 10px;">
						<label for="batteryQR">Battery-QR :</label>
						<i class="fas fa-lock prefix grey-text"></i>
						<input type="text" id="batteryQR" name="batteryQR" class="form-control validate m8-fancy" placeholder="Battery QR">
					</div>
					<div class="w3-col s12 m6 l3" style="padding: 10px;">
						<label for="panelQR">Panel-QR :</label>
						<i class="fas fa-lock prefix grey-text"></i>
						<input type="text" id="panelQR" name="panelQR" class="form-control validate m8-fancy" placeholder="Panel QR">
					</div>
					<div class="w3-col s12 m6 l3" style="padding: 10px;">
						<label for="updatedBy">Updated-By :</label>
						<i class="fas fa-envelope prefix grey-text"></i>
						<input type="text" id="updatedBy" name="updatedBy" class="form-control validate m8-fancy" placeholder="Updated By">
					</div>
					<div class="w3-col s12 m6 l3" style="padding: 10px;">
						<label for="latitude">Latitude :</label>
						<i class="fas fa-lock prefix grey-text"></i>
						<input type="text" id="latitude" name="latitude" class="form-control validate m8-fancy" placeholder="Latitude">
					</div>
					<div class="w3-col s12 m6 l3" style="padding: 10px;">
						<label for="longitude">Longitude :</label>
						<i class="fas fa-lock prefix grey-text"></i>
						<input type="text" id="longitude" name="longitude" class="form-control validate m8-fancy" placeholder="Longitude">
					</div>
					<div class="w3-col s12 m6 l3" style="padding:10px; margin-left: 39%;">
						<label for="locReamark">Remark :</label>
						<i class="fas fa-lock prefix grey-text"></i>
						<input type="text" id="locRemark" name="locRemark" class="form-control validate m8-fancy" placeholder="Location Remark">
					</div>
					<!-- <div class="w3-col s12 m6 l3" style="padding: 10px;">
						<i class="fas fa-lock prefix grey-text"></i>
						<label data-error="wrong" data-success="right" for="uploadImage">Upload Image</label>
						<input type="file" id="fileUpload" name="fileUpload" class="form-control m8-fancy" accept="image/png, image/jpeg">
					</div> -->
				</div>
			</div>
			<div class="">
				<button class="w3-col s12 m12 l12 w3-button w3-color w3-round m8-fancy" id="confirmPassword">Update</button>
				<button class="w3-col s12 m12 l12 w3-button w3-color w3-round m8-fancy" id="updateData" style="display: none;" onclick="submitForm(event)">Save</button>
			</div>
		</div>
	</div>
</div>
</div>

<div id="submitUpadate" class="w3-modal">
	<div class="w3-modal-content w3-animate-top w3-card-4" style="width:400px;height:auto;">
		<header class="w3-container w3-color">
			<span onclick="w3.hide('#submitUpadate')" class="w3-button w3-display-topright">&times;</span>
			<h2>Update Active Device?</h2>
		</header>
		<h4 id="askQuestion" class="w3-center"></h4>
		<div class="w3-padding">
			<label class="w3-text-red">Type security Key</label>
			<input class="w3-input w3-border m8-fancy" id="passwordInput" placeholder="Security Key Here" type="text" required>
			<div class="w3-row" w3-repeat="result" style="margin-top:2vh" id="updateDeviceButton">
			</div>
		</div>
	</div>
</div>

<div id="maxEle" style="display: none;">
	<?php
	$sql = "SELECT COUNT(*) as totalItem FROM _f_device WHERE active=1";
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

	w3.getHttpObject(`../Controller/getManageDeviceLog.php?active=${active}`, myFunction);

	function goToNextLogs() {
		console.log("next is clicked: " + logPageNo + " " + parseInt(maxEle))
		if (logPageNo < maxpages) {
			logPageNo = logPageNo + 1;
			w3.getHttpObject(`../Controller/getManageDeviceLog.php?active=${active}&pageNo= ${logPageNo}&limit=${limit}`, myFunction);
		}
	}

	function goToPreviousLogs() {
		console.log("prev is clicked: " + logPageNo + " " + parseInt(maxpages))
		if (logPageNo > 0) {
			logPageNo = logPageNo - 1;
			w3.getHttpObject(`../Controller/getManageDeviceLog.php?active=${active}&pageNo= ${logPageNo} + &limit=${limit}`, myFunction);
		}
	}

	function myFunction(myObject) {
		//console.log("myFunction : " + typeof parseInt(maxEle));

		if (logPageNo == 0) {
			maxpages = Math.floor(parseInt(maxEle) / limit);
		}
		w3.displayObject("id01", myObject);
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
						if (reload > 0) {
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
		imei1 = imei.value;
		var url = "../Controller/admin/editDeviceVal.php?imei=" + imei1;
		// console.log(imei1);
		const xhttp = new XMLHttpRequest();
		xhttp.onload = function() {
			if (xhttp.readyState === 4) {
				if (xhttp.status === 200) {
					var response = JSON.parse(xhttp.responseText);
					var resultArray = response.result;
					if (resultArray.length > 0) {
						var data = resultArray[0];
						w3.id('editDeviceDetails').innerHTML = "Edit Device Details " + data.dev_id;
						w3.id('imei').innerHTML = data.dev_id;
						w3.id('deviceName').value = data.name;
						w3.id('simNo').value = data.sim_no;
						w3.id('districtNo').value = data.district;
						deviceFillData('_c_block', data.district, data.block);
						deviceFillData('_d_panchayat', data.block, data.panchayat);
						deviceFillData("_e_ward", data.panchayat, data.ward)
						w3.id('luminaryQR').value = data.luminary_qr;
						w3.id('batteryQR').value = data.battery_qr;
						w3.id('panelQR').value = data.panel_qr;
						w3.id('updatedBy').value = data.updated_by;
						w3.id('latitude').value = data.lat;
						w3.id('longitude').value = data.lng;
						w3.id('locRemark').value = data.remark;
					}
				}
			}
		}
		xhttp.open("GET", url);
		xhttp.send();
	}


	deviceFillData('_b_district', '', '');

	function deviceFillData(table_name, id, tableId) {
		sw();
		w3.getHttpObject("../Controller/getTableData.php?branch=" + table_name + "&parent=" + id, function(result) {

			if (table_name == '_b_district') {
				var district_list = {
					'district_list': result
				};
				w3.displayObject("dataDistrict", district_list);
				w3.id('blockNo').value = -1;
				w3.id('panchNo').value = -1;
				w3.id('wardNo').value = -1;
			}
			if (table_name == '_c_block') {
				var block_list = {
					'block_list': result
				};
				w3.displayObject("dataBlock", block_list);
				if (tableId != '') {
					w3.id('blockNo').value = tableId;
				}
				w3.id('panchNo').value = -1;
				w3.id('wardNo').value = -1;

			}
			if (table_name == '_d_panchayat') {
				var panchayat_list = {
					'panchayat_list': result
				};
				w3.displayObject("dataPanchayat", panchayat_list);
				if (tableId != '') {
					w3.id('panchNo').value = tableId;
				}
				w3.id('wardNo').value = -1;
			}
			if (table_name == '_e_ward') {
				var ward_list = {
					'ward_list': result
				};
				w3.displayObject("dataWard", ward_list);
				if (tableId != '') {
					w3.id('wardNo').value = tableId;
				}
			}
			sw();
		});
	}


	function setWardId(id) {
		wardNo = id;
	}

	// function submitFormModal(event) {
	// 	event.preventDefault();
	// 	let imei = document.getElementById("imei");
	// 	imei = event.target.id;
	// 	imei1 = imei.value;
	// 	console.log("imei1", imei);
	// 	w3.hide("#myModal");
	// 	w3.show("#submitUpadate");
	// 	w3.id("updateDeviceButton").innerHTML = '<button class="w3-red w3-button w3-section w3-col s12 m12 l12 m8-fancy" onclick= "submitForm(' + event + ')">Update</button>';

	// }

	$(document).ready(function() {
		$('#confirmPassword').click(function() {
			const password = prompt('Enter your password:');
			if (password !== null) {
				$.ajax({
					url: '../Controller/admin/validate_password.php',
					method: 'POST',
					data: {
						'password': password
					},
					success: function(response) {
						if (response === 'valid') {
							$('#confirmPassword').hide();
							$('#updateData').show();
						} else {
							alert('Incorrect password. Access denied.');
						}
					}
				})
			}
		})
	});

	async function submitForm(event) {
		event.preventDefault();
		let imei = document.getElementById("imei");
		// console.log("imei value",imei.value);
		const formData = new FormData();
		formData.append("districtNo", districtNo.value);
		formData.append("blockNo", blockNo.value);
		formData.append("panchayatNo", panchNo.value);
		formData.append("wardNo", wardNo.value);
		// formData.append("device_image", fileUpload.files[0]);
		formData.append("imei", imei.value);
		formData.append("deviceName", deviceName.value);
		formData.append("simNo", simNo.value);
		formData.append("luminaryQR", luminaryQR.value);
		formData.append("batteryQR", batteryQR.value);
		formData.append("panelQR", panelQR.value);
		formData.append("updatedBy", updatedBy.value);
		formData.append("latitude", latitude.value);
		formData.append("longitude", longitude.value);
		formData.append("locRemark", locRemark.value);
		// console.log(deviceName.value);
		//console.log(fileUpload.files[0]);
		await fetch('../Controller/admin/editDevice.php', {
			method: "POST",
			body: formData
		});
		$('#myModal').modal('toggle');
		alert("Changes Saved");
		window.location.reload();
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
			w3.getHttpObject(`../Controller/getManageDeviceLog.php?active=${active}&poleId=${poleId.value}`, myFunction);
		} else if (imei.value) {
			console.log(imei.value);
			w3.getHttpObject(`../Controller/getManageDeviceLog.php?active=${active}&imei=${imei.value}`, myFunction);
		}
	}

	function deleteDevice(selectedImei) {
		w3.show("#deleteDevice");
		console.log(selectedImei);
		w3.id("askQuestion").innerHTML = "Are you sure you want to delete<br><b>" + selectedImei + "?</b></br>";
		w3.id("deleteDeviceButton").innerHTML = '<button class="w3-red w3-button w3-section w3-col s12 m12 l12 m8-fancy" onclick= "deleteSingleDevice(' + selectedImei + ')">Delete</button>';

	}

	function deleteSingleDevice(selectedImei) {
		sw();
		var securityKey = document.getElementById('passwordInput').value;
		var url = "../Controller/admin/deleteActiveDevice.php?imei=" + selectedImei + "&securityKey=" + securityKey;
		const xhttp = new XMLHttpRequest();
		xhttp.onload = function() {
			sw();
			if (this.responseText == "1") {
				alert("Deleted successfully");
				window.location.reload();
			} else {
				alert("Invalid request");
			}
		}
		xhttp.open("GET", url);
		xhttp.send();
	}
</script>
