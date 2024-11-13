<div class="l-navbar show" id="nav-bar">
    <nav class="nav">
        <div> 
            <!-- Logo Section -->
            <a href="/bhcmis/bhw" class="nav_logo gradient-text"> 
                <img src="./public/images/punta_mesa_logo.png" alt="Logo" class="admin-logo"> 
                <span class="nav_logo-name">BHW Dashboard</span> 
            </a>

            <!-- Navigation Links -->
            <div class="nav_list">
                <?php
                $current_page = $_SERVER['REQUEST_URI'];
                ?>

                <a href="/bhcmis/bhw" class="nav_link <?= preg_match('/^\/bhcmis\/bhw$/', $current_page) ? 'active' : '' ?>"> 
                    <i class='bx bx-home nav_icon'></i> 
                    <span class="nav_name">Home</span> 
                </a>


                <!-- Household Profiling Link -->
                <a href="/bhcmis/bhw-household-profiling" class="nav_link <?= strpos($current_page, '/bhw-household-profiling') !== false ? 'active' : '' ?>"> 
                    <i class='bx bxs-home-heart nav_icon'></i>
                    <span class="nav_name">Household Profiling</span> 
                </a>

            </div>
        </div>
    </nav>
</div>
