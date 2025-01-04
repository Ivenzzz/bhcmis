<?php
session_start();

require '../partials/global_db_config.php';

// Function to generate a 16-character alphanumeric tracking code
function generateTrackingCode($length = 16) {
    return strtoupper(bin2hex(random_bytes($length / 2)));
}

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $resident_ps_id = $_POST['resident_ps_id'];
    $pregnancy_id = $_POST['pregnancy_id'];
    $sched_id = $_POST['sched_id'];
    $weight = $_POST['weight'];
    $blood_pressure = $_POST['blood_pressure'];
    $heart_lungs_condition = $_POST['heart_lungs_condition'];
    $abdominal_exam = $_POST['abdominal_exam'];
    $fetal_heart_rate = $_POST['fetal_heart_rate'];
    $fundal_height = $_POST['fundal_height'];
    $fetal_movement = $_POST['fetal_movement'];
    $checkup_notes = $_POST['checkup_notes'];
    $refer_to = $_POST['refer_to'];

    // Generate tracking code
    $tracking_code = generateTrackingCode();

    // Begin a transaction
    $conn->begin_transaction();

    try {
        // Insert a new prenatal record
        $query_insert_prenatal = "
            INSERT INTO prenatals (
                tracking_code, pregnancy_id, sched_id, weight, blood_pressure, 
                heart_lungs_condition, abdominal_exam, fetal_heart_rate, 
                fundal_height, fetal_movement, checkup_notes, refer_to
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";

        $stmt_insert_prenatal = $conn->prepare($query_insert_prenatal);
        $stmt_insert_prenatal->bind_param(
            "siidssssssss",
            $tracking_code, $pregnancy_id, $sched_id, $weight, $blood_pressure,
            $heart_lungs_condition, $abdominal_exam, $fetal_heart_rate,
            $fundal_height, $fetal_movement, $checkup_notes, $refer_to
        );

        if (!$stmt_insert_prenatal->execute()) {
            throw new Exception("Failed to insert prenatal record: " . $stmt_insert_prenatal->error);
        }

        // Update resident_prenatal_schedules to 'completed'
        $query_update_schedule = "
            UPDATE resident_prenatal_schedules
            SET status = 'completed'
            WHERE resident_ps_id = ?
        ";

        $stmt_update_schedule = $conn->prepare($query_update_schedule);
        $stmt_update_schedule->bind_param("i", $resident_ps_id);

        if (!$stmt_update_schedule->execute()) {
            throw new Exception("Failed to update schedule status: " . $stmt_update_schedule->error);
        }

        // Commit the transaction
        $conn->commit();

        header("Location: ../midwife/scheduled_prenatals.php?sched_id=$sched_id");
        exit;
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $conn->rollback();

        header("Location: ../midwife/scheduled_prenatals.php?sched_id=$sched_id");
        exit;
    }
} else {
    header("Location: ../midwife/scheduled_prenatals.php?sched_id=$sched_id");
    exit;
}
?>
