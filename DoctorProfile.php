<?php
include("./includes/system_essentials.php");
include("./includes/validators/validateLoggedUser.php");
if (isset($_GET[md5(session_id() + "id")])) {
	$query = "SELECT * FROM users,user_profile,feedback where  users.user_id=" . $_GET[md5(session_id() + "id")] . " and users.user_type_id=2 and users.status=1 and users.user_profile_id=user_profile.user_profile_id";
	$result = $conn->query($query);
	if ($result->num_rows > 0) {
		if ($row = $result->fetch_assoc()) {
			$specialities = array_unique(array_filter(preg_split("/\,/", trim($row["specialities"]))));
			$printSpecialities = "";
			foreach ($specialities as $i) {
				$printSpecialities .= ucwords($i) . "<br>";
			}

			$result = $conn->query($query);
			if ($result->num_rows > 0) {
				if ($row = $result->fetch_assoc()) {
				}
			}
			$businessHours = [];
			$days = array_filter(preg_split("/\,/", trim($row["business_hours"])));
			$businessHours[0] = strtolower(trim($days[0])) == strtolower(trim("Closed")) ? "<span class=\"badge bg-danger-light\">" . $days[0] . "</span>" : "<span>" . $days[0] . "</span>";
			$businessHours[1] = strtolower(trim($days[1])) == strtolower(trim("Closed")) ? "<span class=\"badge bg-danger-light\">" . $days[1] . "</span>" : "<span>" . $days[1] . "</span>";
			$businessHours[2] = strtolower(trim($days[2])) == strtolower(trim("Closed")) ? "<span class=\"badge bg-danger-light\">" . $days[2] . "</span>" : "<span>" . $days[2] . "</span>";
			$businessHours[3] = strtolower(trim($days[3])) == strtolower(trim("Closed")) ? "<span class=\"badge bg-danger-light\">" . $days[3] . "</span>" : "<span>" . $days[3] . "</span>";
			$businessHours[4] = strtolower(trim($days[4])) == strtolower(trim("Closed")) ? "<span class=\"badge bg-danger-light\">" . $days[4] . "</span>" : "<span>" . $days[4] . "</span>";
			$businessHours[5] = strtolower(trim($days[5])) == strtolower(trim("Closed")) ? "<span class=\"badge bg-danger-light\">" . $days[5] . "</span>" : "<span>" . $days[5] . "</span>";
			$businessHours[6] = strtolower(trim($days[6])) == strtolower(trim("Closed")) ? "<span class=\"badge bg-danger-light\">" . $days[6] . "</span>" : "<span>" . $days[6] . "</span>";
			$feedbacktotal = 0;
			$feedbackquery = "SELECT count(*) as feedbacktotal FROM feedback where feedback.to_doctor_id=" . $row["user_id"];
			$feedbackresult = $conn->query($feedbackquery);
			if ($feedbackresult->num_rows > 0) {
				if ($feedbackrow = $feedbackresult->fetch_assoc()) {
					$feedbacktotal = $feedbackrow["feedbacktotal"];
				}
			}
		}
	}
} else {
	exit(0);
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
								<li class="breadcrumb-item"><a href="index.php">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Doctor Profile</li>
							</ol>
						</nav>
						<h2 class="breadcrumb-title">Doctor Profile</h2>
					</div>
				</div>
			</div>
		</div>
		

		
		<div class="content">
			<div class="container">

				<!-- Doctor Widget -->
				<div class="card">
					<div class="card-body">
						<div class="doctor-widget">
							<div class="doc-info-left">
								<div class="doctor-img">
									<img src="<?php echo $row["profile_url"] ?>" class="img-fluid" alt="User Image">
								</div>
								<div class="doc-info-cont">
									<h4 class="doc-name">Dr. <?php echo $row["first_name"] . "." . $row["last_name"]; ?></h4>
									<p class="doc-speciality"><?php echo $row["title"] ?></p>
								<?php
									echo '<div class="rating">
														<i class="fas fa-star ' . ($row["ratings"] - 1 >= 0 ? "filled" : "") . '"></i>
														<i class="fas fa-star ' . ($row["ratings"] - 2 >= 0 ? "filled" : "") . '"></i>
														<i class="fas fa-star ' . ($row["ratings"] - 3 >= 0 ? "filled" : "") . '"></i>
														<i class="fas fa-star ' . ($row["ratings"] - 4 >= 0 ? "filled" : "") . '"></i>
														<i class="fas fa-star ' . ($row["ratings"] - 5 >= 0 ? "filled" : "") . '"></i>
														<span class="d-inline-block average-rating">(' . $row["ratings"] . '/5)</span>
													</div>';
									?>
									<div class="clinic-details">
										<p class="doc-location"><i class="fas fa-map-marker-alt"></i> <?php echo ucfirst($row["city"]) ?>, <?php echo ucfirst($row["country"]) ?> - <a href="javascript:void(0);">Get Directions</a></p>
									</div>
								</div>
							</div>
							<?php
							echo '<div class="doc-info-right">
							<div class="clini-infos">
								<ul>
									<li><i class="far fa-thumbs-up"></i> ' . (($row["ratings"] / 5) * 100) . '%</li>
									<li><i class="far fa-comment"></i> ' . $feedbacktotal . ' Feedback</li>
									<li><i class="fas fa-map-marker-alt"></i> ' . ucfirst($row["city"]) . ', ' . ucfirst($row["country"]) . '</li>
									<li><i class="far fa-money-bill-alt"></i> ' . ucfirst($row["cost"]) . ' <i class="fas fa-info-circle" data-toggle="tooltip" title="Lorem Ipsum"></i> </li>
								</ul>
							</div>
							<div class="clinic-booking">
								<a class="apt-btn" href="booking.php?' . md5(session_id() + "id") . '=' . $row["user_id"] . '">Book Appointment</a>
							</div>
						</div>';
							?>
						</div>
					</div>
				</div>
				<!-- /Doctor Widget -->

				<!-- Doctor Details Tab -->
				<div class="card">
					<div class="card-body pt-0">

						<!-- Tab Menu -->
						<nav class="user-tabs mb-4">
							<ul class="nav nav-tabs nav-tabs-bottom nav-justified">
								<li class="nav-item">
									<a class="nav-link active" href="#doc_overview" data-toggle="tab">Overview</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#doc_business_hours" data-toggle="tab">Business Hours</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#doc_reviews" data-toggle="tab">Reviews</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#doc_write_reviews" data-toggle="tab">Write Review</a>
								</li>
							</ul>
						</nav>
						<!-- /Tab Menu -->

						<!-- Tab Content -->
						<div class="tab-content pt-0">

							<!-- Overview Content -->
							<div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
								<div class="row">
									<div class="col-md-12 col-lg-9">

										<!-- About Details -->
										<div class="widget about-widget">
											<h4 class="widget-title">About Me</h4>
											<p><?php echo $row["description"]; ?></p>
										</div>
										<!-- /About Details -->
									</div>
								</div>
							</div>
							<!-- /Overview Content -->
							<!-- Reviews Content -->
							<div role="tabpanel" id="doc_reviews" class="tab-pane fade">

								<!-- Review Listing -->
								<div class="widget review-listing">
									<ul class="comments-list">
										<?php
										$feedbackquery = "SELECT * FROM feedback,users where feedback.from_user_id=users.user_id and feedback.to_doctor_id=" . $row["user_id"];
										$feedbackresult = $conn->query($feedbackquery);
										if ($feedbackresult->num_rows > 0) {
											while ($feedbackrow = $feedbackresult->fetch_assoc()) {
												echo '<!-- Comment List -->
									<li>
										<div class="comment">
											<img class="avatar avatar-sm rounded-circle" alt="User Image" src="assets/img/patients/patient.jpg">
											<div style="width:100%" class="comment-body">
												<div class="meta-data">
												
													<span class="comment-author">' . $feedbackrow["first_name"] . ' ' . $feedbackrow["last_name"] . ' </span>
													<span class="comment-date"><i>Reviewed on ' . date("l, M j, Y", strtotime($feedbackrow["feedback_datetime"])) . '</i></span>
													<p style="float: right;" class="recommended"><i class="far fa-thumbs-up"></i> I recommend the doctor</p>
													
													<p style="width:100%" class="comment-content">
													' . $feedbackrow["feedback"] . '
												</p>
												
													<div class="review-count rating">
														<i class="fas fa-star ' . ($feedbackrow["ratings"] - 1 >= 0 ? "filled" : "") . '"></i>
														<i class="fas fa-star ' . ($feedbackrow["ratings"] - 2 >= 0 ? "filled" : "") . '"></i>
														<i class="fas fa-star ' . ($feedbackrow["ratings"] - 3 >= 0 ? "filled" : "") . '"></i>
														<i class="fas fa-star ' . ($feedbackrow["ratings"] - 4 >= 0 ? "filled" : "") . '"></i>
														<i class="fas fa-star ' . ($feedbackrow["ratings"] - 5 >= 0 ? "filled" : "") . '"></i>
													</div>
												</div>
												
											</div>
										</div>
									</li>
									<!-- /Comment List -->';
											}
										}
										else
										{
											echo "<li>No Reviews. Be the first to review this profile!</li>";
										}
										?>
									</ul>
								</div>
								<!-- /Review Listing -->
							</div>
							<!-- /Reviews Content -->

							<!-- Business Hours Content -->
							<div role="tabpanel" id="doc_business_hours" class="tab-pane fade">
								<div class="row">
									<div class="col-md-6 offset-md-3">

										<!-- Business Hours Widget -->
										<div class="widget business-widget">
											<div class="widget-content">
												<div class="listing-hours">
													<div class="listing-day current">
														<div class="day">Today <span><?php echo date("l, M j, Y"); ?></span></div>
														<div class="time-items">
															<?php echo strtolower(trim($days[(date('w'))])) != strtolower(trim("Closed")) ? '<span style="font-size: 1.6rem" class="open-status"><span class="badge bg-success-light">Open Now</span></span>' : ''; ?>
															<span style="font-size: 1.6rem" class="time"><?php echo $businessHours[(date('w'))]; ?></span>
														</div>
													</div>
													<div class="listing-day">
														<div class="day">Monday</div>
														<div class="time-items">
															<span class="time"><?php echo $businessHours[0]; ?></span>
														</div>
													</div>
													<div class="listing-day">
														<div class="day">Tuesday</div>
														<div class="time-items">
															<span class="time"><?php echo $businessHours[0]; ?></span>
														</div>
													</div>
													<div class="listing-day">
														<div class="day">Wednesday</div>
														<div class="time-items">
															<span class="time"><?php echo $businessHours[0]; ?></span>
														</div>
													</div>
													<div class="listing-day">
														<div class="day">Thursday</div>
														<div class="time-items">
															<span class="time"><?php echo $businessHours[0]; ?></span>
														</div>
													</div>
													<div class="listing-day">
														<div class="day">Friday</div>
														<div class="time-items">
															<span class="time"><?php echo $businessHours[0]; ?></span>
														</div>
													</div>
													<div class="listing-day">
														<div class="day">Saturday</div>
														<div class="time-items">
															<span class="time"><?php echo $businessHours[0]; ?></span>
														</div>
													</div>
													<div class="listing-day closed">
														<div class="day">Sunday</div>
														<div class="time-items">
															<span class="time"><?php echo $businessHours[6]; ?></span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- /Business Hours Widget -->

									</div>
								</div>
							</div>
							<!-- /Business Hours Content -->


							<!--Write Reviews Content -->
							<div role="tabpanel" id="doc_write_reviews" class="tab-pane fade">

								<!-- Review Listing -->
								<div class="widget review-listing">
									<ul class="comments-list">


										<!-- Write Review -->
										<div class="write-review">
											<h4>Write a review for <strong>Dr. <?php echo ucfirst($row["first_name"]) . " " . ucfirst($row["last_name"]); ?></strong></h4>

											<!-- Write Review Form -->
											<form>
												<div class="form-group">
													<label>Review</label>
													<div class="star-rating">
														<input id="star-5" type="radio" name="rating" value="star-5">
														<label for="star-5" title="5 stars">
															<i class="active fa fa-star"></i>
														</label>
														<input id="star-4" type="radio" name="rating" value="star-4">
														<label for="star-4" title="4 stars">
															<i class="active fa fa-star"></i>
														</label>
														<input id="star-3" type="radio" name="rating" value="star-3">
														<label for="star-3" title="3 stars">
															<i class="active fa fa-star"></i>
														</label>
														<input id="star-2" type="radio" name="rating" value="star-2">
														<label for="star-2" title="2 stars">
															<i class="active fa fa-star"></i>
														</label>
														<input id="star-1" type="radio" name="rating" value="star-1">
														<label for="star-1" title="1 star">
															<i class="active fa fa-star"></i>
														</label>
													</div>
												</div>
												<div class="form-group">
													<label>Title of your review</label>
													<input class="form-control" type="text" placeholder="If you could say it in one sentence, what would you say?">
												</div>
												<div class="form-group">
													<label>Your review</label>
													<textarea id="review_desc" maxlength="100" class="form-control"></textarea>

													<div class="d-flex justify-content-between mt-3"><small class="text-muted"><span id="chars">100</span> characters remaining</small></div>
												</div>
												<hr>
												<div class="form-group">
													<div class="terms-accept">
														<div class="custom-checkbox">
															<input type="checkbox" id="terms_accept">
															<label for="terms_accept">I have read and accept <a href="#">Terms &amp; Conditions</a></label>
														</div>
													</div>
												</div>
												<div class="submit-section">
													<button type="submit" class="btn btn-primary submit-btn">Add Review</button>
												</div>
											</form>
											<!-- /Write Review Form -->

										</div>
										<!-- /Write Review -->

									</ul>
								</div>
								<!-- /Review Listing -->
							</div>
							<!-- /Write Reviews Content -->

						</div>
					</div>
				</div>
				<!-- /Doctor Details Tab -->

			</div>
		</div>
		
		<?php include("./includes/footer.php"); ?>

	</div>
	

	<!-- Voice Call Modal -->
	<div class="modal fade call-modal" id="voice_call">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<!-- Outgoing Call -->
					<div class="call-box incoming-box">
						<div class="call-wrapper">
							<div class="call-inner">
								<div class="call-user">
									<img alt="User Image" src="assets/img/doctors/doctor-thumb-02.jpg" class="call-avatar">
									<h4>Dr. Darren Elder</h4>
									<span>Connecting...</span>
								</div>
								<div class="call-items">
									<a href="javascript:void(0);" class="btn call-item call-end" data-dismiss="modal" aria-label="Close"><i class="material-icons">call_end</i></a>
									<a href="voice-call.php" class="btn call-item call-start"><i class="material-icons">call</i></a>
								</div>
							</div>
						</div>
					</div>
					<!-- Outgoing Call -->

				</div>
			</div>
		</div>
	</div>
	<!-- /Voice Call Modal -->

	<!-- Video Call Modal -->
	<div class="modal fade call-modal" id="video_call">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-body">

					<!-- Incoming Call -->
					<div class="call-box incoming-box">
						<div class="call-wrapper">
							<div class="call-inner">
								<div class="call-user">
									<img class="call-avatar" src="assets/img/doctors/doctor-thumb-02.jpg" alt="User Image">
									<h4>Dr. Darren Elder</h4>
									<span>Calling ...</span>
								</div>
								<div class="call-items">
									<a href="javascript:void(0);" class="btn call-item call-end" data-dismiss="modal" aria-label="Close"><i class="material-icons">call_end</i></a>
									<a href="video-call.php" class="btn call-item call-start"><i class="material-icons">videocam</i></a>
								</div>
							</div>
						</div>
					</div>
					<!-- /Incoming Call -->

				</div>
			</div>
		</div>
	</div>
	<!-- Video Call Modal -->
	<?php include("./includes/scripting.php"); ?>
</body>

</html>
