document.addEventListener('DOMContentLoaded', function() {
    initializeTables();
});

function initializeTables() {
    $(document).ready(function() {
        // Initialize the DataTables for appointments and consultations
        $('#appointmentsTable').DataTable({
            responsive: true,        // Make the table responsive
            processing: true,        // Show a processing indicator when loading data
            stateSave: true,         // Save the state of the table (pagination, search, etc.)
        });

        $('#consultationsTable').DataTable({
            responsive: true,        // Make the table responsive
            processing: true,        // Show a processing indicator when loading data
            stateSave: true,         // Save the state of the table (pagination, search, etc.)
        });
    });
}
