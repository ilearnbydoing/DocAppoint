<?php
include("./includes/system_essentials.php");
include("./includes/validators/validateLoggedUser.php");
include("./includes/validators/restrictDoctors.php");
if (isset($_SESSION["appointment_id"]) and isset($_SESSION["appointmentBooked"]) and isset($_SESSION["restrictPageLoad"]) and isset($_SESSION["transactionID"])) {
	if (isset($_SESSION[md5("selected_dr_id")])) {
		$query = "SELECT * FROM users,appointments where appointments.appointment_id=" . $_SESSION["appointment_id"] . " and appointments.doctor_id=users.user_id and appointments.doctor_id=" . $_SESSION[md5("selected_dr_id")] . "";
		$result = $conn->query($query);
		if ($result->num_rows > 0) {
			if ($row = $result->fetch_assoc()) {


				$result = $conn->query($query);
				if ($result->num_rows > 0) {
					if ($row = $result->fetch_assoc()) {
					}
				}
				$businessHours = [];
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
} else {
	echo " <body>
						<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
						<script src='sweetalert2.all.min.js'></script>
						<script src='https://cdn.jsdelivr.net/npm/promise-polyfill'></script>
						   <script type='text/javascript'>
						   Swal.fire({
							title: 'Invalid Page Requested.',
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
								<li class="breadcrumb-item active" aria-current="page">Booking</li>
							</ol>
						</nav>
						<h2 class="breadcrumb-title">Booking</h2>
					</div>
				</div>
			</div>
		</div>
		

		
		<div class="content success-page-cont">
			<div class="container-fluid">

				<div class="row justify-content-center">
					<div class="col-lg-6">

						<!-- Success Card -->
						<div class="card success-card">
							<div class="card-body">
								<div class="success-cont">
									<i class="fas fa-check"></i>
									<h3>Appointment booked Successfully!</h3>
									<p>Appointment booked with <strong>Dr. <?php echo $row["first_name"] . " " . $row["last_name"] ?></strong>
										<br> Appointment Date: <strong><?php echo date("M d, Y (l)", strtotime($row["appointment_datetime"])) ?></strong>
										<br> Appointment Time: <strong><?php echo date("h:i A", strtotime($row["appointment_datetime"])) . " - " . date("h:i A", strtotime($row["appointment_datetime"] . "+1 hour"))  ?></strong><br>
										<br> Location: <strong id="address"><a target="_blank" href="http://maps.google.com/maps?q=<?php echo urlencode($row["address"]);  ?>"><?php echo ($row["address"]);  ?></a></strong></p>
									<a href="patientAppointments.php" class="btn btn-primary view-inv-btn">Go To My Appointments</a>
								</div>
							</div>
						</div>
						<!-- /Success Card -->

					</div>
				</div>

			</div>
		</div>
		

		<?php include("./includes/footer.php"); ?>

	</div>
	
	<?php include("./includes/scripting.php"); ?>
	<script>
	
			$('address').each(function() {
				var link = "<a href='http://maps.google.com/maps?q=" + encodeURIComponent($(this).text()) + "' target='_blank'>" + $(this).text() + "</a>";
				
				console.log(link);
			});
	</script>
</body>

</html>