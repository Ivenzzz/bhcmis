<?php 

function getConsultationSchedules($conn) {
    $query = "
        SELECT 
            cs.con_sched_id,
            cs.con_sched_date,
            COUNT(a.appointment_id) AS total_appointments
        FROM consultation_schedules cs
        LEFT JOIN appointments a ON cs.con_sched_id = a.sched_id AND a.status = 'Scheduled'
        GROUP BY cs.con_sched_id, cs.con_sched_date
        ORDER BY cs.con_sched_date ASC
    ";

    if ($stmt = $conn->prepare($query)) {
        $stmt->execute();
        $result = $stmt->get_result();
        $schedules = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $schedules;
    } else {
        return "Error: Could not retrieve consultation schedules.";
    }
}
?>
