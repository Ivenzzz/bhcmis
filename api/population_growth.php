<?php
// Set headers to handle CORS and return JSON response
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

// Include the database configuration
require '../partials/global_db_config.php'; // Database connection file

// Function to calculate population growth
function getPopulationGrowth($conn) {
    // Get the current year
    $currentYear = date("Y");
    $previousYear = $currentYear - 1;

    // Query to get the current population
    $sql_current_population = "
        SELECT COUNT(*) AS current_population 
        FROM personal_information 
        WHERE isTransferred = 0 AND deceased_date IS NULL";

    $result_current = $conn->query($sql_current_population);

    if ($result_current && $row_current = $result_current->fetch_assoc()) {
        $current_population = $row_current['current_population'];
    } else {
        return ["status" => "error", "message" => "Failed to fetch current population."];
    }

    // Query to get the previous year's population from annual_population table
    $sql_previous_population = "
        SELECT total_population AS previous_population 
        FROM annual_population 
        WHERE year = ?";
    
    $stmt = $conn->prepare($sql_previous_population);
    if ($stmt === false) {
        return ["status" => "error", "message" => "Failed to prepare statement for previous population."];
    }

    $stmt->bind_param("i", $previousYear);
    $stmt->execute();
    $result_previous = $stmt->get_result();
    
    if ($result_previous && $row_previous = $result_previous->fetch_assoc()) {
        $previous_population = $row_previous['previous_population'];
    } else {
        $previous_population = 0; // Default to 0 if no record for the previous year
    }

    // Calculate the population growth rate
    if ($previous_population > 0) {
        $growth_rate = (($current_population - $previous_population) / $previous_population) * 100;
    } else {
        $growth_rate = 0; // No data for the previous year, so no growth rate
    }

    // Return the results
    return [
        "status" => "success",
        "current_year" => $currentYear,
        "previous_year" => $previousYear,
        "current_population" => $current_population,
        "previous_population" => $previous_population,
        "growth_rate" => $growth_rate,
        "message" => "Population growth retrieved successfully."
    ];
}

// Get the population growth data
$response = getPopulationGrowth($conn);

// Send the response as JSON
echo json_encode($response);
?>
