// Call the function to set up print buttons and export button
printAppointment();

function printAppointment() {
    document.addEventListener('DOMContentLoaded', function() {
        const printButtons = document.querySelectorAll('.btn-print');

        // Add event listener to each print button
        printButtons.forEach(button => {
            button.addEventListener('click', function() {
                const appointmentId = this.getAttribute('data-appointment-id');
                generateReceiptPDF(appointmentId);
            });
        });

        // Add event listener for the Export to PDF button
        const exportPdfBtn = document.getElementById('exportPdfBtn');
        exportPdfBtn.addEventListener('click', function() {
            exportTableToPDF(); // Call the function to export the table
        });
    });
}

// Function to generate receipt PDF
function generateReceiptPDF(appointmentId) {
    const receiptContentElement = document.getElementById('receiptContent' + appointmentId);
    const receiptContent = receiptContentElement.innerText;

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Split the content into lines for better formatting
    const lines = receiptContent.split('\n');

    lines.forEach((line, index) => {
        doc.text(line, 10, 10 + (index * 10)); // Add each line with a margin
    });

    doc.save(`appointment_receipt_${appointmentId}.pdf`);
}

// Function to export the table to PDF
function exportTableToPDF() {
    const table = document.getElementById('appointmentsTable');
    const rows = Array.from(table.querySelectorAll('tbody tr')); // Get all rows from the table body
    const data = [];

    // Collecting header and row data, excluding the actions column
    const headers = ['Priority Number', 'Tracking Code', 'Resident Name', 'Contact Number', 'Status'];
    data.push(headers);

    rows.forEach(row => {
        const cols = Array.from(row.querySelectorAll('td'));
        const rowData = [
            cols[0].innerText, // Priority Number
            cols[1].innerText, // Tracking Code
            cols[2].innerText, // Resident Name
            cols[3].innerText, // Contact Number
            cols[4].innerText  // Status
        ];
        data.push(rowData);
    });

    // Create a new jsPDF instance and add the table
    const { jsPDF } = window.jspdf;
    const pdf = new jsPDF('l', 'mm', 'a4'); // Landscape orientation

    pdf.autoTable({
        head: [headers],
        body: data.slice(1), // Exclude headers for the body
        startY: 20, // Starting position for the table
        theme: 'grid', // Optional: Use a grid theme
    });

    // Save the PDF
    pdf.save('appointments.pdf');
}
