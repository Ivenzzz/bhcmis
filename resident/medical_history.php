<?php

session_start();

$title = 'Medical History';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/resident_appointments.php';

$user = getCurrentUser($conn);
$resident_id = $user['resident_id'];
$allergies = getAllergiesByResidentId($conn, $resident_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require '../partials/global_head.php'; ?>
    <link rel="stylesheet" href="../public/css/main.css">
</head>
<body class="poppins-regular" data-resident-id="<?php echo htmlspecialchars($resident_id, ENT_QUOTES, 'UTF-8'); ?>">
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
                    <a href="medical_history.php" class="btn btn-success btn-sm">Home</a>
                    <a href="medical_history_consultations.php" class="btn btn-secondary btn-sm">My Consultations</a>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6 p-4 shadow" style="width: 100%">
                    <p>Weight Trend</p>
                    <canvas id="weightTrendChart" width="400" height="200"></canvas>
                </div>
                <div class="col-md-6 p-4 shadow">
                    <p>Blood Pressure Trend</p>
                    <canvas id="bpTrendChart"></canvas>
                </div>
            </div>

            <div class="row mb-4 p-4 shadow">
                <div class="col-md-12">
                    <!-- Display allergies in a list -->
                    <h5 class="poppins-light">Allergies</h5>
                    <?php if ($allergies && count($allergies) > 0): ?>
                        <ul class="list-group">
                            <?php foreach ($allergies as $allergy): ?>
                                <li class="list-group-item bg-slate-100 shadow">
                                    <strong>Allergy Type:</strong> <?php echo htmlspecialchars($allergy['allergy_type'], ENT_QUOTES, 'UTF-8'); ?><br>
                                    <strong>Allergen:</strong> <?php echo htmlspecialchars($allergy['allergen'], ENT_QUOTES, 'UTF-8'); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>No allergies found for this resident.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>
  </div>


    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/resident_medical_history.js"></script>
</body>
</html>
