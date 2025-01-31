<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Adjust for security

require '../partials/global_db_config.php';

// Query to get residents' full names in "Lastname, Firstname M." format
$query = "
    SELECT 
        r.resident_id,
        r.personal_info_id,
        CONCAT(pi.lastname, ', ', pi.firstname, ' ', LEFT(pi.middlename, 1), '.') AS full_name
    FROM residents r
    JOIN personal_information pi ON r.personal_info_id = pi.personal_info_id
    WHERE r.isArchived = 0
";

$result = $conn->query($query);

// Check if query was successful
if ($result === false) {
    echo json_encode(["error" => "Query failed: " . $conn->error]);
    $conn->close();
    exit;
}

// Fetch results
$residents = [];
while ($row = $result->fetch_assoc()) {
    $residents[] = [
        "resident_id" => $row["resident_id"],
        "full_name" => $row["full_name"],
        "personal_info_id" => $row["personal_info_id"]
    ];
}

// Return JSON response
echo json_encode($residents, JSON_PRETTY_PRINT);

// Close connection
$conn->close();
?>
