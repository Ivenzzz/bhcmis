initPopulationGrowth();
initPopulationGrowthText();
initPopulationPerYearChart();

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