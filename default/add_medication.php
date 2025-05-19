<?php
require_once 'includes/config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patientId = $_POST['patient_id'];
    $medicationName = $_POST['medication_name'];
    $dosage = $_POST['dosage'];
    $frequency = $_POST['frequency'];
    $notes = $_POST['notes'];
    
    // Handle file upload
    $imagePath = '';
    if (isset($_FILES['medication_image']) && $_FILES['medication_image']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/medications/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $fileName = uniqid() . '_' . basename($_FILES['medication_image']['name']);
        $targetPath = $uploadDir . $fileName;
        
        if (move_uploaded_file($_FILES['medication_image']['tmp_name'], $targetPath)) {
            $imagePath = $targetPath;
        }
    }
    
    $query = "INSERT INTO patient_medications 
              (patient_id, medication_name, dosage, frequency, notes, image_path, created_at) 
              VALUES (?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $con->prepare($query);
    $stmt->bind_param("isssss", $patientId, $medicationName, $dosage, $frequency, $notes, $imagePath);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $stmt->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>