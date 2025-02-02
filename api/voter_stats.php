<?php
// Set headers for JSON response and handle CORS
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

// Include the database configuration
require '../partials/global_db_config.php'; // Ensure this file correctly initializes `$conn`

try {
    // Verify connection is established
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Query to retrieve voter statistics based on households, families, and residents
    $sql = "
        SELECT 
            COUNT(DISTINCT r.resident_id) AS total_residents,
            SUM(CASE WHEN p.isRegisteredVoter = 1 THEN 1 ELSE 0 END) AS registered_voters,
            (SUM(CASE WHEN p.isRegisteredVoter = 1 THEN 1 ELSE 0 END) / COUNT(DISTINCT r.resident_id)) * 100 AS voter_percentage
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
    ";

    // Execute the query
    $result = $conn->query($sql);

    if (!$result) {
        throw new Exception("Query failed: " . $conn->error);
    }

    $data = $result->fetch_assoc();

    // Format the response
    $response = [
        'success' => true,
        'data' => [
            'voter_percentage' => round($data['voter_percentage'], 2),
            'registered_voters' => (int)$data['registered_voters'],
            'total_residents' => (int)$data['total_residents']
        ]
    ];

    echo json_encode($response);

} catch (Exception $e) {
    // Handle errors
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>
