<div class="sidebar d-flex flex-column p-3">
    <?php
        $current_page = basename($_SERVER['REQUEST_URI']);
        if ($current_page == '' || $current_page == 'index.php') {
            $current_page = 'statistics';
        }
    ?>

    <a href="#" class="mb-4">
        <img src="/bhcmis/public/images/punta_mesa_logo.png" alt="Dashboard Icon" class="icon" style="width: 1.2rem; height: 1.2rem;">
        <span class="text ms-2">Admin Dashboard</span>
    </a>

    <a href="index.php" class="d-flex align-items-center <?= $current_page == 'statistics' ? 'active' : '' ?>">
        <i class="icon fa-solid fa-chart-area text-info"></i>
        <span class="text ms-2">Overview</span>
    </a>

    <a href="residents.php" class="<?= $current_page == 'residents.php' ? 'active' : '' ?>">
        <i class="icon fa-solid fa-person text-amber-500"></i>
        <span class="text">Residents Records</span>
    </a>
    <a href="midwife.php" class="<?= $current_page == 'midwife.php' ? 'active' : '' ?>">
        <i class="icon fa fa-user-md text-warning"></i>
        <span class="text">Midwife</span>
    </a>
    <a href="bhws.php" class="<?= $current_page == 'bhws.php' ? 'active' : '' ?>">
        <i class="icon fa fa-user-nurse text-red-500"></i>
        <span class="text">BHWs</span>
    </a>
    <a href="events.php" class="<?= $current_page == 'events.php' ? 'active' : '' ?>">
        <i class="icon fa fa-calendar-check text-slate-500"></i>
        <span class="text">Events</span>
    </a>
</div>
