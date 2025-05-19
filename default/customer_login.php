<?php
// customer_login.php

session_start();
require 'includes/config.php'; // DB connection

$alertMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['record_number'])) {
    $record_number = htmlspecialchars($_POST['record_number']);

    // Securely fetch patient by record number
    $stmt = $con->prepare("SELECT * FROM patients WHERE record_number = ?");
    $stmt->bind_param("s", $record_number);
    $stmt->execute();
    $result = $stmt->get_result();
    $patient = $result->fetch_assoc();

    if ($patient) {
        // Destroy any existing session
        session_unset();
        session_destroy();
        session_start();

        // Save patient data in session
        $_SESSION['user_id'] = $patient['id']; // Use 'id' instead of 'record_number'
        $_SESSION['record_number'] = $patient['record_number'];
        $_SESSION['username'] = $patient['first_name'] . ' ' . $patient['last_name'];
        $_SESSION['role'] = 'patient'; // Add role for authorization

        $alertMessage = "success";
    } else {
        $alertMessage = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
    /* Modern Premium Healthcare Login CSS */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

:root {
    --primary: #1e88e5;
    --primary-dark: #1565c0;
    --accent: #00acc1;
    --light: #f8f9fa;
    --dark: #343a40;
    --text: #495057;
    --border: #dee2e6;
    --shadow: rgba(0, 0, 0, 0.05);
    --error: #d32f2f;
    --success: #2e7d32;
}

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #f5f7fa 0%, #e4ecf7 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    color: var(--text);
    line-height: 1.6;
}

.container {
    max-width: 1140px;
    margin: 0 auto;
    padding: 0 15px;
}

.card {
    border: none;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12), 0 8px 20px rgba(0, 0, 0, 0.09);
}

.card-header {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    border: none;
    padding: 1.75rem 1.5rem;
    position: relative;
}

.card-header h4 {
    margin: 0;
    font-weight: 600;
    letter-spacing: 0.5px;
    font-size: 1.5rem;
}

.card-header::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 6px;
    background: linear-gradient(90deg, var(--accent), transparent);
}

.card-body {
    padding: 2.5rem;
    background-color: white;
}

/* Form elements */
.form-group {
    margin-bottom: 1.75rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.75rem;
    font-weight: 500;
    color: var(--dark);
    font-size: 0.95rem;
}

.form-control {
    height: 52px;
    padding: 0.75rem 1.25rem;
    border-radius: 8px;
    border: 2px solid var(--border);
    font-size: 1rem;
    transition: all 0.2s ease-in-out;
    box-shadow: 0 3px 5px var(--shadow);
}

.form-control:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.25);
    outline: none;
}

.btn {
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    border-radius: 8px;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    border: none;
}

.btn-primary:hover, .btn-primary:focus {
    background: linear-gradient(135deg, var(--primary-dark) 0%, #0d47a1 100%);
    transform: translateY(-1px);
    box-shadow: 0 7px 14px rgba(50, 50, 93, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
}

.btn-block {
    width: 100%;
    display: block;
}

/* Help text */
.text-center {
    text-align: center;
}

p.text-center {
    color: #6c757d;
    font-size: 0.9rem;
    margin-top: 2rem;
}

/* Brand logo or icon */
.brand-logo {
    text-align: center;
    margin-bottom: 2rem;
}

.brand-logo img {
    height: 60px;
}

/* Sweet Alert customization */
.swal2-popup {
    border-radius: 12px;
    font-family: 'Poppins', sans-serif;
}

.swal2-title {
    font-weight: 600;
}

.swal2-confirm {
    background: var(--primary) !important;
}

/* Responsive adjustments */
@media (max-width: 767px) {
    .card-body {
        padding: 1.75rem;
    }
    
    .btn {
        padding: 0.65rem 1.25rem;
    }
}
    </style> 
</head>
<body style="background-color: #f0f8ff;">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-lg">
                    <div class="card-header text-center bg-primary text-white">
                        <h4>Patient Login</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group">
                                <label>Medical Record Number</label>
                                <input type="text" name="record_number" class="form-control" required autofocus>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </form>
                    </div>
                </div>
                <p class="text-center mt-3">
                    Need help? Contact our support team
                </p>
            </div>
        </div>
    </div>

    <!-- JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const alertMessage = "<?php echo $alertMessage; ?>";
        if (alertMessage === "success") {
            Swal.fire({
                icon: 'success',
                title: 'Login Successful',
                text: 'Welcome back!',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.href = 'customer_view.php';
            });
        } else if (alertMessage === "error") {
            Swal.fire({
                icon: 'error',
                title: 'Login Failed',
                text: 'Invalid medical record number.',
                confirmButtonColor: '#d33'
            });
        }
    </script>
</body>
</html>