<?php

require '../partials/global_db_config.php';

// Query to retrieve schedules with vaccine names
$query = "
    SELECT 
        immunization_schedules.schedule_id,
        immunization_schedules.schedule_date,
        vaccines.vaccine_name
    FROM immunization_schedules
    INNER JOIN vaccines ON immunization_schedules.vaccine_id = vaccines.vaccine_id
    WHERE immunization_schedules.isArchived = 0
";

$result = $conn->query($query);

$schedules = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $schedules[] = [
            'id' => $row['schedule_id'],
            'title' => $row['vaccine_name'],
            'start' => $row['schedule_date']
        ];
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($schedules);

$conn->close();
?>
