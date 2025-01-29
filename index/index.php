<?php

session_start();
require '../partials/global_db_config.php';
require '../models/addresses.php';


$title = 'BHCMIS - Punta Mesa';
$addresses = getAllAddresses($conn);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require '../partials/global_head.php'; ?>
    <link rel="stylesheet" href="../public/css/main.css">
</head>
<body>
    <div class="container-fluid poppins-regular">

        <header class="row p-5 bg-info bg-gradient">
            <div class="col d-flex align-items-center justify-content-center text-center">
                <img src="../public/images/punta_mesa_logo.png" class="mw-rm-6 me-2 ms-5 shadow rounded-circle opacity-75" alt="Punta Mesa Logo">
                <h1 class="text-slate-700 poppins-bold">Brgy. Punta Mesa Healthcare Management and Information System</h1>
            </div>
        </header>

        <main class="row p-5 bg-slate-100">
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-start">
                <h4 class="poppins-light">Empowering Barangay Health Centers by streamlining patient management, appointment scheduling and healthcare data recording.</h4>
                <div class="d-flex gap-2 mt-4 justify-content-start">
                    <button class="btn btn-primary px-4 py-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                    <button class="btn btn-warning px-4 py-2" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <img src="../public/images/healthcare_hero.png" alt="Hero Icon">
            </div>
        </main>
        <footer class="row mb-2 p-5 bg-dark bg-gradient">
            <div class="py-4 d-flex align-items-center justify-content-center text-white">
                © 2025 Copyright: Iven Loro BSCS-4A
            </div>
        </footer>
    </div>
    
    <?php require 'login_form.php'; ?>
    <?php require 'register_form.php'; ?>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_login.js"></script>
    <script src="../public/js/index_register.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setupForgotPasswordModal();
            setupPasswordResetForm();
            setupSendOtp();

            // Function to handle Forgot Password modal transition
            function setupForgotPasswordModal() {
                document.getElementById('forgotPasswordLink').addEventListener('click', function (e) {
                    e.preventDefault();
                    const loginModal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
                    loginModal.hide();
                    new bootstrap.Modal(document.getElementById('resetPasswordModal')).show();
                });
            }

            function setupPasswordResetForm() {
                document.getElementById('passwordResetForm').addEventListener('submit', function (e) {
                    e.preventDefault();
                    const email = document.getElementById('resetEmail').value.trim();
                    const otp = document.getElementById('otp').value.trim();
                    const storedOtp = localStorage.getItem('reset_password_otp'); // Retrieve the OTP from localStorage

                    if (!email || !otp) {
                        showSweetAlert('Error', 'Email and OTP are required.', 'error');
                        return;
                    }

                    // Verify the OTP
                    if (otp === storedOtp) {
                        showSweetAlert('Success', 'OTP verified successfully.', 'success').then(() => {
                            // Fetch account information
                            fetch(`../models/get_account_by_email.php?email=${encodeURIComponent(email)}`, {
                                method: 'GET',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                            })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                    return response.json();
                                })
                                .then(data => {
                                    if (data.success) {
                                        console.log('Account Information:', data.account); // Log the account data

                                        const username = data.account.username;
                                        const accountId = data.account.account_id;

                                        // Populate username and account_id in the newPasswordModal
                                        document.getElementById('newPasswordUsername').textContent = username;
                                        document.getElementById('hiddenAccountId').value = accountId;

                                        // Close the current modal
                                        const resetPasswordModal = bootstrap.Modal.getInstance(document.getElementById('resetPasswordModal'));
                                        if (resetPasswordModal) {
                                            resetPasswordModal.hide();
                                        }

                                        // Show the new password modal
                                        setTimeout(() => {
                                            const newPasswordModal = new bootstrap.Modal(document.getElementById('newPasswordModal'));
                                            newPasswordModal.show();
                                        }, 300); // Wait 300ms for a smooth transition
                                    } else {
                                        showSweetAlert('Error', data.message || 'Failed to retrieve account information.', 'error');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error fetching account information:', error);
                                    showSweetAlert('Error', 'An error occurred while fetching account information.', 'error');
                                });
                        });
                    } else {
                        showSweetAlert('Error', 'Invalid OTP. Please try again.', 'error');
                    }
                });

                // Handle new password form submission
                document.getElementById('newPasswordForm').addEventListener('submit', function (e) {
                    e.preventDefault();
                    const accountId = document.getElementById('hiddenAccountId').value.trim();
                    const newPassword = document.getElementById('newPassword').value.trim();
                    const confirmPassword = document.getElementById('confirmNewPassword').value.trim();

                    if (!newPassword || !confirmPassword) {
                        showSweetAlert('Error', 'Both password fields are required.', 'error');
                        return;
                    }

                    if (newPassword !== confirmPassword) {
                        showSweetAlert('Error', 'Passwords do not match.', 'error');
                        return;
                    }

                    // Send the request to reset the password
                    fetch('../controllers/index_reset_password.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            account_id: accountId,
                            new_password: newPassword,
                        }),
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                showSweetAlert('Success', data.message || 'Password has been reset successfully.', 'success').then(() => {
                                    // Close the new password modal
                                    const newPasswordModal = bootstrap.Modal.getInstance(document.getElementById('newPasswordModal'));
                                    if (newPasswordModal) {
                                        newPasswordModal.hide();
                                    }
                                });
                            } else {
                                showSweetAlert('Error', data.message || 'Failed to reset the password.', 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error resetting password:', error);
                            showSweetAlert('Error', 'An error occurred while resetting the password.', 'error');
                        });
                });
            }


            // Function to handle sending OTP
            function setupSendOtp() {
                const sendOtpBtn = document.getElementById('sendOtpBtn');
                const resetEmail = document.getElementById('resetEmail');
                const otpField = document.getElementById('otp');

                sendOtpBtn.addEventListener('click', function () {
                    const email = resetEmail.value.trim();

                    if (!validateEmail(email)) {
                        showSweetAlert('Invalid Email', 'Please enter a valid email address.', 'error');
                        return;
                    }

                    sendOtpBtn.disabled = true;
                    sendOtpBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...';

                    fetch('../controllers/index_send_otp_reset_password.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ email: email })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Store the OTP in localStorage
                                localStorage.setItem('reset_password_otp', data.otp);

                                showSweetAlert('OTP Sent', 'OTP sent successfully! Check your email.', 'success');
                                otpField.disabled = false;
                                startResendTimer(sendOtpBtn);
                            } else {
                                showSweetAlert('Failed', data.message || 'Failed to send OTP.', 'error');
                            }
                        })
                        .catch(() => {
                            showSweetAlert('Error', 'An error occurred. Please try again.', 'error');
                        })
                        .finally(() => {
                            sendOtpBtn.disabled = false;
                            sendOtpBtn.innerHTML = 'Send OTP';
                        });
                });
            }


            // Helper function to validate email
            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            // Function to display SweetAlert2 modals
            function showSweetAlert(title, text, icon) {
                return Swal.fire({
                    title: title,
                    text: text,
                    icon: icon,
                    confirmButtonText: 'OK',
                });
            }


            // Function to start resend OTP timer
            function startResendTimer(button) {
                let timeLeft = 30;
                button.disabled = true;

                const timerInterval = setInterval(() => {
                    button.innerHTML = `Resend OTP (${timeLeft})`;
                    timeLeft--;

                    if (timeLeft < 0) {
                        clearInterval(timerInterval);
                        button.disabled = false;
                        button.innerHTML = 'Resend OTP';
                    }
                }, 1000);
            }
        });
    </script>
</body>
</html>
