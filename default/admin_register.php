<?php
// register.php
session_start();
require 'includes/config.php'; // Include database connection

$alertMessage = ''; // Initialize a variable to store alert messages

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role']; // Get the selected role

    // Check if the passwords match
    if ($password !== $confirm_password) {
        $alertMessage = "password_mismatch";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_ARGON2I);

        // Check if the email already exists
        $stmt = $con->prepare("SELECT * FROM Admin WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $alertMessage = "email_exists";
        } else {
            // Insert new user into the database
            $stmt = $con->prepare("INSERT INTO Admin (username, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('ssss', $username, $email, $hashedPassword, $role);
            if ($stmt->execute()) {
                $alertMessage = "registration_success";
            } else {
                $alertMessage = "registration_error";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GASTRONET REGISTER</title>
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
            background:rgb(2, 20, 46);
            background-size: cover;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main-container {
            min-height: 90vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .register-container {
            background:rgb(2, 46, 82);
            border-radius: 30px;
            box-shadow: 0 15px 35px rgb(252, 0, 0);
            overflow: hidden;
            width: 80%;
            max-width: 800px;
            display: flex;
            min-height: 500px;
        }

        .register-image {
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

        .register-form {
            flex: 1.2;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: gold;
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
            margin-bottom: 20px;
            position: relative;
        }

        .form-control {
            border: none;
            border-bottom: 2px solidrgb(255, 255, 255);
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

        .password-strength {
            height: 5px;
            margin-top: 5px;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .btn-register {
            background: var(--accent-color);
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

        .btn-register:hover {
            background: var(--secondary-color);
            box-shadow: 0 8px 20px rgba(41, 98, 255, 0.4);
            transform: translateY(-2px);
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            color:rgb(255, 255, 255);
        }

        .login-link a {
            color: var(--accent-color);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: var(--secondary-color);
        }

        .requirements {
            font-size: 12px;
            color: white;
            margin-top: 5px;
        }

        .requirement {
            margin: 2px 0;
            display: flex;
            align-items: center;
        }

        .requirement i {
            margin-right: 5px;
            font-size: 10px;
        }

        @media (max-width: 768px) {
            .register-image {
                display: none;
            }
            
            .register-container {
                max-width: 400px;
            }
        }
        .role-selection {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            color: white;
            
        }
        .role-option {
            width: 48%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            transition: all 0.3s;
        }
        .role-option:hover {
            border-color:rgb(255, 0, 0);
        }
        .role-option.selected {
            border-color:rgb(255, 0, 0);
            background-color:rgb(201, 1, 1);
        }
        .role-option i {
            font-size: 24px;
            margin-bottom: 10px;
            display: block;
        }
        input[type="radio"] {
            display: none;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="register-container">
            <div class="register-image">
                <h1 class="mb-4">GASTRONET</h1>
            </div>
            <div class="register-form">
                <h3 class="text-center mb-4">Create Your Account</h3>
                <form method="POST" action="" id="registerForm">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                        <i class="fas fa-envelope"></i>
                    </div>
                    
                    <!-- Role Selection -->
                    <div class="role-selection">
                        <label class="role-option">
                            <input type="radio" name="role" value="doctor" required>
                            <i class="fas fa-user-md"></i>
                            <span>Doctor</span>
                        </label>
                        <label class="role-option">
                            <input type="radio" name="role" value="nurse">
                            <i class="fas fa-user-nurse"></i>
                            <span>Nurse</span>
                        </label>
                    </div>
                    
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        <i class="fas fa-lock"></i>
                        <div class="password-strength"></div>
                        <div class="requirements">
                            <div class="requirement"><i class="fas fa-circle"></i> At least 8 characters</div>
                            <div class="requirement"><i class="fas fa-circle"></i> Contains uppercase & lowercase</div>
                            <div class="requirement"><i class="fas fa-circle"></i> Contains numbers</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
                        <i class="fas fa-lock"></i>
                    </div>
                    <button type="submit" class="btn btn-register btn-block">Create Account</button>
                    <div class="login-link">
                        Already have an account? <a href="doc_login.php">Login here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        // Capitalize username first letter
        document.getElementById('username').addEventListener('input', function() {
            this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
        });

        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strength = document.querySelector('.password-strength');
            const requirements = document.querySelectorAll('.requirement i');
            
            // Check requirements
            const hasLength = password.length >= 8;
            const hasCase = /[a-z]/.test(password) && /[A-Z]/.test(password);
            const hasNumber = /\d/.test(password);
            
            requirements[0].className = hasLength ? 'fas fa-check' : 'fas fa-circle';
            requirements[1].className = hasCase ? 'fas fa-check' : 'fas fa-circle';
            requirements[2].className = hasNumber ? 'fas fa-check' : 'fas fa-circle';
            
            let strengthValue = 0;
            if (hasLength) strengthValue += 33;
            if (hasCase) strengthValue += 33;
            if (hasNumber) strengthValue += 34;
            
            strength.style.width = `${strengthValue}%`;
            strength.style.background = 
                strengthValue <= 33 ? '#ff4444' :
                strengthValue <= 66 ? '#ffa700' : '#00C851';
        });

        // Role selection styling
        document.querySelectorAll('.role-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.role-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                this.classList.add('selected');
                this.querySelector('input[type="radio"]').checked = true;
            });
        });

        // Alert messages
        var alertMessage = "<?php echo $alertMessage; ?>";
        if (alertMessage === "password_mismatch") {
            Swal.fire({
                icon: 'error',
                title: 'Passwords Do Not Match',
                text: 'Please ensure both passwords are identical.',
                confirmButtonColor: '#2962ff'
            });
        } else if (alertMessage === "email_exists") {
            Swal.fire({
                icon: 'warning',
                title: 'Email Already Registered',
                text: 'Please use a different email address or login to your existing account.',
                confirmButtonColor: '#2962ff'
            });
        } else if (alertMessage === "registration_success") {
            Swal.fire({
                icon: 'success',
                title: 'Welcome Aboard!',
                text: 'Your account has been created successfully.',
                showConfirmButton: true,
                confirmButtonColor: '#2962ff'
            }).then(() => {
                window.location = 'doc_login.php';
            });
        } else if (alertMessage === "registration_error") {
            Swal.fire({
                icon: 'error',
                title: 'Registration Failed',
                text: 'An error occurred during registration. Please try again.',
                confirmButtonColor: '#2962ff'
            });
        }
    </script>
</body>
</html>