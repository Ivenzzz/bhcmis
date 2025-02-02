initPrenatalCalendar();
initPrenatalTable();
initIncomingPrenatalsTable();
initPregnancyTable();


function initPrenatalCalendar() {
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('prenatalCalendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: '../api/prenatal_schedules.php', // API endpoint
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth'
            },
            themeSystem: 'bootstrap5',  // Set the theme to bootstrap5 (which is Cerulean in this case)
            eventClick: function (info) {
                alert('Schedule: ' + info.event.title + '\nDate: ' + info.event.start.toISOString());
            },
            eventTimeFormat: { // Customize time format
                hour: 'numeric',
                minute: '2-digit',
                meridiem: 'short'
            },
            eventContent: function (arg) {
                // Display a FontAwesome pin icon alongside the time
                let timeText = FullCalendar.formatDate(arg.event.start, {
                    hour: 'numeric',
                    minute: '2-digit',
                    meridiem: 'long'
                });

                return {
                    html: `
                        <span style="display: flex; align-items: center;">
                            <i class="fas fa-map-pin" style="color: green; margin-right: 4px;"></i>
                            ${timeText}
                        </span>
                    `
                };
            },
        });

        calendar.render();
    });
}


function initPrenatalTable() {
    document.addEventListener('DOMContentLoaded', function () {
        $('#prenatalSchedulesTable').DataTable({
            order: [[1, 'asc']], // Order by date ascending
            pageLength: 5,      // Set default page size
            lengthMenu: [5, 10, 25, 50], // Page length options
            columnDefs: [
                { orderable: false, targets: 0 } // Disable ordering on the Schedule ID column
            ],
            language: {
                emptyTable: "No prenatal schedules available."
            }
        });
    });  
}

function initIncomingPrenatalsTable() {
    $(document).ready(function() {
        $('#incomingPrenatalsTable').DataTable({
            searching: false, // Disable searching
            language: {
                emptyTable: "No incoming prenatal appointments."
            }
        });
    });
}

function initPregnancyTable() {
    $(document).ready(function() {
        $('#pregnanciesTable').DataTable({
            searching: false, // Disable searching
            language: {
                emptyTable: "No pregnancy records found."
            }
        });
    });
}

