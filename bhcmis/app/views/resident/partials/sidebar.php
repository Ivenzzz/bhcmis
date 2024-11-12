<div class="l-navbar show" id="nav-bar">
    <nav class="nav">
        <div> 
            <a href="/bhcmis/r-appointments" class="nav_logo gradient-text"> 
                <img src="./public/images/punta_mesa_logo.png" alt="Logo" class="admin-logo"> 
                <span class="nav_logo-name">Resident Page</span> 
            </a>
            <div class="nav_list">
                <?php
                $current_page = $_SERVER['REQUEST_URI'];
                ?>

                <a href="/bhcmis/r-appointments" class="nav_link <?= strpos($current_page, '/r-appointments') !== false ? 'active' : '' ?>"> 
                    <i class="fas fa-calendar-check nav_icon"></i>
                    <span class="nav_name">Appointments</span> 
                </a>

                <a href="/bhcmis/r-med-history" class="nav_link <?= strpos($current_page, '/r-med-history') !== false ? 'active' : '' ?>"> 
                    <i class="fas fa-notes-medical nav_icon"></i> 
                    <span class="nav_name">Medical History</span> 
                </a>

                <a href="/bhcmis/r-clinic-record" class="nav_link <?= strpos($current_page, '/r-clinic-record') !== false ? 'active' : '' ?>"> 
                    <i class="fas fa-file-medical-alt nav_icon"></i> 
                    <span class="nav_name">Clinical Records</span> 
                </a>
            </div>
        </div>
    </nav>
</div>
