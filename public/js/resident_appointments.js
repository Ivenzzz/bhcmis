initUrlHandler();
initFilterCards();
displayAddAppointmentResults();
displayCancelAppointmentResults();


function initUrlHandler() {
    function getQueryParameter(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }
    
    // Show SweetAlert based on Message
    const message = getQueryParameter('message');
    if (message) {
        Swal.fire({
            icon: message.includes('successfully') ? 'success' : 'error',
            title: message.includes('successfully') ? 'Success' : 'Oops...',
            text: message,
            confirmButtonText: 'OK'
        });
    }
    
    // Clear URL parameters when the page loads
    window.onload = function() {
        if (window.history.replaceState) {
            // Clear the parameters in the URL without reloading the page
            window.history.replaceState(null, null, window.location.pathname);
        }
    };
}

function initFilterCards() {
    document.getElementById('statusFilter').addEventListener('change', function() {
        var selectedStatus = this.value;  // Get the selected filter value
        var appointments = document.querySelectorAll('.appointment-card');  // Get all appointment cards

        // Loop through all appointment cards
        appointments.forEach(function(appointment) {
            var appointmentStatus = appointment.getAttribute('data-status');  // Get the status of the current appointment

            // Show or hide the appointment based on filter selection
            if (selectedStatus === 'all' || appointmentStatus === selectedStatus) {
                appointment.style.display = 'block'; // Show the appointment
            } else {
                appointment.style.display = 'none'; // Hide the appointment
            }
        });
    });    
}

function displayAddAppointmentResults() {
    document.addEventListener('DOMContentLoaded', function () {
        // Get references to the form and modal elements
        const form = document.getElementById('addAppointmentForm');
        const scheduleSelect = document.getElementById('schedule');
        const residentIdInput = form.querySelector('input[name="resident_id"]');
        
        // Handle form submission
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            // Get the form data
            const formData = new FormData(form);

            // Show loading indication if needed
            const submitButton = form.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.textContent = 'Submitting...';

            // Send the POST request using fetch
            fetch('../controllers/resident_add_consultation_appointment.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json()) // Parse the JSON response
            .then(data => {
                // Handle response
                if (data.success) {
                    // Success: Show SweetAlert success modal
                    Swal.fire({
                        icon: 'success',
                        title: 'Appointment Added',
                        text: 'Appointment added successfully! Tracking Code: ' + data.data.tracking_code,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Reload the page after success
                        window.location.reload(); // Reload the current page
                    });
                } else {
                    // Failure: Show SweetAlert error modal
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                // Handle errors
                console.error('Error during submission:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'An error occurred. Please try again later.',
                    confirmButtonText: 'OK'
                });
            })
            .finally(() => {
                // Re-enable the submit button after the request is complete
                submitButton.disabled = false;
                submitButton.textContent = 'Add Appointment';
            });
        });
    });
}

function displayCancelAppointmentResults() {
    document.addEventListener('DOMContentLoaded', function () {
        // Use event delegation for dynamically loaded buttons
        document.body.addEventListener('click', function (event) {
            // Check if the clicked element has the class "cancel-appointment-btn"
            if (event.target.classList.contains('cancel-appointment-btn')) {
                const button = event.target;

                // Extract the appointment ID and status from the button's data attributes
                const appointmentId = button.getAttribute('data-appointment-id');
                const status = button.getAttribute('data-status');

                if (status !== 'Scheduled') {
                    Swal.fire({
                        icon: 'info',
                        title: 'Invalid Action',
                        text: 'This appointment cannot be canceled as it is already ' + status + '.',
                        confirmButtonText: 'OK',
                    });
                    return;
                }

                // Confirm cancellation using SweetAlert
                Swal.fire({
                    icon: 'warning',
                    title: 'Cancel Appointment?',
                    text: 'Are you sure you want to cancel this appointment?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Cancel',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send cancellation request to the server
                        fetch('../controllers/resident_cancel_consultation_appointment.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ appointment_id: appointmentId }),
                        })
                            .then((response) => response.json())
                            .then((data) => {
                                if (data.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Appointment Canceled',
                                        text: 'Your appointment has been successfully canceled.',
                                        confirmButtonText: 'OK',
                                    }).then(() => {
                                        // Reload the page to reflect the changes
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: data.message || 'Unable to cancel the appointment. Please try again.',
                                        confirmButtonText: 'OK',
                                    });
                                }
                            })
                            .catch((error) => {
                                console.error('Error:', error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops!',
                                    text: 'An error occurred. Please try again later.',
                                    confirmButtonText: 'OK',
                                });
                            });
                    }
                });
            }
        });
    });
}

