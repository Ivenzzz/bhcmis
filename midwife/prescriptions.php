<?php

session_start();

$title = 'Prescriptions';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/consultations.php';
require '../models/medicines.php';

$user = getCurrentUser($conn);
$consultation_id = $_GET['consultation_id'];
$consultation_schedule_id = $_GET['con_sched_id'];
$prescriptions = getPrescriptionsByConsultationId($consultation_id, $conn);
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

            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="consultations.php">Calendar</a></li>
                            <li class="breadcrumb-item"><a href="consultation_details.php?con_sched_id=<?php echo $consultation_schedule_id?>">Consultation List</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Prescription List</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPrescriptionModal">
                        <i class="fa-solid fa-plus"></i> Add Prescription
                    </button>
                </div>
                <div class="col-md-12 p-4 shadow">
                    <table class="table table-primary text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Medicine Name</th>
                                <th>Quantity</th>
                                <th>Dosage</th>
                                <th>Form</th>
                                <th>Instructions</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $rowNumber = 1; 
                            foreach ($prescriptions as $prescription): ?>
                                <tr>
                                    <td class="position-relative">
                                        <?php if ($prescription['is_new'] === 'new'): ?>
                                            <span class="badge badge-sm bg-success position-absolute top-0 start-100 translate-middle translate-middle-x mt-1 me-1 font-sm">New</span>
                                        <?php endif; ?>
                                        <?php echo $rowNumber++; ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($prescription['medicine_name']); ?></td>
                                    <td><?php echo htmlspecialchars($prescription['quantity']); ?></td>
                                    <td><?php echo htmlspecialchars($prescription['dosage']); ?></td>
                                    <td><?php echo htmlspecialchars($prescription['form']); ?></td>
                                    <td><?php echo htmlspecialchars($prescription['instructions']); ?></td>
                                    <td>
                                        <form action="../controllers/midwife_delete_prescription.php" method="POST">
                                            <input type="hidden" name="medication_id" value="<?php echo $prescription['medication_id']; ?>">
                                            <input type="hidden" name="consultation_id" value="<?php echo $consultation_id; ?>">
                                            <input type="hidden" name="con_sched_id" value="<?php echo $consultation_schedule_id; ?>">
                                            <button type="submit" class="btn btn-transparent btn-sm text-red-500">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php require 'partials/modal_add_prescription.php'; ?>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
</body>
</html>

