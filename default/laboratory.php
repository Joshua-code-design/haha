<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header('Location: doc_login.php');
        exit();
    }
    ?> 

<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
?>


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
    <meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="..\files\assets\images\favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="..\files\bower_components\bootstrap\css\bootstrap.min.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="..\files\assets\icon\feather\css\feather.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="..\files\assets\css\style.css">
    <link rel="stylesheet" type="text/css" href="..\files\assets\css\lab.css">
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
                        <Span>gastronet</span>
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
                                        <span class="input-group-addon search-close"><i class="feather icon-x"></i></span>
                                        <input type="text" class="form-control">
                                        <span class="input-group-addon search-btn"><i class="feather icon-search"></i></span>
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
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                    <?php 
                if (isset($_SESSION['username'])) {
                    echo htmlspecialchars($_SESSION['username']);
                } else {
                    echo "Guest";
                }
            ?>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <a href="#!">
                                                <i class="feather icon-settings"></i> Settings
                                            </a>
                                        </li>
                                        <li>
                                            <a href="user-profile.htm">
                                                <i class="feather icon-user"></i> Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="doc_login.php">
                                                <i class="feather icon-log-out"></i> Logout
                                            </a>
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
                                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                        <span class="pcoded-mtext">Dashboard</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="">
                                            <a href="view.php">
                                                <span class="">Manage Patients</span>
                                            </a>
                                        </li>
                                        <li class="active">
                                            <a href="laboratory.php">
                                                <span class="">Laboratory</span>                                            
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="medic.php">
                                                <span class="">Add medication</span>                                            
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
                                    
                                <div class="container py-4">
    <!-- Dashboard Header -->
    <div class="row mb-4 align-items-center">
        <div class="col">
            <h2 class="fw-bold text-primary mb-0">Recent Patients</h2>
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-primary" id="refreshPatients">
                <i class="bi bi-arrow-clockwise me-1"></i>Refresh
            </button>
        </div>
    </div>
    
    <!-- Patients Table with Pagination -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="ps-4">Patient</th>
                            <th scope="col">Age</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Chief Complaint</th>
                            <th scope="col" class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="patientsTableBody">
                        <?php
                        // Set up pagination
                        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                        $recordsPerPage = 10;
                        $offset = ($page - 1) * $recordsPerPage;
                        
                        // Count total records for pagination
                        $countQuery = "SELECT COUNT(*) as total FROM patients";
                        $countResult = mysqli_query($con, $countQuery);
                        $countRow = mysqli_fetch_assoc($countResult);
                        $totalRecords = $countRow['total'];
                        $totalPages = ceil($totalRecords / $recordsPerPage);
                        
                        // Fetch patients with pagination
                        $query = "SELECT * FROM patients ORDER BY id DESC LIMIT $offset, $recordsPerPage";
                        $result = mysqli_query($con, $query);
                        
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                
                                // Patient name with avatar
                                echo '<td class="ps-4">';
                                echo '<div class="d-flex align-items-center">';
                                echo '<div class="patient-avatar bg-light rounded-circle me-3 d-flex justify-content-center align-items-center" style="width: 36px; height: 36px;">';
                                echo '<span class="text-primary fw-bold">' . substr(htmlspecialchars($row['first_name']), 0, 1) . substr(htmlspecialchars($row['last_name']), 0, 1) . '</span>';
                                echo '</div>';
                                echo '<div class="fw-semibold">' . htmlspecialchars($row['first_name']) . ' ' . htmlspecialchars($row['last_name']) . '</div>';
                                echo '</div>';
                                echo '</td>';
                                
                                // Age
                                echo '<td>' . $row['age'] . '</td>';
                                
                                // Gender
                                echo '<td>' . $row['gender'] . '</td>';
                                
                                // Contact
                                echo '<td><span class="text-secondary"><i class="bi bi-telephone me-1"></i>' . htmlspecialchars($row['mobile_number']) . '</span></td>';
                                
                                // Diagnosis
                                echo '<td><span class="text-dark">' . htmlspecialchars($row['chief_complaint']) . '</span></td>';
                                
                                // Actions
                                echo '<td class="text-end pe-4">';
                                echo '<button class="btn btn-sm btn-primary me-2 add-lab-btn" data-patient-id="' . $row['id'] . '"><i class="bi bi-plus-circle me-1"></i>Lab Test</button>';
                                echo '<button class="btn btn-sm btn-success me-2 view-lab-results-btn" data-patient-id="' . $row['id'] . '" data-bs-toggle="modal" data-bs-target="#labResultsModal">
                                        <i class="bi bi-file-earmark-medical me-1"></i>Lab Results
                                      </button>';
                                echo '</td>';
                                
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="6" class="text-center py-4">';
                            echo '<div class="alert alert-info border-0 shadow-sm mb-0">';
                            echo '<i class="bi bi-info-circle me-2"></i>No patients found in the system.';
                            echo '</div>';
                            echo '</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Pagination Controls -->
    <?php if ($totalPages > 1): ?>
    <nav aria-label="Patient list pagination">
        <ul class="pagination justify-content-center">
            <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            
            <?php
            // Show limited page numbers with ellipsis
            $startPage = max(1, $page - 2);
            $endPage = min($totalPages, $page + 2);
            
            if ($startPage > 1) {
                echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
                if ($startPage > 2) {
                    echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                }
            }
            
            for ($i = $startPage; $i <= $endPage; $i++) {
                echo '<li class="page-item ' . (($page == $i) ? 'active' : '') . '">';
                echo '<a class="page-link" href="?page=' . $i . '">' . $i . '</a>';
                echo '</li>';
            }
            
            if ($endPage < $totalPages) {
                if ($endPage < $totalPages - 1) {
                    echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                }
                echo '<li class="page-item"><a class="page-link" href="?page=' . $totalPages . '">' . $totalPages . '</a></li>';
            }
            ?>
            
            <li class="page-item <?php echo ($page >= $totalPages) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
    <?php endif; ?>
