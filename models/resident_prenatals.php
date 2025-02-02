<?php
// Assuming you have a MySQL connection stored in $conn

function getResidentPrenatalSchedules($conn, $resident_id) {
    // Prepare the SQL query with all necessary joins
    $sql = "SELECT 
                rps.resident_ps_id, 
                rps.pregnancy_id, 
                rps.sched_id, 
                rps.priority_number, 
                rps.status, 
                rps.notes, 
                rps.created_at AS rps_created_at, 
                rps.updated_at AS rps_updated_at, 
                ps.sched_date, 
                p.expected_due_date, 
                p.pregnancy_status,
                res.resident_id, 
                res.account_id, 
                res.personal_info_id, 
                res.isArchived AS resident_isArchived, 
                res.created_at AS resident_created_at, 
                res.updated_at AS resident_updated_at
            FROM 
                resident_prenatal_schedules rps
            JOIN 
                prenatal_schedules ps ON rps.sched_id = ps.sched_id
            JOIN 
                pregnancy p ON rps.pregnancy_id = p.pregnancy_id
            JOIN 
                residents res ON p.resident_id = res.resident_id
            WHERE 
                res.resident_id = ?
                AND p.isArchived = 0
                AND res.isArchived = 0";
    
    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameter
        $stmt->bind_param("i", $resident_id);
        
        // Execute the statement
        $stmt->execute();
        
        // Get the result
        $result = $stmt->get_result();
        
        // Check if any rows are returned
        if ($result->num_rows > 0) {
            // Fetch and return the result as an associative array
            $schedules = [];
            while ($row = $result->fetch_assoc()) {
                $schedules[] = $row;
            }
            return $schedules;
        } else {
            // No schedules found
            return null;
        }
        
        // Close the statement
        $stmt->close();
    } else {
        // Error preparing the query
        return false;
    }
}

function getPrenatalInfoByResidentPsId($conn, $resident_ps_id) {
    // SQL query to retrieve prenatal information based on resident_ps_id
    $sql = "SELECT p.*, rps.*
            FROM prenatals p
            LEFT JOIN resident_prenatal_schedules rps ON p.resident_prenatal_schedule_id = rps.resident_ps_id
            WHERE rps.resident_ps_id = ? AND p.isArchived = 0";
    
    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);
    
    // Bind the resident_ps_id parameter to the SQL query
    $stmt->bind_param("i", $resident_ps_id);
    
    // Execute the query
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Check if there are results
    if ($result->num_rows > 0) {
        // Fetch all the results as an associative array
        $prenatal_info = $result->fetch_all(MYSQLI_ASSOC);
        return $prenatal_info;
    } else {
        return null; // No prenatal info found
    }
    
    // Close the statement
    $stmt->close();
}

?>

