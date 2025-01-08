<?php
session_start();
include 'includes/db.php'; // Include your DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $otp = $_POST['otp'];

    if (empty($otp)) {
        echo "OTP is required.";
        exit;
    }

    // Retrieve session ID and phone from the session
    if (!isset($_SESSION['session_id']) || !isset($_SESSION['phone'])) {
        echo "No OTP session found. Please try again.";
        exit;
    }

    $sessionId = $_SESSION['session_id'];
    $phone = $_SESSION['phone'];
    $apiKey = "dd881835-ae80-11ef-8b17-0200cd936042";

    // Verify OTP URL
    $url = "https://2factor.in/API/V1/$apiKey/SMS/VERIFY/$sessionId/$otp";

    // Verify OTP using cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Decode API response
    $result = json_decode($response, true);

    if ($result['Status'] === 'Success') {
        // Construct full name from session or fallback to phone
        $firstName = $_SESSION['first_name'] ?? '';
        $fullName = trim("$firstName ") ?: $phone; // Fallback to phone if name is not provided

        // Check if the user already exists
        $checkStmt = $pdo->prepare("SELECT * FROM customer_login WHERE phone = :phone OR email = :email");
        $checkStmt->execute([
            ':phone' => $phone,
            ':email' => $_SESSION['email'] ?? '',  // Default to empty string if email is not set
        ]);

        if ($checkStmt->rowCount() > 0) {
            // User already exists, redirect to login
            $_SESSION['username'] = $fullName; // Optional: Set session
            echo "User already registered. Redirecting to login.";
            header("Location: Login-page.php"); // Adjust to your login page
            exit;
        } else {
            // Save user details in the database
            $stmt = $pdo->prepare("
                INSERT INTO customer_login (email, phone, first_name, full_name, verifiedEmail, created_at)
                VALUES (:email, :phone, :first_name, :full_name, :verifiedEmail, NOW())
            ");
            $stmt->execute([
                ':email' => $_SESSION['email'] ?? '', // Default to empty string if email is not set
                ':phone' => $phone,
                ':first_name' => $firstName,
                ':full_name' => $fullName,
                ':verifiedEmail' => 1,  // Mark as verified
            ]);

            // Set session for username (full name)
            $_SESSION['username'] = $fullName;

            unset($_SESSION['session_id']); // Clear session ID
            unset($_SESSION['phone']); // Clear phone number
            echo "OTP verified successfully. User registered.";
            header("Location: index.php");
            exit;
        }
    } else {
        echo "Failed to verify OTP. Error: " . $result['Details'];
    }
}
?>
