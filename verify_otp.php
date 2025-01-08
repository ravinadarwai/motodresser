<?php
session_start();
include("includes/db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the raw POST data and decode JSON
    $data = json_decode(file_get_contents("php://input"), true);
    $email = $data['email'];
    $otp = $data['otp'];

    // Prepare a response array
    $response = [];

    // Using prepared statements to prevent SQL injection
    $query = "SELECT * FROM customer_login WHERE email = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $db_otp = $user['otp_code'];
        $otp_created_at = strtotime($user['otp_created_at']);

        // Check if OTP matches and is within 10 minutes
        if ($otp == $db_otp && (time() - $otp_created_at) < 600) {
            // OTP is valid, insert the user into the final users table
            $full_name = $user['full_name'];  // Get full name from customer_login

            $insert_query = "INSERT INTO users (email, full_name, password) VALUES (?, ?, ?)";
            $stmt_insert = mysqli_prepare($con, $insert_query);
            $hashed_password = password_hash($user['password'], PASSWORD_DEFAULT); // Hash the password
            mysqli_stmt_bind_param($stmt_insert, 'sss', $email, $full_name, $hashed_password);
            if (mysqli_stmt_execute($stmt_insert)) {
                // Now delete the record from customer_login after successful insertion
                $delete_query = "DELETE FROM customer_login WHERE email = ?";
                $stmt_delete = mysqli_prepare($con, $delete_query);
                mysqli_stmt_bind_param($stmt_delete, 's', $email);
                mysqli_stmt_execute($stmt_delete);

                $response['success'] = true;
                $response['message'] = 'Registration successful and OTP verified.';
            } else {
                $response['success'] = false;
                $response['message'] = 'Error inserting user into users table.';
            }
        } else {
            // OTP is invalid or expired
            $response['success'] = false;
            $response['message'] = 'Invalid or expired OTP. Please try again.';
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'User not found.';
    }

    // Return JSON response
    echo json_encode($response);
    exit();
}
?>
