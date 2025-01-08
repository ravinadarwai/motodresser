<?php
session_start();
include './includes/db.php'; // Include your DB connection
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Include PHPMailer using Composer (adjust path if needed)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Validate the email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit;
    }

    // Generate a 6-digit OTP
    $otp = rand(100000, 999999);

    // Store the OTP and email in session for later verification
    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $email;

    // Send the OTP via email using PHPMailer
    $mail = new PHPMailer(true); // Create an instance of PHPMailer

    try {
        // Server settings
        $mail->isSMTP();  // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'darwairavina2002@gmail.com'; // Your Gmail address
        $mail->Password = 'oqjpywhukzbifcre'; // App Password generated from Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS encryption
        $mail->Port = 587; // TLS port
        
        // Recipients
        $mail->setFrom('ground7@gmail.com', 'Ground 7'); // Sender's email and name
        $mail->addAddress($email);  // Recipient's email (user's email)

        // Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'Your OTP for Login';
        $mail->Body    = "Your OTP is: <strong>$otp</strong>";

        // Send email
        $mail->send();
        echo "OTP sent to your email. Please check your inbox.";
        header("Location: login-otp.php");  // Redirect to OTP form
        exit;
    } catch (Exception $e) {
        echo "Failed to send OTP. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
