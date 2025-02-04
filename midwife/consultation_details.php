<?php

session_start();

$title = 'Unscheduled Consultation Details';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/consultations.php';

$user = getCurrentUser($conn);
$consultation_schedule_id = $_GET['con_sched_id'];

$consultations = getUnscheduledConsultations($consultation_schedule_id, $conn);
$consultation_schedule_date = isset($consultations[0]['consultation_schedule_date']) 
    ? date('F j, Y', strtotime($consultations[0]['consultation_schedule_date'])) 
    : 'N/A';

$residents = getAllResidents($conn);
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
                            <li class="breadcrumb-item"><a href="consultations.php">Calendar</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Unappointed Consultation List</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <a href="consultation_details.php?con_sched_id=<?= $consultation_schedule_id ?>" class="btn btn-primary btn-sm">Without Appointments</a>
                    <a href="appointed_consultation_details.php?con_sched_id=<?= $consultation_schedule_id ?>" class="btn btn-secondary btn-sm">With Appointments</a>
                    <a href="appointments.php?con_sched_id=<?= $consultation_schedule_id ?>" class="btn btn-secondary btn-sm">Appointments</a>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12 shadow p-3 mb-3">
                    <table id="consultationsTable" class="display text-sm">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Resident Name</th>
                                <th class="text-center">Reason for Visit</th>
                                <th class="text-center">Symptoms</th>
                                <th class="text-center">Weight (kg)</th>
                                <th class="text-center">Temperature</th>
                                <th class="text-center">Heart Rate</th>
                                <th class="text-center">Respiratory Rate</th>
                                <th class="text-center">Blood Pressure</th>
                                <th class="text-center">Cholesterol Level</th>
                                <th class="text-center">Physical Findings</th>
                                <th class="text-center">Refer To</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Created At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1; ?>
                            <?php foreach ($consultations as $consultation) : ?>
                                <tr>
                                    <td><?= $index++ ?></td>
                                    <td><?= !empty($consultation['resident_name']) ? $consultation['resident_name'] : 'None' ?></td>
                                    <td><?= !empty($consultation['reason_for_visit']) ? $consultation['reason_for_visit'] : 'None' ?></td>
                                    <td><?= !empty($consultation['symptoms']) ? $consultation['symptoms'] : 'None' ?></td>
                                    <td><?= !empty($consultation['weight_kg']) ? $consultation['weight_kg'] : 'None' ?></td>
                                    <td><?= !empty($consultation['temperature']) ? $consultation['temperature'] : 'None' ?></td>
                                    <td><?= !empty($consultation['heart_rate']) ? $consultation['heart_rate'] : 'None' ?></td>
                                    <td><?= !empty($consultation['respiratory_rate']) ? $consultation['respiratory_rate'] : 'None' ?></td>
                                    <td><?= !empty($consultation['blood_pressure']) ? $consultation['blood_pressure'] : 'None' ?></td>
                                    <td><?= !empty($consultation['cholesterol_level']) ? $consultation['cholesterol_level'] : 'None' ?></td>
                                    <td><?= !empty($consultation['physical_findings']) ? $consultation['physical_findings'] : 'None' ?></td>
                                    <td><?= !empty($consultation['refer_to']) ? $consultation['refer_to'] : 'None' ?></td>
                                    <td><?= !empty($consultation['consultation_schedule_date']) ? date('F j, Y, g:i A', strtotime($consultation['consultation_schedule_date'])) : 'None' ?></td>
                                    <td><?= !empty($consultation['created_at']) ? date('F j, Y, g:i A', strtotime($consultation['created_at'])) : 'None' ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $consultation['consultation_id'] ?>">Edit</button>
                                        <a href="prescriptions.php?consultation_id=<?= $consultation['consultation_id'] ?>&con_sched_id=<?= $consultation_schedule_id ?>" class="btn btn-info btn-sm">Show Prescriptions</a>
                                        <!-- Delete Button with Form Submission -->
                                        <form action="../controllers/midwife_delete_resident_consultation.php" method="POST" style="display:inline;">
                                            <input type="hidden" name="consultation_id" value="<?= $consultation['consultation_id'] ?>">
                                            <input type="hidden" name="con_sched_id" value="<?= $consultation_schedule_id ?>">
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this consultation?')">Delete</button>
                                        </form>
                                        <a href="create_referral_form.php?consultation_id=<?= $consultation['consultation_id'] ?>&con_sched_id=<?= $consultation_schedule_id ?>" class="btn bg-indigo-500 text-slate-50 btn-primary btn-sm">Create Referral Form</a>
                                    </td>
                                </tr>
                                <?php require 'partials/modal_update_consultation.php'; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addConsultationModal">Add Consultation</button>
                </div>
            </div>
        </div>
    </div>

    <?php require 'partials/modal_add_resident_consultation.php'; ?>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/midwife_consultation_details.js"></script>
</body>
</html>
