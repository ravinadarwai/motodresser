<?php
// Replace with your Cashfree test credentials
$app_id = 'TEST1028077327cf8aad17f176e6222037708201';
$secret_key = 'cfsk_ma_test_90e81a974bde0db74797cf8474cee25f_50734b00';
$cashfree_endpoint = 'https://sandbox.cashfree.com/pg/orders';
$version = '2023-08-01'; // Using one of the valid API versions

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $upi_id = $_POST['upi_id'];
    $amount = $_POST['amount'];

    // Generate a unique order ID
    $order_id = 'ORDER' . time();

    // Prepare order data for Cashfree
    $orderData = [
        'order_id' => $order_id,
        'order_amount' => $amount,
        'order_currency' => 'INR',
        'customer_details' => [
            'customer_id' => 'cust_' . time(),
            'customer_name' => $name,
            'customer_email' => $email,
            'customer_phone' => $phone,
        ],
        'order_meta' => [
            'upi_details' => [
                'vpa' => $upi_id // Virtual Payment Address for UPI
            ]
        ],
        'order_note' => 'Test UPI Payment',
        'return_url' => 'handle_payment_response.php?order_id=' . $order_id,
    ];

    // Convert order data to JSON
    $jsonOrderData = json_encode($orderData);

    // Make a POST request to Cashfree API
    $headers = [
        'Content-Type: application/json',
        'x-client-id: ' . $app_id,
        'x-client-secret: ' . $secret_key,
        'x-api-version: ' . $version
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $cashfree_endpoint);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonOrderData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($response, true);

    if (isset($response['payment_session_id'])) {
        // Redirect the user to the Cashfree hosted payment page with the payment session ID.
        $payment_session_id = $response['payment_session_id'];
        $payment_url = "https://sandbox.cashfree.com/pg/orders/$payment_session_id";
        header('Location: ' . $payment_url);
        exit;
    } else {
        // Display error if payment session ID is not present
        echo "<h2>Error creating payment order</h2>";
        echo "<p>Unexpected error occurred. Please check the API response for details.</p>";
        echo "<pre>";
        print_r($response); // For debugging
        echo "</pre>";
    }
} else {
    echo "Invalid request.";
}
?>
