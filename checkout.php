<?php
// Assume database connection in $con and session management
session_start();
require 'includes/db.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['username'])) {
header('Location: Login-page'); // Redirect to login page if not logged in
exit();
}

$user_full_name = $_SESSION['username'];

// Fetch customer_login_id based on full_name
$stmt = $con->prepare("SELECT id FROM customer_login WHERE full_name = ?");
$stmt->bind_param("s", $user_full_name);
$stmt->execute();
$result = $stmt->get_result();

$user_id = $result->fetch_assoc()['id'];

// Get customer ID from session
$customer_login_id = $user_id;

// Fetch customer details once
$customerQuery = "SELECT * FROM customers WHERE customer_login_id = ?";
$stmt = $con->prepare($customerQuery);
$stmt->bind_param("i", $customer_login_id);
$stmt->execute();
$customerResult = $stmt->get_result();
$customer = $customerResult->fetch_assoc();

if ($customer) {
$addressOptions = "<option value='{$customer['customer_address']}'>{$customer['customer_address']}, {$customer['customer_city']}, {$customer['customer_country']} - {$customer['customer_pincode']}</option>";
} else {
$addressOptions = "<option value=''>No saved addresses found. Please add a new address.</option>";
}

// Fetch cart items and calculate subtotal
$cartQuery = "
SELECT
c.qty,
c.p_id,
c.p_price,
p.product_title,
MIN(pi.image) AS image,
c.color,
c.size,
p.shipping_charges
FROM cart AS c
JOIN products AS p ON c.p_id = p.product_id
JOIN product_images AS pi ON pi.product_id = c.p_id AND pi.color = c.color
WHERE c.customer_login_id = ?
GROUP BY c.p_id, c.qty, c.p_price, p.product_title, c.color, c.size";

$stmt = $con->prepare($cartQuery);
$stmt->bind_param("i", $customer_login_id);
$stmt->execute();
$cartResult = $stmt->get_result();

$subtotal = 0;
$totalShipping = 0; // Initialize total shipping charges
$cartItemsHTML = '';
while ($cartItem = $cartResult->fetch_assoc()) {
$itemTotal = $cartItem['qty'] * $cartItem['p_price'];
$subtotal += $itemTotal;

// Add the shipping charges for this product
$totalShipping += $cartItem['shipping_charges'];

$cartItemsHTML .= "
<div class='cart-item' data-product-id='{$cartItem['p_id']}'>
<img src='admin_area/product_images/{$cartItem['image']}' alt='{$cartItem['product_title']}'>
<div class='item-details'>
<p>{$cartItem['product_title']}</p>
<p>Color: {$cartItem['color']}</p>
<p>Size: {$cartItem['size']}</p>
<p><span class='quantity_vs'>{$cartItem['qty']}</span>x ₹{$cartItem['p_price']} = ₹{$itemTotal}</p>
</div>
</div>";
}

// Calculate final total
$total = $subtotal + $totalShipping;

// Prepare data for JavaScript
$shippingCharges = [
'subtotal' => $subtotal,
'shipping' => $totalShipping,
'total' => $total
];

// Pass shipping charges and total to the frontend
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
<title>Checkout – motodresser</title>
<?php include 'includes/head-links.php'; ?>
<style>
.checkout-container {
display: flex;
flex-wrap: wrap;
max-width: 1200px;
margin: 0 auto;
background-color: #fff;
border-radius: 10px;
box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
padding: 20px;
gap: 20px;
}

.checkout-form,
.cart-summary {
flex: 1;
padding: 20px;
min-width: 300px;
}

h1,
h2 {
font-size: 24px;
margin-bottom: 10px;
color: #333;
}

h2 {
font-size: 20px;
}

.form-group {
margin-bottom: 20px;
}

label {
display: block;
margin-bottom: 5px;
font-weight: bold;
color: #555;
}

input,
select {
width: 100%;
padding: 10px;
border: 1px solid #ddd;
border-radius: 5px;
margin-bottom: 10px;
}

.address-selection {
margin-bottom: 20px;
}

.address-selection select {
width: 100%;
}

.add-new-address {
margin-top: 10px;
background-color: #007bff;
color: #fff;
padding: 10px;
border-radius: 5px;
cursor: pointer;
text-align: center;
}

.cart-summary h2 {
text-align: right;
}

.cart-item {
display: flex;
align-items: center;
margin-bottom: 15px;
}

.cart-item img {
width: 60px;
height: 60px;
margin-right: 15px;
}

.item-details p {
margin: 0;
color: #666;
}

.discount {
margin: 20px 0;
text-align: right;
}

.discount input {
width: calc(70% - 10px);
margin-right: 10px;
padding: 10px;
border-radius: 5px;
border: 1px solid #ddd;
}

.discount .apply-btn {
padding: 10px;
background-color: #28a745;
color: #fff;
border: none;
cursor: pointer;
border-radius: 5px;
}

.totals p {
display: flex;
justify-content: space-between;
margin-bottom: 10px;
}

