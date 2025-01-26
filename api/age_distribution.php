<?php
// Set headers to handle CORS and return JSON response
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

// Include the database configuration
require '../partials/global_db_config.php'; // Adjust the path to your database connection file

try {
    // Query to calculate age distribution
    $query = "
        SELECT 
            SUM(CASE 
                WHEN TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) BETWEEN 0 AND 12 THEN 1 
                ELSE 0 
            END) AS child,
            SUM(CASE 
                WHEN TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) BETWEEN 13 AND 17 THEN 1 
                ELSE 0 
            END) AS minor,
            SUM(CASE 
                WHEN TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) BETWEEN 18 AND 59 THEN 1 
                ELSE 0 
            END) AS adult,
            SUM(CASE 
                WHEN TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) >= 60 THEN 1 
                ELSE 0 
            END) AS senior
        FROM 
            residents r
        INNER JOIN 
            personal_information p ON r.personal_info_id = p.personal_info_id
        WHERE 
            p.isTransferred = 0 
            AND p.deceased_date IS NULL;
    ";

    // Execute the query
    $result = $conn->query($query);

    // Check if data exists
    if ($result && $row = $result->fetch_assoc()) {
        // Send success response
        echo json_encode([
            "status" => "success",
            "message" => "Age distribution retrieved successfully.",
            "data" => [
                "child" => (int)$row['child'],
                "minor" => (int)$row['minor'],
                "adult" => (int)$row['adult'],
                "senior" => (int)$row['senior']
            ]
        ]);
    } else {
        // Send response if no data
        echo json_encode([
            "status" => "success",
            "message" => "No population data found.",
            "data" => [
                "child" => 0,
                "minor" => 0,
                "adult" => 0,
                "senior" => 0
            ]
        ]);
    }
} catch (Exception $e) {
    // Handle errors
    echo json_encode([
        "status" => "error",
        "message" => "An error occurred while retrieving age distribution: " . $e->getMessage()
    ]);
}
?>