<?php 

function getTotalResidents($conn) {
    $sql = "SELECT COUNT(*) AS total_residents 
            FROM personal_information 
            WHERE isTransferred = 0 AND deceased_date IS NULL";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_residents'];
    } else {
        return 0;
    }
}

function getTotalHouseholds($conn) {
    $sql = "SELECT COUNT(*) AS total_households FROM household";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_households'];
    } else {
        return 0;
    }
}

function getTotalFamilies($conn) {
    $sql = "SELECT COUNT(*) AS total_families FROM families";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_families'];
    } else {
        return 0;
    }
}

function getTotalTransferredResidents($conn) {
    // SQL query to count residents who are transferred
    $sql = "SELECT COUNT(*) AS total_transferred
            FROM personal_information
            WHERE isTransferred = 1";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result && $row = $result->fetch_assoc()) {
        // Return the count of transferred residents
        return $row['total_transferred'];
    } else {
        // Return 0 if query failed or no data found
        return 0;
    }
}

function getTotalDeceasedResidents($conn) {
    // SQL query to count residents with a deceased_date
    $sql = "SELECT COUNT(*) AS total_deceased
            FROM personal_information
            WHERE deceased_date IS NOT NULL";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result && $row = $result->fetch_assoc()) {
        // Return the count of deceased residents
        return $row['total_deceased'];
    } else {
        // Return 0 if query failed or no data found
        return 0;
    }
}

function getPopulationPerArea($conn) {
    // SQL query to get population count per area, including areas with no population
    $sql = "
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
    $result = $conn->query($sql);

    // Check if the query was successful and return data
    if ($result) {
        $populationPerArea = [];
        while ($row = $result->fetch_assoc()) {
            $populationPerArea[] = [
                'address_name' => $row['address_name'],
                'population_count' => $row['population_count']
            ];
        }

        // Return the population data or an empty array if no results
        return $populationPerArea;
    } else {
        // Return an empty array if the query failed
        return [];
    }
}

function getGenderDistribution($conn) {
    // SQL query to count males and females excluding transferred and deceased individuals
    $sql = "
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
    $result = $conn->query($sql);

    // Prepare the gender data array with default values
    $genderData = [
        'male' => 0,
        'female' => 0,
    ];

    // Process the query result
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            // Convert the sex to lowercase and store the count in the genderData array
            $genderData[strtolower($row['sex'])] = (int)$row['count'];
        }
    }

    // Return the gender data or an empty array if no results
    return $genderData;
}

function getPopulationGrowthRate($conn) {
    // Get the current year
    $currentYear = date("Y");
    $previousYear = $currentYear - 1;

    // Query to get the current population
    $sql_current_population = "
        SELECT COUNT(*) AS current_population 
        FROM personal_information 
        WHERE isTransferred = 0 AND deceased_date IS NULL";

    $result_current = $conn->query($sql_current_population);

    // Check if the query was successful and retrieve the current population
    if ($result_current && $row_current = $result_current->fetch_assoc()) {
        $current_population = $row_current['current_population'];
    } else {
        return [
            "status" => "error", 
            "message" => "Failed to fetch current population."
        ];
    }

    // Query to get the previous year's population from annual_population table
    $sql_previous_population = "
        SELECT total_population AS previous_population 
        FROM annual_population 
        WHERE year = ?";
    
    $stmt = $conn->prepare($sql_previous_population);
    if ($stmt === false) {
        return [
            "status" => "error", 
            "message" => "Failed to prepare statement for previous population."
        ];
    }

    $stmt->bind_param("i", $previousYear);
    $stmt->execute();
    $result_previous = $stmt->get_result();
    
    // Check if the query was successful and retrieve the previous population
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




?>