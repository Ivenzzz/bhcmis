<?php
// Set headers to handle CORS and return JSON response
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

// Include the database configuration
require '../partials/global_db_config.php'; // Adjust the path to your database connection file

try {
    // Get the current date
    $currentDate = date("Y-m-d");

    // Query to calculate age distribution
    $query = "
        SELECT 
            SUM(CASE 
                WHEN TIMESTAMPDIFF(YEAR, date_of_birth, ?) BETWEEN 0 AND 12 THEN 1 
                ELSE 0 
            END) AS child,
            SUM(CASE 
                WHEN TIMESTAMPDIFF(YEAR, date_of_birth, ?) BETWEEN 13 AND 17 THEN 1 
                ELSE 0 
            END) AS minor,
            SUM(CASE 
                WHEN TIMESTAMPDIFF(YEAR, date_of_birth, ?) BETWEEN 18 AND 59 THEN 1 
                ELSE 0 
            END) AS adult,
            SUM(CASE 
                WHEN TIMESTAMPDIFF(YEAR, date_of_birth, ?) >= 60 THEN 1 
                ELSE 0 
            END) AS senior
        FROM personal_information
        WHERE isTransferred = 0 AND deceased_date IS NULL
    ";

    // Prepare and execute the query
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $currentDate, $currentDate, $currentDate, $currentDate);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if data exists
    if ($result && $row = $result->fetch_assoc()) {
        // Send success response
        echo json_encode([
            "status" => "success",
            "message" => "Age distribution retrieved successfully.",
            "data" => [
                "child" => $row['child'],
                "minor" => $row['minor'],
                "adult" => $row['adult'],
                "senior" => $row['senior']
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
