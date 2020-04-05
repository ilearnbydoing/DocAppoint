<?php
include("./includes/system_essentials.php");
include("./includes/validators/validateLoggedUser.php");
include("./includes/validators/restrictDoctors.php"); 
if (isset($_SESSION[md5("SearchingForDoctors")])) {
	if (($_SESSION[md5("SearchingForDoctors")]) == true) {
		$location = $_SESSION[md5("location")];
		$speciality = $_SESSION[md5("speciality")];
		$total = 0;
		$query = "SELECT COUNT(*) as total FROM users,user_profile where (user_profile.specialities like '%" . strtolower($speciality) . "%') and (users.city like '%" . strtolower($location) . "%') and users.user_type_id=2 and users.status=1 and users.user_profile_id=user_profile.user_profile_id";
		$result = $conn->query($query);
		if ($result->num_rows > 0) {
			if ($row = $result->fetch_assoc()) {
				$total = $row["total"];
			}
		}
	}
	else
	{
		unset($_SESSION[md5("SearchingForDoctors")]);
	}
}
else
{
	unset($_SESSION[md5("SearchingForDoctors")]);
}
if (isset($_POST[session_id()])) {
	if ($_POST[session_id()] == md5(session_id())) {
		$location = addslashes(trim($_POST["location"]));
		$speciality = addslashes(trim($_POST["doctor"]));
		$_SESSION[md5("SearchingForDoctors")] = true;
		$_SESSION[md5("location")] = addslashes(trim($_POST["location"]));
		$_SESSION[md5("speciality")] = addslashes(trim($_POST["doctor"]));
		header("Refresh:0");
		exit(0);
	} else {
		header("Location: ./");
	}
}
?>
<html lang="en">

<head>
	<title>DocAppoint - Harsh Thakkar Project (1959894)</title>
	<?php include("./includes/metadata.php"); ?>
	<?php include("./includes/icons.php"); ?>
	<?php include("./includes/styling.php"); ?>
</head>

