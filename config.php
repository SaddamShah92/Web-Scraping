<?php

// Database configuration
$host = 'localhost';
$dbname = 'prototype';
$username = 'root';
$password = '';

// Create a new PDO object and connect to the database
$conn = mysqli_connect("localhost", "root", "", "prototype");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
