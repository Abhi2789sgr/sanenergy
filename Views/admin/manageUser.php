<style>
	.inputPadding {
		padding: 0px 10px 10px 10px;
		height: 73px;
	}

	.type_1::before {
		content: "Master";
	}

	.type_2::before {
		content: "Admin";
	}

	.type_3::before {
		content: "Installer";
	}

	.type_4::before {
		content: "User";
	}

	.showHide_1 {
		display: none;
	}

	.show_2 {
		display: none;
	}

	.show_4 {
		display: none;
	}
</style>
<!-- Header -->
<header class="w3-container w3-text-indigo" style="padding-top:22px">
	<h5><b><i class="fa fa-users"></i> Manage User</b></h5>
</header>

<div class="w3-container w3-margin-bottom">
	<button class="w3-right w3-button w3-color m8-fancy w3-margin-top" onclick="w3.show('#addUser')">Add Users</button>
	<h2>Users</h2>

	<div class="w3-animate-top w3-section w3-border w3-white w3-text-color m8-fancy" style="display:none;" id="addUser">
		<div class="w3-row" id="id02">
			<div class="w3-button w3-circle w3-red w3-right w3-margin" onclick="w3.hide('#addUser')">X</div>
			<h3 style="padding-left:10px;">Add User</h3>
			<hr>
			<div class="w3-col s12 m6 l3 inputPadding" w3-repeat="result">
				<label>{{Title}} :</label>
				<input class="w3-input w3-border m8-fancy" id="{{ID}}" type="{{Type}}">
			</div>
			<div class="w3-col s12 m6 l3" w3-repeat="select">
				<div style="display:{{View}}" class="inputPadding">
					<label>{{Title}} :</label>
					<select class="w3-input w3-border m8-fancy" id="{{ID}}" title="{{Branch}}"></select>
				</div>
			</div>
		</div>
		<div class="w3-row" style="margin:10px">
			<button class="w3-col s12 m12 l12 w3-button w3-color m8-fancy" id="addUserBtn" onclick="addUser()">Add User</button>
		</div>
	</div>

	<h3>Users List</h3>
	<ul class="w3-ul" id="id01">
		<li class="w3-bar m8-fancy w3-card w3-button" w3-repeat="result" onclick="listUser('{{Name}}','{{Branch}}')">
			<div class="w3-bar-item" style="text-align:left!important;">
				<span class="w3-large">{{Name}}({{uname}})</span><br>
				<span class="type_{{Type}}"></span>
			</div>
			<div class="showHide_{{Type}}">
				<button class="m8-fancy w3-red" style="float:right; margin-top:20px" id="deleteBtn" onclick="deleteButton('{{Name}}', '{{uname}}')"><i class="fa fa-trash"></i></button>
				<button class="m8-fancy w3-color show_{{Type}}" style="float:right;margin:20px" id="editBtn" onclick="editUser('{{id}}','{{uname}}')"><i class="fa fa-edit"></i></button>
			</div>

		</li>
	</ul>
</div>
<div id="deleteUserModal" class="w3-modal">
	<div class="w3-modal-content w3-animate-top w3-card-4" style="width:400px;height:auto;height:200px;">
		<header class="w3-container w3-color">
			<span onclick="w3.hide('#deleteUserModal')" class="w3-button w3-display-topright">&times;</span>
			<h2>DELETE USER</h2>
		</header>
		<h4 id="changeName"></h4>
		<div class="w3-row" w3-repeat="result" style="margin-top:5vh" id="deleteUserBtn">
		</div>
	</div>
