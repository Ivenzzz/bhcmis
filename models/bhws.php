<?php
/**
 * Retrieves all Barangay Health Workers (BHWs) from the database.
 *
 * @param mysqli $conn The database connection object.
 * @return array An associative array of BHW records.
 */
function getBHWs($conn) {
    $query = "SELECT b.*, 
                     p.firstname, 
                     p.middlename, 
                     p.lastname, 
                     p.phone_number, 
                     p.email, 
                     a.address_name AS assigned_area_name,
                     TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) AS age
              FROM bhw b
              JOIN personal_information p ON b.personal_info_id = p.personal_info_id
              JOIN address a ON b.assigned_area = a.address_id
              ORDER BY b.date_started ASC";

    $result = $conn->query($query);

    if (!$result) {
        die("Error retrieving BHWs: " . $conn->error);
    }

    $bhws = [];
    while ($row = $result->fetch_assoc()) {
        $bhws[] = $row;
    }

    return $bhws;
}



?>
