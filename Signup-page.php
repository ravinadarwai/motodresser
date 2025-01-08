<?php
session_start();
require_once 'googleconfig.php'; // Include Google and Facebook config
require_once 'facebookconfig.php'; // Ensure this is included at the top of your file
require_once 'includes/db.php'; // Database connection
require 'vendor/autoload.php'; // Include PHPMailer

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Handle manual registration (POST request)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if password and confirm password match
    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Password hashing
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Check if user already exists
        $stmt = $pdo->prepare("SELECT * FROM customer_login WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if ($user) {
            // User already exists
            $error = "User already exists with this email.";
        } else {
            // Insert new user
            $stmt = $pdo->prepare("INSERT INTO customer_login (name, email, password, provider)
                                   VALUES (:name, :email, :password, 'manual')");
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $hashed_password
            ]);

            // Generate OTP
            $otp = rand(100000, 999999);

            // Store OTP in session or database for verification (optional)
            $_SESSION['otp'] = $otp;

            // Send OTP Email using PHPMailer
            $mail = new PHPMailer(true);
            try {
                // Server settings
                $mail->isSMTP();
$mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
$mail->SMTPAuth = true;
$mail->Username = 'darwairavina2002@gmail.com'; // Your Gmail address
$mail->Password = 'oqjpywhukzbifcre'; // App Password generated from Gmail
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS encryption
$mail->Port = 587; // TLS port

                // Recipients
                $mail->setFrom('no-reply@ground7.com', 'Ground 7');
                $mail->addAddress($email, $name);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Verify Your Email - Ground 7';
                $mail->Body = "<p>Hello <strong>$name</strong>,</p>
                               <p>Your OTP for email verification is: <strong>$otp</strong>.</p>
                               <p>Thank you for registering with Ground 7.</p>";

                $mail->send();
                $success = "Registration successful! Please check your email for the OTP.";
             // After sending OTP, redirect to OTP verification page
$_SESSION['otp'] = $otp;
header('Location: verify.php');
exit();

            } catch (Exception $e) {
                $error = "Failed to send OTP: {$mail->ErrorInfo}";
            }
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<!-- Mirrored from html.merku.love/promotors/team by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Sep 2024 07:17:10 GMT -->

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width,initial-scale=1,shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>
    Signup
  </title>
  <!-- <link rel="stylesheet" href="./Signup/Signup.css"> -->
  <?php
  include 'includes/head-links.php';
  ?>

  <style>
    .section {
      background-image: url('https://imgd.aeplcdn.com/1280x720/n/cw/ec/103795/yzf-r15-left-front-three-quarter-5.jpeg?isig=0&q=100');
      background-position: left;
      background-repeat: no-repeat;
      background-size: cover;
      padding: 200px 0 200px;
    }

    .container2 {
      width: 400px;
      max-width: 500px;
      margin-left: 200px;
      /* background-color: #fff; */
      background: transparent;
      backdrop-filter: blur(20px);
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      padding: 20px;
      border-radius: 10px;
    }

    .signup-box {
      text-align: center;
    }

    .signup-box h2 {
      margin-bottom: 30px;
      font-size: 24px;
    }

    /* Input Box Styling */
    .input-box {
      position: relative;
      margin-bottom: 30px;
    }

    .toggle-password {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
    }

    .input-box input {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border: 1px solid black;
      border-radius: 5px;
      outline: none;
      transition: 0.3s ease;
      background-color: transparent;
      color: black;
    }

    .input-box label {
      position: absolute;
      top: 12px;
      left: 15px;
      font-size: 16px;
      color: black;
      transition: 0.3s ease;
      pointer-events: none;
    }

    .input-box input:focus~label,
    .input-box input:not(:placeholder-shown)~label {
      top: -20px;
      left: 10px;
      font-size: 12px;
      color: #333;
    }

    .input-box input:focus {
      border-color: #333;
    }

    /* Password Strength Pie Chart */
    .password-strength-container {
      position: relative;
    }

    .password-strength-meter {
      position: absolute;
      top: 10px;
      right: 10px;
      width: 90px;
      height: 30px;
      border-radius: 8px;
      background-color: #ddd;
      /* clip-path: circle(50%); */
    }

    /* Cross and Tick icons */
    .input-box .status-icon {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 20px;
      display: none;
    }

    .input-box .status-icon.active {
      display: block;
    }

    /* Buttons and Links */
    .buttonn {
      width: 100%;
      padding: 10px;
      background-color: #333;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .buttonn:hover {
      background-color: #555;
    }

    .login-link {
      margin-top: 20px;
    }

    .login-link a {
      text-decoration: none;
      color: #333;
    }

    /* Icons */
    .fa-check {
      color: blue;
    }

    .fa-times {
      color: red;
    }

    @media screen and (max-width:768px) {
      section {

        padding: 20px;
        margin-top: 35% !important;


      }

      .container2 {

        margin-left: 0px;
        margin-top: 20%;

      }

    }
  </style>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
  <?php
  include 'includes/top-bar.php';
  ?>
  <div class="page_wrapper">
