<?php
session_start();

// Destroy the session
session_unset();
session_destroy();

// Send a response back to the Fetch request
echo json_encode(['status' => 'success']);
?>
