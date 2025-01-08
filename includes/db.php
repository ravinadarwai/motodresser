<?php

// MySQLi Connection
$con = mysqli_connect("localhost", "root", "", "u308286852_motodresser");

// Check MySQLi connection
if (!$con) {
    die("MySQLi Connection failed: " . mysqli_connect_error());
}

// PDO Connection
try {
    $pdo = new PDO('mysql:host=localhost;dbname=u308286852_motodresser', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('PDO Connection failed: ' . $e->getMessage());
}

?>
