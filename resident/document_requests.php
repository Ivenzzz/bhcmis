<?php

session_start();

$title = 'Document Requests';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/documents_request.php';

$user = getCurrentUser($conn);
$resident_id = $user['resident_id'];
$referral_request = getReferralRequestsByResidentId($conn, $resident_id);


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

            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Referral Request</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-4 p-4">
                <div class="col-md-12 mx-auto">
                    <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#referralModal" title="A referral form is a document used in healthcare which serves as a formal request from a healthcare provider to direct a patient to a more specialized service or professional for further assessment or treatment.">
                        Request a Referral Form
                    </button>
                </div>
            </div>

            <div class="row mb-4 p-4 shadow">
                <div class="col-md-12">
                    <h4 class="poppins-light">Referral Requests</h4>
                    <table class="table table-bordered table-primary text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Request Date</th>
                                <th>Purpose</th>
                                <th>Resolved Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($referral_request) > 0): ?>
                                <?php foreach ($referral_request as $referral): ?>
                                    <tr>
                                        <td><?php echo date('F j, Y | h:i A', strtotime($referral['request_date'])); ?></td>
                                        <td><?php echo htmlspecialchars($referral['purpose']? $referral['purpose'] : 'None'); ?></td>
                                        <td><?php echo $referral['resolved_date'] ? htmlspecialchars($referral['resolved_date']) : 'Not Issued Yet'; ?></td>
                                        <td><?php echo htmlspecialchars($referral['status']); ?></td>
                                        <td>
                                            <button class="btn btn-info">View Document</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">No referral requests found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="referralModal" tabindex="-1" aria-labelledby="referralModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="referralModalLabel">Referral Form Purpose</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="referralForm">
                        <input type="hidden" name="resident_id" value="<?php echo $resident_id?>">
                        <div class="form-group">
                            <label for="purposeInput">Purpose of Referral</label>
                            <input type="text" class="form-control" id="purposeInput" placeholder="Enter the purpose of the referral" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="referralForm" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/resident_document_requests.js"></script>
    <script>
        document.getElementById('referralForm').addEventListener('submit', async function(event) {
    event.preventDefault();  // Prevent the default form submission

    // Get the purpose entered by the user
    const purpose = document.getElementById('purposeInput').value.trim();

    // Ensure purpose is not empty
    if (purpose === '') {
        Swal.fire({
            icon: 'warning',
            title: 'Oops!',
            text: 'Please enter the purpose of the referral.'
        });
        return;
    }

    // Get the resident_id from the hidden input field in the form
    const resident_id = document.querySelector('input[name="resident_id"]').value;

    // Prepare data to send to the server
    const formData = new FormData();
    formData.append('resident_id', resident_id);  // Use resident_id from the form
    formData.append('purpose', purpose);

    try {
        // Send the data to the server using Fetch API
        const response = await fetch('../controllers/resident_add_referral.php', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        if (data.success) {
            // On success, show a success message using SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Referral request submitted successfully.'
            });

            location.reload();

        } else {
            // On failure, show an error message using SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'There was an issue submitting the referral request. Please try again.'
            });
        }
    } catch (error) {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'An error occurred while submitting the referral request.'
        });
    }
});

    </script>
</body>
</html>
