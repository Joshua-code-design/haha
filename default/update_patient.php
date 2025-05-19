<?php
header('Content-Type: application/json');
ob_start();

require_once 'includes/config.php';
require_once 'includes/functions.php';

$response = ['status' => 'error', 'message' => 'Unknown error'];

try {
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        throw new Exception("Invalid request method");
    }

    // Check if recordNumber exists
    if (empty($_POST['recordNumber'])) {
        throw new Exception("Patient ID is required for update");
    }

    // Sanitize and validate input data
    $recordNumber = sanitizeInput($con, $_POST['recordNumber']);
    $firstName = sanitizeInput($con, $_POST['firstName']);
    $middleName = isset($_POST['middleName']) ? sanitizeInput($con, $_POST['middleName']) : null;
    $lastName = sanitizeInput($con, $_POST['lastName']);
    $birthdate = sanitizeInput($con, $_POST['birthday']);
    $age = (int)$_POST['age'];
    $gender = sanitizeInput($con, $_POST['gender']);
    $chiefComplaint = sanitizeInput($con, $_POST['chiefComplaint']);
    $mobileNumber = sanitizeInput($con, $_POST['mobileNumber']);
    $city = sanitizeInput($con, $_POST['city']);
    
    // Optional fields with null coalescing
    $allergies = $_POST['allergies'] ?? null;
    $medicalHistory = $_POST['medicalHistory'] ?? null;
    $medications = $_POST['medications'] ?? null;
    $socialHistory = $_POST['socialHistory'] ?? null;
    $temperature = $_POST['temperature'] ?? null;
    $pulse = $_POST['pulse'] ?? null;
    $respiratoryRate = $_POST['respiratoryRate'] ?? null;
    $bloodPressure = $_POST['bloodPressure'] ?? null;

    $updateQuery = "UPDATE patients SET 
        first_name = ?,
        middle_name = ?,
        last_name = ?,
        birthdate = ?,
        age = ?,
        gender = ?,
        chief_complaint = ?,
        allergies = ?,
        medical_history = ?,
        medications = ?,
        social_history = ?,
        temperature = ?,
        pulse = ?,
        respiratory_rate = ?,
        blood_pressure = ?,
        mobile_number = ?,
        city = ?
        WHERE record_number = ?";

    $stmt = mysqli_prepare($con, $updateQuery);
    if (!$stmt) {
        throw new Exception("Database preparation error: " . mysqli_error($con));
    }

    // Bind parameters - COUNT MUST MATCH NUMBER OF ? IN QUERY
    $bindResult = mysqli_stmt_bind_param(
        $stmt, 
        'ssssissssssssssssi',  // 18 parameters total
        $firstName, $middleName, $lastName, $birthdate, $age, $gender,
        $chiefComplaint, $allergies, $medicalHistory, $medications,
        $socialHistory, $temperature, $pulse, $respiratoryRate, $bloodPressure,
        $mobileNumber, $city, $recordNumber
    );

    if (!$bindResult) {
        throw new Exception("Parameter binding error: " . mysqli_stmt_error($stmt));
    }

    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Database execution error: " . mysqli_stmt_error($stmt));
    }

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $response = ['status' => 'success', 'message' => 'Patient updated successfully!'];
    } else {
        $response = ['status' => 'info', 'message' => 'No changes made to patient record'];
    }
} catch (Exception $e) {
    $response = ['status' => 'error', 'message' => $e->getMessage()];
} finally {
    // Clean any output buffers
    while (ob_get_level() > 0) {
        ob_end_clean();
    }
    
    echo json_encode($response);
    exit;
}