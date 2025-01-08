handleAddAppointmentForm();
handleCancelAppointment();

function handleAddAppointmentForm() {
    document.getElementById("addImmunizationAppointmentForm").addEventListener("submit", async function (e) {
        e.preventDefault(); // Prevent default form submission

        const form = e.target;
        const formData = new FormData(form);

        try {
            // Send POST request to the server
            const response = await fetch("../controllers/resident_add_immunization_appointment.php", {
                method: "POST",
                body: formData,
            });

            const result = await response.json();

            if (result.success) {
                // Show success message with SweetAlert
                Swal.fire({
                    title: "Appointment Added!",
                    html: `
                        <p><strong>Tracking Code:</strong> ${result.tracking_code}</p>
                        <p><strong>Priority Number:</strong> ${result.priority_number}</p>
                    `,
                    icon: "success",
                    confirmButtonText: "OK",
                }).then(() => {
                    // Optionally refresh the page or close the modal after success
                    location.reload();
                });
            } else {
                // Show error message with SweetAlert
                Swal.fire({
                    title: "Error",
                    text: result.message,
                    icon: "error",
                    confirmButtonText: "OK",
                });
            }
        } catch (error) {
            console.error("Error:", error);

            // Show generic error message
            Swal.fire({
                title: "Error",
                text: "An unexpected error occurred. Please try again.",
                icon: "error",
                confirmButtonText: "OK",
            });
        }
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

