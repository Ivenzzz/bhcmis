toggleShowPasswords();
handleUpdatePassword();
handleProfilePreview();
handleUpdateAccount();
handleUpdatePersonalInfo();

function toggleShowPasswords() {
    // Password toggle functionality (corrected version)
    document.querySelectorAll('.password-toggle').forEach(button => {
        button.addEventListener('click', function() {
            // Get the input field that's adjacent to the toggle button
            const input = this.previousElementSibling;
            const icon = this.querySelector('i');
            
            // Toggle password visibility
            const type = input.type === 'password' ? 'text' : 'password';
            input.type = type;
            
            // Toggle eye icon
            icon.classList.toggle('fa-eye-slash');
            icon.classList.toggle('fa-eye');
        });
    });
}

function handleUpdatePassword() {
    document.querySelector('#changePasswordModal form').addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const form = e.target;
        const account_id = form.querySelector('#account_id').value;
        const currentPassword = form.querySelector('#currentPassword').value;
        const newPassword = form.querySelector('#newPassword').value;
        const confirmPassword = form.querySelector('#confirmPassword').value;

        if (newPassword !== confirmPassword) {
            Swal.fire({
                icon: 'error',
                title: 'Password Mismatch',
                text: 'New password and confirmation password do not match!'
            });
            return;
        }

        try {
            const response = await fetch('../controllers/global_change_password.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    account_id,
                    currentPassword,
                    newPassword,
                    confirmPassword
                })
            });

            const result = await response.json();

            if (result.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: result.message,
                    didClose: () => {
                        location.reload(); // Page reload here
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: result.message
                });
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Network Error',
                text: 'Failed to communicate with the server'
            });
        }
    });
}

function handleProfilePreview() {
    // Image preview handling
    document.querySelector('#profilePicture')?.addEventListener('change', function(e) {
        const input = e.target;
        const previewContainer = document.querySelector('.profile-picture-preview');
        const defaultPreview = document.querySelector('.default-preview');
        const imagePreview = document.querySelector('.preview-image');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                if (imagePreview.tagName === 'IMG') {
                    imagePreview.src = e.target.result;
                } else {
                    const newPreview = document.createElement('img');
                    newPreview.className = 'img-thumbnail rounded-circle preview-image';
                    newPreview.style = 'width: 150px; height: 150px; object-fit: cover;';
                    newPreview.src = e.target.result;
                    previewContainer.replaceChild(newPreview, defaultPreview);
                }
            };
            
            reader.readAsDataURL(input.files[0]);
        }
    });
}

function handleUpdateAccount() {
    // Handle profile form submission
document.querySelector('#editProfileForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const form = e.target;
    const formData = new FormData(form);
    
    try {
        const response = await fetch('../controllers/global_update_account_information.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: result.message,
                didClose: () => {
                    location.reload(); // Refresh to show updates
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: result.message || 'Failed to update profile'
            });
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Network Error',
            text: 'Failed to communicate with the server'
        });
    }
});
}

function handleUpdatePersonalInfo() {
    document.addEventListener('DOMContentLoaded', function() {
        // Handle personal info form submission
        const editForm = document.querySelector('#editPersonalInfo form');
        
        if (editForm) {
            editForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const submitBtn = e.target.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
    
                fetch('../controllers/admin_update_personal_info.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            // Close modal and reload page
                            const modal = bootstrap.Modal.getInstance(document.getElementById('editPersonalInfo'));
                            modal.hide();
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: data.message || 'Failed to update information',
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred: ' + error.message,
                    });
                })
                .finally(() => {
                    submitBtn.disabled = false;
                });
            });
        }
    });
}