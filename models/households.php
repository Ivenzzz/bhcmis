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
    // Prepare the SQL query to retrieve families for the specified household_id
    $sql = "
        SELECT 
            f.family_id, 
            f.parent_family_id, 
            f.4PsMember,
            fm.role, 
            p.firstname, 
            p.lastname 
        FROM 
            families f
        LEFT JOIN 
            family_members fm ON f.family_id = fm.family_id
        LEFT JOIN 
            residents r ON fm.resident_id = r.resident_id
        LEFT JOIN 
            personal_information p ON r.personal_info_id = p.personal_info_id
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



?>
