<?php
session_start();
require_once '../partials/global_db_config.php'; // Include your database configuration

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

try {
    // Verify request method
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method');
    }

    // Validate required fields
    $required = ['personal_info_id', 'lastname', 'firstname', 'date_of_birth', 'civil_status'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            throw new Exception("Required field missing: $field");
        }
    }

    // Sanitize and validate input
    $personal_info_id = intval($_POST['personal_info_id']);
    $lastname = trim($_POST['lastname']);
    $firstname = trim($_POST['firstname']);
    $middlename = trim($_POST['middlename'] ?? '');
    $date_of_birth = $_POST['date_of_birth'];
    $civil_status = $_POST['civil_status'];
    $educational_attainment = $_POST['educational_attainment'] ?? null;
    $occupation = trim($_POST['occupation'] ?? '');
    $religion = trim($_POST['religion'] ?? '');
    $citizenship = trim($_POST['citizenship'] ?? '');
    $sex = $_POST['sex'];
    $phone_number = trim($_POST['phone_number'] ?? '');
    $email = trim($_POST['email'] ?? '');

    // Additional validations
    $valid_civil_statuses = ['Single', 'Married', 'Widowed', 'Legally Separated'];
    if (!in_array($civil_status, $valid_civil_statuses)) {
        throw new Exception('Invalid civil status');
    }

    if (!empty($phone_number) && !preg_match('/^[0-9]{11}$/', $phone_number)) {
        throw new Exception('Invalid phone number format');
    }

    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email format');
    }

    if (!DateTime::createFromFormat('Y-m-d', $date_of_birth)) {
        throw new Exception('Invalid date format for birth date');
    }

    // Prepare update query
    $sql = "UPDATE personal_information SET
            lastname = ?,
            firstname = ?,
            middlename = ?,
            date_of_birth = ?,
            civil_status = ?,
            educational_attainment = ?,
            occupation = ?,
            religion = ?,
            citizenship = ?,
            sex = ?,
            phone_number = ?,
            email = ?,
            updated_at = NOW()
            WHERE personal_info_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        'ssssssssssssi',
        $lastname,
        $firstname,
        $middlename,
        $date_of_birth,
        $civil_status,
        $educational_attainment,
        $occupation,
        $religion,
        $citizenship,
        $sex,
        $phone_number,
        $email,
        $personal_info_id
    );

    if (!$stmt->execute()) {
        throw new Exception('Failed to update personal information: ' . $stmt->error);
    }

    if ($stmt->affected_rows === 0) {
        throw new Exception('No changes made or record not found');
    }

    $response['success'] = true;
    $response['message'] = 'Personal information updated successfully';

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
    error_log('Error updating personal info: ' . $e->getMessage());
} finally {
    if (isset($stmt)) {
        $stmt->close();
    }
    $conn->close();
}

echo json_encode($response);
exit;
?>