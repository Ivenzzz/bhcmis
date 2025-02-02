<?php
header('Content-Type: application/json');
require '../partials/global_db_config.php';

$household_id = isset($_GET['household_id']) ? intval($_GET['household_id']) : 0;

if ($household_id <= 0) {
    echo json_encode(['message' => 'Invalid household_id']);
    exit;
}

// Modified query to include resident names
$query = "
    WITH RECURSIVE family_hierarchy AS (
        SELECT 
            f.family_id,
            fm.fmember_id,
            fm.resident_id,
            fm.role,
            fm.own_family_id,
            p.firstname,
            p.lastname,
            0 AS level
        FROM household h
        JOIN household_members hm ON h.household_id = hm.household_id
        JOIN families f ON f.family_id = hm.family_id
        JOIN family_members fm ON fm.family_id = f.family_id
        LEFT JOIN residents r ON fm.resident_id = r.resident_id
        LEFT JOIN personal_information p ON r.personal_info_id = p.personal_info_id
        WHERE h.household_id = ? 
          AND hm.isArchived = 0 
          AND f.isArchived = 0 
          AND fm.isArchived = 0
        
        UNION ALL
        
        SELECT 
            f.family_id,
            fm.fmember_id,
            fm.resident_id,
            fm.role,
            fm.own_family_id,
            p.firstname,
            p.lastname,
            fh.level + 1 AS level
        FROM family_hierarchy fh
        JOIN families f ON f.family_id = fh.own_family_id
        JOIN family_members fm ON fm.family_id = f.family_id
        LEFT JOIN residents r ON fm.resident_id = r.resident_id
        LEFT JOIN personal_information p ON r.personal_info_id = p.personal_info_id
        WHERE fh.role = 'child'
          AND fh.own_family_id IS NOT NULL
          AND f.isArchived = 0
          AND fm.isArchived = 0
    )
    SELECT * FROM family_hierarchy;
";

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $household_id);
$stmt->execute();
$result = $stmt->get_result();
$rows = $result->fetch_all(MYSQLI_ASSOC);

$families = [];
foreach ($rows as $row) {
    $familyId = $row['family_id'];
    if (!isset($families[$familyId])) {
        $families[$familyId] = [
            'family_id' => $familyId,
            'members' => [],
        ];
    }
    
    // Create unique member key with additional fields
    $memberKey = $row['resident_id'] . '_' . $row['role'] . '_' . $row['own_family_id'];
    
    if (!isset($families[$familyId]['members'][$memberKey])) {
        $families[$familyId]['members'][$memberKey] = [
            'resident_id' => $row['resident_id'],
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            'role' => $row['role'],
            'own_family_id' => $row['own_family_id'],
            'child_family' => null,
        ];
    }
}

// Convert members to list and link child families
foreach ($families as &$family) {
    $family['members'] = array_values($family['members']);
    foreach ($family['members'] as &$member) {
        if ($member['role'] === 'child' && $member['own_family_id']) {
            $childFamilyId = $member['own_family_id'];
            if (isset($families[$childFamilyId])) {
                $member['child_family'] = $families[$childFamilyId];
            }
        }
    }
}

// Collect root families (level 0)
$rootFamilies = [];
foreach ($rows as $row) {
    if ($row['level'] == 0 && !isset($rootFamilies[$row['family_id']])) {
        $rootFamilies[$row['family_id']] = $families[$row['family_id']];
    }
}

echo json_encode(array_values($rootFamilies));

$stmt->close();
$conn->close();
?>