<header class="w3-container w3-text-indigo" style="padding-top:22px">
	<h5><b id="title"><i class="fa fa-table"></i> Faulty Device List </b></h5>
</header>

<div class="w3-container w3-margin-bottom w3-row">
  <h2 id="heading">Faulty List</h2>
  <div class="w3-row">
	  <div class="w3-ul w3-quarter" id="id01" style="overflow-y:scroll; overflow-x:hidden; height:400px;display:none;">
		<div w3-repeat="result" class="w3-mobile" style="padding:5px;">
		  <div class="w3-bar w3-card w3-button w3-red m8-fancy" onclick="goHistory('{{Name}}','{{Time}}','{{IMEI}}')">
			<div class="" style="text-align:left!important;">
			  <span class="w3-large">{{IMEI}}</span><br>
			  <span><small><label class="tot_devices">Date: </label>{{Time}}</small></span>
			</div>
		  </div>
		</div>
	  </div>
	  <div class="w3-threequarter" style="display:none;" id="id03">
		<header class="w3-container w3-text-indigo" style="">
			<h5><b><i class="fa fa-history"></i> <lable id="log_title">Faulty Device</lable> > <lable id="log_name"></lable></b></h5>
		</header>
		<div class="w3-container">
			<div class="w3-card w3-white w3-margin-bottom w3-row m8-fancy">
				<div class="w3-row w3-color w3-center w3-padding m8-fancy">
					<div class="w3-col s6 m3 l3">
						<div><b>S.No. / D.Name</b></div>
					</div>
					<div class="w3-col s6 m3 l3">
						<div id="log_name2"></div>
					</div>
					<div class="w3-col s6 m3 l3">
						<div><b>Device IMEI</b></div>
					</div>
					<div class="w3-col s6 m3 l3">
						<div id="log_imei"></div>
					</div>
				</div>
				<div class="w3-row w3-color w3-center w3-padding m8-fancy">
					<div class="w3-col s6 m3 l3">
						<div><b>Fault Types</b></div>
					</div>
					<div class="w3-col s6 m3 l3">
						<div id="fault_names"></div>
					</div>
				</div>
				<div class="w3-container w3-padding w3-small" id="id02">
					<div class="w3-col s6 m3 l3 extraDetails" w3-repeat="result">
						<div class="{{b}}" id="{{b}}">{{a}}</div>
					</div>
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col s6 m3 l3" style="padding:5px;"><button class="w3-button w3-color m8-fancy" style="width:100%;" onclick='window.location.assign("?item=7")'><i class="fa fa-history"></i> Show Logs</button></div>
				<div class="w3-col s6 m3 l3" style="padding:5px;"><button class="w3-button w3-color m8-fancy" style="width:100%;" onclick='window.open("https://www.google.com/maps/search/?api=1&query="+locationLatLng, "_blank")'><i class="fa fa-map-marker"></i> Locate</button></div>
				<div class="w3-col s6 m3 l3" style="padding:5px;"><button class="w3-button w3-color m8-fancy" style="width:100%;" onclick='getImg();'><i class="fa fa-image"></i> Device Image</button></div>
				<div class="w3-col s6 m3 l3" style="padding:5px;"><button class="w3-button w3-color m8-fancy" style="width:100%;" onclick='window.open("/Controller/download.php?q="+w3.id("log_imei").innerHTML,"_blank");'><i class="fa fa-download"></i> Download</button></div>
			</div>
		</div>
	  </div>
  </div>
</div>

  <div id="model" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4" style="width:300px;">
      <header class="w3-container w3-color"> 
        <span onclick="document.getElementById('model').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Device Image</h2>
      </header>
      <div class="">
        <img class="w3-modal-content" src="" id="img" style="width:100%">
		<button class="w3-color w3-button w3-col s12 m12 l12" onclick="newTab()">Open Image In New tag</button>
      </div>
    </div>
  </div>

<script>
var imei = "";

w3.id("id01").style.height= (document.documentElement.clientHeight - 280) + "px";

sw();
w3.getHttpObject("../Controller/user/getFaultyList.php", myFunction2);

function myFunction2(myObject)
{
	w3.displayObject("id01", myObject);
	var len = document.getElementsByClassName("tot_devices").length;
	var len2 = document.getElementsByClassName("tot_devices")[0].parentElement.parentElement.parentElement.getElementsByTagName("span")[0].innerHTML[0];
	if(len>1 || ( len==1 && len2!="{") )
	{
		w3.id("id01").style.display="block";
	}
	else
	alert("Great!!! No Faulty Device Found");
	sw();
}

function newTab()
{
var img = w3.id("img").src;
var image = new Image();
image.src = img;

var w = window.open("");
w.document.write(image.outerHTML);
w.document.close();
}

function getImg()
{
	// sw();
	// document.getElementById('model').style.display='block';
	// get("../Controller/user/getImg.php?imei="+imei);
	// sw();
	document.getElementById('model').style.display='block';
	w3.id("img").src="../upload/images/"+imei+".jpeg";
}