.total {
font-weight: bold;
}

.pay-now-btn {
width: 100%;
padding: 15px;
background-color: #007bff;
color: white;
border: none;
border-radius: 5px;
cursor: pointer;
margin-top: 20px;
font-size: 18px;
}

.pay-now-btn:hover {
background-color: #0056b3;
}

.payment-methods {
margin: 20px 0;
}

.payment-methods label {
display: block;
margin-bottom: 5px;
cursor: pointer;
}

.payment-methods input {
margin-right: 10px;
}

/* Responsive design */
@media (max-width: 768px) {
.checkout-container {
flex-direction: column;
padding: 10px;
}

.checkout-form,
.cart-summary {
padding: 10px;
}

.cart-summary h2,
.discount,
.totals {
text-align: left;
}
}
</style>

</head>

<body>
<?php include 'includes/top-bar.php'; ?>
<div class="page_wrapper">
<?php include 'includes/header.php'; ?>
<main class="page_content" style="margin: 140px 0 40px;">
<section>
<div class="checkout-container">
<!-- Address Section -->
<div class="checkout-form">
<h1>Checkout</h1>
<h2>Your Address</h2>
<div class="address-selection">
<label for="saved-address">Choose a saved address:</label>
<select id="saved-address">
<?= $addressOptions ?>
</select>
<div class="add-new-address" onclick="showAddressForm()">+ Add New Address</div>
</div>

<form id="new-address-form" style="display:none;">
<input type="text" id="new-address" placeholder="Address">
<input type="text" id="new-city" placeholder="City">
<input type="text" id="new-country" placeholder="Country">
<input type="text" id="new-pincode" placeholder="Pincode">
<button type="button" onclick="saveNewAddress()" style="color: black; background-color: gray; padding: 10px;">Save Address</button>
</form>

<!-- Payment Method -->
<h2>Payment Method</h2>
<div class="payment-methods">
<label style="display: flex; align-items: center;">
<input style="width: 12px" type="radio" name="payment-method" value="cod" checked> <p>Cash on Delivery (COD)</p>
</label>
<label style="display: flex; align-items: center;">
<input style="width: 12px" type="radio" name="payment-method" value="online"> <p>Pay Online (Razorpay)</p>
</label>
</div>
</div>

<!-- Cart Summary Section -->
<div class="cart-summary">
<h2>Review Your Cart</h2>
<?= $cartItemsHTML ?>

<!-- Discount Code -->
<div class="discount">
<input type="text" id="discount-code" placeholder="Enter discount code">
<button class="apply-btn" onclick="applyDiscount()">Apply</button>
</div>

<!-- Subtotal and other totals will be updated dynamically -->
<div class="totals" style="margin-top: 40px;">
<p>Subtotal: <span id="subtotal">₹<?= number_format($subtotal, 2) ?></span></p>
<p>Shipping: <span id="shipping-charge">₹<?= number_format($totalShipping, 2) ?></span></p>
<p>Discount: <span id="discount">-₹0.00</span></p>
<p class="total">Total: <span id="total">₹<?= number_format($total, 2) ?></span></p>
</div>
<button class="pay-now-btn" onclick="placeOrder()">Place Order</button>
</div>
</div>
</section>
</main>
<?php include 'includes/footer.php'; ?>
</div>
<?php include 'includes/script-links.php'; ?>

<script>
// Example of dynamically updating totals
const subtotal = <?= json_encode($shippingCharges['subtotal']) ?>;
const shipping = <?= json_encode($shippingCharges['shipping']) ?>;
const total = <?= json_encode($shippingCharges['total']) ?>;

document.getElementById("subtotal").innerText = "₹" + subtotal.toFixed(2);
document.getElementById("shipping-charge").innerText = "₹" + shipping.toFixed(2);
document.getElementById("total").innerText = "₹" + total.toFixed(2);
</script>

<script>
function showAddressForm() {
document.getElementById('new-address-form').style.display = 'block';
}

function saveNewAddress() {
const address = document.getElementById('new-address').value;
const city = document.getElementById('new-city').value;
const country = document.getElementById('new-country').value;
const pincode = document.getElementById('new-pincode').value;

// Use AJAX to save the address in the database
fetch('save_address', {
method: 'POST',
headers: {
'Content-Type': 'application/json'
},
body: JSON.stringify({
address,
city,
country,
pincode
})
})
.then(response => response.json())
.then(data => {
if (data.success) {
Swal.fire('Address changed', 'Address changed Successfully.', 'success')
.then(() => {
location.reload();
});
} else {
alert('Error saving address');
}
});
}
</script>

