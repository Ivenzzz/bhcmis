displayWeightTrend();
displayBloodPressureTrend();

function displayWeightTrend() {
    // Access the resident ID from the data-resident-id attribute
    const residentId = document.body.getAttribute('data-resident-id');

    // API URL
    const apiUrl = `../api/resident_weight_trend.php?resident_id=${residentId}`;

    // Fetch weight trend data
    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            if (data.status === "success" && data.data.length > 0) {
                const weightTrend = data.data;

                // Parse data for Chart.js
                const labels = weightTrend.map(item => item.created_at);
                const dataPoints = weightTrend.map(item => parseFloat(item.weight_kg));

                // Render Chart
                const ctx = document.getElementById('weightTrendChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line', // Line chart
                    data: {
                        labels: labels, // Dates
                        datasets: [{
                            label: 'Weight (kg)',
                            data: dataPoints, // Weights
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 2,
                            tension: 0.4 // Smooth line
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'
                            }
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Date'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Weight (kg)'
                                },
                                beginAtZero: false
                            }
                        }
                    }
                });
            } else {
                console.error('No weight trend data found or error in API response.');
            }
        })
        .catch(error => console.error('Error fetching weight trend data:', error));
}

function displayBloodPressureTrend() {
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('bpTrendChart').getContext('2d');
        const residentId = document.body.dataset.residentId; // Retrieve resident ID from the body tag

        // Fetch blood pressure trend data
        fetch(`../api/resident_bp_trend.php?resident_id=${residentId}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success' && data.data.length > 0) {
                    const labels = data.data.map(item => item.created_at); // Extract dates
                    const systolicData = data.data.map(item => {
                        const [systolic] = item.blood_pressure.split('/'); // Extract systolic
                        return parseInt(systolic, 10);
                    });
                    const diastolicData = data.data.map(item => {
                        const [, diastolic] = item.blood_pressure.split('/'); // Extract diastolic
                        return parseInt(diastolic, 10);
                    });

                    // Create Chart.js line chart
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: 'Systolic Pressure (mmHg)',
                                    data: systolicData,
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderWidth: 2,
                                    fill: true
                                },
                                {
                                    label: 'Diastolic Pressure (mmHg)',
                                    data: diastolicData,
                                    borderColor: 'rgba(153, 102, 255, 1)',
                                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                    borderWidth: 2,
                                    fill: true
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top'
                                },
                                tooltip: {
                                    mode: 'index',
                                    intersect: false
                                }
                            },
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Date'
                                    }
                                },
                                y: {
                                    title: {
                                        display: true,
                                        text: 'Blood Pressure (mmHg)'
                                    },
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                } else {
                    console.error('No blood pressure data available.');
                    alert('No blood pressure trend data available.');
                }
            })
            .catch(error => {
                console.error('Error fetching blood pressure trend:', error);
                alert('Failed to load blood pressure trend data.');
            });
    });
}