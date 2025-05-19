<?php
require_once 'includes/config.php'; 

if (isset($_GET['patient_id'])) {
    $patientId = $_GET['patient_id'];
    
    $query = "SELECT * FROM patient_medications WHERE patient_id = ? ORDER BY created_at DESC";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $patientId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Start modal HTML (placed once at the top)
    echo '<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Medication Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="modalImage" src="" class="img-fluid" style="max-height: 70vh;">
                    </div>
                </div>
            </div>
          </div>';
    
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
                echo '<div class="mt-2">';
                echo '<img src="' . htmlspecialchars($row['image_path']) . '" 
                      class="img-thumbnail medication-image" 
                      style="max-height: 200px; cursor: pointer;"
                      onclick="showImageModal(\'' . htmlspecialchars($row['image_path']) . '\')">';
                echo '</div>';
            }
            echo '</div>';
        }
    } else {
        echo '<div class="list-group-item">No medications found for this patient</div>';
    }
}
?>

<script>
function showImageModal(imageSrc) {
    var modal = new bootstrap.Modal(document.getElementById('imageModal'));
    document.getElementById('modalImage').src = imageSrc;
    modal.show();
}
</script>

<style>
.medication-image:hover {
    opacity: 0.9;
    border-color: #0d6efd;
}
</style>