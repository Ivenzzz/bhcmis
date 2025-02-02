<?php
session_start();
require '../partials/global_db_config.php';
header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'Invalid request'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $appointment_id = $data['appointment_id'] ?? null;

    if ($appointment_id) {
        $stmt = $conn->prepare("UPDATE appointments SET status = 'Cancelled' WHERE appointment_id = ?");
        $stmt->bind_param("i", $appointment_id);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Appointment cancelled successfully.';
        } else {
            $response['message'] = 'Failed to cancel appointment: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        $response['message'] = 'No appointment ID provided.';
    }
}

echo json_encode($response);
exit();
