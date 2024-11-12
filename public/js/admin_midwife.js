import { initializePopover } from './navigations.js';

initializePopover();
handleUpdateUrl();

function handleUpdateUrl() {
        // Check if the URL contains a 'status' parameter
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');

        // If the status parameter exists, show the SweetAlert
        if (status === 'success') {
            Swal.fire({
                title: 'Success!',
                text: 'Midwife information updated successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                // Remove the 'status' parameter from the URL
                const newUrl = window.location.pathname; // Keep only the URL without query params
                window.history.replaceState(null, '', newUrl);
            });
        } else if (status === 'error') {
            Swal.fire({
                title: 'Error!',
                text: 'There was an error updating the midwife information. Please try again.',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(() => {
                // Remove the 'status' parameter from the URL
                const newUrl = window.location.pathname;
                window.history.replaceState(null, '', newUrl);
            });
        }

        // Preview profile picture change
        document.getElementById('profile_picture').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.querySelector('img[alt="Profile Picture"]').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
}


