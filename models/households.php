<?php

function getAllHouseholds($conn) {
    // SQL query to retrieve all household records along with the number of families, BHW name, and address name
    $sql = "
        SELECT 
            h.household_id, 
            h.address_id, 
            a.address_name,
            h.year_resided, 
            h.housing_type, 
            h.construction_materials, 
            h.lighting_facilities, 
            h.water_source, 
            h.toilet_facility, 
            CONCAT(p.firstname, ' ', p.lastname) AS bhw_name,  -- BHW full name
            COUNT(DISTINCT CASE WHEN f.isArchived = 0 THEN hm.family_id END) AS number_of_families  -- Count families that are not archived
        FROM 
            household h
        LEFT JOIN 
            household_members hm ON h.household_id = hm.household_id
        LEFT JOIN 
            families f ON hm.family_id = f.family_id AND f.isArchived = 0  -- Ensure only non-archived families are considered
        -- Join with the bhw table to get the BHW details
        LEFT JOIN 
            bhw b ON h.recorded_by = b.bhw_id
        -- Join with the personal_information table to get the BHW's name
        LEFT JOIN 
            personal_information p ON b.personal_info_id = p.personal_info_id
        -- Join with the address table to get the address name
        LEFT JOIN 
            address a ON h.address_id = a.address_id
        GROUP BY 
            h.household_id
    ";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful and return data
    if ($result && $result->num_rows > 0) {
        $households = [];
        while ($row = $result->fetch_assoc()) {
            $households[] = $row;
        }

        // Return the array of households with the family count, BHW name, and address name
        return $households;
    } else {
        // Return an empty array if no results are found or query failed
        return [];
    }
}

function getFamiliesByHouseholdId($conn, $household_id) {
    // SQL query to retrieve families, head of the family, family name, number of members, and parent family name with family_id
    $sql = "
        SELECT 
            f.family_id, 
            f.parent_family_id, 
            f.4PsMember,
            CONCAT(pi.lastname, ' Family') AS family_name, 
            CONCAT(pi.firstname, ' ', pi.lastname) AS head_of_family,
            (SELECT COUNT(*) 
             FROM family_members fm 
             WHERE fm.family_id = f.family_id) AS number_of_members,
            (SELECT CONCAT(pi2.lastname, ' Family - ', pf.family_id)
             FROM families pf
             LEFT JOIN family_members pfm ON pf.family_id = pfm.family_id AND pfm.role = 'husband'
             LEFT JOIN residents r2 ON pfm.resident_id = r2.resident_id
             LEFT JOIN personal_information pi2 ON r2.personal_info_id = pi2.personal_info_id
             WHERE pf.family_id = f.parent_family_id
             LIMIT 1) AS parent_family
        FROM 
            families f
        LEFT JOIN 
            family_members fm ON f.family_id = fm.family_id AND fm.role = 'husband'
        LEFT JOIN 
            residents r ON fm.resident_id = r.resident_id
        LEFT JOIN 
            personal_information pi ON r.personal_info_id = pi.personal_info_id
        WHERE 
            f.isArchived = 0 AND  -- Only include families that are not archived
            f.family_id IN (
                SELECT hm.family_id 
                FROM household_members hm 
                WHERE hm.household_id = ?
            )
    ";

    // Prepare and execute the query
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $household_id);  // Bind the household_id as an integer
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if there are any families
        if ($result && $result->num_rows > 0) {
            $families = [];
            while ($row = $result->fetch_assoc()) {
                $families[] = $row;
            }
            return $families;  // Return the families data
        } else {
            return [];  // No families found
        }
    } else {
        // Handle query preparation failure
        echo "Error preparing the query.";
        return [];
    }
}

function getFamilyMembersByFamilyId($conn, $family_id) {
    // SQL query to retrieve family members with optimized joins, excluding archived members
    $sql = "
        SELECT 
            fm.fmember_id,
            fm.role,
            r.resident_id,
            pi.*,
            TIMESTAMPDIFF(YEAR, pi.date_of_birth, CURDATE()) AS age, -- Calculate age
            COALESCE(
                (SELECT pi_head.lastname 
                 FROM family_members fm_head
                 LEFT JOIN residents r_head ON fm_head.resident_id = r_head.resident_id
                 LEFT JOIN personal_information pi_head ON r_head.personal_info_id = pi_head.personal_info_id
                 WHERE fm_head.family_id = fm.family_id AND fm_head.role = 'husband'
                 LIMIT 1
                ), 'Unknown Family'
            ) AS family_name,
            -- Check if the child has their own family
            f_child.family_id AS child_family_id
        FROM 
            family_members fm
        LEFT JOIN 
            residents r ON fm.resident_id = r.resident_id
        LEFT JOIN 
            personal_information pi ON r.personal_info_id = pi.personal_info_id
        LEFT JOIN
            families f_child ON f_child.parent_family_id = fm.family_id AND fm.role = 'child' AND f_child.isArchived = 0
        WHERE 
            fm.family_id = ? AND fm.isArchived = 0
    ";

    // Prepare and execute the query
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $family_id);  // Bind the family_id as an integer
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if there are any members
        if ($result && $result->num_rows > 0) {
            $members = [];
            while ($row = $result->fetch_assoc()) {
                $members[] = $row;
            }
            return $members;  // Return the family members data
        } else {
            return [];  // No members found
        }
    } else {
        // Handle query preparation failure
        echo "Error preparing the query.";
        return [];
    }
}


function getHouseholdsByBhwId($conn, $bhw_id) {
    $query = "
        SELECT 
            h.*, 
            a.address_name, 
            a.address_type, 
            COUNT(DISTINCT hm.family_id) AS number_of_families
        FROM 
            household h
        INNER JOIN address a ON h.address_id = a.address_id
        INNER JOIN bhw b ON b.assigned_area = a.address_id
        LEFT JOIN household_members hm ON h.household_id = hm.household_id
        WHERE b.bhw_id = ? AND h.isArchived = 0
        GROUP BY h.household_id
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $bhw_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $households = [];

    while ($row = $result->fetch_assoc()) {
        $households[] = $row;
    }

    return $households;
}

function getAssignedArea($conn) {
    // Ensure that the session is started
    if (!isset($_SESSION)) {
        session_start();
    }

    // Check if bhw_id is available in session
    if (!isset($_SESSION['bhw_id'])) {
        return null;  // BHW ID not found in session
    }

    $bhw_id = $_SESSION['bhw_id'];

    // Prepare the SQL query to fetch both assigned_area (address_id) and address_name based on the BHW
    $query = "
        SELECT b.assigned_area, a.address_name
        FROM bhw b
        INNER JOIN address a ON b.assigned_area = a.address_id
        WHERE b.bhw_id = ?
    ";

    // Prepare the statement
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $bhw_id);
    
    // Execute the statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Fetch the assigned area (address_id) and address_name if it exists
    if ($row = $result->fetch_assoc()) {
        return [
            'assigned_area_id' => $row['assigned_area'], // address_id
            'assigned_area_name' => $row['address_name'] // address_name
        ];
    }

    // Return null if no result found
    return null;
}






?>
