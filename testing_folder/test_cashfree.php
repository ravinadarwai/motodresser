<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashfree UPI Payment Test</title>
</head>
<body>
    <h2>Cashfree UPI Payment Test</h2>
    <form action="create_cashfree_order.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required>
        <br><br>
        <label for="upi_id">UPI ID:</label>
        <input type="text" id="upi_id" name="upi_id" required placeholder="example@upi">
        <br><br>
        <label for="amount">Amount (INR):</label>
        <input type="number" id="amount" name="amount" required>
        <br><br>
        <button type="submit">Pay Now</button>
    </form>
</body>
</html>
