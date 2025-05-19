<?php
require_once 'includes/config.php';

if (isset($_GET['patient_id'])) {
    $patientId = intval($_GET['patient_id']);
    
    // First include the modal HTML structure
    echo '
    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="img-fluid" style="max-height: 80vh;">
                </div>
            </div>
        </div>
    </div>
    
    <script>
    function showImageModal(imageSrc) {
        var modal = new bootstrap.Modal(document.getElementById(\'imageModal\'));
        document.getElementById(\'modalImage\').src = imageSrc;
        modal.show();
    }
    </script>
    ';
    
    // Query to get lab results
    $query = "SELECT lr.*, GROUP_CONCAT(lrf.original_name SEPARATOR '|') as files, 
              GROUP_CONCAT(lrf.file_path SEPARATOR '|') as file_paths,
              GROUP_CONCAT(lrf.file_type SEPARATOR '|') as file_types
              FROM lab_results lr
              LEFT JOIN lab_result_files lrf ON lr.id = lrf.result_id
              WHERE lr.patient_id = ?
              GROUP BY lr.id
              ORDER BY lr.test_date DESC";
    
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $patientId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo '<div class="table-responsive">';
        echo '<table class="table table-striped">';
        echo '<thead><tr><th>Test Type</th><th>Test Date</th><th>Notes</th><th>Files</th></tr></thead>';
        echo '<tbody>';
        
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['test_type']) . '</td>';
            echo '<td>' . htmlspecialchars($row['test_date']) . '</td>';
            echo '<td>' . nl2br(htmlspecialchars($row['notes'])) . '</td>';
            
            // Display files
            echo '<td>';
            if (!empty($row['files'])) {
                $files = explode('|', $row['files']);
                $paths = explode('|', $row['file_paths']);
                $types = explode('|', $row['file_types']);
                
                for ($i = 0; $i < count($files); $i++) {
                    if (strpos($types[$i], 'image') !== false) {
                        echo '<div class="mb-3">';
                        echo '<p class="small mb-1">' . htmlspecialchars($files[$i]) . '</p>';
                        echo '<img src="' . htmlspecialchars($paths[$i]) . '" 
                             class="img-thumbnail" 
                             style="max-height: 200px; cursor: pointer;" 
                             onclick="showImageModal(\'' . htmlspecialchars($paths[$i]) . '\')"
                             alt="' . htmlspecialchars($files[$i]) . '">';
                        echo '<a href="javascript:void(0)" onclick="showImageModal(\'' . htmlspecialchars($paths[$i]) . '\')" class="d-block small mt-1">View full size</a>';
                        echo '</div>';
                    } else {
                        echo '<div class="mb-2">';
                        echo '<a href="' . htmlspecialchars($paths[$i]) . '" target="_blank" class="d-block">';
                        echo '<i class="bi bi-file-earmark"></i> ' . htmlspecialchars($files[$i]);
                        echo '</a>';
                        echo '</div>';
                    }
                }
            } else {
                echo 'No files';
            }
            echo '</td>';
            
            echo '</tr>';
        }
        
        echo '</tbody></table></div>';
    } else {
        echo '<div class="alert alert-info">No lab results found for this patient.</div>';
    }
} else {
    echo '<div class="alert alert-danger">Invalid request.</div>';
}
?>