<?php

session_start();

// Include database connection
require_once '../partials/global_db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data and sanitize input
    $resident_id = intval($_POST['resident_id']); // Ensure resident_id is passed in the form
    $firstname = htmlspecialchars($_POST['firstname']);
    $middlename = htmlspecialchars($_POST['middlename']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $date_of_birth = $_POST['date_of_birth'];
    $civil_status = $_POST['civil_status'];
    $educational_attainment = $_POST['educational_attainment'];
    $occupation = htmlspecialchars($_POST['occupation']);
    $religion = htmlspecialchars($_POST['religion']);
    $citizenship = htmlspecialchars($_POST['citizenship']);
    $sex = $_POST['sex'];
    $phone_number = htmlspecialchars($_POST['phone_number']);
    $email = htmlspecialchars($_POST['email']);
    $isRegisteredVoter = isset($_POST['isRegisteredVoter']) ? 1 : 0;
    $isDeceased = isset($_POST['isDeceased']) ? 1 : 0;
    $deceased_date = !empty($_POST['deceased_date']) ? $_POST['deceased_date'] : NULL;
    $isTransferred = intval($_POST['isTransferred']);

    try {
        // Begin transaction
        $conn->begin_transaction();

        // Get personal_info_id for the resident
        $query = "SELECT personal_info_id FROM residents WHERE resident_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $resident_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception('Resident not found.');
        }

        $row = $result->fetch_assoc();
        $personal_info_id = $row['personal_info_id'];

        // Update personal_information
        $update_query = "
            UPDATE personal_information
            SET 
                firstname = ?, 
                middlename = ?, 
                lastname = ?, 
                date_of_birth = ?, 
                civil_status = ?, 
                educational_attainment = ?, 
                occupation = ?, 
                religion = ?, 
                citizenship = ?, 
                sex = ?, 
                phone_number = ?, 
                email = ?, 
                isRegisteredVoter = ?, 
                isDeceased = ?, 
                deceased_date = ?, 
                isTransferred = ?, 
                updated_at = NOW()
            WHERE personal_info_id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param(
            'ssssssssssssisssi',
            $firstname,
            $middlename,
            $lastname,
            $date_of_birth,
            $civil_status,
            $educational_attainment,
            $occupation,
            $religion,
            $citizenship,
            $sex,
            $phone_number,
            $email,
            $isRegisteredVoter,
            $isDeceased,
            $deceased_date,
            $isTransferred,
            $personal_info_id
        );

        if (!$update_stmt->execute()) {
            throw new Exception('Failed to update resident information.');
        }

        // Commit the transaction
        $conn->commit();

        // Redirect or show success message
        header('Location: ../admin/resident_details.php?resident_id=' . urlencode($resident_id) . '&update_personal_information=1');
        exit();
    } catch (Exception $e) {
        // Rollback the transaction
        $conn->rollback();

        // Redirect or show error message
        header('Location: ../admin/resident_details.php?error=' . urlencode($e->getMessage()));
        exit();
    }
} else {
    // If not POST, redirect to residents page
    header('Location: ../admin/resident_details.php?resident_id=' . urlencode($resident_id));
    exit();
}
?>
