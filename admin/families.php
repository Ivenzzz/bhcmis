<?php

session_start();

$title = 'Families';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/households.php';

$user = getCurrentUser($conn);

if (isset($_GET['household_id'])) {
    $household_id = $_GET['household_id'];
    $families = getFamiliesByHouseholdId($conn, $household_id);
} else {
    echo "Household ID is missing!";
    $families = [];
}

var_dump($families);

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
                <div class="col-12">
                    
                </div>
            </div>
        </div>
  </div>


    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
</body>
</html>
