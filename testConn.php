<?php

$db_servername = "localhost";
$db_username = "root";
$db_password = "root";

try {
    $conn = new PDO("mysql:host=$db_servername;dbname=php67", $db_username, $db_password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h1>Connected successfully</h1>";

    // Insert into DB

    $conn = null;
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
