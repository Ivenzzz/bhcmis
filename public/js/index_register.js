handleSendingOtp();
handleResidentRegistration();

function handleSendingOtp() {
    document.getElementById('sendOtpButton').addEventListener('click', async () => {
        const email = document.getElementById('regEmail').value;

        try {
            const response = await fetch('../controllers/index_send_otp.php', {
                method: 'POST',
                body: JSON.stringify({ email }),
                headers: {
                    'Content-Type': 'application/json',
                },
            });

            const result = await response.json();

            if (result.success) {
                // Store OTP in localStorage
                localStorage.setItem('otp', result.otp);

                Swal.fire({
                    icon: 'success',
                    title: 'OTP Sent',
                    text: result.message,
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to send OTP',
                    text: result.message,
                });
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Unable to send OTP. Please try again later.',
            });
            console.error(error);
        }
    });
}

function handleResidentRegistration() {
    document.getElementById('submitRegisterForm').addEventListener('click', async () => {
        const form = document.getElementById('registerForm');
        const formData = new FormData(form);

        // Get the OTP entered by the user
        const enteredOTP = document.getElementById('regOTP').value;

        // Get the OTP stored in localStorage (assuming it was stored previously)
        const storedOTP = localStorage.getItem('otp'); 

        // Compare the entered OTP with the stored OTP
        if (enteredOTP !== storedOTP) {
            // If OTPs don't match, show an error modal
            Swal.fire({
                icon: 'error',
                title: 'Invalid OTP',
                text: 'The OTP you entered is incorrect. Please try again.',
            });
            return; // Stop the execution of the form submission
        }

        try {
            const response = await fetch('../controllers/index_register_resident.php', {
                method: 'POST',
                body: formData,
            });
            const result = await response.json();

            if (result.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Registration Successful',
                    text: result.message,
                });
                form.reset(); // Reset the form after successful registration
                $('#registerModal').modal('hide'); // Hide the modal
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Registration Failed',
                    text: result.message,
                });
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'An Error Occurred',
                text: 'Unable to complete registration. Please try again later.',
            });
            console.error('Error:', error);
        }
    });
}