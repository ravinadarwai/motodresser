<?php
// verify_razorpay_payment.php
include './includes/db.php'; // Include your database connection
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    // Get the combined data from the POST request
    $combinedData = json_decode(file_get_contents('php://input'), true);

    if (!$combinedData || !isset($combinedData['orderData'], $combinedData['paymentDetails'])) {
        throw new Exception("Invalid input data");
    }

    $orderData = $combinedData['orderData']; // Extract order data
    $paymentDetails = $combinedData['paymentDetails']; // Extract payment details

    // Extract payment details
    $razorpayPaymentId = $paymentDetails['razorpay_payment_id'];
    $razorpayOrderId = $paymentDetails['razorpay_order_id'];
    $razorpaySignature = $paymentDetails['razorpay_signature'];

    // Extract order details
    $invoiceNo = $orderData['invoice_no'];
    $totalAmount = $orderData['total_amount'];
    $paymentMode = 'online';
    $refNo = rand(100000, 999999);
    $code = rand(1000, 9999);
    $paymentDate = date('Y-m-d H:i:s');
    $customerId = $orderData['customer_id'];
    $qty = $orderData['qty'];
    $productsOrdered = $orderData['products_ordered'];
    file_put_contents('payment_verification_log.txt', file_get_contents('php://input') . PHP_EOL, FILE_APPEND);

    // Convert products_ordered array to JSON
    $productsOrderedJson = json_encode($productsOrdered);

    // Start transaction
    $pdo->beginTransaction();

    // Fetch data from the cart table for the customer
    $cartQuery = "SELECT * FROM cart WHERE customer_login_id = ?";
    $cartStmt = $pdo->prepare($cartQuery);
    $cartStmt->execute([$customerId]);
    $cartItems = $cartStmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($cartItems)) {
        throw new Exception("No items in the cart for this customer.");
    }

    // Insert into my_orders table
    $orderQuery = "INSERT INTO my_orders (customer_id, total_amount, invoice_no, qty, payment_method, products_ordered, payment_id, payment_status, order_date) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, 'completed', NOW())";
    $orderStmt = $pdo->prepare($orderQuery);
    $orderStmt->execute([$customerId, $totalAmount, $invoiceNo, $qty, $paymentMode, $productsOrderedJson, $razorpayPaymentId]);

    // Get the last inserted order ID
    // $orderId = $pdo->lastInsertId();

    // // Insert cart items into the order details table
    // foreach ($cartItems as $item) {
    //     $orderDetailsQuery = "INSERT INTO order_details (order_id, product_id, qty, color, size, price) 
    //                           VALUES (?, ?, ?, ?, ?, ?)";
    //     $orderDetailsStmt = $pdo->prepare($orderDetailsQuery);
    //     $orderDetailsStmt->execute([
    //         $orderId,
    //         $item['p_id'],
    //         $item['qty'],
    //         $item['color'],
    //         $item['size'],
    //         $item['p_price']
    //     ]);
    // }

    // Insert payment details into payment_signatures table
    $signatureQuery = "INSERT INTO payment_signatures (invoice_no, amount, payment_mode, ref_no, code, payment_date) 
                       VALUES (?, ?, ?, ?, ?, ?)";
    $signatureStmt = $pdo->prepare($signatureQuery);
    $signatureStmt->execute([$invoiceNo, $totalAmount, $paymentMode, $refNo, $code, $paymentDate]);

    // Clear the cart after successful order placement
    $clearCartQuery = "DELETE FROM cart WHERE customer_login_id = ?";
    $clearCartStmt = $pdo->prepare($clearCartQuery);
    $clearCartStmt->execute([$customerId]);

    // Log for debugging
    file_put_contents('debug.log', "Order Data: " . print_r($orderData, true) . PHP_EOL, FILE_APPEND);
    file_put_contents('debug.log', "Payment Details: " . print_r($paymentDetails, true) . PHP_EOL, FILE_APPEND);

    // Commit transaction
    $pdo->commit();

    // Respond with a success message
    echo json_encode(['success' => true]);

} catch (Exception $e) {
    // Rollback transaction on error
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
