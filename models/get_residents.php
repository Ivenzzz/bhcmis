<?php

function getResidents($conn) {
    $sql = "SELECT  
                r.*,
                pi.*,
                a.*,
                ac.*,
                TIMESTAMPDIFF(YEAR, pi.date_of_birth, CURDATE()) AS age
            FROM 
                residents r
            JOIN 
                personal_information pi ON r.personal_info_id = pi.personal_info_id
            JOIN 
                address a ON pi.address_id = a.address_id
            JOIN 
                accounts ac ON r.account_id = ac.account_id
            WHERE 
                ac.isArchived = 0
            ORDER BY 
                r.resident_id DESC";

    $result = mysqli_query($conn, $sql);
    $residents_data = [];

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $residents_data[] = $row;
        }
    }

    return $residents_data;
}

?>


