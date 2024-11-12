<?php

function getAccountByUsername($conn, $username) {
    $query = "SELECT * FROM accounts WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    return $stmt->get_result();
}

?>
