<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header mb-3">
                <h3 class="modal-title gradient-text" id="loginModalLabel">Login</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="error-login alert alert-danger d-none"></div>
                <form class="px-4" method="post" id="loginForm">
                    <div class="mb-4 d-flex align-items-center gap-2">
                        <i class="fas fa-user"></i>
                        <input class="form-control px-3" type="text" id="username" placeholder="Username" />
                    </div>
                    <div class="mb-5 password-container d-flex align-items-center gap-2">
                        <i class="fas fa-lock"></i>
                        <input class="form-control px-3" type="password" id="password" placeholder="••••••" />
                        <i class="fas fa-eye eye-icon" id="togglePassword"></i>
                    </div>
                    <div class="my-4 d-flex justify-content-between">
                        <div>
                            <input type="checkbox" id="remember_me">
                            <label class="form-label" for="remember_me">Remember Me</label>
                        </div>
                        <div>
                            <a href="#" id="forgotPasswordLink">Forgot Password?</a>
                        </div>
                    </div>
                    <div class="mt-5 mb-3 d-flex justify-content-end">
                        <button class="btn btn-primary" type="button" id="loginButton">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Password Reset Modal -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetPasswordLabel">Password Recovery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="passwordResetForm">
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-envelope"></i>
                            <input type="email" class="form-control" id="resetEmail" placeholder="Enter your registered email" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-shield-alt"></i>
                            <input type="text" class="form-control" id="otp" placeholder="Enter OTP" required>
                            <!-- Add this manual send button -->
                            <button type="button" class="btn btn-primary btn-sm" id="sendOtpBtn">
                                Send OTP
                            </button>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="newPasswordModal" tabindex="-1" aria-labelledby="newPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newPasswordModalLabel">Set New Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="newPasswordForm">
                <div class="modal-body">
                    <p>Resetting password for: <strong id="newPasswordUsername"></strong></p>
                    <input type="hidden" id="hiddenAccountId" name="account_id">
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="new_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmNewPassword" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmNewPassword" name="confirm_new_password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save New Password</button>
                </div>
            </form>
        </div>
    </div>
</div>



