<?php

$title = 'BHCMIS - Punta Mesa';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './app/views/globals/head.php'; ?>
    <link rel="stylesheet" href="./public/css/index.css">
</head>
<body class="container-fluid">
    <header class="row mb-4 header-index p-4">
        <div class="col d-flex align-items-center justify-content-center text-center">
            <img src="./public/images/punta_mesa_logo.png" class="header-logo" alt="Punta Mesa Logo">
            <h1 class="fw-bolder gradient-text">Brgy. Punta Mesa Healthcare Management and Information System</h1>
        </div>
    </header>
    <main>
        <div class="main-section row">
            <div class="col d-flex flex-column justify-content-center">
                <h4 class="fw-light">Empowering Barangay Health Centers by streamlining patient management, appointment scheduling and healthcare data recording.</h4>
                <div class="d-flex gap-2 mt-4">
                    <button class="btn btn-primary px-4 py-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                    <button class="btn btn-secondary px-4 py-2">Register</button>
                </div>
            </div>
            <div class="col d-flex justify-content-center">
                <img src="./public/images/healthcare_hero.png" alt="Hero Icon">
            </div>
        </div>
    </main>
    <footer class="footer-index">
        <div class="py-4 d-flex align-items-center justify-content-center">
            © 2024 Copyright: Iven Loro BSCS-4A
        </div>
    </footer>
    
    <?php include 'login_form.php'; ?>
    <?php include './app/views/globals/javascripts.php'; ?>
    <script src="./public/js/index.js"></script>
</body>
</html>
