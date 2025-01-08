<?php
require 'razorpay_config.php'; 

$data = json_decode(file_get_contents('php://input'), true);
$amount = $data['amount'] * 100; // Convert to paise
$invoiceNo = $data['invoice_no'];

try {
    $order = $razorpay->order->create([
        'amount' => $amount,
        'currency' => 'INR',
        'receipt' => $invoiceNo,
        'payment_capture' => 1 // Auto-capture payment
    ]);

    echo json_encode(['success' => true, 'order_id' => $order['id'], 'amount' => $amount, 'currency' => 'INR']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
