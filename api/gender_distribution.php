<?php
// Set headers for JSON response and handle CORS
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

// Include the database configuration
require '../partials/global_db_config.php'; // Adjust the path to your DB config

try {
    // Query to count males and females excluding transferred and deceased individuals
    $query = "
        SELECT 
            sex, 
            COUNT(personal_info_id) AS count 
        FROM 
            personal_information 
        WHERE 
            isTransferred = 0 AND deceased_date IS NULL
        GROUP BY 
            sex
    ";

    // Execute the query
    $result = $conn->query($query);

    // Prepare the response
    $genderData = [
        "male" => 0,
        "female" => 0,
    ];

    // Process the query result
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $genderData[strtolower($row['sex'])] = (int)$row['count'];
        }
    }

    // Send success response
    echo json_encode([
        "status" => "success",
        "message" => "Gender distribution retrieved successfully.",
        "data" => $genderData,
    ]);
} catch (Exception $e) {
    // Handle errors
    echo json_encode([
        "status" => "error",
        "message" => "An error occurred while retrieving gender distribution: " . $e->getMessage(),
    ]);
}
?>