function setDetails(myObject)
{
	w3.displayObject("id02", myObject);
	sw();
	get2("../Controller/user/getDetails2.php?imei="+imei);
}

function myFunction(myObject)
{
	var result = myObject.result
	result = Object.keys(result).map((key) => result[key]);
	result.sort(sortByProperty("Name"));
	myObject = JSON.parse('{"result":'+JSON.stringify(result)+'}');

	w3.displayObject("id01", myObject);
	for(var i=0;i<color.length;i++)
	w3.removeClass('.w3-card.w3-button',color[Math.floor(Math.random() * 10)]);
	w3.addClass('.w3-card.w3-button',color[Math.floor(Math.random() * 10)]);
	var str = title.innerHTML;
	str = str.slice(0,str.indexOf('<a onclick="goHistory(&quot;'+name_global))
	title.innerHTML = str+" <a onclick='goHistory(\""+name_global+"\", \""+branch_global+"\")'>"+name_global+"</a> >";
	heading.innerHTML = (tree[branch_global-1].split("_")[2]+" List").toUpperCase();
	scrollToTop();
	
	if(device_page)
	{
		var tot_devices = document.getElementsByClassName("tot_devices");
		console.log(tot_devices.length);
		for(var i=0;i<tot_devices.length;i++)
		tot_devices[i].innerHTML="Device ID: ";
		
		w3.id("id01").className += " w3-quarter";
		var div = w3.id("id01").getElementsByClassName("w3-mobile");
		for(var i=0;i<div.length;i++)
		div[i].className = "w3-mobile";
	}
	console.log(document.getElementsByClassName("tot_devices").length+", "+result.length);
	if(document.getElementsByClassName("tot_devices").length != result.length)
	{
		w3.id("id01").style.display="none";
		//w3.id("addBtnCenter").style.display="block";
	}
}

function goHistory(name, id, branch)
{

			localStorage.clear();
			localStorage.temp_name = name;
			localStorage.temp_id = id;
			localStorage.temp_imei = branch;
			
			w3.id("id03").style.display="block";
			sw();
			w3.id("log_name").innerHTML = name;
			w3.id("log_name2").innerHTML = name;
			w3.id("log_imei").innerHTML = branch;
			
			imei = branch;
			w3.getHttpObject("../Controller/user/getDetails.php?imei="+branch, setDetails);
			branch = 0;
}

function scrollToTop()
{
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

function SortByName(x,y) {
  return ((x.Name == y.Name) ? 0 : ((x.Name > y.Name) ? 1 : -1 ));
}

function sortByProperty(property){  
   return function(a,b){  
      if(a[property] > b[property])  
         return 1;  
      else if(a[property] < b[property])  
         return -1;  
  
      return 0;  
   }  
}

function get2(url) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
  var res = this.responseText;
	var r = JSON.parse(res);
	console.log('the get2 details are', r);
	locationLatLng = r.locationLatLng;
	try{
		w3.id("onTime").innerHTML=r.onTime;
		w3.id("offTime").innerHTML=r.offTime;
		w3.id("Bfault").innerHTML=r.Bfault;
		w3.id("Pfault").innerHTML=r.Pfault;
		w3.id("fault").innerHTML=r.fault;
		w3.id("resolved").innerHTML=r.resolved;	
		
		var batt_status = document.getElementById('battery-fault');
			if (r['battery-fault'] == "1") {
				batt_status.className = "fa fa-circle w3-text-red";
				batt_status.innerHTML = " ERR";
			} else {
				batt_status.className = "fa fa-circle w3-text-green";
				batt_status.innerHTML = " OK";
			}
			var panel_status = document.getElementById('panel-fault');
			if (r['panel-fault'] == "1") {
				panel_status.className = "fa fa-circle w3-text-red";
				panel_status.innerHTML = " ERR";
			} else {
				panel_status.className = "fa fa-circle w3-text-green";
				panel_status.innerHTML = " OK";
			}
			var lumi_status = document.getElementById('luminary-fault');
			if (r['luminary-fault'] == "1") {
				lumi_status.className = "fa fa-circle w3-text-red";
				lumi_status.innerHTML = " ERR";
			} else {
				lumi_status.className = "fa fa-circle w3-text-green";
				lumi_status.innerHTML = " OK";
			}
			var sys_status = document.getElementById('system-status');
			if (r['battery-fault'] == "1" || r['panel-fault'] == "1" || r['luminary-fault'] == "1") {
				sys_status.className = "fa fa-circle w3-text-red";
				sys_status.innerHTML = " ERR";
			} else {
				sys_status.className = "fa fa-circle w3-text-green";
				sys_status.innerHTML = " OK";
			}

	}catch(e){
		console.log('the error catched is', e);
	}
  }
  xhttp.open("GET", url);
  xhttp.send();
}
</script>
