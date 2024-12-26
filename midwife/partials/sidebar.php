<div class="sidebar d-flex flex-column p-3">
    <?php
        $current_page = basename($_SERVER['REQUEST_URI']);
        if ($current_page == '' || $current_page == 'index.php') {
            $current_page = 'overview';
        }
    ?>

    <a href="#" class="mb-4">
        <img src="/bhcmis/public/images/punta_mesa_logo.png" alt="Dashboard Icon" class="icon" style="width: 1.2rem; height: 1.2rem;">
        <span class="text ms-2">Midwife Dashboard</span>
    </a>

    <a href="index.php" class="d-flex align-items-center <?= $current_page == 'overview' ? 'active' : '' ?>">
        <i class="icon fa-solid fa-chart-area text-info"></i>
        <span class="text ms-2">Overview</span>
    </a>

    <a href="consultations.php" class="<?= in_array(basename($_SERVER['PHP_SELF']), ['consultations.php', 'consultation_details.php', 'prescriptions.php', 'appointed_consultation_details.php', 'appointments.php']) ? 'active' : '' ?>">
        <i class="icon fa-solid fa-calendar-check text-green-500"></i>
        <span class="text ms-2">Consultations</span>
    </a>
    
    <a href="prenatals.php" class="d-flex align-items-center <?= $current_page == 'prenatals.php' ? 'active' : '' ?>">
        <i class="icon fa-solid fa-baby text-warning"></i>
        <span class="text ms-2">Prenatals</span>
    </a>
    
    <a href="medicines.php" class="<?= in_array(basename($_SERVER['PHP_SELF']), ['medicines.php']) ? 'active' : '' ?>">
        <i class="icon fa-solid fa-pills text-danger"></i>
        <span class="text ms-2">Medicines</span>
    </a>
    
    <a href="vaccinations.php" class="d-flex align-items-center <?= $current_page == 'vaccinations.php' ? 'active' : '' ?>">
        <i class="icon fa-solid fa-syringe text-slate-500"></i>
        <span class="text ms-2">Vaccinations</span>
    </a>
</div>
