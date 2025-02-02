<?php
session_start();
require_once '../partials/global_db_config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

try {
    // Validate inputs
    $account_id = filter_input(INPUT_POST, 'account_id', FILTER_VALIDATE_INT);
    $username = trim(htmlspecialchars($_POST['username'] ?? ''));

    if (!$account_id || $account_id < 1) {
        throw new Exception('Invalid account identifier');
    }

    if (empty($username) || strlen($username) < 3) {
        throw new Exception('Username must be at least 3 characters');
    }

    // Check username availability
    $stmt = $conn->prepare("SELECT account_id FROM accounts WHERE username = ? AND account_id != ?");
    $stmt->bind_param("si", $username, $account_id);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        throw new Exception('Username already taken');
    }

    // File upload handling
    $profilePicture = null;
    if (!empty($_FILES['profile_picture']['tmp_name'])) {
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        $maxFileSize = 2 * 1024 * 1024;
        
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($_FILES['profile_picture']['tmp_name']);
        $fileExt = strtolower(pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION));

        if (!in_array($fileExt, $allowedTypes)) {
            throw new Exception('Invalid file type. Allowed: JPG, PNG, GIF');
        }

        if (!in_array($mimeType, ['image/jpeg', 'image/png', 'image/gif'])) {
            throw new Exception('Invalid file content');
        }

        if ($_FILES['profile_picture']['size'] > $maxFileSize) {
            throw new Exception('File size exceeds 2MB limit');
        }

        $basePath = '/bhcmis/storage/uploads/';
        $absoluteUploadPath = $_SERVER['DOCUMENT_ROOT'] . $basePath;
        
        if (!file_exists($absoluteUploadPath)) {
            mkdir($absoluteUploadPath, 0755, true);
        }

        $fileName = uniqid() . '.' . $fileExt;
        $targetFile = $absoluteUploadPath . $fileName;

        if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFile)) {
            throw new Exception('Failed to save uploaded file');
        }

        $profilePicture = $basePath . $fileName;
    }

    // Update database
    $sql = "UPDATE accounts SET 
            username = ?, 
            profile_picture = COALESCE(?, profile_picture), 
            updated_at = NOW() 
            WHERE account_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $username, $profilePicture, $account_id);
    $stmt->execute();

    if ($stmt->affected_rows === 0) {
        throw new Exception('No changes made');
    }

    echo json_encode([
        'success' => true,
        'message' => 'Profile updated successfully',
        'profile_picture' => $profilePicture
    ]);

} catch (Exception $e) {
    error_log("Profile update error: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
} finally {
    if (isset($stmt)) {
        $stmt->close();
    }
    $conn->close();
}