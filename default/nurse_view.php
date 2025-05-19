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
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="..\files\assets\images\favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="..\files\bower_components\bootstrap\css\bootstrap.min.css">
    <!-- radial chart.css -->
    <link rel="stylesheet" href="..\files\assets\pages\chart\radial\css\radial.css" type="text/css" media="all">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="..\files\assets\icon\feather\css\feather.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="..\files\assets\css\style.css">
    <link rel="stylesheet" type="text/css" href="..\files\assets\css\view.css">
    <link rel="stylesheet" type="text/css" href="..\files\assets\css\jquery.mCustomScrollbar.css">
</head>
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
                                            <a href="nurse_index.php">
                                                <span class="">Patients</span>
                                            </a>
                                        </li>
                                        <li class="active">
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

                                <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Registered Patients</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Mobile</th>
                                        <th>City</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM patients ORDER BY id DESC";
                                    $result = mysqli_query($con, $query);
                                    
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>
                                            <td>{$row['id']}</td>
                                            <td>{$row['first_name']} " . (!empty($row['middle_name']) ? substr($row['middle_name'], 0, 1) . ". " : "") . "{$row['last_name']}</td>
                                            <td>{$row['age']}</td>
                                            <td>{$row['gender']}</td>
                                            <td>{$row['mobile_number']}</td>
                                            <td>{$row['city']}</td>
                                            <td class='action-btns'>
                                                <button class='btn btn-sm btn-info view-btn' data-id='{$row['id']}'><i class='bi bi-eye'></i> View</button>
                                                <button class='btn btn-sm btn-warning update-btn' data-id='{$row['id']}'><i class='bi bi-pencil'></i> Update</button>
                                                <button class='btn btn-sm btn-danger delete-btn' data-id='{$row['id']}'><i class='bi bi-trash'></i> Delete</button>
                                            </td>
                                        </tr>";
                                    }
                                    
                                    if (mysqli_num_rows($result) == 0) {
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
            </div>
        </div>
    </div>

  
    <!-- View Patient Modal -->
    <div class="modal fade" id="viewPatientModal" tabindex="-1" aria-labelledby="viewPatientModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewPatientModalLabel">Patient Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="patientDetails">
                    <!-- Patient details will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Patient Modal -->
    <div class="modal fade" id="updatePatientModal" tabindex="-1" aria-labelledby="updatePatientModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updatePatientModalLabel">Update Patient</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updatePatientForm" method="POST">
                    <input type="hidden" id="updateId" name="id">
                    <div class="modal-body" id="updatePatientFormBody">
                        <!-- Update form will be loaded here -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Patient</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deletePatientModal" tabindex="-1" aria-labelledby="deletePatientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePatientModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this patient record? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
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
    <!-- Google map js -->
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="..\files\assets\pages\google-maps\gmaps.js"></script>
    <!-- gauge js -->
    <script src="..\files\assets\pages\widget\gauge\gauge.min.js"></script>
    <script src="..\files\assets\pages\widget\amchart\amcharts.js"></script>
    <script src="..\files\assets\pages\widget\amchart\serial.js"></script>
    <script src="..\files\assets\pages\widget\amchart\gauge.js"></script>
    <script src="..\files\assets\pages\widget\amchart\pie.js"></script>
    <script src="..\files\assets\pages\widget\amchart\light.js"></script>
    <!-- Custom js -->
    <script src="..\files\assets\js\pcoded.min.js"></script>
    <script src="..\files\assets\js\vartical-layout.min.js"></script>
    <script src="..\files\assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="..\files\assets\pages\dashboard\crm-dashboard.min.js"></script>
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
            $('#patientForm').on('submit', function(e) {
                e.preventDefault();
                
                $.ajax({
                    url: 'process_patient.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            alert(response.message);
                            $('#addPatientModal').modal('hide');
                            location.reload();
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function() {
                        alert('An error occurred while processing your request.');
                    }
                });
            });
            
            // View patient details
            $('.view-btn').on('click', function() {
                const patientId = $(this).data('id');
                
                $.ajax({
                    url: 'get_patient.php',
                    method: 'GET',
                    data: { id: patientId, action: 'view' },
                    success: function(response) {
                        $('#patientDetails').html(response);
                        $('#viewPatientModal').modal('show');
                    },
                    error: function() {
                        alert('Error loading patient details');
                    }
                });
            });
            
            // Load update form
            $('.update-btn').on('click', function() {
                const patientId = $(this).data('id');
                
                $.ajax({
                    url: 'get_patient.php',
                    method: 'GET',
                    data: { id: patientId, action: 'update' },
                    success: function(response) {
                        $('#updatePatientFormBody').html(response);
                        $('#updateId').val(patientId);
                        $('#updatePatientModal').modal('show');
                    },
                    error: function() {
                        alert('Error loading patient data for update');
                    }
                });
            });
            
            $('#updatePatientForm').on('submit', function(e) {
    e.preventDefault();
    
    $.ajax({
        url: 'update_patient.php',
        method: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                alert(response.message);
                $('#updatePatientModal').modal('hide');
                location.reload();
            } else {
                alert(response.message);
            }
        },
        error: function(xhr, status, error) {
            try {
                // Try to parse the response as JSON first
                var response = JSON.parse(xhr.responseText);
                alert(response.message || 'An error occurred');
            } catch (e) {
                // If not JSON, show raw response for debugging
                console.error(xhr.responseText);
                alert('Server error: Please check console for details');
            }
        }
    });
});       // Delete patient
            let patientToDelete = null;
            
            $('.delete-btn').on('click', function() {
                patientToDelete = $(this).data('id');
                $('#deletePatientModal').modal('show');
            });
            
            $('#confirmDelete').on('click', function() {
                if (patientToDelete) {
                    $.ajax({
                        url: 'delete_patient.php',
                        method: 'POST',
                        data: { id: patientToDelete },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                alert(response.message);
                                $('#deletePatientModal').modal('hide');
                                location.reload();
                            } else {
                                alert('Error: ' + response.message);
                            }
                        },
                        error: function() {
                            alert('An error occurred while deleting the patient.');
                        }
                    });
                }
            });
        });

</script>
</body>

</html>
