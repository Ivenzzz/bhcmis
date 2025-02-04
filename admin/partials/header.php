<nav class="navbar navbar-expand-lg navbar-dark bg-dark header p-2">
    <div class="container-fluid">
        <div class="ms-auto avatar-menu dropdown">
            <span class="me-2">Welcome, <?= htmlspecialchars($user['username'] ?? 'User'); ?></span>
            <img src="<?= htmlspecialchars($user['profile_picture']); ?>" alt="Avatar" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            
            <ul class="dropdown-menu dropdown-menu-end p-3">
                <li><a class="dropdown-item" href="profile.php"><span class="bi bi-person-fill me-2"></span>Profile</a></li>
                <li><a class="dropdown-item text-danger" href="#" id="logoutBtn"><span class="bi bi-box-arrow-right me-2"></span>Logout</a></li>
            </ul>
        </div>
    </div>
</nav>