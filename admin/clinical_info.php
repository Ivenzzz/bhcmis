<?php
session_start();

$title = 'Clinical Info';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/clinic_analytics.php';

$user = getCurrentUser($conn);
$result = getConsultationsGroupedBySchedules($conn);
$consultations = $result['consultations'];
$statusCounts = $result['status_counts'];

// Calculate the total number of consultations
$totalConsultations = array_sum(array_column($consultations, 'consultation_count'));

$immunizations = getImmunizationsBySchedule($conn);
$prenatals = getPrenatalSchedulesWithCounts($conn);

// Calculate totals for Immunizations
$totalImmunizations = 0;
$totalScheduledImmunizations = 0;
$totalCompletedImmunizations = 0;
$totalCancelledImmunizations = 0;
$totalMissedImmunizations = 0;

if (!empty($immunizations)) {
    foreach ($immunizations as $immunization) {
        $totalImmunizations += $immunization['total_immunizations'];
        $totalScheduledImmunizations += $immunization['scheduled'];
        $totalCompletedImmunizations += $immunization['completed'];
        $totalCancelledImmunizations += $immunization['cancelled'];
        $totalMissedImmunizations += $immunization['missed'];
    }
}

// Calculate totals for Prenatals
$totalPrenatals = 0;

if (!empty($prenatals)) {
    foreach ($prenatals as $prenatal) {
        $totalPrenatals += $prenatal['total_prenatals'];
    }
}
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
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Clinic Data</li>
                </ol>
            </nav>
            
            <div class="row mb-4">
                <div class="col-md-12">
                    <a href="index.php" class="btn btn-sm btn-secondary">Overview</a>
                    <a href="index_table_view.php" class="btn btn-sm btn-secondary">Population Table</a>
                    <a href="clinical_info.php" class="btn btn-sm btn-primary">Clinical Info</a>
                </div>
            </div>

            <!-- Display consultations and status counts in one table -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card p-4 shadow">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Consultations and Status Counts</h5>
                        </div>
                        <div class="card-body">
                            <table id="consultationsTable" class="table table-bordered table-striped text-center open-sans-regular">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Schedule Date</th>
                                        <th>Number of Consultations</th>
                                        <th>Cancelled</th>
                                        <th>Completed</th>
                                        <th>Scheduled</th>
                                        <th>No Appointment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Display consultation details -->
                                    <?php if (!empty($consultations)): ?>
                                        <?php foreach ($consultations as $consultation): ?>
                                            <tr>
                                                <td>
                                                    <?php
                                                    $date = new DateTime($consultation['con_sched_date']);
                                                    echo htmlspecialchars($date->format('F j, Y | h:i A'));
                                                    ?>
                                                </td>
                                                <td><?php echo htmlspecialchars($consultation['consultation_count']); ?></td>
                                                <td><?php echo $consultation['appointment_status'] === 'Cancelled' ? htmlspecialchars($consultation['consultation_count']) : 0; ?></td>
                                                <td><?php echo $consultation['appointment_status'] === 'Completed' ? htmlspecialchars($consultation['consultation_count']) : 0; ?></td>
                                                <td><?php echo $consultation['appointment_status'] === 'Scheduled' ? htmlspecialchars($consultation['consultation_count']) : 0; ?></td>
                                                <td><?php echo $consultation['appointment_status'] === 'No Appointment' ? htmlspecialchars($consultation['consultation_count']) : 0; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No consultations found.</td>
                                        </tr>
                                    <?php endif; ?>

                                    <!-- Display status counts as summary row -->
                                    <tr class="table-info">
                                        <td class="text-end"><strong>Total:</strong></td>
                                        <td><?php echo htmlspecialchars($totalConsultations); ?></td>
                                        <td><?php echo htmlspecialchars($statusCounts['Cancelled']); ?></td>
                                        <td><?php echo htmlspecialchars($statusCounts['Completed']); ?></td>
                                        <td><?php echo htmlspecialchars($statusCounts['Scheduled']); ?></td>
                                        <td><?php echo htmlspecialchars($statusCounts['No Appointment']); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Display immunization schedules in a DataTable -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Immunization Schedules</h5>
                        </div>
                        <div class="card-body">
                            <table id="immunizationsTable" class="table table-bordered table-striped text-center open-sans-regular">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Schedule Date</th>
                                        <th>Total Immunizations</th>
                                        <th>Scheduled</th>
                                        <th>Completed</th>
                                        <th>Cancelled</th>
                                        <th>Missed</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Display immunization details -->
                                    <?php if (!empty($immunizations)): ?>
                                        <?php foreach ($immunizations as $immunization): ?>
                                            <tr>
                                                <td>
                                                    <?php
                                                    $date = new DateTime($immunization['schedule_date']);
                                                    echo htmlspecialchars($date->format('F j, Y | h:i A'));
                                                    ?>
                                                </td>
                                                <td><?php echo htmlspecialchars($immunization['total_immunizations']); ?></td>
                                                <td><?php echo htmlspecialchars($immunization['scheduled']); ?></td>
                                                <td><?php echo htmlspecialchars($immunization['completed']); ?></td>
                                                <td><?php echo htmlspecialchars($immunization['cancelled']); ?></td>
                                                <td><?php echo htmlspecialchars($immunization['missed']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No immunization schedules found.</td>
                                        </tr>
                                    <?php endif; ?>

                                    <!-- Totals Row for Immunizations -->
                                    <tr class="table-info">
                                        <td class="text-end"><strong>Total:</strong></td>
                                        <td><?php echo htmlspecialchars($totalImmunizations); ?></td>
                                        <td><?php echo htmlspecialchars($totalScheduledImmunizations); ?></td>
                                        <td><?php echo htmlspecialchars($totalCompletedImmunizations); ?></td>
                                        <td><?php echo htmlspecialchars($totalCancelledImmunizations); ?></td>
                                        <td><?php echo htmlspecialchars($totalMissedImmunizations); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Display prenatal schedules in a DataTable -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Prenatal Schedules</h5>
                        </div>
                        <div class="card-body">
                            <table id="prenatalsTable" class="table table-bordered table-striped text-center open-sans-regular">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Schedule</th>
                                        <th>Number of Prenatals</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Display prenatal schedule details -->
                                    <?php if (!empty($prenatals)): ?>
                                        <?php foreach ($prenatals as $prenatal): ?>
                                            <tr>
                                                <td>
                                                    <?php
                                                    $date = new DateTime($prenatal['sched_date']);
                                                    echo htmlspecialchars($date->format('F j, Y | h:i A'));
                                                    ?>
                                                </td>
                                                <td><?php echo htmlspecialchars($prenatal['total_prenatals']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="2" class="text-center">No prenatal schedules found.</td>
                                        </tr>
                                    <?php endif; ?>

                                    <!-- Totals Row for Prenatals -->
                                    <tr class="table-info">
                                        <td class="text-end"><strong>Total:</strong></td>
                                        <td><?php echo htmlspecialchars($totalPrenatals); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/admin_clinical_info.js"></script>
</body>
</html>