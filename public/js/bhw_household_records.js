initHouseholdDataTable();
archiveHousehold();


function initHouseholdDataTable() {
    $(document).ready(function() {
        $('#householdsTable').DataTable({
            "order": [[0, 'desc']], // Sort by the first column in descending order
            "responsive": true,    // Enable responsive layout
            "stateSave": true,     // Enable state saving
            "language": {
                "search": "Filter Households: ", // Custom text for search bar
                "lengthMenu": "_MENU_ households per page", // Custom text for paging dropdown
                "info": "Showing _START_ to _END_ of _TOTAL_ entries", // Customize table information
                "loadingRecords": "Loading...", // Text while loading data
                "zeroRecords": "No matching households found" // Text when no data matches the filter
            }
        });
    });
}

function archiveHousehold() {
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const householdId = this.getAttribute('data-id');

                // Show SweetAlert modal
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to delete this household? Data will be archived after.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send POST request using fetch
                        fetch('../controllers/bhw_delete_household.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: `household_id=${encodeURIComponent(householdId)}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    'Deleted!',
                                    'The household has been deleted.',
                                    'success'
                                ).then(() => {
                                    // Reload the page or remove the row
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    data.message || 'Something went wrong. Please try again.',
                                    'error'
                                );
                            }
                        })
                        .catch(() => {
                            Swal.fire(
                                'Error!',
                                'Unable to delete household. Please try again.',
                                'error'
                            );
                        });
                    }
                });
            });
        });
    });
}