</div>

<!-- Lab Test Modal -->
<div class="modal fade" id="labTestModal" tabindex="-1" aria-labelledby="labTestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="labTestModalLabel">Add Laboratory Test</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="labTestForm" class="needs-validation" novalidate>
                    <input type="hidden" id="labPatientId" name="patientId">
                    
                    <!-- Patient Information -->
                    <div class="mb-3">
                        <label for="patientName" class="form-label text-secondary fw-semibold small">PATIENT</label>
                        <input type="text" class="form-control form-control-lg bg-light" id="patientName" readonly>
                    </div>
                    
                    <!-- Test Information Section -->
                    <h6 class="mb-3 text-primary fw-semibold">Test Information</h6>
                    
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="doctorName" class="form-label text-secondary fw-semibold small">REFERRING DOCTOR<span class="text-danger">*</span></label>
                            <select class="form-select form-select-lg" id="doctorName" name="doctorName" required>
                                <option value="">Select Doctor</option>
                                <option value="Dr. Smith">Dr. Smith</option>
                                <option value="Dr. Johnson">Dr. Johnson</option>
                                <option value="Dr. Williams">Dr. Williams</option>
                                <option value="Dr. Brown">Dr. Brown</option>
                                <option value="Dr. Davis">Dr. Davis</option>
                            </select>
                            <div class="invalid-feedback">Please select a doctor</div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="testType" class="form-label text-secondary fw-semibold small">TEST TYPE<span class="text-danger">*</span></label>
                            <select class="form-select form-select-lg" id="testType" name="testType" required>
                                <option value="">Select Test Type</option>
                                <option value="Blood Test">Blood Test</option>
                                <option value="Urinalysis">Urinalysis</option>
                                <option value="X-Ray">X-Ray</option>
                                <option value="MRI">MRI</option>
                                <option value="CT Scan">CT Scan</option>
                                <option value="Ultrasound">Ultrasound</option>
                            </select>
                            <div class="invalid-feedback">Please select a test type</div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="testDate" class="form-label text-secondary fw-semibold small">TEST DATE<span class="text-danger">*</span></label>
                            <input type="date" class="form-control form-control-lg" id="testDate" name="testDate" required>
                            <div class="invalid-feedback">Please select a date</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="testTime" class="form-label text-secondary fw-semibold small">TIME</label>
                            <input type="time" class="form-control form-control-lg" id="testTime" name="testTime">
                        </div>
                    </div>
                    
                    <!-- Payment Information Section -->
                    <h6 class="mb-3 text-primary fw-semibold">Payment Information</h6>
                    
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="paymentStatus" class="form-label text-secondary fw-semibold small">PAYMENT STATUS</label>
                            <select class="form-select form-select-lg" id="paymentStatus" name="paymentStatus">
                                <option value="pending" selected>Pending</option>
                                <option value="partial">Partial</option>
                                <option value="paid">Paid</option>
                                <option value="insurance_covered">Insurance Covered</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="paymentAmount" class="form-label text-secondary fw-semibold small">AMOUNT</label>
                            <div class="input-group">
                                <input type="number" class="form-control form-control-lg" id="paymentAmount" name="paymentAmount" step="0.01" min="0" value="0.00">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="paymentMethod" class="form-label text-secondary fw-semibold small">PAYMENT METHOD</label>
                            <select class="form-select form-select-lg" id="paymentMethod" name="paymentMethod">
                                <option value="">Select Method</option>
                                <option value="cash">Cash</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="debit_card">Debit Card</option>
                                <option value="insurance">Insurance</option>
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light fw-semibold" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary fw-semibold px-4" id="saveLabTest">Schedule Test</button>
            </div>
        </div>
    </div>
