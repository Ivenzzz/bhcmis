<?php 

function getAllResidents($conn) {
    // SQL query to retrieve all residents with their personal information, address, and exclude invalid/rejected residents
    $sql = "
        SELECT 
            r.resident_id,  
            r.personal_info_id, 
            p.lastname, 
            p.firstname, 
            p.middlename, 
            p.date_of_birth, 
            p.address_id,
            p.civil_status,
            p.sex,
            p.isRegisteredVoter,  
            a.address_name, 
            a.address_type, 
            p.created_at, 
            p.updated_at,
            ac.*
        FROM 
            residents r
        LEFT JOIN 
            personal_information p ON r.personal_info_id = p.personal_info_id
        LEFT JOIN
            accounts ac ON r.account_id = ac.account_id
        LEFT JOIN 
            address a ON p.address_id = a.address_id
        WHERE 
            ac.isValid = 1 AND ac.isRejected = 0
        ORDER BY r.resident_id DESC
    ";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful and return data
    if ($result && $result->num_rows > 0) {
        $residents = [];
        while ($row = $result->fetch_assoc()) {
            // Check if date_of_birth is NULL
            if ($row['date_of_birth'] === null) {
                $row['age'] = null; // Set age as NULL
            } else {
                // Calculate the age based on the date of birth
                $dateOfBirth = new DateTime($row['date_of_birth']);
                $currentDate = new DateTime(); // Get the current date
                $age = $dateOfBirth->diff($currentDate)->y; // Get the difference in years
                $row['age'] = $age; // Add the age to the resident data
            }

            // Add the resident to the residents array
            $residents[] = $row;
        }

        // Return the array of residents with personal information, address, and age
        return $residents;
    } else {
        // Return an empty array if no results are found or query failed
        return [];
    }
}


function getFamiliesWithHeadAndAddress($conn) {
    // Prepare the SQL query
    $sql = "
        SELECT 
            f.family_id, 
            f.parent_family_id, 
            f.4PsMember, 
            f.isArchived AS family_isArchived,
            h.address_id,
            h.year_resided,
            h.housing_type,
            h.construction_materials,
            h.lighting_facilities,
            h.water_source,
            h.toilet_facility,
            h.recorded_by,
            h.isArchived AS household_isArchived,
            p.firstname AS family_head_firstname,
            p.lastname AS family_head_lastname,
            COUNT(hm.hm_id) AS num_members
        FROM families f
        JOIN household_members hm ON f.family_id = hm.family_id
        JOIN household h ON hm.household_id = h.household_id
        JOIN family_members fm ON f.family_id = fm.family_id  -- Join with family_members to get resident_id
        JOIN residents r ON fm.resident_id = r.resident_id  -- Join with residents to get personal_info_id
        JOIN personal_information p ON r.personal_info_id = p.personal_info_id  -- Join personal_information
        WHERE hm.family_id = f.family_id
        AND hm.isArchived = 0  -- Ensure we only consider active members
        AND f.isArchived = 0  -- Ensure we only consider active families
        AND fm.role = 'husband'  -- Ensure we only select the husband as the family head
        GROUP BY f.family_id, h.address_id, p.firstname, p.lastname
    ";

    // Execute the query
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch all rows and directly push to the $families array
        $families = [];
        while ($row = $result->fetch_assoc()) {
            // Store the retrieved family data
            $families[] = $row;
        }

        // Return the families data
        return $families;
    } else {
        // If no data is found
        return false;
    }
}

function getUnverifiedResidents($conn) {
    $query = "
        SELECT 
            r.resident_id,
            pi.*,
            a.*,
            ad.*
        FROM 
            residents r
        INNER JOIN 
            accounts a ON r.account_id = a.account_id
        INNER JOIN 
            personal_information pi ON r.personal_info_id = pi.personal_info_id
        INNER JOIN
            address ad ON pi.address_id = ad.address_id
        WHERE 
            a.isValid = 0 AND a.isRejected = 0
    ";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Preparation failed: " . $conn->error);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $residents = [];
    while ($row = $result->fetch_assoc()) {
        $residents[] = $row;
    }

    $stmt->close();
    return $residents;
}

function getRejectedResidents($conn) {
    $query = "
        SELECT 
            r.resident_id,
            pi.*,
            a.*,
            ad.*
        FROM 
            residents r
        INNER JOIN 
            accounts a ON r.account_id = a.account_id
        INNER JOIN 
            personal_information pi ON r.personal_info_id = pi.personal_info_id
        INNER JOIN
            address ad ON pi.address_id = ad.address_id
        WHERE 
            a.isValid = 0 AND a.isRejected = 1
    ";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Preparation failed: " . $conn->error);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $residents = [];
    while ($row = $result->fetch_assoc()) {
        $residents[] = $row;
    }

    $stmt->close();
    return $residents;
}

?>
