<?php
session_start();

require '../partials/global_db_config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $appointment_id = filter_input(INPUT_POST, 'appointment_id', FILTER_SANITIZE_NUMBER_INT);
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
    $con_sched_id = filter_input(INPUT_POST, 'con_sched_id', FILTER_SANITIZE_NUMBER_INT);

    // Default result to "error" in case of failure
    $result = 'error';

    // Ensure required data is provided
    if ($appointment_id && $status && $con_sched_id) {
        try {
            // Prepare the SQL statement
            $stmt = $conn->prepare("UPDATE appointments SET status = ? WHERE appointment_id = ?");
            $stmt->bind_param('si', $status, $appointment_id);

            // Execute the query
            if ($stmt->execute()) {
                $result = 'success';
            }

            // Close the statement
            $stmt->close();
        } catch (Exception $e) {
            $result = 'error';
        }
    }

    // Redirect to the appointments page with result and con_sched_id
    header('Location: ../midwife/appointments.php?con_sched_id=' . $con_sched_id . '&result=' . $result);
    exit();
} else {
    // Redirect with an error if the request method is invalid
    header('Location: ../midwife/appointments.php?result=error');
    exit();
}
