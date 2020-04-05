<?php
include("./includes/system_essentials.php");
include("./includes/validators/validateLoggedUser.php");
if (isset($_POST[md5("changePatientProfilePassword")])) {
    $query = "SELECT * FROM users where users.user_id=" . $_SESSION["user_id"] ;
		$result = $conn->query($query);
		if ($result->num_rows > 0) {
			if ($row = $result->fetch_assoc()) {
                $key = md5("HarshThakkar");
                $old_password = md5(md5($key . addslashes(trim($_POST["old_password"])) . $key));
                if($row["password"]==$old_password)
                {
                    $password = md5(md5($key . addslashes(trim($_POST["password"])) . $key));
                    $sql = "UPDATE users SET 
                    password=\"".trim($password)."\"
                    WHERE users.user_id=".$_SESSION["user_id"];
                    if ($conn->query($sql) === TRUE) {
                        echo " <body>
                        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
                <script src='sweetalert2.all.min.js'></script>
                <script src='https://cdn.jsdelivr.net/npm/promise-polyfill'></script>
                           <script type='text/javascript'>
                           Swal.fire({
                            title: 'Password Changed!',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Okay'
                          }).then(DocAppoint =>{
                             setTimeout(()=>{
                                 window.location.href='./changePassword.php';
                             },10);
                          } )</script></body>";
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
                        title: 'Wrong Password!',
                        text: 'Please provide correct old password.',
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Okay'
                      }).then(DocAppoint =>{
                         setTimeout(()=>{
                             window.location.href='./changePassword.php';
                         },10);
                      } )</script></body>";                }

            }
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
        <!-- Breadcrumb -->
        <div class="breadcrumb-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-12 col-12">
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="./">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                            </ol>
                        </nav>
                        <h2 class="breadcrumb-title">Change Password</h2>
                    </div>
                </div>
            </div>
        </div>
        

        
        <div class="content">
            <div class="container-fluid">

                <div class="row">

                    <?php include("includes/patientProfileSidebar.php") ?>

                    <div class="col-md-7 col-lg-8 col-xl-9">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-md-12 col-lg-6">
										
											<!-- Change Password Form -->
											<form id="patientProfileForm" action="" method="POST">
												<div class="form-group">
													<label>Old Password</label>
													<input id="old_password" name="old_password" type="password" class="form-control">
												</div>
												<div class="form-group">
													<label>New Password</label>
													<input id="password" name="password" type="password" class="form-control">
												</div>
												<div class="form-group">
													<label>Confirm Password</label>
													<input id="confirm_password" name="confirm_password" type="password" class="form-control">
												</div>
												<div class="submit-section">
													<button  onclick="event.preventDefault(); validateInputFields();"  type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                                </div>
                                                <input hidden type="password" <?php echo 'value="'.md5(session_id()).'"  name="' . md5("changePatientProfilePassword") . '"'; ?> />
											</form>
											<!-- /Change Password Form -->
											
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

</body>

<script>
    <?php include("./includes/alerts.php"); ?>

    function validateInputFields() {
        if (document.getElementById("old_password").value.length === 0) {
			Swal.fire({
				title: 'Invalid Input!',
				text: 'Please enter your old password!',
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Okay'
			});

		}
        else if (document.getElementById("password").value.length === 0) {
			Swal.fire({
				title: 'Invalid Input!',
				text: 'Please enter new password field!',
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Okay'
			});

		}  else if (document.getElementById("confirm_password").value.length === 0) {
			Swal.fire({
				title: 'Invalid Input!',
				text: 'Please enter confirm password field!',
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Okay'
			});

		} 
        else if ((document.getElementById("password").value) !== (document.getElementById("confirm_password").value)) {
			Swal.fire({
				title: 'Password Mismatch!',
				text: 'Password doesn\'t match. Please enter same password for \'Password\' and \'Confirm Password\' field.',
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Okay'
			});

		} else {
            document.getElementById("patientProfileForm").submit();
        }
    }
</script>

</html>