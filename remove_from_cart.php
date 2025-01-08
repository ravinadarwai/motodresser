<?php
session_start();
require './includes/db.php';

if (!isset($_SESSION['username'])) {
    echo 'unauthorized'; // Ensure user is logged in
    exit;
}
$user_full_name = $_SESSION['username'];

// Fetch customer_login_id based on full_name
$stmt = $con->prepare("SELECT id FROM customer_login WHERE full_name = ?");
$stmt->bind_param("s", $user_full_name);
$stmt->execute();
$result = $stmt->get_result();
$user_id = $result->fetch_assoc()['id'];

// Get customer ID from session
$customer_login_id = $user_id;

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $size = isset($_POST['size']) ? filter_var($_POST['size'], FILTER_SANITIZE_STRING) : '';
    $color = isset($_POST['color']) ? filter_var($_POST['color'], FILTER_SANITIZE_STRING) : '';

    if ($product_id > 0 && !empty($size) && !empty($color)) {
        // Prepare DELETE statement
        $stmt = $con->prepare("DELETE FROM cart WHERE p_id = ? AND size = ? AND color = ? AND customer_login_id = ?");
        $stmt->bind_param("issi", $product_id, $size, $color, $customer_login_id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo 'success'; // Product removed successfully
            } else {
                echo 'no_rows_affected'; // No rows were affected (e.g., product not found in cart)
            }
        } else {
            echo 'error: ' . $stmt->error; // Error executing query
        }

        $stmt->close();
    } else {
        echo 'invalid'; // Invalid input
    }
} else {
    echo 'invalid_request'; // Wrong request method
}
?>
