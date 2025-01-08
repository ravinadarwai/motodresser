<?php
require 'vendor/autoload.php'; // Load Razorpay SDK

use Razorpay\Api\Api;

// Your Razorpay API Key and Secret
$keyId = 'rzp_test_uxKdzs7v17Ts4S';      // Replace with your Key ID
$keySecret = 'UHdx7VAXCytr5Bf0AXMev5Iw'; // Replace with your Key Secret

// Initialize Razorpay API
$razorpay = new Api($keyId, $keySecret);
?>