<script>
function applyDiscount() {
const discountCode = document.getElementById('discount-code').value.trim();
const subtotal = <?= json_encode($shippingCharges['subtotal']) ?>; // Pass subtotal from PHP to JS
const total = <?= json_encode($shippingCharges['total']) ?>; // Pass total from PHP to JS

fetch('validate_coupon.php', {
method: 'POST',
headers: {
'Content-Type': 'application/json'
},
body: JSON.stringify({
code: discountCode,
subtotal: subtotal
})
})
.then(response => response.json())
.then(data => {
if (data.success) {
let discount = data.amount;

// Check if the discount is a percentage (e.g., '10%')
if (typeof discount === 'string' && discount.includes('%')) {
const percentage = parseFloat(discount.replace('%', '')); // Extract percentage
if (!isNaN(percentage) && percentage > 0) {
discount = (subtotal * percentage) / 100; // Calculate percentage discount
} else {
Swal.fire('Error!', 'Invalid discount percentage.', 'error');
return;
}
}

// Ensure discount is not greater than the total
if (discount > total) {
Swal.fire('Error!', 'Discount cannot be greater than the total price.', 'error');
return;
}

// Update the discount display and total
document.getElementById('discount').innerText = `-₹${discount.toFixed(2)}`;
updateTotal(discount); 

// Show success alert
Swal.fire('Success!', 'Discount applied successfully!', 'success');
} else {
Swal.fire('Error!', data.message, 'error');
}
})
.catch(error => {
console.error('Error applying discount:', error);
Swal.fire('Error!', 'Could not apply the discount. Please try again.', 'error');
});
}

// Function to update total after discount
function updateTotal(discount) {
const subtotal = <?= json_encode($shippingCharges['subtotal']) ?>;
const totalShipping = <?= json_encode($shippingCharges['shipping']) ?>;

const newTotal = subtotal + totalShipping - discount;
document.getElementById('total').innerText = `₹${newTotal.toFixed(2)}`;
}

</script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>async function placeOrder() {
    const paymentMethod = document.querySelector('input[name="payment-method"]:checked').value;
    const address = document.getElementById('saved-address').value;
    const customerId = <?= json_encode($customer_login_id ?? null) ?>;

    const cartItems = document.querySelectorAll('.cart-item');
    const productsOrdered = Array.from(cartItems).map(item => ({
        productId: item.dataset.productId,
        quantity: parseInt(item.querySelector('.quantity_vs').innerText),
        color: item.querySelector('p:nth-child(2)').innerText.replace('Color: ', ''),
        size: item.querySelector('p:nth-child(3)').innerText.replace('Size: ', '')
    }));

    const totalAmount = parseFloat(document.getElementById('total').innerText.replace('₹', '').replace(',', ''));
    const invoiceNo = 'INV-' + Date.now();

    const orderDetails = {
        customer_id: customerId,
        total_amount: totalAmount,
        invoice_no: invoiceNo,
        qty: productsOrdered.reduce((sum, item) => sum + item.quantity, 0),
        payment_method: paymentMethod,
        products_ordered: productsOrdered
    };

    if (paymentMethod === 'cod') {
        const formData = new FormData();
        Object.keys(orderDetails).forEach(key => {
            if (key === 'products_ordered') {
                formData.append(key, JSON.stringify(orderDetails[key]));
            } else {
                formData.append(key, orderDetails[key]);
            }
        });

        const response = await fetch('place_order.php', {
            method: 'POST',
            body: formData
        });

        const data = await response.text();
        console.log(data); // For debugging
    } else {
        const orderData = {
        customer_id: customerId,
        total_amount: totalAmount,
        invoice_no: invoiceNo,
        qty: productsOrdered.reduce((sum, item) => sum + item.quantity, 0),
        products_ordered: productsOrdered
    };

    const response = await fetch('create_razorpay_order.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(orderData)
    });

    const data = await response.json();

    if (data.success) {
        const options = {
            key: 'rzp_test_uxKdzs7v17Ts4S', // Your Razorpay Key ID
            amount: totalAmount * 100, // Amount in paise
            currency: 'INR',
            order_id: data.order_id, // Received from backend
            name: 'Your Store Name',
            description: 'Order Payment',
            handler: function(response) {
                // After successful payment
                const paymentDetails = {
                    razorpay_payment_id: response.razorpay_payment_id,
                    razorpay_order_id: response.razorpay_order_id,
                    razorpay_signature: response.razorpay_signature,
                    order_id: data.order_id
                };
                const combinedData = {
    orderData: orderData,
    paymentDetails: paymentDetails
};
                // Save payment details in the database
                fetch('verify_razorpay_payment.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(combinedData)
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Success!', 'Payment successful!', 'success')
                        .then(() => {
                            location.reload(); // Refresh page after payment
                        });
                    } else {
                        Swal.fire('Error!', 'Failed to save payment details.', 'error');
                    }
                });
            },
            prefill: {
                name: 'Customer Name', // Customer's name
                email: 'customer@example.com', // Customer's email
                contact: '1234567890' // Customer's contact
            },
            theme: {
                color: '#F37254' // Razorpay theme color
            }
        };

        const rzp = new Razorpay(options);
        rzp.open();
    } else {
        Swal.fire('Error!', 'Failed to create order.', 'error');
    }
}
}
</script>
</body>

</html>