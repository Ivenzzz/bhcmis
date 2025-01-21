<?php

session_start();

$title = 'Residents';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/get_residents.php';

$user = getCurrentUser($conn);
$residents = getAllResidents($conn);
$families = getFamiliesWithHeadAndAddress($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require '../partials/global_head.php'; ?>
    <link rel="stylesheet" href="../public/css/main.css">
</head>
<body class="poppins-regular">
    <?php require 'partials/sidebar.php'; ?>

    <div class="flex-grow-1 bg-slate-100">

        <?php require 'partials/header.php'; ?>
        
        <div class="container mt-4 px-5">

            <div class="row mb-2">
                <div class="col-md-12 p-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Residents List</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-12">
                    <a href="residents.php" class="btn btn-success btn-sm">All</a>
                    <a href="pending_residents.php" class="btn btn-secondary btn-sm">Pending Registration</a>
                    <a href="rejected_residents.php" class="btn btn-secondary btn-sm">Rejected Registration</a>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12 d-flex justify-content-end mb-2">
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createResidentModal">
                        Create New Record <i class="fa-solid fa-user-plus"></i>
                    </button>
                </div>
                <div class="col-md-12 shadow p-4">
                    <?php require 'partials/table_all_residents.php'; ?>
                </div>
            </div>
        </div>
    </div>

    <?php require 'partials/modal_add_resident_record.php'; ?>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/admin_residents.js"></script>
</body>
</html>
