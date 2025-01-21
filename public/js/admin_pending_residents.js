initPendingResidents();
handleApproveResident();
handleRejectResident();

function initPendingResidents() {
    $(document).ready(function () {
        $('#pendingResidentsTable').DataTable({
            "language": {
                "emptyTable": "No pending residents found"
            },
        });
    });
}

function handleApproveResident() {
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.approve-btn').forEach(function (button) {
            button.addEventListener('click', function () {
                const accountId = this.getAttribute('data-account-id');

                fetch('../controllers/admin_approve_registration.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ account_id: accountId })
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    }
                    throw new Error('Network response was not ok.');
                })
                .then(data => {
                    if (data.success) {
                        // Display SweetAlert success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Resident Approved',
                            text: 'The resident has been approved successfully!',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload(); // Reload the page to update the resident list
                        });
                    } else {
                        // Display SweetAlert error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message || 'An unknown error occurred.',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    // Display SweetAlert error message for fetch failure
                    Swal.fire({
                        icon: 'error',
                        title: 'Request Failed',
                        text: 'There was an error processing your request: ' + error.message,
                        confirmButtonText: 'OK'
                    });
                });
            });
        });
    });
}

function handleRejectResident() {
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.reject-btn').forEach(function (button) {
            button.addEventListener('click', function () {
                const accountId = this.getAttribute('data-account-id'); // Get the account_id
    
                // Trigger SweetAlert confirmation
                Swal.fire({
                    icon: 'warning',
                    title: 'Are you sure?',
                    text: 'You are about to reject this resident registration!',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Reject',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send the rejection request if confirmed
                        fetch('../controllers/admin_reject_resident.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ account_id: accountId }) // Send account_id instead of resident_id
                        })
                        .then(response => {
                            if (response.ok) {
                                return response.json();
                            }
                            throw new Error('Network response was not ok.');
                        })
                        .then(data => {
                            if (data.success) {
                                // Show success message and reload the page
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Resident Rejected',
                                    text: 'The resident has been rejected successfully.',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload(); // Reload the page to update the list
                                });
                            } else {
                                // Show error message if the operation fails
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.message || 'An unknown error occurred.',
                                    confirmButtonText: 'OK'
                                });
                            }
                        })
                        .catch(error => {
                            // Show error message if there's a problem with the fetch
                            Swal.fire({
                                icon: 'error',
                                title: 'Request Failed',
                                text: 'There was an error processing your request: ' + error.message,
                                confirmButtonText: 'OK'
                            });
                        });
                    }
                });
            });
        });
    });
    
}
