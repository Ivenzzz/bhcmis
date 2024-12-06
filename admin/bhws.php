<?php

session_start();

$title = 'Barangay Health Workers';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/bhws.php';
require '../models/addresses.php';

$addresses = getAllAddresses($conn);
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
        
        <div class="container mt-4 px-4">

            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Barangay Health Workers</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row p-4">
                <div class="col-md-12 shadow">
                    <table id="bhwsTable" class="display text-center text-sm">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Age</th>
                                <th class="text-center">Assigned Area</th>
                                <th class="text-center">Date Started</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($bhws as $index => $bhw): ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td><?= htmlspecialchars($bhw['firstname'] . ' ' . $bhw['middlename'] . ' ' . $bhw['lastname']); ?></td>
                                <td><?= htmlspecialchars($bhw['age']); ?></td>
                                <td><?= htmlspecialchars($bhw['assigned_area_name']); ?></td>
                                <td><?= htmlspecialchars($bhw['date_started']); ?></td>
                                <td class="<?= $bhw['employment_status'] === 'active' ? 'text-green-500' : ($bhw['employment_status'] === 'on_leave' ? 'text-amber-500' : 'text-red-500'); ?>">
                                    <?= htmlspecialchars($bhw['employment_status']); ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" 
                                        data-bs-target="#editBHWModal<?php echo htmlspecialchars($bhw['bhw_id']); ?>">
                                        Edit <i class="fa-solid fa-edit"></i>
                                    </button>
                                </td>
                            </tr>

                            <?php require 'partials/update_bhw_modal.php'; ?>

                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row mb-4 p-4">
                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-primary btn-sm me-2">Add BHW from Residents</button>
                    <button class="btn btn-primary btn-sm">Add BHW as New Record</button>
                </div>
            </div>

        </div>
  </div>


    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script>
        $(document).ready(function() {
            $('#bhwsTable').DataTable();
        });
    </script>
</body>
</html>
