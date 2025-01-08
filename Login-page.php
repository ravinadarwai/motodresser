<?php
session_start();
include './includes/db.php'; // Include your database connection

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the request is an AJAX POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the form data
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Prepare the SQL query to get the user by email
  $sql = "SELECT * FROM customer_login WHERE email = ?";
  $stmt = mysqli_prepare($con, $sql);
  mysqli_stmt_bind_param($stmt, 's', $email);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  // Prepare a response array
  $response = [];

  // Check if a user with the provided email exists
  if ($result && mysqli_num_rows($result) == 1) {
    // Fetch user data
    $user = mysqli_fetch_assoc($result);

    // Verify the provided password against the hashed password in the database
    if (password_verify($password, $user['password'])) {
      // Set session variables for the logged-in user
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_name'] = $user['name'];

      // Successful login
      $response['success'] = true;
    } else {
      // Incorrect password
      $response['success'] = false;
      $response['message'] = 'Invalid email or password. Please try again.';
    }
  } else {
    // No user found with the provided email
    $response['success'] = false;
    $response['message'] = 'Invalid email or password. Please try again.';
  }

  // Return JSON response
  echo json_encode($response);
  exit();
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Login</title>
  <link rel="stylesheet" href="includes/script-links.php">
  <link rel="stylesheet" href="style.css">
  <?php include 'includes/head-links.php'; ?>

  <style>
    :root,
    [data-bs-theme="dark"] {
      color-scheme: dark;
      --bs-body-color: #ededed;
      --bs-body-bg: #161616;
      --bs-primary: #d16527;
      --bs-secondary: #ededed;
      --bs-dark: #161616;
      --bs-gray-dark: #121212;
      --bs-white: #ffffff;
      --bs-border-color: #343434;
      --bs-border-color-translucent: rgba(255, 255, 255, 0.06);
      --bs-primary-border-subtle: #d16527;
      --bs-box-shadow: 0 30px 50px 0 rgba(18, 18, 18, 0.5);
    }

    [data-bs-theme="light"] {
      --bs-body-color: #161616;
      --bs-body-bg: #f9f9f9;
      --bs-primary: #d16527;
      --bs-secondary: #161616;
      --bs-dark: #161616;
      --bs-gray-dark: #ffffff;
      --bs-white: #161616;
      --bs-border-color: #dadbdd;
      --bs-border-color-translucent: #dadbdd;
      --bs-primary-border-subtle: #d16527;
      --bs-box-shadow: 0 30px 50px 0 rgba(18, 18, 18, 0.2);
    }

    .tab-content {
      background-color: transparent;
      margin-top: 0;
    }

    .btn-primary {
      background-color: var(--bs-primary) !important;
      --bs-btn-hover-bg: var(--bs-primary) !important;
    }

    /* General Styles */
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f4f7fc;
      margin: 0;
      padding: 0;
    }

    /* Section Styling */
    .section {
      background-image: url('https://imgd.aeplcdn.com/1280x720/n/cw/ec/103795/yzf-r15-left-front-three-quarter-5.jpeg?isig=0&q=100');
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      padding: 60px 0;
    }

    /* Main Container */
    .container2 {
      width: 100%;
      max-width: 500px;
      -webkit-backdrop-filter: blur(10px) !important;
      backdrop-filter: blur(15px) !important;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      margin: 4rem 0rem 0rem 4rem;
    }

    /* Form Styling */
    .form-group {
      margin-bottom: 20px;
    }

    label {
      font-size: 14px;
      color: #333;
      margin-bottom: 5px;
    }
    
    @media screen and (max-width: 575px){
        label {
            color: white;
        }
    }

    input[type="email"],
    input[type="password"],
    input[type="text"] {
      width: 100%;
      padding: 12px;
      font-size: 16px;
      border: 1px solid #ddd;
      border-radius: 5px;
      outline: none;
      transition: all 0.3s ease;
    }

    input[type="email"]:focus,
    input[type="password"]:focus,
    input[type="text"]:focus {
      border-color: #0056b3;
    }

    /* Button Styling */
    .btn-primary,
    .btn-danger,
    .btn-block {
      width: 100%;
      padding: 12px;
      font-size: 16px;
      background-color: #0056b3;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-primary:hover,
    .btn-danger:hover {
      background-color: #004085;
    }

    .login-link a {
      text-decoration: none;
      color: #0056b3;
    }

    /* Tab Navigation */
    .tab-container {
      display: flex;
      justify-content: center;
      margin-bottom: 20px;
    }

    .tab-button {
      padding: 10px 20px;
      margin: 0 10px;
      font-size: 16px;
      border: 2px solid transparent;
      cursor: pointer;
      background-color: #f0f0f0;
      border-radius: 5px;
      color: black;
    }

    .tab-button.active {
      background-color: rgba(255, 255, 255, .4) !important;
      border-color: #d16527;
      color: #d16527;
      font-weight: 500;
    }

    .tab-content.hidden {
      display: none;
    }

    /* Responsive Design */
    @media screen and (max-width: 768px) {
      .container2 {
        padding: 20px;
        margin-top: 50px;
        margin-left: 0;
      }
      .section {
        display: flex;
        justify-content: center;
        align-items: center;
      }
    }


    .mm {
      margin-bottom: 1rem;
    }

    .mm-2 {
      margin-bottom: 2rem;
    }
    @media screen and (max-width: 575px){
    .form-group .form-control {
        color: white;
    }
    .form-group .form-control::placeholder {
        opacity: 0.5;
        color: white;
    }
}
  </style>
</head>

<body>
  <?php include 'includes/top-bar.php'; ?>
  <div class="page_wrapper">
    <?php include 'includes/header.php'; ?>

    <main class="page_content">
      <div class="section">
        <div class="container2">
          <header class="text-center">
            <h3 class="mm-2">Login to Your Account</h3>
          </header>

          <div class="tab-container">
            <button id="emailTab" class="tab-button active" onclick="showTab('email')">Login with Email</button>
            <button id="numberTab" class="tab-button" onclick="showTab('number')">Login with Phone</button>
          </div>

          <div class="tab-content" id="emailTabContent">
            <form action="verify-email-otp.php" method="post">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
              </div>
              <button type="submit" class="btn btn-primary btn-block">Send OTP</button>
            </form>
          </div>

          <div class="tab-content hidden" id="numberTabContent">
            <!-- Send OTP Form -->
            <form action="send-otp.php" method="post" id="sendOtpForm" class="mm-2">
              <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" class="form-control" name="phone" placeholder="Enter your phone number" required>
              </div>
              <button type="submit" class="btn btn-primary">Send OTP</button>
            </form>

            <!-- Verify OTP Form -->
            <form action="verify-otp.php" method="post" id="verifyOtpForm" class="hidden">
              <div class="form-group">
                <label for="otp">Enter OTP:</label>
                <input type="text" class="form-control" name="otp" placeholder="Enter the OTP" required>
              </div>
              <button type="submit" class="btn btn-primary">Verify OTP</button>
            </form>
          </div>

          <div class="text-center mt-3">
            <a href="google-login.php" class="btn btn-primary mm btn-block">Login with Google</a>
            <a href="facebook-login.php" class="btn btn-primary btn-block">Login with Facebook</a>
          </div>

          <div class="bottom-text text-center mt-4">
            <p>Don’t have an account? <a href="registration.php">Sign Up</a></p>
          </div>
        </div>
      </div>
    </main>

    <?php include 'includes/footer.php'; ?>
  </div>
  <?php
  include 'includes/script-links.php';
  ?>
  <script>
    function showTab(tab) {
      const emailTabContent = document.getElementById('emailTabContent');
      const numberTabContent = document.getElementById('numberTabContent');
      const emailTab = document.getElementById('emailTab');
      const numberTab = document.getElementById('numberTab');

      if (tab === 'email') {
        emailTabContent.classList.remove('hidden');
        numberTabContent.classList.add('hidden');
        emailTab.classList.add('active');
        numberTab.classList.remove('active');
      } else {
        numberTabContent.classList.remove('hidden');
        emailTabContent.classList.add('hidden');
        numberTab.classList.add('active');
        emailTab.classList.remove('active');
      }
    }

    // Default to email login
    showTab('email');
  </script>
</body>

</html>