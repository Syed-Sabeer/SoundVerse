// Project details charts

(function () {
  var summary_chat_option = {
    series: [70, 80, 92],
    chart: {
      height: 240,
      type: "radialBar",
      stacked: false,
      toolbar: {
        show: false,
      },
    },
    plotOptions: {
      radialBar: {
        offsetY: 0,
        startAngle: 0,
        endAngle: 270,
        hollow: {
          margin: 5,
          size: "30%",
          background: "transparent",
          image: undefined,
        },
        dataLabels: {
          name: {
            show: true,
            offsetY: -10,
          },
          value: {
            offsetY: -5,
            fontSize: "12px",
          },
          total: {
            show: true,
            fontSize: "11px",
            fontFamily: "Rubik, sans-serif",
            fontWeight: 500,
            label: "80%",
            formatter: () => "Completed",
          },
        },
        barLabels: {
          enabled: true,
          useSeriesColors: false,
          margin: 8,
          fontSize: "12px",
          formatter: function (seriesName, opts) {
            return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex];
          },
        },
      },
    },
    colors: ["#7366FF", "#54BA4A", "#ffb829"],
    labels: ["Pending", "In Progress", "Completed"],
    legend: {
      show: false,
    },
    responsive: [
      {
        breakpoint: 1675,
        options: {
          chart: {
            offsetX: 10,
          },
        },
      },
      {
        breakpoint: 480,
        options: {
          legend: {
            show: false,
          },
        },
      },
    ],
  };

  var summary_chat = new ApexCharts(document.querySelector("#summary-chart"), summary_chat_option);
  summary_chat.render();

  // Task-overview
  var taskOverview = {
    series: [
      {
        name: "Incomplete",
        data: [78, 55, 55, 22, 22, 37, 37, 51, 51, 32, 32, 18],
      },
      {
        name: "Completed",
        data: [3, 22, 42, 42, 33, 32, 18, 18, 48, 48, 70, 70],
      },
    ],
    chart: {
      type: "area",
      height: 363,
      toolbar: {
        show: false,
      },
      dropShadow: {
        enabled: true,
        top: 8,
        left: 0,
        blur: 6,
        color: ["#7366FF", "#54BA4A"],
        opacity: 0.4,
      },
    },
    stroke: {
      curve: "monotoneCubic",
      lineCap: "butt",
      width: 2,
    },
    xaxis: {
      type: "category",
      categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "July", "Aug", "Sep", "Oct", "Nov", "Dec"],
      tickAmount: 12,
      labels: {
        style: {
          colors: "var(--chart-text-color)",
          fontSize: "12px",
          fontFamily: "Rubik, sans-serif",
          fontWeight: 400,
        },
      },
      axisTicks: {
        show: false,
      },
      axisBorder: {
        show: false,
      },
      tooltip: {
        enabled: false,
      },
    },
    grid: {
      show: true,
      borderColor: "rgba(230, 233, 235, 1)",
      strokeDashArray: 3,
      position: "back",
      xaxis: {
        lines: {
          show: true,
        },
      },
    },
    yaxis: {
      min: 0,
      max: 95,
      tickAmount: 6,
      labels: {
        style: {
          colors: "rgba(82, 82, 108, 0.8)",
          fontSize: "12px",
          fontFamily: "Rubik, sans-serif",
          fontWeight: 400,
        },
      },
    },
    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    markers: {
      hover: {
        sizeOffset: 4,
      },
    },
    colors: [CubaAdminConfig.primary, "#65c15c"],
    fill: {
      type: "gradient",
      gradient: {
        shade: "light",
        type: "vertical",
        shadeIntensity: 0,
        inverseColors: true,
        opacityFrom: 0,
        opacityTo: 0,
        stops: [0, 100],
      },
    },
    markers: {
      discrete: [
        {
          seriesIndex: 0,
          dataPointIndex: 3,
          fillColor: "#7064F5",
          strokeColor: "var(--white)",
          size: 5,
          sizeOffset: 6,
        },
        {
          seriesIndex: 1,
          dataPointIndex: 3,
          fillColor: "#54BA4A",
          strokeColor: "var(--white)",
          size: 5,
          sizeOffset: 6,
        },
      ],
      hover: {
        size: 6,
        sizeOffset: 0,
      },
    },

    responsive: [
      {
        breakpoint: 1875,
        options: {
          xaxis: {
            tickAmount: 6,
          },
        },
      },
      {
        breakpoint: 1661,
        options: {
          chart: {
            height: 345,
          },
        },
      },
      {
        breakpoint: 1400,
        options: {
          chart: {
            height: 225,
          },
        },
      },
    ],
  };
  var taskOverview = new ApexCharts(document.querySelector("#task-overview-chart"), taskOverview);
  taskOverview.render();

  // Expense Chart
  var expenseChart = {
    series: [
      {
        name: "Income",
        type: "line",
        data: [12, 30, 45, 20, 60, 50],
      },
    ],
    chart: {
      height: 100,
      type: "line",
      toolbar: {
        show: false,
      },
      dropShadow: {
        enabled: true,
        top: 4,
        left: 0,
        blur: 2,
        colors: ["#7366FF"],
        opacity: 0.02,
      },
    },
    grid: {
      show: false,
      xaxis: {
        lines: {
          show: false,
        },
      },
    },
    colors: ["#65c15c"],
    stroke: {
      width: 3,
      curve: "monotoneCubic",
      lineCap: "butt",
      opacity: 1,
    },
    tooltip: {
      shared: false,
      intersect: false,
      marker: {
        width: 5,
        height: 5,
      },
    },
    xaxis: {
      type: "category",
      categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
      tickAmount: 12,
      crosshairs: {
        show: false,
      },
      labels: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
      axisBorder: {
        show: false,
      },
      tooltip: {
        enabled: false,
      },
    },
    fill: {
      opacity: 1,
      type: "gradient",
      gradient: {
        shade: "light",
        type: "horizontal",
        inverseColors: true,
        shadeIntensity: 1,
        opacityFrom: [1],
        opacityTo: 1,
        stops: [0, 100, 300],
      },
    },
    yaxis: {
      tickAmount: 5,
      labels: {
        show: false,
      },
    },
    legend: {
      show: false,
    },
    responsive: [
      {
        breakpoint: 1698,
        options: {
          chart: {
            height: 100,
            offsetX: 0,
          },
        },
      },
      {
        breakpoint: 497,
        options: {
          chart: {
            height: 90,
            width: 200,
          },
        },
      },
      {
        breakpoint: 397,
        options: {
          chart: {
            width: 150,
          },
        },
      },
      {
        breakpoint: 347,
        options: {
          chart: {
            width: 120,
          },
        },
      },
    ],
  };

  var expenseChart = new ApexCharts(document.querySelector("#expense-chart"), expenseChart);
  expenseChart.render();

  // Monthly Expense
  var monthlyExpense = {
    series: [
      {
        name: "Month",
        data: [4, 3, 3, 3, 4, 3, 3, 4, 5, 3.5],
      },
    ],
    chart: {
      height: 100,
      type: "bar",
      toolbar: {
        show: false,
      },
      dropShadow: {
        enabled: true,
        top: 8,
        left: 0,
        blur: 8,
        color: "#7366FF",
        opacity: 0.1,
      },
    },
    plotOptions: {
      bar: {
        borderRadius: 2,
        borderRadiusApplication: "around",
        borderRadiusWhenStacked: "last",
        columnWidth: "20%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    xaxis: {
      labels: {
        show: false,
      },
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
      tooltip: {
        enabled: false,
      },
    },
    yaxis: {
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
      labels: {
        show: false,
      },
    },
    grid: {
      show: false,
    },
    colors: ["var(--theme-default)", "rgba(115, 102, 255, 0.13)", "rgba(115, 102, 255, 0.33)", "rgba(115, 102, 255, 0.62)", "rgba(115, 102, 255, 0.09)"],
    responsive: [
      {
        breakpoint: 1698,
        options: {
          chart: {
            height: 100,
          },
        },
      },
      {
        breakpoint: 576,
        options: {
          plotOptions: {
            bar: {
              columnWidth: "8px",
            },
          },
        },
      },
      {
        breakpoint: 497,
        options: {
          chart: {
            height: 90,
            width: 200,
          },
        },
      },
      {
        breakpoint: 397,
        options: {
          chart: {
            width: 150,
          },
        },
      },
      {
        breakpoint: 347,
        options: {
          chart: {
            width: 120,
          },
          plotOptions: {
            bar: {
              columnWidth: "4px",
            },
          },
        },
      },
    ],
  };

  var monthlyExpense = new ApexCharts(document.querySelector("#monthly-chart"), monthlyExpense);
  monthlyExpense.render();

  // Yearly Expense
  var yearExpense = {
    series: [
      {
        name: "Year",
        data: [20, 20, 8, 8, 20, 20, 25, 25],
      },
    ],
    chart: {
      type: "area",
      height: 100,
      toolbar: {
        show: false,
      },
    },
    stroke: {
      curve: "straight",
      width: 3,
    },
    xaxis: {
      type: "category",
      categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "July", "Aug"],
      labels: {
        show: false,
      },
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
      tooltip: {
        enabled: false,
      },
    },
    grid: {
      show: false,
    },
    yaxis: {
      show: false,
    },
    dataLabels: {
      enabled: false,
    },
    markers: {
      discrete: [
        {
          seriesIndex: 0,
          dataPointIndex: 3,
          fillColor: "#ffb829",
          strokeColor: "var(--white)",
          size: 4,
          sizeOffset: 2,
        },
      ],
      hover: {
        size: 5,
        sizeOffset: 0,
      },
    },
    colors: ["#ffb829"],
    fill: {
      type: "gradient",
      gradient: {
        shade: "light",
        type: "vertical",
        shadeIntensity: 0.1,
        inverseColors: true,
        opacityFrom: 0.2,
        opacityTo: 0,
        stops: [0, 100],
      },
    },
    responsive: [
      {
        breakpoint: 1698,
        options: {
          chart: {
            height: 100,
          },
        },
      },
      {
        breakpoint: 497,
        options: {
          chart: {
            height: 90,
            width: 200,
          },
        },
      },
      {
        breakpoint: 397,
        options: {
          chart: {
            width: 150,
          },
        },
      },
      {
        breakpoint: 347,
        options: {
          chart: {
            width: 120,
          },
        },
      },
    ],
  };
  var yearExpense = new ApexCharts(document.querySelector("#year-chart"), yearExpense);
  yearExpense.render();

  // Budget Distribution
  var projectChart = {
    series: [44, 55, 67, 83],
    chart: {
      height: 300,
      type: "radialBar",
    },
    plotOptions: {
      radialBar: {
        dataLabels: {
          name: {
            fontSize: "12px",
            fontFamily: "Rubik, sans-serif",
            fontWeight: 500,
            color: "var(--chart-text-color)",
            offsetY: 18,
          },
          value: {
            fontSize: "18px",
            fontFamily: "Rubik, sans-serif",
            fontWeight: 600,
            color: "#2F2F3B",
            offsetY: -18,
          },
          total: {
            show: true,
            label: "Budget Use",
            fontSize: "13px",
            formatter: function (w) {
              return 67;
            },
          },
        },
      },
    },
    legend: {
      show: true,
      position: "bottom",
      horizontalAlign: "center",
      offsetY: 0,
      fontSize: "14px",
      fontFamily: "Rubik, sans-serif",
      fontWeight: 500,
      labels: {
        colors: "var(--chart-text-color)",
      },
      markers: {
        width: 8,
        height: 8,
      },
    },
    colors: ["#7366FF", "#838383", "#ffb829", "#65c15c"],
    labels: ["Design", "Product", "Development", "Marketing"],
  };

  var projectChart = new ApexCharts(document.querySelector("#projectchart"), projectChart);
  projectChart.render();
})();
