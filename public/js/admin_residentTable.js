export function spinRefreshButton() {
    document.addEventListener('DOMContentLoaded', function() {
        const refreshButton = document.querySelector('.left-toolbar button');

        refreshButton.addEventListener('click', function() {
            this.classList.add('spin-animation');
            setTimeout(() => {
                this.classList.remove('spin-animation');
                location.reload();
            }, 500);
        });
    });
}

export function deleteResidents() {
    document.addEventListener('DOMContentLoaded', () => {
        const deleteButton = document.querySelector('.delete-btn');
        const rowCheckboxes = document.querySelectorAll('.row-checkbox');

        const getSelectedResidents = () => {
            const selectedResidents = [];
            rowCheckboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    const residentId = checkbox.dataset.residentId;
                    selectedResidents.push(residentId);
                }
            });
            return selectedResidents;
        };

        const archiveResidents = (selectedResidents) => {
            if (selectedResidents.length > 0) {
                fetch('./app/controllers/admin-residents/delete_residents.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        'resident_ids': selectedResidents
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        selectedResidents.forEach(residentId => {
                            const row = document.querySelector(`tr[data-resident-id="${residentId}"]`);
                            if (row) row.remove();
                        });
                        Swal.fire({
                            title: 'Success',
                            text: `Successfully deleted ${selectedResidents.length} resident(s).`,
                            icon: 'success'
                        }).then(() => {
                            // Reload the page after showing success message
                            window.location.reload();
                        });
                    } else {
                        Swal.fire('Error', 'Error deleting residents', 'error');
                    }
                })
                .catch(error => Swal.fire('Error', 'An error occurred: ' + error, 'error'));
            } else {
                Swal.fire('Error', 'Please select residents to delete.', 'error');
            }
        };

        deleteButton.addEventListener('click', () => {
            const selectedResidents = getSelectedResidents();

            if (selectedResidents.length > 0) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are about to delete the selected residents.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete them!',
                    cancelButtonText: 'No, cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        archiveResidents(selectedResidents);
                    }
                });
            } else {
                Swal.fire('Error', 'Please select residents to delete.', 'error');
            }
        });
    });
}



export function initializeSelectAllCheckbox() {
    const selectAllCheckbox = document.getElementById('select-all');
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.row-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    }
}

export function initDataTable() {
    $(document).ready(function() {
        $('#residentsTable').DataTable({
            responsive: true,
            stateSave: true,
            processing: true,
            language: {
                search: "Filter residents:",
                lengthMenu: "Display _MENU_ residents per page",
                info: "Showing _START_ to _END_ of _TOTAL_ residents"
            },
        });
    });
}







