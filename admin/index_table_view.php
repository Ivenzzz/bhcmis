<?php

session_start();

date_default_timezone_set('Asia/Manila');

$title = 'Population ' . date('F d, Y');

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/population_analytics.php';

$user = getCurrentUser($conn);
$area_stats = getPerAreaStats($conn);

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

            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Table View</li>
                </ol>
            </nav> 
            
            <div class="row mb-4">
                <div class="col-md-12">
                    <a href="index.php" class="btn btn-sm btn-secondary">Graph View</a>
                    <a href="index_table_view.php" class="btn btn-sm btn-primary">Table View</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 shadow p-4">
                    <h4 class="poppins-bold text-center">Population as of <?= date('F d, Y') ?></h4>
                </div>
            </div>

            <!-- Table displaying area statistics -->
            <div class="row mb-4">
                <div class="col-md-12 shadow p-4">
                <table id="populationTable" class="table text-center text-xs table-primary">
                    <thead class="table-dark">
                        <tr>
                            <th>Hacienda/Sitio</th>
                            <th>Total Households</th>
                            <th>Total Families</th>
                            <th>Total Residents</th>
                            <th>Total Females</th>
                            <th>Total Males</th>
                            <th>Total Seniors (60+)</th>
                            <th>Total Children (12-)</th>
                            <th>Total Transferred</th>
                            <th>Total Deceased</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // Initialize variables for totals
                        $total_households = 0;
                        $total_families = 0;
                        $total_residents = 0;
                        $total_females = 0;
                        $total_males = 0;
                        $total_seniors = 0;
                        $total_children = 0;
                        $total_transferred = 0;
                        $total_deceased = 0;
                        ?>

                        <?php if (!empty($area_stats)): ?>
                            <?php foreach ($area_stats as $stat): 
                                // Accumulate totals
                                $total_households += $stat['total_households'];
                                $total_families += $stat['total_families'];
                                $total_residents += $stat['total_residents'];
                                $total_females += $stat['total_females'];
                                $total_males += $stat['total_males'];
                                $total_seniors += $stat['total_seniors'];
                                $total_children += $stat['total_children'];
                                $total_transferred += $stat['total_transferred'];
                                $total_deceased += $stat['total_deceased'];
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($stat['address_name']) ?></td>
                                    <td><?= htmlspecialchars($stat['total_households']) ?></td>
                                    <td><?= htmlspecialchars($stat['total_families']) ?></td>
                                    <td><?= htmlspecialchars($stat['total_residents']) ?></td>
                                    <td><?= htmlspecialchars($stat['total_females']) ?></td>
                                    <td><?= htmlspecialchars($stat['total_males']) ?></td>
                                    <td><?= htmlspecialchars($stat['total_seniors']) ?></td>
                                    <td><?= htmlspecialchars($stat['total_children']) ?></td>
                                    <td><?= htmlspecialchars($stat['total_transferred']) ?></td>
                                    <td><?= htmlspecialchars($stat['total_deceased']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="10" class="text-center">No data available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot class="table-dark">
                        <tr class="text-center">
                            <th class="text-center">Total</th>
                            <th class="text-center"><?= $total_households ?></th>
                            <th class="text-center"><?= $total_families ?></th>
                            <th class="text-center"><?= $total_residents ?></th>
                            <th class="text-center"><?= $total_females ?></th>
                            <th class="text-center"><?= $total_males ?></th>
                            <th class="text-center"><?= $total_seniors ?></th>
                            <th class="text-center"><?= $total_children ?></th>
                            <th class="text-center"><?= $total_transferred ?></th>
                            <th class="text-center"><?= $total_deceased ?></th>
                        </tr>
                    </tfoot>
                </table>

                </div>
            </div>

        </div>
    </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script>
        $(document).ready(function () {
            $('#populationTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        className: 'btn-excel', // Custom class for styling
                        init: function(api, node, config) {
                            $(node).css({
                                'background-color': '#28a745',
                                'color': '#fff',
                                'border': 'none',
                                'border-radius': '4px',
                                'padding': '8px 12px'
                            });
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        className: 'btn-pdf', // Custom class for styling
                        init: function(api, node, config) {
                            $(node).css({
                                'background-color': '#dc3545',
                                'color': '#fff',
                                'border': 'none',
                                'border-radius': '4px',
                                'padding': '8px 12px'
                            });
                        }
                    },
                    {
                        extend: 'print',
                        text: 'Print Report',
                        className: 'btn-print', // Custom class for styling
                        init: function(api, node, config) {
                            $(node).css({
                                'background-color': '#007bff',
                                'color': '#fff',
                                'border': 'none',
                                'border-radius': '4px',
                                'padding': '8px 12px'
                            });
                        }
                    }
                ],
                paging: false,     // Disable pagination
                searching: false,  // Disable searching
                ordering: false    // Disable sorting
            });
        });
    </script>
</body>
</html>
