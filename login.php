<?php
include("./includes/system_essentials.php");
include("./includes/validators/validateLoggedUser.php");
$error_message = "";
if (isset($_POST[session_id()])) {
	if ($_POST[session_id()] == md5(session_id())) {
		if (isset($_POST["email"]) and isset($_POST["password"])) {
			$key = md5("HarshThakkar");
			$email = addslashes(trim($_POST["email"]));
			$password = md5(md5($key . addslashes(trim($_POST["password"])) . $key));
			$query = "SELECT*FROM users,user_types where users.email='$email' and users.password='$password' and users.user_type_id=user_types.user_types_id";
			$result = $conn->query($query);
			if ($result->num_rows > 0) {
				if ($row = $result->fetch_assoc()) {
					if ($row["status"] == 1) {
						//SESSION CREDENTIALS
						$_SESSION["user_id"] = $row["user_id"];
						$_SESSION[md5(session_id())] = md5(session_id() . " - " . session_status());
						$_SESSION["first_name"] = $row["first_name"];
						$_SESSION["last_name"] 	= $row["last_name"];
						$_SESSION["user_type"] = $row["user_type_name"];
						$_SESSION["access_priviledges"] = $row["access_priviledges"];
						$_SESSION["email"] = $row["email"];
						$_SESSION["mobile"] = $row["mobile"];
						$_SESSION["gender"] = $row["gender"];
						$_SESSION["dob"] = $row["dob"];
						$_SESSION["logged_time"] = date("Y-m-d h:i:sa");
						echo "<script>alert('" . $row["access_priviledges"] . "')</script>";
						if (strpos($row["access_priviledges"], 'PATIENTPANEL') !== false) {

							$_SESSION["admin_logged"] = false;
							$_SESSION["doctor_logged"] = false;
							$_SESSION["patient_logged"] = true;
							header("Location: ./");
						}
						if (strpos($row["access_priviledges"], 'DOCTORPANEL')  !== false) {
							$_SESSION["admin_logged"] = false;
							$_SESSION["doctor_logged"] = true;
							$_SESSION["patient_logged"] = false;
							header("Location: ./");
						}
						if (strpos($row["access_priviledges"], 'ADMINPANEL')  !== false) {
							$_SESSION["admin_logged"] = true;
							$_SESSION["patient_logged"] = false;
							$_SESSION["doctor_logged"] = false;
							header("Location: ./admin/");
						}
					} else {
						echo " <body>
						<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
						<script src='sweetalert2.all.min.js'></script>
						<script src='https://cdn.jsdelivr.net/npm/promise-polyfill'></script>
						   <script type='text/javascript'>
						   Swal.fire({
							title: 'Account Under Verification!',
							text: 'Your account is under verification. You need to wait until it gets verified!',
							icon: 'warning',
							showCancelButton: false,
							confirmButtonColor: '#3085d6',
							confirmButtonText: 'Okay'
						  }).then(DocAppoint =>{
							 setTimeout(()=>{
								window.location.href='./login.php';
							 },10);
						  } )</script></body>";
					}
				}
			} else {
				$error_message = "Invalid Credentials";
			}
		}
	} else {
		session_destroy();
		header("Refresh:0");
	}
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

		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-8 offset-md-2">
						<div class="account-content">
							<div class="row align-items-center justify-content-center">
								<div class="col-md-7 col-lg-6 login-left">
									<img src="assets/img/login-banner.png" class="img-fluid" alt="DocAppoint Login">
								</div>
								<div class="col-md-12 col-lg-6 login-right">
									<div class="login-header">
										<h3>Login <span>DocAppoint</span></h3>
									</div>
									<form id="<?php echo md5(session_id()); ?>" action="" method="POST">
										<div class="form-group form-focus">
											<input required="true" name="email" type="email" class="form-control floating">
											<label class="focus-label">Email</label>
										</div>
										<div class="form-group form-focus">
											<input required="true" name="password" type="password" class="form-control floating">
											<label class="focus-label">Password</label>
										</div>
										<p style="text-align:center;color:red;font-weight:600"><?php echo $error_message; ?></p>
										<div class="text-right">
											<a class="forgot-link" href="forgot-password.php">Forgot Password ?</a>
										</div>
										<button value="<?php echo md5(session_id()); ?>" name="<?php echo session_id(); ?>" class="btn btn-primary btn-block btn-lg login-btn" type="submit">Login</button>
										<div class="text-center dont-have">Don’t have an account? <a style="font-weight:600" href="register.php"> Register Now!</a></div>
									</form>
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
</body>

</html>