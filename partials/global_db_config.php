<?php

$server = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'bhcmis';

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

?>
