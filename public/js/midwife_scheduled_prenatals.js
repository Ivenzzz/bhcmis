initScheduledPrenatalTable();

function initScheduledPrenatalTable() {
    $(document).ready(function() {
        // Initialize the DataTable only once
        const table = $('#scheduledPrenatalsTable').DataTable({
            searching: true // Enable searching by default
        });
    
        // Handle URL search parameter
        handleUrlSearch(table);
    });
}

function handleUrlSearch(table) {
    // Check if the "search" parameter exists in the URL
    const urlParams = new URLSearchParams(window.location.search);
    const searchParam = urlParams.get('search'); // Replace 'search' with your desired parameter

    // If the parameter exists, set it as the value of the DataTable search input
    if (searchParam) {
        table.search(searchParam).draw();  // Apply the search and redraw the table
    }
}
