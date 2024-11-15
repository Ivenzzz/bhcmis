<?php

// Set headers to handle CORS and return JSON response
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

// Include the database configuration
require '../partials/global_db_config.php';  // Database connection file

// Function to calculate the population growth rate
function calculatePopulationGrowthRate($conn) {
    // Get the current year based on the system's current date
    $currentYear = date("Y");

    // Initialize population variables
    $current_population = 0;
    $previous_population = 0;

    // Get the current population (alive, not transferred, and not archived)
    $sql_current_population = "
        SELECT COUNT(*) AS current_population
        FROM personal_information
        WHERE isAlive = 1
        AND isTransferred = 0
        AND isArchived = 0
        AND YEAR(NOW()) = ?";  // Use system's current year
    $stmt = $conn->prepare($sql_current_population);
    if ($stmt === false) {
        return ["status" => "error", "message" => "Failed to prepare statement for current population."];
    }
    $stmt->bind_param("i", $currentYear);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result) {
        $current_population_data = $result->fetch_assoc();
        $current_population = $current_population_data['current_population'];
    } else {
        return ["status" => "error", "message" => "Failed to fetch current population."];
    }

    // Get the population from the previous year (alive, not transferred, and not archived)
    $previousYear = $currentYear - 1;
    $sql_previous_population = "
        SELECT COUNT(*) AS previous_population
        FROM personal_information
        WHERE isAlive = 1
        AND isTransferred = 0
        AND isArchived = 0
        AND YEAR(NOW()) = ?";
    $stmt = $conn->prepare($sql_previous_population);
    if ($stmt === false) {
        return ["status" => "error", "message" => "Failed to prepare statement for previous population."];
    }
    $stmt->bind_param("i", $previousYear);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result) {
        $previous_population_data = $result->fetch_assoc();
        $previous_population = $previous_population_data['previous_population'];
    } else {
        return ["status" => "error", "message" => "Failed to fetch previous population."];
    }

    // Calculate the growth rate
    if ($previous_population > 0) {
        $growth_rate = (($current_population - $previous_population) / $previous_population) * 100;
    } else {
        $growth_rate = 0;  // No population last year, no growth
    }

    return [
        'status' => 'success',
        'growth_rate' => $growth_rate,
        'current_population' => $current_population,
        'previous_population' => $previous_population,
        'message' => 'Population growth rate calculated successfully.'
    ];
}

// Call the function to get the population growth rate
$response = calculatePopulationGrowthRate($conn);

// Send the response as JSON
echo json_encode($response);

?>
