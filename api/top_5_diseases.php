<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

// Include the database configuration
require '../partials/global_db_config.php'; // Database connection file

try {
    // Query to get the top 5 diseases/medical conditions based on residents diagnosed
    $sql = "
        SELECT 
            mc.condition_name, 
            COUNT(rmc.resident_id) AS resident_count
        FROM 
            residents_medical_condition rmc
        INNER JOIN 
            medical_conditions mc ON rmc.medical_conditions_id = mc.medical_conditions_id
        GROUP BY 
            mc.medical_conditions_id
        ORDER BY 
            resident_count DESC
        LIMIT 5
    ";

    // Execute the query
    $result = $conn->query($sql);

    // Initialize the response array
    $response = [];

    if ($result && $result->num_rows > 0) {
        // Fetch and store results in response array
        while ($row = $result->fetch_assoc()) {
            $response[] = [
                'condition_name' => $row['condition_name'],
                'resident_count' => (int)$row['resident_count']
            ];
        }
    }

    // Return the response as JSON
    echo json_encode([
        'success' => true,
        'data' => $response
    ]);
} catch (Exception $e) {
    // Handle any errors
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

?>
