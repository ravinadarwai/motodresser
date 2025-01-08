<?php
session_start();
require './includes/db.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['username'])) {
    header("Location: Login-page"); // Replace 'Login-page' with the path to your login page
    exit();
}

if (isset($_POST['product_id'], $_POST['price'], $_POST['quantity'], $_POST['color'], $_POST['size'])) {
    $p_id = $_POST['product_id'];
    $p_price = $_POST['price'];
    $qty = $_POST['quantity'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $username = $_SESSION['username'];

    $stmt = $con->prepare("SELECT id, full_name FROM customer_login WHERE full_name = ?");
    if (!$stmt) {
        die("SQL Error: " . $con->error);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];
        $full_name = $row['full_name'];
    } else {
        die("User not found.");
    }

    $stmt = $con->prepare("SELECT * FROM cart WHERE p_id = ? AND customer_login_id = ? AND color = ? AND size = ?");
    if (!$stmt) {
        die("SQL Error: " . $con->error);
    }
    $stmt->bind_param("iiss", $p_id, $user_id, $color, $size);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $update_stmt = $con->prepare("UPDATE cart SET qty = qty + ? WHERE p_id = ? AND customer_login_id = ? AND color = ? AND size = ?");
        if (!$update_stmt) {
            die("SQL Error: " . $con->error);
        }
        $update_stmt->bind_param("iisss", $qty, $p_id, $user_id, $color, $size);
        $update_stmt->execute();
    } else {
        $insert_stmt = $con->prepare("INSERT INTO cart (p_id, qty, p_price, customer_login_id, color, size) VALUES (?, ?, ?, ?, ?, ?)");
        if (!$insert_stmt) {
            die("SQL Error: " . $con->error);
        }
        $insert_stmt->bind_param("iissss", $p_id, $qty, $p_price, $user_id, $color, $size);
        $insert_stmt->execute();
    }

    header("Location: cart");
    exit();
} else {
    die("Invalid request.");
}
?>
