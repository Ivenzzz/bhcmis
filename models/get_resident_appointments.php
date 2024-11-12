<?php
function getResidentAppointmentsWithSchedule($conn) {
    // Check if the session contains 'account_id'
    if (isset($_SESSION['account_id'])) {
        $account_id = $_SESSION['account_id'];
        
        // Prepare the SQL query to get resident_id from the 'residents' table
        $query_resident = "SELECT resident_id FROM residents WHERE account_id = ?";
        $stmt_resident = $conn->prepare($query_resident);
        $stmt_resident->bind_param("i", $account_id);
        $stmt_resident->execute();
        $result_resident = $stmt_resident->get_result();

        // Check if resident found
        if ($result_resident->num_rows > 0) {
            $row_resident = $result_resident->fetch_assoc();
            $resident_id = $row_resident['resident_id'];

            // Prepare the SQL query to retrieve all appointments for the resident along with their schedule
            $query_appointments = "
                SELECT 
                    a.*,
                    cs.con_sched_date
                FROM 
                    appointments a
                LEFT JOIN 
                    consultation_schedules cs
                ON 
                    a.sched_id = cs.con_sched_id
                WHERE 
                    a.resident_id = ?
                ORDER BY 
                    a.appointment_id DESC";

                    
            $stmt_appointments = $conn->prepare($query_appointments);
            $stmt_appointments->bind_param("i", $resident_id);
            $stmt_appointments->execute();
            $result_appointments = $stmt_appointments->get_result();

            // Fetch and return appointments with schedule details
            $appointments = $result_appointments->fetch_all(MYSQLI_ASSOC);
            return $appointments;
        } else {
            // Resident not found for the account_id
            return null;
        }
    } else {
        // Account ID not found in session
        return null;
    }
}
?>
