<?php

function getMidwifeData($conn) {
    $sql = "SELECT 
            a.account_id,
            a.username,
            a.role,
            a.profile_picture,
            m.*,
            p.personal_info_id,
            p.lastname,
            p.firstname,
            p.middlename,
            p.date_of_birth,
            p.civil_status,
            p.educational_attainment,
            p.occupation,
            p.religion,
            p.citizenship,
            p.sex,
            p.phone_number,
            p.email,
            p.created_at,
            p.updated_at
        FROM 
            midwife m
        JOIN 
            accounts a ON m.account_id = a.account_id
        JOIN 
            personal_information p ON m.personal_info_id = p.personal_info_id
        WHERE 
            a.role = 'midwife'";

    $result = mysqli_query($conn, $sql);
    $midwife_data = [];

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $midwife_data[] = $row;
        }
    }

    return $midwife_data;
}

$midwife_data = getMidwifeData($conn);

?>


