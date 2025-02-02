<?php 

function getAllResidents($conn) {
<<<<<<< HEAD
    // SQL query to get distinct residents who belong to multiple families as one
=======
    // SQL query to retrieve all residents with their personal information, address, and exclude invalid/rejected residents
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
    $sql = "
        SELECT 
            r.resident_id,  
            r.personal_info_id, 
            p.lastname, 
            p.firstname, 
            p.middlename, 
            p.date_of_birth, 
<<<<<<< HEAD
            h.address_id AS household_address_id, -- Fetch household address instead
            p.civil_status,
            p.sex,
            p.isRegisteredVoter,
            p.isTransferred,
            p.isDeceased, 
            ha.address_name AS household_address_name,  -- Household Address Name
            ha.address_type AS household_address_type,  -- Household Address Type
            p.created_at, 
            p.updated_at,
            COALESCE(ac.account_id, NULL) AS account_id,
            COALESCE(ac.username, NULL) AS username,
            COALESCE(ac.isValid, 0) AS isValid,
            COALESCE(ac.isRejected, 0) AS isRejected,
            h.household_id, 
            h.year_resided,
            h.housing_type,
            h.construction_materials,
            h.lighting_facilities,
            h.water_source,
            h.toilet_facility,
            h.recorded_by,
            h.isArchived AS household_isArchived,
            MIN(f.family_id) AS family_id,  -- Ensures a single record per resident
            MIN(f.parent_family_id) AS parent_family_id,
            MIN(f.4PsMember) AS 4PsMember,
            MIN(f.isArchived) AS family_isArchived,
            GROUP_CONCAT(DISTINCT fm.role) AS family_member_role,  -- List all roles
            MIN(fm.own_family_id) AS own_family_id,
            MIN(fm.isArchived) AS family_member_isArchived
        FROM 
            family_members fm
        LEFT JOIN 
            residents r ON fm.resident_id = r.resident_id
        LEFT JOIN 
            personal_information p ON r.personal_info_id = p.personal_info_id
        LEFT JOIN 
            accounts ac ON r.account_id = ac.account_id
        LEFT JOIN 
            families f ON fm.family_id = f.family_id
        LEFT JOIN 
            household_members hm ON f.family_id = hm.family_id
        LEFT JOIN 
            household h ON hm.household_id = h.household_id
        LEFT JOIN 
            address ha ON h.address_id = ha.address_id  -- Join with household address
        WHERE 
            (ac.account_id IS NULL OR (ac.isValid = 1 AND ac.isRejected = 0))
            AND h.isArchived = 0         -- Household not archived
            AND hm.isArchived = 0        -- Household member not archived
            AND f.isArchived = 0         -- Family not archived
            AND fm.isArchived = 0        -- Family member not archived
            AND (p.isDeceased = 0 OR p.isDeceased IS NULL)  -- Exclude deceased residents
            AND (p.isTransferred = 0 OR p.isTransferred IS NULL)  -- Exclude transferred residents
        GROUP BY r.resident_id  -- Ensures each resident appears only once
=======
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
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
        ORDER BY r.resident_id DESC
    ";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful and return data
    if ($result && $result->num_rows > 0) {
        $residents = [];
        while ($row = $result->fetch_assoc()) {
<<<<<<< HEAD
            // Calculate age if date_of_birth is not NULL
            if ($row['date_of_birth'] !== null) {
                $dateOfBirth = new DateTime($row['date_of_birth']);
                $currentDate = new DateTime();
                $age = $dateOfBirth->diff($currentDate)->y;
                $row['age'] = $age;
            } else {
                $row['age'] = null;
=======
            // Check if date_of_birth is NULL
            if ($row['date_of_birth'] === null) {
                $row['age'] = null; // Set age as NULL
            } else {
                // Calculate the age based on the date of birth
                $dateOfBirth = new DateTime($row['date_of_birth']);
                $currentDate = new DateTime(); // Get the current date
                $age = $dateOfBirth->diff($currentDate)->y; // Get the difference in years
                $row['age'] = $age; // Add the age to the resident data
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
            }

            // Add the resident to the residents array
            $residents[] = $row;
        }

<<<<<<< HEAD
        // Return the array of distinct residents
=======
        // Return the array of residents with personal information, address, and age
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
        return $residents;
    } else {
        // Return an empty array if no results are found or query failed
        return [];
    }
}


<<<<<<< HEAD






=======
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
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
