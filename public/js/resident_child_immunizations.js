handleAddChildAppointment();
handleCancelAppointment();

function handleAddChildAppointment() {
    document.addEventListener('DOMContentLoaded', () => {
        const setAppointmentForm = document.getElementById('setAppointmentForm');

        setAppointmentForm.addEventListener('submit', async (event) => {
            event.preventDefault();  // Prevent the default form submission

            // Get the form data
            const childId = document.getElementById('childSelect').value;
            const scheduleId = document.getElementById('scheduleSelect').value;

            // Validate the form data
            if (!childId || !scheduleId) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please select both child and schedule!',
                });
                return;
            }

            // Create form data object
            const formData = new FormData();
            formData.append('child_id', childId);
            formData.append('schedule_id', scheduleId);

            try {
                // Send the data via fetch to the server
                const response = await fetch('../controllers/resident_add_children_immunization_appointment.php', {
                    method: 'POST',
                    body: formData,
                });

                const data = await response.json();

                // Handle the response
                if (data.status === 'success') {
                    // Success - show a success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                    }).then(() => {
                        // Refresh the page after success
                        location.reload();
                    });
                } else {
                    // Error - show an error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                    });
                }
            } catch (error) {
                // Network or other errors
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'There was an issue with the request. Please try again later.',
                });
            }
        });
    });
}

function handleCancelAppointment() {
    document.addEventListener("DOMContentLoaded", function() {
        // Select all cancel appointment buttons
        const cancelButtons = document.querySelectorAll('.cancel-appointment-btn');
    
        cancelButtons.forEach(button => {
            button.addEventListener('click', function() {
                const appointmentId = this.getAttribute('data-appointment-id');
                const trackingCode = this.getAttribute('data-tracking-code');
    
                // Show SweetAlert confirmation modal
                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to cancel appointment with tracking code: ${trackingCode}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, cancel it!',
                    cancelButtonText: 'No, keep it',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send a POST request to cancel the appointment
                        fetch('../controllers/resident_cancel_immunization_appointment.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({ appointment_id: appointmentId })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    'Cancelled!',
                                    'Your appointment has been cancelled.',
                                    'success'
                                ).then(() => {
                                    // Reload the page after the modal closes
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    data.message || 'An error occurred while cancelling the appointment.',
                                    'error'
                                );
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error); // Log any error for debugging
                            Swal.fire(
                                'Error!',
                                'Something went wrong. Please try again later.',
                                'error'
                            );
                        });
                    }
                });
            });
        });
    });
}