</div>


<!-- Lab Results Modal -->
<div class="modal fade" id="labResultsModal" tabindex="-1" aria-labelledby="labResultsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="labResultsModalLabel">Lab Results</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="labResultsForm" enctype="multipart/form-data">
                    <input type="hidden" id="patientId" name="patientId">
                    <input type="hidden" id="testId" name="testId">
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="testType" class="form-label">Test Type</label>
                            <input type="text" class="form-control" id="testType" name="testType" required>
                        </div>
                        <div class="col-md-6">
                            <label for="testDate" class="form-label">Test Date</label>
                            <input type="date" class="form-control" id="testDate" name="testDate" required>
                        </div>
                        <div class="col-12">
                            <label for="resultsNotes" class="form-label">Notes</label>
                            <textarea class="form-control" id="resultsNotes" name="resultsNotes" rows="3"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="resultFiles" class="form-label">Upload Results</label>
                            <input class="form-control" type="file" id="resultFiles" name="resultFiles[]" multiple accept="image/*,.pdf,.doc,.docx">
                            <div class="form-text">You can upload multiple files (images, PDFs, or documents)</div>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Save Results
                        </button>
                    </div>
                </form>
                
                <hr class="my-4">
                
                <div id="existingResults">
                    <h5 class="mb-3">Existing Results</h5>
                    <div class="text-center py-3" id="noResultsMessage">
                        <i class="bi bi-info-circle me-2"></i> No results found for this patient.
                    </div>
                    <div id="resultsContainer" class="row"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
            

