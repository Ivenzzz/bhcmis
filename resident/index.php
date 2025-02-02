<?php

session_start();

$title = 'Appointments';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/resident_appointments.php';
require '../models/resident_prenatals.php';

$user = getCurrentUser($conn);
$appointments = getResidentAppointmentsWithSchedule($conn);
$resident_prenatals = getResidentPrenatalSchedules($conn, $user['resident_id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require '../partials/global_head.php'; ?>
    <link rel="stylesheet" href="../public/css/main.css">
    <style>
    /* Custom Card Styling */
    .card {
        border: none;
        border-radius: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.12);
    }

    .card-header {
        background: #4a90e2;
        color: white;
        border-radius: 15px 15px 0 0 !important;
        border-bottom: none;
        padding: 1.25rem;
    }

    .card-header p {
        margin-bottom: 0;
    }

    .card-header p:first-child {
        font-size: 1.1rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .card-header p:nth-child(2) {
        background: rgba(255,255,255,0.15);
        padding: 0.25rem 1rem;
        border-radius: 20px;
        display: inline-block;
        font-size: 0.9rem;
        margin-top: 0.5rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-body p {
        margin-bottom: 0.75rem;
        color: #495057;
    }

    .card-body strong {
        color: #2c3e50;
        font-weight: 600;
        min-width: 140px;
        display: inline-block;
    }

    .card-footer {
        background: rgba(74, 144, 226, 0.05);
        border-top: 1px solid rgba(74, 144, 226, 0.15);
        border-radius: 0 0 15px 15px !important;
        padding: 1.25rem;
    }

    .card-footer p {
        margin: 0;
        color: #6c757d;
        font-style: italic;
        font-size: 0.9rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .card-header p:first-child {
            font-size: 1rem;
        }
        
        .card-body strong {
            min-width: 120px;
        }
    }
</style>
</head>
<body class="poppins-regular">
    <?php require 'partials/sidebar.php'; ?>

    <div class="flex-grow-1 bg-slate-100">

        <?php require 'partials/header.php'; ?>
        
        <div class="container mt-4 px-4">

            <div class="row mb-4">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container">
                            <a class="navbar-brand" href="#">Appointments</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <div class="ms-auto">
                                    <a href="index.php" class="btn btn-primary me-2">Consultation Appointment</a>
                                    <a href="scheduled_immunization_appointments.php" class="btn btn-secondary">Immunization Appointment</a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            
            <!-- Status Filter Dropdown -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="d-flex justify-content-end">
                        <label for="statusFilter" class="me-2">Filter by Status:</label>
                        <select id="statusFilter" class="form-select" style="width: 200px;">
                            <option value="all">All</option>
                            <option value="Scheduled">Scheduled</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Appointments Cards Section -->
            <div class="row mb-4 shadow p-4">
                <div class="col-md-12 px-5">
                    <?php require 'partials/appointment_cards.php';?>
                </div>
            </div>

            <!-- Add Appointment Button -->
            <div class="row mb-4">  
                <div class="col-md-12">
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAppointmentModal">Add Appointment</button>
                    </div>
                </div>
            </div>

            <div class="row mb-4 shadow p-4">
                <h5 class="text-center">Prenatal Schedules</h5>
                <?php if ($resident_prenatals !== null): ?>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <?php foreach ($resident_prenatals as $schedule): ?>
                            <div class="col">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <p><?= date('F j, Y | g:i A', strtotime($schedule['sched_date'])); ?></p>
                                        <p>Status: <?= htmlspecialchars($schedule['status']); ?></p>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Priority Number:</strong> <?= htmlspecialchars($schedule['priority_number']); ?></p>
                                        <p><strong>Expected Due Date:</strong> <?= htmlspecialchars($schedule['expected_due_date']); ?></p>
                                        <p><strong>Pregnancy Status:</strong> <?= htmlspecialchars($schedule['pregnancy_status']); ?></p>
                                    </div>
                                    <div class="card-footer text-center">
                                        <p><strong>Notes:</strong> <?= htmlspecialchars($schedule['notes']); ?></p>
                                        <?php if ($schedule['status'] === 'completed'): ?>
                                            <!-- View Result button shown when status is completed -->
                                            <a href="prenatal_result.php?schedule_id=<?= htmlspecialchars($schedule['resident_ps_id']); ?>" class="btn btn-primary btn-sm mt-3">
                                                View Result
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>No prenatal schedules found for this resident.</p>
                <?php endif; ?>
            </div>

        </div>
  </div>

    <?php require 'partials/modal_add_appointment.php'; ?>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/resident_appointments.js"></script>
</body>
</html>
