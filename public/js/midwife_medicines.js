initMedicinesTable();

function initMedicinesTable() {
    // Initialize DataTable
    document.addEventListener('DOMContentLoaded', function () {
        const table = new DataTable('#medicinesTable', {
            responsive: true,
            stateSave: true, // Enable state saving (remembers sorting, search, pagination)
            columnDefs: [
                {
                    targets: 2, // Column index for expiry_status (which is the 3rd column, 0-based index 2)
                    orderDataType: 'expiry-status', // Apply custom sorting logic for expiry status
                },
            ],
            order: [[2, 'asc']], // Default sort by expiry_status (Valid, Expiring, Expired)
        });
    });
}
        