<!-- Toast Notification (keeping the same one) -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="responseToast" class="toast align-items-center border-0 shadow-sm" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body d-flex align-items-center">
                <i id="toastIcon" class="bi me-2"></i>
                <span id="toastMessage"></span>
            </div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>              
                                            
                                        </div>
                                    </div>
                                </div>

                                <div id="styleSelector">

                                </div>
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
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
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
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <script type="text/javascript" src="..\files\bower_components\jquery\js\jquery.min.js"></script>
    <script type="text/javascript" src="..\files\bower_components\jquery-ui\js\jquery-ui.min.js"></script>
    <script type="text/javascript" src="..\files\bower_components\popper.js\js\popper.min.js"></script>
    <script type="text/javascript" src="..\files\bower_components\bootstrap\js\bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="..\files\bower_components\jquery-slimscroll\js\jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="..\files\bower_components\modernizr\js\modernizr.js"></script>
    <script type="text/javascript" src="..\files\bower_components\modernizr\js\css-scrollbars.js"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="..\files\bower_components\chart.js\js\Chart.js"></script>
    <!-- amchart js -->
    <script src="..\files\assets\pages\widget\amchart\amcharts.js"></script>
    <script src="..\files\assets\pages\widget\amchart\serial.js"></script>
    <script src="..\files\assets\pages\widget\amchart\light.js"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="..\files\assets\js\SmoothScroll.js"></script>
    <script src="..\files\assets\js\pcoded.min.js"></script>
    <script src="..\files\assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="..\files\assets\js\vartical-layout.min.js"></script>
    <script type="text/javascript" src="..\files\assets\pages\dashboard\analytic-dashboard.min.js"></script>
    <script type="text/javascript" src="..\files\assets\js\script.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>

  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');

  $(document).ready(function() {
            // Handle form submission
            $('#registrationForm').on('submit', function(e) {
                e.preventDefault();
                
                $.ajax({
                    url: 'lab_test.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        showToast(response.status === 'success' ? 'Success' : 'Error', response.message);
                        if (response.status === 'success') {
                            $('#registrationForm')[0].reset();
                            // Reload patient list after 1 second
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    },
                    error: function() {
                        showToast('Error', 'An error occurred while processing your request.');
                    }
                });
            });
            
            // Handle Add Lab Test button click
            $(document).on('click', '.add-lab-btn', function() {
                const patientId = $(this).data('patient-id');
                $('#labPatientId').val(patientId);
                $('#testDate').val(new Date().toISOString().split('T')[0]);
                $('#labTestModal').modal('show');
            });
            
            $('#saveLabTest').on('click', function() {
    const formData = $('#labTestForm').serialize();

    $.ajax({
        url: 'lab_save_test.php',
        method: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            showToast(response.status === 'success' ? 'Success' : 'Error', response.message);
            if (response.status === 'success') {
                $('#labTestModal').modal('hide');
            }
        },
        error: function() {
            showToast('Error', 'An error occurred while saving the lab test.');
        }
    });
});

            
            // Show toast notification
            function showToast(title, message) {
                $('#toastTitle').text(title);
                $('#toastMessage').text(message);
                const toast = new bootstrap.Toast(document.getElementById('responseToast'));
                toast.show();
            }
        });

        
        document.addEventListener('DOMContentLoaded', function() {
    // Add click event for refresh button
    document.getElementById('refreshPatients').addEventListener('click', function() {
        location.reload();
    });
    
    // Setup for lab test modal buttons
    const addLabButtons = document.querySelectorAll('.add-lab-btn');
    addLabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const patientId = this.getAttribute('data-patient-id');
            // You'll need an AJAX call here to get patient name
            // For now, let's set a placeholder
            document.getElementById('labPatientId').value = patientId;
            document.getElementById('patientName').value = this.closest('tr').querySelector('.fw-semibold').textContent;
            
            const labTestModal = new bootstrap.Modal(document.getElementById('labTestModal'));
            labTestModal.show();
        });
    });
    
    // Setup for view details buttons
    const viewDetailsButtons = document.querySelectorAll('.view-details-btn');
    viewDetailsButtons.forEach(button => {
        button.addEventListener('click', function() {
            const patientId = this.getAttribute('data-patient-id');
            // Redirect to patient details page
            window.location.href = 'patient-details.php?id=' + patientId;
        });
    });

});



