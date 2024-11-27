initPopulationGrowth();
initPopulationGrowthText();
initPopulationPerYearChart();
initPopulationPerArea();
initAgeDistribution();
initGenderDistribution();
initYearlyPopulationTable();
initTopDiseasesPie();

function initPopulationGrowth() {
    document.addEventListener("DOMContentLoaded", function () {
        fetch('../api/population_growth.php')
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "success") {
                    // Prepare the data for Chart.js
                    const labels = [data.previous_year, data.current_year];
                    const populationData = [data.previous_population, data.current_population];
                    
                    // Render the chart
                    const ctx = document.getElementById("populationChart").getContext("2d");
                    new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: "Population",
                                    data: populationData,
                                    backgroundColor: ["#3498db", "#2ecc71"], // Bar colors
                                    borderColor: ["#2980b9", "#27ae60"],
                                    borderWidth: 1,
                                },
                            ],
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: true,
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            return `${context.dataset.label}: ${context.raw}`;
                                        },
                                    },
                                },
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: "Population",
                                    },
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: "Year",
                                    },
                                },
                            },
                        },
                    });
                } else {
                    console.error("Failed to fetch population data:", data.message);
                }
            })
            .catch((error) => console.error("Error fetching the API:", error));
    });
}

function initPopulationGrowthText() {
    document.addEventListener("DOMContentLoaded", function () {
        fetch('../api/population_growth.php')
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "success") {
                    const growthRate = data.growth_rate;
                    const currentPopulation = data.current_population;
                    const previousPopulation = data.previous_population;
                    const currentYear = data.current_year;
                    const previousYear = data.previous_year;
                    
                    const growthRateLabel = document.getElementById("growthRateLabel");
                    growthRateLabel.innerHTML = `Growth Rate: ${growthRate.toFixed(2)}%`;
                } else {
                    console.error("Failed to fetch population data:", data.message);
                }
            })
            .catch((error) => console.error("Error fetching the API:", error));
    });
}

function initPopulationPerYearChart() {
    document.addEventListener("DOMContentLoaded", function () {
        fetch('../api/population_per_year.php')  // API URL for population data
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "success") {
                    // Extract the years and total populations from the API response
                    const years = data.data.map(item => item.year);
                    const populations = data.data.map(item => item.total_population);
    
                    // Prepare the data for the Line chart
                    const ctx = document.getElementById('populationLineChart').getContext('2d');
    
                    // Create a new line chart using Chart.js
                    new Chart(ctx, {
                        type: 'line', // Line chart type
                        data: {
                            labels: years, // x-axis labels (years)
                            datasets: [{
                                label: 'Total Population',
                                data: populations, // y-axis data (populations)
                                borderColor: '#3498db', // Line color
                                backgroundColor: 'rgba(52, 152, 219, 0.2)', // Line fill color
                                borderWidth: 2,
                                fill: true, // Fill the area under the line
                                tension: 0.1, // Smooth the line
                            }],
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: true,
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            return `Population: ${context.raw}`;
                                        },
                                    },
                                },
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Population',
                                    },
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Year',
                                    },
                                },
                            },
                        },
                    });
                } else {
                    console.error("Failed to fetch population data:", data.message);
                }
            })
            .catch((error) => console.error("Error fetching the API:", error));
    });
}

function initPopulationPerArea() {
    document.addEventListener("DOMContentLoaded", function () {
        fetch('../api/population_per_area.php')
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    // Extract labels and data for the chart
                    const labels = data.data.map(area => area.address_name);
                    const populationCounts = data.data.map(area => area.population_count);

                    // Render the horizontal bar chart
                    const ctx = document.getElementById("populationPerAreaChart").getContext("2d");
                    new Chart(ctx, {
                        type: "bar", // Bar chart
                        data: {
                            labels: labels, // Area names
                            datasets: [
                                {
                                    label: "Population Count",
                                    data: populationCounts, // Population count per area
                                    backgroundColor: "#2ecc71", // Bar color
                                    borderColor: "#27ae60",
                                    borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            indexAxis: "y", // Horizontal bars
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: "top"
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            return `${context.dataset.label}: ${context.raw}`;
                                        }
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: "Population Count"
                                    }
                                },
                                y: {
                                    title: {
                                        display: true,
                                        text: "Area"
                                    }
                                }
                            }
                        }
                    });
                } else {
                    console.error("Failed to fetch population per area data:", data.message);
                }
            })
            .catch(error => console.error("Error fetching population per area data:", error));
    });
}

