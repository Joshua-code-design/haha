<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header('Location: doc_login.php');
        exit();
    }
    ?> <?php require_once 'includes/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>GASTRONET</title>
		<!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 10]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- Meta -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="#">
		<meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
		<meta name="author" content="#">
		<!-- Favicon icon -->
		<link rel="icon" href="..\files\assets\images\favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
		<!-- Google font-->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
		<!-- Required Fremwork -->
		<link rel="stylesheet" type="text/css" href="..\files\bower_components\bootstrap\css\bootstrap.min.css">
		<!-- feather Awesome -->
		<link rel="stylesheet" type="text/css" href="..\files\assets\icon\feather\css\feather.css">
		<!-- Style.css -->
		<link rel="stylesheet" type="text/css" href="..\files\assets\css\style.css">
		<link rel="stylesheet" type="text/css" href="..\files\assets\css\form.css">
		<link rel="stylesheet" type="text/css" href="..\files\assets\css\jquery.mCustomScrollbar.css">
	</head>
	<body>
		<!-- Pre-loader start -->
		<div class="theme-loader">
			<div class="ball-scale">
				<div class='contain'>
					<div class="ring">
						<div class="frame"></div>
					</div>
					<div class="ring">
						<div class="frame"></div>
					</div>
					<div class="ring">
						<div class="frame"></div>
					</div>
					<div class="ring">
						<div class="frame"></div>
					</div>
					<div class="ring">
						<div class="frame"></div>
					</div>
					<div class="ring">
						<div class="frame"></div>
					</div>
					<div class="ring">
						<div class="frame"></div>
					</div>
					<div class="ring">
						<div class="frame"></div>
					</div>
					<div class="ring">
						<div class="frame"></div>
					</div>
					<div class="ring">
						<div class="frame"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- Pre-loader end -->
		<div id="pcoded" class="pcoded">
			<div class="pcoded-overlay-box"></div>
			<div class="pcoded-container navbar-wrapper">
				<nav class="navbar header-navbar pcoded-header">
					<div class="navbar-wrapper">
						<div class="navbar-logo">
							<a class="mobile-menu" id="mobile-collapse" href="#!">
								<i class="feather icon-menu"></i>
							</a>
							<a href="index-1.htm">
								<Span>gastronet </span>
							</a>
							<a class="mobile-options">
								<i class="feather icon-more-horizontal"></i>
							</a>
						</div>
						<div class="navbar-container container-fluid">
							<ul class="nav-left">
								<li class="header-search">
									<div class="main-search morphsearch-search">
										<div class="input-group">
											<span class="input-group-addon search-close">
												<i class="feather icon-x"></i>
											</span>
											<input type="text" class="form-control">
											<span class="input-group-addon search-btn">
												<i class="feather icon-search"></i>
											</span>
										</div>
									</div>
								</li>
								<li>
									<a href="#!" onclick="javascript:toggleFullScreen()">
										<i class="feather icon-maximize full-screen"></i>
									</a>
								</li>
							</ul>
							<ul class="nav-right">
								<li class="user-profile header-notification">
									<div class="dropdown-primary dropdown">
										<div class="dropdown-toggle" data-toggle="dropdown"> <?php 
                if (isset($_SESSION['username'])) {
                    echo htmlspecialchars($_SESSION['username']);
                } else {
                    echo "Guest";
                }
            ?> <i class="feather icon-chevron-down"></i>
										</div>
										<ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
											<li>
												<a href="#!">
													<i class="feather icon-settings"></i> Settings </a>
											</li>
											<li>
												<a href="user-profile.htm">
													<i class="feather icon-user"></i> Profile </a>
											</li>
											<li>
												<a href="customer_login.php">
													<i class="feather icon-log-out"></i> Logout </a>
											</li>
										</ul>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</nav>
				<div class="pcoded-main-container">
					<div class="pcoded-wrapper">
						<nav class="pcoded-navbar">
							<div class="pcoded-inner-navbar main-menu">
								<div class="pcoded-navigatio-lavel">Navigation</div>
								<ul class="pcoded-item pcoded-left-item">
									<li class="pcoded-hasmenu active pcoded-trigger">
										<a href="javascript:void(0)">
											<span class="pcoded-micon">
												<i class="feather icon-home"></i>
											</span>
											<span class="pcoded-mtext">Dashboard</span>
										</a>
										<ul class="pcoded-submenu">
											<li class="active">
												<a href="nurse_index.php">
													<span class="">Patients</span>
												</a>
											</li>
											<li class="">
												<a href="nurse_view.php">
													<span class="">Manage Patients</span>
												</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</nav>
						<div class="pcoded-content">
							<div class="pcoded-inner-content">
								<div class="main-body">
									<div class="page-wrapper">
										<div class="container">
											<div class="form-container">
												<form id="registrationForm">
													<div class="form-step active">
														<h2 class="section-title">
															<i class="fas fa-user"></i> Patient Registration
														</h2>
														<!-- Patient Data -->
														<div class="form-row">
															<div class="form-column">
																<label class="form-label required">First Name</label>
																<input type="text" name="firstName" class="form-control" required>
															</div>
															<div class="form-column">
																<label class="form-label required">Last Name</label>
																<input type="text" name="lastName" class="form-control" required>
															</div>
															<div class="form-column">
																<label class="form-label required">Middle Name</label>
																<input type="text" name="middleName" class="form-control" required>
															</div>
															<div class="form-column">
																<label class="form-label required">Birthday</label>
																<input type="date" name="birthday" class="form-control" required onchange="calculateAge()">
															</div>
														</div>
														<div class="form-row">
															<div class="form-column">
																<label class="form-label">Age</label>
																<input type="number" name="age" id="age" class="form-control" readonly>
															</div>
															<div class="form-column">
																<label class="form-label required">Mobile Number</label>
																<input type="tel" name="mobileNumber" class="form-control" required>
															</div>
															<div class="form-column">
																<label class="form-label required">City</label>
																<input type="text" name="city" class="form-control" required>
															</div>
															<div class="form-column">
																<label class="form-label required">Street</label>
																<input type="text" name="street" class="form-control" required>
															</div>
														</div>
														<div class="form-row">
															<div class="form-column">
																<label class="form-label required">Medical Record Number</label>
																<input type="number" name="recordNumber" class="form-control" required>
															</div>
															<div class="form-column">
																<label class="form-label required">Gender</label>
																<div class="form-control">
																	<label>
																		<input type="radio" name="gender" value="Female" checked> Female </label>
																	<label>
																		<input type="radio" name="gender" value="Male"> Male </label>
																</div>
															</div>
															<div class="form-column">
																<label class="form-label required">Date of Admission</label>
																<input type="date" name="admissionDate" class="form-control" required>
															</div>
															<div class="form-column">
																<label class="form-label required">Time of Admission</label>
																<input type="time" name="admissionTime" class="form-control" required>
															</div>
														</div>
														<!-- Allergies -->
														<div class="form-row">
															<div class="form-column">
																<label class="form-label">Allergies</label>
																<textarea name="allergies" class="form-control">Penicillin (rash)</textarea>
															</div>
														</div>
														<div class="form-row">
															<div class="form-column">
																<label class="form-label required">Chief Complaint</label>
																<textarea name="chiefComplaint" class="form-control" required>Abdominal pain and bloating for the past two weeks.</textarea>
															</div>
														</div>
														<!-- Patient History -->
														<h3 class="section-title">Patient History</h3>
														<div class="form-row">
															<div class="form-column">
																<label class="form-label">Past Medical History</label>
																<textarea name="medicalHistory" class="form-control">Irritable Bowel Syndrome (IBS) diagnosed 3 years ago. No previous surgeries.</textarea>
															</div>
														</div>
														<!-- Medications
        <div class="form-row"><div class="form-column"><label class="form-label">Medications</label><textarea name="medications" class="form-control">Dicyclomine (Bentyl) as needed for IBS. Probiotic supplement daily.</textarea></div></div> -->
														<!-- Social History -->
														<div class="form-row">
															<div class="form-column">
																<label class="form-label">Social History</label>
																<textarea name="socialHistory" class="form-control">Non-smoker. Occasional alcohol use (1-2 drinks per week). Diet includes high fiber and low-fat foods.</textarea>
															</div>
														</div>
														<!-- Assessment -->
														<h3 class="section-title">Assessment - Vital Signs</h3>
														<div class="form-row">
															<div class="form-column">
																<label class="form-label">Temperature (°F)</label>
																<input type="number" step="0.1" name="temperature" class="form-control">
															</div>
															<div class="form-column">
																<label class="form-label">Pulse (bpm)</label>
																<input type="number" name="pulse" class="form-control">
															</div>
															<div class="form-column">
																<label class="form-label">Respiratory Rate (breaths/min)</label>
																<input type="number" name="respiratoryRate" class="form-control">
															</div>
															<div class="form-column">
																<label class="form-label">Blood Pressure</label>
																<input type="text" name="bloodPressure" class="form-control">
															</div>
														</div>
														<div class="success-message" id="successMessage">
															<i class="fas fa-check-circle"></i>
															<span id="successText">Registration submitted successfully!</span>
														</div>
														<div class="error-message" id="errorMessage">
															<i class="fas fa-exclamation-circle"></i>
															<span id="errorText"></span>
														</div>
														<div class="buttons-container">
															<button type="submit" class="btn btn-primary"> Submit <i class="fas fa-paper-plane"></i>
															</button>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
								<div id="styleSelector"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		<!-- Warning Section Starts -->
		<!-- Older IE warning message -->
		<!--[if lt IE 10]>
																																			<div class="ie-warning">
																																				<h1>Warning!!</h1>
																																				<p>You are using an outdated version of Internet Explorer, please upgrade 
																																			
																																					<br/>to any of the following web browsers to access this website.
																																		
																																				</p>
																																				<div class="iew-container">
																																					<ul class="iew-download">
																																						<li>
																																							<a href="http://www.google.com/chrome/">
																																								<img src="../files/assets/images/browser/chrome.png" alt="Chrome">
																																									<div>Chrome</div>
																																								</a>
																																							</li>
																																							<li>
																																								<a href="https://www.mozilla.org/en-US/firefox/new/">
																																									<img src="../files/assets/images/browser/firefox.png" alt="Firefox">
																																										<div>Firefox</div>
																																									</a>
																																								</li>
																																								<li>
																																									<a href="http://www.opera.com">
																																										<img src="../files/assets/images/browser/opera.png" alt="Opera">
																																											<div>Opera</div>
																																										</a>
																																									</li>
																																									<li>
																																										<a href="https://www.apple.com/safari/">
																																											<img src="../files/assets/images/browser/safari.png" alt="Safari">
																																												<div>Safari</div>
																																											</a>
																																										</li>
																																										<li>
																																											<a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
																																												<img src="../files/assets/images/browser/ie.png" alt="">
																																													<div>IE (9 & above)</div>
																																												</a>
																																											</li>
																																										</ul>
																																									</div>
																																									<p>Sorry for the inconvenience!</p>
																																								</div>
																																								<![endif]-->
		<!-- Warning Section Ends -->
		<!-- Required Jquery -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="assets/js/script.js"></script>
		<script data-cfasync="false" src="..\..\..\cdn-cgi\scripts\5c5dd728\cloudflare-static\email-decode.min.js"></script>
		<script type="text/javascript" src="..\files\bower_components\jquery\js\jquery.min.js"></script>
		<script type="text/javascript" src="..\files\bower_components\jquery-ui\js\jquery-ui.min.js"></script>
		<script type="text/javascript" src="..\files\bower_components\popper.js\js\popper.min.js"></script>
		<script type="text/javascript" src="..\files\bower_components\bootstrap\js\bootstrap.min.js"></script>
		<!-- jquery slimscroll js -->
		<script type="text/javascript" src="..\files\bower_components\jquery-slimscroll\js\jquery.slimscroll.js"></script>
		<!-- modernizr js -->
		<script type="text/javascript" src="..\files\bower_components\modernizr\js\modernizr.js"></script>
		<!-- Chart js -->
		<script type="text/javascript" src="..\files\bower_components\chart.js\js\Chart.js"></script>
		<!-- amchart js -->
		<script src="..\files\assets\pages\widget\amchart\amcharts.js"></script>
		<script src="..\files\assets\pages\widget\amchart\serial.js"></script>
		<script src="..\files\assets\pages\widget\amchart\light.js"></script>
		<script src="..\files\assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
		<script type="text/javascript" src="..\files\assets\js\SmoothScroll.js"></script>
		<script src="..\files\assets\js\pcoded.min.js"></script>
		<!-- custom js -->
		<script src="..\files\assets\js\vartical-layout.min.js"></script>
		<script type="text/javascript" src="..\files\assets\pages\dashboard\custom-dashboard.js"></script>
		<script type="text/javascript" src="..\files\assets\js\script.min.js"></script>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
		<script>
			window.dataLayer = window.dataLayer || [];

			function gtag() {
				dataLayer.push(arguments);
			}
			gtag('js', new Date());
			gtag('config', 'UA-23581568-13');

			function calculateAge() {
				const dob = new Date(document.querySelector('input[name="birthday"]').value);
				const today = new Date();
				let age = today.getFullYear() - dob.getFullYear();
				const month = today.getMonth();
				if (month < dob.getMonth() || (month === dob.getMonth() && today.getDate() < dob.getDate())) {
					age--;
				}
				document.getElementById('age').value = age;
			}
		</script>
	</body>
</html>