</div>
<div id="editUserModal" class="w3-modal m8-fancy">
	<div id="id01" class="w3-modal-content w3-animate-top w3-card-4 w3-white" w3-repeat="result" style="width:73%;height:auto;float:right;margin-right:20px">
		<header class="w3-container w3-color">
			<span onclick="w3.hide('#editUserModal')" class="w3-button w3-display-topright">&times;</span>
			<h2>EDIT USER</h2>
		</header>
		<div class="w3-row" style="background-color: white;" w3-repeat="result">
			<div class="w3-col s12 m6 l3">
				<div style="padding: 10px;">
					<label>User Name :</label>
					<input class="w3-input w3-border m8-fancy" id="enterUname" type="text">
				</div>
			</div>
			<div class="w3-col s12 m6 l3">
				<div style="padding: 10px;">
					<label>Name :</label>
					<input class="w3-input w3-border m8-fancy" id="enterName" type="text">
				</div>
			</div>
			<div class="w3-col s12 m6 l3">
				<div style="padding: 10px;">
					<label>Email :</label>
					<input class="w3-input w3-border m8-fancy" id="enterEmail" type="text">
				</div>
			</div>
			<div class="w3-col s12 m6 l3">
				<div style="padding: 10px;">
					<label>Mobile 1:</label>
					<input class="w3-input w3-border m8-fancy" id="enterMobile1" type="text">
				</div>
			</div>
			<div class="w3-col s12 m6 l3">
				<div style="padding: 10px;">
					<label>Mobile 2:</label>
					<input class="w3-input w3-border m8-fancy" id="enterMobile2" type="text">
				</div>
			</div>
			<div class="w3-col s12 m6 l3">
				<div style="padding: 10px;">
					<label>Password:</label>
					<input class="w3-input w3-border m8-fancy" id="enterPassword" type="text">
				</div>
			</div>
			<div class="w3-col s12 m6 l3">
				<div style="padding: 10px;">
					<label>Type of User:</label>
					<input class="w3-input w3-border m8-fancy" id="enterTypeUser" type="text">
				</div>
			</div>
			<div class="w3-col s12 m6 l3">
				<div style="padding: 10px;">
					<label>Branch:</label>
					<input class="w3-input w3-border m8-fancy" id="enterBranch" type="text">
				</div>
			</div>
			<div class="w3-col s12 m6 l3">
				<div style="padding: 10px;">
					<label>Project:</label>
					<input class="w3-input w3-border m8-fancy" id="enterProject" type="text">
				</div>
			</div>
		</div>
		<div class="w3-row" id="updateButton">
			<!-- <button class="w3-col s12 m12 l12 w3-button w3-color w3-round" id="editUserBtn" onclick="updateUser()">Update</button> -->
		</div>
	</div>
</div>

