handleAddChildAppointment();

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