<?php
// Set headers to handle CORS and return JSON response
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

// Include the database configuration
require '../partials/global_db_config.php'; // Include your database connection file

// Function to fetch the total population per year
function getTotalPopulationPerYear($conn) {
    // SQL query to get the total population per year
    $sql = "SELECT year, total_population 
            FROM annual_population 
            ORDER BY year ASC";  // You can order by year if needed, or change to ASC for ascending order

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful and rows exist
    if ($result && $result->num_rows > 0) {
        $populationData = [];

        // Fetch the data and store it in an array
        while ($row = $result->fetch_assoc()) {
            $populationData[] = [
                "year" => $row['year'],
                "total_population" => $row['total_population']
            ];
        }

        // Return the data as a JSON response
        return [
            "status" => "success",
            "message" => "Population data retrieved successfully.",
            "data" => $populationData
        ];
    } else {
        // Return an error message if no data is found
        return [
            "status" => "error",
            "message" => "No population data found for the specified years."
        ];
    }
}

// Get the population data
$response = getTotalPopulationPerYear($conn);

// Send the response as JSON
echo json_encode($response);
?>
