<?php

require_once __DIR__ . '/../vendor/autoload.php'; 


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Get database connection info
$host = $_ENV['DB_HOST']; 
$db_name = $_ENV['DB_NAME']; 
$username = $_ENV['DB_USER']; 
$password = $_ENV['DB_PASSWORD']; 
$port = $_ENV['DB_PORT']; 

// Create connection
$conn = new mysqli($host, $username, $password, $db_name, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "";

?>
