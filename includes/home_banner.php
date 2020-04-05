<script>
function showLocationResult(query) {
	document.getElementById("searchLocation").style.backgroundColor = "";
	document.getElementById("hintLocationText").innerHTML = "";
  if (query.length==0) {
	document.getElementById("hintLocationText").innerHTML = "Based on your Location";
    document.getElementById("liveLocationSearch").innerHTML="";
	document.getElementById("liveLocationSearch").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    xmlhttp=new XMLHttpRequest();
  } else { 
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("liveLocationSearch").innerHTML=this.responseText;
      document.getElementById("liveLocationSearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","./255e6839b3057ff68abf0fae3008401b.php?<?php echo session_id() ?>=<?php echo md5(session_id()); ?>&<?php echo md5("LocationQuery") ?>="+query,true);
  xmlhttp.send();
}

function showDoctorResult(query) {
	document.getElementById("searchDoctor").style.backgroundColor = "";
	document.getElementById("hintDoctorText").innerHTML = "";
  if (query.length==0) {
	document.getElementById("hintDoctorText").innerHTML = "Based on your Doctor";
    document.getElementById("liveDoctorSearch").innerHTML="";
	document.getElementById("liveDoctorSearch").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    xmlhttp=new XMLHttpRequest();
  } else { 
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("liveDoctorSearch").innerHTML=this.responseText;
      document.getElementById("liveDoctorSearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","./255e6839b3057ff68abf0fae3008401b.php?<?php echo session_id() ?>=<?php echo md5(session_id()); ?>&<?php echo md5("DoctorQuery") ?>="+query,true);
  xmlhttp.send();
}

function selectLocation(city, state, country)
{
	document.getElementById("searchLocation").value = city;
	document.getElementById("liveLocationSearch").innerHTML = "";
	document.getElementById("hintLocationText").innerHTML = "Searching for doctors in "+city;
	document.getElementById("liveLocationSearch").style="";
	document.getElementById("searchLocation").style.backgroundColor = "whitesmoke";
	document.getElementById("searchLocation").style.border="1px solid #ccc";
}


function selectDoctor(specilities)
{
	document.getElementById("searchDoctor").value = specilities;
	document.getElementById("liveDoctorSearch").innerHTML = "";
	document.getElementById("hintDoctorText").innerHTML = "Searching for "+specilities;
	document.getElementById("liveDoctorSearch").style="";
	document.getElementById("searchDoctor").style.backgroundColor = "whitesmoke";
	document.getElementById("searchDoctor").style.border="1px solid #ccc";
}
</script>
<section class="section section-search">
			<div class="container-fluid">
				<div class="banner-wrapper">
					<div class="banner-header text-center">
						<h1>Search Doctor, Make an Appointment</h1>
						<p>Discover the best doctors, clinic & hospital the city nearest to you.</p>
					</div>

					<div class="search-box">
						<form method="post" action="search.php">
							<div class="form-group search-location">
								<input autocomplete="off" id="searchLocation" onkeyup="showLocationResult(this.value)" required type="text" name="location" class="form-control" placeholder="Search Location">
								<div id="liveLocationSearch"></div>
								<span id="hintLocationText" class="form-text">Based on your Location</span>
							</div>
							<div class="form-group search-info">
								<input autocomplete="off" id="searchDoctor" onkeyup="showDoctorResult(this.value)" required type="text" name="doctor" class="form-control" placeholder="Search Doctors, Clinics, Hospitals, Diseases Etc">
								<div id="liveDoctorSearch"></div>
								<span id="hintDoctorText" class="form-text">Ex : Dental or Sugar Check up etc</span>
							</div>
							<input required hidden type="password" value="<?php echo md5(session_id()) ?>" name="<?php echo session_id() ?>">
							<button type="submit" class="btn btn-primary search-btn"><i class="fas fa-search"></i> <span>Search</span></button>
						</form>
					</div>
				</div>
			</div>
		</section>