$(document).ready(function() {
    // When lab results button is clicked
    $('.view-lab-results-btn').click(function() {
        var patientId = $(this).data('patient-id');
        $('#patientId').val(patientId);
        
        // Clear previous data
        $('#testType').val('');
        $('#testDate').val('');
        $('#resultFiles').val('');
        $('#resultsNotes').val('');
        
        // Load existing results (you'll need to implement this)
        loadExistingResults(patientId);
    });
    
    // Form submission
    $('#labResultsForm').submit(function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        
        $.ajax({
            url: 'save_lab_results.php', // Your backend handler
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Handle success
                var patientId = $('#patientId').val();
                loadExistingResults(patientId);
                
                // Clear form
                $('#labResultsForm')[0].reset();
                
                // Show success message
                alert('Results saved successfully');
            },
            error: function(xhr, status, error) {
                // Handle error
                alert('Error saving results: ' + error);
            }
        });
    });
});

$(document).ready(function() {
    // When lab results button is clicked
    $(document).on('click', '.view-lab-results-btn', function() {
        var patientId = $(this).data('patient-id');
        $('#patientId').val(patientId);
        loadExistingResults(patientId);
    });

    // Load existing results
    function loadExistingResults(patientId) {
        $.ajax({
            url: 'lab_results.php',
            type: 'GET',
            data: { patientId: patientId },
            dataType: 'json',
            success: function(response) {
                var container = $('#resultsContainer');
                var noResults = $('#noResultsMessage');
                container.empty();
                
                if (response.success && response.data && response.data.length > 0) {
                    noResults.hide();
                    
                    response.data.forEach(function(result) {
                        var filesHtml = '';
                        
                        if (result.files && result.files.length > 0) {
                            filesHtml += '<div class="files-container mt-3">';
                            filesHtml += '<h6 class="small text-uppercase text-muted mb-2">Attachments</h6>';
                            filesHtml += '<div class="row g-2">';
                            
                            result.files.forEach(function(file) {
                                if (file.is_image) {
                                    filesHtml += `
                                        <div class="col-6 col-md-4 col-lg-3">
                                            <div class="file-thumbnail image-thumbnail" onclick="openImageModal('${file.path}')">
                                                <img src="${file.path}" class="img-fluid" alt="${file.original_name}">
                                                <div class="file-name">${file.original_name}</div>
                                            </div>
                                        </div>
                                    `;
                                } else {
                                    filesHtml += `
                                        <div class="col-6 col-md-4 col-lg-3">
                                            <div class="file-thumbnail document-thumbnail">
                                                <a href="${file.path}" target="_blank" class="text-decoration-none">
                                                    <div class="file-icon">
                                                        <i class="bi bi-file-earmark-text fs-3"></i>
                                                    </div>
                                                    <div class="file-name">${file.original_name}</div>
                                                </a>
                                            </div>
                                        </div>
                                    `;
                                }
                            });
                            
                            filesHtml += '</div></div>';
                        }
                        
                        var item = $(`
                            <div class="col-12 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h5 class="card-title mb-1">${result.test_type}</h5>
                                                <p class="card-subtitle text-muted small mb-3">
                                                    <i class="bi bi-calendar me-1"></i>${result.test_date}
                                                </p>
                                            </div>
                                            <button class="btn btn-sm btn-outline-primary add-more-results" 
                                                    data-test-id="${result.id}">
                                                <i class="bi bi-plus-lg"></i> Add More
                                            </button>
                                        </div>
                                        
                                        ${result.notes ? `<p class="card-text mb-3">${result.notes}</p>` : ''}
                                        
                                        ${filesHtml}
                                    </div>
                                </div>
                            </div>
                        `);
                        
                        container.append(item);
                    });
                } else {
                    noResults.show();
                }
            },
            error: function(xhr, status, error) {
                console.error("Error loading lab results:", error);
                alert('Error loading lab results. Please try again.');
            }
        });
    }

    // Image modal function
    window.openImageModal = function(src) {
        $('#imageModal').remove();
        
        $('body').append(`
            <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center p-0">
                            <img src="${src}" class="img-fluid" style="max-height: 80vh;">
                        </div>
                    </div>
                </div>
            </div>
        `);
        
        var modal = new bootstrap.Modal(document.getElementById('imageModal'));
        modal.show();
        
        $('#imageModal').on('hidden.bs.modal', function() {
            $(this).remove();
        });
    };
});




        
</script>
</body>

</html>
