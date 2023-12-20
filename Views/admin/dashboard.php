<style>
	.tableFixHead thead th {
		position: sticky;
		top: 0;
	}

	th {
		background: #107090 !important;
	}

	.strikethrough {
		position: relative;
	}

	.strikethrough:before {
		position: absolute;
		content: "";
		left: 0;
		top: 29%;
		right: 0;
		border-top: 1px solid;
		border-color: inherit;

		-webkit-transform: rotate(323deg);
		-moz-transform: rotate(323deg);
		-ms-transform: rotate(323deg);
		-o-transform: rotate(323deg);
		transform: rotate(323deg);
		padding: 11px 13px 0px 5px;
		color: red;
	}

	.w3-animate-zoom-x {
		animation: animatezoom 2s infinite linear
	}

	@keyframes animatezoom {
		from {
			transform: scale(0)
		}

		to {
			transform: scale(1)
		}
	}
</style>
<!-- Header -->
<header class="w3-container w3-text-indigo" style="padding-top:22px">
	<h5><b><i class="fa fa-dashboard"></i> Dashboard</b></h5>
</header>

<div class="w3-row-padding w3-margin-bottom">
	<div class="w3-quarter">
		<div class="w3-container w3-blue w3-padding-16 m8-fancy">
			<div class="w3-left"><i class="fa fa-lightbulb-o w3-xxxlarge"></i></div>
			<div class="w3-right">
				<h3>
					<?php
					$all = 0;
					$faulty = 0;
					$healthy = 0;
					$offline = 0;
					$device_arr = array();
					$sql = "SELECT dev_id FROM _f_device where active=1";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							$device_arr[] = $row["dev_id"];
						}

						$userDevices = implode("','", $device_arr);
						$userDevices = "'".$userDevices."'";

						$latestDataQuery = "SELECT * FROM _h_fault_data WHERE device IN (".$userDevices.") AND (panel_fault = 1 OR luminary_fault = 1 OR battery_fault = 1)";
						$resultData = $conn->query($latestDataQuery);
						$faulty = $resultData->num_rows;
						echo $all = $result->num_rows;
						$healthy = $all - $faulty;
					} else {
						echo $all = 0;
						$healthy = $faulty = $all;
					}
					?>
				</h3>
			</div>
			<div class="w3-clear"></div>
			<h4>Total Lights</h4>
		</div>
	</div>
	<div class="w3-quarter">
		<div class="w3-container w3-teal w3-padding-16 m8-fancy">
			<div class="w3-left"><i class="fa fa-lightbulb-o w3-xxxlarge"></i></div>
			<div class="w3-right">
				<h3><?php echo $healthy; ?></h3>
			</div>
			<div class="w3-clear"></div>
			<h4>Healthy Lights</h4>
		</div>
	</div>

	<div class="w3-quarter w3-button" onclick="window.location.assign('?item=7')">
		<div class="w3-container w3-red w3-padding-16 w3-hover-amber m8-fancy">
			<div class="w3-left"><i class="fa fa-lightbulb-o w3-xxxlarge"></i></div>
			<div class="w3-right">
				<h3><?php echo $faulty; ?></h3>
			</div>
			<div class="w3-clear"></div>
			<h4>Faulty</h4>
		</div>
	</div>
	<div class="w3-quarter">
		<div class="w3-container w3-orange w3-text-white w3-padding-16 m8-fancy">
			<div class="w3-left"><i class="fa fa-plug w3-xxxlarge"></i></div>
			<div class="w3-right">
				<h5>
					<?php
					$pwr = "0";
					$sql = "SELECT id FROM _g_data ORDER BY id DESC LIMIT 1";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						$row = $result->fetch_assoc();
						echo $pwr = $row["id"] / 1000;
					}
					?> kWh</h5>
			</div>
			<div class="w3-clear"></div>
			<h4>Energy Saving</h4>
		</div>
	</div>
</div>

