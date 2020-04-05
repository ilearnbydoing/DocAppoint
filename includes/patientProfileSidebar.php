<!-- Profile Sidebar -->
<?php

$query = "SELECT * FROM users where users.user_id=" . $_SESSION["user_id"] ;
		$result = $conn->query($query);
		if ($result->num_rows > 0) {
			if ($row = $result->fetch_assoc()) {
  echo '
  <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                              <div class="profile-sidebar">
                                  <div class="widget-profile pro-widget-content">
                                      <div class="profile-info-widget">
                                          <a href="#" class="booking-doc-img">
                                              <img src="'.$row["profile_url"].'" alt="User Image">
                                          </a>
                                          <div class="profile-det-info">
                                              <h3>'.$row["first_name"].' '.$row["last_name"].'</h3>
                                              <div class="patient-details">
                                                  <h5><i class="fas fa-birthday-cake"></i> '.date("M j, Y",strtotime($row["dob"])).'</h5>
                                                  <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> '.$row["address"].'</h5>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="dashboard-widget">
                                      <nav class="dashboard-menu">
                                          <ul>
                                              <li>
                                                  <a href="./patientAppointments.php">
                                                      <i class="fas fa-columns"></i>
                                                      <span>My Appointments</span>
                                                  </a>
                                              </li>
                                           <li>
                                                  <a href="./patientProfile.php">
                                                      <i class="fas fa-user-cog"></i>
                                                      <span>Profile</span>
                                                  </a>
                                              </li>
                                              <li>
                                                  <a href="./changePassword.php">
                                                      <i class="fas fa-lock"></i>
                                                      <span>Change Password</span>
                                                  </a>
                                              </li>
                                              <li>
                                                  <a href="./logout.php">
                                                      <i class="fas fa-sign-out-alt"></i>
                                                      <span>Logout</span>
                                                  </a>
                                              </li>
                                          </ul>
                                      </nav>
                                  </div>
  
                              </div>
                          </div>
                          <!-- / Profile Sidebar -->';
                        
                    }
                }
        ?>