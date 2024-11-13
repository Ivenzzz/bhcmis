<?php

session_start();

require './config/db_config.php';
require './app/models/get_current_user.php';
require './app/models/get_medicines.php';
require './app/models/get_medicine_analytics.php';

$title = 'Medicines';
$user = getCurrentUser($conn);
$medicines = getAllMedicines($conn);
$total_medicines = getMedicineCount($conn);
$medicineCountsByForm = getMedicineCountByForm($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './app/views/globals/head.php'; ?>
    <link rel="stylesheet" href="./public/css/midwife.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
</head>
<body id="body-pd">
    <?php include 'partials/top_navigation.php'; ?>
    <?php include 'partials/sidebar.php'; ?>
    
    <div class="container-fluid height-100 main-content">
        <div class="row shadow mb-4 p-3">
            <h3 class="text-center">Inventory Summary</h3>
            <div class="row d-flex justify-content-center">
                <!-- Card for Total Number of Residents -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 p-3">
                    <div class="card w-100 d-flex justify-content-center align-items-center text-center p-3 shadow">
                        <div class="card-content">
                            <i class="fa-solid fa-pills lg-icon"></i>
                            <div class="card-info">
                                <h2 class="text-center mb-1"><?= $total_medicines ?></h2>
                                <h5 class="text-center fw-light">Medicines</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($medicineCountsByForm as $form => $count): ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 p-3">
                        <div class="card w-100 d-flex justify-content-center align-items-center text-center p-3 shadow">
                            <div class="card-content">
                                <?php
                                // Determine the icon based on the form type
                                switch ($form) {
                                    case 'Inhaler':
                                        $icon = '<i class="fa-solid fa-smog lg-icon"></i>';
                                        break;
                                    case 'Syrup':
                                        $icon = '<i class="bx bxs-coffee-togo lg-icon"></i>';
                                        break;
                                    case 'Tablet':
                                        $icon = '<i class="fa-solid fa-tablets lg-icon"></i>';
                                        break;
                                    case 'Capsule':
                                        $icon = '<i class="fa-solid fa-capsules lg-icon"></i>';
                                        break;
                                    default:
                                        $icon = '<i class="fa-solid fa-pills lg-icon"></i>'; // Default icon
                                }
                                ?>
                                <?= $icon; // Display the icon ?>
                                <div class="card-info">
                                    <h2 class="text-center mb-1"><?= htmlspecialchars($count) ?></h2>
                                    <h5 class="text-center fw-light"><?= htmlspecialchars($form) ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="row gx-5 shadow mb-5 p-3">
            <!-- Add Medicine Form (Left Column - 50%) -->
            <div class="col-md-3 medicine-form shadow p-3">
                <h2 class="form-title">Add Medicine</h2>
                <form action="./app/controllers/midwife-medicines/add_medicine.php" method="POST" class="small-form">
                    <div class="mb-2">
                        <label for="batch_number" class="form-label">Batch Number</label>
                        <input type="text" class="form-control form-control-sm" id="batch_number" name="batch_number" required>
                    </div>
                    <div class="mb-2">
                        <label for="name" class="form-label">Medicine Name</label>
                        <input type="text" class="form-control form-control-sm" id="name" name="name" required>
                    </div>
                    <div class="mb-2">
                        <label for="generic_name" class="form-label">Generic Name</label>
                        <input type="text" class="form-control form-control-sm" id="generic_name" name="generic_name">
                    </div>
                    <div class="mb-2">
                        <label for="dosage" class="form-label">Dosage</label>
                        <input type="text" class="form-control form-control-sm" id="dosage" name="dosage" required>
                    </div>
                    <div class="mb-2">
                        <label for="form" class="form-label">Form</label>
                        <input type="text" class="form-control form-control-sm" id="form" name="form" required>
                    </div>
                    <div class="mb-2">
                        <label for="expiry_date" class="form-label">Expiry Date</label>
                        <input type="date" class="form-control form-control-sm" id="expiry_date" name="expiry_date">
                    </div>
                    <div class="mb-2">
                        <label for="quantity_in_stock" class="form-label">Quantity in Stock</label>
                        <input type="number" class="form-control form-control-sm" id="quantity_in_stock" name="quantity_in_stock" required>
                    </div>
                    <div class="mb-2">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control form-control-sm" id="description" name="description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Add Medicine</button>
                </form>
            </div>


            <!-- Medicines Table (Right Column - 50%) -->
            <div class="col-md-9 medicine-table">
                <table id="medicinesTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Batch Number</th>
                            <th>Name</th>
                            <th>Dosage</th>
                            <th>Form</th>
                            <th>Expiry Date</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($medicines)): ?>
                            <?php foreach ($medicines as $medicine): ?>
                                <tr>
                                    <td><?= htmlspecialchars($medicine['batch_number']) ?></td>
                                    <td><?= htmlspecialchars($medicine['name']) ?></td>
                                    <td><?= htmlspecialchars($medicine['dosage']) ?></td>
                                    <td><?= htmlspecialchars($medicine['form']) ?></td>
                                    <td><?= htmlspecialchars($medicine['expiry_date']) ?></td>
                                    <td><?= htmlspecialchars($medicine['quantity_in_stock']) ?></td>
                                    <td class="medicine-actions">
                                        <button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#editMedicineModal">
                                            <i class="fa-solid fa-pencil-alt"></i>
                                        </button>
                                        <button class="btn btn-sm">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="7">No medicines found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include './app/views/globals/javascripts.php'; ?>
    <script>
        $(document).ready(function() {
            $('#medicinesTable').DataTable({
                "ordering": false
            });
        });
    </script>
    <script src="./public/js/midwife/medicinesUrlHandler.js"></script>
    <script src="./public/js/admin/logout.js"></script>
</body>
</html>