<div class="w3-row-padding w3-margin-bottom">
	<div class="w3-quarter w3-button0" onclick0="window.location.assign('?item=2')">
		<div class="w3-container w3-indigo w3-padding-16 w3-hover-red0 m8-fancy">
			<div class="w3-left"><i class="fa fa-user w3-xxxlarge"></i></div>
			<div class="w3-right">
				<h3>
					<?php
					$sql = "SELECT count(id) as id FROM _b_district";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						$row = $result->fetch_assoc();
						echo $row["id"];
					}
					?>
				</h3>
			</div>
			<div class="w3-clear"></div>
			<h4 class="w3-left">Total Districts</h4>
		</div>
	</div>
	<div class="w3-quarter">
		<div class="w3-container w3-purple w3-padding-16 m8-fancy">
			<div class="w3-left"><i class="fa fa-user-o w3-xxxlarge"></i></div>
			<div class="w3-right">
				<h3>
					<?php
					$sql = "SELECT count(id) as id FROM _c_block";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						$row = $result->fetch_assoc();
						echo $row["id"];
					}
					?></h3>
			</div>
			<div class="w3-clear"></div>
			<h4>Blocks</h4>
		</div>
	</div>
	<div class="w3-quarter">
		<div class="w3-container w3-green w3-padding-16 m8-fancy">
			<div class="w3-left"><i class="fa fa-user-secret w3-xxxlarge"></i></div>
			<div class="w3-right">
				<h3>
					<?php
					$sql = "SELECT count(id) as id FROM _d_panchayat";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						$row = $result->fetch_assoc();
						echo $row["id"];
					}
					?></h3>
			</div>
			<div class="w3-clear"></div>
			<h4>Panchayat</h4>
		</div>
	</div>
	<div class="w3-quarter">
		<div class="w3-container w3-deep-orange w3-text-white w3-padding-16 m8-fancy">
			<div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
			<div class="w3-right">
				<h3>
					<?php
					$sql = "SELECT count(id) as id FROM _e_ward";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						$row = $result->fetch_assoc();
						echo $row["id"];
					}
					?></h3>
			</div>
			<div class="w3-clear"></div>
			<h4>Ward</h4>
		</div>
	</div>
</div>

<div class="w3-section w3-container">
	<div class="w3-card w3-white w3-padding w3-row w3-center m8-fancy">
		<div class="w3-third w3-mobile"><img src="../img/co2.jpg" style="height:100px"></div>
		<div class="w3-third w3-mobile">
			<b>
				CO2 Emmision Reduction
				<h1><?php echo $co2 = round($pwr / 10.55, 5); ?> m<sup>3</sup></h1>
			</b>
		</div>
		<div class="w3-third w3-mobile">
			<b>
				Equivalent trees absorbed CO<sub>2</sub> annually
				<h1><?php echo round($co2 / (48 * 0.00045359290943564), 1); ?> Tree <i class="fa fa-tree w3-text-green w3-animate-zoom-x"></i></h1>
			</b>
		</div>
	</div>
</div>

  <div class="w3-container w3-section">
	<div style="width: 100%" class="w3-card m8-fancy"><div class="w3-card m8-fancy" id="googleMap" style="width:100%;height:400px;"></div></div>
  </div>
  
  <!-- <div class="w3-row">
  
	<div class="w3-container w3-section w3-half">
		<div class="w3-card m8-fancy" id="graph" style="height:500px;"></div>
	</div>

	<div class="w3-container w3-section w3-half">
		<div class="w3-card m8-fancy" id="pie" style="width:100%; max-width:600px; height:500px;"></div>
	</div>
  
  </div>  -->

  <!-- Search box -->
<div class="w3-section w3-container">
	<div class="w3-card w3-white w3-padding w3-row w3-center m8-fancy">
		<form class="form-inline" id="data_form">
			<select class="custom-select my-1 mr-sm-2 mx-1 my-1" style="width:150px;border-radius: 0; " id="project" name="project" onchange="project_changed(event)">
				<option value=''>Project</option>
				<!-- <option w3-repeat="output" value={{ID}}>{{Name}}</option> -->
			</select>
			<select class="custom-select my-1 mr-sm-2 mx-1 my-1" style="width:150px;border-radius: 0; " id="district" name="district" onchange="district_changed(event)">
				<option value=''>District</option>
				<!-- <option w3-repeat="output" value={{ID}}>{{Name}}</option> -->
			</select>
			<select class="custom-select my-1 mr-sm-2 mx-1 my-1" style="width:150px;border-radius: 0; " id="block" name="block" onchange="block_changed(event)">
				<option value=''>Block</option>
				<!-- <option w3-repeat="output" value={{ID}}>{{Name}}</option> -->
			</select>
			<select class="custom-select my-1 mr-sm-2 mx-1 my-1" style="width:150px;border-radius: 0; " id="panchayat" name="panchayat" onchange="panchayat_changed(event)">
				<option value=''>Panchayat</option>
				<!-- <option w3-repeat="output" value={{ID}}>{{Name}}</option> -->
			</select>
			<select class="custom-select my-1 mr-sm-2 mx-1 my-1" style="width:150px;border-radius: 0; " id="ward" name="ward" onchange="ward_changed(event)">
				<option value=''>Ward</option>
				<!-- <option w3-repeat="output" value={{ID}}>{{Name}}</option> -->
			</select>
			<input type="text" class="form-control my-1 mr-sm-2 mx-1 my-1" placeholder="Search By Pole ID" aria-describedby="addon-wrapping" style="width:150px;border-radius: 0; " id="poleId" name="poleId">
			<input type="text" class="form-control my-1 mr-sm-2 mx-1 my-1" placeholder="Search By IMEI" aria-describedby="addon-wrapping" style="width:150px;border-radius: 0; " id="imei" name="imei">
			<button type="submit" class="btn btn-info mx-1 my-1" style="border-radius: 0;" id="table_btn">Go</button>
		</form>
	</div>
