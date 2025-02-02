document.addEventListener('DOMContentLoaded', function () {
    var calendar = initializeConsultationsCalendar();
    handleConsultationFormSubmission(calendar);
});

function initializeConsultationsCalendar() {
    var calendarEl = document.getElementById('consultationsCalendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth', // Default view when the calendar loads
        events: function (info, successCallback, failureCallback) {
            // Fetch consultation schedules from the PHP API
            fetch('../api/consultation_schedules.php')
                .then(response => response.json())
                .then(data => {
                    // Pass the events to FullCalendar
                    successCallback(data);
                })
                .catch(error => {
                    failureCallback(error);
                });
        },
        eventColor: '#378006',
        eventContent: function (arg) {
            let eventTime = FullCalendar.formatDate(arg.event.start, {
                hour: '2-digit',
                minute: '2-digit',
                meridiem: 'short',
            });
        
            let icon = document.createElement('i');
            icon.className = 'fa fa-thumbtack';
            icon.style.color = '#dc2626';
            icon.style.marginRight = '5px';
        
            let container = document.createElement('div');
            container.className = 'text-xs'; // Add a custom class
        
            container.appendChild(icon);
            container.appendChild(document.createTextNode(eventTime));
        
            return { domNodes: [container] };
        },
        dateClick: function (info) {
            var clickedEvent = null;
        
            // Check if the clicked date matches any event
            calendar.getEvents().forEach(function (event) {
                if (event.start.toISOString().split('T')[0] === info.dateStr) {
                    clickedEvent = event; // Store the event object
                }
            });
        
            if (clickedEvent) {
                // Redirect to consultation_details.php with the event's con_sched_id
                window.location.href = `consultation_details.php?con_sched_id=${clickedEvent.id}`;
            } else {
                // If no event exists for the clicked date, show the modal to add a new consultation
                $('#addConsultationModal').modal('show');
                document.getElementById('consultationDate').value = info.dateStr + "T12:00";
            }
        },
        
        eventDidMount: function (info) {
            // Add a context menu event listener (right-click) to events
            info.el.addEventListener('contextmenu', function (e) {
                e.preventDefault(); // Prevent default right-click menu

                // Show a custom context menu for deletion
                showContextMenu(e, info.event, calendar);
            });
        },

        headerToolbar: {
            left: 'prev,next',       // Navigation buttons
            center: 'title',               // Title (current month/week/day)
            right: 'dayGridMonth,dayGridWeek' // Buttons for month, week, day views
        },
    });

    calendar.render();
    return calendar;
}


function showContextMenu(event, calendarEvent, calendar) {
    // Create the context menu container if it doesn't exist
    let contextMenu = document.getElementById('contextMenu');
    if (!contextMenu) {
        contextMenu = document.createElement('div');
        contextMenu.id = 'contextMenu';
        contextMenu.style.position = 'absolute';
        contextMenu.style.zIndex = '1000';
        contextMenu.style.background = '#fff';
        contextMenu.style.border = '1px solid #ccc';
        contextMenu.style.boxShadow = '0px 2px 5px rgba(0, 0, 0, 0.2)';
        contextMenu.style.padding = '8px';
        contextMenu.style.cursor = 'pointer';

        document.body.appendChild(contextMenu);

        // Hide the context menu when clicking elsewhere
        document.addEventListener('click', () => {
            contextMenu.style.display = 'none';
        });
    }

    // Set the content and position of the context menu
    contextMenu.innerHTML = `<button id="deleteEventButton" class="btn btn-danger btn-sm">Delete</button>`;
    contextMenu.style.top = `${event.clientY}px`;
    contextMenu.style.left = `${event.clientX}px`;
    contextMenu.style.display = 'block';

    // Add a click event listener to the "delete" button
    document.getElementById('deleteEventButton').onclick = function () {
        deleteEvent(calendarEvent, calendar);
        contextMenu.style.display = 'none';
    };
}

function deleteEvent(calendarEvent, calendar) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to undo this action!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
    }).then((result) => {
        if (result.isConfirmed) {
            // Send the delete request to the server
            fetch('../controllers/midwife_delete_consultation_schedule.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    id: calendarEvent.id, // Assuming the event has a unique ID
                }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove the event from the calendar
                        calendarEvent.remove();

                        // Show a success message
                        Swal.fire(
                            'Deleted!',
                            'The consultation has been deleted.',
                            'success'
                        );
                    } else {
                        // Show an error message
                        Swal.fire(
                            'Error!',
                            'An error occurred while deleting the consultation.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    // Show an error message
                    Swal.fire(
                        'Error!',
                        'An unexpected error occurred: ' + error,
                        'error'
                    );
                });
        }
    });
}

function handleConsultationFormSubmission(calendar) {
    document.getElementById('consultationForm').addEventListener('submit', function (event) {
        event.preventDefault();

        var consultationDate = document.getElementById('consultationDate').value;
        var consultationDetails = document.getElementById('consultationDetails').value;

        fetch('../controllers/midwife_add_consultation_schedule.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                date: consultationDate,
                details: consultationDetails,
            }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    $('#addConsultationModal').modal('hide');
                    calendar.refetchEvents();
                } else {
                    alert("Error adding consultation!");
                }
            })
            .catch(error => {
                alert("Error: " + error);
            });
    });
}
