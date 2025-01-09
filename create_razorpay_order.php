<?php
// create_order.php

require 'razorpay_config.php'; 
use Razorpay\Api\Api;

$keyId = 'rzp_test_uxKdzs7v17Ts4S';
$keySecret = 'UHdx7VAXCytr5Bf0AXMev5Iw';

$api = new Api($keyId, $keySecret);

// Get order data from the request
$orderData = json_decode(file_get_contents('php://input'), true);

// Create Razorpay order
$order = $api->order->create([
    'amount' => $orderData['total_amount'] * 100, // Amount in paise
    'currency' => 'INR',
    'payment_capture' => 1 // Automatic payment capture
]);

// Send order ID back to the frontend
echo json_encode(['success' => true, 'order_id' => $order->id]);
?>
