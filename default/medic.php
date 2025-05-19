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
    <link rel="stylesheet" type="text/css" href="..\files\assets\css\medic.css">
    <link rel="stylesheet" type="text/css" href="..\files\assets\css\jquery.mCustomScrollbar.css">
</head>
<!-- Menu sidebar static layout -->
<style>
        .action-btns .btn {
            margin-right: 5px;
        }
        .action-btns .btn:last-child {
            margin-right: 0;
        }
    </style>
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
                                        <li class="">
                                            <a href="laboratory.php">
                                                <span class="">Laboratory</span>                                            
                                            </a>
                                        </li>
                                        <li class="active">
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
            <button class='btn btn-sm btn-primary med-btn' data-id='{$row['id']}' data-bs-toggle='modal' data-bs-target='#medicationModal'><i class='bi bi-capsule'></i> Meds</button>
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
    <!-- Medication Modal -->
    <div class="modal fade" id="medicationModal" tabindex="-1" aria-labelledby="medicationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="medicationModalLabel">Patient Medications</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="medicationForm" enctype="multipart/form-data">
          <input type="hidden" name="patient_id" id="medPatientId">
          
          <div class="mb-3">
            <label for="medicationName" class="form-label">Medication Name</label>
            <input type="text" class="form-control" id="medicationName" name="medication_name" required>
          </div>
          
          <div class="mb-3">
            <label for="dosage" class="form-label">Dosage</label>
            <input type="text" class="form-control" id="dosage" name="dosage" required>
          </div>
          
          <div class="mb-3">
            <label for="frequency" class="form-label">Frequency</label>
            <input type="text" class="form-control" id="frequency" name="frequency" placeholder="e.g., 2 times daily" required>
          </div>
          
          <div class="mb-3">
            <label for="medicationNotes" class="form-label">Notes</label>
            <textarea class="form-control" id="medicationNotes" name="notes" rows="3"></textarea>
          </div>
          
          <div class="mb-3">
            <label for="medicationImage" class="form-label">Medication Image</label>
            <input class="form-control" type="file" id="medicationImage" name="medication_image" accept="image/*">
            <small class="text-muted">Upload a picture of the medication if available</small>
          </div>
          
          <div class="text-end">
            <button type="submit" class="btn btn-primary">Add Medication</button>
          </div>
        </form>
        
        <hr>
        
        <div id="medicationList">
          <h6>Current Medications</h6>
          <div class="list-group" id="medicationsContainer">
            <!-- Medications will be loaded here via AJAX -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


                                </tbody>
                            </table>
                        </div>
                    </div>
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

 
// Make sure jQuery is loaded first
$(document).ready(function() {
    // When med button is clicked
    $('.med-btn').click(function() {
        var patientId = $(this).data('id');
        $('#medPatientId').val(patientId);
        loadMedications(patientId);
    });
    
    // Handle form submission
    $('#medicationForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        
        $.ajax({
            url: 'add_medication.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                try {
                    var data = JSON.parse(response);
                    if(data.success) {
                        alert('Medication added successfully');
                        loadMedications($('#medPatientId').val());
                        $('#medicationForm')[0].reset();
                    } else {
                        alert('Error: ' + (data.message || 'Unknown error'));
                    }
                } catch(e) {
                    alert('Error parsing response');
                }
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    });
    
    function loadMedications(patientId) {
        $.ajax({
            url: 'get_medications.php',
            type: 'GET',
            data: { patient_id: patientId },
            success: function(response) {
                $('#medicationsContainer').html(response);
            },
            error: function(xhr, status, error) {
                $('#medicationsContainer').html('<div class="list-group-item">Error loading medications</div>');
            }
        });
    }
});

</script>
</body>

</html>
