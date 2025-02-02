<?php

require '../partials/global_db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $appointment_id = filter_input(INPUT_POST, 'appointment_id', FILTER_SANITIZE_NUMBER_INT);
    $con_sched_id = filter_input(INPUT_POST, 'con_sched_id', FILTER_SANITIZE_NUMBER_INT);

    // Ensure required data is provided
    if ($appointment_id && $con_sched_id) {
        try {
            // Prepare the SQL statement to delete the appointment
            $stmt = $conn->prepare("DELETE FROM appointments WHERE appointment_id = ?");
            $stmt->bind_param('i', $appointment_id);

            // Execute the query
            if ($stmt->execute()) {
                $message = 'Appointment deleted successfully.';
                $message_type = 'success';
            } else {
                $message = 'Failed to delete appointment. Please try again.';
                $message_type = 'error';
            }

            // Close the statement
            $stmt->close();
        } catch (Exception $e) {
            $message = 'An error occurred: ' . $e->getMessage();
            $message_type = 'error';
        }
    } else {
        $message = 'Invalid input. Please try again.';
        $message_type = 'error';
    }
} else {
    $message = 'Invalid request method.';
    $message_type = 'error';
}

header('Location: ../midwife/appointments.php?con_sched_id=' . $con_sched_id . '&message=' . urlencode($message) . '&message_type=' . $message_type);
exit();
?>
