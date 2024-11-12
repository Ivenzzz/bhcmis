<?php

session_start();
require '../../../config/db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        mysqli_autocommit($conn, false);

        // Insert Household data
        $addressId = $_POST['address'];
        $yearResided = $_POST['year_resided'];
        $housingType = $_POST['housing_type'];
        $constructionMaterials = $_POST['construction_materials'];
        $lightingFacilities = $_POST['lighting_facilities'];
        $waterSource = $_POST['water_source'];
        $toiletFacility = $_POST['toilet_facility'];
        $recordedBy = $_POST['bhw_id'];

        // Prepare statement with year_resided
        $stmt = mysqli_prepare($conn, "
            INSERT INTO household (address_id, year_resided, housing_type, construction_materials, lighting_facilities, water_source, toilet_facility, recorded_by) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        mysqli_stmt_bind_param($stmt, "iisssssi", $addressId, $yearResided, $housingType, $constructionMaterials, $lightingFacilities, $waterSource, $toiletFacility, $recordedBy);

        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Failed to insert household: " . mysqli_stmt_error($stmt));
        }
        $householdId = mysqli_insert_id($conn);

        $numFamilies = $_POST['num_families'];
        $parentFamilyId = null;

        for ($i = 1; $i <= $numFamilies; $i++) {
            $is4PsMember = isset($_POST["4PsMember_$i"]) ? 1 : 0;

            // Insert main family and capture the family_id as the parent family
            $stmt = mysqli_prepare($conn, "INSERT INTO families (4PsMember) VALUES (?)");
            mysqli_stmt_bind_param($stmt, "i", $is4PsMember);
            mysqli_stmt_execute($stmt);
            $familyId = mysqli_insert_id($conn);

            // Store the first family as the parent family for subsequent sub-families
            if ($i == 1) {
                $parentFamilyId = $familyId;
            }

            // Insert the family-member relation with the household
            $stmt = mysqli_prepare($conn, "INSERT INTO household_members (household_id, family_id) VALUES (?, ?)");
            mysqli_stmt_bind_param($stmt, "ii", $householdId, $familyId);
            mysqli_stmt_execute($stmt);

            // Collect member data
            $memberData = [];
            foreach ($_POST as $key => $value) {
                if (preg_match("/^(role|lastname|firstname|middlename|date_of_birth|civil_status|educational_attainment|occupation|religion|citizenship|sex|phone_number|email)_{$i}_(\d+)$/", $key, $matches)) {
                    $memberIndex = $matches[2];
                    $memberData[$memberIndex][$matches[1]] = $value;
                }
            }

            // Insert member details
            foreach ($memberData as $memberIndex => $member) {
                $stmt = mysqli_prepare($conn, "
                    INSERT INTO personal_information (lastname, firstname, middlename, date_of_birth, civil_status, educational_attainment, occupation, religion, citizenship, address_id, sex, phone_number, email)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ");
                mysqli_stmt_bind_param($stmt, "ssssssssissss", 
                    $member['lastname'], 
                    $member['firstname'], 
                    $member['middlename'], 
                    $member['date_of_birth'], 
                    $member['civil_status'], 
                    $member['educational_attainment'], 
                    $member['occupation'], 
                    $member['religion'], 
                    $member['citizenship'], 
                    $addressId, 
                    $member['sex'], 
                    $member['phone_number'], 
                    $member['email']
                );
                mysqli_stmt_execute($stmt);
                $personalInfoId = mysqli_insert_id($conn);

                // Insert resident data
                $stmt = mysqli_prepare($conn, "INSERT INTO residents (account_id, personal_info_id) VALUES (NULL, ?)");
                mysqli_stmt_bind_param($stmt, "i", $personalInfoId);
                mysqli_stmt_execute($stmt);
                $residentId = mysqli_insert_id($conn);

                // Insert family_member data
                $stmt = mysqli_prepare($conn, "INSERT INTO family_members (family_id, resident_id, role) VALUES (?, ?, ?)");
                mysqli_stmt_bind_param($stmt, "iis", $familyId, $residentId, $member['role']);
                mysqli_stmt_execute($stmt);

                // Sub-family handling
                $subFamilyData = [];
                foreach ($_POST as $subKey => $subValue) {
                    if (preg_match("/^(sub_role|sub_lastname|sub_firstname|sub_middlename|sub_date_of_birth|sub_civil_status|sub_educational_attainment|sub_occupation|sub_religion|sub_citizenship|sub_sex|sub_phone_number|sub_email)_{$i}_{$memberIndex}_(\d+)$/", $subKey, $subMatches)) {
                        $subFamilyIndex = $subMatches[3];
                        $subFamilyData[$subFamilyIndex][$subMatches[1]] = $subValue;
                    }
                }

                foreach ($subFamilyData as $subFamilyIndex => $subMember) {
                    $checkboxName = "4PsMember_{$i}_{$memberIndex}_{$subFamilyIndex}";
                    $isSubFamily4PsMember = isset($_POST[$checkboxName]) ? 1 : 0;
                
                    // Insert sub-family with the parent_family_id
                    $stmt = mysqli_prepare($conn, "
                        INSERT INTO families (4PsMember, parent_family_id) VALUES (?, ?)
                    ");
                    mysqli_stmt_bind_param($stmt, "ii", $isSubFamily4PsMember, $parentFamilyId);
                    mysqli_stmt_execute($stmt);
                    $subFamilyId = mysqli_insert_id($conn);
                
                    // Insert sub-member's personal information
                    $stmt = mysqli_prepare($conn, "
                        INSERT INTO personal_information (lastname, firstname, middlename, date_of_birth, civil_status, educational_attainment, occupation, religion, citizenship, address_id, sex, phone_number, email)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                    ");
                    mysqli_stmt_bind_param($stmt, "ssssssssissss", 
                        $subMember['sub_lastname'], 
                        $subMember['sub_firstname'], 
                        $subMember['sub_middlename'], 
                        $subMember['sub_date_of_birth'], 
                        $subMember['sub_civil_status'], 
                        $subMember['sub_educational_attainment'], 
                        $subMember['sub_occupation'], 
                        $subMember['sub_religion'], 
                        $subMember['sub_citizenship'], 
                        $addressId, 
                        $subMember['sub_sex'], 
                        $subMember['sub_phone_number'], 
                        $subMember['sub_email']
                    );
                    mysqli_stmt_execute($stmt);
                    $subPersonalInfoId = mysqli_insert_id($conn);
                
                    // Insert sub-resident
                    $stmt = mysqli_prepare($conn, "INSERT INTO residents (account_id, personal_info_id) VALUES (NULL, ?)");
                    mysqli_stmt_bind_param($stmt, "i", $subPersonalInfoId);
                    mysqli_stmt_execute($stmt);
                    $subResidentId = mysqli_insert_id($conn);
                
                    $stmt = mysqli_prepare($conn, "INSERT INTO family_members (family_id, resident_id, role) VALUES (?, ?, ?)");
                    mysqli_stmt_bind_param($stmt, "iis", $subFamilyId, $subResidentId, $subMember['sub_role']);
                    mysqli_stmt_execute($stmt);
                
                    $stmt = mysqli_prepare($conn, "
                        INSERT INTO household_members (household_id, family_id) 
                        VALUES (?, ?)
                    ");
                    mysqli_stmt_bind_param($stmt, "ii", $householdId, $subFamilyId);
                    mysqli_stmt_execute($stmt);
                }

                if ($member['role'] === 'child' && !empty($subFamilyData)) {
                    $childRole = ($member['sex'] === 'male') ? 'husband' : 'wife';

                    $stmt = mysqli_prepare($conn, "INSERT INTO family_members (family_id, resident_id, role) VALUES (?, ?, ?)");
                    mysqli_stmt_bind_param($stmt, "iis", $subFamilyId, $residentId, $childRole);
                    mysqli_stmt_execute($stmt);
                }
            }
        }

        mysqli_commit($conn);
        header("Location: /bhcmis/bhw-household-profiling?status=success&action=register_household");

    } catch (Exception $e) {
        mysqli_rollback($conn);
        header("Location: /bhcmis/bhw-household-profiling?status=error&action=register_household");
    } finally {
        mysqli_autocommit($conn, true);
    }
}
?>
