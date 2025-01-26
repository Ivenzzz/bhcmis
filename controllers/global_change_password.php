<?php
session_start();
require_once '../partials/global_db_config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

// Extract and validate account_id
$account_id = filter_var($data['account_id'] ?? null, FILTER_VALIDATE_INT);
$currentPassword = $data['currentPassword'] ?? '';
$newPassword = $data['newPassword'] ?? '';
$confirmPassword = $data['confirmPassword'] ?? '';

// Validate account ID
if (!$account_id || $account_id < 1) {
    echo json_encode(['success' => false, 'message' => 'Invalid account identifier']);
    exit;
}

// Server-side validation
if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

if ($newPassword !== $confirmPassword) {
    echo json_encode(['success' => false, 'message' => 'New passwords do not match']);
    exit;
}

try {
    // Get current user's password hash
    $stmt = $conn->prepare("SELECT password FROM accounts WHERE account_id = ?");
    $stmt->bind_param("i", $account_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user || !password_verify($currentPassword, $user['password'])) {
        echo json_encode(['success' => false, 'message' => 'Current password is incorrect']);
        exit;
    }

    // Hash new password
    $newHash = password_hash($newPassword, PASSWORD_BCRYPT);

    // Update password and timestamp in database
    $updateStmt = $conn->prepare("UPDATE accounts SET password = ?, updated_at = NOW() WHERE account_id = ?");
    $updateStmt->bind_param("si", $newHash, $account_id);
    $updateStmt->execute();

    if ($updateStmt->affected_rows === 1) {
        echo json_encode(['success' => true, 'message' => 'Password updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update password']);
    }
} catch (Exception $e) {
    error_log("Password change error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Server error occurred']);
}