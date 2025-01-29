<?php 

function getReferralByConsultationId($conn, $consultationId) {
    $sql = "SELECT 
                rr.*,
                CONCAT(pi.firstname, ' ', pi.middlename, ' ', pi.lastname) AS patient_name,
                pi.sex,
                TIMESTAMPDIFF(YEAR, pi.date_of_birth, CURDATE()) AS age,
                pi.religion,
                pi.occupation,
                pi.date_of_birth,
                pi.phone_number,
                pi.email,
                c.blood_pressure,
                c.weight_kg,
                c.temperature,
                c.heart_rate
            FROM referral_requests rr
            JOIN residents r ON rr.resident_id = r.resident_id
            JOIN personal_information pi ON r.personal_info_id = pi.personal_info_id
            LEFT JOIN consultations c ON rr.consultation_id = c.consultation_id
            WHERE rr.consultation_id = ?";

    // Rest of the function remains the same
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        error_log("SQL prepare failed: " . $conn->error);
        return false;
    }

    $stmt->bind_param("i", $consultationId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        $stmt->close();
        return false;
    }

    $referral = $result->fetch_assoc();
    $stmt->close();
    
    return $referral;
}

function getConsultationDetails($consultation_id) {
    global $conn;

    $query = "
        SELECT 
            consultations.*,
            personal_information.*
        FROM consultations
        INNER JOIN residents ON consultations.resident_id = residents.resident_id
        INNER JOIN personal_information ON residents.personal_info_id = personal_information.personal_info_id
        WHERE consultations.consultation_id = ?
    ";

    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        return ['error' => 'Database preparation error: ' . $conn->error];
    }

    $stmt->bind_param("i", $consultation_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        return ['error' => 'No consultation found with that ID'];
    }

    $consultationData = $result->fetch_assoc();
    $stmt->close();

    // Calculate age from date_of_birth
    if (!empty($consultationData['date_of_birth'])) {
        $dob = new DateTime($consultationData['date_of_birth']);
        $today = new DateTime();
        $age = $today->diff($dob)->y;
        $consultationData['age'] = $age;
    } else {
        $consultationData['age'] = null;
    }

    return $consultationData;
}

function getReferralByReferralId($conn, $referral_id) {
    $sql = "
        SELECT rr.*,
               r.*,  
               c.*,
               pi.*,
               TIMESTAMPDIFF(YEAR, pi.date_of_birth, CURDATE()) AS age 
        FROM referral_requests rr
        LEFT JOIN consultations c ON rr.consultation_id = c.consultation_id
        JOIN residents r ON rr.resident_id = r.resident_id
        JOIN personal_information pi ON r.personal_info_id = pi.personal_info_id
        WHERE rr.referral_id = ?
    ";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Query preparation failed: " . $conn->error);
    }

    $stmt->bind_param("i", $referral_id);

    if (!$stmt->execute()) {
        die("Execution failed: " . $stmt->error);
    }

    $result = $stmt->get_result();
    if (!$result) {
        die("Getting result failed: " . $stmt->error);
    }

    $referral = $result->fetch_assoc();
    $stmt->close();

    return $referral ?: null;
}



?>