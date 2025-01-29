<?php

function getCurrentUser($conn) {
    // Check if the session variable is set
    if (isset($_SESSION['account_id'])) {
        $account_id = $_SESSION['account_id'];

        // Prepare the SQL statement with conditional joins based on role
        $stmt = $conn->prepare("
            SELECT 
                a.*,
                r.resident_id,
                m.midwife_id,
                b.bhw_id,
                ad.admin_id
            FROM 
                accounts a
            LEFT JOIN 
                residents r ON a.account_id = r.account_id AND a.role = 'residents'
            LEFT JOIN 
                midwife m ON a.account_id = m.account_id AND a.role = 'midwife'
            LEFT JOIN 
                bhw b ON a.account_id = b.account_id AND a.role = 'bhw'
            LEFT JOIN 
                admin ad ON a.account_id = ad.account_id AND a.role = 'admin'
            WHERE 
                a.account_id = ?
        ");

        if (!$stmt) {
            // Handle preparation error
            error_log("SQL prepare error: " . $conn->error);
            return null;
        }

        // Bind the parameter as an integer
        $stmt->bind_param("i", $account_id);

        // Execute the statement
        if (!$stmt->execute()) {
            // Handle execution error
            error_log("SQL execute error: " . $stmt->error);
            $stmt->close();
            return null;
        }

        // Get the result
        $result = $stmt->get_result();

        // Fetch the current user data
        if ($result->num_rows > 0) {
            $currentUser = $result->fetch_assoc(); // Fetch the user data
        } else {
            // Handle case when no user is found
            $currentUser = null; // No user found
        }

        // Close the statement
        $stmt->close();
        return $currentUser; // Return the current user data
    } else {
        // Handle case when session variable is not set
        return null; // User is not logged in
    }
}

function getChildrenIds($conn, $resident_id) {
    // Prepare the SQL query to retrieve children resident IDs
    $query = "
        SELECT fm.resident_id 
        FROM family_members AS fm
        WHERE fm.family_id = (
            SELECT family_id 
            FROM family_members 
            WHERE resident_id = ? AND isArchived = 0
        )
        AND fm.role = 'child' 
        AND fm.isArchived = 0
    ";

    // Prepare the statement
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $resident_id);
    $stmt->execute();

    // Fetch results
    $result = $stmt->get_result();
    $children_ids = [];
    while ($row = $result->fetch_assoc()) {
        $children_ids[] = $row['resident_id'];
    }

    // Close statement and return result
    $stmt->close();
    return $children_ids;
}

function getChildrenInfoByResidentIds($conn, $residentIds) {
    // Ensure the input is an array
    if (!is_array($residentIds)) {
        return "Error: Input must be an array of resident IDs.";
    }

    // Sanitize the array to prevent SQL injection
    $sanitizedResidentIds = array_map('intval', $residentIds);
    $residentIdsString = implode(',', $sanitizedResidentIds);

    // SQL query to retrieve personal information based on resident IDs
    $query = "
        SELECT 
            r.resident_id,  -- Include resident_id
            pi.personal_info_id, 
            pi.lastname, 
            pi.firstname, 
            pi.middlename, 
            pi.date_of_birth, 
            pi.civil_status, 
            pi.educational_attainment, 
            pi.occupation, 
            pi.religion, 
            pi.citizenship, 
            pi.address_id, 
            pi.sex, 
            pi.phone_number, 
            pi.email, 
            pi.id_picture, 
            pi.isTransferred, 
            pi.isDeceased, 
            pi.isRegisteredVoter, 
            pi.deceased_date, 
            pi.created_at AS personal_info_created_at, 
            pi.updated_at AS personal_info_updated_at
        FROM personal_information pi
        JOIN residents r ON pi.personal_info_id = r.personal_info_id
        WHERE r.resident_id IN ($residentIdsString)
        AND r.isArchived = 0
    ";

    // Execute the query
    $result = $conn->query($query);

    // Check if query was successful
    if ($result === false) {
        return "Error executing query: " . $conn->error;
    }

    // Fetch the results
    $personalInformation = [];
    while ($row = $result->fetch_assoc()) {
        $personalInformation[] = $row;
    }

    // Return the retrieved personal information with resident_id
    return $personalInformation;
}

