<?php

session_start();

require './config/db_config.php';
require './app/models/get_current_user.php';
require './app/models/get_consultation_details.php'; // Include the function to get consultation details

$title = 'Consultation Result';
$user = getCurrentUser($conn);

// Get appointment_id from URL parameters
$appointment_id = isset($_GET['appointment_id']) ? intval($_GET['appointment_id']) : null;

$consultation_details = [];
if ($appointment_id) {
    $consultation_details = getConsultationDetails($conn, $appointment_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './app/views/globals/head.php'; ?>
    <link rel="stylesheet" href="./public/css/resident.css">
</head>
<body id="body-pd">
    <?php include 'partials/top_navigation.php'; ?>
    <?php include 'partials/sidebar.php'; ?>
    
    <div class="height-100 main-content">
        <div class="row">
            <div class="col-md-12">
                <h4 class="my-4 text-center">Consultation Result</h4>
            </div>
        </div>

        <?php if ($consultation_details): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Consultation Details</h5>
                            <p><strong>Reason for Visit:</strong> <?= htmlspecialchars($consultation_details['reason_for_visit']); ?></p>
                            <p><strong>Symptoms:</strong> <?= htmlspecialchars($consultation_details['symptoms']); ?></p>
                            <p><strong>Weight:</strong> <?= htmlspecialchars($consultation_details['weight_kg']) . ' kg'; ?></p>
                            <p><strong>Temperature:</strong> <?= htmlspecialchars($consultation_details['temperature']); ?></p>
                            <p><strong>Heart Rate:</strong> <?= htmlspecialchars($consultation_details['heart_rate']); ?></p>
                            <p><strong>Respiratory Rate:</strong> <?= htmlspecialchars($consultation_details['respiratory_rate']); ?></p>
                            <p><strong>Blood Pressure:</strong> <?= htmlspecialchars($consultation_details['blood_pressure']); ?></p>
                            <p><strong>Cholesterol Level:</strong> <?= htmlspecialchars($consultation_details['cholesterol_level']); ?></p>
                            <p><strong>Physical Findings:</strong></p>
                            <p><?= nl2br(htmlspecialchars($consultation_details['physical_findings'])); ?></p>
                            <p><strong>Referred To:</strong> <?= htmlspecialchars($consultation_details['refer_to']); ?></p>
                            <p><strong>Created At:</strong> <?= htmlspecialchars($consultation_details['created_at']); ?></p>

                            <h5 class="mt-4">Prescriptions</h5>
                            <?php if (!empty($consultation_details['prescriptions'])): ?>
                                <ul>
                                    <?php foreach ($consultation_details['prescriptions'] as $prescription): ?>
                                        <li>
                                            <strong>Medicine ID:</strong> <?= htmlspecialchars($prescription['medicine_id']); ?>,
                                            <strong>Name:</strong> <?= htmlspecialchars($prescription['medicine_name']); ?>,
                                            <strong>Dosage:</strong> <?= htmlspecialchars($prescription['medicine_dosage']); ?>,
                                            <strong>Quantity:</strong> <?= htmlspecialchars($prescription['quantity']); ?>,
                                            <strong>Instructions:</strong> <?= nl2br(htmlspecialchars($prescription['instructions'])); ?>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning text-center">
                        No consultation results found for this appointment.
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php include './app/views/globals/javascripts.php'; ?>
    <script src="./public/js/admin/logout.js"></script>
</body>
</html>
