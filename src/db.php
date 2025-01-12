<?php
// Database information
$servername = "mariadb";
$username = "root";
$password = "mariadb";
$dbname = "mariadb";

try {
    // Creates a new PDO instance to establish a connection to the database.
    $conn = new PDO(
        "mysql:host=$servername;dbname=$dbname;charset=utf8mb4", 
        $username, 
        $password
    );
    // Sets the PDO error mode to exception to handle errors more effectively.
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handles connection errors and outputs an error message
    die("Failed to connect: " . $e->getMessage());
     // Stops the script execution if the connection fails.
}
