document.addEventListener('DOMContentLoaded', () => {
    prefillFieldsFromCookies();
    addLoginButtonListener();
    addTogglePasswordListener();
});

// Function to prefill input fields from cookies
function prefillFieldsFromCookies() {
    const cookies = document.cookie.split('; ').reduce((acc, cookie) => {
        const [name, value] = cookie.split('=');
        acc[name] = value;
        return acc;
    }, {});

    const usernameField = document.getElementById('username');
    const passwordField = document.getElementById('password');
    const rememberMeCheckbox = document.getElementById('remember_me');

    // Prefill the username if it exists in cookies
    if (cookies.username) {
        usernameField.value = cookies.username;
    }

    // Prefill the password if it exists in cookies
    if (cookies.password) {
        passwordField.value = cookies.password;
    }

    // If both username and password are prefilled, check the "Remember Me" checkbox
    if (cookies.username && cookies.password) {
        rememberMeCheckbox.checked = true;
    } else {
        rememberMeCheckbox.checked = false;
    }
}


// Function to add event listener for the login button
function addLoginButtonListener() {
    document.getElementById('loginButton').addEventListener('click', async function() {
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        const rememberMe = document.getElementById('remember_me').checked;
        const formData = new FormData();

        formData.append('username', username);
        formData.append('password', password);
        formData.append('remember', rememberMe);

        try {
            const response = await fetch('../controllers/index_login.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.status === 'success') {
                // Redirect based on role
                redirectToDashboard(data.role);
            } else {
                displayErrorMessage(data.message);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });
}

// Function to redirect based on user role
function redirectToDashboard(role) {
    switch (role) {
        case 'admin':
            window.location.href = '../admin/index.php';
            break;
        case 'midwife':
            window.location.href = '../midwife/index.php';
            break;
        case 'residents':
            window.location.href = '../resident/index.php';
            break;
        case 'bhw':
            window.location.href = '../bhw/index.php';
            break;
    }
}

// Function to display error message
function displayErrorMessage(message) {
    const errorDiv = document.querySelector('.error-login');
    errorDiv.textContent = message;
    errorDiv.classList.remove('d-none');
}

// Function to add event listener for the password toggle
function addTogglePasswordListener() {
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = this;

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    });
}
