<?php
session_start();
require '../partials/global_db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate input data
    $pregnancy_id = isset($_POST['pregnancy_id']) ? intval($_POST['pregnancy_id']) : null;
    $sched_id = isset($_POST['sched_id']) ? intval($_POST['sched_id']) : null;
    $weight = isset($_POST['weight']) && $_POST['weight'] !== '' ? floatval($_POST['weight']) : null;
    $blood_pressure = isset($_POST['blood_pressure']) && trim($_POST['blood_pressure']) !== '' ? trim($_POST['blood_pressure']) : null;
    $heart_lungs_condition = isset($_POST['heart_lungs_condition']) && trim($_POST['heart_lungs_condition']) !== '' ? trim($_POST['heart_lungs_condition']) : null;
    $abdominal_exam = isset($_POST['abdominal_exam']) && trim($_POST['abdominal_exam']) !== '' ? trim($_POST['abdominal_exam']) : null;
    $fetal_heart_rate = isset($_POST['fetal_heart_rate']) && trim($_POST['fetal_heart_rate']) !== '' ? trim($_POST['fetal_heart_rate']) : null;
    $fundal_height = isset($_POST['fundal_height']) && trim($_POST['fundal_height']) !== '' ? trim($_POST['fundal_height']) : null;
    $fetal_movement = isset($_POST['fetal_movement']) && trim($_POST['fetal_movement']) !== '' ? trim($_POST['fetal_movement']) : null;
    $checkup_notes = isset($_POST['checkup_notes']) && trim($_POST['checkup_notes']) !== '' ? trim($_POST['checkup_notes']) : null;
    $refer_to = isset($_POST['refer_to']) && trim($_POST['refer_to']) !== '' ? trim($_POST['refer_to']) : null;

    // Generate a 16-character alphanumeric tracking code
    function generateTrackingCode($length = 16) {
        return strtoupper(substr(bin2hex(random_bytes($length / 2)), 0, $length));
    }

    $tracking_code = generateTrackingCode();

    // Insert into database
    $sql = "INSERT INTO prenatals (
                tracking_code, pregnancy_id, sched_id, weight, blood_pressure, 
                heart_lungs_condition, abdominal_exam, fetal_heart_rate, 
                fundal_height, fetal_movement, checkup_notes, refer_to
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
            )";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param(
            'siidssssssss',
            $tracking_code,
            $pregnancy_id,
            $sched_id,
            $weight,
            $blood_pressure,
            $heart_lungs_condition,
            $abdominal_exam,
            $fetal_heart_rate,
            $fundal_height,
            $fetal_movement,
            $checkup_notes,
            $refer_to
        );

        if ($stmt->execute()) {
            header('Location: ../midwife/prenatals_list.php?sched_id=' . $sched_id);
        } else {
            header('Location: ../midwife/prenatals_list.php?sched_id=' . $sched_id);
        }

        $stmt->close();
    } else {
        header('Location: ../midwife/prenatals_list.php?sched_id=' . $sched_id);
    }

    $conn->close();
} else {
    header('Location: ../midwife/prenatals_list.php?sched_id=' . (isset($_POST['sched_id']) ? intval($_POST['sched_id']) : ''));
}
?>
