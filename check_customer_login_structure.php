<?php
include './includes/db.php'; // Include your DB connection

try {
    $stmt = $pdo->query("DESCRIBE customer_login");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($columns) {
        echo "<h2>customer_login Table Structure</h2>";
        echo "<table border='1'><tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
        foreach ($columns as $column) {
            echo "<tr>
                    <td>{$column['Field']}</td>
                    <td>{$column['Type']}</td>
                    <td>{$column['Null']}</td>
                    <td>{$column['Key']}</td>
                    <td>{$column['Default']}</td>
                    <td>{$column['Extra']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No columns found in the customer_login table.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
