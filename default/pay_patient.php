<?php
header('Content-Type: application/json');
require_once 'includes/config.php'; // Assumes $con is defined here
require_once 'includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // Ensure database connection is valid
        if (!$con) {
            throw new Exception("Database connection failed.");
        }

        // Required fields
        $requiredFields = [
            'patientId' => 'Patient ID',
            'testType' => 'Test type',
            'testDate' => 'Test date',
            'doctorName' => 'Referring doctor',
            'paymentMethod' => 'Payment method',
            'patientName' => 'Patient name',
            'testCost' => 'Test cost'
        ];

        $missing = [];
        foreach ($requiredFields as $field => $label) {
            if (empty($_POST[$field])) {
                $missing[] = $label;
            }
        }

        if (!empty($missing)) {
            throw new Exception("Missing required fields: " . implode(', ', $missing));
        }

        // Sanitize inputs
        $patientId = intval($_POST['patientId']);
        $patientName = sanitizeInput($con, $_POST['patientName']);
        $testType = sanitizeInput($con, $_POST['testType']);
        $testDate = sanitizeInput($con, $_POST['testDate']);
        $testTime = !empty($_POST['testTime']) ? sanitizeInput($con, $_POST['testTime']) : null;
        $referringDoctor = sanitizeInput($con, $_POST['doctorName']);
        $paymentMethod = sanitizeInput($con, $_POST['paymentMethod']);
        $referenceNumber = !empty($_POST['referenceNumber']) ? sanitizeInput($con, $_POST['referenceNumber']) : null;
        $testCost = floatval(str_replace(['$', ','], '', $_POST['testCost']));
        $insuranceCoverage = isset($_POST['insuranceCoverage']) ? intval($_POST['insuranceCoverage']) : 0;
        $paymentStatus = isset($_POST['paymentStatus']) ? 1 : 0;

        // Validate date format
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $testDate)) {
            throw new Exception("Invalid date format. Use YYYY-MM-DD.");
        }

        // Validate time format if provided
        if ($testTime && !preg_match('/^\d{2}:\d{2}(:\d{2})?$/', $testTime)) {
            throw new Exception("Invalid time format. Use HH:MM or HH:MM:SS.");
        }

        // Calculate payment amount
        $paymentAmount = $testCost * (1 - $insuranceCoverage / 100);

        // Start transaction
        mysqli_begin_transaction($con);

        // Insert into lab_tests
        $labSql = "INSERT INTO lab_tests (patient_id, referring_doctor, test_type, test_date, test_time, test_cost)
                   VALUES (?, ?, ?, ?, ?, ?)";
        $labStmt = mysqli_prepare($con, $labSql);
        mysqli_stmt_bind_param($labStmt, 'issssd', $patientId, $referringDoctor, $testType, $testDate, $testTime, $testCost);
        if (!mysqli_stmt_execute($labStmt)) {
            throw new Exception("Error inserting lab test: " . mysqli_stmt_error($labStmt));
        }

        $testId = mysqli_insert_id($con);

        // Insert into payments
        $paymentSql = "INSERT INTO payments 
            (patient_id, full_name, amount, payment_date, payment_method, reference_number, doctor, test_type, insurance_coverage, status, created_at)
            VALUES (?, ?, ?, NOW(), ?, ?, ?, ?, ?, ?, NOW())";
        $payStmt = mysqli_prepare($con, $paymentSql);
        mysqli_stmt_bind_param($payStmt, 'isdsissii', $patientId, $patientName, $paymentAmount, $paymentMethod,
            $referenceNumber, $referringDoctor, $testType, $insuranceCoverage, $paymentStatus);
        if (!mysqli_stmt_execute($payStmt)) {
            throw new Exception("Error inserting payment: " . mysqli_stmt_error($payStmt));
        }

        $paymentId = mysqli_insert_id($con);

        // Commit
        mysqli_commit($con);

        echo json_encode([
            'status' => 'success',
            'message' => 'Lab test and payment saved successfully.',
            'data' => [
                'test' => [
                    'id' => $testId,
                    'patientId' => $patientId,
                    'testType' => $testType,
                    'testDate' => $testDate,
                    'testTime' => $testTime,
                    'testCost' => $testCost
                ],
                'payment' => [
                    'id' => $paymentId,
                    'amount' => $paymentAmount,
                    'status' => $paymentStatus ? 'Paid' : 'Pending'
                ]
            ]
        ]);
    } catch (Exception $e) {
        if ($con) {
            mysqli_rollback($con);
        }
        error_log("Lab Test Error: " . $e->getMessage());
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'An error occurred while processing the lab test.',
            'debug' => $e->getMessage() // Remove or comment out in production
        ]);
    } finally {
        if (isset($labStmt)) mysqli_stmt_close($labStmt);
        if (isset($payStmt)) mysqli_stmt_close($payStmt);
        if ($con) mysqli_close($con);
    }
} else {
    http_response_code(405);
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method. Only POST is allowed.'
    ]);
}
?>
