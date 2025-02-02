<?php
// Include necessary files
require '../partials/global_db_config.php';

// Get the form data
$child_id = $_POST['child_id'];
$schedule_id = $_POST['schedule_id'];

// Validate inputs
if (empty($child_id) || empty($schedule_id)) {
    echo json_encode(['status' => 'error', 'message' => 'Child and Schedule are required']);
    exit;
}

// Generate a 16-character alphanumeric tracking code
function generateTrackingCode() {
    return strtoupper(bin2hex(random_bytes(8))); // Generates 16 characters
}

$tracking_code = generateTrackingCode();

// Get the scheduled date from the immunization schedule
$query = "SELECT schedule_date FROM immunization_schedules WHERE schedule_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $schedule_id);
$stmt->execute();
$result = $stmt->get_result();
$schedule_data = $result->fetch_assoc();
$schedule_date = $schedule_data['schedule_date'];

// Check if the schedule date is in the past
if (new DateTime($schedule_date) < new DateTime()) {
    echo json_encode(['status' => 'error', 'message' => 'Cannot schedule an appointment for a past date']);
    exit;
}

// Check if the child already has an appointment for the same schedule on the same date
$query = "
    SELECT COUNT(*) 
    FROM immunization_appointments ia
    JOIN immunization_schedules isch ON ia.sched_id = isch.schedule_id
    WHERE ia.resident_id = ? 
    AND ia.sched_id = ? 
    AND DATE(isch.schedule_date) = DATE(?) 
    AND ia.isArchived = 0
";
$stmt = $conn->prepare($query);
$stmt->bind_param('iis', $child_id, $schedule_id, $schedule_date);
$stmt->execute();
$result = $stmt->get_result();
$existing_appointments = $result->fetch_assoc()['COUNT(*)'];

// If the child already has an appointment, return an error
if ($existing_appointments > 0) {
    echo json_encode(['status' => 'error', 'message' => 'Already has an appointment for this schedule on the selected date']);
    exit;
}

// Generate the priority number (as done previously)
$query = "SELECT priority_number FROM immunization_appointments WHERE sched_id = ? ORDER BY priority_number DESC LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $schedule_id);
$stmt->execute();
$result = $stmt->get_result();

// If there are previous appointments, get the latest priority number and increment it
if ($result->num_rows > 0) {
    $latest_priority = $result->fetch_assoc()['priority_number'];
    $priority_number = $latest_priority + 1;
} else {
    // If no previous appointments, set priority number to 1
    $priority_number = 1;
}

$stmt->close();

// Insert the new appointment into the `immunization_appointments` table
$query = "
    INSERT INTO immunization_appointments (resident_id, sched_id, tracking_code, priority_number, status)
    VALUES (?, ?, ?, ?, 'Scheduled')
";
$stmt = $conn->prepare($query);
$stmt->bind_param('iiss', $child_id, $schedule_id, $tracking_code, $priority_number);

// Execute the query
if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Appointment scheduled successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to schedule appointment']);
}

$stmt->close();
?>
