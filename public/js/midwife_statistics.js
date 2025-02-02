displayConsultationPerMonth();
displayConsultationReasonsChart();


function displayConsultationPerMonth() {
    // Fetch consultation count by month from the API
    fetch('../api/consultation_count_by_month.php')
    .then(response => response.json())
    .then(data => {
        // Process the data for Chart.js
        const months = [];
        const counts = [];
        data.forEach(item => {
            // Convert month number to month name
            const monthName = new Date(item.year, item.month - 1).toLocaleString('default', { month: 'long' });
            months.push(monthName + ' ' + item.year); // Format as "Month Year"
            counts.push(item.consultation_count);
        });

        // Set up the Chart.js bar chart
        const ctx = document.getElementById('consultationChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months, // X-axis labels (months and years)
                datasets: [{
                    label: 'Consultation Count',
                    data: counts, // Data for the bar chart (consultation counts)
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true // Start the Y-axis from 0
                    }
                }
            }
        });
    })
    .catch(error => console.error('Error fetching data:', error));
}

function displayConsultationReasonsChart() {
    // Fetch the most common reasons for visit from the API
    fetch('../api/consultations_most_reasons.php')
    .then(response => response.json())
    .then(data => {
        // Prepare data for Chart.js
        const labels = [];
        const dataValues = [];

        // Process each item to populate the labels and data
        data.forEach(item => {
            labels.push(item.reason_for_visit); // Labels for the chart
            dataValues.push(item.reason_count); // Counts for the chart
        });

        // Set up the Chart.js pie chart
        const ctx = document.getElementById('reasonsChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels, // Labels for each slice of the pie chart
                datasets: [{
                    label: 'Most Common Reasons for Visit',
                    data: dataValues, // Values corresponding to the reasons
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                // Custom tooltip formatting
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    })
    .catch(error => console.error('Error fetching data:', error));
}