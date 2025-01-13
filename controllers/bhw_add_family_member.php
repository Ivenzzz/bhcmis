<?php
// Include the database connection file
require '../partials/global_db_config.php';

// Set the content type to JSON
header('Content-Type: application/json');

try {
    // Retrieve and sanitize form data
    $firstname = htmlspecialchars($_POST['firstname'] ?? '');
    $lastname = htmlspecialchars($_POST['lastname'] ?? '');
    $middlename = htmlspecialchars($_POST['middlename'] ?? '');
    $date_of_birth = htmlspecialchars($_POST['date_of_birth'] ?? '');
    $role = htmlspecialchars($_POST['role'] ?? '');
    $civil_status = htmlspecialchars($_POST['civil_status'] ?? '');
    $educational_attainment = htmlspecialchars($_POST['educational_attainment'] ?? '');
    $occupation = htmlspecialchars($_POST['occupation'] ?? '');
    $religion = htmlspecialchars($_POST['religion'] ?? '');
    $citizenship = htmlspecialchars($_POST['citizenship'] ?? '');
    $sex = htmlspecialchars($_POST['sex'] ?? '');
    $family_id = intval($_POST['family_id'] ?? 0);
    $household_id = intval($_POST['household_id'] ?? 0);

    // Validate required fields
    if (empty($firstname) || empty($lastname) || empty($date_of_birth) || empty($role) || empty($family_id) || empty($household_id)) {
        throw new Exception("Missing required fields.");
    }

    // Check if the role "Husband" or "Wife" already exists in the family
    if (in_array($role, ['husband', 'wife'])) {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM family_members WHERE family_id = ? AND role = ?");
        $stmt->bind_param('is', $family_id, $role);
        $stmt->execute();
        $stmt->bind_result($role_count);
        $stmt->fetch();
        $stmt->close();

        if ($role_count > 0) {
            throw new Exception(ucfirst($role) . " role already exists in this family.");
        }
    }

    // Insert into personal_information
    $stmt = $conn->prepare(
        "INSERT INTO personal_information 
         (firstname, lastname, middlename, date_of_birth, civil_status, educational_attainment, 
          occupation, religion, citizenship, sex) 
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param(
        'ssssssssss',
        $firstname,
        $lastname,
        $middlename,
        $date_of_birth,
        $civil_status,
        $educational_attainment,
        $occupation,
        $religion,
        $citizenship,
        $sex
    );
    $stmt->execute();
    $personal_info_id = $stmt->insert_id;
    $stmt->close();

    // Insert into residents
    $stmt = $conn->prepare("INSERT INTO residents (personal_info_id) VALUES (?)");
    $stmt->bind_param('i', $personal_info_id);
    $stmt->execute();
    $resident_id = $stmt->insert_id;
    $stmt->close();

    // Insert into family_members
    $stmt = $conn->prepare("INSERT INTO family_members (family_id, resident_id, role) VALUES (?, ?, ?)");
    $stmt->bind_param('iis', $family_id, $resident_id, $role);
    $stmt->execute();
    $stmt->close();

    // Close the database connection
    $conn->close();

    // Return success response
    echo json_encode(['success' => true, 'message' => 'Family member added successfully.']);
} catch (Exception $e) {
    // Return error response
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
