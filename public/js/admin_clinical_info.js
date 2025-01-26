handleTableExports();

function handleTableExports() {
document.addEventListener('DOMContentLoaded', function () {
    // Load jsPDF
    const { jsPDF } = window.jspdf;

    // Function to get the current date and time in a formatted string
    function getCurrentDateTime() {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero-based
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        return `${year}-${month}-${day}_${hours}-${minutes}-${seconds}`;
    }

    // Function to export all tables to a single PDF
    function exportAllToPDF() {
        const doc = new jsPDF();

        // Add Consultations Table
        doc.setFontSize(16);
        doc.text('Consultations', 105, 10, { align: 'center' }); // Center-aligned title
        doc.autoTable({
            html: '#consultationsTable',
            startY: 20,
            headStyles: { halign: 'center' }, // Center-align header cells
            bodyStyles: { halign: 'center' }, // Center-align body cells
        });
        doc.addPage();

        // Add Immunizations Table
        doc.setFontSize(16);
        doc.text('Immunizations', 105, 10, { align: 'center' }); // Center-aligned title
        doc.autoTable({
            html: '#immunizationsTable',
            startY: 20,
            headStyles: { halign: 'center' }, // Center-align header cells
            bodyStyles: { halign: 'center' }, // Center-align body cells
        });
        doc.addPage();

        // Add Prenatals Table
        doc.setFontSize(16);
        doc.text('Prenatal', 105, 10, { align: 'center' }); // Center-aligned title
        doc.autoTable({
            html: '#prenatalsTable',
            startY: 20,
            headStyles: { halign: 'center' }, // Center-align header cells
            bodyStyles: { halign: 'center' }, // Center-align body cells
        });

        // Save the PDF with a timestamped filename
        const timestamp = getCurrentDateTime();
        doc.save(`Clinic_Data_${timestamp}.pdf`);
    }

    // Function to export all tables to a single Excel file
    function exportAllToExcel() {
        // Create a new workbook
        const workbook = XLSX.utils.book_new();

        // Add Consultations Table
        const consultationsTable = document.getElementById('consultationsTable');
        const consultationsSheet = XLSX.utils.table_to_sheet(consultationsTable);
        addTitleToSheet(consultationsSheet, 'Consultations'); // Add title to sheet
        centerAlignExcelCells(consultationsSheet); // Center-align cells
        XLSX.utils.book_append_sheet(workbook, consultationsSheet, 'Consultations');

        // Add Immunizations Table
        const immunizationsTable = document.getElementById('immunizationsTable');
        const immunizationsSheet = XLSX.utils.table_to_sheet(immunizationsTable);
        addTitleToSheet(immunizationsSheet, 'Immunizations'); // Add title to sheet
        centerAlignExcelCells(immunizationsSheet); // Center-align cells
        XLSX.utils.book_append_sheet(workbook, immunizationsSheet, 'Immunizations');

        // Add Prenatals Table
        const prenatalsTable = document.getElementById('prenatalsTable');
        const prenatalsSheet = XLSX.utils.table_to_sheet(prenatalsTable);
        addTitleToSheet(prenatalsSheet, 'Prenatal'); // Add title to sheet
        centerAlignExcelCells(prenatalsSheet); // Center-align cells
        XLSX.utils.book_append_sheet(workbook, prenatalsSheet, 'Prenatal');

        // Save the Excel file with a timestamped filename
        const timestamp = getCurrentDateTime();
        XLSX.writeFile(workbook, `Clinic_Data_${timestamp}.xlsx`);
    }

    // Function to add a title to an Excel sheet
    function addTitleToSheet(sheet, title) {
        // Shift all existing data down by 1 row
        const range = XLSX.utils.decode_range(sheet['!ref']);
        range.e.r += 1; // Increase the end row by 1
        for (let row = range.e.r; row > 0; row--) {
            for (let col = range.s.c; col <= range.e.c; col++) {
                const cellAddress = XLSX.utils.encode_cell({ r: row, c: col });
                const previousCellAddress = XLSX.utils.encode_cell({ r: row - 1, c: col });
                sheet[cellAddress] = sheet[previousCellAddress] || {};
            }
        }

        // Add the title in the first row
        const titleCellAddress = XLSX.utils.encode_cell({ r: 0, c: 0 });
        sheet[titleCellAddress] = { t: 's', v: title, s: { font: { bold: true }, alignment: { horizontal: 'center' } } };

        // Merge cells for the title
        sheet['!merges'] = sheet['!merges'] || [];
        sheet['!merges'].push({ s: { r: 0, c: 0 }, e: { r: 0, c: range.e.c } });

        // Update the sheet's range
        sheet['!ref'] = XLSX.utils.encode_range(range);
    }

    // Function to center-align cells in an Excel sheet
    function centerAlignExcelCells(sheet) {
        const range = XLSX.utils.decode_range(sheet['!ref']);
        for (let row = range.s.r; row <= range.e.r; row++) {
            for (let col = range.s.c; col <= range.e.c; col++) {
                const cellAddress = XLSX.utils.encode_cell({ r: row, c: col });
                if (!sheet[cellAddress]) continue;
                sheet[cellAddress].s = sheet[cellAddress].s || {};
                sheet[cellAddress].s.alignment = sheet[cellAddress].s.alignment || {};
                sheet[cellAddress].s.alignment.horizontal = 'center'; // Center-align text
            }
        }
    }

    // Add buttons for exporting all tables
    function addExportAllButtons() {
        const container = document.createElement('div');
        container.className = 'mb-3';

        // Create PDF button
        const pdfButton = document.createElement('button');
        pdfButton.textContent = 'Export to PDF';
        pdfButton.className = 'btn btn-danger btn-sm me-2';
        pdfButton.onclick = exportAllToPDF;

        // Create Excel button
        const excelButton = document.createElement('button');
        excelButton.textContent = 'Export to Excel';
        excelButton.className = 'btn btn-success btn-sm';
        excelButton.onclick = exportAllToExcel;

        // Add buttons to the container
        container.appendChild(pdfButton);
        container.appendChild(excelButton);

        // Insert the container above the first table
        const firstTableContainer = document.querySelector('.card-body').parentElement;
        firstTableContainer.insertBefore(container, firstTableContainer.firstChild);
    }

    // Add export buttons for all tables
    addExportAllButtons();
});
}