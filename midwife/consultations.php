<?php

session_start();

$title = 'Schedules of Consultations';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';

$user = getCurrentUser($conn);

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


            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Schedules of Consultations</li>
                        </ol>
                    </nav>
                </div>
            </div>


            <div class="row mb-4 shadow">
                <div class="col-md-12 p-4">
                    <div id="consultationsCalendar"></div>
                </div>
            </div>

        </div>
    </div>

    <?php require 'partials/modal_add_consultation_schedule.php'; ?>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/midwife_consultations.js"></script>
</body>
</html>
