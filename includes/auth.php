<?php
session_start();
include("includes/head.php");
include 'includes/configs.php';
include 'includes/db.php';

// Check authentication
if (!isset($_SESSION['customer_id'])) {
    header("Location: index.php");
    exit();
}

$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : "";
unset($_SESSION['success_message']);

$customer_id = $_SESSION['customer_id'];
