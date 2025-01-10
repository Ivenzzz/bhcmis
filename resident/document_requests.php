<?php

session_start();

$title = 'Document Requests';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/documents_request.php';

$user = getCurrentUser($conn);
$resident_id = $user['resident_id'];
$children_ids = getChildrenIds($conn, $resident_id);
$children = getChildrenInfoByResidentIds($conn, $children_ids);
$medical_certificate_requests = getMedicalCertificatesByResidentId($conn, $resident_id);

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
                <div class="col-md-6">
                    <a href="document_requests.php" class="btn btn-success btn-sm">Medical Certificate</a>
                    <a href="referral_slip_requests.php" class="btn btn-secondary btn-sm">Referral Slip</a>
                </div>
            </div>

            <div class="row mb-4 p-4 shadow">
                <div class="col-md-12">
                    <h4 class="poppins-semibold mb-3">Request a Medical Certificate</h4>
                    <form action="submit_medical_certificate_request.php" method="POST">
                        <div class="mb-3">
                            <label for="purpose" class="form-label">Purpose</label>
                            <input type="text" class="form-control" id="purpose" name="purpose" placeholder="E.g., Job Application, School Requirement" required>
                        </div>

                        <div class="mb-3">
                            <label for="other_receiver" class="form-label">Other Receiver</label>
                            <select class="form-control" id="other_receiver" name="other_receiver">
                                <option value="">Select your child</option>
                                <?php foreach ($children as $child): ?>
                                    <option value="<?= $child['resident_id'] ?>"><?= $child['firstname'] . ' ' . $child['lastname'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Hidden input for resident_id -->
                        <input type="hidden" name="resident_id" value="<?= $resident_id ?>">

                        <button type="submit" class="btn btn-primary">Submit Request</button>
                    </form>

                </div>
            </div>

            <div class="row mb-4 p-4 shadow">
                <div class="col-md-12">
                    <?php if (!empty($medical_certificate_requests)): ?>
                        <div class="table-responsive">
                            <table class="table text-center table-primary text-xs">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Purpose</th>
                                        <th>Request Date</th>
                                        <th>Issue Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($medical_certificate_requests as $request): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($request['purpose']); ?></td>
                                            <td><?php echo (new DateTime($request['request_date']))->format('F j, Y | g:i A'); ?></td>
                                            <td><?php echo isset($request['issue_date']) ? htmlspecialchars($request['issue_date']) : 'Not issued'; ?></td>
                                            <td class="<?php echo 
                                                ($request['status'] == 'Pending') ? 'text-amber-500' : 
                                                (($request['status'] == 'Cancelled') ? 'text-red-500' : 
                                                (($request['status'] == 'Approved') ? 'text-green-500' : '')); 
                                            ?>">
                                                <?php echo htmlspecialchars($request['status']); ?>
                                            </td>
                                            <td><a href="view_certificate.php?id=<?php echo $request['certificate_id']; ?>" class="btn btn-info btn-sm">View</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p>No medical certificate requests found for this resident.</p>
                    <?php endif; ?>
                </div>
            </div>


        </div>
    </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/resident_document_requests.js"></script>
</body>
</html>
