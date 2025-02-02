initAllResidentsTables();
handleAddResidentForm();

function initAllResidentsTables() {
    $(document).ready(function () {
        $('#residentsTable').DataTable({
            responsive: true,
            pageLength: 5,  // Set the number of rows per page to 5
            lengthMenu: [5, 10, 15, 25, 50],  // Include 5, 10, 15, 25, 50 in the dropdown
            stateSave: true, // Enable state saving
            processing: true, // Show default processing/loading indicator
            language: {
                processing: "Loading...",
                emptyTable: "No residents found"
            },
            
        });
    });
}



function handleAddResidentForm() {
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('createResidentForm').addEventListener('submit', function(event) {
            event.preventDefault();  // Prevent the form from submitting the traditional way

            // Gather form data
            var formData = new FormData(this);

            // Send data to the server using the Fetch API
            fetch('../controllers/admin_add_resident.php', {
                method: 'POST',
                body: formData,  // The form data
            })
            .then(response => response.json())  // Parse the JSON response
            .then(data => {
                if (data.success) {
                    // If successful, show a success message with an OK button
                    Swal.fire({
                        icon: 'success',
                        title: 'Resident added successfully!',
                        showConfirmButton: true,  // Show the OK button
                        confirmButtonText: 'OK',
                    }).then(() => {
                        location.reload();  // Reload the page to show the new resident
                    });
                } else {
                    // If there was an error, show the error message using SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                        showConfirmButton: true,  // Show the OK button
                        confirmButtonText: 'OK',
                    });
                }
            })
            .catch(error => {
                // Handle fetch errors
                Swal.fire({
                    icon: 'error',
                    title: 'An error occurred',
                    text: error,
                    showConfirmButton: true,  // Show the OK button
                    confirmButtonText: 'OK',
                });
            });
        });
    });
}