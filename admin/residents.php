<?php

session_start();

$title = 'Residents';

require './config/db_config.php';
require './app/models/get_residents.php';
require './app/models/get_addresses.php';
require './app/models/get_current_user.php';

$user = getCurrentUser($conn);
$residents = getResidents($conn);

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
    <div class="height-100 main-content">
        <div class="row shadow p-1">
            <div class="col-md-12">
                <div class="toolbar shadow p-2">
                    <div class="left-toolbar">
                        <button class="spinner"><i class='bx bx-refresh'></i></button>
                    </div>
                    <div class="right-toolbar">
                        <button class="delete-btn"><i class='bx bx-trash'></i></button>
                        <button data-bs-toggle="modal" data-bs-target="#addResidentModal"><i class='bx bx-plus-circle'></i></button>
                    </div>
                </div>
                <table class="table text-center shadow my-3 table-hover table-bordered" id="residentsTable">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all" class="text-center"></th>
                            <th class="text-center">Lastname</th>
                            <th class="text-center">Firstname</th>
                            <th class="text-center">Middlename</th>
                            <th class="text-center">Age</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($residents as $resident): ?>
                            <tr class="main-row">
                                <td><input type="checkbox" class="row-checkbox" data-resident-id="<?php echo $resident['resident_id']; ?>"></td>
                                <td><?php echo $resident['lastname']; ?></td>
                                <td><?php echo $resident['firstname']; ?></td>
                                <td><?php echo $resident['middlename']; ?></td>
                                <td><?php echo $resident['age']; ?></td>
                                <td><?php echo $resident['address_name']; ?></td>
                                <td>
                                    <a href="admin-residents?resident_id=<?php echo $resident['resident_id']; ?>" class="btn btn-view">
                                        <i class='bx bx-info-circle'></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php require 'partials/add_resident_modal.php'; ?>
    
    <?php require './app/views/globals/javascripts.php'; ?>
    <script src="./public/js/admin/admin.js" type="module"></script>
    <script src="./public/js/admin/logout.js"></script>
</body>
</html>
