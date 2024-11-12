document.addEventListener('DOMContentLoaded', function() {
    // Prepare events from the schedules
    const events = schedules.map(schedule => {
        return {
            title: schedule.sched_note, // Use the schedule note as the event title
            start: schedule.sched_date,  // Use the schedule date as the event start date
            allDay: true
        };
    });

    // Initialize FullCalendar
    const calendarEl = document.getElementById('prenatalCalendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth', // Change this to your preferred view
        events: events, // Pass the events data to FullCalendar
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        eventClick: function(info) {
            alert(info.event.title); // Show an alert with the event title on click
        }
    });

    calendar.render(); // Render the calendar
});
