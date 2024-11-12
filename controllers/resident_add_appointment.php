<?php
session_start();
require_once '../../../config/db_config.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the submitted data
    $resident_id = isset($_POST['resident_id']) ? intval($_POST['resident_id']) : null;
    $schedule_id = isset($_POST['schedule_id']) ? intval($_POST['schedule_id']) : null;

    // Check if required fields are not empty
    if ($resident_id && $schedule_id) {
        // Step 1: Verify that the schedule exists
        $stmt_check_schedule = $conn->prepare("SELECT con_sched_date FROM consultation_schedules WHERE con_sched_id = ?");
        $stmt_check_schedule->bind_param("i", $schedule_id);
        $stmt_check_schedule->execute();
        $result_schedule = $stmt_check_schedule->get_result();

        // Check if the schedule exists
        if ($result_schedule->num_rows > 0) {
            $schedule_data = $result_schedule->fetch_assoc();
            $schedule_date = $schedule_data['con_sched_date'];

            // Step 2: Check if an appointment already exists for this resident on the same schedule date
            $stmt_check_appointment = $conn->prepare("
                SELECT a.appointment_id 
                FROM appointments a
                JOIN consultation_schedules cs ON a.sched_id = cs.con_sched_id
                WHERE a.resident_id = ? AND cs.con_sched_date = ?
            ");
            $stmt_check_appointment->bind_param("is", $resident_id, $schedule_date);
            $stmt_check_appointment->execute();
            $result_appointment = $stmt_check_appointment->get_result();

            // If there is already an appointment for the same date, prevent the insertion
            if ($result_appointment->num_rows > 0) {
                $message = urlencode("You already have an appointment scheduled on this date.");
            } else {
                // Step 3: Retrieve the latest priority number for the given schedule
                $stmt_priority = $conn->prepare("SELECT COUNT(*) AS priority_number FROM appointments WHERE sched_id = ?");
                $stmt_priority->bind_param("i", $schedule_id);
                $stmt_priority->execute();
                $result_priority = $stmt_priority->get_result();
                $priority_data = $result_priority->fetch_assoc();

                // Get the priority number (the count of appointments + 1)
                $latest_priority_number = $priority_data['priority_number'] + 1;

                // Step 4: Generate the tracking code with 12 random digits
                $random_digits = random_int(100000000000, 999999999999);
                $tracking_code = 'HC' . $random_digits . 'PH';

                // Step 5: Prepare the SQL statement to insert a new appointment with tracking code and priority number
                $stmt = $conn->prepare("INSERT INTO appointments (tracking_code, resident_id, sched_id, status, priority_number) VALUES (?, ?, ?, 'Scheduled', ?)");
                $stmt->bind_param("siii", $tracking_code, $resident_id, $schedule_id, $latest_priority_number);

                // Execute the statement
                if ($stmt->execute()) {
                    $message = urlencode("Appointment added successfully! Tracking Code: " . htmlspecialchars($tracking_code));
                } else {
                    // Error message
                    $message = urlencode("Error adding appointment: " . $stmt->error);
                }

                // Close the statements
                $stmt->close();
                $stmt_priority->close();
            }

            // Close the check appointment statement
            $stmt_check_appointment->close();
        } else {
            // Handle case where schedule does not exist
            $message = urlencode("The selected schedule does not exist.");
        }

        // Close the check schedule statement
        $stmt_check_schedule->close();
    } else {
        // Handle case where required fields are missing
        $message = urlencode("Please select a schedule and resident ID.");
    }
} else {
    $message = urlencode("Invalid request.");
}

// Redirect back to the appointments page with the message as a URL parameter
header("Location: /bhcmis/r-appointments?message=$message");
exit();

