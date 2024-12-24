<?php

require '../partials/global_db_config.php';

// Query to retrieve consultation schedules
$sql = "SELECT con_sched_id, con_sched_date, isArchived FROM consultation_schedules WHERE isArchived = 0";
$result = $conn->query($sql);

$schedules = [];

if ($result->num_rows > 0) {
    // Output each row of data
    while($row = $result->fetch_assoc()) {
        $schedules[] = [
            'id' => $row['con_sched_id'],
            'start' => $row['con_sched_date'], // FullCalendar expects "start" and "end" dates
            'title' => 'Consultation', // You can modify this to add more details
        ];
    }
} else {
    echo "0 results";
}

// Return schedules as JSON
header('Content-Type: application/json');
echo json_encode($schedules);

// Close connection
$conn->close();
?>
