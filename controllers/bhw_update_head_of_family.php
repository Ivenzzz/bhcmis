<?php
// Include the necessary database connection file
require_once '../partials/global_db_config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the personal_info_id from the form (hidden field)
    $personal_info_id = $_POST['personal_info_id'];

    // Get the new data from the form
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $date_of_birth = $_POST['date_of_birth'];
    $civil_status = $_POST['civil_status'];
    $educational_attainment = $_POST['educational_attainment'];
    $occupation = $_POST['occupation'];
    $religion = $_POST['religion'];
    $citizenship = $_POST['citizenship'];
    $sex = $_POST['sex'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $isTransferred = isset($_POST['isTransferred']) ? 1 : 0;
    $isDeceased = isset($_POST['isDeceased']) ? 1 : 0;
    $deceased_date = $isDeceased ? $_POST['deceased_date'] : NULL;
    $isRegisteredVoter = isset($_POST['isRegisteredVoter']) ? 1 : 0;

    // Ensure that family_id and household_id are available (could come from the session, URL, or form)
    $family_id = $_POST['family_id']; // Assuming it's passed in the form
    $household_id = $_POST['household_id']; // Assuming it's passed in the form

    // Prepare the SQL query to update the personal information
    $query = "UPDATE personal_information SET
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
                isTransferred = ?, 
                isDeceased = ?, 
                deceased_date = ?, 
                isRegisteredVoter = ?, 
                updated_at = NOW() 
              WHERE personal_info_id = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($query)) {
        // Bind the parameters
        $stmt->bind_param("ssssssssssssisisi", $lastname, $firstname, $middlename, $date_of_birth, 
                          $civil_status, $educational_attainment, $occupation, $religion, $citizenship, 
                          $sex, $phone_number, $email, $isTransferred, $isDeceased, $deceased_date, 
                          $isRegisteredVoter, $personal_info_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect back to the family members page with family_id and household_id as URL parameters
            header("Location: ../bhw/family_members.php?family_id=$family_id&household_id=$household_id");
            exit();
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
