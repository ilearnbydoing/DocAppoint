<?php
include("./includes/system_essentials.php");
include("./includes/validators/validateLoggedUser.php");
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
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Appointments</li>
                            </ol>
                        </nav>
                        <h2 class="breadcrumb-title">Appointments</h2>
                    </div>
                </div>
            </div>
        </div>
        

        
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

                        <?php include("./includes/doctorProfileSidebar.php"); ?>

                    </div>

                    <div class="col-md-7 col-lg-8 col-xl-9">
                        <div class="appointments">

                            <?php

                            $query = "SELECT * FROM users,appointments where appointments.doctor_id=" . $_SESSION["user_id"] . " and appointments.doctor_id=users.user_id";
                            $result = $conn->query($query);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {


                                    //find doc
                                    $patientFindQuery = "SELECT * FROM users where users.user_id=" . $row["patient_id"] . "";
                                    $patientResult = $conn->query($patientFindQuery);
                                    if ($patientResult->num_rows > 0) {
                                        if ($patient = $patientResult->fetch_assoc()) {
                                            echo '
								<!-- Appointment List -->
								<div class="appointment-list">
									<div class="profile-info-widget">
										<a href="patient-profile.html" class="booking-doc-img">
											<img src="' . $patient["profile_url"] . '" alt="User Image">
										</a>
										<div class="profile-det-info">
											<h3><a href="patient-profile.html">' . $patient["first_name"] . ' ' . $patient["last_name"] . '</a></h3>
											<div class="patient-details">
												<h5><i class="far fa-clock"></i> ' . date("M j, Y", strtotime($row["appointment_datetime"])) . ', ' . date("h:i A", strtotime($row["appointment_datetime"])) . '</h5>
												<h5><i class="fas fa-map-marker-alt"></i> ' . $patient["address"] . '</h5>
												<h5><i class="fas fa-envelope"></i> ' . $patient["email"] . '</h5>
												<h5 class="mb-0"><i class="fas fa-phone"></i> ' . $patient["mobile"] . '</h5>
											</div>
										</div>
									</div>
									<div class="appointment-action">
										<a href="#" class="btn btn-sm bg-info-light" data-toggle="modal" data-target="#appointmentID_' . $row["appointment_id"] . '">
											<i class="far fa-eye"></i> View Patient Details
										</a>
										
									</div>
								</div>
                                <!-- /Appointment List -->';
                                        }
                                    }
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>

            </div>

        </div>
        
        <?php include("./includes/footer.php"); ?>

    </div>
    


    <?php

    $query = "SELECT * FROM users,appointments where appointments.doctor_id=" . $_SESSION["user_id"] . " and appointments.doctor_id=users.user_id";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {


            //find doc
            $patientFindQuery = "SELECT * FROM users where users.user_id=" . $row["patient_id"] . "";
            $patientResult = $conn->query($patientFindQuery);
            if ($patientResult->num_rows > 0) {
                if ($patient = $patientResult->fetch_assoc()) {
                    echo '
<!-- Appointment Details Modal -->
<div class="modal fade custom-modal" id="appointmentID_' . $row["appointment_id"] . '">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Appointment Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="info-details">
                    <li>
                        <div class="details-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="title">Appointment ID </span>
                                     <span class="text">#APT000' . $row["appointment_id"] . '</span>
                                     <br></div>
                                
                                <div class="col-md-6">
                                <span class="title">Patient Name</span>
                                <span class="text">' . $row["patient_first_name"] . ' ' . $row["patient_last_name"] . '</span>
                                <br></div>
                                
                                <div class="col-md-6">
                                <span class="title">Patient Email</span>
                                <span class="text">' . $row["patient_email"]  . '</span>
                                <br></div>
                                
                                <div class="col-md-6">
                                <span class="title">Patient Mobile</span>
                                <span class="text">' . $row["patient_mobile"]  . '</span>
                                <br></div>
                                
                                <div class="col-md-6">
                                <span class="title">Patient Birth Date</span>
                                <span class="text">' . date("M j, Y", strtotime($row["patient_dob"])) . ' </span>
                                <br></div>
                                
                                <div class="col-md-6">
                                <span class="title">Patient Gender</span>
                                <span class="text">' . $row["patient_gender"]. '</span>
                                <br></div>

                                <div class="col-md-12">
                                <span class="title">Comments</span>
                                <span class="text">' . $row["comments"]. '</span>
                                <br></div>
                                
                                                

                          
                            
                            </div>
                        </div>
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Appointment Details Modal -->';
                }
            }
        }
    }
    ?>
    <?php include("./includes/scripting.php"); ?>
</body>

</html>