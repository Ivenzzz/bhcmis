<?php

function getResidentDetails($conn, $resident_id) {
    // Prepare the SQL query to retrieve resident details, family/household information, and account details
    $sql = "
        SELECT 
            r.resident_id, 
            r.account_id, 
            p.*,
            h.household_id,
            f.family_id,
            f.parent_family_id,
            f.4PsMember,
            fm.role AS family_role,
<<<<<<< HEAD
            a.*  -- Include account details (if available)
=======
            a.*
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
        FROM 
            residents r
        JOIN 
            personal_information p ON r.personal_info_id = p.personal_info_id
        LEFT JOIN 
            household h ON p.address_id = h.address_id
        LEFT JOIN 
            household_members hm ON h.household_id = hm.household_id
        LEFT JOIN 
            family_members fm ON hm.family_id = fm.family_id AND fm.resident_id = r.resident_id
        LEFT JOIN 
            families f ON fm.family_id = f.family_id
<<<<<<< HEAD
        LEFT JOIN  -- LEFT JOIN for accounts to handle residents without accounts
            accounts a ON r.account_id = a.account_id  
        WHERE 
            r.resident_id = ?";

=======
        JOIN 
            accounts a ON r.account_id = a.account_id  -- Join with the accounts table
        WHERE 
            r.resident_id = ?";
    
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the resident_id parameter
    $stmt->bind_param('i', $resident_id);

    // Execute the query
    $stmt->execute();

    // Store the result
    $result = $stmt->get_result();

    // Check if a resident was found
    if ($result->num_rows > 0) {
        // Fetch the first row of the resident's details
        $resident_details = $result->fetch_assoc();
    } else {
        // If no resident found, return false
        return false;
    }

<<<<<<< HEAD
    // Only include account details if the resident has an account
    if ($resident_details['account_id'] === null) {
        // Remove account details if no account exists
        unset($resident_details['account_id']);
        unset($resident_details['account_*']); // If there are other specific account-related fields
    }

=======
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
    // Now fetch the medical conditions for the resident
    $sql_medical_conditions = "
        SELECT
            rmc.rmc_id,
            rmc.status, 
            m.condition_name AS medical_condition,
            rmc.diagnosed_date AS condition_diagnosed_date
        FROM 
            residents_medical_condition rmc
        LEFT JOIN 
            medical_conditions m ON rmc.medical_conditions_id = m.medical_conditions_id
        WHERE 
            rmc.resident_id = ?";
<<<<<<< HEAD

=======
    
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
    // Prepare the statement for medical conditions
    $stmt_medical = $conn->prepare($sql_medical_conditions);

    // Bind the resident_id parameter
    $stmt_medical->bind_param('i', $resident_id);

    // Execute the query
    $stmt_medical->execute();

    // Store the result
    $result_medical = $stmt_medical->get_result();

    // Initialize an array to hold the medical conditions
    $medical_conditions = [];

    // Loop through the medical conditions result
    while ($row = $result_medical->fetch_assoc()) {
        $medical_conditions[] = [
            'condition_name' => $row['medical_condition'],
            'diagnosed_date' => $row['condition_diagnosed_date'],
            'rmc_id' => $row['rmc_id'],
            'status' => $row['status']
        ];
    }

    // Add the medical conditions to the resident details
    $resident_details['medical_conditions'] = $medical_conditions;

    // Close the statements
    $stmt->close();
    $stmt_medical->close();

<<<<<<< HEAD
    // Return the resident details with medical conditions (and account details if available)
=======
    // Return the resident details with medical conditions and account details
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
    return $resident_details;
}





<<<<<<< HEAD


=======
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
?>