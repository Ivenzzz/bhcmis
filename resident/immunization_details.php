<?php

session_start();

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/resident_immunizations.php';

$title = 'Immunization Result';
$user = getCurrentUser($conn);

$appointment_id = $_GET['appointment_id'];
$immunization_details = getImmunizationDetailsByAppointmentId($conn, $appointment_id);

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
                            <li class="breadcrumb-item active" aria-current="page"><a href="completed_immunization_appointments.php">Immunizations</a></li>
                            <li class="breadcrumb-item" aria-current="page">Immunization Info</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <?php if (is_array($immunization_details) && count($immunization_details) > 0): ?>
                        <?php foreach ($immunization_details as $immunization): ?>
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h3>Appointment Details</h3>
                                </div>
                                <div class="card-body">
                                    <h5>Tracking Code: <span class="badge bg-primary"><?= htmlspecialchars($immunization['tracking_code'] ?? 'None') ?></span></h5>
                                    <p><strong>Resident ID:</strong> <?= htmlspecialchars($immunization['resident_id'] ?? 'None') ?></p>
                                    <p><strong>Priority Number:</strong> <?= htmlspecialchars($immunization['priority_number'] ?? 'None') ?></p>
                                    <p><strong>Status:</strong> <?= htmlspecialchars($immunization['status'] ?? 'None') ?></p>
                                    <p><strong>Schedule:</strong> <?= date("F j, Y, g:i a", strtotime($immunization['schedule_date'] ?? 'None')) ?></p>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header">
                                    <h3>Immunization Information</h3>
                                </div>
                                <div class="card-body">
                                    <h5>Vaccine: <span class="badge bg-success"><?= htmlspecialchars($immunization['vaccine_name'] ?? 'None') ?></span></h5>
                                    <p><strong>Dose Number:</strong> <?= htmlspecialchars($immunization['dose_number'] ?? 'None') ?></p>
                                    <p><strong>Next Dose Date:</strong> <?= date('F j, Y', strtotime($immunization['next_dose_schedule_date'] ?? 'None')) ?></p>
                                    <p><strong>Adverse Reaction:</strong> <?= htmlspecialchars($immunization['adverse_reaction'] ?? 'None') ?></p>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No immunization details found for this appointment.</p>
                    <?php endif; ?>

                </div>
            </div>


        </div>
    </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
</body>
</html>
