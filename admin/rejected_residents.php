<?php

session_start();

$title = 'Rejected Resident Registrations';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/get_residents.php';

$user = getCurrentUser($conn);
$rejected_residents = getRejectedResidents($conn);


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
                    <a href="residents.php" class="btn btn-secondary btn-sm">All</a>
                    <a href="pending_residents.php" class="btn btn-secondary btn-sm">Pending Registration</a>
                    <a href="rejected_residents.php" class="btn btn-success btn-sm">Rejected Registration</a>
                </div>
            </div>

            <div class="row mb-4 shadow p-4">
                <div class="col-md-12">
                    <table class="table text-center" style="width:100%">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Date of Birth</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($rejected_residents)): ?>
                                <?php foreach ($rejected_residents as $index => $resident): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= htmlspecialchars($resident['lastname']) ?></td>
                                        <td><?= htmlspecialchars($resident['firstname']) ?></td>
                                        <td><?= htmlspecialchars($resident['middlename']) ?></td>
                                        <td><?= htmlspecialchars($resident['date_of_birth']) ?></td>
                                    </tr>

                                <?php endforeach; ?>
                            <?php else: ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
  </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
</body>
</html>
