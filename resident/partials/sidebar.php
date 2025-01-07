<div class="sidebar d-flex flex-column p-3">
    <?php
        $current_page = basename($_SERVER['REQUEST_URI']);
        if ($current_page == '' || $current_page == 'index.php') {
            $current_page = 'index';
        }
    ?>

    <a href="#" class="mb-4">
        <img src="/bhcmis/public/images/punta_mesa_logo.png" alt="Dashboard Icon" class="icon" style="width: 1.2rem; height: 1.2rem;">
        <span class="text ms-2">Resident's Page</span>
    </a>

    <a href="index.php" class="<?= in_array(basename($_SERVER['PHP_SELF']), ['index.php', 'consultation_details.php']) ? 'active' : '' ?>">
        <i class="icon fa-solid fa-calendar-check text-success"></i>
        <span class="text ms-2">Appointments</span>
    </a>

    <a href="medical_history.php" class="d-flex align-items-center <?= $current_page == 'medical_history.php' ? 'active' : '' ?>">
        <i class="icon fa-solid fa-clipboard-list text-amber-500"></i>
        <span class="text ms-2">Medical History</span>
    </a>

    <a href="document_requests.php" class="<?= in_array(basename($_SERVER['PHP_SELF']), ['document_requests.php']) ? 'active' : '' ?>">
        <i class="icon fa-solid fa-file-contract text-red-500"></i>
        <span class="text ms-2">Document Requests</span>
    </a>

</div>
