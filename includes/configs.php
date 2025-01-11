<?php

// Load the .env file using Dotenv
require_once __DIR__ . '/../vendor/autoload.php'; 

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../'); 
$dotenv->load();

// Geting keys from the .env file
$SecretKey = $_ENV['PAYSTACK_SECRET_KEY'];
$PublicKey = $_ENV['PAYSTACK_PUBLIC_KEY'];


