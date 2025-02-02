<?php

session_start();

$title = 'My title';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/resident_appointments.php';

$user = getCurrentUser($conn);
$resident_id = $user['resident_id'];
$consultations = getConsultationsByResidentId($conn, $resident_id);

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

            <div class="row mb-4">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">   
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Medical History</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <a href="medical_history.php" class="btn btn-secondary btn-sm">Home</a>
                    <a href="medical_history_consultations.php" class="btn btn-success btn-sm">My Consultations</a>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <?php if (!empty($consultations)): ?>
                        <ul class="list-group">
                            <?php foreach ($consultations as $consultation): ?>
                                <li class="list-group-item mb-4 bg-slate-100 shadow">
                                    <h5><strong>Date:</strong> <?php echo htmlspecialchars($consultation['formatted_date']); ?></h5>
                                    <p><strong>Reason for Visit:</strong> <?php echo htmlspecialchars($consultation['reason_for_visit']); ?></p>
                                    <p><strong>Symptoms:</strong> <?php echo !empty($consultation['symptoms']) ? htmlspecialchars($consultation['symptoms']) : 'None'; ?></p>
                                    <p><strong>Weight (kg):</strong> <?php echo !empty($consultation['weight_kg']) ? htmlspecialchars($consultation['weight_kg']) : 'None'; ?></p>
                                    <p><strong>Temperature:</strong> <?php echo !empty($consultation['temperature']) ? htmlspecialchars($consultation['temperature']) : 'None'; ?></p>
                                    <p><strong>Heart Rate:</strong> <?php echo !empty($consultation['heart_rate']) ? htmlspecialchars($consultation['heart_rate']) : 'None'; ?></p>
                                    <p><strong>Respiratory Rate:</strong> <?php echo !empty($consultation['respiratory_rate']) ? htmlspecialchars($consultation['respiratory_rate']) : 'None'; ?></p>
                                    <p><strong>Blood Pressure:</strong> <?php echo !empty($consultation['blood_pressure']) ? htmlspecialchars($consultation['blood_pressure']) : 'None'; ?></p>
                                    <p><strong>Cholesterol Level:</strong> <?php echo !empty($consultation['cholesterol_level']) ? htmlspecialchars($consultation['cholesterol_level']) : 'None'; ?></p>
                                    <p><strong>Physical Findings:</strong> <?php echo !empty($consultation['physical_findings']) ? htmlspecialchars($consultation['physical_findings']) : 'None'; ?></p>
                                    <p><strong>Referred To:</strong> <?php echo !empty($consultation['refer_to']) ? htmlspecialchars($consultation['refer_to']) : 'None'; ?></p>
                                    
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>No consultations found.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>
  </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
</body>
</html>
