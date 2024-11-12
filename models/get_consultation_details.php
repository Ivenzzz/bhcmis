<?php

function getConsultationDetails($conn, $appointment_id) {
    // Prepare the SQL statement with joins to fetch consultation, prescription, and medicine details
    $stmt = $conn->prepare("
        SELECT 
            c.consultation_id,
            c.resident_id,
            c.appointment_id,
            c.reason_for_visit,
            c.sched_id,
            c.symptoms,
            c.weight_kg,
            c.temperature,
            c.heart_rate,
            c.respiratory_rate,
            c.blood_pressure,
            c.cholesterol_level,
            c.physical_findings,
            c.refer_to,
            c.created_at,
            c.updated_at,
            cp.medicine_id,
            cp.quantity,
            cp.instructions,
            m.name AS medicine_name,
            m.dosage AS medicine_dosage
        FROM consultations c
        LEFT JOIN consultations_prescriptions cp ON c.consultation_id = cp.consultation_id
        LEFT JOIN medicines m ON cp.medicine_id = m.medicine_id
        WHERE c.appointment_id = ?
    ");
    
    // Bind the parameter
    $stmt->bind_param("i", $appointment_id);

    // Execute the statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();

    // Initialize an array to hold the consultation details
    $consultation_details = [];
    
    // Fetch the consultation details as an associative array
    while ($row = $result->fetch_assoc()) {
        // Store consultation details
        if (empty($consultation_details)) {
            $consultation_details = [
                'consultation_id' => $row['consultation_id'],
                'resident_id' => $row['resident_id'],
                'appointment_id' => $row['appointment_id'],
                'reason_for_visit' => $row['reason_for_visit'],
                'sched_id' => $row['sched_id'],
                'symptoms' => $row['symptoms'],
                'weight_kg' => $row['weight_kg'],
                'temperature' => $row['temperature'],
                'heart_rate' => $row['heart_rate'],
                'respiratory_rate' => $row['respiratory_rate'],
                'blood_pressure' => $row['blood_pressure'],
                'cholesterol_level' => $row['cholesterol_level'],
                'physical_findings' => $row['physical_findings'],
                'refer_to' => $row['refer_to'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at'],
                'prescriptions' => []
            ];
        }

        // Append prescription details if they exist
        if (!is_null($row['medicine_id'])) {
            $consultation_details['prescriptions'][] = [
                'medicine_id' => $row['medicine_id'],
                'medicine_name' => $row['medicine_name'],
                'medicine_dosage' => $row['medicine_dosage'],
                'quantity' => $row['quantity'],
                'instructions' => $row['instructions']
            ];
        }
    }

    return $consultation_details;
}
