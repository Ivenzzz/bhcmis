<?php

session_start();

$title = 'Deceased Residents';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/population_analytics.php';

$user = getCurrentUser($conn);
$deceased_residents = getDeceasedResidents($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require '../partials/global_head.php'; ?>
    <link rel="stylesheet" href="../public/css/main.css">
</head>
<body class="poppins-regular">
    <?php require 'partials/sidebar.php'; ?>

    <div class="flex-grow-1 bg-slate-100">

        <?php require 'partials/header.php'; ?>        
        <div class="container mt-4 px-5">

            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Overview</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Deceased Residents</li>
                </ol>
            </nav>

            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0">Deceased Residents</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th><i class="fas fa-user-tag me-2"></i>Name</th>
                                        <th><i class="fas fa-venus-mars me-2"></i>Gender</th>
                                        <th><i class="fas fa-birthday-cake me-2"></i>Date of Birth</th>
                                        <th><i class="fas fa-cross me-2"></i>Deceased Date</th>
                                        <th><i class="fas fa-tools me-2"></i>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($deceased_residents)): ?>
                                        <?php foreach ($deceased_residents as $resident): ?>
                                            <tr>
                                                <td>
                                                    <i class="fas fa-user-slash text-muted me-2"></i>
                                                    <?= htmlspecialchars(
                                                        $resident['lastname'] . ', ' . 
                                                        $resident['firstname'] . ' ' . 
                                                        $resident['middlename']
                                                    ) ?>
                                                </td>
                                                <td>
                                                    <i class="fas fa-<?= $resident['sex'] === 'male' ? 'mars' : 'venus' ?> 
                                                        text-<?= $resident['sex'] === 'male' ? 'primary' : 'danger' ?> fa-lg"></i>
                                                    <span class="ms-2"><?= ucfirst($resident['sex']) ?></span>
                                                </td>
                                                <td>
                                                    <i class="fas fa-calendar-day text-secondary me-2"></i>
                                                    <?= date('M j, Y', strtotime($resident['date_of_birth'])) ?>
                                                </td>
                                                <td>
                                                    <span class="badge bg-dark">
                                                        <i class="fas fa-skull me-2"></i>
                                                        <?= date('M j, Y', strtotime($resident['deceased_date'])) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-warning undo-deceased-btn"
                                                            title="Restore Resident"
                                                            data-bs-toggle="tooltip"
                                                            data-resident-id="<?= $resident['resident_id'] ?>">
                                                        <i class="fas fa-undo me-2"></i>Restore
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="fas fa-peace fa-3x mb-3 text-success"></i>
                                                    <p class="mb-0 fs-5">No deceased residents recorded</p>
                                                    <small class="text-muted">All residents are currently active</small>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Attach click event to all restore buttons
            document.querySelectorAll('.undo-deceased-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const residentId = this.getAttribute('data-resident-id');

                    // Confirm action with SweetAlert
                    Swal.fire({
                        title: 'Restore Resident?',
                        text: 'Are you sure you want to restore this resident? This will mark them as active again.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, restore!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Send POST request to restore resident
                            fetch('../controllers/admin_restore_deceased_resident.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({ resident_id: residentId })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Show success message
                                    Swal.fire({
                                        title: 'Success!',
                                        text: data.message,
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        // Reload the page to reflect changes
                                        window.location.reload();
                                    });
                                } else {
                                    // Show error message
                                    Swal.fire({
                                        title: 'Error!',
                                        text: data.message,
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'An unexpected error occurred. Please try again.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            });
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>
