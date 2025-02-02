<?php

session_start();

$title = 'Midwife Dashboard';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/midwife.php';
require '../models/appointments.php';
require '../models/consultations.php';

$user = getCurrentUser($conn);
$midwife = getCurrentMidwife($conn);
$todays_appointments = getTodaysAppointments($conn);
$total_todays_appointments = getTotalAppointmentsToday($conn);
$total_completed_appointments = getTotalCompletedAppointments($conn);
$total_cancelled_appointments = getTotalCancelledAppointments($conn);
$total_consultations = getTotalConsultations($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require '../partials/global_head.php'; ?>
    <link rel="stylesheet" href="../public/css/main.css">
</head>
<body class="poppins-regular">
    <?php require 'partials/sidebar.php'; ?>

    <div class="flex-grow-1 bg-slate-100">
        <?php require 'partials/header.php'; ?>
        
        <div class="container mt-4 px-5">

            <div class="row mb-4 shadow">
                <div class="col-md-9 d-flex flex-column p-4">
                    <h5 class="poppins-semibold">Welcome Midwife <?php echo $midwife['firstname'] . ' ' . $midwife['lastname']; ?></h5>
                    <p><small>Have a nice day at work!</small></p>
                </div>
                <div class="col-md-3 py-2 h-100 d-flex justify-content-end">
                    <?php echo date('F j, Y'); ?>
                </div>
            </div>

            <?php require 'partials/cards_index_overview.php'; ?>
            <?php require 'partials/table_todays_appointments.php'; ?>

            <div class="row mb-4 shadow p-4">
                <div class="col-md-7 p-4 shadow">
                    <h5 class="poppins-light mb-4 text-center">Consultation Count per Month</h5>
                    <canvas id="consultationChart"></canvas>
                </div>  
                <div class="col-md-5 p-4">
                    <h5 class="poppins-light mb-4 text-center">Most Consultation Reasons</h5>
                    <canvas id="reasonsChart" ></canvas> 
                </div>
            </div>

            <div class="row mb-4 shadow p-4">
                <div class="col-md-4">
                    <h5 class="poppins-light mb-4 text-center">Most Common Symptoms</h5>
                    <canvas id="symptomDonutChart"></canvas>
                </div>
            </div>

        </div>
    </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/midwife_statistics.js"></script>
    <script>
        // Fetch the data from the API that retrieves the most common symptoms
        fetch('../api/consultations_most_symptoms.php')
            .then(response => response.json())
            .then(data => {
                // Prepare the labels and data for the donut chart
                const labels = [];
                const counts = [];
                
                data.forEach(item => {
                    labels.push(item.symptom);  // The symptom names will be the labels
                    counts.push(item.count);  // The counts of symptoms will be the data values
                });

                // Set up the Chart.js donut chart
                const ctx = document.getElementById('symptomDonutChart').getContext('2d');
                new Chart(ctx, {
                    type: 'doughnut',  // Doughnut chart type
                    data: {
                        labels: labels,  // Labels (symptom names)
                        datasets: [{
                            data: counts,  // Counts (symptom occurrences)
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(255, 99, 132, 0.6)',
                                'rgba(255, 159, 64, 0.6)',
                                'rgba(75, 192, 192, 0.6)',
                                'rgba(153, 102, 255, 0.6)',
                                'rgba(255, 159, 64, 0.6)',
                                'rgba(255, 99, 132, 0.6)',
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(75, 192, 192, 0.6)',
                                'rgba(153, 102, 255, 0.6)'
                            ],  // Color array for each slice
                            borderColor: 'white',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',  // Legend at the top
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.label + ': ' + tooltipItem.raw;  // Format tooltips
                                    }
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));  // Error handling
    </script>
</body>
</html>


<!--
Most Frequent Symptoms Reported
Blood Pressure Distribution
Referral Statistics
 




-->
