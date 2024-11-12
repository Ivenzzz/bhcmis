initializePrenatalTable();
searchSelectResident();

function initializePrenatalTable() {
    $(document).ready(function() {
        $('#prenatalsTable').DataTable({
            "ordering": false
        });
    });
}

function searchSelectResident() {
    document.getElementById('searchResident').addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        const items = document.querySelectorAll('.resident-item');

        items.forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    document.querySelectorAll('.resident-item').forEach(item => {
        item.addEventListener('click', function() {
            document.getElementById('pregnancy_id').value = this.getAttribute('data-id');
            document.getElementById('resident_search').value = this.textContent;
            var modal = bootstrap.Modal.getInstance(document.getElementById('residentModal'));
            modal.hide();
        });
    });
}