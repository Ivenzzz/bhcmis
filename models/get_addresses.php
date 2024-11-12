<?php

function getAddresses($conn) {
    $sql = "SELECT address_id, address_name, address_type FROM address";
    $result = mysqli_query($conn, $sql);

    $addresses = [];

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $addresses[] = $row;
        }
    }

    return $addresses;
}

// Call the function and store the result in a variable
$addresses = getAddresses($conn);
?>


