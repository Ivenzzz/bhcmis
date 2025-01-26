<?php
// Set headers to handle CORS and return JSON response
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

// Include the database configuration
require '../partials/global_db_config.php'; // Adjust the path to your database connection file

try {
    // Query to get the total residents grouped by address_name, based on households
    $query = "
        SELECT 
            a.address_name, 
            COUNT(DISTINCT r.resident_id) AS total_residents -- Total residents per address
        FROM 
            address a
        LEFT JOIN 
            household h ON a.address_id = h.address_id
        LEFT JOIN 
            household_members hm ON h.household_id = hm.household_id
        LEFT JOIN 
            families f ON hm.family_id = f.family_id
        LEFT JOIN 
            family_members fm ON f.family_id = fm.family_id
        LEFT JOIN
            residents r ON fm.resident_id = r.resident_id
        LEFT JOIN 
            personal_information p ON r.personal_info_id = p.personal_info_id
        WHERE 
            p.isTransferred = 0 
            AND p.deceased_date IS NULL
        GROUP BY 
            a.address_id
        ORDER BY 
            a.address_name;
    ";

    // Execute the query
    $result = $conn->query($query);

    // Check if data exists
    if ($result->num_rows > 0) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = [
                'address_name' => $row['address_name'],
                'total_residents' => $row['total_residents']
            ];
        }

        // Send success response
        echo json_encode([
            "status" => "success",
            "message" => "Total residents per area retrieved successfully.",
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