function getAdminInformation($conn, $admin_id) {
    // Prepare the SQL query to fetch admin information
    $query = "
        SELECT 
            a.*,
            pi.*
        FROM admin a
        INNER JOIN personal_information pi 
            ON a.personal_information_id = pi.personal_info_id
        WHERE a.admin_id = ?";

    // Prepare and execute the query
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $admin_id); // Bind the admin_id as an integer
        $stmt->execute();

        // Fetch the result
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // Return the fetched row as an associative array
            return $result->fetch_assoc();
        } else {
            return null; // No admin found with the given ID
        }
    } else {
        // Handle query preparation errors
        die("Query failed: " . $conn->error);
    }
}

function getResidentInformation($conn, $resident_id) {
    // Prepare the SQL query to fetch admin information
    $query = "
        SELECT 
            r.*,
            pi.*
        FROM residents r
        INNER JOIN personal_information pi 
            ON r.personal_info_id = pi.personal_info_id
        WHERE r.resident_id = ?";

    // Prepare and execute the query
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $resident_id); // Bind the admin_id as an integer
        $stmt->execute();

        // Fetch the result
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // Return the fetched row as an associative array
            return $result->fetch_assoc();
        } else {
            return null; // No admin found with the given ID
        }
    } else {
        // Handle query preparation errors
        die("Query failed: " . $conn->error);
    }
}

function getMidwifeInformation($conn, $midwife_id) {
    // Prepare the SQL query to fetch midwife information including signature
    $query = "
        SELECT 
            m.*,
            pi.*,
            s.*
        FROM midwife m
        INNER JOIN personal_information pi 
            ON m.personal_info_id = pi.personal_info_id
        LEFT JOIN signatures s 
            ON m.signature_id = s.signature_id
        WHERE m.midwife_id = ?";

    // Prepare and execute the query
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $midwife_id); // Bind the midwife_id as an integer
        $stmt->execute();

        // Fetch the result
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // Return the fetched row as an associative array
            return $result->fetch_assoc();
        } else {
            return null; // No midwife found with the given ID
        }
    } else {
        // Handle query preparation errors
        die("Query failed: " . $conn->error);
    }
}

function getBhwInformation($conn, $bhw_id) {
    // Prepare the SQL query to fetch midwife information including signature
    $query = "
        SELECT 
            b.*,
            pi.*,
            s.*
        FROM bhw b
        INNER JOIN personal_information pi 
            ON b.personal_info_id = pi.personal_info_id
        LEFT JOIN signatures s 
            ON b.signature_id = b.signature_id
        WHERE b.bhw_id = ?";

    // Prepare and execute the query
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $bhw_id);
        $stmt->execute();

        // Fetch the result
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // Return the fetched row as an associative array
            return $result->fetch_assoc();
        } else {
            return null; // No midwife found with the given ID
        }
    } else {
        // Handle query preparation errors
        die("Query failed: " . $conn->error);
    }
}

function getBrgyCaptainDetails($conn, $brgy_captain_id) {
    // Prepare the SQL query to join `brgy_captain` and `signatures` tables
    $sql = "
        SELECT bc.brgy_captain_id, bc.full_name, s.signature_path
        FROM brgy_captain bc
        LEFT JOIN signatures s ON bc.signature_id = s.signature_id
        WHERE bc.brgy_captain_id = ?";
    
    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the brgy_captain_id parameter to the query
        $stmt->bind_param("i", $brgy_captain_id);
        
        // Execute the query
        $stmt->execute();
        
        // Bind the result variables
        $stmt->bind_result($brgy_captain_id, $full_name, $signature_path);
        
        // Fetch the result
        if ($stmt->fetch()) {
            // Store the result in an associative array
            $captainDetails = [
                'brgy_captain_id' => $brgy_captain_id,
                'full_name' => $full_name,
                'signature_path' => $signature_path
            ];
            
            // Close the statement
            $stmt->close();
            
            return $captainDetails;
        } else {
            // If no result is found
            return null;
        }
    } else {
        // If the query preparation fails
        return null;
    }
}



?>
