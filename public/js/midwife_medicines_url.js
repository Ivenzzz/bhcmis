// Function to get query parameter from URL
function getQueryParameter(param) {
    let urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

// Function to remove query parameter from URL
function clearQueryParameter(param) {
    let urlParams = new URLSearchParams(window.location.search);
    urlParams.delete(param);
    const newUrl = window.location.pathname + '?' + urlParams.toString();
    window.history.replaceState({}, document.title, newUrl);
}

// Check the add_medicine_status parameter
const status = getQueryParameter('add_medicine_status');

// Show SweetAlert2 modal based on the status
if (status === 'success') {
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Medicine added successfully!',
        confirmButtonText: 'OK'
    }).then(() => {
        clearQueryParameter('add_medicine_status');
    });
} else if (status === 'error') {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'There was an issue adding the medicine. Please try again.',
        confirmButtonText: 'OK'
    }).then(() => {
        clearQueryParameter('add_medicine_status');
    });
}