</div>

<div class="w3-container w3-responsive tableFixHead w3-small m8-fancy">
	<table id="id01" class="w3-table-all m8-fancy" style="overflow-y:scroll; overflow-x:scroll; height:400px;">
		<thead>
			<tr class="w3-color">
				<th>Date & Time</th>
				<td>Pole ID</td>
				<th>IMEI</th>
				<th>Installer</th>
				<th>Battery Percentage</th>
				<th>Battery Voltage</th>
				<th>Battery Current</th>
				<th>Battery Power</th>
				<th>Solar Voltage</th>
				<th>Solar Current</th>
				<th>Solar Power</th>
				<th>Luminary Voltage</th>
				<th>Luminary Current</th>
				<th>Luminary Power</th>
				<th>Full Working Minutes</th>
				<th>Dim Working Minutes</th>
				<th>Total Working Hours</th>
				<th>KWH</th>
				<th>Total KWH</th>
				<th>Light Status</th>
				<th>Dusk/ Down</th>
				<th>Battery Status</th>
				<th>Luminary Fault</th>
				<th>Battery Fault</th>
				<th>Panel Fault</th>
				<th>System Fault</th>
				<th>Locate</th>
			</tr>
		</thead>
		<tbody>
			<tr w3-repeat="myObjectData">
				<td>{{Time}}</td>
				<td onclick='get_log(this.id)' id={{PoleID}} style="color:blue;cursor:pointer">{{PoleID}}</td>
				<td name={{PoleID}} id={{IMEI}}>{{IMEI}}</td>
				<td>{{Installer}}</td>
				<td>{{V1}} %</td>
				<td>{{V2}}</td>
				<td>{{V3}}</td>
				<td>{{V4}}</td>
				<td>{{V5}}</td>
				<td>{{V6}}</td>
				<td>{{V7}}</td>
				<td>{{V8}}</td>
				<td>{{V9}}</td>
				<td>{{V10}}</td>

				<td>{{V14}}</td>
				<td>{{V15}}</td>
				<td>{{V16}}</td>
				<td>{{V17}}</td>
				<td>{{V18}}</td>
				<td><i class="fa {{V11[7]}} w3-large"></i></td>
				<td><i class="fa {{V11[6]}} w3-large"></i></td>
				<td><i class="fa {{V11[5]}} w3-large"></i></td>
				<td><i class="fa fa-circle w3-text-{{V11[4]}} w3-large"></i></td>
				<td><i class="fa fa-circle w3-text-{{V11[3]}} w3-large"></i></td>
				<td><i class="fa fa-circle w3-text-{{V11[2]}} w3-large"></i></td>
				<td><i class="fa fa-circle w3-text-{{V11[2,3,4]}} w3-large"></i></td>
				<td><a href="https://www.google.com/maps/search/?api=1&query=0,0" target="_blank" class="w3-large"><i class="fa fa-globe w3-text-color"></i></a></a></td>
			</tr>
		</tbody>
	</table>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATX7SRJg6UuAUdl6gCM8fy26lBorZ5h2I&callback=myMap"></script>

