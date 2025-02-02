document.addEventListener('DOMContentLoaded', function() {
    // Initialize tables once
    initializeTables();
    // Handle consultation search after initialization
    handleConsultationSearch();
});

function initializeTables() {
    // Initialize the DataTables for appointments and consultations only once
    if (!$.fn.dataTable.isDataTable('#appointmentsTable')) {
        $('#appointmentsTable').DataTable({
            responsive: true,        // Make the table responsive
            processing: true,        // Show a processing indicator when loading data
            stateSave: true,         // Save the state of the table (pagination, search, etc.)
        });
    }

    if (!$.fn.dataTable.isDataTable('#consultationsTable')) {
        $('#consultationsTable').DataTable({
            responsive: true,        // Make the table responsive
            processing: true,        // Show a processing indicator when loading data
            stateSave: true,         // Save the state of the table (pagination, search, etc.)
        });
    }
}

function handleConsultationSearch() {
    // Check if the "search" parameter exists in the URL
    const urlParams = new URLSearchParams(window.location.search);
    const searchParam = urlParams.get('search'); // Replace 'search' with your desired parameter

    // If the parameter exists, set it as the value of the DataTable search input
    if (searchParam) {
        // Use the existing DataTable instance to apply the search filter
        var table = $('#consultationsTable').DataTable();  // Access the DataTable instance
        table.search(searchParam).draw();  // Apply the search and redraw the table
    }
}

