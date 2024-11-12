<?php
require '../../config/db_config.php';

// Check if the POST request contains 'address_id'
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['address_id'])) {
    $address_id = $_POST['address_id'];

    // Initialize variables for queries
    $total_residents = 0;
    $age_groups_result = [
        'age_0_12' => 0,
        'age_13_18' => 0,
        'age_19_59' => 0,
        'age_60_plus' => 0
    ];
    $total_children_0_12 = 0;
    $gender_result = [
        'total_males' => 0,
        'total_females' => 0
    ];

    // If a specific address is selected
    if (!empty($address_id)) {
        // Query to get total residents for the selected address
        $sql_total_residents = "
            SELECT COUNT(*) as total_residents 
            FROM residents r
            INNER JOIN personal_information pi ON r.personal_info_id = pi.personal_info_id
            WHERE pi.address_id = ? AND r.isValidResident = 1";
        
        $stmt1 = $conn->prepare($sql_total_residents);
        $stmt1->bind_param("i", $address_id);
        $stmt1->execute();
        $result = $stmt1->get_result()->fetch_assoc();
        $total_residents = $result['total_residents'];

        // Query to get population breakdown by age group for residents
        $sql_age_groups = "
            SELECT 
                SUM(CASE WHEN TIMESTAMPDIFF(YEAR, pi.date_of_birth, CURDATE()) BETWEEN 0 AND 12 THEN 1 ELSE 0 END) as age_0_12,
                SUM(CASE WHEN TIMESTAMPDIFF(YEAR, pi.date_of_birth, CURDATE()) BETWEEN 13 AND 18 THEN 1 ELSE 0 END) as age_13_18,
                SUM(CASE WHEN TIMESTAMPDIFF(YEAR, pi.date_of_birth, CURDATE()) BETWEEN 19 AND 59 THEN 1 ELSE 0 END) as age_19_59,
                SUM(CASE WHEN TIMESTAMPDIFF(YEAR, pi.date_of_birth, CURDATE()) >= 60 THEN 1 ELSE 0 END) as age_60_plus
            FROM residents r
            INNER JOIN personal_information pi ON r.personal_info_id = pi.personal_info_id
            WHERE pi.address_id = ? AND r.isValidResident = 1";
        
        $stmt2 = $conn->prepare($sql_age_groups);
        $stmt2->bind_param("i", $address_id);
        $stmt2->execute();
        $age_groups_result = $stmt2->get_result()->fetch_assoc();

        // Query to get the number of children whose guardian lives in the selected address
        $sql_children = "
        SELECT COUNT(*) as total_children_0_12
        FROM children c
        INNER JOIN residents r ON c.guardian_id = r.personal_info_id
        INNER JOIN personal_information pi ON r.personal_info_id = pi.personal_info_id
        WHERE pi.address_id = ?";

        $stmt3 = $conn->prepare($sql_children);
        $stmt3->bind_param("i", $address_id);
        $stmt3->execute();
        $children_result = $stmt3->get_result()->fetch_assoc();
        $total_children_0_12 = $children_result['total_children_0_12'];

        // Query to get population breakdown by gender for residents
        $sql_gender = "
        SELECT 
            SUM(CASE WHEN pi.sex = 'male' THEN 1 ELSE 0 END) as total_males,
            SUM(CASE WHEN pi.sex = 'female' THEN 1 ELSE 0 END) as total_females
        FROM residents r
        INNER JOIN personal_information pi ON r.personal_info_id = pi.personal_info_id
        WHERE pi.address_id = ? AND r.isValidResident = 1";

        $stmt4 = $conn->prepare($sql_gender);
        $stmt4->bind_param("i", $address_id);
        $stmt4->execute();
        $gender_result = $stmt4->get_result()->fetch_assoc();

    } 
    // If no address is selected, fetch data for all areas
    else {
        // Query to get total residents for all addresses
        $sql_total_residents = "
            SELECT COUNT(*) as total_residents 
            FROM residents r
            INNER JOIN personal_information pi ON r.personal_info_id = pi.personal_info_id
            WHERE r.isValidResident = 1";
        
        $total_residents = $conn->query($sql_total_residents)->fetch_assoc()['total_residents'];

        // Query to get population breakdown by age group for all residents
        $sql_age_groups = "
            SELECT 
                SUM(CASE WHEN TIMESTAMPDIFF(YEAR, pi.date_of_birth, CURDATE()) BETWEEN 0 AND 12 THEN 1 ELSE 0 END) as age_0_12,
                SUM(CASE WHEN TIMESTAMPDIFF(YEAR, pi.date_of_birth, CURDATE()) BETWEEN 13 AND 18 THEN 1 ELSE 0 END) as age_13_18,
                SUM(CASE WHEN TIMESTAMPDIFF(YEAR, pi.date_of_birth, CURDATE()) BETWEEN 19 AND 59 THEN 1 ELSE 0 END) as age_19_59,
                SUM(CASE WHEN TIMESTAMPDIFF(YEAR, pi.date_of_birth, CURDATE()) >= 60 THEN 1 ELSE 0 END) as age_60_plus
            FROM residents r
            INNER JOIN personal_information pi ON r.personal_info_id = pi.personal_info_id
            WHERE r.isValidResident = 1";
        
        $age_groups_result = $conn->query($sql_age_groups)->fetch_assoc();

        // Query to get the number of children from all areas
        $sql_children = "
        SELECT COUNT(*) as total_children_0_12
        FROM children c
        INNER JOIN residents r ON c.guardian_id = r.personal_info_id";
        
        $total_children_0_12 = $conn->query($sql_children)->fetch_assoc()['total_children_0_12'];

        // Query to get population breakdown by gender for all residents
        $sql_gender = "
        SELECT 
            SUM(CASE WHEN pi.sex = 'male' THEN 1 ELSE 0 END) as total_males,
            SUM(CASE WHEN pi.sex = 'female' THEN 1 ELSE 0 END) as total_females
        FROM residents r
        INNER JOIN personal_information pi ON r.personal_info_id = pi.personal_info_id
        WHERE r.isValidResident = 1";
        
        $gender_result = $conn->query($sql_gender)->fetch_assoc();
    }

    $age_0_12_total = $age_groups_result['age_0_12'] + $total_children_0_12;

    echo json_encode([
        'total_residents' => $total_residents,
        'age_groups' => [
            $age_0_12_total,
            $age_groups_result['age_13_18'],
            $age_groups_result['age_19_59'],
            $age_groups_result['age_60_plus']
        ],
        'gender_distribution' => [
            'male' => $gender_result['total_males'],
            'female' => $gender_result['total_females']
        ]
    ]);
}
?>
