<?php

session_start();

$title = 'Resident Details';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/residents.php';
require '../models/medical_conditions.php';

$resident_id = isset($_GET['resident_id']) ? intval($_GET['resident_id']) : 0;
$resident_details = getResidentDetails($conn, $resident_id);
$medical_conditions = getMedicalConditions($conn);
$user = getCurrentUser($conn);

<<<<<<< HEAD


=======
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
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
                            <li class="breadcrumb-item"><a href="residents.php">Residents List</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Resident Details</li> <!-- Current page -->
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12 text-center mb-4">
                    <!-- Profile Picture -->
                    <img src="<?php echo $resident_details['profile_picture']; ?>" alt="Profile Picture" class="w-25">
                </div>
<<<<<<< HEAD
=======
                <div class="col-md-12 text-center">
                    <!-- ID Picture -->
                    <img src="<?php echo !empty($resident_details['id_picture']) ? $resident_details['id_picture'] : '../storage/uploads/default_id.jpg'; ?>" alt="ID Picture" class="w-25">
                </div>
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
            </div>


            <div class="row mb-4">
                <div class="col-md-12 p-2">
                    <h2 class="text-center poppins-light text-slate-700">--- <?php echo $resident_details['firstname'] . ' ' . $resident_details['lastname'];?> ---</h2>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="shadow p-4 mb-2">
                        <h5 class="poppins-light">Household Number</h5>
                        <p class="poppins-semibold text-green-500">
                            <?php echo !empty($resident_details['household_id']) ? $resident_details['household_id'] : 'Household not provided'; ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="shadow p-4 mb-2">
                        <h5 class="poppins-light">Family Number</h5>
                        <p class="poppins-semibold text-amber-500">
                            <?php echo !empty($resident_details['household_id']) ? $resident_details['household_id'] : 'Family not available'; ?>
                        </p>
                    </div>
                </div>
            </div>


            <div class="row mb-4 shadow p-4">
                <div class="col-md-12">
                    <h4 class="poppins-light mb-4 text-center">Personal Information</h4>
                    <?php require 'partials/form_resident_personal_information.php'; ?>
                </div>
            </div>

        </div>
  </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/admin_resident_details.js"></script>

</body>
</html>
