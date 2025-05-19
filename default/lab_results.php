<?php
require_once 'includes/config.php';

header('Content-Type: application/json');

$patientId = isset($_GET['patientId']) ? intval($_GET['patientId']) : 0;

if ($patientId <= 0) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid patient ID'
    ]);
    exit;
}

try {
    // Get patient info
    $stmt = $con->prepare("SELECT id, CONCAT(first_name, ' ', last_name) as name, age, gender 
                          FROM patients WHERE id = ?");
    $stmt->bind_param("i", $patientId);
    $stmt->execute();
    $patient = $stmt->get_result()->fetch_assoc();
    
    if (!$patient) {
        throw new Exception('Patient not found');
    }
    
    // Add initials for avatar
    $patient['initials'] = substr($patient['name'], 0, 2);
    
    // Get latest lab test for this patient
    $stmt = $con->prepare("SELECT * FROM lab_tests 
                          WHERE patient_id = ? 
                          ORDER BY test_date DESC, created_at DESC 
                          LIMIT 1");
    $stmt->bind_param("i", $patientId);
    $stmt->execute();
    $test = $stmt->get_result()->fetch_assoc();
    
    if (!$test) {
        echo json_encode([
            'status' => 'success',
            'data' => [
                'patient' => $patient,
                'message' => 'No lab tests found for this patient'
            ]
        ]);
        exit;
    }
    
    // Get test results
    $stmt = $con->prepare("SELECT * FROM lab_test_results WHERE test_id = ?");
    $stmt->bind_param("i", $test['id']);
    $stmt->execute();
    $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
    // Mock attachments (you would implement actual file handling)
    $attachments = [];
    if ($test['status'] === 'completed') {
        $attachments = [
            ['name' => 'Test_Results.pdf', 'url' => '#'],
            ['name' => 'Lab_Report.pdf', 'url' => '#']
        ];
    }
    
    echo json_encode([
        'status' => 'success',
        'data' => [
            'patient' => $patient,
            'test' => $test,
            'results' => $results,
            'attachments' => $attachments
        ]
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Error: ' . $e->getMessage()
    ]);
}