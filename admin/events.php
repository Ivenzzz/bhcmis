<?php

session_start();

$title = 'Healthcare Events';

require './config/db_config.php';
require './app/models/get_current_user.php';

$user = getCurrentUser($conn);


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
        <h1>Events</h1>
    </div>
    <?php require './app/views/globals/javascripts.php'; ?>
    <script src="./public/js/admin/logout.js"></script>

</body>
</html>
