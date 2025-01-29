<?php
session_start();

$title = 'Document Requests';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/documents_request.php';

$user = getCurrentUser($conn);
$admin = getAdminInformation($conn, $user['admin_id']);
$referral_requests = getAllReferralRequests($conn);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require '../partials/global_head.php'; ?>
    <link rel="stylesheet" href="../public/css/main.css">
    <style>
        /* Custom modal size */
        .pdf-modal .modal-dialog {
            max-width: 90%;
            height: 90vh;
        }
        .pdf-modal .modal-content {
            height: 100%;
        }
        .pdf-modal iframe {
            width: 100%;
            height: 85vh;
            border: none;
        }
    </style>
</head>
<body class="poppins-regular">
    <?php require 'partials/sidebar.php'; ?>

    <div class="flex-grow-1 bg-slate-100">
        <?php require 'partials/header.php'; ?>        
        <div class="container mt-4 px-5">

            <div class="row mb-4">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Referral Requests</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Referral Requests Table -->
            <div class="row mb-4 shadow p-4">
                <div class="col-12">
                    <table id="referralTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Request Date</th>
                                <th>Resident Name</th>
                                <th>Referring Personnel</th>
                                <th>Referring Facility</th>
                                <th>Purpose</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($referral_requests as $request): ?>
                                <tr>
                                    <td><?php echo date('F j, Y | h:i A', strtotime($request['request_date'] ?? '')); ?></td>
                                    <td><?php echo htmlspecialchars(($request['firstname'] ?? 'None') . ' ' . ($request['lastname'] ?? 'None')); ?></td>
                                    <td><?php echo htmlspecialchars($request['referring_physician'] ?? 'None'); ?></td>
                                    <td><?php echo htmlspecialchars($request['referring_to_facility'] ?? 'None'); ?></td>
                                    <td><?php echo htmlspecialchars($request['purpose'] ?? 'None'); ?></td>
                                    <td><?php echo htmlspecialchars($request['status'] ?? 'None'); ?></td>
                                    <td>
                                        <?php if ($request['status'] == 'Approved' && !empty($request['document_path'])): ?>
                                            <!-- View Form button triggers modal -->
                                            <button type="button" 
                                                    class="btn btn-info btn-sm" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#pdfModal<?= $request['referral_id'] ?>">
                                                View Form
                                            </button>

                                            <!-- Individual Modal for each PDF -->
                                            <div class="modal fade" 
                                                id="pdfModal<?= $request['referral_id'] ?>" 
                                                tabindex="-1" 
                                                aria-labelledby="pdfModalLabel<?= $request['referral_id'] ?>" 
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="pdfModalLabel<?= $request['referral_id'] ?>">
                                                                Referral Form #<?= htmlspecialchars($request['referral_id']) ?>
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body p-0">
                                                            <!-- Embed PDF using iframe -->
                                                            <iframe src="<?= htmlspecialchars($request['document_path']) ?>" 
                                                                    style="width: 100%; height: 80vh;" 
                                                                    frameborder="0" 
                                                                    allowfullscreen>
                                                            </iframe>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <!-- Existing Sign and Approve button -->
                                            <a href="generate_referral_form.php?referral_id=<?= htmlspecialchars($request['referral_id']) ?>" 
                                            class="btn btn-primary btn-sm">
                                                Sign and Approve
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            
        </div>
    </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#referralTable').DataTable();
        });
</script>
</body>
</html>