<script>
	google.charts.load('current', {
		'packages': ['corechart']
	});
	google.charts.setOnLoadCallback(drawChart);

	function drawChart() {
		//chart
		var data = google.visualization.arrayToDataTable([
			<?php
			$sql = "SELECT distinct name FROM _b_district where 1 limit 10";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				echo "['District', 'District'],";
				while ($row = $result->fetch_assoc()) {
					echo "['" . $row["name"] . "',1],";
				}
			}
			?>
		]);

		var options = {
			title: 'Device List Ratio in District'
		};

		var chart = new google.visualization.BarChart(document.getElementById('graph'));
		chart.draw(data, options);

		//pie
		var data = google.visualization.arrayToDataTable([
			<?php
			$sql = "SELECT distinct name FROM _b_district where 1 limit 10";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				echo "['District', 'District'],";
				while ($row = $result->fetch_assoc()) {
					echo "['" . $row["name"] . "',1],";
				}
			}
			?>
		]);

		var options = {
			title: 'Device List Ratio in District',
			is3D: true
		};

		var chart = new google.visualization.PieChart(document.getElementById('pie'));
		chart.draw(data, options);
	}


	//table
	function getTableData(proj = "", dist = "", bloc = "", panc = "", ward = "", imei = "", poleID = "", filter = 0) {
		//filter = 0 means no filter
		//filter = 1 means project hierarchy
		//filter = 2 means imei search;
		//filter = 3 means poleId search
		let url = `&project_id=${proj}&district_id=${dist}&block_id=${bloc}&panchayat_id=${panc}&&ward_id=${ward}&imei=${imei}&pole_id=${poleID}`;
		// w3.getHttpObject(`../Controller/getAllLog.php?filter=${filter}${url}`, myFunction);
		w3.getHttpObject("../Controller/getMapsLog.php", myFunction2);
		// w3.id("id01").style.height= (document.documentElement.clientHeight - 300) + "px";

		// function myFunction(myObject) {
		// 	w3.displayObject("id01", myObject);
		// }

		function capitalizeFirstLetter(str) {
			return str.charAt(0).toUpperCase() + str.slice(1);
		}

		fetch(`../Controller/getAllLogData.php?filter=${filter}${url}`)
			.then(response => response.json())
			.then(data => {
				const result = data.map(item => {
					let V11 = item.v11 || "";
					// console.log(V11);
					if (V11.length != 8) {
						V11 == "00000000";
					}
					return {
						IMEI: item.device,
						PoleID: item.name,
						Time: item.time,
						Installer: capitalizeFirstLetter(item.updated_by),
						V1: item.v1,
						V2: item.v2,
						V3: item.v3,
						V4: item.v4,
						V5: item.v5,
						V6: item.v6,
						V7: item.v7,
						V8: item.v8,
						V9: item.v9,
						V10: item.v10,
						V12: item.v12,
						V13: item.v13,
						V14: item.v14,
						V15: item.v15,
						V16: item.v16,
						V17: item.v17,
						V18: item.v18,
						V19: item.v19,
						V20: item.v20,
						V11: item.v11,
						// Applying conditions for V11 properties
						"V11[2,3,4]": item.v11[2] + item.v11[3] + item.v11[4] === "000" ? "green" : "red",
						"V11[2]": item.v11[2] > 0 ? "red" : "green",
						"V11[3]": item.v11[3] > 0 ? "red" : "green",
						"V11[4]": item.v11[4] > 0 ? "red" : "green",
						"V11[5]": item.v11[5] > 0 ? "fa-battery-1 w3-text-red" : "fa-battery w3-text-green",
						"V11[6]": item.v11[6] > 0 ? "fa-moon-o w3-text-grey" : "fa-sun-o w3-text-orange",
						"V11[7]": item.v11[7] > 0 ? "fa-lightbulb-o w3-text-orange" : "fa-lightbulb-o w3-text-grey",
					};
				});
				const myObjectData = {
					myObjectData: result
				};
				w3.displayObject("id01", myObjectData);
			})
			.catch(error => {
				console.error('Error fetching data:', error);
			});


		function myFunction2(myObject) {
			LoadMap(myObject.result);
		}

		function LoadMap(myObject) {
			var i = 0;
			for (i = 0; i < myObject.length; i++)
				if (myObject[i].lat > 0 && myObject[i].lng > 0)
					break;

			var mapOptions = {
				center: new google.maps.LatLng(myObject[i].lat, myObject[i].lng),
				zoom: 5,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);

			//Create and open InfoWindow.
			var infoWindow = new google.maps.InfoWindow();

			for (var i = 0; i < myObject.length; i++) {
				var data = myObject[i];
				var myLatlng = new google.maps.LatLng(data.lat, data.lng);
				var marker = new google.maps.Marker({
					position: myLatlng,
					map: map,
					title: data.name,
					icon: '../img/green.png'
				});

				//Attach click event to the marker.
				(function(marker, data) {
					google.maps.event.addListener(marker, "click", function(e) {
						infoWindow.setContent("<div style = 'width:250px;min-height:40px'><b style='font-weight: 500!important;'>POLE ID: " + data.name + "<br>IMEI: </b>" + data.IMEI + "</div>");
						infoWindow.open(map, marker);
					});
				})(marker, data);
			}
		}
	}
	getTableData();

	//  filter script
	// let project = document.getElementById("project").innerHTML
	// console.log("type of: " + typeof project);
	// console.log("project: " + project);
	let project = document.getElementById("project");
	let district = document.getElementById("district");
	let block = document.getElementById("block");
	let panchayat = document.getElementById("panchayat");
	let ward = document.getElementById("ward");
	let table_btn = document.getElementById("table_btn");
	let poleId = document.getElementById("poleId");
	let imei = document.getElementById("imei");

	function loadList(category, parent_id) {
		// console.log("loadList called :" + category + " " + parent_id);
		w3.getHttpObject(`../Controller/getDeviceHierarchy.php?category=${category}&parent_id=${parent_id}`, myFunction3);

		function myFunction3(myObject) {
			//category is id of the container to be populated
			// console.log(myObject.output);
			if (category == "project") {
				$("#project").html(`<option value="">Project</option>`);
				myObject.output.forEach((element) => {
					$("#project").append(`<option value=${element.ID}>${element.Name}</option>`);
				});
			} else if (category == "district") {
				$("#district").html(`<option value="">District</option>`);
				myObject.output.forEach((element) => {
					$("#district").append(`<option value=${element.ID}>${element.Name}</option>`);
				});
			} else if (category == "block") {
				$("#block").html(`<option value="">Block</option>`);
				myObject.output.forEach((element) => {
					$("#block").append(`<option value=${element.ID}>${element.Name}</option>`);
				});
			} else if (category == "panchayat") {
				$("#panchayat").html(`<option value="">Panchayat</option>`);
				myObject.output.forEach((element) => {
					$("#panchayat").append(`<option value=${element.ID}>${element.Name}</option>`);
				});
			} else if (category == "ward") {
				$("#ward").html(`<option value="">Ward</option>`);
				myObject.output.forEach((element) => {
					$("#ward").append(`<option value=${element.ID}>${element.Name}</option>`);
				});
			}
		}
	}
	loadList("project", 1);

	function project_changed(event) {
		let id = event.target.value;
		let id_text = event.target.selectedOptions[0].text;
		//console.log(id + " " + id_text);
		if (id != "") {
			table_btn.removeAttribute('disabled');
			loadList("district", id);
			//enableBtn();
		} else {
			$("#district").html("<option value=''>DIstrict</option>");
		}
		$("#block").html("<option value=''>Block</option>");
		$("#panchayat").html("<option value=''>Panchayat</option>");
		$("#ward").html("<option value=''>Ward</option>");
	}

	function district_changed(event) {
		let id = event.target.value;
		let id_text = event.target.selectedOptions[0].text;
		//console.log(id + " " + id_text);
		if (id != "") {
			// table_btn.removeAttribute('disabled');
			loadList("block", id);
			//enableBtn();
		} else {
			$("#block").html("<option value=''>Block</option>");
		}
		$("#panchayat").html("<option value=''>Panchayat</option>");
		$("#ward").html("<option value=''>Ward</option>");
	}

	function block_changed(event) {
		let id = event.target.value;
		let id_text = event.target.selectedOptions[0].text;
		//console.log(id + " " + id_text);
		if (id != "Block" && id > 0) {
			loadList("panchayat", id);
		} else {
			$("#panchayat").html("<option value=''>Panchayat</option>");
		}
		$("#ward").html("<option value=''>Ward</option>");
	}

	function panchayat_changed(event) {
		let id = event.target.value;
		let id_text = event.target.selectedOptions[0].text;
		//console.log(id + " " + id_text);
		if (id != "Panchayat" && id > 0) {
			loadList("ward", id);
		}
	}

	function ward_changed(event) {
		let id = event.target.value;
		let id_text = event.target.selectedOptions[0].text;
		//console.log(id + " " + id_text);
	}
	table_btn.addEventListener("click", (event) => {
		event.preventDefault();
		console.log("Project: " + project.value, "dist: " + district.value, "block: " + block.value, "panch: " + panchayat.value, "ward: " + ward.value)
		if (imei.value.length > 0) {
			console.log("imei search")
			getTableData("", "", "", "", "", imei.value, "", 2); //imei search
		} else if (poleId.value.length > 0) {
			console.log("pole id search")
			getTableData("", "", "", "", "", "", poleId.value, 3); //poleId search
		} else if (project.value) {
			console.log("project hierarchy")
			getTableData(project.value, district.value, block.value, panchayat.value, ward.value, "", "", 1); //project hierarchy
		}
	});

	//go to device page
	function get_log(pole_name) {
		// let pole_name = event.target.id;
		let imei_name = document.getElementsByName(pole_name);
		let imei = imei_name[0].getAttribute('id');
		console.log(pole_name+" "+imei);
		localStorage.setItem("temp_name", pole_name);
		localStorage.setItem("temp_imei", imei);
		window.location.assign("?item=6");
	}
</script>
