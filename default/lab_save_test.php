<?php
// lab_save_test.php

// Include your database connection
require_once 'includes/config.php';

// Get form data
$patientId = $_POST['patientId'];
$doctorName = $_POST['doctorName'];
$testType = $_POST['testType'];
$testDate = $_POST['testDate'];
$testTime = $_POST['testTime'];
$paymentStatus = $_POST['paymentStatus'];
$paymentAmount = $_POST['paymentAmount'];
$paymentMethod = $_POST['paymentMethod'];

// Prepare SQL query to insert data
$query = "INSERT INTO lab_tests (patient_id, doctor_name, test_type, test_date, test_time, payment_status, payment_amount, payment_method) 
          VALUES ('$patientId', '$doctorName', '$testType', '$testDate', '$testTime', '$paymentStatus', '$paymentAmount', '$paymentMethod')";

// Execute the query
if (mysqli_query($con, $query)) {
    // Return success response
    echo json_encode(['status' => 'success', 'message' => 'Lab test saved successfully']);
} else {
    // Return error response
    echo json_encode(['status' => 'error', 'message' => 'Failed to save lab test: ' . mysqli_error($con)]);
}
?>
