<?php
session_start();
require '../partials/global_db_config.php';
header('Content-Type: application/json');

try {

    // Get input data
    $data = json_decode(file_get_contents('php://input'), true);
    $residentId = filter_var($data['resident_id'] ?? null, FILTER_VALIDATE_INT);

    if (!$residentId) {
        throw new Exception('Invalid resident ID');
    }

    // Update transfer status
    $stmt = $conn->prepare("UPDATE personal_information SET isTransferred = 0 WHERE personal_info_id = (
        SELECT personal_info_id FROM residents WHERE resident_id = ?
    )");
    $stmt->bind_param('i', $residentId);
    
    if (!$stmt->execute()) {
        throw new Exception('Failed to update database');
    }

    echo json_encode([
        'success' => true,
        'message' => 'Transfer status successfully undone'
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>