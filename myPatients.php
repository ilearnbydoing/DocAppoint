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
                                <li class="breadcrumb-item active" aria-current="page">My Patients</li>
                            </ol>
                        </nav>
                        <h2 class="breadcrumb-title">My Patients</h2>
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

                        <div class="row row-grid">

                            <?php

                            $query = "SELECT * FROM appointments where appointments.doctor_id=" . $_SESSION["user_id"] . " ";
                            $result = $conn->query($query);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {

                                    $query = "SELECT * FROM users where users.user_id=" . $row["patient_id"] . " ";
                                    $result = $conn->query($query);
                                    if (($result->num_rows > 0) and ($row = $result->fetch_assoc())) {


                                        //calculating age
                                        $birthDate = explode("/", date("d/m/Y", strtotime($row["dob"])));
                                        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                                            ? ((date("Y") - $birthDate[2]) - 1)
                                            : (date("Y") - $birthDate[2]));

                                        echo  '<div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="card widget-profile pat-widget-profile">
                                    <div class="card-body">
                                        <div class="pro-widget-content">
                                            <div class="profile-info-widget">
                                                <a href="patient-profile.html" class="booking-doc-img">
                                                    <img src="' . $row["profile_url"] . '" alt="User Image">
                                                </a>
                                                <div class="profile-det-info">
                                                    <h3><a>' . $row["first_name"] . ' ' . $row["last_name"] . '</a></h3>
                                                    
                                                    <div class="patient-details">
                                                        <h5><b>Patient ID :</b> P00' . $row["user_id"] . '</h5>
                                                        <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> ' . $row["city"] . ', ' . $row["country"] . '</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="patient-info">
                                            <ul>
                                            <li>Email <span>' . $row["email"] . '</span></li>
                                                <li>Phone <span>' . $row["mobile"] . '</span></li>
                                                <li>Age <span>' . $age . ' Years, ' . $row["gender"] . '</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>';
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
    
    <?php include("./includes/scripting.php"); ?>
</body>

</html>