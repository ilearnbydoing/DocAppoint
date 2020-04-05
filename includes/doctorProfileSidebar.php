<?php
$query = "SELECT * FROM users,user_profile where users.user_profile_id=user_profile.user_profile_id and users.user_id=" . $_SESSION["user_id"] ;
		$result = $conn->query($query);
		if ($result->num_rows > 0) {
			if ($row = $result->fetch_assoc()) {

                echo '
<div class="profile-sidebar">
    <div class="widget-profile pro-widget-content">
        <div class="profile-info-widget">
            <a href="#" class="booking-doc-img">
                <img src="'.$row["profile_url"].'" alt="User Image">
            </a>
            <div class="profile-det-info">
                <h3>Dr. '.$row["first_name"].' '.$row["last_name"].'</h3>

                <div class="patient-details">
                    <h5 class="mb-0">'.$row["title"].'</h5>
                </div>
                
            </div>
        </div>
    </div>
    <div class="dashboard-widget">
        <nav class="dashboard-menu">
            <ul>

                <li>
                    <a href="doctorAppointments.php">
                        <i class="fas fa-calendar-check"></i>
                        <span>Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="myPatients.php">
                        <i class="fas fa-user-injured"></i>
                        <span>My Patients</span>
                    </a>
                </li>
                <li>
                    <a href="timings.php">
                        <i class="fas fa-hourglass-start"></i>
                        <span>Schedule Timings</span>
                    </a>
                </li>
               <li>
                    <a href="doctorUserProfile.php">
                        <i class="fas fa-user-cog"></i>
                        <span>Profile</span>
                    </a>
                </li>
               <li>
                    <a href="changePasswordDoctor.php">
                        <i class="fas fa-lock"></i>
                        <span>Change Password</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>';

            }
        }
