<?php
// Include database connection
require '../partials/global_db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $date_of_birth = $_POST['date_of_birth'];
    $civil_status = !empty($_POST['civil_status']) ? $_POST['civil_status'] : NULL;
    $educational_attainment = !empty($_POST['educational_attainment']) ? $_POST['educational_attainment'] : NULL;
    $occupation = !empty($_POST['occupation']) ? $_POST['occupation'] : NULL;
    $religion = !empty($_POST['religion']) ? $_POST['religion'] : NULL;
    $citizenship = !empty($_POST['citizenship']) ? $_POST['citizenship'] : NULL;
    $sex = !empty($_POST['sex']) ? $_POST['sex'] : NULL;
    $phone_number = !empty($_POST['phone_number']) ? $_POST['phone_number'] : NULL;
    $email = !empty($_POST['email']) ? $_POST['email'] : NULL;
    $isRegisteredVoter = $_POST['isRegisteredVoter'];
    $family_role = $_POST['family_role'];  
    $family_id = $_POST['family_id'];  

    $conn->begin_transaction();

    try {
        // Step 1: Check for duplicate fullname and birthday across all records
        $stmt_check_duplicate = $conn->prepare("
            SELECT pi.personal_info_id
            FROM personal_information pi
            WHERE pi.lastname = ? 
            AND pi.firstname = ? 
            AND pi.middlename = ?
        ");
        $stmt_check_duplicate->bind_param('sss', $lastname, $firstname, $middlename);
        $stmt_check_duplicate->execute();
        $result_check_duplicate = $stmt_check_duplicate->get_result();

        if ($result_check_duplicate->num_rows > 0) {
            throw new Exception("A resident with the same full name and birthday already exists.");
        }

        // Step 2: Find the family_id and address_id based on family_no
        $stmt1 = $conn->prepare("SELECT f.family_id, h.address_id 
                                 FROM families f
                                 JOIN household_members hm ON f.family_id = hm.family_id
                                 JOIN household h ON hm.household_id = h.household_id
                                 WHERE f.family_id = ?");
        $stmt1->bind_param('s', $family_id); 
        $stmt1->execute();
        $result1 = $stmt1->get_result();

        if ($result1->num_rows == 0) {
            throw new Exception("You are providing a family no. that doesn't exist.");
        }

        $row = $result1->fetch_assoc();
        $family_id = $row['family_id'];
        $address_id = $row['address_id'];

        // Step 3: If the role is "husband" or "wife", check if another husband or wife exists in the family
        if ($family_role == 'husband' || $family_role == 'wife') {
            $stmt_check_role = $conn->prepare("SELECT * FROM family_members WHERE family_id = ? AND role = ?");
            $stmt_check_role->bind_param('is', $family_id, $family_role);
            $stmt_check_role->execute();
            $result_check_role = $stmt_check_role->get_result();

            if ($result_check_role->num_rows > 0) {
                throw new Exception("There is already a {$family_role} in the family.");
            }
        }

        // Step 4: Insert into personal_information table
        $stmt2 = $conn->prepare("INSERT INTO personal_information (lastname, firstname, middlename, date_of_birth, civil_status, educational_attainment, occupation, religion, citizenship, address_id, sex, phone_number, email, isRegisteredVoter)
                                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt2->bind_param('ssssssssssssii', $lastname, $firstname, $middlename, $date_of_birth, $civil_status, $educational_attainment, $occupation, $religion, $citizenship, $address_id, $sex, $phone_number, $email, $isRegisteredVoter);

        if (!$stmt2->execute()) {
            throw new Exception('Failed to insert personal information.');
        }

        $personal_info_id = $stmt2->insert_id;

        // Step 5: Insert into residents table
        $stmt3 = $conn->prepare("INSERT INTO residents (personal_info_id) VALUES (?)");
        $stmt3->bind_param('i', $personal_info_id);
        if (!$stmt3->execute()) {
            throw new Exception('Failed to insert resident data into residents table.');
        }

        $resident_id = $stmt3->insert_id;

        // Step 6: Insert into family_members table
        $stmt4 = $conn->prepare("INSERT INTO family_members (family_id, resident_id, role) VALUES (?, ?, ?)");
        $stmt4->bind_param('iis', $family_id, $resident_id, $family_role);
        if (!$stmt4->execute()) {
            throw new Exception('Failed to insert family member data.');
        }

        $conn->commit();
        echo json_encode(['success' => true, 'message' => 'Resident added successfully!']);
    } catch (Exception $e) {
        $conn->rollback();

        if (isset($stmt1)) { $stmt1->close(); }
        if (isset($stmt2)) { $stmt2->close(); }
        if (isset($stmt3)) { $stmt3->close(); }
        if (isset($stmt4)) { $stmt4->close(); }
        if (isset($stmt_check_duplicate)) { $stmt_check_duplicate->close(); }

        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }

    $conn->close();
}
?>
