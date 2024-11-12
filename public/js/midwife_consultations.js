showConsultationCalendar();

function showConsultationCalendar() {
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        const consultationSchedules = JSON.parse(calendarEl.getAttribute('data-schedules'));

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            eventTimeFormat: {
                hour: 'numeric',
                minute: '2-digit',
                meridiem: 'short'
            },
            events: consultationSchedules.map(schedule => ({
                start: schedule.con_sched_date,
                color: 'blue',
                sched_id: schedule.con_sched_id 
            })),
            
            dateClick: function(info) {
                const clickedDate = info.date;
            
                // Format the date (YYYY-MM-DD) while accounting for local time zone
                const year = clickedDate.getFullYear();
                const month = String(clickedDate.getMonth() + 1).padStart(2, '0'); // Month is zero-based, so we add 1
                const day = String(clickedDate.getDate()).padStart(2, '0'); 
            
                const formattedDate = `${year}-${month}-${day}`; // YYYY-MM-DD format

                // Check if the clicked date has a schedule
                const schedule = consultationSchedules.find(s => {
                    const scheduleDate = new Date(s.con_sched_date);
                    return (
                        scheduleDate.getFullYear() === clickedDate.getFullYear() &&
                        scheduleDate.getMonth() === clickedDate.getMonth() &&
                        scheduleDate.getDate() === clickedDate.getDate()
                    );
                });

                if (schedule) {
                    // If a schedule exists, redirect to the appointment list page with the schedule ID
                    window.location.href = `midwife-appointments?sched_id=${schedule.con_sched_id}`;
                } else {
                    // If no schedule exists, set the formatted date in the modal input field
                    const consultationDateInput = document.getElementById('consultationDate');
                    consultationDateInput.value = formattedDate;

                    // Show the modal for adding a new consultation schedule
                    var addConsultationModal = new bootstrap.Modal(document.getElementById('addConsultationModal'));
                    addConsultationModal.show();
                }
            },
            
            dayCellDidMount: function(info) {
                const clickedDate = info.date;
                const schedule = consultationSchedules.find(s => {
                    const scheduleDate = new Date(s.con_sched_date);
                    return (
                        scheduleDate.getFullYear() === clickedDate.getFullYear() &&
                        scheduleDate.getMonth() === clickedDate.getMonth() &&
                        scheduleDate.getDate() === clickedDate.getDate()
                    );
                });

                const tooltipContent = schedule ? 'View Appointments' : 'Add Schedule';
                tippy(info.el, {
                    content: tooltipContent,
                    trigger: 'mouseenter',
                    placement: 'top',
                });
            }
        });

        calendar.render();
    });
}
