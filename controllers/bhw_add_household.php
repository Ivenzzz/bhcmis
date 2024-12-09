<?php
require '../partials/global_db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $address_id = $_POST['address_id'];
    $year_resided = $_POST['year_resided'];
    $housing_type = $_POST['housing_type'];
    $construction_materials = $_POST['construction_materials'];
    $lighting_facilities = $_POST['lighting_facilities'];
    $water_source = $_POST['water_source'];
    $toilet_facility = $_POST['toilet_facility'];
    $recorded_by = $_POST['recorded_by'];

    $sql = "INSERT INTO household (address_id, year_resided, housing_type, construction_materials, lighting_facilities, water_source, toilet_facility, recorded_by) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('issssssi', $address_id, $year_resided, $housing_type, $construction_materials, $lighting_facilities, $water_source, $toilet_facility, $recorded_by);

    if ($stmt->execute()) {
        header("Location: ../bhw/household_records.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
