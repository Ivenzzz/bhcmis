initMedicalConditionsTable();
handleUpdateResidentForm();

function initMedicalConditionsTable() {
    $(document).ready(function() {
        $('#medicalConditionsTable').DataTable({
            "paging": true,         // Enable pagination
            "searching": true,      // Enable search functionality
            "ordering": true,       // Enable sorting functionality
            "info": true,           // Show information about the table
            "lengthMenu": [5, 10, 25, 50],  // Set the page length options
        });
    });
}

function handleUpdateResidentForm() {
    document.addEventListener('DOMContentLoaded', function () {
        // Select the form by its ID
        const form = document.getElementById('updateResidentPersonalInformationForm');

        form.addEventListener('submit', function (event) {
            event.preventDefault();  // Prevent the default form submission

            // Create a FormData object to gather form data
            const formData = new FormData(form);

            // Make the Fetch request to submit the form
            fetch('../controllers/admin_update_resident_personal_information.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())  // Parse the JSON response
            .then(data => {
                // Handle the response message
                if (data.status === 'success') {
                    // Success - Show success message using SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    // Error - Show error message using SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                        confirmButtonText: 'Try Again'
                    });
                }
            })
            .catch(error => {
                // Handle network or other unexpected errors
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong. Please try again.',
                    confirmButtonText: 'Try Again'
                });
            });
        });
    });
}