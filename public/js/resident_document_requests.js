handleMedCertRequest();

function handleMedCertRequest() {
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('form');
        const submitButton = form.querySelector('button[type="submit"]');

        form.addEventListener('submit', async (event) => {
            event.preventDefault(); // Prevent the default form submission

            // Disable the submit button to prevent multiple submissions
            submitButton.disabled = true;

            // Gather form data
            const formData = new FormData(form);
            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });

            try {
                // Send data to the server using Fetch API
                const response = await fetch('../controllers/resident_add_medical_certificate_request.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                });

                // Check for successful response
                if (response.ok) {
                    const result = await response.json();
                    // Show success message using SweetAlert
                    Swal.fire({
                        title: 'Success!',
                        text: result.message,
                        icon: 'success',
                        confirmButtonText: 'OK',
                    });
                    form.reset(); // Reset the form
                } else {
                    const error = await response.json();
                    // Show error message using SweetAlert
                    Swal.fire({
                        title: 'Error!',
                        text: error.message,
                        icon: 'error',
                        confirmButtonText: 'Try Again',
                    });
                }
            } catch (error) {
                // Show error message using SweetAlert for network issues
                Swal.fire({
                    title: 'Oops!',
                    text: 'There was an error with the request: ' + error.message,
                    icon: 'error',
                    confirmButtonText: 'Close',
                });
            } finally {
                // Re-enable the submit button
                submitButton.disabled = false;
            }
        });
    });
}