initPopulationTable();

function initPopulationTable() {
    $(document).ready(function () {
        $('#populationTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: 'Copy',
                    className: 'btn-copy',
                    init: function(api, node, config) {
                        $(node).css({
                            'background-color': '#6c757d',
                            'color': '#fff',
                            'border': 'none',
                            'border-radius': '4px',
                            'padding': '8px 12px'
                        });
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: 'CSV',
                    className: 'btn-csv',
                    init: function(api, node, config) {
                        $(node).css({
                            'background-color': '#17a2b8',
                            'color': '#fff',
                            'border': 'none',
                            'border-radius': '4px',
                            'padding': '8px 12px'
                        });
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    className: 'btn-excel',
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
                    className: 'btn-pdf',
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
                    className: 'btn-print',
                    action: function (e, dt, node, config) {
                        // Open print_population_table.php in a new tab
                        window.open('print_population_table.php', '_blank');
                    },
                    init: function(api, node, config) {
                        $(node).css({
                            'background-color': '#007bff',
                            'color': '#fff',
                            'border': 'none',
                            'border-radius': '4px',
                            'padding': '8px 12px'
                        });
                    }
                },
                {
                    extend: 'pageLength',
                    className: 'btn-page-length',
                    init: function(api, node, config) {
                        $(node).css({
                            'background-color': '#fd7e14',
                            'color': '#fff',
                            'border': 'none',
                            'border-radius': '4px',
                            'padding': '8px 12px'
                        });
                    }
                },
            ],
            paging: false,     // Disable pagination
            searching: false,  // Disable searching
            ordering: false    // Disable sorting
        });
    });
}