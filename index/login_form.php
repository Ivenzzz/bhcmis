<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content dark-modal modal-sm">
            <div class="modal-header mb-3 d-flex align-items-center position-relative">
                <h3 class="modal-title gradient-text" id="loginModalLabel">Login</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
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
                            <a href="#">Forgot Password?</a>
                        </div>
                    </div>
                    <div class="mt-5 mb-3">
                        <button class="btn btn-primary btn-full" type="button" id="loginButton">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>