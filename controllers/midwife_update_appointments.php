<?php
session_start();
require '../../../config/db_config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get appointment ID and new status from POST data
    $appointmentId = isset($_POST['appointmentId']) ? intval($_POST['appointmentId']) : null;
    $scheduleId = isset($_POST['schedId']) ? intval($_POST['schedId']) : null; // Get schedule ID
    $status = isset($_POST['status']) ? $_POST['status'] : null;

    // Validate inputs
    if ($appointmentId && in_array($status, ['Scheduled', 'Cancelled', 'Completed'])) {
        // Prepare SQL update statement
        $stmt = $conn->prepare("UPDATE appointments SET status = ?, updated_at = NOW() WHERE appointment_id = ?");
        $stmt->bind_param("si", $status, $appointmentId);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: /bhcmis/midwife-appointments?sched_id=$scheduleId"); 
            exit();
        } else {
            header("Location: /bhcmis/midwife-appointments?sched_id=$scheduleId"); 
            exit();
        }
    } else {
        header("Location: /bhcmis/midwife-appointments?sched_id=$scheduleId"); 
        exit();
    }
} else {
    header("Location: /bhcmis/midwife-appointments"); 
    exit();
}
?>
