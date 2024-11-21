<?php
// Set headers to handle CORS and return JSON response
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

// Include the database configuration
require '../partials/global_db_config.php'; // Adjust the path to your database connection file

try {
    // Query to get the population count grouped by address_name, including areas with no population
    $query = "
        SELECT 
            a.address_name,
            COUNT(p.personal_info_id) AS population_count
        FROM 
            address a
        LEFT JOIN 
            personal_information p ON a.address_id = p.address_id
            AND p.isTransferred = 0 
            AND p.deceased_date IS NULL
        GROUP BY 
            a.address_name
        ORDER BY 
            population_count DESC
    ";

    // Execute the query
    $result = $conn->query($query);

    // Check if data exists
    if ($result->num_rows > 0) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = [
                'address_name' => $row['address_name'],
                'population_count' => $row['population_count']
            ];
        }

        // Send success response
        echo json_encode([
            "status" => "success",
            "message" => "Population per area retrieved successfully.",
            "data" => $data
        ]);
    } else {
        // Send response if no data
        echo json_encode([
            "status" => "success",
            "message" => "No population data found.",
            "data" => []
        ]);
    }
} catch (Exception $e) {
    // Handle errors
    echo json_encode([
        "status" => "error",
        "message" => "An error occurred while retrieving population data: " . $e->getMessage()
    ]);
}
?>
