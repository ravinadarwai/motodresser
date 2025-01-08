<?php
session_start();
require './includes/db.php';

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

$user_full_name = $_SESSION['username'];

// Fetch customer_login_id based on full_name
$stmt = $con->prepare("SELECT id FROM customer_login WHERE full_name = ?");
$stmt->bind_param("s", $user_full_name);
$stmt->execute();
$result = $stmt->get_result();
$user_id = $result->fetch_assoc()['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = intval($_POST['product_id']);
    $size = trim($_POST['size']); // Trim spaces
    $quantity = intval($_POST['quantity']);

    // Prepare and execute update query
    $stmt = $con->prepare("UPDATE cart SET qty = ? WHERE p_id = ? AND size = ? AND customer_login_id = ?");
    $stmt->bind_param("iisi", $quantity, $product_id, $size, $user_id);

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        // Success
        $_SESSION['message'] = "Cart updated successfully.";
    } else {
        // Log error for debugging
        error_log("Error updating cart: " . $stmt->error);
        $_SESSION['error'] = "Error updating cart. Please try again.";
    }

    // Redirect to cart page
    header('Location: cart.php');
    exit;
} else {
    // Invalid request method
    $_SESSION['error'] = "Invalid request method.";
    header('Location: cart.php');
    exit;
}
?>
