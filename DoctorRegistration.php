<?php
include("./includes/system_essentials.php");
include("./includes/validators/validateLoggedUser.php");
$error_message = "";
if (isset($_POST[session_id()])) {
	if ($_POST[session_id()] == md5(session_id())) {
		if (isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["email"]) && isset($_POST["mobile"]) && isset($_POST["password"]) && isset($_POST["confirm_password"]) && isset($_POST["address"]) && isset($_POST["dob"]) && isset($_POST["gender"])) {
			$key = md5("HarshThakkar");
			$first_name = addslashes(trim($_POST["first_name"]));
			$last_name = addslashes(trim($_POST["last_name"]));
			$email = addslashes(trim($_POST["email"]));
			$mobile = addslashes(trim($_POST["mobile"]));
			$password = addslashes(trim($_POST["password"]));
			$confirm_password = addslashes(trim($_POST["confirm_password"]));
			$address = addslashes(trim($_POST["address"]));
			$dob = addslashes(trim($_POST["dob"]));
			$gender = addslashes(trim($_POST["gender"]));

			if ($password == $confirm_password) {
				$password = md5(md5($key . addslashes(trim($password)) . $key));
				$sql = "INSERT INTO users(user_type_id, first_name, last_name, email, password, mobile, address, gender, dob, status) VALUES (2,'$first_name', '$last_name', '$email', '$password', '$mobile', '$address', '$gender', '$dob', '0')";
				if ($conn->query($sql) === TRUE) {
					echo " <body>
					<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
<script src='sweetalert2.all.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/promise-polyfill'></script>
					   <script type='text/javascript'>
					   Swal.fire({
						title: 'Account Created!',
						text: 'Your account is successfully created! As per our privacy policy, it is mandatory to verify a doctor before appointing any patients. You will be contacted by our team to verify your identity via email. Once your account is verified, you will be notified and can start taking appointments.',
						icon: 'success',
						showCancelButton: false,
						confirmButtonColor: '#3085d6',
						confirmButtonText: 'Okay'
					  }).then(DocAppoint =>{
						 setTimeout(()=>{
							 window.location.href='./';
						 },10);
					  } )</script></body>";
				} else {
					if (strpos(strtolower($conn->error), strtolower('Duplicate entry')) !== false) {
						echo " <body>
					<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
					<script src='sweetalert2.all.min.js'></script>
					<script src='https://cdn.jsdelivr.net/npm/promise-polyfill'></script>
					   <script type='text/javascript'>
					   Swal.fire({
						title: 'Account Already Exists!',
						text: 'Email used for registration is associated with an exisiting account.',
						icon: 'warning',
						showCancelButton: false,
						confirmButtonColor: '#3085d6',
						confirmButtonText: 'Okay'
					  }).then(DocAppoint =>{
						 setTimeout(()=>{
							//window.location.href='./register.php';
						 },10);
					  } )</script></body>";
					} else {
						echo " <body>
					<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
					<script src='sweetalert2.all.min.js'></script>
					<script src='https://cdn.jsdelivr.net/npm/promise-polyfill'></script>
					   <script type='text/javascript'>
					   Swal.fire({
						title: 'Invalid Details!',
						text: 'Please enter valid details!',
						icon: 'warning',
						showCancelButton: false,
						confirmButtonColor: '#3085d6',
						confirmButtonText: 'Okay'
					  }).then(DocAppoint =>{
						 setTimeout(()=>{
							//window.location.href='./register.php';
						 },10);
					  } )</script></body>";
					}
				}
			} else {
				echo " <body>
				<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
				<script src='sweetalert2.all.min.js'></script>
				<script src='https://cdn.jsdelivr.net/npm/promise-polyfill'></script>
				   <script type='text/javascript'>
				   Swal.fire({
					title: 'Input Error!',
					text: 'Your password doesn\'t matches, please try again!',
					icon: 'warning',
					showCancelButton: false,
					confirmButtonColor: '#3085d6',
					confirmButtonText: 'Okay'
				  }).then(DocAppoint =>{
					 setTimeout(()=>{
						 window.location.href='./register.php';
					 },10);
				  } )</script></body>";
				$error_message = "Password doesn't match!";
				session_destroy();
				header("Refresh:0");
			}
		}
	} else {
		session_destroy();
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
									<img src="assets/img/login-banner.png" class="img-fluid" alt="DocAppoint Register">
								</div>
								<div class="col-md-12 col-lg-6 login-right">
									<div class="login-header">
										<h3>Register As Doctor <a href="register.php">Are you a Patient?</a></h3>
									</div>
									<form id="registrationForm" action="" method="POST">
										<div class="row">
											<div class="col-md-12 col-lg-6">
												<div class="form-group form-focus focused">
													<input id="first_name" name="first_name" required type="text" class="form-control floating">
													<label class="focus-label">First Name</label>
												</div>
											</div>
											<div class="col-md-12 col-lg-6">
												<div class="form-group form-focus focused">
													<input id="last_name" name="last_name" required type="text" class="form-control floating">
													<label class="focus-label">Last Name</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 col-lg-6">
												<div class="form-group form-focus focused">
													<input id="email" name="email" required type="email" class="form-control floating">
													<label class="focus-label">Email</label>
												</div>
											</div>
											<div class="col-md-12 col-lg-6">
												<div class="form-group form-focus focused">
													<input id="mobile" name="mobile" required type="number" class="form-control floating">
													<label class="focus-label">Mobile</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 col-lg-6">
												<div class="form-group form-focus focused">
													<input id="password" name="password" required type="password" class="form-control floating">
													<label class="focus-label">Create Password</label>
												</div>
											</div>
											<div class="col-md-12 col-lg-6">
												<div class="form-group form-focus focused">
													<input id="confirm_password" name="confirm_password" required type="password" class="form-control floating">
													<label class="focus-label">Confirm Password</label>
												</div>
											</div>
										</div>

										<div class="form-group form-focus focused">
											<input id="address" name="address" required type="text" class="form-control floating">
											<label class="focus-label">Address</label>
										</div>
										<div class="row">
											<div class="col-md-12 col-lg-6">
												<div class="form-group form-focus focused">
													<input id="dob" name="dob" required type="text" class="form-control datetimepicker">
													<label class="focus-label">Date Of Birth</label>
												</div>
											</div>
											<div class="col-md-12 col-lg-6">
												<div class="form-group form-focus focused">
													<select id="gender" name="gender" required class="form-control select">
														<option value="" selected></option>
														<option value="Male">Male</option>
														<option value="Female">Female</option>
														<option value="Other">Other</option>
													</select>
													<label class="focus-label">Gender</label>
												</div>
											</div>
										</div>

										<div class="text-right">
											<a class="forgot-link" href="./login.php">Already have an account?</a>
										</div>
										<input value="<?php echo md5(session_id()); ?>" name="<?php echo session_id(); ?>" hidden required type="text">
										<button onclick="event.preventDefault(); validateInputFields();" class="btn btn-primary btn-block btn-lg login-btn">Signup</button>
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

<script>
	<?php include("./includes/alerts.php"); ?>

	function validateInputFields() {
		if (document.getElementById("first_name").value.length === 0) {
			Swal.fire({
				title: 'Invalid Input!',
				text: 'Please enter your first name!',
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Okay'
			});

		} else if (document.getElementById("last_name").value.length === 0) {
			Swal.fire({
				title: 'Invalid Input!',
				text: 'Please enter your last name!',
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Okay'
			});

		} else if (document.getElementById("email").value.length === 0) {
			Swal.fire({
				title: 'Invalid Input!',
				text: 'Please enter your email address!',
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Okay'
			});

		} else if (document.getElementById("mobile").value.length === 0) {
			Swal.fire({
				title: 'Invalid Input!',
				text: 'Please enter your mobile number!',
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Okay'
			});

		} else if (document.getElementById("password").value.length === 0) {
			Swal.fire({
				title: 'Invalid Input!',
				text: 'Please enter your password!',
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Okay'
			});

		} else if (document.getElementById("confirm_password").value.length === 0) {
			Swal.fire({
				title: 'Invalid Input!',
				text: 'Please enter confirm password field!',
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Okay'
			});

		} else if (document.getElementById("address").value.length === 0) {
			Swal.fire({
				title: 'Invalid Input!',
				text: 'Please enter your address!',
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Okay'
			});

		} else if (document.getElementById("gender").value.length === 0) {
			Swal.fire({
				title: 'Invalid Input!',
				text: 'Please enter your gender!',
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Okay'
			});

		} else if ((document.getElementById("password").value) !== (document.getElementById("confirm_password").value)) {
			Swal.fire({
				title: 'Password Mismatch!',
				text: 'Password doesn\'t match. Please enter same password for \'Password\' and \'Confirm Password\' field.',
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Okay'
			});

		} else if (document.getElementById("mobile").value.length !== 10) {
			Swal.fire({
				title: 'Invalid Mobile Number!',
				text: 'Mobile Number should be valid!',
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Okay'
			});

		} else {
			document.getElementById("registrationForm").submit();
		}
	}
</script>

</html>