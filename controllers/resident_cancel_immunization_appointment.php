<?php
require '../partials/global_db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $data = json_decode(file_get_contents("php://input"), true);

    // Check if the appointment_id is passed in the request
    $appointment_id = $data['appointment_id'] ?? null;

    if (!$appointment_id) {
        echo json_encode([
            'success' => false,
            'message' => 'Appointment ID is required.',
        ]);
        exit;
    }

    // Check if the appointment exists and is not already cancelled
    $stmt = $conn->prepare("SELECT status FROM immunization_appointments WHERE appointment_id = ?");
    $stmt->bind_param("i", $appointment_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Appointment not found.',
        ]);
        exit;
    }

    $appointment = $result->fetch_assoc();

    // If appointment is already cancelled, no need to do anything
    if ($appointment['status'] === 'Cancelled') {
        echo json_encode([
            'success' => false,
            'message' => 'Appointment is already cancelled.',
        ]);
        exit;
    }

    // Update the status to 'Cancelled'
    $stmt = $conn->prepare("UPDATE immunization_appointments SET status = 'Cancelled' WHERE appointment_id = ?");
    $stmt->bind_param("i", $appointment_id);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Appointment cancelled successfully.',
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to cancel the appointment. Please try again.',
        ]);
    }

    $stmt->close();
    $conn->close();
}
?>
