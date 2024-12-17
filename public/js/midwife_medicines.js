document.addEventListener("DOMContentLoaded", function () {
    initMedicinesTable();
    handleDeleteButtonClicks();
    renderMedicineCountByFormChart();
    renderMedicineCountByExpiryChart();
});

/**
 * Initialize the DataTable with responsiveness and state saving enabled.
 */
function initMedicinesTable() {
    new DataTable('#medicinesTable', {
        responsive: true,
        stateSave: true,
    });
}

/**
 * Attach event delegation to handle delete button clicks on the medicines table.
 */
function handleDeleteButtonClicks() {
    const medicinesTable = document.querySelector('#medicinesTable');

    medicinesTable.addEventListener('click', function (event) {
        const deleteBtn = event.target.closest('.delete-btn');
        if (deleteBtn) {
            const medicineId = deleteBtn.dataset.id;
            confirmMedicineDeletion(medicineId);
        }
    });
}

/**
 * Show a confirmation modal using SweetAlert and delete the medicine if confirmed.
 * 
 * @param {string} medicineId - The ID of the medicine to delete.
 */
function confirmMedicineDeletion(medicineId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You are about to delete this medicine.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteMedicine(medicineId);
        }
    });
}

/**
 * Send a POST request to delete the medicine and show feedback using SweetAlert.
 * 
 * @param {string} medicineId - The ID of the medicine to delete.
 */
function deleteMedicine(medicineId) {
    fetch('../controllers/midwife_delete_medicine.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `medicine_id=${medicineId}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire(
                'Deleted!',
                'The medicine has been deleted.',
                'success'
            ).then(() => {
                location.reload(); // Reload page to reflect the changes
            });
        } else {
            Swal.fire(
                'Error!',
                data.message || 'Something went wrong. Please try again.',
                'error'
            );
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire(
            'Error!',
            'An unexpected error occurred. Please try again later.',
            'error'
        );
    });
}

// Function to fetch and render the medicine count by form bar chart
function renderMedicineCountByFormChart() {
    fetch('../api/medicine_count_by_form.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Prepare the data for the chart
                const labels = data.data.map(item => item.form); // Medicine forms
                const counts = data.data.map(item => item.count); // Medicine counts

                // Create the chart
                const ctx = document.getElementById('medicineChart').getContext('2d');
                const medicineChart = new Chart(ctx, {
                    type: 'bar', // Chart type
                    data: {
                        labels: labels, // X-axis labels (medicine forms)
                        datasets: [{
                            label: 'Medicine Count',
                            data: counts, // Y-axis values (medicine counts)
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Bar color
                            borderColor: 'rgba(54, 162, 235, 1)', // Bar border color
                            borderWidth: 1 // Border width
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.raw + ' medicines'; // Show label as count + "medicines"
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true // Start the Y-axis at 0
                            }
                        }
                    }
                });
            } else {
                console.error('Error:', data.message);
            }
        })
        .catch(error => console.error('Fetch Error:', error));
}

// Function to fetch and render the medicine count by expiry status pie chart
function renderMedicineCountByExpiryChart() {
    fetch('../api/medicine_count_by_expiry.php') // Replace with actual API URL
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Extract expiry status data
                const expiryStatuses = data.data;
                const labels = expiryStatuses.map(item => item.expiry_status);
                const counts = expiryStatuses.map(item => item.count);

                // Prepare data for Chart.js
                const chartData = {
                    labels: labels,
                    datasets: [{
                        data: counts,
                        backgroundColor: ['#ef4444', '#f59e0b', '#22c55e'], // Colors for Expired, Expiring, Valid
                        hoverOffset: 4
                    }]
                };

                // Create the pie chart
                new Chart(document.getElementById('expiryStatusChart'), {
                    type: 'pie',
                    data: chartData,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.label + ': ' + tooltipItem.raw + ' medicines';
                                    }
                                }
                            }
                        }
                    }
                });
            } else {
                console.error('Failed to fetch data: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}
