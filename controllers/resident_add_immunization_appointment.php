<?php

require '../partials/global_db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resident_id = $_POST['resident_id'] ?? null;
    $schedule_id = $_POST['schedule_id'] ?? null;

    if (!$resident_id || !$schedule_id) {
        echo json_encode([
            'success' => false,
            'message' => 'Resident ID and Schedule ID are required.',
        ]);
        exit;
    }

    // Check if the selected schedule is in the past
    $stmt = $conn->prepare("SELECT schedule_date FROM immunization_schedules WHERE schedule_id = ?");
    $stmt->bind_param("i", $schedule_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $schedule = $result->fetch_assoc();
    $schedule_date = $schedule['schedule_date'] ?? null;

    if (!$schedule_date || strtotime($schedule_date) < time()) {
        echo json_encode([
            'success' => false,
            'message' => 'The selected schedule is in the past. Please choose a future schedule.',
        ]);
        exit;
    }

    // Check if the resident already has an appointment for the selected schedule
    $stmt = $conn->prepare("SELECT * FROM immunization_appointments WHERE resident_id = ? AND sched_id = ? AND isArchived = 0");
    $stmt->bind_param("ii", $resident_id, $schedule_id);
    $stmt->execute();
    $existing_appointment = $stmt->get_result()->fetch_assoc();

    if ($existing_appointment) {
        echo json_encode([
            'success' => false,
            'message' => 'You already have an appointment for this schedule.',
        ]);
        exit;
    }

    // Generate a unique tracking code (16 uppercase alphanumeric characters)
    $tracking_code = strtoupper(substr(bin2hex(random_bytes(8)), 0, 16));

    // Set initial priority number (e.g., last+1 or logic to assign priority)
    $stmt = $conn->prepare("SELECT COUNT(*) + 1 AS priority_number FROM immunization_appointments WHERE sched_id = ?");
    $stmt->bind_param("i", $schedule_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $priority_number = $result->fetch_assoc()['priority_number'];

    // Insert into database
    $stmt = $conn->prepare("
        INSERT INTO immunization_appointments (tracking_code, resident_id, sched_id, priority_number, status) 
        VALUES (?, ?, ?, ?, 'Scheduled')
    ");
    $stmt->bind_param("siii", $tracking_code, $resident_id, $schedule_id, $priority_number);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Appointment added successfully.',
            'tracking_code' => $tracking_code,
            'priority_number' => $priority_number,
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to add appointment. Please try again.',
        ]);
    }

    $stmt->close();
    $conn->close();
}
?>
