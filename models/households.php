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
            COUNT(DISTINCT hm.family_id) AS number_of_families  -- Number of families in the household
        FROM 
            household h
        LEFT JOIN 
            household_members hm ON h.household_id = hm.household_id
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
    // SQL query to retrieve families, head of the family, family name, number of members, and parent family name
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
            (SELECT CONCAT(pi2.lastname, ' Family')
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
    // SQL query to retrieve family members, the family name, and age
    $sql = "
        SELECT 
            fm.fmember_id,
            fm.role,
            r.resident_id,
            pi.firstname,
            pi.lastname,
            pi.middlename,
            pi.date_of_birth,
            pi.sex,
            pi.civil_status,
            pi.educational_attainment,
            pi.occupation,
            TIMESTAMPDIFF(YEAR, pi.date_of_birth, CURDATE()) AS age, -- Calculate age
            CONCAT(
                (SELECT pi_head.lastname 
                 FROM family_members fm_head
                 LEFT JOIN residents r_head ON fm_head.resident_id = r_head.resident_id
                 LEFT JOIN personal_information pi_head ON r_head.personal_info_id = pi_head.personal_info_id
                 WHERE fm_head.family_id = fm.family_id AND fm_head.role = 'husband'
                 LIMIT 1
                ), ' Family'
            ) AS family_name
        FROM 
            family_members fm
        LEFT JOIN 
            residents r ON fm.resident_id = r.resident_id
        LEFT JOIN 
            personal_information pi ON r.personal_info_id = pi.personal_info_id
        WHERE 
            fm.family_id = ?
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


?>
