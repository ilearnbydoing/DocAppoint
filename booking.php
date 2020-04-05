<?php
include("./includes/system_essentials.php");
include("./includes/validators/validateLoggedUser.php");
include("./includes/validators/restrictDoctors.php");
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if(isset($_GET[md5('proceed')]))
{
	if($_GET[md5('proceed')]==md5(session_id()."proceed"))
	{
		if(($_SESSION["selected_date"]!="") and ($_SESSION["selected_time"]!="") and ($_SESSION["selected_period"]!=""))
		{
			header("Location: ./checkout.php");
		}
		else
		{
			echo " <body>
						<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
						<script src='sweetalert2.all.min.js'></script>
						<script src='https://cdn.jsdelivr.net/npm/promise-polyfill'></script>
						   <script type='text/javascript'>
						   Swal.fire({
							title: 'Date & Time Required!',
							text: 'You need to select appointment date and time to proceed.',
							icon: 'warning',
							showCancelButton: false,
							confirmButtonColor: '#3085d6',
							confirmButtonText: 'Okay'
						  }).then(DocAppoint =>{
							 setTimeout(()=>{
								window.location.href='./booking.php?" . md5(session_id() + "id") . "=" . $_SESSION[md5("selected_dr_id")] . "';
							 },10);
						  } )</script></body>";
		}
	}
	else
	{
		header("Location: ./booking.php?" . md5(session_id() + "id") . "=" . $_SESSION[md5("selected_dr_id")] . "");
	}
}

if (isset($_GET[md5(session_id() . "date")]) and isset($_GET[md5(session_id() . "day")]) and isset($_GET[md5(session_id() . 'time')]) and isset($_GET[md5(session_id() . "period")])) {
	if ($_GET[md5(session_id() . "day")] == md5(session_id() . "monday")) {
		if ($_GET[md5(session_id() . "period")] == md5("AM")) {
			$_SESSION["selected_period"] = "AM";
			$_SESSION["selected_day"] = "monday";
			$_SESSION["selected_date"] = $_GET[md5(session_id() . "date")];
			$_SESSION["selected_time"] = $_GET[md5(session_id() . 'time')];
		} else {
			$_SESSION["selected_period"] = "PM";
			$_SESSION["selected_day"] = "monday";
			$_SESSION["selected_date"] = $_GET[md5(session_id() . "date")];
			$_SESSION["selected_time"] = $_GET[md5(session_id() . 'time')];
		}
	} else if ($_GET[md5(session_id() . "day")] == md5(session_id() . "tuesday")) {
		if ($_GET[md5(session_id() . "period")] == md5("AM")) {
			$_SESSION["selected_period"] = "AM";
			$_SESSION["selected_day"] = "tuesday";
			$_SESSION["selected_date"] = $_GET[md5(session_id() . "date")];
			$_SESSION["selected_time"] = $_GET[md5(session_id() . 'time')];
		} else {
			$_SESSION["selected_period"] = "PM";
			$_SESSION["selected_day"] = "tuesday";
			$_SESSION["selected_date"] = $_GET[md5(session_id() . "date")];
			$_SESSION["selected_time"] = $_GET[md5(session_id() . 'time')];
		}
	} else if ($_GET[md5(session_id() . "day")] == md5(session_id() . "wednesday")) {
		if ($_GET[md5(session_id() . "period")] == md5("AM")) {
			$_SESSION["selected_period"] = "AM";
			$_SESSION["selected_day"] = "wednesday";
			$_SESSION["selected_date"] = $_GET[md5(session_id() . "date")];
			$_SESSION["selected_time"] = $_GET[md5(session_id() . 'time')];
		} else {
			$_SESSION["selected_period"] = "PM";
			$_SESSION["selected_day"] = "wednesday";
			$_SESSION["selected_date"] = $_GET[md5(session_id() . "date")];
			$_SESSION["selected_time"] = $_GET[md5(session_id() . 'time')];
		}
	} else if ($_GET[md5(session_id() . "day")] == md5(session_id() . "thursday")) {
		if ($_GET[md5(session_id() . "period")] == md5("AM")) {
			$_SESSION["selected_period"] = "AM";
			$_SESSION["selected_day"] = "thursday";
			$_SESSION["selected_date"] = $_GET[md5(session_id() . "date")];
			$_SESSION["selected_time"] = $_GET[md5(session_id() . 'time')];
		} else {
			$_SESSION["selected_period"] = "PM";
			$_SESSION["selected_day"] = "thursday";
			$_SESSION["selected_date"] = $_GET[md5(session_id() . "date")];
			$_SESSION["selected_time"] = $_GET[md5(session_id() . 'time')];
		}
	} else if ($_GET[md5(session_id() . "day")] == md5(session_id() . "friday")) {
		if ($_GET[md5(session_id() . "period")] == md5("AM")) {
			$_SESSION["selected_period"] = "AM";
			$_SESSION["selected_day"] = "friday";
			$_SESSION["selected_date"] = $_GET[md5(session_id() . "date")];
			$_SESSION["selected_time"] = $_GET[md5(session_id() . 'time')];
		} else {
			$_SESSION["selected_period"] = "PM";
			$_SESSION["selected_day"] = "friday";
			$_SESSION["selected_date"] = $_GET[md5(session_id() . "date")];
			$_SESSION["selected_time"] = $_GET[md5(session_id() . 'time')];
		}
	} else if ($_GET[md5(session_id() . "day")] == md5(session_id() . "saturday")) {
		if ($_GET[md5(session_id() . "period")] == md5("AM")) {
			$_SESSION["selected_period"] = "AM";
			$_SESSION["selected_day"] = "saturday";
			$_SESSION["selected_date"] = $_GET[md5(session_id() . "date")];
			$_SESSION["selected_time"] = $_GET[md5(session_id() . 'time')];
		} else {
			$_SESSION["selected_period"] = "PM";
			$_SESSION["selected_day"] = "saturday";
			$_SESSION["selected_date"] = $_GET[md5(session_id() . "date")];
			$_SESSION["selected_time"] = $_GET[md5(session_id() . 'time')];
		}
	} else if ($_GET[md5(session_id() . "day")] == md5(session_id() . "sunday")) {
		if ($_GET[md5(session_id() . "period")] == md5("AM")) {
			$_SESSION["selected_period"] = "AM";
			$_SESSION["selected_day"] = "sunday";
			$_SESSION["selected_date"] = $_GET[md5(session_id() . "date")];
			$_SESSION["selected_time"] = $_GET[md5(session_id() . 'time')];
		} else {
			$_SESSION["selected_period"] = "PM";
			$_SESSION["selected_day"] = "sunday";
			$_SESSION["selected_date"] = $_GET[md5(session_id() . "date")];
			$_SESSION["selected_time"] = $_GET[md5(session_id() . 'time')];
		}
	}
	header("Location: ./booking.php?" . md5(session_id() + "id") . "=" . $_SESSION[md5("selected_dr_id")] . "");
}

