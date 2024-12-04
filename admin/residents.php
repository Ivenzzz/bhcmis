<?php

session_start();

$title = 'Residents';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/get_residents.php';

$user = getCurrentUser($conn);
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
                <div class="col-md-12 p-2">
                    <!-- Breadcrumb Structure -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Residents List</li> <!-- Current page -->
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12 shadow">
                    <table id="residentsTable" class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Civil Status</th>
                                <th>Registered Voter</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            // Check if there are any residents
                            if (!empty($residents)) {
                                foreach ($residents as $resident) {
                            ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($resident['firstname']) . ' ' . htmlspecialchars($resident['lastname']); ?></td>
                                    <td><?php echo htmlspecialchars($resident['address_name']); ?></td>
                                    <td><?php echo htmlspecialchars($resident['age']); ?></td>
                                    <td><?php echo htmlspecialchars($resident['sex']); ?></td>
                                    <td><?php echo htmlspecialchars($resident['civil_status']); ?></td>
                                    <td>
                                        <?php 
                                        // Check if the resident is a registered voter
                                        if ($resident['isRegisteredVoter']) {
                                            // Display a green check icon for registered voters
                                            echo '<i class="fas fa-check-circle text-green-500"></i>';
                                        } else {
                                            // Display a red X icon for non-registered voters
                                            echo '<i class="fas fa-times-circle text-red-500"></i>';
                                        }
                                        ?>
                                    </td>                                    
                                    <td>
                                        <a href="resident_details.php?resident_id=<?php echo htmlspecialchars($resident['resident_id']); ?>" class="btn btn-info">More</a>
                                    </td>

                                </tr>
                            <?php
                                }
                            } else {
                                echo '<tr><td colspan="7">No residents found.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>

    <!-- DataTables Initialization -->
    <script>
        $(document).ready(function() {
            $('#residentsTable').DataTable(); // Initialize DataTable
        });
    </script>
</body>
</html>
