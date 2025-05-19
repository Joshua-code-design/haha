<?php
require_once 'includes/config.php';

header('Content-Type: application/json');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Validate required fields
$required = ['patientId', 'testType', 'testDate'];
foreach ($required as $field) {
    if (empty($_POST[$field])) {
        echo json_encode(['success' => false, 'message' => "Required field missing: $field"]);
        exit;
    }
}

// Process form data
$patientId = (int)$_POST['patientId'];
$testId = !empty($_POST['testId']) ? (int)$_POST['testId'] : null;
$testType = mysqli_real_escape_string($con, $_POST['testType']);
$testDate = mysqli_real_escape_string($con, $_POST['testDate']);
$resultsNotes = isset($_POST['resultsNotes']) ? mysqli_real_escape_string($con, $_POST['resultsNotes']) : '';

// File upload handling
$uploadDir = 'uploads/lab_results/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$uploadedFiles = [];
if (!empty($_FILES['resultFiles'])) {
    foreach ($_FILES['resultFiles']['tmp_name'] as $key => $tmpName) {
        if ($_FILES['resultFiles']['error'][$key] === UPLOAD_ERR_OK) {
            $originalName = basename($_FILES['resultFiles']['name'][$key]);
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
            $newFilename = uniqid('lab_') . '.' . $extension;
            $destination = $uploadDir . $newFilename;

            if (move_uploaded_file($tmpName, $destination)) {
                $uploadedFiles[] = [
                    'original' => $originalName,
                    'stored' => $newFilename,
                    'path' => $destination,
                    'type' => $_FILES['resultFiles']['type'][$key],
                    'size' => $_FILES['resultFiles']['size'][$key]
                ];
            }
        }
    }
}

// Database operations
mysqli_begin_transaction($con);

try {
    // Insert or update lab result
    if ($testId) {
        $query = "UPDATE lab_results SET 
                 test_type = '$testType',
                 test_date = '$testDate',
                 notes = '$resultsNotes'
                 WHERE id = $testId";
    } else {
        $query = "INSERT INTO lab_results 
                 (patient_id, test_type, test_date, notes) 
                 VALUES 
                 ($patientId, '$testType', '$testDate', '$resultsNotes')";
    }
    
    if (!mysqli_query($con, $query)) {
        throw new Exception("Failed to save lab result: " . mysqli_error($con));
    }
    
    $resultId = $testId ?: mysqli_insert_id($con);
    
    // Save files
    if (!empty($uploadedFiles)) {
        foreach ($uploadedFiles as $file) {
            $fileQuery = "INSERT INTO lab_result_files 
                         (result_id, original_name, stored_name, file_path, file_type, file_size) 
                         VALUES 
                         ($resultId, '{$file['original']}', '{$file['stored']}', '{$file['path']}', '{$file['type']}', {$file['size']})";
            
            if (!mysqli_query($con, $fileQuery)) {
                throw new Exception("Failed to save file record: " . mysqli_error($con));
            }
        }
    }
    
    mysqli_commit($con);
    echo json_encode(['success' => true, 'message' => 'Lab results saved successfully']);
    
} catch (Exception $e) {
    mysqli_rollback($con);
    
    // Clean up uploaded files if transaction failed
    foreach ($uploadedFiles as $file) {
        if (file_exists($file['path'])) {
            unlink($file['path']);
        }
    }
    
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>