function initAgeDistribution() {
    document.addEventListener("DOMContentLoaded", function () {
        // Fetch the API data
        fetch('../api/age_distribution.php') // Adjust to your API's actual path
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "success") {
                    const ageData = data.data;

                    // Prepare data for the chart
                    const labels = ["Child (0-12)", "Minor (13-17)", "Adult (18-59)", "Senior (60+)"];
                    const chartData = [
                        ageData.child,
                        ageData.minor,
                        ageData.adult,
                        ageData.senior,
                    ];
                    const backgroundColors = ["#3498db", "#9b59b6", "#2ecc71", "#e74c3c"];

                    // Render the pie chart
                    const ctx = document.getElementById("ageDistributionChart").getContext("2d");
                    new Chart(ctx, {
                        type: "pie", // Pie chart
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: "Age Distribution",
                                    data: chartData,
                                    backgroundColor: backgroundColors,
                                    borderColor: "#fff",
                                    borderWidth: 1,
                                },
                            ],
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: "bottom",
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            const percentage = (
                                                (context.raw /
                                                    chartData.reduce((a, b) => a + b, 0)) *
                                                100
                                            ).toFixed(2);
                                            return `${context.label}: ${context.raw} (${percentage}%)`;
                                        },
                                    },
                                },
                            },
                        },
                    });
                } else {
                    console.error("Failed to fetch age distribution:", data.message);
                }
            })
            .catch((error) => console.error("Error fetching the API:", error));
    });
}

function initGenderDistribution() {
    document.addEventListener("DOMContentLoaded", function () {
        // Fetch the gender distribution data from the API
        fetch('../api/gender_distribution.php') // Replace with the actual API URL
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    const genderData = data.data;

                    // Prepare data for the chart
                    const labels = ["Male", "Female"];
                    const distribution = [genderData.male, genderData.female];

                    // Get the canvas context
                    const ctx = document.getElementById("genderDistributionChart").getContext("2d");

                    // Render the chart
                    new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: "Population",
                                    data: distribution,
                                    backgroundColor: ["#3498db", "#e74c3c"], // Blue for male, Red for female
                                    borderColor: ["#2980b9", "#c0392b"],
                                    borderWidth: 1,
                                },
                            ],
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: false, // Hides the legend
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            return `${context.dataset.label}: ${context.raw}`;
                                        },
                                    },
                                },
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: "Population Count",
                                    },
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: "Gender",
                                    },
                                },
                            },
                        },
                    });
                } else {
                    console.error("Error fetching gender distribution:", data.message);
                }
            })
            .catch(error => console.error("Error fetching the API:", error));
    });
}

function initYearlyPopulationTable() {
    $(document).ready(function() {
        // Initialize the DataTable
        $('#yearlyPopulationTable').DataTable({
            "paging": true,        // Enable pagination
            "ordering": true,      // Enable sorting
            "searching": true,     // Enable searching/filtering
            "info": true,          // Display table information
            "responsive": true     // Make the table responsive
        });
    });
}

function initTopDiseasesPie() {
    document.addEventListener('DOMContentLoaded', function () {
        // Fetch data from the API
        fetch('../api/top_5_diseases.php') // Replace with the actual path to your PHP API
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const diseases = data.data;

                    // Extract labels and counts
                    const labels = diseases.map(item => item.condition_name);
                    const counts = diseases.map(item => item.resident_count);

                    // Define chart data
                    const chartData = {
                        labels: labels,
                        datasets: [{
                            label: 'Number of Residents',
                            data: counts,
                            backgroundColor: [
                                '#FF6384',
                                '#36A2EB',
                                '#FFCE56',
                                '#4BC0C0',
                                '#9966FF'
                            ],
                            borderWidth: 1
                        }]
                    };

                    // Render the chart
                    const ctx = document.getElementById('diseasesChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'doughnut',
                        data: chartData,
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top'
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            let label = context.label || '';
                                            const value = context.raw;
                                            if (label) {
                                                label += ': ';
                                            }
                                            label += value + ' residents';
                                            return label;
                                        }
                                    }
                                }
                            }
                        }
                    });
                } else {
                    console.error('Failed to load data:', data.message);
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    });
}