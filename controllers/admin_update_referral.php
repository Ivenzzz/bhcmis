<?php
require '../partials/global_db_config.php';
require '../models/get_current_user.php';

session_start();

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['pdf'], $data['referral_id'])) {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
    exit;
}

// Prepare file storage
$targetDir = '../storage/referral_forms/';
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// Generate filename
$filename = 'referral_' . $data['referral_id'] . '_' . date('Ymd_His') . '.pdf';
$filePath = $targetDir . $filename;

// Decode and save PDF
$pdfData = base64_decode($data['pdf']);
if ($pdfData === false) {
    echo json_encode(['success' => false, 'error' => 'Invalid PDF data']);
    exit;
}

if (!file_put_contents($filePath, $pdfData)) {
    echo json_encode(['success' => false, 'error' => 'Failed to save file']);
    exit;
}

// Update database with file path, status, and resolved date
$stmt = $conn->prepare("UPDATE referral_requests 
                       SET document_path = ?, 
                           resolved_date = CURDATE(), 
                           status = 'Approved' 
                       WHERE referral_id = ?");
$stmt->bind_param("si", $filePath, $data['referral_id']);
$stmt->execute();

if ($stmt->affected_rows === 0) {
    echo json_encode(['success' => false, 'error' => 'No records updated']);
    $stmt->close();
    exit;
}

$stmt->close();

echo json_encode([
    'success' => true,
    'path' => $filePath,
    'updated_fields' => ['document_path', 'resolved_date', 'status']
]);
exit;
?>