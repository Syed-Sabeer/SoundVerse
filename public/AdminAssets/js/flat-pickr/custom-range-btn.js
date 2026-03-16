// Custom-range button flatpickr JS
(function () {
  // 17. Date range picker for day, week, month, select custom
  document.addEventListener("DOMContentLoaded", function () {
    var start = moment().subtract(29, "days");
    var end = moment();

    function cb(start, end) {
      document.querySelector("#reportrange span").innerHTML = start.format("DD-MM-YYYY") + " - " + end.format("DD-MM-YYYY");
    }

    var flatpickrInstance = flatpickr("#reportrange", {
      mode: "range",
      dateFormat: "d-m-Y",
      defaultDate: [start.toDate(), end.toDate()],
      clickOpens: false, // Prevent calendar from showing when clicking
      closeOnSelect: true, // Automatically close dropdown after date selection
      onChange: function (selectedDates) {
        if (selectedDates.length === 2) {
          var startDate = moment(selectedDates[0]);
          var endDate = moment(selectedDates[1]);
          cb(startDate, endDate);
          flatpickrInstance.close();
        }
      },
    });

    cb(start, end);

    // Custom range buttons (This needs to be handled separately from flatpickr)
    var customRanges = {
      Today: [moment(), moment()],
      Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
      "Last 7 Days": [moment().subtract(6, "days"), moment()],
      "Last 30 Days": [moment().subtract(29, "days"), moment()],
      "This Month": [moment().startOf("month"), moment().endOf("month")],
      "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")],
    };

    // Create range buttons dynamically
    var rangeButtonsContainer = document.createElement("div");
    rangeButtonsContainer.id = "rangeButtons";

    Object.keys(customRanges).forEach(function (rangeName) {
      var button = document.createElement("button");
      button.innerText = rangeName;

      // Button click event handler
      button.onclick = function () {
        var range = customRanges[rangeName];
        var start = range[0];
        var end = range[1];

        // Set the selected date range in flatpickr
        flatpickrInstance.setDate([start.toDate(), end.toDate()]);
        cb(start, end);

        // Remove 'active' class from all buttons
        document.querySelectorAll("#rangeButtons button").forEach(function (btn) {
          btn.classList.remove("active");
        });

        // Add 'active' class to the clicked button
        this.classList.add("active");
      };

      rangeButtonsContainer.appendChild(button);
    });

    // Create a button for "Custom Select Date Range"
    var customRangeButton = document.createElement("button");
    customRangeButton.innerText = "Custom Date Range";

    // Custom button click event to open the flatpickr calendar
    customRangeButton.onclick = function () {
      flatpickrInstance.open();

      // Remove 'active' class from all buttons
      document.querySelectorAll("#rangeButtons button").forEach(function (btn) {
        btn.classList.remove("active");
      });

      // Add 'active' class to the custom button
      this.classList.add("active");
    };

    // Append the custom button to the range buttons container
    rangeButtonsContainer.appendChild(customRangeButton);

    // Append the range buttons to the "reportrange" element
    var reportrange = document.querySelector("#reportrange");
    if (reportrange) {
      reportrange.appendChild(rangeButtonsContainer);

      // Add click event listener for showing/hiding range options
      reportrange.addEventListener("click", function () {
        var rangeButtons = document.getElementById("rangeButtons");
        if (rangeButtons) {
          rangeButtons.classList.toggle("range-option");
        }
      });
    }
  });
})();
