<?php

session_start();

$title = 'Midwife';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/midwife.php';
require '../models/get_all_bhws.php';


$midwives = getMidwives($conn);
$bhws = getBHWs($conn);
$user = getCurrentUser($conn);

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

            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Midwife</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12 shadow">
                <table id="midwivesTable" class="display text-center table-sm text-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Employment Status</th>
                            <th>Employment Date</th>
                            <th>License Number</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Civil Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($midwives as $midwife): ?>
                        <tr>
                            <td><?= htmlspecialchars($midwife['firstname'] . ' ' . $midwife['middlename'] . ' ' . $midwife['lastname']) ?></td>
                            <td class="<?= $midwife['employment_status'] === 'active' ? 'text-green-500' : 'text-red-500'; ?>">
                                <?= htmlspecialchars($midwife['employment_status']) ?>
                            </td>
                            <td><?= htmlspecialchars($midwife['employment_date']) ?></td>
                            <td><?= htmlspecialchars($midwife['license_number']) ?></td>
                            <td><?= htmlspecialchars($midwife['phone_number']) ?></td>
                            <td><?= htmlspecialchars($midwife['email']) ?></td>
                            <td><?= htmlspecialchars($midwife['civil_status']) ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal<?= $midwife['midwife_id'] ?>">
                                    Update
                                </button>
                            </td>
                        </tr>
                    
                        <?php require 'partials/update_midwife_modal.php'; ?>

                        <?php endforeach; ?>
                    </tbody>
                </table>

                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#appointFromBHWModal">Appoint from BHWs</button>
                    <button class="btn btn-primary btn-sm me-2">Appoint from Residents</button>
                    <button class="btn btn-primary btn-sm">Appoint from New Record</button>
                </div>
            </div>
    
        </div>
  </div>

    
    <?php require 'partials/add_midwife_from_bhw_modal.php'; ?>


    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script>
        // Initialize Datatables
        $(document).ready(function () {
            $('#midwivesTable').DataTable({
                "pageLength": 10, // Default number of rows
                "order": [[1, "desc"]] // Default sorting: by Employment Status
            });
        });
    </script>
</body>
</html>
