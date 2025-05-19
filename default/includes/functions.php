<?php
function sanitizeInput($con, $data) {
    return htmlspecialchars(mysqli_real_escape_string($con, trim($data)));
}

function calculateAge($birthdate) {
    $today = new DateTime();
    $diff = $today->diff(new DateTime($birthdate));
    return $diff->y;
}

function validatePhone($phone) {
    return preg_match('/^[0-9]{10,15}$/', $phone);
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}



?>