initFamilyDataTable();
showDeleteFamilyModal();

function initFamilyDataTable() {
    $(document).ready(function () {
        $('#familiesTable').DataTable({
            responsive: true,
            pageLength: 10,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false
        });
    });
}

function showDeleteFamilyModal() {
    document.addEventListener("DOMContentLoaded", function () {
        // Add event listeners to all delete buttons
        const deleteButtons = document.querySelectorAll(".delete-family-btn");

        deleteButtons.forEach(button => {
            button.addEventListener("click", function () {
                const familyId = this.getAttribute("data-family-id");
                const householdId = this.getAttribute("data-household-id");

                // Show SweetAlert confirmation modal
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33", // Red for the delete button
                    cancelButtonColor: "#3085d6", // Blue for the cancel button
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "Cancel" // Customize cancel button text
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, send a POST request to delete the family
                        fetch('../controllers/bhw_delete_family.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `family_id=${encodeURIComponent(familyId)}&household_id=${encodeURIComponent(householdId)}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    "Deleted!",
                                    "The family has been deleted.",
                                    "success"
                                ).then(() => {
                                    // Reload the page to reflect changes
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire(
                                    "Error!",
                                    data.message || "An error occurred while deleting the family.",
                                    "error"
                                );
                            }
                        })
                        .catch(error => {
                            Swal.fire(
                                "Error!",
                                "Unable to process the request. Please try again.",
                                "error"
                            );
                        });
                    }
                });
            });
        });
    });
}