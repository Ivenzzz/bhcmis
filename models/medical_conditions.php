<?php

require_once '../partials/global_db_config.php';

function getMedicalConditions($conn) {
    // Initialize an empty array to store the medical conditions
    $medicalConditions = [];

    // Query to retrieve all medical conditions
    $query = "SELECT medical_conditions_id, condition_name FROM medical_conditions ORDER BY condition_name ASC";
    
    // Execute the query
    $result = $conn->query($query);

    // Check if the query returned any rows
    if ($result->num_rows > 0) {
        // Fetch the results as an associative array
        while ($row = $result->fetch_assoc()) {
            $medicalConditions[] = $row;
        }
    }

    // Return the array of medical conditions
    return $medicalConditions;
}

// Example usage of the function
$conditions = getMedicalConditions($conn);

?>
