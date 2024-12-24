<?php
require '../partials/global_db_config.php'; // Include database configuration

// Decode the JSON payload
$input = json_decode(file_get_contents('php://input'), true);

// Validate the input
if (isset($input['id']) && is_numeric($input['id'])) {
    $con_sched_id = intval($input['id']);

    // Prepare the query to set isArchived to 1
    $stmt = $conn->prepare("UPDATE consultation_schedules SET isArchived = 1, updated_at = CURRENT_TIMESTAMP WHERE con_sched_id = ?");
    $stmt->bind_param("i", $con_sched_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid or missing ID']);
}

$conn->close();
