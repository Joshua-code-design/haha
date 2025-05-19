<?php
// login.php
session_start();
require 'includes/config.php'; // Include database connection

$alertMessage = ''; // Initialize a variable to store alert messages

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    // Prepare the statement to prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM Admin WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Check if user exists and password is correct
    if ($user && password_verify($password, $user['password'])) {
        // Reset session variables
        session_unset(); // Clear previous session variables
        session_destroy(); // Destroy the session if it exists

        // Start a new session
        session_start();

        // Set session variables for the logged-in user
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role']; // Store the user's role in session

        // Set the alert message for successful login
        $alertMessage = "success";
    } else {
        // Set the alert message for invalid login
        $alertMessage = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GASTRONET</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
      :root {
            --primary-color: #1a237e;
            --secondary-color: #0d47a1;
            --accent-color: #2962ff;
        }

        body {
            min-height: 100vh;
            background: #f7f9f9;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background:rgb(2, 20, 46);
            background-size: cover;
        }

        .main-container {
            min-height: 90vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            background:rgb(7, 24, 36);
            border-radius: 30px;
            box-shadow: 0 15px 35px rgb(252, 0, 0);
            overflow: hidden;
            width: 70%;
            max-width: 800px;
            display: flex;
            min-height: 500px;
        }

    .login-image {
    flex: 1;
    background: linear-gradient(rgba(128, 128, 128, 0.1), rgba(128, 128, 128, 0.7)), url('../files/assets/images/3.jpg');
    background-size: cover;
    background-position: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: white;
    padding: 40px;
    text-align: center;
}


        .login-form {
            flex: 1;
            padding: 40px;
            color: rgb(139, 137, 0);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo {
            width: 120px;
            height: 120px;
            border-radius: 60px;
            background: white;
            padding: 5px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-control {
            border: none;
            border-bottom: 2px solid #e0e0e0;
            border-radius: 0;
            padding: 12px 40px 12px 15px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: transparent;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: var(--accent-color);
        }

        .form-group i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #757575;
        }

        .btn-login {
            background: #2874a6;
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 1px;
            box-shadow: 0 5px 15px rgba(41, 98, 255, 0.3);
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .btn-login:hover {
            background: var(--secondary-color);
            box-shadow: 0 8px 20px rgba(41, 98, 255, 0.4);
            transform: translateY(-2px);
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            color: #616161;
        }

        .register-link a {
            color: var(--accent-color);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: var(--secondary-color);
        }

        @media (max-width: 768px) {
            .login-image {
                display: none;
            }
            
            .login-container {
                max-width: 400px;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="login-container">
            <div class="login-image">
                <h1 class="mb-4">GASTRONET</h1>
                <p>Your trusted healthcare management system for doctors and nurses</p>
            </div>
            <div class="login-form">
                <h3 class="text-center mb-4">Login to Your Account</h3>
                <form method="POST" action="">
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="forgot-password">
                        <a href="forgot_password.php">Forgot Password?</a>
                    </div>
                    <button type="submit" class="btn btn-login btn-block">Sign In</button>
                </form>
                <div class="register-link">
                    Don't have an account? <a href="admin_register.php">Register here</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        var alertMessage = "<?php echo $alertMessage; ?>";
        if (alertMessage === "success") {
            Swal.fire({
                icon: 'success',
                title: 'Welcome Back!',
                text: 'Login successful',
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                    popup: 'animated fadeInDown'
                }
            }).then(() => {
                // Redirect based on user role
                <?php if(isset($_SESSION['role'])): ?>
                    if("<?php echo $_SESSION['role']; ?>" === "doctor") {
                        window.location.href = 'view.php';
                    } else if("<?php echo $_SESSION['role']; ?>" === "nurse") {
                        window.location.href = 'nurse_index.php';
                    } else {
                        window.location.href = 'index.php';
                    }
                <?php else: ?>
                    window.location.href = 'index.php';
                <?php endif; ?>
            });
        } else if (alertMessage === "error") {
            Swal.fire({
                icon: 'error',
                title: 'Access Denied',
                text: 'Invalid email or password. Please try again.',
                confirmButtonColor: '#2962ff'
            });
        }
    </script>
</body>
</html>