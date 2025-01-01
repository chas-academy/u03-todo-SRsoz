<?php
// Databasuppgifter
$servername = "mariadb";
$username = "root";
$password = "mariadb";
$dbname = "mariadb";

try {
    // Skapa en ny PDO-instans
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Felhantering vid anslutningsproblem
    die("Failed to connect: " . $e->getMessage());
}