if (!isset($_SESSION["selected_date"]) and !isset($_SESSION["selected_period"]) and !isset($_SESSION["selected_day"]) and !isset($_SESSION["selected_time"])) {
	$_SESSION["selected_period"] = "";
	$_SESSION["selected_day"] = "";
	$_SESSION["selected_date"] = "";
	$_SESSION["selected_time"] = "";
}


if (isset($_GET[md5("nextPage")])) {
	if ($_GET[md5("nextPage")] == md5("true")) {
		$_SESSION[md5(session_id() . "" . "nextDate")] = md5("active");
		$_SESSION["addOne"] = 1;
		$_SESSION["subOne"] = 0;
		header("Location: ./booking.php?" . md5(session_id() + "id") . "=" . $_SESSION[md5("selected_dr_id")] . "");
	}
}

if (isset($_GET[md5("previousPage")])) {
	if ($_GET[md5("previousPage")] == md5("true")) {
		$_SESSION[md5(session_id() . "" . "previousDate")] = md5("active");
		$_SESSION["addOne"] = 0;
		$_SESSION["subOne"] = 1;
		header("Location: ./booking.php?" . md5(session_id() + "id") . "=" . $_SESSION[md5("selected_dr_id")] . "");
	}
}

if (isset($_SESSION[md5(session_id() . "" . "nextDate")])) {
	$_SESSION["counter"] = ($_SESSION["counter"] + $_SESSION["addOne"]) - ($_SESSION["subOne"]);
	if ($_SESSION["counter"] < 0) {
		$_SESSION["counter"] = 0;
	}
	unset($_SESSION[md5(session_id() . "" . "nextDate")]);
} else {
	unset($_SESSION[md5(session_id() . "" . "nextDate")]);
}
if (isset($_SESSION[md5(session_id() . "" . "previousDate")])) {
	$_SESSION["counter"] = ($_SESSION["counter"] + $_SESSION["addOne"]) - ($_SESSION["subOne"]);
	unset($_SESSION[md5(session_id() . "" . "previousDate")]);
	if ($_SESSION["counter"] < 0) {
		$_SESSION["counter"] = 0;
	}
} else {
	unset($_SESSION[md5(session_id() . "" . "previousDate")]);
}
if (!isset($_SESSION["counter"])) {
	$_SESSION["counter"] = 0;
}
if (isset($_GET[md5(session_id() + "id")])) {
	$_SESSION[md5("selected_dr_id")] = $_GET[md5(session_id() + "id")];
	$query = "SELECT * FROM users,user_profile,feedback where  users.user_id=" . $_GET[md5(session_id() + "id")] . " and users.user_type_id=2 and users.status=1 and users.user_profile_id=user_profile.user_profile_id";
	$result = $conn->query($query);
	if ($result->num_rows > 0) {
		if ($row = $result->fetch_assoc()) {
			$specialities = array_unique(array_filter(preg_split("/\,/", trim($row["specialities"]))));
			$printSpecialities = "";
			foreach ($specialities as $i) {
				$printSpecialities .= ucwords($i) . "<br>";
			}

			$result = $conn->query($query);
			if ($result->num_rows > 0) {
				if ($row = $result->fetch_assoc()) {
				}
			}
			$businessHours = [];

			$days = array_filter(preg_split("/\,/", trim($row["business_hours"])));
			$mon = $tue = $wed = $thurs = $fri = $sat = $sun = [];
			if (trim($days[0]) != "Closed") {
				$mon = array_filter(preg_split("/\ - /", trim($days[0])));
			}

			if (trim($days[1]) != "Closed") {
				$tue = array_filter(preg_split("/\ - /", trim($days[1])));
			}

			if (trim($days[2]) != "Closed") {
				$wed = array_filter(preg_split("/\ - /", trim($days[2])));
			}

			if (trim($days[3]) != "Closed") {
				$thurs = array_filter(preg_split("/\ - /", trim($days[3])));
			}

			if (trim($days[4]) != "Closed") {
				$fri = array_filter(preg_split("/\ - /", trim($days[4])));
			}

			if (trim($days[5]) != "Closed") {
				$sat = array_filter(preg_split("/\ - /", trim($days[5])));
			}

			if (trim($days[6]) != "Closed") {
				$sun = array_filter(preg_split("/\ - /", trim($days[6])));
			}
		}
	}
	else
	{
	exit(0);	
	}
} else {
	exit(0);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>DocAppoint - Harsh Thakkar Project (1959894)</title>
	<?php include("./includes/metadata.php"); ?>
	<?php include("./includes/icons.php"); ?>
	<?php include("./includes/styling.php"); ?>
</head>
<body class="account-page">
	<div class="main-wrapper">
		<?php include("./includes/header.php"); ?>
		<div class="breadcrumb-bar">
			<div class="container-fluid">
				<div class="row align-items-center">
					<div class="col-md-12 col-12">
						<nav aria-label="breadcrumb" class="page-breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Booking</li>
							</ol>
						</nav>
						<h2 class="breadcrumb-title">Booking</h2>
					</div>
				</div>
			</div>
		</div>
		<div class="content">
			<div class="container">

				<div class="row">
					<div class="col-12">

						<div class="card">
							<div class="card-body">
								<div class="booking-doc-info">
									<a href="DoctorProfile.php?<?php echo md5(session_id() + "id") . "=" . $_SESSION[md5("selected_dr_id")] ?>" class="booking-doc-img">
										<img src="<?php echo ucfirst($row["profile_url"]) ?>" alt="User Image">
									</a>
									<div class="booking-info">
										<h4><a href="DoctorProfile.php?<?php echo md5(session_id() + "id") . "=" . $_SESSION[md5("selected_dr_id")] ?>">Dr. <?php echo ucfirst($row["first_name"]) ?> <?php echo ucfirst($row["last_name"]) ?></a></h4>
										<?php

										echo '<div class="rating">
											<i class="fas fa-star ' . ($row["ratings"] - 1 >= 0 ? "filled" : "") . '"></i>
											<i class="fas fa-star ' . ($row["ratings"] - 2 >= 0 ? "filled" : "") . '"></i>
											<i class="fas fa-star ' . ($row["ratings"] - 3 >= 0 ? "filled" : "") . '"></i>
											<i class="fas fa-star ' . ($row["ratings"] - 4 >= 0 ? "filled" : "") . '"></i>
											<i class="fas fa-star ' . ($row["ratings"] - 5 >= 0 ? "filled" : "") . '"></i>
											<span class="d-inline-block average-rating">(' . $row["ratings"] . '/5)</span>
										</div>';
										?>
										<p class="text-muted mb-0"><i class="fas fa-map-marker-alt"></i> <?php echo ucfirst($row["city"]) ?>, <?php echo ucfirst($row["country"]) ?></p>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-sm-4 col-md-6">
								<h4 class="mb-1">Today is <?php echo date("M j, Y"); ?></h4>
								<p class="text-muted"><?php echo ucfirst(date('l')); ?></p>
							</div>
							<?php
							if(($_SESSION["selected_date"]!="") and ($_SESSION["selected_time"]!="") and ($_SESSION["selected_period"]!=""))
							{
								echo '<div class="col-12 col-sm-8 col-md-6 text-sm-right">
								<div class="bookingrange btn btn-white btn-sm mb-3">
									<i class="far fa-calendar-alt mr-2"></i>
									<span>Date Selected: '.$_SESSION["selected_date"] .", ". $_SESSION["selected_time"]." ".'</span>
									<i class="fas fa-chevron-down ml-2"></i>
								</div>
							</div>';
							}
							?>
						</div>
						<!-- Schedule Widget -->
						<div class="card booking-schedule schedule-widget">

							<!-- Schedule Header -->
							<div class="schedule-header">
								<div class="row">
									<div class="col-md-12">

										<!-- Day Slot -->
										<div class="day-slot">
											<ul>
												<li class="left-arrow">
													<a href="<?php echo $actual_link . "&" . md5("previousPage") . "=" . md5("true") ?>">
														<i class="fa fa-chevron-left"></i>
													</a>
												</li>
												<?php
												$date = new DateTime();
												$dayCounter = 1 + ($_SESSION["counter"]);
												$date->modify('+' . $dayCounter . ' day');
												for ($i = 0; $i < 7; $i++) {

													echo '<li>
													<span>' . strtoupper($date->format("l")) . '</span>
													<span class="slot-date">' . strtoupper($date->format("j M Y")) . '</small></span>
												</li>';
													$date->modify('+1 day');
												}
												?>
												<li class="right-arrow">
													<a href="<?php echo $actual_link . "&" . md5("nextPage") . "=" . md5("true") ?>">
														<i class="fa fa-chevron-right"></i>
													</a>
												</li>
											</ul>
										</div>
										<!-- /Day Slot -->

									</div>
								</div>
							</div>
							<!-- /Schedule Header -->

							<!-- Schedule Content -->
							<div class="schedule-cont">
								<div class="row">
									<div class="col-md-12">

										<!-- Time Slot -->
										<div class="time-slot">
											<ul class="clearfix">
												<?php
												$date = new DateTime();
												$dayCounter = 1 + ($_SESSION["counter"]);
												$date->modify('+' . $dayCounter . ' day');
												for ($j = 0; $j < 7; $j++) {
													echo '<li>';
													if (strtolower($date->format("l")) == "monday") {
														if (count($mon) == 0) {
															echo '<a class="timing bg-danger-light"> Closed</a>';
														} else {
															$mon[0] = str_replace(" ", "", str_replace(":00", "", str_replace("AM", "", $mon[0])));
															$mon[1] = 12 + (str_replace(" ", "", str_replace(":00", "", str_replace("PM", "", $mon[1]))));
															for ($i = 0; $i <= ($mon[1] - $mon[0]); $i++) {
																if ((($mon[0]) + ($i)) > 12) {
																	$selected = ($_SESSION["selected_period"] == "PM" && $_SESSION["selected_date"] == $date->format("j M Y") && $_SESSION["selected_day"] == "monday" && $_SESSION["selected_time"] == date("h:i A" ,strtotime($mon[0] + $i.":00"))) ? "selected" : "";
																	echo '<a class="timing ' . $selected . '" href="' . $actual_link . '&' . md5(session_id() . "date") . "=" . $date->format("j M Y") . '&' . md5(session_id() . "day") . '=' . md5(session_id() . "monday") . '&' . md5(session_id() . 'time') . '=' . (date("h:i A" ,strtotime($mon[0] + $i.":00"))) . '&' . md5(session_id() . "period") . '=' . md5("PM") . '"><span>' . date("h:i A" ,strtotime($mon[0] + $i.":00")) . '</span> </a>';
																} else {
																	$selected = ($_SESSION["selected_period"] == "AM" && $_SESSION["selected_date"] == $date->format("j M Y") && $_SESSION["selected_day"] == "monday" && $_SESSION["selected_time"] == ((($mon[0]) + ($i)))) ? "selected" : "";
																	echo '<a class="timing ' . $selected . '" href="' . $actual_link . '&' . md5(session_id() . "date") . "=" . $date->format("j M Y") . '&' . md5(session_id() . "day") . '=' . md5(session_id() . "monday") . '&' . md5(session_id() . 'time') . '=' . date("h:i A" ,strtotime($mon[0] + $i.":00")) . '&' . md5(session_id() . "period") . '=' . md5("AM") . '"><span>' . (date("h:i A" ,strtotime($mon[0] + $i.":00"))) . '</span> </a>';
																}
															}
														}
													} else if (strtolower($date->format("l")) == "tuesday") {
														if (count($tue) == 0) {
															echo '<a class="timing bg-danger-light"> Closed</a>';
														} else {
															$tue[0] = str_replace(" ", "", str_replace(":00", "", str_replace("AM", "", $tue[0])));
															$tue[1] = 12 + (str_replace(" ", "", str_replace(":00", "", str_replace("PM", "", $tue[1]))));
															for ($i = 0; $i <= ($tue[1] - $tue[0]); $i++) {
																if ((($tue[0]) + ($i)) > 12) {
																	$selected = ($_SESSION["selected_period"] == "PM" && $_SESSION["selected_date"] == $date->format("j M Y") && $_SESSION["selected_day"] == "tuesday" && $_SESSION["selected_time"] == date("h:i A" ,strtotime($tue[0] + $i.":00"))) ? "selected" : "";
																	echo '<a class="timing ' . $selected . '" href="' . $actual_link . '&' . md5(session_id() . "date") . "=" . $date->format("j M Y") . '&' . md5(session_id() . "day") . '=' . md5(session_id() . "tuesday") . '&' . md5(session_id() . 'time') . '=' . date("h:i A" ,strtotime($tue[0] + $i.":00")) . '&' . md5(session_id() . "period") . '=' . md5("PM") . '"><span>' .date("h:i A" ,strtotime($tue[0] + $i.":00")). '</span></a>';
																} else {
																	$selected = ($_SESSION["selected_period"] == "AM" && $_SESSION["selected_date"] == $date->format("j M Y") && $_SESSION["selected_day"] == "tuesday" && $_SESSION["selected_time"] == date("h:i A" ,strtotime($tue[0] + $i.":00"))) ? "selected" : "";
																	echo '<a class="timing ' . $selected . '" href="' . $actual_link . '&' . md5(session_id() . "date") . "=" . $date->format("j M Y") . '&' . md5(session_id() . "day") . '=' . md5(session_id() . "tuesday") . '&' . md5(session_id() . 'time') . '=' . date("h:i A" ,strtotime($tue[0] + $i.":00")) . '&' . md5(session_id() . "period") . '=' . md5("AM") . '"><span>' . date("h:i A" ,strtotime($tue[0] + $i.":00")). '</span></a>';
																}
															}
														}
													} else if (strtolower($date->format("l")) == "wednesday") {
														if (count($wed) == 0) {
															echo '<a class="timing bg-danger-light"> Closed</a>';
														} else {
															$wed[0] = str_replace(" ", "", str_replace(":00", "", str_replace("AM", "", $wed[0])));
															$wed[1] = 12 + (str_replace(" ", "", str_replace(":00", "", str_replace("PM", "", $wed[1]))));
															for ($i = 0; $i <= ($wed[1] - $wed[0]); $i++) {
																if ((($wed[0]) + ($i)) > 12) {
																	$selected = ($_SESSION["selected_period"] == "PM" && $_SESSION["selected_date"] == $date->format("j M Y") && $_SESSION["selected_day"] == "wednesday" && $_SESSION["selected_time"] ==  date("h:i A" ,strtotime($wed[0] + $i.":00"))) ? "selected" : "";
																	echo '<a class="timing ' . $selected . '" href="' . $actual_link . '&' . md5(session_id() . "date") . "=" . $date->format("j M Y") . '&' . md5(session_id() . "day") . '=' . md5(session_id() . "wednesday") . '&' . md5(session_id() . 'time') . '=' . date("h:i A" ,strtotime($wed[0] + $i.":00")) . '&' . md5(session_id() . "period") . '=' . md5("PM") . '"><span>' . date("h:i A" ,strtotime($wed[0] + $i.":00")) . '</span></a>';
																} else {
																	$selected = ($_SESSION["selected_period"] == "AM" && $_SESSION["selected_date"] == $date->format("j M Y") && $_SESSION["selected_day"] == "wednesday" && $_SESSION["selected_time"] ==  date("h:i A" ,strtotime($wed[0] + $i.":00"))) ? "selected" : "";
																	echo '<a class="timing ' . $selected . '" href="' . $actual_link . '&' . md5(session_id() . "date") . "=" . $date->format("j M Y") . '&' . md5(session_id() . "day") . '=' . md5(session_id() . "wednesday") . '&' . md5(session_id() . 'time') . '=' . date("h:i A" ,strtotime($wed[0] + $i.":00")). '&' . md5(session_id() . "period") . '=' . md5("AM") . '"><span>' .  date("h:i A" ,strtotime($wed[0] + $i.":00")) . '</span></a>';
																}
															}
														}
													} else if (strtolower($date->format("l")) == "thursday") {
														if (count($thurs) == 0) {
															echo '<a class="timing bg-danger-light"> Closed</a>';
														} else {
															$thurs[0] = str_replace(" ", "", str_replace(":00", "", str_replace("AM", "", $thurs[0])));
															$thurs[1] = 12 + (str_replace(" ", "", str_replace(":00", "", str_replace("PM", "", $thurs[1]))));
															for ($i = 0; $i <= ($thurs[1] - $thurs[0]); $i++) {
																if ((($thurs[0]) + ($i)) > 12) {
																	$selected = ($_SESSION["selected_period"] == "PM" && $_SESSION["selected_date"] == $date->format("j M Y") && $_SESSION["selected_day"] == "thursday" && $_SESSION["selected_time"] == date("h:i A" ,strtotime($thurs[0] + $i.":00"))) ? "selected" : "";
																	echo '<a class="timing ' . $selected . '" href="' . $actual_link . '&' . md5(session_id() . "date") . "=" . $date->format("j M Y") . '&' . md5(session_id() . "day") . '=' . md5(session_id() . "thursday") . '&' . md5(session_id() . 'time') . '=' . date("h:i A" ,strtotime($thurs[0] + $i.":00")) . '&' . md5(session_id() . "period") . '=' . md5("PM") . '"><span>' . date("h:i A" ,strtotime($thurs[0] + $i.":00")) . '</span></a>';
																} else {
																	$selected = ($_SESSION["selected_period"] == "AM" && $_SESSION["selected_date"] == $date->format("j M Y") && $_SESSION["selected_day"] == "thursday" && $_SESSION["selected_time"] == date("h:i A" ,strtotime($thurs[0] + $i.":00"))) ? "selected" : "";
																	echo '<a class="timing ' . $selected . '" href="' . $actual_link . '&' . md5(session_id() . "date") . "=" . $date->format("j M Y") . '&' . md5(session_id() . "day") . '=' . md5(session_id() . "thursday") . '&' . md5(session_id() . 'time') . '=' . date("h:i A" ,strtotime($thurs[0] + $i.":00")) . '&' . md5(session_id() . "period") . '=' . md5("AM") . '"><span>' .date("h:i A" ,strtotime($thurs[0] + $i.":00")) . '</span></a>';
																}
															}
														}
													} else if (strtolower($date->format("l")) == "friday") {
														if (count($fri) == 0) {
															echo '<a class="timing bg-danger-light"> Closed</a>';
														} else {
															$fri[0] = str_replace(" ", "", str_replace(":00", "", str_replace("AM", "", $fri[0])));
															$fri[1] = 12 + (str_replace(" ", "", str_replace(":00", "", str_replace("PM", "", $fri[1]))));
															for ($i = 0; $i <= ($fri[1] - $fri[0]); $i++) {
																if ((($fri[0]) + ($i)) > 12) {
																	$selected = ($_SESSION["selected_period"] == "PM" && $_SESSION["selected_date"] == $date->format("j M Y") && $_SESSION["selected_day"] == "friday" && $_SESSION["selected_time"] == date("h:i A" ,strtotime($fri[0] + $i.":00"))) ? "selected" : "";
																	echo '<a class="timing ' . $selected . '" href="' . $actual_link . '&' . md5(session_id() . "date") . "=" . $date->format("j M Y") . '&' . md5(session_id() . "day") . '=' . md5(session_id() . "friday") . '&' . md5(session_id() . 'time') . '=' .date("h:i A" ,strtotime($fri[0] + $i.":00")) . '&' . md5(session_id() . "period") . '=' . md5("PM") . '"><span>' .date("h:i A" ,strtotime($fri[0] + $i.":00")) . '</span></a>';
																} else {
																	$selected = ($_SESSION["selected_period"] == "AM" && $_SESSION["selected_date"] == $date->format("j M Y") && $_SESSION["selected_day"] == "friday" && $_SESSION["selected_time"] == date("h:i A" ,strtotime($fri[0] + $i.":00"))) ? "selected" : "";
																	echo '<a class="timing ' . $selected . '" href="' . $actual_link . '&' . md5(session_id() . "date") . "=" . $date->format("j M Y") . '&' . md5(session_id() . "day") . '=' . md5(session_id() . "friday") . '&' . md5(session_id() . 'time') . '=' . date("h:i A" ,strtotime($fri[0] + $i.":00")) . '&' . md5(session_id() . "period") . '=' . md5("AM") . '"><span>' .date("h:i A" ,strtotime($fri[0] + $i.":00")). '</span></a>';
																}
															}
														}
													} else if (strtolower($date->format("l")) == "saturday") {
														if (count($sat) == 0) {
															echo '<a class="timing bg-danger-light"> Closed</a>';
														} else {
															$sat[0] = str_replace(" ", "", str_replace(":00", "", str_replace("AM", "", $sat[0])));
															$sat[1] = 12 + (str_replace(" ", "", str_replace(":00", "", str_replace("PM", "", $sat[1]))));
															for ($i = 0; $i <= ($sat[1] - $sat[0]); $i++) {
																if ((($sat[0]) + ($i)) > 12) {
																	$selected = ($_SESSION["selected_period"] == "PM" && $_SESSION["selected_date"] == $date->format("j M Y") && $_SESSION["selected_day"] == "saturday" && $_SESSION["selected_time"] == date("h:i A" ,strtotime($sat[0] + $i.":00"))) ? "selected" : "";
																	echo '<a class="timing ' . $selected . '" href="' . $actual_link . '&' . md5(session_id() . "date") . "=" . $date->format("j M Y") . '&' . md5(session_id() . "day") . '=' . md5(session_id() . "saturday") . '&' . md5(session_id() . 'time') . '=' . date("h:i A" ,strtotime($sat[0] + $i.":00")) . '&' . md5(session_id() . "period") . '=' . md5("PM") . '"><span>' . date("h:i A" ,strtotime($sat[0] + $i.":00")). '</span></a>';
																} else {
																	$selected = ($_SESSION["selected_period"] == "AM" && $_SESSION["selected_date"] == $date->format("j M Y") && $_SESSION["selected_day"] == "saturday" && $_SESSION["selected_time"] == date("h:i A" ,strtotime($sat[0] + $i.":00"))) ? "selected" : "";
																	echo '<a class="timing ' . $selected . '" href="' . $actual_link . '&' . md5(session_id() . "date") . "=" . $date->format("j M Y") . '&' . md5(session_id() . "day") . '=' . md5(session_id() . "saturday") . '&' . md5(session_id() . 'time') . '=' . date("h:i A" ,strtotime($sat[0] + $i.":00")) . '&' . md5(session_id() . "period") . '=' . md5("AM") . '"><span>' .date("h:i A" ,strtotime($sat[0] + $i.":00")). '</span></a>';
																}
															}
														}
													} else if (strtolower($date->format("l")) == "sunday") {
														if (count($sun) == 0) {
															echo '<a class="timing bg-danger-light"> Closed</a>';
														} else {
															$sun[0] = str_replace(" ", "", str_replace(":00", "", str_replace("AM", "", $sun[0])));
															$sun[1] = 12 + (str_replace(" ", "", str_replace(":00", "", str_replace("PM", "", $sun[1]))));
															for ($i = 0; $i <= ($sun[1] - $sun[0]); $i++) {
																if ((($sun[0]) + ($i)) > 12) {
																	$selected = ($_SESSION["selected_period"] == "PM" && $_SESSION["selected_date"] == $date->format("j M Y") && $_SESSION["selected_day"] == "sunday" && $_SESSION["selected_time"] == ((($sun[0]) + ($i)) - 12)) ? "selected" : "";
																	echo '<a class="timing ' . $selected . '" href="' . $actual_link . '&' . md5(session_id() . "date") . "=" . $date->format("j M Y") . '&' . md5(session_id() . "day") . '=' . md5(session_id() . "sunday") . '&' . md5(session_id() . 'time') . '=' . date("h:i A" ,strtotime($sun[0] + $i.":00")) . '&' . md5(session_id() . "period") . '=' . md5("PM") . '"><span>' . date("h:i A" ,strtotime($sun[0] + $i.":00")) . '</span></a>';
																} else {
																	$selected = ($_SESSION["selected_period"] == "AM" && $_SESSION["selected_date"] == $date->format("j M Y") && $_SESSION["selected_day"] == "sunday" && $_SESSION["selected_time"] == ((($sun[0]) + ($i)))) ? "selected" : "";
																	echo '<a class="timing ' . $selected . '" href="' . $actual_link . '&' . md5(session_id() . "date") . "=" . $date->format("j M Y") . '&' . md5(session_id() . "day") . '=' . md5(session_id() . "saturday") . '&' . md5(session_id() . 'time') . '=' . date("h:i A" ,strtotime($sun[0] + $i.":00")) . '&' . md5(session_id() . "period") . '=' . md5("AM") . '"><span>' . date("h:i A" ,strtotime($sun[0] + $i.":00")) . '</span></a>';
																}
															}
														}
													}
													echo '</li>';
													$date->modify('+1 day');
												}
												?>
											</ul>
										</div>
										

									</div>
								</div>
							</div>
						</div>
						<div class="submit-section proceed-btn text-right">
							<a href="<?php echo $actual_link."&".md5('proceed')."=".md5(session_id()."proceed"); ?>" class="btn btn-primary submit-btn">Proceed</a>
						</div>
						

					</div>
				</div>
			</div>

		</div>
		
		<?php include("./includes/footer.php"); ?>


	</div>
	
	<?php include("./includes/scripting.php"); ?>
	<script>
		$(document).ready(function(e) {
			let UrlsObj = localStorage.getItem('rememberScroll');
			let ParseUrlsObj = JSON.parse(UrlsObj);
			let windowUrl = window.location.href;

			if (ParseUrlsObj == null) {
				return false;
			}
			ParseUrlsObj.forEach(function(el) {
				if (el.url === windowUrl) {
					let getPos = el.scroll;
					$(window).scrollTop(getPos);
				}
			});
		});

		function RememberScrollPage(scrollPos) {
			let UrlsObj = localStorage.getItem('rememberScroll');
			let urlsArr = JSON.parse(UrlsObj);
			if (urlsArr == null) {
				urlsArr = [];
			}
			if (urlsArr.length == 0) {
				urlsArr = [];
			}
			let urlWindow = window.location.href;
			let urlScroll = scrollPos;
			let urlObj = {
				url: urlWindow,
				scroll: scrollPos
			};
			let matchedUrl = false;
			let matchedIndex = 0;
			if (urlsArr.length != 0) {
				urlsArr.forEach(function(el, index) {

					if (el.url === urlWindow) {
						matchedUrl = true;
						matchedIndex = index;
					}
				});
				if (matchedUrl === true) {
					urlsArr[matchedIndex].scroll = urlScroll;
				} else {
					urlsArr.push(urlObj);
				}
			} else {
				urlsArr.push(urlObj);
			}
			localStorage.setItem('rememberScroll', JSON.stringify(urlsArr));
		}
		$(window).scroll(function(event) {
			let topScroll = $(window).scrollTop();
			RememberScrollPage(topScroll);
		});
	</script>
</body>

</html>