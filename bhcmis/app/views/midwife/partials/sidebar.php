<div class="l-navbar show" id="nav-bar">
    <nav class="nav">
        <div> 
            <a href="/bhcmis/midwife" class="nav_logo gradient-text"> 
                <img src="./public/images/punta_mesa_logo.png" alt="Logo" class="admin-logo"> 
                <span class="nav_logo-name">Midwife Dashboard</span> 
            </a>
            <div class="nav_list">
                <?php
                $current_page = $_SERVER['REQUEST_URI'];
                ?>

                <!-- Dashboard Link -->
                <a href="/bhcmis/midwife" class="nav_link <?= preg_match('/^\/bhcmis\/midwife$/', $current_page) ? 'active' : '' ?>"> 
                    <i class='bx bx-line-chart nav_icon'></i> 
                    <span class="nav_name">Home</span> 
                </a>

                <a href="/bhcmis/midwife-appointments" class="nav_link <?= strpos($current_page, '/midwife-appointments') !== false ? 'active' : '' ?>"> 
                    <i class="fas fa-calendar-check"></i>
                    <span class="nav_name">Appointments</span> 
                </a>

                <a href="/bhcmis/midwife-prenatals" class="nav_link <?= strpos($current_page, '/midwife-prenatals') !== false ? 'active' : '' ?>"> 
                    <i class="fa-solid fa-female"></i>
                    <span class="nav_name">Prenatal</span> 
                </a>

                <a href="/bhcmis/midwife-medicines" class="nav_link <?= strpos($current_page, '/midwife-medicines') !== false ? 'active' : '' ?>"> 
                    <i class="fa-solid fa-capsules"></i>
                    <span class="nav_name">Medicines</span> 
                </a>

                <a href="/bhcmis/midwife/vaccine-stock" class="nav_link <?= strpos($current_page, '/midwife/vaccine-stock') !== false ? 'active' : '' ?>"> 
                    <i class="fa-solid fa-syringe"></i>
                    <span class="nav_name">Vaccinations</span> 
                </a>

                <a href="/bhcmis/midwife/bhw-tasks" class="nav_link <?= strpos($current_page, '/midwife/bhw-tasks') !== false ? 'active' : '' ?>"> 
                    <i class="fa-solid fa-tasks"></i>
                    <span class="nav_name">Audit Logs</span> 
                </a>    
            </div>
        </div>
    </nav>
</div>
