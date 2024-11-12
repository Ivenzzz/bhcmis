<?php
session_start();
require './config/db_config.php';
require './app/models/get_current_user.php';
require './app/models/get_addresses.php';
require './app/models/get_resident_by_id.php';
require './app/models/get_resident_medical_conditions.php';

// Get the resident ID from the URL parameter
$resident_id = isset($_GET['resident_id']) ? intval($_GET['resident_id']) : null;

if ($resident_id) {
    // Fetch the medical conditions using the function
    $medical_conditions = getResidentMedicalConditions($conn, $resident_id);
}

$user = getCurrentUser($conn);
$resident_details = getResidentById($conn, $resident_id);
$title = $resident_details['firstname'] . ' ' . $resident_details['lastname'] . ' Medical Record';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require './app/views/globals/head.php'; ?>
    <link rel="stylesheet" href="./public/css/admin.css">
</head>
<body id="body-pd">
    <?php require 'partials/top_navigation.php'; ?>
    <?php require 'partials/sidebar.php'; ?>
    
    <div class="height-100 main-content">
        <div class="row mb-4">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-residents">Residents</a></li>
                        <li class="breadcrumb-item">
                            <a href="admin-residents?resident_id=<?php echo $resident_id; ?>">
                                <?php echo htmlspecialchars($resident_details['firstname'] . ' ' . $resident_details['lastname']); ?>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"> / Medical Conditions</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Medical Conditions Table -->
        <div class="row mb-4">
            <div class="col-md-12">
                
                <!-- Bootstrap Table -->
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Condition Name</th>
                            <th>Diagnosed Date</th>
                            <th>Medications</th> <!-- New Medications Column -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($medical_conditions)) : ?>
                            <?php foreach ($medical_conditions as $index => $condition) : ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo htmlspecialchars($condition['condition_name']); ?></td>
                                    <td><?php echo htmlspecialchars($condition['diagnosed_date']); ?></td>
                                    <td>
                                        <?php 
                                            echo !empty($condition['medicines']) ? htmlspecialchars($condition['medicines']) : 'No medications prescribed';
                                        ?>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4" class="text-center">No medical conditions found for this resident.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>

    <script src="./public/js/admin/logout.js"></script>
</body>
</html>
