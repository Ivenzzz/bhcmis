<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="registerModalLabel">Register as a Resident</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registerForm" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Account Information -->
                        <div class="col-md-6">
                            <h5 class="mb-3">Account Information</h5>
                            <div class="mb-3">
                                <label for="regUsername" class="form-label">Username</label>
                                <input type="text" id="regUsername" name="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="regPassword" class="form-label">Password</label>
                                <input type="password" id="regPassword" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="regConfirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" id="regConfirmPassword" name="confirm_password" class="form-control" required>
                            </div>
                        </div>
                        <!-- Personal Information -->
                        <div class="col-md-6">
                            <h5 class="mb-3">Personal Information</h5>
                            <div class="mb-3">
                                <label for="regLastname" class="form-label">Last Name</label>
                                <input type="text" id="regLastname" name="lastname" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="regFirstname" class="form-label">First Name</label>
                                <input type="text" id="regFirstname" name="firstname" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="regMiddlename" class="form-label">Middle Name</label>
                                <input type="text" id="regMiddlename" name="middlename" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="regBirthday" class="form-label">Birthday</label>
                                <input type="date" id="regBirthday" name="date_of_birth" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <!-- Address and Email -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="regAddress" class="form-label">Address</label>
                                <select id="regAddress" name="address" class="form-select" required>
                                    <option value="" disabled selected>Select Address</option>
                                    <?php foreach ($addresses as $address): ?>
                                        <option value="<?= htmlspecialchars($address['address_id']); ?>">
                                            <?= htmlspecialchars($address['address_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="regEmail" class="form-label">Email</label>
                                <div class="input-group">
                                    <input type="email" id="regEmail" name="email" class="form-control" required>
                                    <button type="button" class="btn btn-secondary" id="sendOtpButton">Send OTP</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ID Picture -->
                    <div class="mb-3">
                        <label for="regIdPicture" class="form-label">Upload ID Picture</label>
                        <input type="file" id="regIdPicture" name="id_picture" class="form-control" accept="image/*" required>
                    </div>
                    <!-- OTP Field -->
                    <div class="mb-3">
                        <label for="regOTP" class="form-label">OTP</label>
                        <input type="text" id="regOTP" name="otp" class="form-control" placeholder="Enter OTP" required>
                        <small id="otpHelp" class="form-text text-muted">Enter the OTP sent to your email.</small>
                    </div>
                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" id="submitRegisterForm">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>