<?php

session_start();

// Include necessary files
require '../partials/global_db_config.php';
require '../models/get_residents.php';

// Get the account_id from the request
$data = json_decode(file_get_contents("php://input"), true);
$accountId = $data['account_id'] ?? null;

if ($accountId) {
    // Update the account record in the database (mark as rejected)
    $sql = "UPDATE accounts SET isRejected = 1 WHERE account_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $accountId);
        if ($stmt->execute()) {
            // Respond with success
            echo json_encode(['success' => true]);
        } else {
            // Respond with error if query fails
            echo json_encode(['success' => false, 'message' => 'Failed to reject resident.']);
        }
        $stmt->close();
    } else {
        // Respond with error if preparation of the query fails
        echo json_encode(['success' => false, 'message' => 'Database error.']);
    }
} else {
    // Invalid account_id in the request
    echo json_encode(['success' => false, 'message' => 'Invalid account ID.']);
}
