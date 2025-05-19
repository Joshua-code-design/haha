<?php
require_once 'includes/config.php'; 

if (isset($_GET['patient_id'])) {
    $patientId = $_GET['patient_id'];
    
    $query = "SELECT * FROM patient_medications WHERE patient_id = ? ORDER BY created_at DESC";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $patientId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="list-group-item">';
            echo '<div class="d-flex w-100 justify-content-between">';
            echo '<h6 class="mb-1">' . htmlspecialchars($row['medication_name']) . '</h6>';
            echo '<small>' . date('M d, Y', strtotime($row['created_at'])) . '</small>';
            echo '</div>';
            echo '<p class="mb-1"><strong>Dosage:</strong> ' . htmlspecialchars($row['dosage']) . '</p>';
            echo '<p class="mb-1"><strong>Frequency:</strong> ' . htmlspecialchars($row['frequency']) . '</p>';
            if (!empty($row['notes'])) {
                echo '<p class="mb-1"><strong>Notes:</strong> ' . htmlspecialchars($row['notes']) . '</p>';
            }
            if (!empty($row['image_path'])) {
                echo '<img src="' . htmlspecialchars($row['image_path']) . '" class="img-thumbnail mt-2" style="max-height: 100px;">';
            }
            echo '</div>';
        }
    } else {
        echo '<div class="list-group-item">No medications found for this patient</div>';
    }
}
?>