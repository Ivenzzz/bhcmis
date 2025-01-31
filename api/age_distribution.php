<?php
// Set headers to handle CORS and return JSON response
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

// Include the database configuration
require '../partials/global_db_config.php'; // Adjust the path to your database connection file

try {
    // Query to calculate age distribution based on household, household_members, families, and family_members
    $query = "
    SELECT 
        COUNT(DISTINCT CASE 
            WHEN TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) BETWEEN 0 AND 12 THEN r.resident_id 
            ELSE NULL 
        END) AS child,
        COUNT(DISTINCT CASE 
            WHEN TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) BETWEEN 13 AND 17 THEN r.resident_id 
            ELSE NULL 
        END) AS minor,
        COUNT(DISTINCT CASE 
            WHEN TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) BETWEEN 18 AND 59 THEN r.resident_id 
            ELSE NULL 
        END) AS adult,
        COUNT(DISTINCT CASE 
            WHEN TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) >= 60 THEN r.resident_id 
            ELSE NULL 
        END) AS senior
    FROM 
        residents r
    INNER JOIN 
        personal_information p ON r.personal_info_id = p.personal_info_id
    INNER JOIN 
        family_members fm ON r.resident_id = fm.resident_id AND fm.isArchived = 0
    INNER JOIN 
        families f ON fm.family_id = f.family_id AND f.isArchived = 0
    INNER JOIN 
        household_members hm ON f.family_id = hm.family_id AND hm.isArchived = 0
    INNER JOIN 
        household h ON hm.household_id = h.household_id AND h.isArchived = 0
    WHERE 
        p.isTransferred = 0 
        AND p.deceased_date IS NULL
        AND r.isArchived = 0;
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