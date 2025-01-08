<?php
session_start();
require 'includes/db.php';
require 'razorpay-php/Razorpay.php'; // Ensure you have Razorpay SDK installed

use Razorpay\Api\Api;

// Razorpay API credentials
$keyId = 'rzp_test_uxKdzs7v17Ts4S';
$keySecret = 'UHdx7VAXCytr5Bf0AXMev5Iw';

$api = new Api($keyId, $keySecret);



header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['payment_id'], $data['invoice_no'])) {
    $paymentId = $data['payment_id'];
    $invoiceNo = $data['invoice_no'];

    // Update the order status in the database to 'paid'
    $updateOrderQuery = "UPDATE my_orders SET payment_id = ?, payment_status = 'paid' WHERE invoice_no = ?";
    $stmt = $con->prepare($updateOrderQuery);
    $stmt->bind_param("ss", $paymentId, $invoiceNo);

    if ($stmt->execute()) {
        // Successfully updated order with payment details
        $response = [
            'success' => true,
            'message' => 'Payment details saved successfully'
        ];
    } else {
        // Failed to update order with payment details
        $response = [
            'success' => false,
            'message' => 'Failed to save payment details'
        ];
    }

    $stmt->close();
} else {
    $response = [
        'success' => false,
        'message' => 'Invalid input data'
    ];
}

echo json_encode($response);
?>
