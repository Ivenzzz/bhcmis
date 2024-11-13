<div class="sidebar d-flex flex-column p-3">
    <?php
        $current_page = basename($_SERVER['REQUEST_URI']);
    ?>

    <a href="dashboard.php" class="mb-4">
        <img src="/bhcmis/public/images/punta_mesa_logo.png" alt="Dashboard Icon" class="icon" style="width: 1.2rem; height: 1.2rem;">
        <span class="text ms-2">Admin Dashboard</span>
    </a>


    <a href="home.php" class="d-flex align-items-center <?= $current_page == 'dashboard.php' ? 'active' : '' ?>">
        <span class="icon fa fa-folder-open text-info"></span>
        <span class="text ms-2">Home</span>
    </a>
    <a href="residents.php" class="<?= $current_page == 'residents.php' ? 'active' : '' ?>">
        <span class="icon fa fa-users text-amber"></span>
        <span class="text">Residents</span>
    </a>
    <a href="midwife.php" class="<?= $current_page == 'midwife.php' ? 'active' : '' ?>">
        <span class="icon fa fa-user-md text-warning"></span>
        <span class="text">Midwife</span>
    </a>
    <a href="bhws.php" class="<?= $current_page == 'bhws.php' ? 'active' : '' ?>">
        <span class="icon fa fa-user-nurse text-red"></span>
        <span class="text">BHWs</span>
    </a>
    <a href="events.php" class="<?= $current_page == 'events.php' ? 'active' : '' ?>">
        <span class="icon fa fa-calendar-check text-slate-500"></span>
        <span class="text">Events</span>
    </a>

</div>