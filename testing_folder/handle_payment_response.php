<?php
if (isset($_GET['order_id']) && isset($_GET['order_status'])) {
    $order_id = $_GET['order_id'];
    $order_status = $_GET['order_status'];

    echo "<h2>Payment Response</h2>";
    echo "<p>Order ID: $order_id</p>";
    echo "<p>Order Status: $order_status</p>";

    // Check if the payment is successful
    if ($order_status === 'PAID') {
        echo "<p>Payment Successful!</p>";
    } else {
        echo "<p>Payment Failed or Pending. Please try again.</p>";
    }
} else {
    echo "Invalid payment response.";
}
?>