<script>
	const tree = ["_g_data", "_f_device", "_e_ward", "_d_panchayat", "_c_block", "_b_district", "_a_project"];
	const color = ["w3-red", "w3-pink", "w3-purple", "w3-deep-purple", "w3-blue", "w3-teal", "w3-green", "w3-indigo", "w3-blue-grey", "w3-deep-orange"];
	var title = w3.id("title");
	var heading = w3.id("heading");
	var name_global = "";
	var branch_global = "";

	listUser("", "");

	function myFunction(myObject) {
		w3.displayObject("id01", myObject);
		for (var i = 0; i < color.length; i++)
			w3.removeClass('.w3-bar.m8-fancy', color[Math.floor(Math.random() * 10)]);
		w3.addClass('.w3-bar.m8-fancy', color[Math.floor(Math.random() * 10)]);
		w3.id("id01").style.display = "block";
		// w3.id("id03").style.display="none";
		//var str = title.innerHTML;
		//str = str.slice(0,str.indexOf('<a onclick="listUser(&quot;'+name_global))
		//title.innerHTML = str+" <a onclick='listUser(\""+name_global+"\", \""+branch_global+"\")'>"+name_global+"</a> >";
		//heading.innerHTML = (tree[branch_global-1].split("_")[2]+" List").toUpperCase();

	}

	function listUser(name, branch) {
		var q = "";
		if (name == "" || branch == "") {
			branch_global = branch = <?php echo $branch; ?> + 1;
			name_global = "";
		} else {
			if (branch > 9999) {
				localStorage.clear();
				localStorage.temp_name = name;
				localStorage.temp_imei = branch;

				window.location.assign("?item=7");
				branch = 0;
			} else if (branch > 1) {
				q = "?branch=" + (branch - 1) + "&parent=" + name;
				name_global = name;
				branch_global = branch;
			}
		}
		if (branch > 1) {
			w3.getHttpObject("../Controller/admin/getUserList.php" + q, myFunction);
		}

	}

	showOptions();

	function showOptions() {
		myObject = `{"result":[
		{"Title":"User Name","ID":"uname","Type":"text"},
		{"Title":"Name","ID":"name","Type":"text"},
		{"Title":"Email","ID":"email","Type":"text"},
		{"Title":"Mobile 1","ID":"mob1","Type":"text"},
		{"Title":"Mobile 2","ID":"mob2","Type":"text"},
		{"Title":"Password","ID":"pass","Type":"password"}
	],"select":[
		{"Title":"Type Of User","ID":"type","View":"block","Branch":"0"},
		{"Title":"Branch","ID":"branch","View":"block","Branch":"0"},
		{"Title":"Projects","ID":"project","View":"none","Branch":"6"},
		{"Title":"District","ID":"district","View":"none","Branch":"5"},
		{"Title":"Block","ID":"block","View":"none","Branch":"4"},
		{"Title":"Panchyat","ID":"panchayat","View":"none","Branch":"3"},
		{"Title":"Ward","ID":"ward","View":"none","Branch":"2"},
		{"Title":"Device","ID":"device","View":"none","Branch":"1"}
	]}`;
		w3.displayObject("addUser", JSON.parse(myObject));

		var text = '<option value="" disabled selected>Choose type of user</option>';
		text += '<option value="2">Admin</option>';
		text += '<option value="3">Installer</option>';
		text += '<option value="4">User</option>';
		var user_type = w3.id("type");
		user_type.innerHTML = text;

		var text = '';
		var branch = w3.id("branch");
		user_type.addEventListener("change", function onclick(event) {
			text = '<option value="" disabled selected>Choose access level of user</option>';
			if (user_type.value == 2 || user_type.value == 3) {
				text += '<option value="6">Project</option>';
			} else {
				text += '<option value="6">Project</option>';
				text += '<option value="5">District</option>';
				text += '<option value="4">Block</option>';
				text += '<option value="3">Panchyat</option>';
				text += '<option value="2">Ward</option>';
				//text += '<option value="1">Device</option>';
			}
			branch.innerHTML = text;
		});

		branch.addEventListener("change", function onclick(event) {
			sw();
			for (var i = 1; i < 6; i++)
				w3.hide(w3.id(tree[i].split("_")[2]).parentElement);
			for (var i = branch.value; i <= 6; i++) {
				//w3.id(tree[i].split("_")[2]).innerHTML=
				w3.show(w3.id(tree[i].split("_")[2]).parentElement);
			}
			//w3.hide(w3.id("project").parentElement);
			//w3.id("project").innerHTML = '<option value="1">wam</option>';
			fillItems(<?php echo $branch . "," . $branch_value; ?>);
			event.preventDefault();
		});

		var select = [];
		for (var i = 1; i < 6; i++) {
			select[i] = w3.id(tree[i + 1].split("_")[2]);
			select[i].addEventListener("change", function onclick(event) {
				sw();
				fillItems(this.title, this.value)
				event.preventDefault();
			});
		}
	}

	function fillItems(branch, id) {
		w3.getHttpObject("../Controller/admin/getHistory.php?branch=" + (branch - 1) + "&parent=" + id, function(result) {
			var branch = "device";
			if (result.result[0].Branch < 9) {
				branch = tree[result.result[0].Branch].split("_")[2];
			}
			var text = '<option value="" disabled selected>Choose type of ' + branch + '</option>';
			var appnd = '';
			for (var i = 0; i < result.result.length; i++) {
				t_branch = result.result[i].Branch;
				if (t_branch > 9)
					appnd = ' ( ' + t_branch + ' )';
				text += '<option value="' + result.result[i].ID + '">' + result.result[i].Name + appnd + '</option>';
			}
			w3.id(branch).innerHTML = text;
			sw();
		});
	}

	function addUser() {
		var uname = w3.id("uname").value;
		var name = w3.id("name").value;
		var email = w3.id("email").value;
		var mob1 = w3.id("mob1").value;
		var mob2 = w3.id("mob2").value;
		var pass = w3.id("pass").value;
		var type = w3.id("type").value;
		var branch = w3.id("branch").value;
		var branchValue = w3.id(tree[w3.id("branch").value].split("_")[2]).value;

		if (uname == "" || name == "" || email == "" || pass == "" || type == "" || branch == "" || branchValue == "") {
			msg("Please fill all the fields");
			return 0;
		}

		var param = "uname=" + uname + "&name=" + name + "&email=" + email + "&mob1=" + mob1 + "&mob2=" + mob2 + "&pass=" + pass + "&type=" + type + "&branch=" + branch + "&branchValue=" + branchValue;

		ajax("../Controller/admin/addUser.php", param);
	}

	function scrollToTop() {
		document.body.scrollTop = 0;
		document.documentElement.scrollTop = 0;
	}

	function deleteButton(name, uname) {
		w3.show('#deleteUserModal');
		console.log("uname came in delete button function value =", uname);
		w3.id("changeName").innerHTML = "Are you sure you want to delete <br><b>" + name + "(" + uname + ")</b> ?";
		w3.id("deleteUserBtn").innerHTML = '<button class="w3-red w3-button w3-section w3-col s12 m12 l12 m8-fancy" onclick= "deleteUser(\'' + uname + '\')">Delete</button>';
	}

	function deleteUser(uname) {
		sw();
		w3.hide('#deleteUserModal');
		var url = "../Controller/admin/deleteUser.php?uname=" + uname;
		const xhttp = new XMLHttpRequest();
		xhttp.onload = function() {
			sw();
			if (this.responseText == "1") {
				alert("Deleted successfully");
				listUser("", "");
			} else {
				alert("Invalid request");
			}
		}
		xhttp.open("GET", url);
		xhttp.send();
	}
	function editUser(id, uname) {
		// console.log(id);
		w3.id('updateButton').innerHTML = '<button class="w3-col s12 m12 l12 w3-button w3-color w3-round" id="editUserBtn" onclick="updateUser(\'' + id + '\')">Update</button>';
		w3.show('#editUserModal');
		var url = "../Controller/admin/editUserVal.php?id=" + id;
		const xhttp = new XMLHttpRequest();
		xhttp.onload = function() {
			if (xhttp.readyState === 4) {
				if (xhttp.status === 200) {
					var response = JSON.parse(xhttp.responseText);
					var resultArray = response.result;
					if (resultArray.length > 0) {
						var data = resultArray[0];

						w3.id('enterUname').value = data.Name;
						w3.id('enterName').value = data.uname;
						w3.id('enterEmail').value = data.email;
						w3.id('enterMobile1').value = data.mob1;
						w3.id('enterMobile2').value = data.mob2;
						w3.id('enterTypeUser').value = data.Type;
						w3.id('enterBranch').value = data.branch;
						w3.id('enterProject').value = data.project;
					}
				}
			}
		}
		xhttp.open("GET", url);
		xhttp.send();

	}

	function updateUser(id) {
		w3.hide('#editUserModal');
		// console.log(id);
		var updatedName = w3.id('enterUname').value;
		var updatedUname = w3.id('enterName').value;
		var updatedEmail = w3.id('enterEmail').value;
		var updatedPass = w3.id('enterPassword').value;
		var updatedMobile1 = w3.id('enterMobile1').value;
		var updatedMobile2 = w3.id('enterMobile2').value;
		var updatedType = w3.id('enterTypeUser').value;
		var updatedProject = w3.id('enterProject').value;
		// Create an object to send as JSON
		var updatedData = {
			id: id,
			Name: updatedName,
			uname: updatedUname,
			email: updatedEmail,
			pass: updatedPass,
			mob1: updatedMobile1,
			mob2: updatedMobile2,
			type: updatedType,
			proj: updatedProject
		};

		var url = "../Controller/admin/upadateUserVal.php";
		var xmlhttp = new XMLHttpRequest();
		
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState === 4) {
				if (xmlhttp.status === 200) {
					if (xmlhttp.responseText == "1") {
						msg("Success!","?item=3");
					} else if (xmlhttp.responseText == "2")
						msg("Duplicate Username");
					else
						msg("Some error occurred. Please try again later");
					sw();
				} else
					sw();
			}
		};

		xmlhttp.open('POST', url, true);
		xmlhttp.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
		xmlhttp.send(JSON.stringify(updatedData));
	}

	function ajax(url, params) {
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
						msg("Success!", "?item=3");
					} else if (xmlhttp.responseText == "2")
						msg("Duplicate Username");
					else
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
</script>