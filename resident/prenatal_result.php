<?php

session_start();

$title = 'Prenatal Result';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/resident_prenatals.php';

$user = getCurrentUser($conn);
$schedule_id = $_GET['schedule_id'];
$prenatal_result = getPrenatalInfoByResidentPsId($conn, $schedule_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require '../partials/global_head.php'; ?>
    <link rel="stylesheet" href="../public/css/main.css">
    <style>
    /* Prenatal Result Card Styling */
    .card.prenatal-result {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease;
        background: linear-gradient(145deg, #ffffff, #f8fafc);
    }

    .card.prenatal-result:hover {
        transform: translateY(-3px);
    }

    .card-header.bg-primary {
        background: linear-gradient(135deg, #22d3ee, #3b82f6) !important;
        border-radius: 15px 15px 0 0 !important;
        padding: 1.5rem;
        border-bottom: none;
        box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11);
    }

    .card-header h5 {
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 0;
        font-size: 1.5rem;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
    }

    .card-body {
        padding: 2rem;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .card-body p {
        margin: 0;
        padding: 0.8rem 1.2rem;
        border-radius: 8px;
        background: rgba(236, 240, 243, 0.5);
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: background 0.3s ease;
    }

    .card-body p:hover {
        background: rgba(224, 231, 255, 0.3);
    }

    .card-body strong {
        color: #1e40af;
        font-weight: 600;
        margin-right: 1rem;
        position: relative;
        padding-left: 24px;
    }

    .card-body strong::before {
        content: "•";
        color: #3b82f6;
        position: absolute;
        left: 0;
        font-size: 1.4em;
        line-height: 0.75;
    }

    .card-body p:last-child {
        grid-column: 1 / -1;
        background: rgba(255, 237, 213, 0.3);
    }

    .alert-warning {
        border-radius: 12px;
        background: rgba(255, 229, 172, 0.3);
        border: 2px solid #ffd351;
        color: #854d0e;
        padding: 1.5rem;
        font-size: 1.1rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .card-body {
            grid-template-columns: 1fr;
            padding: 1.5rem;
        }
        
        .card-body p {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
        
        .card-header h5 {
            font-size: 1.3rem;
        }
    }

    /* Value Styling */
    .card-body p span:not([class]) {
        color: #1f2937;
        font-weight: 500;
        text-align: right;
        flex-shrink: 0;
    }

    .card-body p em {
        color: #6b7280;
        font-style: italic;
        font-size: 0.95em;
    }
</style>
</head>
<body class="poppins-regular">
    <?php require 'partials/sidebar.php'; ?>

    <div class="flex-grow-1 bg-slate-100">

        <?php require 'partials/header.php'; ?>        
        <div class="container mt-4 px-5">

            <div class="row mb-4">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-white p-3 shadow-sm rounded">
                            <li class="breadcrumb-item"><a href="index.php">Appointments</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Prenatal Checkup Result</li>
                        </ol>
                    </nav>
                </div>
            </div>
            
            <div class="row mb-4 open-sans-regular">
                <div class="col-md-12">
                    <h3 class="text-center mb-4">Prenatal Checkup Result</h3>

                    <?php if ($prenatal_result !== null): ?>
                        <div class="card shadow-lg">
                            <div class="card-header bg-primary text-white text-center">
                                <h5>Prenatal Checkup Details</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Tracking Code:</strong> <?= !empty($prenatal_result[0]['tracking_code']) ? htmlspecialchars($prenatal_result[0]['tracking_code']) : 'Not Available'; ?></p>
                                <p><strong>Weight:</strong> <?= !empty($prenatal_result[0]['weight']) ? htmlspecialchars($prenatal_result[0]['weight']) . ' kg' : 'Not Available'; ?></p>
                                <p><strong>Blood Pressure:</strong> <?= !empty($prenatal_result[0]['blood_pressure']) ? htmlspecialchars($prenatal_result[0]['blood_pressure']) : 'Not Available'; ?></p>
                                <p><strong>Heart & Lungs Condition:</strong> <?= !empty($prenatal_result[0]['heart_lungs_condition']) ? htmlspecialchars($prenatal_result[0]['heart_lungs_condition']) : 'Not Available'; ?></p>
                                <p><strong>Abdominal Exam:</strong> <?= !empty($prenatal_result[0]['abdominal_exam']) ? htmlspecialchars($prenatal_result[0]['abdominal_exam']) : 'Not Available'; ?></p>
                                <p><strong>Fetal Heart Rate:</strong> <?= !empty($prenatal_result[0]['fetal_heart_rate']) ? htmlspecialchars($prenatal_result[0]['fetal_heart_rate']) : 'Not Available'; ?></p>
                                <p><strong>Fundal Height:</strong> <?= !empty($prenatal_result[0]['fundal_height']) ? htmlspecialchars($prenatal_result[0]['fundal_height']) . ' cm' : 'Not Available'; ?></p>
                                <p><strong>Fetal Movement:</strong> <?= !empty($prenatal_result[0]['fetal_movement']) ? htmlspecialchars($prenatal_result[0]['fetal_movement']) : 'Not Available'; ?></p>
                                <p><strong>Checkup Notes:</strong> <?= !empty($prenatal_result[0]['checkup_notes']) ? htmlspecialchars($prenatal_result[0]['checkup_notes']) : 'Not Available'; ?></p>
                                <p><strong>Referred To:</strong> <?= !empty($prenatal_result[0]['refer_to']) ? htmlspecialchars($prenatal_result[0]['refer_to']) : 'Not Available'; ?></p>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning text-center">
                            <p>No prenatal information found for this schedule.</p>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
</body>
</html>
