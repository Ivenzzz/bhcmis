<?php
// voter_stats.php
header('Content-Type: application/json');
require '../partials/global_db_config.php'; // Contains existing $conn object

try {
    // Verify connection is established
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Query to get voter statistics
    $sql = "SELECT 
            COUNT(r.resident_id) AS total_residents,
            SUM(p.isRegisteredVoter) AS registered_voters,
            (SUM(p.isRegisteredVoter) / COUNT(r.resident_id)) * 100 AS voter_percentage
            FROM residents r
            INNER JOIN personal_information p ON r.personal_info_id = p.personal_info_id
            WHERE r.isArchived = 0";

    $result = $conn->query($sql);
    
    if (!$result) {
        throw new Exception("Query failed: " . $conn->error);
    }

    $data = $result->fetch_assoc();
    
    // Format the percentage
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
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
} finally {
    // Connection closure handled in global_db_config.php if needed
}
?>