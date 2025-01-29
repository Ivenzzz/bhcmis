<?php
require '../partials/global_db_config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $accountId = $data['account_id'] ?? null;
    $newPassword = $data['new_password'] ?? null;

    if (!$accountId || !$newPassword) {
        echo json_encode(['success' => false, 'message' => 'Account ID and new password are required.']);
        exit;
    }

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the password in the database
    $stmt = $conn->prepare("UPDATE accounts SET password = ? WHERE account_id = ?");
    $stmt->bind_param('si', $hashedPassword, $accountId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Password has been reset successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to reset the password.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
