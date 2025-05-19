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
    
    // Get lab results with their files
    $stmt = $con->prepare("SELECT lr.*, 
                          GROUP_CONCAT(CONCAT_WS('||', lrf.id, lrf.original_name, lrf.file_path, lrf.file_type) AS files
                          FROM lab_results lr
                          LEFT JOIN lab_result_files lrf ON lrf.result_id = lr.id
                          WHERE lr.patient_id = ?
                          GROUP BY lr.id
                          ORDER BY lr.test_date DESC");
    $stmt->bind_param("i", $patientId);
    $stmt->execute();
    $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
    // Process results to format files properly
    foreach ($results as &$result) {
        $result['files'] = [];
        if (!empty($result['files'])) {
            $fileEntries = explode(',', $result['files']);
            foreach ($fileEntries as $entry) {
                $parts = explode('||', $entry);
                if (count($parts) >= 4) {
                    $result['files'][] = [
                        'id' => $parts[0],
                        'original_name' => $parts[1],
                        'path' => $parts[2],
                        'type' => $parts[3],
                        'is_image' => strpos($parts[3], 'image/') === 0
                    ];
                }
            }
        }
    }
    
    echo json_encode([
        'status' => 'success',
        'data' => [
            'patient' => $patient,
            'lab_results' => $results
        ]
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Error: ' . $e->getMessage()
    ]);
}
?>