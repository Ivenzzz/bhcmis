<?php

require '../../../config/db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resident_id = $_POST['resident_id'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $date_of_birth = $_POST['date_of_birth'];
    $civil_status = $_POST['civil_status'];
    $educational_attainment = $_POST['educational_attainment'];
    $occupation = $_POST['occupation'];
    $religion = $_POST['religion'];
    $citizenship = $_POST['citizenship'];
    $address_id = $_POST['address_id'];
    $sex = $_POST['sex'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];

    // Update the personal_information table
    $sql = "UPDATE personal_information 
            SET lastname = ?, firstname = ?, middlename = ?, date_of_birth = ?, civil_status = ?, educational_attainment = ?, 
                occupation = ?, religion = ?, citizenship = ?, address_id = ?, sex = ?, phone_number = ?, email = ?, updated_at = NOW()
            WHERE personal_info_id = (SELECT personal_info_id FROM residents WHERE resident_id = ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo json_encode(['success' => false, 'error' => $conn->error]);
        exit;
    }

    $stmt->bind_param('sssssssssssssi', $lastname, $firstname, $middlename, $date_of_birth, $civil_status, $educational_attainment, 
                      $occupation, $religion, $citizenship, $address_id, $sex, $phone_number, $email, $resident_id);

    if ($stmt->execute()) {
        $sql_fetch = "SELECT 
                    r.resident_id, 
                    pi.lastname, 
                    pi.firstname, 
                    pi.middlename, 
                    pi.date_of_birth, 
                    YEAR(CURDATE()) - YEAR(pi.date_of_birth) - (DATE_FORMAT(CURDATE(), '%m%d') < DATE_FORMAT(pi.date_of_birth, '%m%d')) AS age,
                    pi.civil_status, 
                    pi.educational_attainment, 
                    pi.occupation, 
                    pi.religion, 
                    pi.citizenship, 
                    a.address_name, 
                    pi.sex, 
                    pi.phone_number, 
                    pi.email 
                    FROM residents r 
                    JOIN personal_information pi ON r.personal_info_id = pi.personal_info_id 
                    JOIN address a ON pi.address_id = a.address_id 
                    WHERE r.resident_id = ?";
        
        $stmt_fetch = $conn->prepare($sql_fetch);
        $stmt_fetch->bind_param('i', $resident_id);
        $stmt_fetch->execute();
        $result = $stmt_fetch->get_result();
        $updated_resident = $result->fetch_assoc();

        echo json_encode(['success' => true, 'updated_resident' => $updated_resident]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
    if (isset($stmt_fetch)) {
        $stmt_fetch->close();
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

$conn->close();
