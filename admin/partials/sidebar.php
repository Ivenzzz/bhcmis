<div class="l-navbar show" id="nav-bar">
    <nav class="nav">
        <div> 
            <a href="/bhcmis/admin" class="nav_logo gradient-text"> 
                <img src="../public/images/punta_mesa_logo.png" alt="Logo" class="admin-logo"> 
                <span class="nav_logo-name">Admin Dashboard</span> 
            </a>
            <div class="nav_list">
                <?php
                $current_page = $_SERVER['REQUEST_URI'];
                ?>

                <a href="/bhcmis/admin" class="nav_link <?= preg_match('/^\/bhcmis\/admin$/', $current_page) ? 'active' : '' ?>"> 
                    <i class="fa-solid fa-house nav_icon"></i>
                    <span class="nav_name">Home</span> 
                </a>

                <a href="/bhcmis/admin-residents" class="nav_link <?= strpos($current_page, '/admin-residents') !== false ? 'active' : '' ?>"> 
                    <i class="fa-solid fa-users nav_icon"></i>
                    <span class="nav_name">Residents</span> 
                </a> 

                <a href="/bhcmis/admin-midwife" class="nav_link <?= strpos($current_page, '/admin-midwife') !== false ? 'active' : '' ?>"> 
                    <i class="fa-solid fa-user-doctor nav_icon"></i>
                    <span class="nav_name">Midwife</span> 
                </a>

                <a href="/bhcmis/admin-bhws" class="nav_link <?= strpos($current_page, '/admin-bhws') !== false ? 'active' : '' ?>"> 
                    <i class="fa-solid fa-user-nurse nav_icon"></i>
                    <span class="nav_name">BHWs</span> 
                </a>

                <a href="/bhcmis/admin-events" class="nav_link <?= strpos($current_page, '/admin-events') !== false ? 'active' : '' ?>"> 
                    <i class='bx bxs-calendar-check'></i>
                    <span class="nav_name">Events</span> 
                </a> 
            </div>
        </div>
    </nav>
</div>
