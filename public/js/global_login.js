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


// Function to add event listeners for login (button click and Enter key)
function addLoginButtonListener() {
    const loginButton = document.getElementById('loginButton');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');

    // Shared handler function
    const handleLogin = async () => {
        const username = usernameInput.value;
        const password = passwordInput.value;
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
                redirectToDashboard(data.role);
            } else {
                displayErrorMessage(data.message);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    };

    // Click event for button
    loginButton.addEventListener('click', handleLogin);

    // Enter key event for form inputs
    const handleEnterKey = (event) => {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent form submission if in a <form>
            handleLogin();
        }
    };

    // Add to both input fields
    usernameInput.addEventListener('keydown', handleEnterKey);
    passwordInput.addEventListener('keydown', handleEnterKey);
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
            window.location.href = '../resident/medical_history.php';
            break;
        case 'bhw':
            window.location.href = '../bhw/household_records.php';
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
