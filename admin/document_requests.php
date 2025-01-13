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
                            <li class="breadcrumb-item active" aria-current="page">Medical Certificate Requests</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Referral Requests Table -->
            <div class="row mb-4">
                <div class="col-12">
                    <table id="referralTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Request Date</th>
                                <th>Resident Name</th>
                                <th>Purpose</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($referral_requests as $request): ?>
                            <tr>
                                <td><?php echo date('F j, Y | h:i A', strtotime($request['request_date'])); ?></td>
                                <td><?php echo htmlspecialchars($request['firstname'] . ' ' . $request['lastname']); ?></td>
                                <td><?php echo htmlspecialchars($request['purpose']? $request['purpose'] : 'None'); ?></td>
                                <td><?php echo htmlspecialchars($request['status']); ?></td>
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
