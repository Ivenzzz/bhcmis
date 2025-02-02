<?php

require '../partials/global_db_config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form inputs
    $resident_id = $conn->real_escape_string($_POST['resident_id']);
    $sched_id = $conn->real_escape_string($_POST['sched_id']);
    $reason_for_visit = $conn->real_escape_string($_POST['reason_for_visit']);
    $symptoms = isset($_POST['symptoms']) ? $conn->real_escape_string($_POST['symptoms']) : null;
    $weight_kg = isset($_POST['weight_kg']) ? $conn->real_escape_string($_POST['weight_kg']) : null;
    $temperature = isset($_POST['temperature']) ? $conn->real_escape_string($_POST['temperature']) : null;
    $heart_rate = isset($_POST['heart_rate']) ? $conn->real_escape_string($_POST['heart_rate']) : null;
    $respiratory_rate = isset($_POST['respiratory_rate']) ? $conn->real_escape_string($_POST['respiratory_rate']) : null;
    $blood_pressure = isset($_POST['blood_pressure']) ? $conn->real_escape_string($_POST['blood_pressure']) : null;
    $cholesterol_level = isset($_POST['cholesterol_level']) ? $conn->real_escape_string($_POST['cholesterol_level']) : null;
    $physical_findings = isset($_POST['physical_findings']) ? $conn->real_escape_string($_POST['physical_findings']) : null;
    $refer_to = isset($_POST['refer_to']) ? $conn->real_escape_string($_POST['refer_to']) : null;

    // Insert query
    $sql = "INSERT INTO consultations (
                resident_id, 
                sched_id, 
                reason_for_visit, 
                symptoms, 
                weight_kg, 
                temperature, 
                heart_rate, 
                respiratory_rate, 
                blood_pressure, 
                cholesterol_level, 
                physical_findings, 
                refer_to, 
                created_at, 
                updated_at
            ) VALUES (
                '$resident_id', 
                '$sched_id', 
                '$reason_for_visit', 
                " . ($symptoms ? "'$symptoms'" : "NULL") . ", 
                " . ($weight_kg ? "'$weight_kg'" : "NULL") . ", 
                " . ($temperature ? "'$temperature'" : "NULL") . ", 
                " . ($heart_rate ? "'$heart_rate'" : "NULL") . ", 
                " . ($respiratory_rate ? "'$respiratory_rate'" : "NULL") . ", 
                " . ($blood_pressure ? "'$blood_pressure'" : "NULL") . ", 
                " . ($cholesterol_level ? "'$cholesterol_level'" : "NULL") . ", 
                " . ($physical_findings ? "'$physical_findings'" : "NULL") . ", 
                " . ($refer_to ? "'$refer_to'" : "NULL") . ", 
                NOW(), 
                NOW()
            )";

    // Execute query
    if ($conn->query($sql) === TRUE) {
        // Redirect back to consultation details page with status
        $status = urlencode('Consultation details recorded successfully');
        header("Location: ../midwife/consultation_details.php?con_sched_id=" . urlencode($sched_id) . "&status=$status");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
