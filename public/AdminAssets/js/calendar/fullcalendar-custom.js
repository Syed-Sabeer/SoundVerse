// Calendar JS
document.addEventListener("DOMContentLoaded", function () {
  ("use strict");

  // Initialize Tagify
  var input = document.querySelector("input[name=member-tags]");
  if (input) {
    new Tagify(input);
  }

  // Initialize FullCalendar
  var containerEl = document.getElementById("external-events-list");
  new FullCalendar.Draggable(containerEl, {
    itemSelector: ".fc-event",
    eventData: function (eventEl) {
      return {
        title: eventEl.innerText.trim(),
      };
    },
  });

  var calendarEl = document.getElementById("calendar");
  var calendar = new FullCalendar.Calendar(calendarEl, {
    aspectRatio: 2,
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek",
    },
    initialView: "dayGridMonth",
    initialDate: "2024-11-12",
    navLinks: true,
    editable: true,
    selectable: true,
    nowIndicator: true,
    events: [
      { title: "All Day Event", start: "2024-11-01" },
      { title: "Tour With Our Team.", start: "2024-11-07", end: "2024-11-10" },
      { groupId: 999, title: "Meeting With Team", start: "2024-11-11T16:00:00" },
      { groupId: 999, title: "Upload New Project", start: "2024-11-16T16:00:00" },
      { groupId: 999, title: "Innovation Hackathon", start: "2024-12-02T18:00:00" },
      { title: "Birthday Party", start: "2024-11-24" },
      { title: "Reporting About Theme", start: "2024-11-28T10:30:00", end: "2024-11-29T12:30:00" },
      { title: "Lunch", start: "2024-11-30T12:00:00" },
      { title: "Meeting", start: "2024-07-12T14:30:00" },
      { title: "Happy Hour", start: "2024-12-30T17:30:00" },
      { title: "Innovation Hackathon", start: "2024-02-30T17:02:00", end: "2024-03-05" },
      { title: "Fitness Bootcamp", start: "2024-09-12T18:08:00", end: "2024-09-15" },
      { title: "Company Anniversary Celebration", start: "2024-09-02T09:09:00" },
      { title: "Group Projects", start: "2024-10-05T09:08:00" },
    ],
    droppable: true,
    drop: function (arg) {
      if (document.getElementById("drop-remove").checked) {
        arg.draggedEl.parentNode.removeChild(arg.draggedEl);
      }
    },
  });
  calendar.render();
});
