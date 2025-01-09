<?php
session_start();
require 'includes/db.php';

header('Content-Type: application/json'); // Set response type to JSON

$data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $customerId = isset($_POST['customer_id']) ? $_POST['customer_id'] : null;
    $totalAmount = isset($_POST['total_amount']) ? $_POST['total_amount'] : null;
    $invoiceNo = isset($_POST['invoice_no']) ? $_POST['invoice_no'] : null;
    $qty = isset($_POST['qty']) ? $_POST['qty'] : null;
    $paymentMethod = isset($_POST['payment_method']) ? $_POST['payment_method'] : null;
    $productsOrdered = isset($_POST['products_ordered']) ? $_POST['products_ordered'] : null; // This is a JSON string

    // Validate input data
    if (empty($customerId) || empty($totalAmount) || empty($invoiceNo) || empty($qty) || empty($paymentMethod) || empty($productsOrdered)) {
        echo json_encode([
            'success' => false,
            'message' => 'Missing required fields'
        ]);
        exit;
    }

    // Decode products ordered if needed
    $productsOrderedDecoded = json_decode($productsOrdered, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid JSON format for products ordered'
        ]);
        exit;
    }

    // Insert the order into my_orders table
    $orderQuery = "INSERT INTO my_orders (customer_id, total_amount, invoice_no, qty, payment_method, products_ordered) 
                   VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($orderQuery);

    // Check for database connection error
    if (!$stmt) {
        echo json_encode([
            'success' => false,
            'message' => 'Database error: ' . $con->error
        ]);
        exit;
    }

    // Bind parameters and execute
    $stmt->bind_param("idssss", $customerId, $totalAmount, $invoiceNo, $qty, $paymentMethod, json_encode($productsOrderedDecoded));

    if ($stmt->execute()) {
        // Order placed successfully, now delete the cart items for the user
        $deleteCartQuery = "DELETE FROM cart WHERE customer_login_id = ?";
        $deleteStmt = $con->prepare($deleteCartQuery);
        
        if ($deleteStmt) {
            $deleteStmt->bind_param("i", $customerId);
            
            if ($deleteStmt->execute()) {
                // Cart items deleted successfully
                $response = [
                    'success' => true,
                    'invoice_no' => $invoiceNo,
                ];
            } else {
                // Order placed but failed to delete cart items
                $response = [
                    'success' => true,
                    'invoice_no' => $invoiceNo,
                    'message' => 'Order placed but failed to clear cart items: ' . $deleteStmt->error
                ];
            }
            $deleteStmt->close();
        } else {
            // Failed to prepare delete cart query
            $response = [
                'success' => false,
                'message' => 'Failed to clear cart items: ' . $con->error
            ];
        }

        $stmt->close();
    } else {
        // Failed to place order
        $response = [
            'success' => false,
            'message' => 'Failed to place order: ' . $stmt->error
        ];
    }
} else {
    $response = [
        'success' => false,
        'message' => 'Invalid input data'
    ];
}

echo json_encode($response);
?>
