document.addEventListener('DOMContentLoaded', function () {
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    document.addEventListener('click', function (event) {
        if (event.target && event.target.id === 'logout-link') {
            event.preventDefault();

            // SweetAlert2 confirmation modal
            Swal.fire({
                title: 'Are you sure you want to logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Logout',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('./app/controllers/logout.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        }
                    })
                    .then(response => response.json())  // Parse JSON response
                    .then(data => {
                        if (data.status === 'success') {
                            // On successful session destruction, redirect to home page
                            window.location.href = '/bhcmis/'; // Redirect to homepage or login page
                        } else {
                            // Handle any error or unsuccessful logout
                            console.error('Logout failed:', data);
                        }
                    })
                    .catch(error => {
                        console.error('Error during logout:', error);
                    });
                }
            });
        }
    });
});