<?php
session_start();

// Redirect to email form if session email or OTP is not set
if (!isset($_SESSION['email']) || !isset($_SESSION['otp'])) {
    header("Location: verify-email-otp.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .form-group .form-control::placeholder {
            opacity: 0.5;
            color: black;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header text-center">
                    <h4 style="color: black;">Verify OTP</h4>
                </div>
                <div class="card-body">
                    <form action="verify-otp-email.php" method="post" id="otpForm">
                        <div class="form-group">
                            <label for="otp">Enter OTP</label>
                            <input type="text" id="otp" name="otp" 
                                   class="form-control" 
                                   placeholder="Enter the OTP sent to your email" 
                                   style="color: black;" 
                                   pattern="\d{6}" 
                                   title="Please enter a valid 6-digit OTP." 
                                   required 
                                   inputmode="numeric" 
                                   maxlength="6">
                            <small id="error-message" style="color: red; display: none;">Please enter numbers only.</small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Verify OTP</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p style="color: black;">Didn't receive the OTP? <a href="resend-otp.php">Resend OTP</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const otpInput = document.getElementById('otp');
const errorMessage = document.getElementById('error-message');

otpInput.addEventListener('keypress', function (e) {
    const charCode = e.which || e.keyCode;

    // Allow only numbers (48-57 are keycodes for 0-9)
    if (charCode < 48 || charCode > 57) {
        e.preventDefault();
        errorMessage.style.display = 'block';
        setTimeout(() => {
            errorMessage.style.display = 'none';
        }, 2000); // Hide the message after 2 seconds
    }
});

otpInput.addEventListener('input', function (e) {
    const value = e.target.value;

    // Remove any non-numeric characters (fallback for paste or other input methods)
    e.target.value = value.replace(/\D/g, '');
});

</script>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
