<?php
function getMidwives($conn) {
    // Define the SQL query to get active midwife first, followed by inactive ones
    $query = "
        SELECT 
            m.midwife_id,
            m.account_id,
            m.personal_info_id,
            m.employment_status,
            m.employment_date,
            p.lastname,
            p.firstname,
            p.middlename,
            p.date_of_birth,
            p.civil_status,
            p.educational_attainment,
            p.occupation,
            p.religion,
            p.citizenship,
            p.sex,
            p.phone_number,
            p.email
        FROM 
            midwife m
        INNER JOIN 
            personal_information p 
        ON 
            m.personal_info_id = p.personal_info_id
        ORDER BY 
            m.employment_status DESC, -- 'active' comes before 'inactive'
            m.employment_date ASC; -- Oldest employment date first
    ";

    // Prepare the statement
    if ($stmt = $conn->prepare($query)) {
        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch all rows
        $midwives = [];
        while ($row = $result->fetch_assoc()) {
            $midwives[] = $row;
        }

        // Close the statement
        $stmt->close();

        return $midwives;
    } else {
        // If the query fails
        throw new Exception("Error preparing SQL statement: " . $conn->error);
    }
}

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
                                    m.employment_status
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
