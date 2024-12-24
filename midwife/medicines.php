<?php

session_start();

$title = 'Medicines';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/medicines.php';

$user = getCurrentUser($conn);
$medicines = getMedicines($conn);

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
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Medicines</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-3 shadow p-2">
                <div class="col-md-8">
                    <canvas id="medicineChart"></canvas>
                </div>
                <div class="col-md-4">
                    <canvas id="expiryStatusChart"></canvas>
                </div>
            </div>


            <div class="row mb-4">
                <div class="col-md-12 shadow p-3">
                    <table id="medicinesTable" class="display nowrap text-sm text-center" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="text-center">Batch Number</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Expiry Status</th>
                                <th class="text-center">Quantity in Stock</th>
                                <th class="text-center">Dosage</th>
                                <th class="text-center">Generic Name</th>
                                <th class="text-center">Form</th>
                                <th class="text-center">Recorded at</th>
                                <th class="text-center">Expiry Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($medicines as $medicine): ?>
                                <tr>
                                    <td><?= htmlspecialchars($medicine['batch_number']) ?></td>
                                    <td><?= htmlspecialchars($medicine['name']) ?></td>
                                    <td>
                                        <?php
                                        if ($medicine['expiry_status'] === 'Expired') {
                                            echo '<span class="badge bg-danger">Expired</span>';
                                        } elseif ($medicine['expiry_status'] === 'Expiring') {
                                            echo '<span class="badge bg-warning text-dark">Expiring</span>';
                                        } else {
                                            echo '<span class="badge bg-success">Valid</span>';
                                        }
                                        ?>
                                    </td>
                                    <td><?= htmlspecialchars($medicine['quantity_in_stock']) ?></td>
                                    <td><?= htmlspecialchars($medicine['dosage']) ?></td>
                                    <td><?= htmlspecialchars($medicine['generic_name']) ?></td>
                                    <td><?= htmlspecialchars($medicine['form']) ?></td>
                                    <td><?= (new DateTime($medicine['created_at']))->format('F j, Y | h:i A') ?></td>
                                    <td><?= (new DateTime($medicine['expiry_date']))->format('F j, Y') ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editMedicineModal<?= $medicine['medicine_id'] ?>">
                                            Edit
                                        </button>
                                        <button class="btn btn-transparent btn-sm delete-btn" data-id="<?= htmlspecialchars($medicine['medicine_id']); ?>">
                                            <i class="fa-regular fa-trash-can text-red-500"></i>
                                        </button>
                                    </td>
                                </tr>

                                <?php require 'partials/modal_edit_medicines.php'; ?>

                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMedicineModal">Add Medicine</button>
                </div>
                </div>
            </div>
            
        </div>
    </div>

    <?php require 'partials/modal_add_medicine.php'; ?>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/midwife_medicines.js"></script>
</body>
</html>
