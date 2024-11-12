initUrlHandler();
initFilterCards();


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
