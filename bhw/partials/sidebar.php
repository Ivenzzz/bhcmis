<div class="sidebar d-flex flex-column p-3">
    <?php
        $current_page = basename($_SERVER['REQUEST_URI']);
        if ($current_page == '' || $current_page == 'index.php') {
            $current_page = 'overview';
        }
    ?>

    <a href="#" class="mb-4">
        <img src="/bhcmis/public/images/punta_mesa_logo.png" alt="Dashboard Icon" class="icon" style="width: 1.2rem; height: 1.2rem;">
        <span class="text ms-2">BHW Dashboard</span>
    </a>

    <a href="index.php" class="d-flex align-items-center <?= $current_page == 'overview' ? 'active' : '' ?>">
        <i class="icon fa-solid fa-chart-area text-info"></i>
        <span class="text ms-2">Overview</span>
    </a>

    <a href="household_records.php" class="d-flex align-items-center <?= $current_page == 'household_records.php' ? 'active' : '' ?>">
        <i class="icon fa-solid fa-file-alt text-green-500"></i>
        <span class="text ms-2">Household Records</span>
    </a>
</div>
