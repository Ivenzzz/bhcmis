<div class="sidebar d-flex flex-column p-3">
    <?php
        $current_page = basename($_SERVER['REQUEST_URI']);
        if ($current_page == '' || $current_page == 'index.php') {
            $current_page = 'index';
        }
    ?>

    <a href="#" class="mb-4">
        <img src="/bhcmis/public/images/punta_mesa_logo.png" alt="Dashboard Icon" class="icon" style="width: 1.2rem; height: 1.2rem;">
        <span class="text ms-2">Admin Dashboard</span>
    </a>

    <a href="index.php" class="d-flex align-items-center <?= $current_page == 'index' ? 'active' : '' ?>">
        <i class="icon fa-solid fa-people-group text-indigo-500"></i>
        <span class="text ms-2">Population</span>
    </a>

    <a href="residents.php" class="<?= in_array(basename($_SERVER['PHP_SELF']), ['residents.php', 'resident_details.php']) ? 'active' : '' ?>">
        <i class="icon fa-solid fa-person text-amber-500"></i>
        <span class="text">Residents</span>
    </a>

    <a href="households.php" class="<?= in_array(basename($_SERVER['PHP_SELF']), ['households.php', 'families.php', 'family_members.php']) ? 'active' : '' ?>">
        <i class="icon fa-solid fa-house-chimney-user text-green-500"></i>
        <span class="text">Households</span>
    </a>


    <a href="midwife.php" class="<?= in_array(basename($_SERVER['PHP_SELF']), ['midwife.php']) ? 'active' : '' ?>">
        <i class="icon fa fa-user-md text-warning"></i>
        <span class="text">Midwife</span>
    </a>

    <a href="bhws.php" class="<?= in_array(basename($_SERVER['PHP_SELF']), ['bhws.php']) ? 'active' : '' ?>">
        <i class="icon fa fa-user-nurse text-red-500"></i>
        <span class="text">BHWs</span>
    </a>
</div>
