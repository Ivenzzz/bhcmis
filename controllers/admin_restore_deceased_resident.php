<?php
session_start();
require '../partials/global_db_config.php';

header('Content-Type: application/json');

try {
    // Validate input
    $data = json_decode(file_get_contents('php://input'), true);
    if (!isset($data['resident_id']) || empty($data['resident_id'])) {
        throw new Exception('Invalid resident ID.');
    }

    $residentId = intval($data['resident_id']);

    // Update the resident's status in the database
    $sql = "UPDATE personal_information 
            SET isDeceased = 0, deceased_date = NULL 
            WHERE personal_info_id = (
                SELECT personal_info_id 
                FROM residents 
                WHERE resident_id = ?
            )";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Database error: " . $conn->error);
    }

    $stmt->bind_param('i', $residentId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode([
            'success' => true,
            'message' => 'Resident restored successfully.'
        ]);
    } else {
        throw new Exception('No changes made. Resident may not exist or already be active.');
    }

    $stmt->close();
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}