`
    <?php
    include 'includes/header.php';
    ?>

    <main class="page_content" style="margin-top: 140px;">
      <section class="section">
        <div class="container2">
          <div class="signup-box">
            <h2>Sign Up</h2>
            <form id="signupForm" onsubmit="return validateForm()">
              <div class="input-box">
                <input type="text" name="name" id="name" required placeholder=" ">
                <label for="name">Full Name</label>
              </div>
              <div class="input-box">
                <input type="text" name="phone" id="phone" required placeholder=" " maxlength="10" pattern="\d{10}">
                <label for="phone">Phone</label>
              </div>

            
              <div class="input-box">
                <input type="email" name="email" id="email" required placeholder=" ">
                <label for="email">Email</label>
              </div>
              <div class="input-box">
                <input id="password" type="password" name="password" required placeholder=" ">
                <label for="password">Password</label>
                <span class="toggle-password" onclick="togglePasswordVisibility('password', 'togglePasswordIcon')">
                  <i id="togglePasswordIcon" class="fas fa-eye"></i>
                </span>
              </div>
              <div class="input-box">
                <input type="password" id="confirm-password" required placeholder=" ">
                <label for="confirm-password">Confirm Password</label>
                <span class="toggle-password" onclick="togglePasswordVisibility('confirm-password', 'toggleConfirmPasswordIcon')">
                  <i id="toggleConfirmPasswordIcon" class="fas fa-eye"></i>
                </span>
              </div>
              <button type="submit" class="buttonn">Sign Up</button>
              <div class="login-link">
                <p>Already have an account? <a href="./Login">Login</a></p>
              </div>
            </form>
            <div class="d-grid gap-2">
                    <!-- Google Login Button -->
                    <a href="<?= htmlspecialchars($client->createAuthUrl()) ?>" class="btn btn-google">Login with Google</a>

                    <!-- Facebook Login Button --> 
                    <a href="<?= htmlspecialchars($fb_login_url) ?>" class="btn btn-facebook">Login with Facebook</a>
                </div>

                <div class="text-center mt-3">
                    <a href="forgot_password.php" class="text-decoration-none">Forgot Password?</a>
                </div>

          </div>
        </div>
      </section>
    </main>


    <script>
      function checkPasswordStrength() {
        const password = document.getElementById('password').value;
        const strengthMeter = document.getElementById('password-strength');
        const strongPasswordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;

        if (strongPasswordPattern.test(password)) {
          strengthMeter.textContent = 'Strong';
          strengthMeter.style.color = 'black';
          strengthMeter.style.backgroundColor = 'green';
        } else if (password.length >= 6) {
          strengthMeter.textContent = 'Weak';
          strengthMeter.style.color = 'black';
          strengthMeter.style.backgroundColor = 'orange';
        } else {
          strengthMeter.textContent = 'Very Weak';
          strengthMeter.style.color = 'black';
          strengthMeter.style.backgroundColor = 'red';
        }
      }
      function togglePasswordVisibility(passwordFieldId, iconId) {
    const passwordField = document.getElementById(passwordFieldId);
    const icon = document.getElementById(iconId);
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        passwordField.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

      function checkPasswordMatch() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm-password').value;
        const checkIcon = document.getElementById('check-icon');
        const crossIcon = document.getElementById('cross-icon');

        if (password === confirmPassword) {
          checkIcon.style.display = 'flex';
          crossIcon.style.display = 'none';
        } else {
          checkIcon.style.display = 'none';
          crossIcon.style.display = 'flex';
        }
      }


    </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@...">

  </div>
  <?php
  include 'includes/footer.php';
  ?>
  </div>
  <?php
  include 'includes/script-links.php';
  ?>

</body>
<!-- Mirrored from html.merku.love/promotors/team by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Sep 2024 07:17:10 GMT -->

</html>