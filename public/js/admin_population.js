initializePopulation();

function initializePopulation() {
    let chartInstance = null;
    let chartInstanceGender = null;

    document.addEventListener('DOMContentLoaded', function() {
        // Get the address dropdown
        const addressSelect = document.getElementById('address');

        // Trigger the initial population fetch for "All Areas" (empty addressId)
        fetchPopulationData("");

        // Add event listener for changes in the dropdown
        addressSelect.addEventListener('change', function() {
            const selectedAddressId = this.value;
            fetchPopulationData(selectedAddressId);
        });
    });

    function fetchPopulationData(addressId) {
        const formData = new FormData();
        formData.append('address_id', addressId);

        // Make an AJAX request to fetch population data via POST
        fetch('./app/models/get_population_by_area.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Update the total residents in the card
            document.getElementById('totalResidents').textContent = data.total_residents;

            // Update pie chart with age group data
            updatePopulationChart(data.age_groups);

            // Update gender distribution chart (now a bar chart)
            updateGenderChart(data.gender_distribution);
        })
        .catch(error => {
            console.error('Error fetching population data:', error);
        });
    }

    // Function to update the age group pie chart
    function updatePopulationChart(ageGroups) {
        const ctx = document.getElementById('populationChart').getContext('2d');

        // If chartInstance already exists, destroy it before creating a new one
        if (chartInstance) {
            chartInstance.destroy();
        }

        // Create a new chart instance with updated data
        chartInstance = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['0-12', '13-18', '18-59', '60+'],
                datasets: [{
                    label: 'Population by Age Group',
                    data: ageGroups,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Age Distribution',
                        font: {
                            size: 18
                        }
                    }
                }
            }
        });
    }

    // Function to update the gender distribution chart (now a bar chart)
    function updateGenderChart(genderData) {
        const ctxGender = document.getElementById('populationByGender').getContext('2d');

        // If chartInstanceGender already exists, destroy it before creating a new one
        if (chartInstanceGender) {
            chartInstanceGender.destroy();
        }

        // Create a new chart instance with gender distribution data as a bar chart
        chartInstanceGender = new Chart(ctxGender, {
            type: 'bar',
            data: {
                labels: ['Male', 'Female'],
                datasets: [{
                    label: 'Number of Residents',
                    data: [genderData.male, genderData.female],
                    backgroundColor: ['#36A2EB', '#FF6384'],
                    borderColor: ['#36A2EB', '#FF6384'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Residents'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Gender Distribution',
                        font: {
                            size: 18
                        }
                    }
                }
            }
        }); // <-- Added the missing closing parenthesis and semicolon
    }
}
