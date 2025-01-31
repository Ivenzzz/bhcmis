<?php
// Set headers for JSON response and handle CORS
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

// Include the database configuration
require '../partials/global_db_config.php'; // Adjust the path to your DB config

try {
    // Query to count gender distribution based on household structure
    $query = "
        SELECT 
            p.sex, 
            COUNT(DISTINCT r.resident_id) AS count 
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
            AND r.isArchived = 0
        GROUP BY 
            p.sex
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