<body>

	
	<div class="main-wrapper">

		<?php include("./includes/header.php"); ?>

		<!-- Breadcrumb -->
		<div class="breadcrumb-bar">
			<div class="container-fluid">
				<div class="row align-items-center">
					<div class="col-md-8 col-12">
						<nav aria-label="breadcrumb" class="page-breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="./">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Search</li>
							</ol>
						</nav>
						<h2 class="breadcrumb-title"><?php echo $total; ?> matches found for : <?php echo $speciality; ?> In <?php echo  $location; ?></h2>
					</div>
					<div class="col-md-4 col-12 d-md-block d-none">
						<div class="sort-by">
							<span class="sort-title">Sort by</span>
							<span class="sortby-fliter">
								<select class="select">
									<option selected class="sorting">Recommended</option>
									<option class="sorting">Rating</option>
									<option class="sorting">Price</option>
								</select>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		

		
		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">
						
						<div class="card search-filter">
							<div class="card-header">
								<h4 class="card-title mb-0">Search Filter</h4>
							</div>
							<div class="card-body">
								<div class="filter-widget">
									<div class="cal-icon">
										<input type="text" class="form-control datetimepicker" placeholder="Select Date">
									</div>
								</div>
								<div class="filter-widget">
									<h4>Gender</h4>
									<div>
										<label class="custom_check">
											<input type="checkbox" name="gender_type" checked>
											<span class="checkmark"></span> Male Doctor
										</label>
									</div>
									<div>
										<label class="custom_check">
											<input type="checkbox" name="gender_type">
											<span class="checkmark"></span> Female Doctor
										</label>
									</div>
								</div>
								<div class="filter-widget">
									<h4>Select Specialist</h4>
									<div>
										<label class="custom_check">
											<input type="checkbox" name="select_specialist" checked>
											<span class="checkmark"></span> Urology
										</label>
									</div>
									<div>
										<label class="custom_check">
											<input type="checkbox" name="select_specialist" checked>
											<span class="checkmark"></span> Neurology
										</label>
									</div>
									<div>
										<label class="custom_check">
											<input type="checkbox" name="select_specialist">
											<span class="checkmark"></span> Dentist
										</label>
									</div>
									<div>
										<label class="custom_check">
											<input type="checkbox" name="select_specialist">
											<span class="checkmark"></span> Orthopedic
										</label>
									</div>
									<div>
										<label class="custom_check">
											<input type="checkbox" name="select_specialist">
											<span class="checkmark"></span> Cardiologist
										</label>
									</div>
									<div>
										<label class="custom_check">
											<input type="checkbox" name="select_specialist">
											<span class="checkmark"></span> Cardiologist
										</label>
									</div>
								</div>
								<div class="btn-search">
									<button type="button" class="btn btn-block">Search</button>
								</div>
							</div>
						</div>
						

					</div>

					<div class="col-md-12 col-lg-8 col-xl-9">

						<?php
						$location = $_SESSION[md5("location")];
						$speciality = $_SESSION[md5("speciality")];
						$feedbacktotal = 0;
						$query = "SELECT * FROM users,user_profile, feedback where feedback.feedback_id=user_profile.feedback_id and (user_profile.specialities like '%" . strtolower($speciality) . "%') and (users.city like '%" . strtolower($location) . "%') and users.user_type_id=2 and users.status=1  and users.user_profile_id=user_profile.user_profile_id";
						$result = $conn->query($query);
						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								$specialities = array_unique(array_filter(preg_split("/\,/", trim($row["specialities"]))));
								$printSpecialities = "";
								foreach ($specialities as $i) {
									$printSpecialities .= ucwords($i) . "<br>";
								}
								
								$days = array_filter(preg_split("/\,/", trim($row["business_hours"])));
								$mon=strtolower(trim($days[0]))==strtolower(trim("Closed"))?"<span style='margin:2px;color:white;background-color:#F32013'>Monday: ".$days[0]."</span>":"<span style='margin:2px;'>Monday: ".$days[0]."</span>";
								$tue=strtolower(trim($days[1]))==strtolower(trim("Closed"))?"<span style='margin:2px;color:white;background-color:#F32013'>Tuesday: ".$days[1]."</span>":"<span style='margin:2px;'>Tuesday: ".$days[1]."</span>";
								$wed=strtolower(trim($days[2]))==strtolower(trim("Closed"))?"<span style='margin:2px;color:white;background-color:#F32013'>Wednesday: ".$days[2]."</span>":"<span style='margin:2px;'>Wednesday: ".$days[2]."</span>";
								$thurs=strtolower(trim($days[3]))==strtolower(trim("Closed"))?"<span style='margin:2px;color:white;background-color:#F32013'>Thursday: ".$days[3]."</span>":"<span style='margin:2px;'>Thursday: ".$days[3]."</span>";
								$fri=strtolower(trim($days[4]))==strtolower(trim("Closed"))?"<span style='margin:2px;color:white;background-color:#F32013'>Friday: ".$days[4]."</span>":"<span style='margin:2px;'>Friday: ".$days[4]."</span>";
								$sat=strtolower(trim($days[5]))==strtolower(trim("Closed"))?"<span style='margin:2px;color:white;background-color:#F32013'>Saturday: ".$days[5]."</span>":"<span style='margin:2px;'>Saturday: ".$days[5]."</span>";
								$sun=strtolower(trim($days[6]))==strtolower(trim("Closed"))?"<span style='margin:2px;color:white;background-color:#F32013'>Sunday: ".$days[6]."</span>":"<span style='margin:2px;'>Sunday: ".$days[6]."</span>";
								$feedbackquery = "SELECT count(*) as feedbacktotal FROM feedback where feedback.to_doctor_id=" . $row["user_id"];
								$feedbackresult = $conn->query($feedbackquery);
								if($feedbackresult->num_rows > 0) {
									if ($feedbackrow = $feedbackresult->fetch_assoc()) {
										$feedbacktotal = $feedbackrow["feedbacktotal"];
									}
								}

								echo '<!-- Doctor Section -->
								<div class="card">
									<div class="card-body">
										<div class="doctor-widget">
											<div class="doc-info-left">
												<div class="doctor-img">
													<a href="DoctorProfile.php">
														<img src="' . $row["profile_url"] . '" class="img-fluid" alt="User Image">
													</a>
												</div>
												<div class="doc-info-cont">
													<h4 class="doc-name"><a href="DoctorProfile.php?'.md5(session_id()+"id").'=' . $row["user_id"] . '">Dr. ' . $row["first_name"] . ' ' . $row["last_name"] . ' </a></h4>
													<p class="doc-speciality">' . $row["title"] . ' </p>
													<h5 class="doc-department">' . $printSpecialities . '</h5>
													<div class="rating">
														<i class="fas fa-star ' . ($row["ratings"] - 1 >= 0 ? "filled" : "") . '"></i>
														<i class="fas fa-star ' . ($row["ratings"] - 2 >= 0 ? "filled" : "") . '"></i>
														<i class="fas fa-star ' . ($row["ratings"] - 3 >= 0 ? "filled" : "") . '"></i>
														<i class="fas fa-star ' . ($row["ratings"] - 4 >= 0 ? "filled" : "") . '"></i>
														<i class="fas fa-star ' . ($row["ratings"] - 5 >= 0 ? "filled" : "") . '"></i>
														<span class="d-inline-block average-rating">(' . $row["ratings"] . '/5)</span>
													</div>
													
													<div class="clinic-services">
														'.$mon.'
														'.$tue.'
														'.$wed.'
														'.$thurs.'
														'.$fri.'
														'.$sat.'
														'.$sun.'
													</div>
												</div>
											</div>
											<div class="doc-info-right">
												<div class="clini-infos">
													<ul>
														<li><i class="far fa-thumbs-up"></i> ' . (($row["ratings"] / 5) * 100) . '%</li>
														<li><i class="far fa-comment"></i> ' . $feedbacktotal . ' Feedback</li>
														<li><i class="fas fa-map-marker-alt"></i>' . ucfirst($row["city"]) . ', ' . ucfirst($row["country"]) . '</li>
														<li><i class="far fa-money-bill-alt"></i> ' . ucfirst($row["cost"]) . ' <i class="fas fa-info-circle" data-toggle="tooltip" title="Lorem Ipsum"></i> </li>
													</ul>
												</div>
												<div class="clinic-booking">
													<a class="view-pro-btn" href="DoctorProfile.php?'.md5(session_id()+"id").'=' . $row["user_id"] . '">View Profile</a>
													<a class="apt-btn" href="booking.php?'.md5(session_id()+"id").'=' . $row["user_id"] . '">Book Appointment</a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /Doctor Section-->';
							}
						}
						else
						{
							echo " <body>
			<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
	<script src='sweetalert2.all.min.js'></script>
	<script src='https://cdn.jsdelivr.net/npm/promise-polyfill'></script>
			   <script type='text/javascript'>
			   Swal.fire({
				title: 'No Doctors Found!',
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Okay'
			  }).then(DocAppoint =>{
				 setTimeout(()=>{
					 window.location.href='./';
				 },10);
			  } )</script></body>";
						}
						?>
						
					</div>
				</div>

			</div>

		</div>
		
		<?php include("./includes/footer.php"); ?>
	</div>
	
	<?php include("./includes/scripting.php"); ?>
</body>

</html>