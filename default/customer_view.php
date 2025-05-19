<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'patient') {
    header('Location: customer_login.php');
    exit();
}

require_once 'includes/config.php';
require_once 'includes/functions.php';

// Get the logged-in patient's data
$patient_id = $_SESSION['user_id'];
$stmt = $con->prepare("SELECT * FROM patients WHERE id = ?");
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
$patient = $result->fetch_assoc();

if (!$patient) {
    // Patient not found (shouldn't happen if login was valid)
    session_destroy();
    header('Location: customer_login.php');
    exit();
}

// Get lab tests for the patient
$lab_tests = [];
$stmt = $con->prepare("SELECT * FROM lab_tests WHERE patient_id = ? ORDER BY test_date DESC, test_time DESC");
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $lab_tests[] = $row;
}

// Get medications for the patient
$medications = [];
$stmt = $con->prepare("SELECT * FROM patient_medications WHERE patient_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $medications[] = $row;
}

// Get lab results for the patient
$lab_results = [];
$stmt = $con->prepare("SELECT lr.*, GROUP_CONCAT(lrf.original_name SEPARATOR '|') as files 
                      FROM lab_results lr 
                      LEFT JOIN lab_result_files lrf ON lr.id = lrf.result_id 
                      WHERE lr.patient_id = ? 
                      GROUP BY lr.id 
                      ORDER BY lr.test_date DESC");
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $lab_results[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>GASTRONET - Patient Portal</title>
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
		<link rel="icon" href="../files/assets/images/favicon.ico" type="image/x-icon">
		<!-- Google font-->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
		<!-- Required Fremwork -->
		<link rel="stylesheet" type="text/css" href="../files/bower_components/bootstrap/css/bootstrap.min.css">
		<!-- radial chart.css -->
		<link rel="stylesheet" href="../files/assets/pages/chart/radial/css/radial.css" type="text/css" media="all">
		<!-- feather Awesome -->
		<link rel="stylesheet" type="text/css" href="../files/assets/icon/feather/css/feather.css">
		<!-- Style.css -->
		<link rel="stylesheet" type="text/css" href="../files/assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="../files/assets/css/view.css">
		<link rel="stylesheet" type="text/css" href="../files/assets/css/jquery.mCustomScrollbar.css">
	</head>
    <style> 
        .medication-thumbnail {
    max-width: 100px;
    max-height: 100px;
    cursor: pointer;
    transition: transform 0.2s;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 2px;
}
.medication-thumbnail:hover {
    transform: scale(1.05);
    box-shadow: 0 0 8px rgba(0,0,0,0.2);
}
.modal-content {
    border-radius: 10px;
}
    </style>
	<!-- Menu sidebar static layout -->
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
                echo htmlspecialchars($_SESSION['username']);
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
												<a href="customer_view.php">
													<span class="">My Information</span>
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
										<div class="container-fluid">
											<div class="row">
												<div class="col-md-12">
													<div class="card">
                                                    <div class="card-header">
															<h4>My Patient Information</h4>
														</div>
														<div class="page-body">
    <div class="card">
        <div class="card-header">
            <h5>Patient Information</h5>
        </div>
        <div class="card-block">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Record Number:</strong> <?= htmlspecialchars($patient['record_number']) ?></p>
                    <p><strong>Full Name:</strong> <?= htmlspecialchars($patient['first_name'] . ' ' . $patient['middle_name'] . ' ' . $patient['last_name']) ?></p>
                    <p><strong>Birthdate:</strong> <?= htmlspecialchars($patient['birthdate']) ?></p>
                    <p><strong>Age:</strong> <?= htmlspecialchars($patient['age']) ?></p>
                    <p><strong>Gender:</strong> <?= htmlspecialchars($patient['gender']) ?></p>
                    <p><strong>Mobile Number:</strong> <?= htmlspecialchars($patient['mobile_number']) ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Address:</strong> <?= htmlspecialchars($patient['street'] . ', ' . $patient['city']) ?></p>
                    <p><strong>Ailment:</strong> <?= nl2br(htmlspecialchars($patient['patient_ailment'])) ?></p>
                    <p><strong>Allergies:</strong> <?= nl2br(htmlspecialchars($patient['allergies'])) ?></p>
                    <p><strong>Chief Complaint:</strong> <?= nl2br(htmlspecialchars($patient['chief_complaint'])) ?></p>
                    <p><strong>Medical History:</strong> <?= nl2br(htmlspecialchars($patient['medical_history'])) ?></p>
                    <p><strong>Social History:</strong> <?= nl2br(htmlspecialchars($patient['social_history'])) ?></p>
                </div>
            </div>
            <hr>
            <h6>Admission Details</h6>
            <p><strong>Date:</strong> <?= htmlspecialchars($patient['admission_date']) ?></p>
            <p><strong>Time:</strong> <?= htmlspecialchars($patient['admission_time']) ?></p>
            <hr>
            <h6>Vital Signs</h6>
            <p><strong>Temperature:</strong> <?= htmlspecialchars($patient['temperature']) ?></p>
            <p><strong>Pulse:</strong> <?= htmlspecialchars($patient['pulse']) ?></p>
            <p><strong>Respiratory Rate:</strong> <?= htmlspecialchars($patient['respiratory_rate']) ?></p>
            <p><strong>Blood Pressure:</strong> <?= htmlspecialchars($patient['blood_pressure']) ?></p>
            <hr>
            <p><strong>Registration Date:</strong> <?= htmlspecialchars($patient['registration_date']) ?></p>
        </div>
    </div>

   <!-- Lab Tests Section -->
<div class="card mt-4">
    <div class="card-header">
        <h5>My Lab Tests</h5>
    </div>
    <div class="card-block">
        <?php if (empty($lab_tests)): ?>
            <p>No lab tests found.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Test Type</th>
                            <th>Doctor</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Payment Status</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lab_tests as $test): ?>
                            <tr>
                                <td><?= htmlspecialchars($test['test_type']) ?></td>
                                <td><?= htmlspecialchars($test['doctor_name']) ?></td>
                                <td><?= htmlspecialchars($test['test_date']) ?></td>
                                <td><?= htmlspecialchars($test['test_time']) ?></td>
                                <td>
                                    <span class="badge badge-<?= $test['payment_status'] === 'Paid' ? 'success' : 'warning' ?>">
                                        <?= htmlspecialchars($test['payment_status']) ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars(number_format($test['payment_amount'], 2)) ?></td>
                                <td>
                                    <button class="btn btn-sm btn-warning labs-btn" data-id="<?= $test['id'] ?>" data-bs-toggle="modal" data-bs-target="#labResultsModal">
                                        <i class="bi bi-clipboard2-pulse"></i> View Results
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

    <!-- Medications Section -->
<div class="card mt-4">
    <div class="card-header">
        <h5>My Medications</h5>
    </div>
    <div class="card-block">
        <?php if (empty($medications)): ?>
            <p>No medications prescribed.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Medication</th>
                            <th>Image</th>
                            <th>Dosage</th>
                            <th>Frequency</th>
                            <th>Notes</th>
                            <th>Prescribed On</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($medications as $med): ?>
                            <tr>
                                <td><?= htmlspecialchars($med['medication_name']) ?></td>
                                <td>
                                    <?php if (!empty($med['image_path'])): ?>
                                        <img src="<?= htmlspecialchars($med['image_path']) ?>" 
                                             alt="<?= htmlspecialchars($med['medication_name']) ?>" 
                                             class="medication-thumbnail"
                                             data-image="<?= htmlspecialchars($med['image_path']) ?>"
                                             data-name="<?= htmlspecialchars($med['medication_name']) ?>">
                                    <?php else: ?>
                                        <span class="text-muted">No image</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($med['dosage']) ?></td>
                                <td><?= htmlspecialchars($med['frequency']) ?></td>
                                <td><?= nl2br(htmlspecialchars($med['notes'])) ?></td>
                                <td><?= htmlspecialchars(date('M j, Y', strtotime($med['created_at']))) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>


<!-- Modal for displaying medication image -->
<div class="modal fade" id="medicationImageModal" tabindex="-1" role="dialog" aria-labelledby="medicationImageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="medicationImageModalLabel">Medication: <span id="medicationName"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="modalMedicationImage" src="" class="img-fluid" alt="Medication Image">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal()">
                    <i class="feather icon-x"></i> Close
                </button>
                <button type="button" class="btn btn-primary" onclick="downloadImage()">
                    <i class="feather icon-download"></i> Download
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Lab Results Modal -->
<div class="modal fade" id="labResultsModal" tabindex="-1" aria-labelledby="labResultsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="labResultsModalLabel">Lab Results</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="labResultsContent">
                <!-- Content will be loaded via AJAX -->
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



													</div>
												</div>
											</div>
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
		<!-- Required Jquery -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script type="text/javascript" src="../files/bower_components/jquery/js/jquery.min.js"></script>
		<script type="text/javascript" src="../files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="../files/bower_components/popper.js/js/popper.min.js"></script>
		<script type="text/javascript" src="../files/bower_components/bootstrap/js/bootstrap.min.js"></script>
		<!-- jquery slimscroll js -->
		<script type="text/javascript" src="../files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
		<!-- modernizr js -->
		<script type="text/javascript" src="../files/bower_components/modernizr/js/modernizr.js"></script>
		<script type="text/javascript" src="../files/bower_components/modernizr/js/css-scrollbars.js"></script>
		<!-- Chart js -->
		<script type="text/javascript" src="../files/bower_components/chart.js/js/Chart.js"></script>
		<!-- Custom js -->
		<script src="../files/assets/js/pcoded.min.js"></script>
		<script src="../files/assets/js/vartical-layout.min.js"></script>
		<script src="../files/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
		<script type="text/javascript" src="../files/assets/js/script.js"></script>
        <script>
function showMedicationImage(imagePath) {
    $('#modalMedicationImage').attr('src', imagePath);
    $('#medicationImageModal').modal('show');
}


// Open modal with medication image
$(document).ready(function() {
    $('.medication-thumbnail').click(function() {
        const imageUrl = $(this).data('image');
        const medName = $(this).data('name');
        
        $('#modalMedicationImage').attr('src', imageUrl);
        $('#medicationName').text(medName);
        $('#medicationImageModal').modal('show');
    });
});

// Close modal function
function closeModal() {
    $('#medicationImageModal').modal('hide');
}

// Download image function
function downloadImage() {
    const imageSrc = $('#modalMedicationImage').attr('src');
    if (imageSrc) {
        const link = document.createElement('a');
        link.href = imageSrc;
        link.download = $('#medicationName').text() || 'medication_image';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
}

// Close modal when clicking outside or pressing ESC
$(document).keyup(function(e) {
    if (e.key === "Escape") {
        closeModal();
    }
});

// Alternative close method when clicking outside modal
$('#medicationImageModal').click(function(event) {
    if ($(event.target).is('#medicationImageModal')) {
        closeModal();
    }
});

$(document).ready(function() {
    // Handle lab results button click
    $('.labs-btn').click(function() {
        var patientId = $(this).data('id');
        $('#labResultsContent').html('<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>');
        
        // AJAX request to fetch lab results
        $.ajax({
            url: 'view_results.php',
            type: 'GET',
            data: { patient_id: patientId },
            success: function(response) {
                $('#labResultsContent').html(response);
            },
            error: function() {
                $('#labResultsContent').html('<div class="alert alert-danger">Failed to load lab results.</div>');
            }
        });
    });
});
</script>
	</body>
</html>