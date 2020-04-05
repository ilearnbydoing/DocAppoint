<?php
include("./includes/system_essentials.php");
include("./includes/validators/validateLoggedUser.php");

$_SESSION["requestPayment"] = true;
if($_SESSION["selected_period"]=="PM")
{
	$time = $_SESSION["selected_date"]." ".($_SESSION["selected_time"]+12).":00 ";
}
else
{
	$time = $_SESSION["selected_date"]." ".($_SESSION["selected_time"]).":00 ";
}
$_SESSION["appointmentDatetime"] = date("Y-m-d H:i", strtotime($time));
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (isset($_SESSION[md5("selected_dr_id")])) {
	$sql = 'SELECT AUTO_INCREMENT
	FROM information_schema.TABLES
	WHERE TABLE_SCHEMA = "webappointmentsystem"
	AND TABLE_NAME = "appointments"';
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		if ($row = $result->fetch_assoc()) {
			$_SESSION["appointment_id"]=$row["AUTO_INCREMENT"];
		}
		else
		{
			header("Location: ./");
		}
	}
	else
		{
			header("Location: ./");
		}
	$query = "SELECT * FROM users,user_profile,feedback where users.user_id=" . $_SESSION[md5("selected_dr_id")] . " and users.user_type_id=2 and users.status=1 and users.user_profile_id=user_profile.user_profile_id";
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
		} else {
			exit(0);
		}
	} else {
		exit(0);
		header("Location: ./");
	}
} else {
	exit(0);
	header("Location: ./");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>DocAppoint - Harsh Thakkar Project (1959894)</title>
	<?php include("./includes/metadata.php"); ?>
	<?php include("./includes/icons.php"); ?>
	<?php include("./includes/styling.php"); ?>
	<script src="https://js.stripe.com/v3/"></script>
</head>

<body class="account-page">
	
	<div class="main-wrapper">
		<?php include("./includes/header.php"); ?>

		<!-- Breadcrumb -->
		<div class="breadcrumb-bar">
			<div class="container-fluid">
				<div class="row align-items-center">
					<div class="col-md-12 col-12">
						<nav aria-label="breadcrumb" class="page-breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Checkout</li>
							</ol>
						</nav>
						<h2 class="breadcrumb-title">Checkout</h2>
					</div>
				</div>
			</div>
		</div>
		

		
		<div class="content">
			<div class="container">

				<div class="row">
					<div class="col-md-7 col-lg-8">
						<div class="card">
							<div class="card-body">

								<form id="payment-form" method="post" action="./payments/cc86ac09e3a681c1f47dc2a38c16879f.php">
									<div class="info-widget">
										<h4 class="card-title">Patient Information</h4>
										<div class="row">
											<div class="col-md-6 col-sm-12">
												<div class="form-group card-label">
													<label>First Name</label>
													<input required value="<?php echo $_SESSION["first_name"]; ?>" name="first_name" class="form-control mb-3 StripeElement StripeElement--empty" type="text">
												</div>
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="form-group card-label">
													<label>Last Name</label>
													<input required value="<?php echo $_SESSION["last_name"]; ?>" name="last_name" class="form-control mb-3 StripeElement StripeElement--empty" type="text">
												</div>
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="form-group card-label">
													<label>Email</label>
													<input required value="<?php echo $_SESSION["email"]; ?>" name="email" class="form-control mb-3 StripeElement StripeElement--empty" type="email">
												</div>
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="form-group card-label">
													<label>Phone</label>
													<input required value="<?php echo $_SESSION["mobile"]; ?>" name="mobile" class="form-control mb-3 StripeElement StripeElement--empty" type="text">
												</div>
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="form-group card-label">
													<label>Date of Birth</label>
													<input required value="<?php echo $_SESSION["dob"]; ?>" name="dob" class="form-control" type="date">
												</div>
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="form-group card-label">
													<label>Gender</label>
													<select required name="gender" class="form-control">
														<option value="Male" <?php echo ((strtolower($_SESSION["gender"]) == "male") ? "selected" : ""); ?>>Male</option>
														<option value="Female" <?php echo ((strtolower($_SESSION["gender"]) == "female") ? "selected" : ""); ?>>Female</option>
													</select>
												</div>
											</div>

										</div>
									</div>
									<div class="info-widget">
										<h4 class="card-title">Message To Doctor</h4>
										<div class="row">
											<div class="col-md-12 col-sm-12">
												<div class="form-group card-label">
													<label>Explain your problem (Symptoms, Diseases, Injuries, Disorders, Other)</label>
													<textarea placeholder="Write your message here..." required name="message" class="form-control mb-3 StripeElement StripeElement--empty"></textarea>
												</div>
											</div>
										</div>
									</div>
									<div class="payment-widget">
										<h4 class="card-title">Payment Method</h4>
										<div class="payment-list">
											<label class="payment-radio credit-card-option">
												<input type="radio" name="radio" checked>
												<span class="checkmark"></span>
												Credit card
											</label>
											<div class="row">
												<div class="col-md-12">
													<div id="card-element" class="form-group">
													</div>
												</div>
											</div>
										</div>

										<div style="color:red;margin:10px;padding:4px" class="terms-accept">
											<div class="custom-checkbox">
												<div id="card-errors" role="alert"></div>
											</div>
										</div>
										<div class="terms-accept">
											<div class="custom-checkbox">
												<input required type="checkbox" name="terms" id="terms_accept">
												<label for="terms_accept">I have read and accept <a target="_blank" href="./termsAndCondition.php">Terms &amp; Conditions</a></label>
											</div>
										</div>
										<div class="submit-section mt-4">
											<button type="submit" class="btn btn-primary submit-btn">Confirm and Pay</button>
										</div>
									</div>
								</form>
							</div>
						</div>

					</div>

					<div class="col-md-5 col-lg-4 theiaStickySidebar">
						<div class="card booking-card">
							<div class="card-header">
								<h4 class="card-title">Booking Summary</h4>
							</div>
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
										<div class="clinic-details">
											<p class="text-muted mb-0"><i class="fas fa-map-marker-alt"></i> <?php echo ucfirst($row["city"]) ?>, <?php echo ucfirst($row["country"]) ?></p>
										</div>
									</div>
								</div>
								<div class="booking-summary">
									<div class="booking-item-wrap">
										<ul class="booking-date">
											<li>Date <span><?php echo $_SESSION["selected_date"] ?></span></li>
											<li>Time <span><?php echo $_SESSION["selected_time"] ?></span></li>
										</ul>
										<ul class="booking-fee">
											<li>Appointment Fee <span>$5.00</span></li>
										</ul>
										<div class="booking-total">
											<ul class="booking-total-list">
												<li>
													<span>Total</span>
													<span class="total-cost">$5.00</span>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include("./includes/footer.php"); ?>
	</div>
	<?php include("./includes/scripting.php"); ?>
	<?php include("/includes/paymentScripts.php");?>
	</body>
</html>