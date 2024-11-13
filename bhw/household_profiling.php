<?php

session_start();

require './config/db_config.php';
require './app/models/get_current_user.php';
require './app/models/get_addresses.php';

$title = 'Household Profiling';
$user = getCurrentUser($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './app/views/globals/head.php'; ?>
    <link rel="stylesheet" href="./public/css/bhw.css">
</head>
<body id="body-pd">
    <?php include 'partials/top_navigation.php'; ?>
    <?php include 'partials/sidebar.php'; ?>
    
    <div class="height-100 main-content">
        <div class="container mt-5 shadow p-3">
        <h2 class="text-center mb-4">Household Profiling Form</h2>
        <form action="./app/controllers/bhw/register_household.php" method="POST">
            <input type="hidden" name="bhw_id" value="<?= htmlspecialchars($user['bhw_id']); ?>">
            <div class="card mb-3 shadow p-2">
                <div class="card-header">
                    <h4 class="text-center">Household Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="year_resided" class="form-label">Year of Residency Start</label>
                            <input type="number" class="form-control" id="year_resided" name="year_resided" min="1900" max="2100" required placeholder="e.g., 2010">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="address" class="form-label">Address</label>
                            <select class="form-select" id="address" name="address" required>
                                <option value="">Select Address</option>
                                <?php foreach ($addresses as $address) : ?>
                                    <option value="<?= $address['address_id']; ?>">
                                        <?= $address['address_name'] . ' (' . $address['address_type'] . ')'; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="housing_type" class="form-label">Housing Type</label>
                            <select class="form-select" id="housing_type" name="housing_type" required>
                                <option value="Owned">Owned</option>
                                <option value="Rented">Rented</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="construction_materials" class="form-label">Construction Materials</label>
                            <select class="form-select" id="construction_materials" name="construction_materials" required>
                                <option value="light">Light</option>
                                <option value="strong">Strong</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="lighting_facilities" class="form-label">Lighting Facilities</label>
                            <select class="form-select" id="lighting_facilities" name="lighting_facilities" required>
                                <option value="electricity">Electricity</option>
                                <option value="kerosene">Kerosene</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="water_source" class="form-label">Water Source</label>
                            <select class="form-select" id="water_source" name="water_source" required>
                                <option value="LEVEL 1 - Point Source">LEVEL 1 - Point Source</option>
                                <option value="LEVEL 2 - Communal Faucet">LEVEL 2 - Communal Faucet</option>
                                <option value="LEVEL 3 - Individual Connection">LEVEL 3 - Individual Connection</option>
                                <option value="OTHERS - For doubtful sources, open dug well etc.">OTHERS</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="toilet_facility" class="form-label">Toilet Facility</label>
                            <select class="form-select" id="toilet_facility" name="toilet_facility" required>
                                <option value="Pointflush type connected to septic tank">Pointflush type connected to septic tank</option>
                                <option value="Pointflush toilet connected to septic tank and sewerage system">Pointflush toilet connected to septic tank and sewerage system</option>
                                <option value="Ventilated Pit">Ventilated Pit</option>
                                <option value="Overhung Latrine">Overhung Latrine</option>
                                <option value="Without toilet">Without toilet</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="num_families" class="form-label">Number of Main Families</label>
                            <input type="number" class="form-control" id="num_families" name="num_families" required>
                        </div>
                    </div>
                </div>
            </div>

            <div id="families_section"></div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Register Household Information</button>
            </div>
        </form>

        </div>
    </div>

    <?php include './app/views/globals/javascripts.php'; ?>
    <script src="./public/js/admin/logout.js"></script>
    <script src="./public/js/bhw/generateHouseholdForm.js"></script>
</body>
</html>
