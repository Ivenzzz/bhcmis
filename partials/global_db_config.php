<?php

<<<<<<< HEAD
error_reporting(0);
ini_set('display_errors', 0);


=======
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
$server = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'bhcmis';

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

?>
