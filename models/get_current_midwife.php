<?php 

function getCurrentMidwife($conn) {
    // Check if the session variable is set
    if (isset($_SESSION['account_id'])) {
        $account_id = $_SESSION['account_id'];

        // Prepare the SQL statement with JOINs
        $stmt = $conn->prepare("SELECT 
                                    a.account_id, 
                                    a.username, 
                                    a.role, 
                                    a.profile_picture, 
                                    a.isArchived, 
                                    p.firstname, 
                                    p.middlename, 
                                    p.lastname, 
                                    p.date_of_birth, 
                                    p.phone_number, 
                                    p.email, 
                                    p.sex, 
                                    m.employment_status, 
                                    m.license_number 
                                FROM 
                                    accounts a
                                LEFT JOIN 
                                    midwife m ON a.account_id = m.account_id
                                LEFT JOIN 
                                    personal_information p ON m.personal_info_id = p.personal_info_id
                                WHERE 
                                    a.account_id = ?");

        $stmt->bind_param("i", $account_id); // Bind the parameter as an integer

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch the current user data
        if ($result->num_rows > 0) {
            $currentUser = $result->fetch_assoc(); // Fetch the user data
        } else {
            // Handle case when no user is found
            $currentUser = null;
        }

        // Close the statement
        $stmt->close();
        return $currentUser; // Return the current user data
    } else {
        // Handle case when session variable is not set
        return null;
    }
}


?>