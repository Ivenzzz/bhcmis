<?php
require '../../../config/db_config.php';

// Get the posted data
$data = json_decode(file_get_contents("php://input"), true);
$bhw_id = $data['bhw_id'];

// Fetch account_id from bhw table using bhw_id
$query = "SELECT account_id FROM bhw WHERE bhw_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $bhw_id);
$stmt->execute();
$stmt->bind_result($account_id);
$stmt->fetch();
$stmt->close();

if ($account_id) {
    // Update isArchived in accounts table
    $updateQuery = "UPDATE accounts SET isArchived = 1 WHERE account_id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("i", $account_id);
    
    if ($updateStmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to archive account.']);
    }
    $updateStmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'BHW not found.']);
}

$conn->close();
