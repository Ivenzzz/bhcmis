<?php
function getResidentMedicalConditions($conn, $resident_id) {
    $sql = "
        SELECT mc.condition_name, rmc.rmc_id, rmc.diagnosed_date, 
               GROUP_CONCAT(DISTINCT m.name SEPARATOR ', ') AS medicines
        FROM residents_medical_condition rmc
        INNER JOIN medical_conditions mc ON rmc.medical_conditions_id = mc.medical_conditions_id
        LEFT JOIN conditions_prescriptions cp ON cp.resident_condition_id = rmc.rmc_id
        LEFT JOIN medicines m ON cp.medicine_id = m.medicine_id
        INNER JOIN residents r ON r.resident_id = rmc.resident_id
        WHERE r.resident_id = ? AND r.isValidResident = 1
        GROUP BY rmc.rmc_id
        ORDER BY rmc.diagnosed_date";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the resident_id parameter
    $stmt->bind_param("i", $resident_id);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch all rows as an associative array
    $medical_conditions = $result->fetch_all(MYSQLI_ASSOC);

    // Return the medical conditions data
    return $medical_conditions;
}
?>
