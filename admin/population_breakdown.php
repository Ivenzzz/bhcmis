<?php

session_start();

require './config/db_config.php';

$title = 'Population Breakdown';

require './app/models/get_admin_analytics.php';
require './app/models/get_current_user.php';
require './app/models/get_addresses.php';
require './app/models/get_population_statistics.php';

$total_residents = getTotalResidents($conn);
$user = getCurrentUser($conn);
$population_statistics = getPopulationStatistics($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './app/views/globals/head.php'; ?>
    <link rel="stylesheet" href="./public/css/admin.css">
</head>
<body id="body-pd">
    <?php include 'partials/top_navigation.php'; ?>
    <?php include 'partials/sidebar.php'; ?>
    
    <div class="height-100 main-content pb-4">
        <div class="row mb-4">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/bhcmis/admin">Statistics</a></li>
                        <li class="breadcrumb-item active" aria-current="page">/ Population</li>
                    </ol>
                </nav>
            </div>
        </div>
    
        <div class="row mb-4">
            <div class="col-md-12">
                <form method="POST" action="" id="filterForm">
                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Filter by Address:</label>
                        <div class="col-sm-6">
                            <select class="form-select" id="address" name="address">
                                <option value="">All Areas</option>
                                <?php foreach ($addresses as $address) : ?>
                                    <option value="<?= htmlspecialchars($address['address_id']) ?>">
                                        <?= htmlspecialchars($address['address_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row mb-4 shadow p-3">

            <div class="col-md-4 shadow p-2">
                <div class="card w-100 h-100 d-flex justify-content-center align-items-center text-center p-3 shadow">
                    <div class="card-content">
                        <img src="./public/images/svg/person-team.svg" alt="" width="50" height="50" class="mb-2">
                        <div class="card-info">
                            <h2 class="text-center mb-1" id="totalResidents">0</h2>
                            <h5 class="text-center fw-light">Residents</h5>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 shadow p-2">
                <canvas id="populationChart"></canvas>
            </div>

            <div class="col-md-4 shadow p-2">
                <canvas id="populationByGender"></canvas>
            </div>

        </div>

        <div class="row mb-4 shadow pb-5">
            <div class="col-md-12 p-2 px-4">
                <h3 class="text-center mb-3">Summary</h3>
                <table class="table table-bordered table-striped text-center table-sm">
                    <thead>
                        <tr>
                            <th>Address</th>
                            <th>Total Residents</th>
                            <th>Total Males</th>
                            <th>Total Females</th>
                            <th>Total Children (0-12)</th>
                            <th>Total Seniors (60+)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // Initialize totals
                        $totalResidents = 0;
                        $totalMales = 0;
                        $totalFemales = 0;
                        $totalChildren = 0;
                        $totalSeniors = 0;

                        if (!empty($population_statistics)) : ?>
                            <?php foreach ($population_statistics as $stat) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($stat['address_name']) ?></td>
                                    <td><?= htmlspecialchars($stat['total_residents']) ?></td>
                                    <td><?= htmlspecialchars($stat['total_males']) ?></td>
                                    <td><?= htmlspecialchars($stat['total_females']) ?></td>
                                    <td><?= htmlspecialchars($stat['total_children']) ?></td>
                                    <td><?= htmlspecialchars($stat['total_seniors']) ?></td>
                                </tr>
                                <?php
                                // Accumulate totals
                                $totalResidents += $stat['total_residents'];
                                $totalMales += $stat['total_males'];
                                $totalFemales += $stat['total_females'];
                                $totalChildren += $stat['total_children'];
                                $totalSeniors += $stat['total_seniors'];
                                ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" class="text-center">No data available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>Total</strong></td>
                            <td><strong><?= htmlspecialchars($totalResidents) ?></strong></td>
                            <td><strong><?= htmlspecialchars($totalMales) ?></strong></td>
                            <td><strong><?= htmlspecialchars($totalFemales) ?></strong></td>
                            <td><strong><?= htmlspecialchars($totalChildren) ?></strong></td>
                            <td><strong><?= htmlspecialchars($totalSeniors) ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-12 px-4">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success">Print as PDF</button>
                </div>
            </div>
        </div>


    </div>

    <?php include './app/views/globals/javascripts.php'; ?>
    <script src="./public/js/admin/logout.js"></script>
    <script src="./public/js/admin/admin-population.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Function to convert image to Base64
        function getBase64Image(img) {
            const canvas = document.createElement("canvas");
            canvas.width = img.width;
            canvas.height = img.height;
            const ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0);
            return canvas.toDataURL("image/png");
        }

        // Load the logo image and convert to Base64
        const img = new Image();
        img.src = './public/images/punta_mesa_logo.png'; // Path to your logo image
        img.onload = function() {
            const base64Logo = getBase64Image(img);

            // Function to export table data to PDF
            const exportToPDF = () => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to export the population summary as a PDF.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, export it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const { jsPDF } = window.jspdf;

                        // Create new PDF document
                        const doc = new jsPDF({
                            orientation: 'portrait',
                            unit: 'mm',
                            format: 'a4',
                            putOnlyUsedFonts: true,
                            floatPrecision: 16
                        });

                        const table = document.querySelector('table');

                        // Add logo
                        doc.addImage(base64Logo, 'PNG', 10, 10, 20, 20); // Adjust x, y, width, height as needed

                        // Add title with custom styling
                        doc.setFontSize(20);
                        doc.text('Population Summary', 14, 40); // Adjust Y position to avoid overlap with logo

                        // Get current date and time
                        const currentDate = new Date();

                        // Format the date as 'MM/DD/YYYY'
                        const formattedDate = currentDate.toLocaleDateString(); 

                        // Format the time as 'HH:MM AM/PM'
                        const formattedTime = currentDate.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }); // Adjust options as needed

                        // Combine date and time
                        const printedDateTime = `Printed on: ${formattedDate} at ${formattedTime}`;

                        // Add printed date and time
                        doc.setFontSize(12);
                        doc.text(printedDateTime, 14, 50); // Position the date below the title
                        // Add table to PDF with custom styles
                        doc.autoTable({
                            html: table,
                            startY: 55, // Start drawing below the date
                            theme: 'grid',
                            styles: {
                                cellPadding: 2,
                                fontSize: 10,
                                overflow: 'linebreak',
                                tableLineColor: [0, 0, 0],
                                tableLineWidth: 0.75,
                                halign: 'center',
                                valign: 'middle'
                            },
                            margin: { top: 10 }
                        });

                        // Footer with page number
                        const pageCount = doc.internal.getNumberOfPages();
                        for (let i = 1; i <= pageCount; i++) {
                            doc.setPage(i);
                            doc.text(`Page ${i} of ${pageCount}`, 10, doc.internal.pageSize.height - 10);
                        }

                        // Save the PDF
                        doc.save('population_summary.pdf');

                        // Show success message
                        Swal.fire(
                            'Exported!',
                            'Your PDF has been exported.',
                            'success'
                        );
                    }
                });
            };

            // Add click event to the button
            document.querySelector('.btn-success').addEventListener('click', exportToPDF);
        };
    });
</script>





</body>
</html>
