<?php

function getAllPrenatals($conn) {
    // SQL query to retrieve all prenatals with their associated information, including prenatal schedules
    $sql = "
        SELECT 
            p.*,
            pr.*,
            r.resident_id,
            pi.lastname,
            pi.firstname,
            pi.middlename,
            pi.phone_number,
            pi.email,
            ps.sched_date,
            ps.sched_note
        FROM 
            prenatals AS p
        JOIN 
            pregnancy AS pr ON p.pregnancy_id = pr.pregnancy_id
        JOIN 
            residents AS r ON pr.resident_id = r.resident_id
        JOIN 
            personal_information AS pi ON r.personal_info_id = pi.personal_info_id
        JOIN 
            prenatal_schedules AS ps ON p.sched_id = ps.sched_id
        ORDER BY 
            p.prenatal_id DESC
    ";

    $result = $conn->query($sql);

    if ($result === FALSE) {
        // Handle error
        die("Error executing query: " . $conn->error);
    }

    // Fetch all prenatals and their information into an associative array
    $prenatals = [];
    while ($row = $result->fetch_assoc()) {
        $prenatals[] = $row;
    }

    return $prenatals;
}



?>