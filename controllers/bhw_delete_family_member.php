<?php
// Include database configuration
require_once '../partials/global_db_config.php';

// Set response header for JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $data = json_decode(file_get_contents('php://input'), true);

    // Extract fmember_id from the request
    $fmember_id = $data['fmember_id'] ?? null;

    if ($fmember_id) {
        // Prepare the SQL query to update isArchived
        $query = "UPDATE family_members SET isArchived = 1, updated_at = NOW() WHERE fmember_id = ?";

        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("i", $fmember_id);

            if ($stmt->execute()) {
                // Return success response
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => $stmt->error]);
            }

            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'error' => $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid input.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
}

$conn->close();
