<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = (int)$_GET['id'];
    $action = $_GET['action'];
    
    $query = "SELECT * FROM patients WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    
    // Get the result set from the prepared statement
    $result = mysqli_stmt_get_result($stmt);
    $patient = mysqli_fetch_assoc($result);
    
    if (!$patient) {
        die("Patient not found");
    }
    
    // Helper function to safely handle null values for htmlspecialchars
    function safe_html($value) {
        return htmlspecialchars((string)($value ?? ''));
    }
    
    if ($action === 'view') {
        // Display patient details
        echo '<div class="row mb-3">
                <div class="col-md-4"><strong>Name:</strong></div>
                <div class="col-md-8">' . safe_html($patient['first_name']) . ' ' . 
                (!empty($patient['middle_name']) ? safe_html(substr($patient['middle_name'], 0, 1)) . '. ' : '') . 
                safe_html($patient['last_name']) . '</div>
              </div>';
        echo '<div class="row mb-3">
                <div class="col-md-4"><strong>Birthdate:</strong></div>
                <div class="col-md-8">' . safe_html($patient['birthdate']) . '</div>
              </div>';
        echo '<div class="row mb-3">
                <div class="col-md-4"><strong>Age:</strong></div>
                <div class="col-md-8">' . safe_html($patient['age']) . '</div>
              </div>';
        echo '<div class="row mb-3">
                <div class="col-md-4"><strong>Gender:</strong></div>
                <div class="col-md-8">' . safe_html($patient['gender']) . '</div>
              </div>';
        echo '<div class="row mb-3">
                <div class="col-md-4"><strong>Mobile Number:</strong></div>
                <div class="col-md-8">' . safe_html($patient['mobile_number']) . '</div>
              </div>';
        echo '<div class="row mb-3">
                <div class="col-md-4"><strong>Address:</strong></div>
                <div class="col-md-8">' . safe_html($patient['street']) . ', ' . safe_html($patient['city']) . '</div>
              </div>';
        echo '<div class="row mb-3">
                <div class="col-md-4"><strong>Admission Date:</strong></div>
                <div class="col-md-8">' . safe_html($patient['admission_date']) . '</div>
              </div>';
        echo '<div class="row mb-3">
                <div class="col-md-4"><strong>Admission Time:</strong></div>
                <div class="col-md-8">' . safe_html($patient['admission_time']) . '</div>
              </div>';
        echo '<div class="row mb-3">
                <div class="col-md-4"><strong>Record Number:</strong></div>
                <div class="col-md-8">' . safe_html($patient['record_number']) . '</div>
              </div>';
        echo '<div class="row mb-3">
                <div class="col-md-4"><strong>Chief Complaint:</strong></div>
                <div class="col-md-8">' . nl2br(safe_html($patient['chief_complaint'])) . '</div>
              </div>';
        echo '<div class="row mb-3">
                <div class="col-md-4"><strong>Allergies:</strong></div>
                <div class="col-md-8">' . nl2br(safe_html($patient['allergies'])) . '</div>
              </div>';
        echo '<div class="row mb-3">
                <div class="col-md-4"><strong>Medical History:</strong></div>
                <div class="col-md-8">' . nl2br(safe_html($patient['medical_history'])) . '</div>
              </div>';
        echo '<div class="row mb-3">
                <div class="col-md-4"><strong>Social History:</strong></div>
                <div class="col-md-8">' . nl2br(safe_html($patient['social_history'])) . '</div>
              </div>';
        echo '<div class="row mb-3">
                <div class="col-md-4"><strong>Vital Signs:</strong></div>
                <div class="col-md-8">
                    <div><strong>Temperature:</strong> ' . safe_html($patient['temperature']) . '</div>
                    <div><strong>Pulse:</strong> ' . safe_html($patient['pulse']) . '</div>
                    <div><strong>Respiratory Rate:</strong> ' . safe_html($patient['respiratory_rate']) . '</div>
                    <div><strong>Blood Pressure:</strong> ' . safe_html($patient['blood_pressure']) . '</div>
                </div>
              </div>';
        
        // Fetch and display lab tests
$labQuery = "SELECT * FROM lab_tests WHERE patient_id = ? ORDER BY test_date DESC";
$labStmt = mysqli_prepare($con, $labQuery);
mysqli_stmt_bind_param($labStmt, 'i', $id);
mysqli_stmt_execute($labStmt);
$labResult = mysqli_stmt_get_result($labStmt);

if (mysqli_num_rows($labResult) > 0) {
    echo '<div class="row mb-3">
            <div class="col-12">
                <h5 class="mt-4">Lab Tests</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Test Type</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Referring Doctor</th>
                                <th>Payment Status</th>
                                <th>Payment Amount</th>
                                <th>Payment Method</th>
                            </tr>
                        </thead>
                        <tbody>';

    while ($labTest = mysqli_fetch_assoc($labResult)) {
        echo '<tr>
                <td>' . safe_html($labTest['test_type']) . '</td>
                <td>' . safe_html($labTest['test_date']) . '</td>
                <td>' . safe_html($labTest['test_time']) . '</td>
                <td>' . safe_html($labTest['doctor_name']) . '</td>
                <td>' . safe_html($labTest['payment_status']) . '</td>
                <td>' . safe_html($labTest['payment_amount']) . '</td>
                <td>' . safe_html($labTest['payment_method']) . '</td>
              </tr>';
    }

    echo '      </tbody>
                </table>
            </div>
        </div>
      </div>';
} else {
    echo '<div class="row mb-3">
            <div class="col-12">
                <h5 class="mt-4">Lab Tests</h5>
                <p>No lab tests recorded for this patient.</p>
            </div>
          </div>';
}

        
    } elseif ($action === 'update') {
        // Display update form with safe_html
        echo '<div class="row">
                <div class="col-md-4 mb-3">
                    <label for="updateFirstName" class="form-label">First Name*</label>
                    <input type="text" class="form-control" id="updateFirstName" name="firstName" value="' . safe_html($patient['first_name']) . '" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="updateMiddleName" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="updateMiddleName" name="middleName" value="' . safe_html($patient['middle_name']) . '">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="updateLastName" class="form-label">Last Name*</label>
                    <input type="text" class="form-control" id="updateLastName" name="lastName" value="' . safe_html($patient['last_name']) . '" required>
                </div>
              </div>';
              
        echo '<div class="row">
                <div class="col-md-4 mb-3">
                    <label for="updateBirthdate" class="form-label">Birthdate*</label>
                    <input type="date" class="form-control" id="updateBirthdate" name="birthdate" value="' . safe_html($patient['birthdate']) . '" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="updateAge" class="form-label">Age*</label>
                    <input type="number" class="form-control" id="updateAge" name="age" value="' . safe_html($patient['age']) . '" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="updateGender" class="form-label">Gender*</label>
                    <select class="form-select" id="updateGender" name="gender" required>
                        <option value="Male" ' . ($patient['gender'] === 'Male' ? 'selected' : '') . '>Male</option>
                        <option value="Female" ' . ($patient['gender'] === 'Female' ? 'selected' : '') . '>Female</option>
                        <option value="Other" ' . ($patient['gender'] === 'Other' ? 'selected' : '') . '>Other</option>
                    </select>
                </div>
              </div>';
              
        echo '<div class="row">
                <div class="col-md-6 mb-3">
                    <label for="updateMobileNumber" class="form-label">Mobile Number*</label>
                    <input type="text" class="form-control" id="updateMobileNumber" name="mobileNumber" value="' . safe_html($patient['mobile_number']) . '" required>
                </div>
              </div>';
              
        echo '<div class="row">
                <div class="col-md-6 mb-3">
                    <label for="updateCity" class="form-label">City*</label>
                    <input type="text" class="form-control" id="updateCity" name="city" value="' . safe_html($patient['city']) . '" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="updateStreet" class="form-label">Street Address*</label>
                    <input type="text" class="form-control" id="updateStreet" name="street" value="' . safe_html($patient['street']) . '" required>
                </div>
              </div>';
            
              
        echo '<div class="row">
                <div class="col-md-6 mb-3">
                    <label for="updateAdmissionDate" class="form-label">Admission Date*</label>
                    <input type="date" class="form-control" id="updateAdmissionDate" name="admissionDate" value="' . safe_html($patient['admission_date']) . '" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="updateAdmissionTime" class="form-label">Admission Time*</label>
                    <input type="time" class="form-control" id="updateAdmissionTime" name="admissionTime" value="' . safe_html($patient['admission_time']) . '" required>
                </div>
              </div>';
              
        echo '<div class="row">
                <div class="col-md-6 mb-3">
                    <label for="updateRecordNumber" class="form-label">Record Number*</label>
                    <input type="text" class="form-control" id="updateRecordNumber" name="recordNumber" value="' . safe_html($patient['record_number']) . '" required>
                </div>
              </div>';
              
        echo '<div class="mb-3">
                <label for="updateChiefComplaint" class="form-label">Chief Complaint*</label>
                <textarea class="form-control" id="updateChiefComplaint" name="chiefComplaint" rows="3" required>' . safe_html($patient['chief_complaint']) . '</textarea>
              </div>';
              
        echo '<div class="mb-3">
                <label for="updateAllergies" class="form-label">Allergies</label>
                <textarea class="form-control" id="updateAllergies" name="allergies" rows="2">' . safe_html($patient['allergies']) . '</textarea>
              </div>';
              
        echo '<div class="mb-3">
                <label for="updateMedicalHistory" class="form-label">Medical History</label>
                <textarea class="form-control" id="updateMedicalHistory" name="medicalHistory" rows="3">' . safe_html($patient['medical_history']) . '</textarea>
              </div>';
              
        echo '<div class="mb-3">
                <label for="updateMedications" class="form-label">Medications</label>
                <textarea class="form-control" id="updateMedications" name="medications" rows="2">' . safe_html($patient['medications']) . '</textarea>
              </div>';
              
        echo '<div class="mb-3">
                <label for="updateSocialHistory" class="form-label">Social History</label>
                <textarea class="form-control" id="updateSocialHistory" name="socialHistory" rows="2">' . safe_html($patient['social_history']) . '</textarea>
              </div>';
              
        echo '<div class="row">
                <div class="col-md-3 mb-3">
                    <label for="updateTemperature" class="form-label">Temperature*</label>
                    <input type="text" class="form-control" id="updateTemperature" name="temperature" value="' . safe_html($patient['temperature']) . '" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="updatePulse" class="form-label">Pulse*</label>
                    <input type="text" class="form-control" id="updatePulse" name="pulse" value="' . safe_html($patient['pulse']) . '" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="updateRespiratoryRate" class="form-label">Respiratory Rate*</label>
                    <input type="text" class="form-control" id="updateRespiratoryRate" name="respiratoryRate" value="' . safe_html($patient['respiratory_rate']) . '" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="updateBloodPressure" class="form-label">Blood Pressure</label>
                    <input type="text" class="form-control" id="updateBloodPressure" name="bloodPressure" value="' . safe_html($patient['blood_pressure']) . '">
                </div>
              </div>';
    }
}
?>