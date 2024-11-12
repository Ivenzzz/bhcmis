<header class="header" id="header">
    <div class="header_toggle"> 
        <i class='bx bx-menu nav_icon' id="header-toggle"></i> 
    </div>
    <div class="avatar-menu">
        <div class="header_notifications">
            <i class='bx bx-bell nav_icon'></i>
        </div>
        <div class="header_messages">
            <i class='bx bx-envelope nav_icon'></i>
        </div>
        <div class="header_img"> 
            <img src="<?php echo isset($user['profile_picture']) ? $user['profile_picture'] : '/bhcmis/storage/uploads/avatar-default.png'; ?>" 
                alt="Avatar" 
                id="avatar"
                data-bs-toggle="popover"
                data-bs-trigger="focus"
                data-bs-html="true"
                data-bs-content="<ul class='list-group'>
                                    <li class='list-group-item'>
                                        <a href='#'><i class='bx bx-user'></i> Profile</a>
                                    </li>
                                    <li class='list-group-item'>
                                        <a href='#'><i class='bx bx-cog'></i> Settings</a>
                                    </li>
                                    <li class='list-group-item'>
                                        <a href='#' class='logout-text' id='logout-link'><i class='bx bx-log-out'></i> Logout</a>
                                    </li>
                                </ul>"
                tabindex="0">
        </div>
    </div>
</header>