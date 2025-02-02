<?php

session_start();

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/resident_appointments.php';


$title = 'Consultation Result';
$user = getCurrentUser($conn);

$appointment_id = $_GET['appointment_id'];
$consultation_details = getConsultationDetails($conn, $appointment_id);


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
                        <li class="breadcrumb-item active" aria-current="page"><a href="index.php">Appointments</a></li>
                        <li class="breadcrumb-item" aria-current="page">Consultation Info</li>
                    </ol>
                </nav>
            </div>
        </div>

        <?php if ($consultation_details): ?>
            <div class="row mb-4 p-4 shadow">
                <div class="col-md-12">
                    <div class="card text-slate-800 bg-secondary">
                        <div class="card-body">
                            <h5 class="card-title">Consultation Details</h5>
                            <p><strong>Reason for Visit:</strong> <?= htmlspecialchars($consultation_details['reason_for_visit'] ?? 'None'); ?></p>
                            <p><strong>Symptoms:</strong> <?= htmlspecialchars($consultation_details['symptoms'] ?? 'None'); ?></p>
                            <p><strong>Weight:</strong> <?= htmlspecialchars($consultation_details['weight_kg'] ?? 'None') . ' kg'; ?></p>
                            <p><strong>Temperature:</strong> <?= htmlspecialchars($consultation_details['temperature'] ?? 'None'); ?></p>
                            <p><strong>Heart Rate:</strong> <?= htmlspecialchars($consultation_details['heart_rate'] ?? 'None'); ?></p>
                            <p><strong>Respiratory Rate:</strong> <?= htmlspecialchars($consultation_details['respiratory_rate'] ?? 'None'); ?></p>
                            <p><strong>Blood Pressure:</strong> <?= htmlspecialchars($consultation_details['blood_pressure'] ?? 'None'); ?></p>
                            <p><strong>Cholesterol Level:</strong> <?= htmlspecialchars($consultation_details['cholesterol_level'] ?? 'None'); ?></p>
                            <p><strong>Physical Findings:</strong></p>
                            <p><?= nl2br(htmlspecialchars($consultation_details['physical_findings'] ?? 'None')); ?></p>
                            <p><strong>Referred To:</strong> <?= htmlspecialchars($consultation_details['refer_to'] ?? 'None'); ?></p>
                            <p><strong>Created At:</strong> <?= htmlspecialchars($consultation_details['created_at'] ?? 'None'); ?></p>

                            <h5 class="mt-4">Prescriptions</h5>
                            <?php if (!empty($consultation_details['prescriptions'])): ?>
                                <ul>
                                    <?php foreach ($consultation_details['prescriptions'] as $prescription): ?>
                                        <li>
                                            <strong>Medicine ID:</strong> <?= htmlspecialchars($prescription['medicine_id'] ?? 'None'); ?>,
                                            <strong>Name:</strong> <?= htmlspecialchars($prescription['medicine_name'] ?? 'None'); ?>,
                                            <strong>Dosage:</strong> <?= htmlspecialchars($prescription['medicine_dosage'] ?? 'None'); ?>,
                                            <strong>Quantity:</strong> <?= htmlspecialchars($prescription['quantity'] ?? 'None'); ?>,
                                            <strong>Instructions:</strong> <?= nl2br(htmlspecialchars($prescription['instructions'] ?? 'None')); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p>No prescriptions found for this consultation.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="row mb-4 p-4 shadow">
                <div class="col-md-12">
                    <div class="alert alert-warning text-center">
                        No consultation results found for this appointment.
                    </div>
                </div>
            </div>
        <?php endif; ?>
        </div>
  </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
</body>
</html>
