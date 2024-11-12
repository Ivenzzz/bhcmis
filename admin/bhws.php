<?php

session_start();

$title = 'Barangay Health Workers';

require './config/db_config.php';
require './app/models/get_addresses.php';
require './app/models/get_bhws.php';
require './app/models/get_current_user.php';

$user = getCurrentUser($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require './app/views/globals/head.php'; ?>
    <link rel="stylesheet" href="./public/css/admin.css">
</head>
<body id="body-pd">
    <?php require 'partials/top_navigation.php'; ?>
    <?php require 'partials/sidebar.php'; ?>
    
    <div class="height-100 main-content container">
        <div class="row">
            <div class="col-12 text-center m-4 d-flex justify-content-end">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addBhwModal">
                    <i class="bx bx-plus"></i> Add BHW
                </button>
            </div>
        </div>
        <div class="row">
            <?php if (!empty($bhw_data)): ?>
                <?php foreach ($bhw_data as $bhw): ?>
                    <div class="col-md-4 mb-4 bhw" id="bhw-card-<?= $bhw['bhw_id']; ?>">
                        <div class="card text-center shadow">
                            <img src="<?= !empty($bhw['profile_picture']) ? $bhw['profile_picture'] : './public/images/avatar-panda.png'; ?>" class="card-img-top rounded-circle mx-auto mt-3" alt="Profile Picture">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?= htmlspecialchars($bhw['firstname'] . ' ' . substr($bhw['middlename'], 0, 1) . '. ' . $bhw['lastname']); ?>
                                </h5>
                                <p class="card-text"><strong>Assigned Area:</strong> <?= htmlspecialchars($bhw['assigned_area_name']); ?></p>
                                
                                <!-- Edit and Delete Buttons -->
                                <div class="mt-3">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#bhwModal<?= $bhw['bhw_id']; ?>">
                                        <i class='bx bx-info-circle'></i>
                                    </button>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editBhwModal<?= $bhw['bhw_id']; ?>">
                                        <i class="bx bx-edit-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger delete-bhw" data-bhw-id="<?= $bhw['bhw_id']; ?>">
                                        <i class="bx bx-trash"></i>
                                    </button>


                                </div>
                            </div>
                        </div>
                    </div>

                    <?php require 'partials/view_bhw_modal.php';?>
                    <?php require 'partials/edit_bhw_modal.php';?>

                <?php endforeach; ?>
            <?php else: ?>
                <p>No Barangay Health Workers found.</p>
            <?php endif; ?>

        </div>

        <?php require 'partials/add_bhw_modal.php'; ?>
    </div>

    <?php require './app/views/globals/javascripts.php'; ?>
    <script src="./public/js/admin/admin-bhws.js" type="module"></script>
    <script src="./public/js/admin/admin-bhws-functions.js" type="module"></script>
    <script src="./public/js/admin/logout.js"></script>
</body>
</html>
