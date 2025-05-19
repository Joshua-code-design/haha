<?php
// Set headers for JSON response
header('Content-Type: application/json');
ob_start();

require_once 'includes/config.php';
require_once 'includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $required = [
            'firstName', 'lastName', 'birthday', 'gender', 
            'admissionDate', 'admissionTime', 'recordNumber',
            'chiefComplaint', 'mobileNumber', 'city'
        ];
        
        foreach ($required as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("$field is required");
            }
        }

        // Sanitize and validate input data
        $firstName = sanitizeInput($con, $_POST['firstName']);
        $middleName = isset($_POST['middleName']) ? sanitizeInput($con, $_POST['middleName']) : null;
        $lastName = sanitizeInput($con, $_POST['lastName']);
        $birthdate = sanitizeInput($con, $_POST['birthday']);
        $age = (int)$_POST['age'];
        $gender = sanitizeInput($con, $_POST['gender']);
        $admissionDate = sanitizeInput($con, $_POST['admissionDate']);
        $admissionTime = sanitizeInput($con, $_POST['admissionTime']);
        $recordNumber = sanitizeInput($con, $_POST['recordNumber']);
        $chiefComplaint = sanitizeInput($con, $_POST['chiefComplaint']);
        $mobileNumber = sanitizeInput($con, $_POST['mobileNumber']);  // Added mobile number
        $city = sanitizeInput($con, $_POST['city']);  // Added city
        
        // Optional fields
        $allergies = isset($_POST['allergies']) ? sanitizeInput($con, $_POST['allergies']) : null;
        $medicalHistory = isset($_POST['medicalHistory']) ? sanitizeInput($con, $_POST['medicalHistory']) : null;
        $medications = isset($_POST['medications']) ? sanitizeInput($con, $_POST['medications']) : null;
        $socialHistory = isset($_POST['socialHistory']) ? sanitizeInput($con, $_POST['socialHistory']) : null;
        $temperature = isset($_POST['temperature']) ? sanitizeInput($con, $_POST['temperature']) : null;
        $pulse = isset($_POST['pulse']) ? sanitizeInput($con, $_POST['pulse']) : null;
        $respiratoryRate = isset($_POST['respiratoryRate']) ? sanitizeInput($con, $_POST['respiratoryRate']) : null;
        $bloodPressure = isset($_POST['bloodPressure']) ? sanitizeInput($con, $_POST['bloodPressure']) : null;

        $insertQuery = "INSERT INTO patients (
            first_name, middle_name, last_name, birthdate, age, gender,
            admission_date, admission_time, record_number,
            chief_complaint, allergies, medical_history, medications,
            social_history, temperature, pulse, respiratory_rate, blood_pressure,
            mobile_number, city  -- Added new fields to the query
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        

        $stmt = mysqli_prepare($con, $insertQuery);
        mysqli_stmt_bind_param($stmt, 'ssssisssssssssssssss',  // Added two more 's' for the new string fields
            $firstName, $middleName, $lastName, $birthdate, $age, $gender,
            $admissionDate, $admissionTime, $recordNumber,
            $chiefComplaint, $allergies, $medicalHistory, $medications,
            $socialHistory, $temperature, $pulse, $respiratoryRate, $bloodPressure,
            $mobileNumber, $city  // Added new parameters
        );

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Patient registration submitted successfully!'
            ]);
        } else {
            throw new Exception("Database error: " . mysqli_error($con));
        }
    } catch (Exception $e) {
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
}

// Close connection
mysqli_close($con);
ob_end_flush();
?>