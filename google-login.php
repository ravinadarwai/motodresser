<?php
require_once 'vendor/autoload.php';
include './includes/db.php';

session_start(); // Ensure session is started at the top

$client = new Google_Client();
$client->setClientId('441692829419-5ao9blu5g1pclbs9o4io58nu1a75vjtb.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('https://motodresser.com/google-login.php');
$client->addScope('email');
$client->addScope('profile');

if (isset($_GET['code'])) {
    // Fetch the token
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    
    if (isset($token['error'])) {
        // Handle error (e.g., invalid or expired code)
        echo 'Error: ' . $token['error'];
        exit();
    }

    $client->setAccessToken($token);

    // Fetch the user info
    $google_service = new Google_Service_Oauth2($client);
    $data = $google_service->userinfo->get();

    // Extract user info
    $google_id = $data['id'];
    $email = $data['email'];
    $name = $data['name'];

    // Check if the user already exists in the database by email
    $query = "SELECT * FROM customer_login WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // User already exists, log them in by setting session or redirecting
        $_SESSION['user_id'] = $user['id'];  // Assuming you have an 'id' field in your table
        $_SESSION['username'] = $user['full_name'];  // Store the user's name in session
        // Redirect to the home page or dashboard
        header('Location: index.php');
        exit();
    } else {
        // Insert new user
        $insert_query = "INSERT INTO customer_login (google_id, email, full_name) VALUES (:google_id, :email, :full_name)";
        $stmt = $pdo->prepare($insert_query);
        $stmt->bindParam(':google_id', $google_id);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':full_name', $name);
        $stmt->execute();

        // Log the new user in by setting session
        $_SESSION['user_id'] = $pdo->lastInsertId();  // Get the last inserted user ID
        $_SESSION['username'] = $name;  // Store the user's name in session

        // Redirect to the home page or dashboard
        header('Location: index.php');
        exit();
    }
} else {
    // Redirect to Google login page if 'code' is not set
    header('Location: ' . $client->createAuthUrl());
    exit();
}
?>
