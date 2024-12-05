<?php
// Include database connection file
require_once '../partials/global_db_config.php';

function getBHWs($conn) {
    // SQL query to retrieve all BHWs
    $sql = "SELECT bhw.bhw_id, bhw.account_id, bhw.personal_info_id, bhw.assigned_area, 
                   bhw.date_started, bhw.employment_status,
                   pi.firstname, pi.middlename, pi.lastname, pi.phone_number, pi.email
            FROM bhw 
            INNER JOIN personal_information AS pi ON bhw.personal_info_id = pi.personal_info_id
            ORDER BY bhw.bhw_id ASC"; // Order by BHW ID

    // Execute the query
    $result = $conn->query($sql);

    // Check if query was successful
    if ($result === false) {
        die('Error executing query: ' . $conn->error);
    }

    // Fetch all results
    $bhws = [];
    while ($row = $result->fetch_assoc()) {
        $bhws[] = $row;
    }

    return $bhws;
}
?>
