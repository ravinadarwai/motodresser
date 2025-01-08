<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Razorpay Integration</title>
    <!-- <script src="https://checkout.razorpay.com/v1/checkout.js"></script> -->
</head>
<body>
    <h1>Pay with Razorpay</h1>
    <button id="pay-btn">Pay Now</button>

    <script>
        document.getElementById('pay-btn').onclick = function() {
            var options = {
                "key": "YOUR_RAZORPAY_KEY", // Replace with your Razorpay Key ID
                "amount": 1000, // Amount is in paise (e.g., 1000 paise = INR 10)
                "currency": "INR",
                "name": "motodresser",
                "description": "Test Transaction",
                "image": "https://yourwebsite.com/logo.png", // Optional: Replace with your logo URL
                "handler": function(response) {
                    // This function handles the success of the payment
                    alert("Payment successful! Payment ID: " + response.razorpay_payment_id);
                    // Here, you can send the payment ID to your server for further processing or store it in the database
                },
                "prefill": {
                    "name": "Customer Name", // Optional: Prefill customer's name
                    "email": "customer@example.com", // Optional: Prefill customer's email
                    "contact": "9999999999" // Optional: Prefill customer's contact
                },
                "theme": {
                    "color": "#007bff"
                }
            };

            var rzp = new Razorpay(options);
            rzp.open();
        };
    </script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</body>
</html>
