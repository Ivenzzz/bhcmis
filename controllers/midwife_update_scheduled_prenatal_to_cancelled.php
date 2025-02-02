<?php
session_start();

require '../partials/global_db_config.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resident_ps_id = $_POST['resident_ps_id'];
    $sched_id = $_POST['sched_id'];

    try {
        // Update the status to "Cancelled"
        $query = "
            UPDATE resident_prenatal_schedules
            SET status = 'cancelled'
            WHERE resident_ps_id = ?
        ";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $resident_ps_id);
        
        if ($stmt->execute()) {
            header("Location: ../midwife/scheduled_prenatals.php?sched_id=$sched_id");
            exit;
        } else {
            throw new Exception("Failed to update schedule status.");
        }
    } catch (Exception $e) {
        header("Location: ../midwife/scheduled_prenatals.php?sched_id=$sched_id");
        exit;
    }
} else {
    header("Location: ../midwife/scheduled_prenatals.php");
    exit;
}
?>
