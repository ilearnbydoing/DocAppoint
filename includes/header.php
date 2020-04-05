<header class="header">
	<nav class="navbar navbar-expand-lg header-nav">
		<div class="navbar-header">
			<a id="mobile_btn" href="javascript:void(0);">
				<span class="bar-icon">
					<span></span>
					<span></span>
					<span></span>
				</span>
			</a>
			<a href="index.php" class="navbar-brand logo">
				<img src="assets/img/logo.png" class="img-fluid" alt="Logo">
			</a>
		</div>
		<div class="main-menu-wrapper">
			<div class="menu-header">
				<a href="index.php" class="menu-logo">
					<img src="assets/img/logo.png" class="img-fluid" alt="Logo">
				</a>
				<a id="menu_close" class="menu-close" href="javascript:void(0);">
					<i class="fas fa-times"></i>
				</a>
			</div>
			<ul class="main-nav">
				<?php
				//VALIDATE USER IS LOGGED IN OR NOT
				if (isset($_SESSION[md5(session_id())])) {
					if (($_SESSION[md5(session_id())] === md5(session_id() . " - " . session_status())) and
						isset($_SESSION["first_name"]) and
						isset($_SESSION["last_name"]) and
						isset($_SESSION["email"]) and
						isset($_SESSION["mobile"]) and
						isset($_SESSION["gender"]) and
						isset($_SESSION["logged_time"]) and
						isset($_SESSION["dob"])
					) {
					}
				}
				else
				{
					echo '<li class="login-link">
						<a href="login.php">Login / Signup</a>
					</li>';
				}
				?>
			</ul>
		</div>
		<ul class="nav header-navbar-rht">
			<li class="nav-item contact-item">
				<div class="header-contact-img">
					<i class="far fa-hospital"></i>
				</div>
				<div class="header-contact-detail">
					<p class="contact-header">Emergency Contact</p>
					<p class="contact-info-header"> +1 514-555-5555</p>
				</div>
			</li>
			<?php
			//VALIDATE USER IS LOGGED IN OR NOT
			if (isset($_SESSION[md5(session_id())])) {
				if (($_SESSION[md5(session_id())] === md5(session_id() . " - " . session_status())) and
					isset($_SESSION["first_name"]) and
					isset($_SESSION["last_name"]) and
					isset($_SESSION["email"]) and
					isset($_SESSION["mobile"]) and
					isset($_SESSION["gender"]) and
					isset($_SESSION["logged_time"]) and
					isset($_SESSION["dob"])
				) {
					$query = "SELECT * FROM users where users.user_id=" . $_SESSION["user_id"];
					$result = $conn->query($query);
					if ($result->num_rows > 0) {
						if ($row = $result->fetch_assoc()) {
							echo '
					<li class="nav-item">
					<a class="nav-link header-login" href="login.php">Book Appointment</a>
				</li>
				<li class="nav-item dropdown has-arrow logged-item">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<span class="user-img">
							<img class="rounded-circle" src="' . $row["profile_url"] . '" width="31" alt="Darren Elder">
						</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<div class="user-header">
							<div class="avatar avatar-sm">
								<img src="' . $row["profile_url"] . '" alt="User Image" class="avatar-img rounded-circle">
							</div>
							<div class="user-text">
								<h6>' . ucfirst($row["first_name"]) . " " . ucfirst($row["last_name"]) . '</h6>
								<p class="text-muted mb-0">' . ucfirst($_SESSION["user_type"]) . '</p>
							</div>
						</div>';

							if ($_SESSION["user_type"] == "doctor") {
								echo '<a class="dropdown-item" href="./doctorAppointments.php">Appointments</a>
						<a class="dropdown-item" href="./myPatients.php">My Patients</a>
						<a class="dropdown-item" href="./timings.php">Schedule Timings</a>
						<a class="dropdown-item" href="./doctorUserProfile.php">Profile</a>
						<a class="dropdown-item" href="./changePasswordDoctor.php">Change Password</a>
						<a class="dropdown-item" href="./logout.php">Logout</a>';
							} else {
								echo '	<a class="dropdown-item" href="./patientAppointments.php">My Appointments</a>
						<a class="dropdown-item" href="./patientProfile.php">Profile</a>
						<a class="dropdown-item" href="./changePassword.php">Change Password</a>
						<a class="dropdown-item" href="./logout.php">Logout</a>';
							}
							echo '</div>
				</li>';
						}
					}
				} else {
					session_destroy();
				}
			} else {
				echo '<li class="nav-item">
				<a class="nav-link header-login" href="login.php">login / Signup </a>
			</li>';
			}
			?>
		</ul>
	</nav>
</header>