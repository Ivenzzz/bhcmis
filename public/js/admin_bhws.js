import { initializePopover } from './navigations.js';
import { confirmDelete } from './admin-bhws-functions.js';

initializePopover();
handleAlerts();


// Attach event listeners to delete buttons after the DOM has fully loaded
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.delete-bhw').forEach(button => {
        button.addEventListener('click', function () {
            const bhwId = this.getAttribute('data-bhw-id');
            confirmDelete(bhwId);  // Call the confirmDelete function
        });
    });
});


// Named function to handle URL parameters and alerts
function handleAlerts() {
    // Function to get URL parameters
    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }

    // Function to clear URL parameters without reloading the page
    function clearUrlParameters() {
        const url = new URL(window.location);
        url.searchParams.delete('update_success');
        url.searchParams.delete('error');
        window.history.replaceState({}, document.title, url.pathname);
    }

    // Function to check for success or error parameters and show corresponding alerts
    function checkAlerts() {
        var updateSuccess = getUrlParameter('update_success');
        var errorType = getUrlParameter('error');

        if (updateSuccess === 'true') {
            // Show success modal
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'BHW information updated successfully.',
                confirmButtonText: 'OK'
            }).then(() => {
                // Clear URL parameters after the success alert is closed
                clearUrlParameters();
            });
        }

        if (errorType) {
            let errorMessage = '';

            // Set error message based on the error type
            switch (errorType) {
                case 'assigned_area_taken':
                    errorMessage = 'The selected area is already assigned to another Barangay Health Worker.';
                    break;
                case 'bhw_area_update_failed':
                    errorMessage = 'Error updating BHW area.';
                    break;
                case 'personal_info_update_failed':
                    errorMessage = 'Error updating personal information.';
                    break;
                default:
                    errorMessage = 'An unknown error occurred.';
            }

            // Show error modal
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: errorMessage,
                confirmButtonText: 'OK'
            }).then(() => {
                // Clear URL parameters after the error alert is closed
                clearUrlParameters();
            });
        }
    }

    // Run the checkAlerts function
    checkAlerts();
}

