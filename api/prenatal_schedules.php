<?php
header('Content-Type: application/json');

require '../partials/global_db_config.php';

// Query to retrieve prenatal schedules
$query = "
    SELECT sched_id, sched_date 
    FROM prenatal_schedules 
    WHERE isArchived = 0
";

$result = $conn->query($query);

if (!$result) {
    die(json_encode(['error' => $conn->error]));
}

// Format data for FullCalendar
$schedules = [];
while ($row = $result->fetch_assoc()) {
    $schedules[] = [
        'id' => $row['sched_id'],
        'title' => 'Prenatal Checkup',
        'start' => $row['sched_date'],
    ];
}

echo json_encode($schedules);

$conn->close();
?>
