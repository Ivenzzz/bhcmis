<?php
// Database connection
require '../partials/global_db_config.php';

// API Endpoint to get the most common symptoms
header('Content-Type: application/json');

// Query to get the symptoms from the consultations table
$query = "
    SELECT symptoms
    FROM consultations
    WHERE isArchived = 0 AND symptoms IS NOT NULL AND symptoms != '';
";

$result = $conn->query($query);

// Check if the query was successful
if (!$result) {
    echo json_encode(['error' => 'Database query failed']);
    exit();
}

// Initialize an array to hold individual symptoms
$symptom_counts = [];

// Process the symptoms to separate them and count their occurrences
while ($row = $result->fetch_assoc()) {
    // Split the symptoms string by comma
    $symptoms = explode(',', $row['symptoms']);
    
    // Clean up extra spaces and count each symptom
    foreach ($symptoms as $symptom) {
        $symptom = trim($symptom); // Trim spaces
        if (!empty($symptom)) {
            if (isset($symptom_counts[$symptom])) {
                $symptom_counts[$symptom]++;
            } else {
                $symptom_counts[$symptom] = 1;
            }
        }
    }
}

// Sort symptoms by count in descending order
arsort($symptom_counts);

// Get the top 10 most common symptoms
$top_symptoms = array_slice($symptom_counts, 0, 10);

// Format the data for the API response
$response = [];
foreach ($top_symptoms as $symptom => $count) {
    $response[] = [
        'symptom' => $symptom,
        'count' => $count
    ];
}

// Return the data as JSON
echo json_encode($response);
?>
