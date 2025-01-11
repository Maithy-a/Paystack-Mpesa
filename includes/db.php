<?php

$host = 'localhost'; 
$db_name = 'paystack'; 
$username = 'root'; 
$password = '#tHinkpad8700';

// Create connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "";

?>
