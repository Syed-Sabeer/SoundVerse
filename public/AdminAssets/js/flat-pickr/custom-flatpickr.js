// Custom-flatpickr JS
(function () {
  const datePickerID = ["datetime-local", "datetime-local3", "datetime-localEvent"]; // Array of IDs
  const timePickerID = ["time-picker1", "time-picker2"]; // Array of IDs
  const rangeDateID = ["range-date"]; // Array of IDs

  datePickerID.forEach((id) => {
    flatpickr(`#${id}`, {
      dateFormat: "d-m-Y",
    });
  });

  // 2. Human Friendly
  flatpickr("#human-friendly", {
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
  });

  flatpickr("#human-friendly1", {
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "d-m-Y",
  });

  // 3. min-max value
  flatpickr("#min-max", {
    dateFormat: "d.m.Y",
    maxDate: "15.12.2017",
  });

  // 4. disabled-date
  flatpickr("#disabled-date", {
    disable: ["2025-01-30", "2025-02-21", "2025-03-08", new Date(2025, 4, 9)],
    dateFormat: "d-m-Y",
  });

  // 5. multiple-date
  flatpickr("#multiple-date", {
    mode: "multiple",
    dateFormat: "d-m-Y",
  });

  // 6. Customizing the Conjunction
  flatpickr("#customize-date", {
    mode: "multiple",
    dateFormat: "d-m-Y",
    conjunction: " :: ",
  });

  // 7. Range-date
  rangeDateID.forEach((id) => {
    flatpickr(`#${id}`, {
      mode: "range",
      dateFormat: "d-m-Y",
    });
  });

  // 8. Disabled Range
  flatpickr("#preloading-date", {
    mode: "multiple",
    dateFormat: "d-m-Y",
    defaultDate: ["2016-10-20", "2016-11-04"],
  });

  // Time-picker
  timePickerID.forEach((id) => {
    flatpickr(`#${id}`, {
      enableTime: true,
      noCalendar: true,
      dateFormat: "H:i",
    });
  });

  flatpickr("#time-picker", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
  });

  // 10. 24-hour Time Picker
  flatpickr("#twenty-four-hour", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true,
  });

  // 11. Time Picker W/Limits
  flatpickr("#limit-time", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    minTime: "16:00",
    maxTime: "22:30",
  });

  // 12. Preloading Time
  flatpickr("#preloading-time", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    defaultDate: "13:45",
  });

  // 13. DateTimePicker with Limited Time Range[min-time]
  flatpickr("#limit-time-range", {
    enableTime: true,
    minTime: "09:00",
    dateFormat: "d-m-Y H:i",
  });

  // 14. DateTimePicker with Limited Time Range[min/max-time]
  flatpickr("#limit-min-max-range", {
    enableTime: true,
    minTime: "16:00",
    maxTime: "22:00",
    dateFormat: "d-m-Y H:i",
  });

  // 15. Date With Time
  flatpickr("#datetime-local1", {
    enableTime: true,
    dateFormat: "d-m-Y H:i",
  });

  flatpickr("#datetime-local2", {
    enableTime: true,
    dateFormat: "d-m-Y H:i",
  });

  // 16. monthSelectPlugin
  flatpickr("#inline-calender", {
    inline: true,
  });
})();
