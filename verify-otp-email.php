<?php
session_start();
include './includes/db.php'; // Include your DB connection

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredOtp = $_POST['otp'];

    // Check if OTP from session matches the entered OTP
    if (isset($_SESSION['otp']) && $_SESSION['otp'] == $enteredOtp) {
        // OTP is valid, proceed to check or insert data into the database
        $email = $_SESSION['email'];

        // Debug: Check if the email in the session is correct
        echo "Session Email: " . $email . "<br>";

        try {
            // Check if the email already exists
            $checkStmt = $pdo->prepare("SELECT * FROM customer_login WHERE email = :email");
            $checkStmt->execute([':email' => $email]);
            $user = $checkStmt->fetch(PDO::FETCH_ASSOC);

            // Debug: Check the query result
            if ($user) {
                echo "User Found: Yes <br>";
            } else {
                echo "User Found: No <br>";
            }

            if ($user) {
                // Email already exists, log the user in
                $_SESSION['username'] = $user['email']; // Store the username in the session
                echo "User already registered. Logging in...<br>";

                // Now update the user data if necessary (e.g., updating full_name, verifiedEmail, updated_at)
                $updateStmt = $pdo->prepare("
                    UPDATE customer_login 
                    SET full_name = :full_name, 
                        verifiedEmail = 1, 
                        updated_at = NOW() 
                    WHERE email = :email
                ");
                $updateStmt->execute([
                    ':full_name' => $email, // You can change this to something more meaningful if needed
                    ':email' => $email
                ]);

                // Display updated user data
                echo "<h3>Updated User Details</h3>";
                echo "<p>Email: " . $user['email'] . "</p>";
                echo "<p>Full Name: " . $user['full_name'] . "</p>";
                echo "<p>Verified Email: " . ($user['verifiedEmail'] ? 'Yes' : 'No') . "</p>";
                echo "<p>Created At: " . $user['created_at'] . "</p>";
                echo "<p>Updated At: " . date("Y-m-d H:i:s") . "</p>"; // Displaying the current updated timestamp

                // Redirect to home page or dashboard
                header("Location: index.php"); 
                exit;
            } else {
                // Email does not exist, insert the email and log the user in
                $insertStmt = $pdo->prepare("
                    INSERT INTO customer_login (email, full_name, verifiedEmail, created_at, updated_at) 
                    VALUES (:email, :full_name, 1, NOW(), NOW())
                ");
                $insertStmt->execute([
                    ':email' => $email,
                    ':full_name' => $email // Use email as the full name, adjust if needed
                ]);

                if ($insertStmt) {
                    $_SESSION['username'] = $email; // Store the username in the session
                    echo "Email verified and user data inserted successfully.<br>";

                    // Fetch and display the inserted data
                    $newUserStmt = $pdo->prepare("SELECT * FROM customer_login WHERE email = :email");
                    $newUserStmt->execute([':email' => $email]);
                    $newUser = $newUserStmt->fetch(PDO::FETCH_ASSOC);

                    if ($newUser) {
                        // Display user data
                        echo "<h3>User Details</h3>";
                        echo "<p>Email: " . $newUser['email'] . "</p>";
                        echo "<p>Full Name: " . $newUser['full_name'] . "</p>";
                        echo "<p>Verified Email: " . ($newUser['verifiedEmail'] ? 'Yes' : 'No') . "</p>";
                        echo "<p>Created At: " . $newUser['created_at'] . "</p>";
                        echo "<p>Updated At: " . $newUser['updated_at'] . "</p>";
                    }
                    // Redirect to home page or dashboard
                    header("Location: index.php"); 
                    exit;
                } else {
                    echo "Failed to insert user data.";
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

    } else {
        echo "Invalid OTP.";
    }
}
?>
