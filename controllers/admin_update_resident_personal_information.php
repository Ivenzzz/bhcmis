<?php

header('Content-Type: application/json');

// Include database connection
require_once '../partials/global_db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data and sanitize input
    $resident_id = isset($_POST['resident_id']) ? intval($_POST['resident_id']) : null;
    $firstname = isset($_POST['firstname']) && !empty($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : NULL;
    $middlename = isset($_POST['middlename']) && !empty($_POST['middlename']) ? htmlspecialchars($_POST['middlename']) : NULL;
    $lastname = isset($_POST['lastname']) && !empty($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : NULL;
    $date_of_birth = isset($_POST['date_of_birth']) && !empty($_POST['date_of_birth']) ? $_POST['date_of_birth'] : NULL;
    $civil_status = isset($_POST['civil_status']) && !empty($_POST['civil_status']) ? $_POST['civil_status'] : NULL;
    $educational_attainment = isset($_POST['educational_attainment']) && !empty($_POST['educational_attainment']) ? $_POST['educational_attainment'] : NULL;
    $occupation = isset($_POST['occupation']) && !empty($_POST['occupation']) ? htmlspecialchars($_POST['occupation']) : NULL;
    $religion = isset($_POST['religion']) && !empty($_POST['religion']) ? htmlspecialchars($_POST['religion']) : NULL;
    $citizenship = isset($_POST['citizenship']) && !empty($_POST['citizenship']) ? htmlspecialchars($_POST['citizenship']) : NULL;
    $sex = isset($_POST['sex']) && !empty($_POST['sex']) ? $_POST['sex'] : NULL;
    $phone_number = isset($_POST['phone_number']) && !empty($_POST['phone_number']) ? htmlspecialchars($_POST['phone_number']) : NULL;
    $email = isset($_POST['email']) && !empty($_POST['email']) ? htmlspecialchars($_POST['email']) : NULL;
    $isRegisteredVoter = isset($_POST['isRegisteredVoter']) ? 1 : 0;
    $isDeceased = isset($_POST['isDeceased']) ? 1 : 0;
    $deceased_date = isset($_POST['deceased_date']) && !empty($_POST['deceased_date']) ? $_POST['deceased_date'] : NULL;
    $isTransferred = isset($_POST['isTransferred']) ? intval($_POST['isTransferred']) : NULL;

    if (!$resident_id) {
        echo json_encode(['status' => 'error', 'message' => 'Resident ID is required']);
        exit();
    }

    try {
        // Begin transaction
        $conn->begin_transaction();

        // Check if there is a resident with the same full name and birthday excluding the current resident
        $duplicate_check_query = "
            SELECT r.resident_id 
            FROM residents r
            JOIN personal_information p ON r.personal_info_id = p.personal_info_id
            WHERE p.firstname = ? 
                AND p.middlename = ? 
                AND p.lastname = ? 
                AND r.resident_id != ?";
        $stmt = $conn->prepare($duplicate_check_query);
        $stmt->bind_param('sssi', $firstname, $middlename, $lastname, $resident_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo json_encode(['status' => 'error', 'message' => 'Duplicate resident found with the same full name and birthday']);
            exit();
        }

        // Get personal_info_id for the resident
        $query = "SELECT personal_info_id FROM residents WHERE resident_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $resident_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            echo json_encode(['status' => 'error', 'message' => 'Resident not found']);
            exit();
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
            echo json_encode(['status' => 'error', 'message' => 'Failed to update resident information']);
            exit();
        }

        // Commit the transaction
        $conn->commit();

        // Return success response
        echo json_encode(['status' => 'success', 'message' => 'Resident information updated successfully']);
        exit();
    } catch (Exception $e) {
        // Rollback the transaction
        $conn->rollback();

        // Return error response
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        exit();
    }
} else {
    // If not POST, return error response
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit();
}
?>
