<div class="w3-container w3-responsive">
	<table id="id01" class="w3-table-all">
		<tr class="w3-color">
			<th>Device Name</th>
			<th>IMEI</th>
			<th>Ward</th>
			<th>Panchayat</th>
			<th>Block</th>
			<th>District</th>
			<th>Luminary QR</th>
			<th>Battery QR</th>
			<th>Panel QR</th>
			<th>Updated By</th>
			<th>Image</th>
			<th>Locate</th>
			<th>Location Remark</th>
			<th>Date & Time</th>
			<th>Action</th>
		</tr>
		<tbody>
			<?php
			$sql = "SELECT * FROM _f_device where active=0";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
			?>
					<tr>
						<td style="width:50px;"><?php echo $row["name"]; ?></td>
						<td><?php echo $row["dev_id"]; ?></td>
						<td><?php echo $row["ward"]; ?></td>
						<td><?php echo $row["panchayat"]; ?></td>
						<td><?php echo $row["block"]; ?></td>
						<td><?php echo $row["district"]; ?></td>
						<td><?php echo $row["luminary_qr"]; ?></td>
						<td><?php echo $row["battery_qr"]; ?></td>
						<td><?php echo $row["panel_qr"]; ?></td>
						<td><?php echo $row["updated_by"]; ?></td>
						<?php if (str_contains($row["file"], ".jpeg")) { ?>
							<td><img src="../upload/images/<?php echo $row["file"]; ?>" style="width:200px;"></td>
						<?php } else { ?>
							<td><img src="data:image/png;base64,<?php echo $row["file"]; ?>" style="width:200px;"></td>
						<?php } ?>
						<td><a href="https://www.google.com/maps/search/?api=1&query=<?php echo $row["lat"] . "," . $row["lng"]; ?>" target="_blank" class="w3-large"><i class="fa fa-globe w3-text-color"></i> Locate</a></a></td>
						<td><?php echo $row["remark"]; ?></td>
						<td><?php echo $row["time"]; ?></td>
						<td>
							<button class="w3-button w3-teal m8-fancy" style="width:100px;" onclick="authoriseDevice('<?php echo $row['dev_id']; ?>')">Accept</button><br><br>
							<button class="w3-button w3-red m8-fancy" style="width:100px;" onclick="deleteDevice('<?php echo $row['dev_id']; ?>','<?php echo $row['id']; ?>')">Delete</button><br><br>
							<button class="w3-button w3-color m8-fancy" style="width:100px;">Block IMEI</button>
						</td>
					</tr>
			<?php
				}
			} else {
				echo "<tr><td>No new device found!</td></tr>";
			}
			?>
		</tbody>
	</table>
</div>

<div id="idDeleteDevice" class="w3-modal">
	<div class="w3-modal-content w3-animate-top w3-card-4" style="width:400px;height:auto;height:300px;">
		<header class="w3-container w3-color">
			<span onclick="document.getElementById('idDeleteDevice').style.display='none'" class="w3-button w3-display-topright">&times;</span>
			<h2 id="deleteDeviceH2"></h2>
		</header>
		<div class="w3-padding">
			<h4>Once deleted the data for this device will be deleted and cannot be recovered.</h4>
			<div id="deleteDeviceButton"></div>
		</div>
	</div>
</div>

<script>
	function authoriseDevice(imei) {
		console.log(imei);
		var param = "imei=" + imei;
		ajaxCsllForInactive("../Controller/admin/authoriseDevice.php", param, 1);
		// ajaxCsllForInactive("../Controller/admin/authoriseDevice.php", param, 1);
	}

	function downloadList() {
		var url = '../../orientsolar/Controller/devicesExport.php';
		window.location.href = url;
	}

	function ajaxCsllForInactive(url, params, reload) {
		sw();
		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		} else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.open("POST", url, true);
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4) {
				if (xmlhttp.status == 200) {
					if (xmlhttp.responseText == "1") {
						msg("Success!");
						if (reload > 0) {
							reload_on_close = 1;
						}

						window.location.reload();

					} else {
						msg("Some error occurred. Please try again later");
					}
					sw();
				}
			} else {
				sw();
			}
		}
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", params.length);
		xmlhttp.setRequestHeader("Connection", "close");
		xmlhttp.send(params);
	}

	function deleteDevice(dev_id, id) {
		w3.id("idDeleteDevice").style.display = "block";
		w3.id("deleteDeviceH2").innerHTML = 'Are you sure to delete device ' + dev_id + ' ?';
		w3.id("deleteDeviceButton").innerHTML = '<button class="w3-red w3-button w3-section w3-col s12 m12 l12 m8-fancy" onclick="deleteDeviceFor(' + id + ')">Delete</button>';
	}

	function deleteDeviceFor(id) {
		console.log(id);
		var param = "id=" + id;
		ajaxCsllForInactive("../Controller/admin/deleteDevice.php", param);
		let lastA = document.getElementById('InactiveDevices');
		setTimeout(() => {
			w3.id("idDeleteDevice").style.display = "none";
			w3.id("deleteDeviceH2").innerHTML = '';
			w3.id("deleteDeviceButton").innerHTML = '';
			lastA.click();
		}, 2000);
	}
</script>
