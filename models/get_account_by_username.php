<?php

function getAccountByUsername($conn, $username) {
    $query = "
        SELECT 
            a.*, 
            b.bhw_id, 
            m.midwife_id, 
            ad.admin_id, 
            r.resident_id 
        FROM 
            accounts a
        LEFT JOIN bhw b ON a.account_id = b.account_id
        LEFT JOIN midwife m ON a.account_id = m.account_id
        LEFT JOIN admin ad ON a.account_id = ad.account_id
        LEFT JOIN residents r ON a.account_id = r.account_id
        WHERE a.username = ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();

    return $stmt->get_result();
}


?>
