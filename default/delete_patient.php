<?php
header('Content-Type: application/json');
require_once 'includes/config.php'; // Ensure this contains your database connection

// Only allow POST requests
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(405); // Method Not Allowed
    echo json_encode([
        'status' => 'error',
        'message' => 'Only POST method is allowed'
    ]);
    exit;
}

try {
    // Validate input
    if (empty($_POST['id'])) {
        throw new Exception("Patient ID is required");
    }

    $id = (int)$_POST['id'];
    if ($id <= 0) {
        throw new Exception("Invalid Patient ID");
    }

    // Begin transaction for atomic operations
    mysqli_begin_transaction($con);

    try {
        // First delete all lab tests for this patient
        $deleteLabTestsQuery = "DELETE FROM lab_tests WHERE patient_id = ?";
        $stmtLabTests = mysqli_prepare($con, $deleteLabTestsQuery);
        
        if (!$stmtLabTests) {
            throw new Exception("Database error: " . mysqli_error($con));
        }
        
        mysqli_stmt_bind_param($stmtLabTests, 'i', $id);
        mysqli_stmt_execute($stmtLabTests);

        // Then delete the patient
        $deletePatientQuery = "DELETE FROM patients WHERE id = ?";
        $stmtPatient = mysqli_prepare($con, $deletePatientQuery);
        
        if (!$stmtPatient) {
            throw new Exception("Database error: " . mysqli_error($con));
        }
        
        mysqli_stmt_bind_param($stmtPatient, 'i', $id);
        mysqli_stmt_execute($stmtPatient);

        // Check if patient was actually deleted
        if (mysqli_affected_rows($con) === 0) {
            mysqli_rollback($con);
            throw new Exception("No patient found with that ID or already deleted");
        }

        // Commit the transaction if all went well
        mysqli_commit($con);

        echo json_encode([
            'status' => 'success',
            'message' => 'Patient and all associated lab tests deleted successfully'
        ]);

    } catch (Exception $e) {
        // Rollback if any operation fails
        mysqli_rollback($con);
        throw $e;
    }

} catch (Exception $e) {
    http_response_code(400); // Bad Request
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
} finally {
    // Close statements if they exist
    if (isset($stmtLabTests)) mysqli_stmt_close($stmtLabTests);
    if (isset($stmtPatient)) mysqli_stmt_close($stmtPatient);
    
    // Close connection
    mysqli_close($con);
}