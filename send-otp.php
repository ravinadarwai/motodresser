<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone = $_POST['phone'];

    if (empty($phone)) {
        echo "Phone number is required.";
        exit;
    }

    // Store the phone number in the session
    $_SESSION['phone'] = $phone;

    // 2Factor API Key
    $apiKey = "dd881835-ae80-11ef-8b17-0200cd936042";

    // Generate OTP URL
    $url = "https://2factor.in/API/V1/$apiKey/SMS/$phone/AUTOGEN";

    // Send OTP using cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Decode API response
    $result = json_decode($response, true);

    if ($result['Status'] === 'Success') {
        $_SESSION['session_id'] = $result['Details']; // Store session ID for verification
        echo "OTP sent successfully.";
        // Redirect to verification page
        header("Location: Login-page.php");
        exit;
    } else {
        echo "Failed to send OTP. Error: " . $result['Details'];
    }
}
