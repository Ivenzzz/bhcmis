<?php 

function getTotalResidents($conn) {
    $sql = "SELECT COUNT(*) AS total_residents 
            FROM residents r
            INNER JOIN personal_information pi ON r.personal_info_id = pi.personal_info_id
            WHERE pi.isTransferred = 0 AND pi.deceased_date IS NULL";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_residents'];
    } else {
        return 0;
    }
}

function getTotalHouseholds($conn) {
    $sql = "SELECT COUNT(*) AS total_households FROM household";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_households'];
    } else {
        return 0;
    }
}

function getTotalFamilies($conn) {
    $sql = "SELECT COUNT(*) AS total_families FROM families";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_families'];
    } else {
        return 0;
    }
}

function getTotalTransferredResidents($conn) {
    // SQL query to count residents who are transferred
    $sql = "SELECT COUNT(*) AS total_transferred
            FROM personal_information
            WHERE isTransferred = 1";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result && $row = $result->fetch_assoc()) {
        // Return the count of transferred residents
        return $row['total_transferred'];
    } else {
        // Return 0 if query failed or no data found
        return 0;
    }
}

function getTotalDeceasedResidents($conn) {
    // SQL query to count residents with a deceased_date
    $sql = "SELECT COUNT(*) AS total_deceased
            FROM personal_information
            WHERE deceased_date IS NOT NULL";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result && $row = $result->fetch_assoc()) {
        // Return the count of deceased residents
        return $row['total_deceased'];
    } else {
        // Return 0 if query failed or no data found
        return 0;
    }
}

function getPerAreaStats($conn) {
    // SQL query to retrieve population statistics by address
    $sql = "
        SELECT 
            a.address_name, 
            a.address_type, 
            COUNT(DISTINCT h.household_id) AS total_households,
            COUNT(DISTINCT f.family_id) AS total_families,
            COUNT(DISTINCT r.resident_id) AS total_residents,
            COUNT(DISTINCT CASE WHEN p.sex = 'female' THEN r.resident_id END) AS total_females,
            COUNT(DISTINCT CASE WHEN p.sex = 'male' THEN r.resident_id END) AS total_males,
            COUNT(DISTINCT CASE WHEN TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) >= 60 THEN r.resident_id END) AS total_seniors,
            COUNT(DISTINCT CASE WHEN TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) <= 12 THEN r.resident_id END) AS total_children,
            SUM(DISTINCT CASE WHEN p.isTransferred = 1 THEN 1 ELSE 0 END) AS total_transferred,
            SUM(DISTINCT CASE WHEN p.isDeceased = 1 THEN 1 ELSE 0 END) AS total_deceased
        FROM 
            address a
        LEFT JOIN 
            household h ON a.address_id = h.address_id
        LEFT JOIN 
            household_members hm ON h.household_id = hm.household_id
        LEFT JOIN 
            families f ON hm.family_id = f.family_id
        LEFT JOIN 
            family_members fm ON f.family_id = fm.family_id
        LEFT JOIN
            residents r ON fm.resident_id = r.resident_id
        LEFT JOIN 
            personal_information p ON r.personal_info_id = p.personal_info_id
        GROUP BY 
            a.address_id
        ORDER BY 
            a.address_name;
    ";

    // Execute the query using mysqli
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result && $result->num_rows > 0) {
        $statistics = [];
        while ($row = $result->fetch_assoc()) {
            $statistics[] = [
                'address_name' => $row['address_name'],
                'address_type' => $row['address_type'],
                'total_households' => $row['total_households'],
                'total_families' => $row['total_families'],
                'total_residents' => $row['total_residents'],
                'total_females' => $row['total_females'],
                'total_males' => $row['total_males'],
                'total_seniors' => $row['total_seniors'],
                'total_children' => $row['total_children'],
                'total_transferred' => $row['total_transferred'],
                'total_deceased' => $row['total_deceased']
            ];
        }
        return $statistics;
    } else {
        return [];
    }
}

function getTransferredResidents($conn) {
    try {
        $transferredResidents = [];
        
        $sql = "SELECT 
                r.resident_id,
                p.lastname,
                p.firstname,
                p.middlename,
                p.date_of_birth,
                p.sex,
                p.isTransferred,
                p.updated_at AS transfer_date
                FROM residents r
                INNER JOIN personal_information p 
                ON r.personal_info_id = p.personal_info_id
                WHERE p.isTransferred = 1
                AND r.isArchived = 0
                ORDER BY p.updated_at DESC";

        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $transferredResidents[] = $row;
        }
        
        $stmt->close();
        return $transferredResidents;
        
    } catch (Exception $e) {
        // Handle error (you might want to log this instead)
        throw new Exception("Error fetching transferred residents: " . $e->getMessage());
    }
}

function getDeceasedResidents($conn) {
    try {
        $deceasedResidents = [];
        
        $sql = "SELECT 
                r.resident_id,
                p.lastname,
                p.firstname,
                p.middlename,
                p.date_of_birth,
                p.sex,
                p.isDeceased,
                p.deceased_date,
                p.updated_at AS deceased_updated_at
                FROM residents r
                INNER JOIN personal_information p 
                ON r.personal_info_id = p.personal_info_id
                WHERE p.isDeceased = 1
                AND r.isArchived = 0
                ORDER BY p.deceased_date DESC";

        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $deceasedResidents[] = $row;
        }
        
        $stmt->close();
        return $deceasedResidents;
        
    } catch (Exception $e) {
        // Handle error (you might want to log this instead)
        throw new Exception("Error fetching deceased residents: " . $e->getMessage());
    }
}






?>