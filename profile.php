<?php
session_start();
require_once 'googleconfig.php'; // Include Google config
require_once 'facebookconfig.php'; // Include Facebook config
require_once 'includes/db.php'; // Include DB connection

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); // Enable error reporting

// Google Login Callback
if (isset($_GET['code']) && !isset($_SESSION['email'])) {
    try {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        if (isset($token['access_token'])) {
            $client->setAccessToken($token['access_token']);
            $google_service = new Google_Service_Oauth2($client);
            $user_info = $google_service->userinfo->get();

            // Store user information in session
            $_SESSION['email'] = $user_info->email;
            $_SESSION['name'] = $user_info->name;
            $_SESSION['provider'] = 'Google';

            // Save user information in the database using MySQLi
            $stmt = $con->prepare("INSERT INTO customer_login (name, email, provider, provider_id)
                                   VALUES (?, ?, ?, ?)
                                   ON DUPLICATE KEY UPDATE name = ?");
            // Bind parameters: (s = string, i = integer)
            $stmt->bind_param("sssss", $user_info->name, $user_info->email, 'Google', $user_info->id, $user_info->name);
            $stmt->execute();
        }
    } catch (Exception $e) {
        die("Google Login Error: " . htmlspecialchars($e->getMessage()));
    }
}

// Facebook Login Callback
if (isset($_GET['state'])) {
    $_SESSION['FBRLH_state'] = $_GET['state'];
}

try {
    $accessToken = $helper->getAccessToken();

    if (isset($accessToken) && !isset($_SESSION['email'])) {
        $response = $fb->get('/me?fields=id,name,email', $accessToken);
        $user_info = $response->getGraphUser();

        // Store user information in session
        $_SESSION['email'] = $user_info['email'] ?? '';
        $_SESSION['name'] = $user_info['name'] ?? '';
        $_SESSION['provider'] = 'Facebook';

        // Save user information in the database using MySQLi
        $stmt = $con->prepare("INSERT INTO customer_login (name, email, provider, provider_id)
                               VALUES (?, ?, ?, ?)
                               ON DUPLICATE KEY UPDATE name = ?");
        // Bind parameters: (s = string)
        $stmt->bind_param("sssss", $user_info['name'], $user_info['email'], 'Facebook', $user_info['id'], $user_info['name']);
        $stmt->execute();
    }
} catch (Exception $e) {
    die("Facebook Login Error: " . htmlspecialchars($e->getMessage()));
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php"); // Redirect back to the index page
    exit;
}
?>
