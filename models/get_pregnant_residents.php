<?php

function getPregnantResidents($conn) {
    $sql = "
        SELECT p.pregnancy_id, pi.firstname, pi.middlename, pi.lastname, p.expected_due_date 
        FROM pregnancy AS p
        JOIN residents AS r ON p.resident_id = r.resident_id
        JOIN personal_information AS pi ON r.personal_info_id = pi.personal_info_id
        WHERE p.pregnancy_status = 'Ongoing'
    ";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

?>
