<?php
include("./includes/system_essentials.php");
include("./includes/validators/validateLoggedUser.php");
include("./includes/validators/restrictDoctors.php");
if (isset($_POST[md5("savePatientProfileInformation")])) {
    
    $uploaddir = './assets/img/patients/'.session_id().date("y-m-d-h-i-s");
    $uploadfile = $uploaddir . basename($_FILES['profile_image']['name']);
    if(isset($_FILES['profile_image']))
    {
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadfile)) {
            $sql = "UPDATE users SET 
    first_name=\"" . addslashes(trim($_POST["first_name"])) . "\", 
    last_name=\"" . addslashes(trim($_POST["last_name"])) . "\", 
    dob=\"" . addslashes(trim($_POST["dob"])) . "\", 
    mobile=\"" . addslashes(trim($_POST["mobile"])) . "\", 
    city=\"" . addslashes(trim($_POST["city"])) . "\", 
    profile_url=\"" . addslashes(trim($uploadfile)) . "\", 
    state=\"" . addslashes(trim($_POST["state"])) . "\", 
    country=\"" . addslashes(trim($_POST["country"])) . "\", 
    address=\"" . addslashes(trim($_POST["address"])) . "\"
    WHERE users.user_id=" . $_SESSION["user_id"];
        } else {
            $sql = "UPDATE users SET 
            first_name=\"" . addslashes(trim($_POST["first_name"])) . "\", 
            last_name=\"" . addslashes(trim($_POST["last_name"])) . "\", 
            dob=\"" . addslashes(trim($_POST["dob"])) . "\", 
            mobile=\"" . addslashes(trim($_POST["mobile"])) . "\", 
            city=\"" . addslashes(trim($_POST["city"])) . "\", 
            state=\"" . addslashes(trim($_POST["state"])) . "\", 
            country=\"" . addslashes(trim($_POST["country"])) . "\", 
            address=\"" . addslashes(trim($_POST["address"])) . "\"
            WHERE users.user_id=" . $_SESSION["user_id"];
        }
    }
    else
    {
        $sql = "UPDATE users SET 
    first_name=\"" . addslashes(trim($_POST["first_name"])) . "\", 
    last_name=\"" . addslashes(trim($_POST["last_name"])) . "\", 
    dob=\"" . addslashes(trim($_POST["dob"])) . "\", 
    mobile=\"" . addslashes(trim($_POST["mobile"])) . "\", 
    city=\"" . addslashes(trim($_POST["city"])) . "\", 
    state=\"" . addslashes(trim($_POST["state"])) . "\", 
    country=\"" . addslashes(trim($_POST["country"])) . "\", 
    address=\"" . addslashes(trim($_POST["address"])) . "\"
    WHERE users.user_id=" . $_SESSION["user_id"];
    }



    if ($conn->query($sql) === TRUE) {
        echo " <body>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
<script src='sweetalert2.all.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/promise-polyfill'></script>
           <script type='text/javascript'>
           Swal.fire({
            title: 'Profile Updated!',
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Okay'
          }).then(DocAppoint =>{
             setTimeout(()=>{
                 window.location.href='./patientProfile.php';
             },10);
          } )</script></body>";
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
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                            </ol>
                        </nav>
                        <h2 class="breadcrumb-title">Profile</h2>
                    </div>
                </div>
            </div>
        </div>
        

        
        <div class="content">
            <div class="container-fluid">

                <div class="row">

                    <?php include("includes/patientProfileSidebar.php") ?>

                    <?php

                    $query = "SELECT * FROM users where users.user_id=" . $_SESSION["user_id"];
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        if ($row = $result->fetch_assoc()) {


                            echo '<div class="col-md-7 col-lg-8 col-xl-9">
							<div class="card">
								<div class="card-body">
									
									<!-- Profile Settings Form -->
									<form id="patientProfileForm" enctype="multipart/form-data" action="" method="POST">
										<div class="row form-row">
											<div class="col-12 col-md-12">
												<div class="form-group">
													<div class="change-avatar">
														<div class="profile-img">
															<img src="' . $row["profile_url"] . '" alt="User Image">
                                                        </div>
                                                        <div class="upload-img">
                                                        <div class="change-photo-btn">
                                                            <span><i class="fa fa-upload"></i> Upload Photo</span>
                                                            <input name="profile_image" type="file" class="upload">
                                                        </div>
                                                        <small class="form-text text-muted">Allowed JPG or PNG</small>
                                                    </div>  
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>First Name</label>
													<input type="text" name="first_name" id="first_name" class="form-control" value="' . $row["first_name"] . '">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Last Name</label>
													<input type="text" id="last_name" name="last_name" class="form-control" value="' . $row["last_name"] . '">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Date of Birth</label>
													<div class="cal-icon">
														<input type="date" name="dob" id="dob" class="form-control" value="' . $row["dob"] . '">
													</div>
												</div>
											</div>
											
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Email </label>
													<input type="email" id="email" name="email" readonly class="form-control" value="' . $row["email"] . '">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Mobile</label>
													<input type="number" name="mobile" id="mobile" value="' . $row["mobile"] . '" class="form-control">
												</div>
											</div>
										
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>City</label>
													<input type="text" name="city" id="city" class="form-control" value="' . $row["city"] . '">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>State</label>
													<input type="text" name="state" id="state" class="form-control" value="' . $row["state"] . '">
												</div>
											</div>
											
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Country</label>
													<input type="text" id="country" name="country" class="form-control" value="' . $row["country"] . '">
												</div>
                                            </div>
                                            <div class="col-12">
                                            <div class="form-group">
                                            <label>Address</label>
                                                <input type="text" name="address" id="address" class="form-control" value="' . $row["address"] . '">
                                            </div>
                                        </div>
                                        </div>
                                        <input type="password" hidden value="'.md5(session_id()).'"  name="' . md5("savePatientProfileInformation") . '" />
										<div class="submit-section">
											<button type="submit" onclick="event.preventDefault(); validateInputFields();" class="btn btn-primary submit-btn">Save Changes</button>
										</div>
									</form>
									<!-- /Profile Settings Form -->
									
								</div>
							</div>
						</div>';
                        }
                    };
                    ?>

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

        } else if (document.getElementById("city").value.length === 0) {
            Swal.fire({
                title: 'Invalid Input!',
                text: 'Please enter city!',
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
            });

        } else if (document.getElementById("country").value.length === 0) {
            Swal.fire({
                title: 'Invalid Input!',
                text: 'Please enter country!',
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
            });

        } else if (document.getElementById("state").value.length === 0) {
            Swal.fire({
                title: 'Invalid Input!',
                text: 'Please enter state!',
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
            document.getElementById("patientProfileForm").submit();
        }
    }
</script>

</html>