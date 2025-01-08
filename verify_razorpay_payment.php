<?php
require 'razorpay_config.php'; // Include Razorpay SDK and configuration

// Get raw POST data
$data = json_decode(file_get_contents('php://input'), true);

// Extract required parameters
$paymentId = $data['payment_id'] ?? null;
$amount = $data['amount'] ?? null;
$qty = $data['qty'] ?? null;
$productsOrdered = $data['products_ordered'] ?? null;
$orderId = $data['order_id'] ?? null;
$invoiceNo = $data['invoice_no'] ?? null;
$customerId = $data['customer_id'] ?? null;

// Response array to store the output
$response = [];

try {
    // Validate inputs
    if (!$paymentId || !$amount || !$qty || !$productsOrdered || !$orderId || !$invoiceNo || !$customerId) {
        throw new Exception("Missing required parameters");
    }

    // Verify payment with Razorpay
    $payment = $razorpay->payments->fetch($paymentId); // Fetch payment details

    if ($payment->status === 'captured') {
        // Payment successful, insert order details into the database
        $orderQuery = "INSERT INTO my_orders (customer_id, total_amount, invoice_no, qty, payment_method, products_ordered) 
                       VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $con->prepare($orderQuery);
        $paymentMethod = 'online'; // Set payment method
        $stmt->bind_param("idssss", $customerId, $amount, $invoiceNo, $qty, $paymentMethod, $productsOrdered);

        if ($stmt->execute()) {
            $response = ['success' => true, 'message' => 'Payment verified and order saved successfully'];
        } else {
            throw new Exception("Failed to save order to the database");
        }
        $stmt->close();
    } else {
        throw new Exception("Payment not captured. Status: " . $payment->status);
    }
} catch (\Razorpay\Api\Errors\BadRequestError $e) {
    $response = ['success' => false, 'message' => 'Razorpay API Error: ' . $e->getMessage()];
} catch (\Exception $e) {
    $response = ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
}

// Log details for debugging
$logData = [
    'time' => date('Y-m-d H:i:s'),
    'input_data' => $data,
    'payment_id' => $paymentId,
    'response' => $response,
];
file_put_contents('payment_verification_log.txt', json_encode($logData, JSON_PRETTY_PRINT) . PHP_EOL, FILE_APPEND);

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
