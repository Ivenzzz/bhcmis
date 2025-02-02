<?php

session_start();

$title = 'Transferred Residents';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/population_analytics.php';

$user = getCurrentUser($conn);
$transferred_residents = getTransferredResidents($conn);

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
                    <li class="breadcrumb-item active" aria-current="page">Transferred Residents</li>
                </ol>
            </nav>

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-people-carry me-2"></i>
                        Transferred Residents
                    </h4>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Date of Birth</th>
                                    <th>Transfer Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($transferred_residents)): ?>
                                    <?php foreach ($transferred_residents as $resident): ?>
                                        <tr>
                                            <td>
                                                <?= htmlspecialchars(
                                                    $resident['lastname'] . ', ' . 
                                                    $resident['firstname'] . ' ' . 
                                                    $resident['middlename']
                                                ) ?>
                                            </td>
                                            <td>
                                                <i class="fas fa-<?= $resident['sex'] === 'male' ? 'mars' : 'venus' ?> 
                                                    text-<?= $resident['sex'] === 'male' ? 'primary' : 'danger' ?>"></i>
                                                <?= ucfirst($resident['sex']) ?>
                                            </td>
                                            <td>
                                                <?= date('M j, Y', strtotime($resident['date_of_birth'])) ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-danger">
                                                    <?= date('M j, Y h:i A', strtotime($resident['transfer_date'])) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-warning ms-2 undo-transfer-btn"
                                                        title="Undo Transfer"
                                                        data-bs-toggle="tooltip"
                                                        data-resident-id="<?= $resident['resident_id'] ?>">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-user-slash fa-2x mb-3"></i>
                                                <p class="mb-0">No transferred residents found</p>
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

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

            // Undo Transfer Functionality
            document.querySelectorAll('.undo-transfer-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    const residentId = this.dataset.residentId;
                    const residentName = this.closest('tr').querySelector('td:first-child').textContent;

                    Swal.fire({
                        title: 'Confirm Undo Transfer',
                        html: `Are you sure you want to undo the transfer status for <b>${residentName}</b>?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, undo transfer',
                        cancelButtonText: 'Cancel',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            undoTransfer(residentId);
                        }
                    });
                });
            });

            async function undoTransfer(residentId) {
                try {
                    const response = await fetch('../controllers/admin_undo_resident_transfer.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ resident_id: residentId })
                    });

                    const result = await response.json();

                    if (result.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Transfer Undone!',
                            text: result.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload(); // Refresh to update the list
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to Undo Transfer',
                            text: result.message
                        });
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Network Error',
                        text: 'Failed to communicate with the server'
                    });
                }
            }
        });
    </script>
</body>
</html>
