<?php

require '../partials/global_db_config.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate inputs
    $sched_id = isset($_POST['sched_id']) ? htmlspecialchars($_POST['sched_id']) : '';
    $weight = isset($_POST['weight']) && !empty($_POST['weight']) ? htmlspecialchars($_POST['weight']) : NULL;
    $blood_pressure = isset($_POST['blood_pressure']) && !empty($_POST['blood_pressure']) ? htmlspecialchars($_POST['blood_pressure']) : NULL;
    $heart_lungs_condition = isset($_POST['heart_lungs_condition']) && !empty($_POST['heart_lungs_condition']) ? htmlspecialchars($_POST['heart_lungs_condition']) : NULL;
    $abdominal_exam = isset($_POST['abdominal_exam']) && !empty($_POST['abdominal_exam']) ? htmlspecialchars($_POST['abdominal_exam']) : NULL;
    $fetal_heart_rate = isset($_POST['fetal_heart_rate']) && !empty($_POST['fetal_heart_rate']) ? htmlspecialchars($_POST['fetal_heart_rate']) : NULL;
    $fundal_height = isset($_POST['fundal_height']) && !empty($_POST['fundal_height']) ? htmlspecialchars($_POST['fundal_height']) : NULL;
    $fetal_movement = isset($_POST['fetal_movement']) && !empty($_POST['fetal_movement']) ? htmlspecialchars($_POST['fetal_movement']) : NULL;
    $checkup_notes = isset($_POST['checkup_notes']) && !empty($_POST['checkup_notes']) ? htmlspecialchars($_POST['checkup_notes']) : NULL;
    $refer_to = isset($_POST['refer_to']) && !empty($_POST['refer_to']) ? htmlspecialchars($_POST['refer_to']) : NULL;

    // Check if sched_id is provided
    if (empty($sched_id)) {
        echo "Schedule ID is required.";
        exit;
    }

    // Prepare the SQL update query
    $query = "UPDATE prenatals SET
                weight = ?, blood_pressure = ?, heart_lungs_condition = ?, abdominal_exam = ?, fetal_heart_rate = ?, fundal_height = ?, fetal_movement = ?, checkup_notes = ?, refer_to = ?
              WHERE sched_id = ?";

    // Prepare statement
    if ($stmt = $conn->prepare($query)) {
        // Bind parameters
        $stmt->bind_param("ssssssssss", $weight, $blood_pressure, $heart_lungs_condition, $abdominal_exam, $fetal_heart_rate, $fundal_height, $fetal_movement, $checkup_notes, $refer_to, $sched_id);

        // Execute statement
        if ($stmt->execute()) {
            // Redirect back to the prenatal list page with the sched_id parameter
            header("Location: ../midwife/prenatals_list.php?sched_id=" . urlencode($sched_id));
            exit;
        } else {
            echo "Error updating record: " . $conn->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error preparing the query: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // If form is not submitted via POST
    echo "Invalid request.";
    exit;
}
?>
