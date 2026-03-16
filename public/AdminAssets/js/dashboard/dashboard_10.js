// Dashboard 10 JS

(function () {
  // Visit chart
  var visitUser = {
    series: [
      {
        name: "Visits",
        data: [11, 23, 7, 18, 10, 11, 9, 20, 13, 25, 6, 30],
      },
    ],
    chart: {
      height: 222,
      type: "line",
      stacked: true,
      toolbar: {
        show: false,
      },
      dropShadow: {
        enabled: true,
        top: 10,
        left: 0,
        blur: 12,
        color: "#7366FF",
        opacity: 0.5,
      },
    },
    colors: ["#7366FF"],
    stroke: {
      width: 2.5,
      curve: "smooth",
    },
    xaxis: {
      lines: {
        show: true,
      },
      type: "category",
      categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      labels: {
        style: {
          fontSize: "12px",
          fontFamily: "Rubik, sans-serif",
          colors: "#52526C",
          fontWeight: 400,
        },
      },
      axisTicks: {
        show: false,
      },
      axisBorder: {
        show: false,
      },
    },
    yaxis: {
      min: 0,
      max: 25,
      tickAmount: 5,
      labels: {
        formatter: function (val) {
          return val + "k";
        },
        style: {
          fontSize: "12px",
          fontFamily: "Rubik, sans-serif",
          colors: "#52526C",
          fontWeight: 400,
        },
      },
    },
    grid: {
      show: true,
      borderColor: "var(--chart-border)",
      strokeDashArray: 0,
      position: "back",
      xaxis: {
        lines: {
          show: false,
        },
      },
      yaxis: {
        lines: {
          show: true,
        },
      },
    },
    tooltip: {
      enabled: false,
    },
    fill: {
      type: ["gradient", "solid"],
      gradient: {
        shade: "dark",
        gradientToColors: ["#7366FF"],
        shadeIntensity: 1,
        type: "horizontal",
        opacityFrom: 0.9,
        opacityTo: 1,
        colorStops: [
          {
            offset: 0,
            color: "#48A3D7",
            opacity: 1,
          },
          {
            offset: 100,
            color: "#7366FF",
            opacity: 1,
          },
        ],
      },
    },
    annotations: {
      xaxis: [
        {
          x: 340,
          strokeDashArray: 2,
          borderWidth: 1,
          borderColor: CubaAdminConfig.primary,
        },
      ],
      points: [
        {
          x: 340,
          y: 20.5,
          marker: {
            size: 8,
            fillColor: CubaAdminConfig.primary,
            strokeColor: "#ffffff",
            strokeWidth: 4,
            radius: 5,
          },
          label: {
            borderWidth: 1,
            offsetY: 0,
            text: "4.6%",
            style: {
              fontSize: "12px",
              fontWeight: "600",
              fontFamily: "Rubik, sans-serif",
            },
          },
        },
      ],
    },
    responsive: [
      {
        breakpoint: 1846,
        options: {
          chart: {
            height: 245,
            offsetY: 0,
          },
        },
      },
      {
        breakpoint: 1530,
        options: {
          annotations: {
            xaxis: [
              {
                x: 100,
                strokeDashArray: 2,
                borderWidth: 1,
                borderColor: CubaAdminConfig.primary,
              },
            ],
            points: [
              {
                x: 100,
                y: 20.5,
                marker: {
                  size: 8,
                  fillColor: CubaAdminConfig.primary,
                  strokeColor: "#ffffff",
                  strokeWidth: 4,
                  radius: 5,
                },
                label: {
                  borderWidth: 1,
                  offsetY: 0,
                  text: "2.6%",
                  style: {
                    fontSize: "12px",
                    fontWeight: "600",
                    fontFamily: "Rubik, sans-serif",
                  },
                },
              },
            ],
          },
        },
      },
      {
        breakpoint: 1456,
        options: {
          chart: {
            height: 220,
          },
        },
      },
      {
        breakpoint: 1325,
        options: {
          xaxis: {
            tickAmount: 6,
            tickPlacement: "between",
          },
        },
      },
      {
        breakpoint: 1200,
        options: {
          chart: {
            height: 224,
          },
        },
      },
      {
        breakpoint: 812,
        options: {
          chart: {
            height: 228,
          },
        },
      },
      {
        breakpoint: 792,
        options: {
          chart: {
            offsetY: 0,
          },
        },
      },
    ],
  };

  var visitChart = new ApexCharts(document.querySelector("#visit-chart"), visitUser);
  visitChart.render();

  //  Finance Chart
  var countryChart = {
    series: [
      {
        name: "Session",
        data: [40, 20, 30, 15, 40, 26],
      },
    ],
    chart: {
      type: "bar",
      height: 275,
      stacked: true,
      toolbar: {
        show: false,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "52%",
        borderRadius: 0,
      },
    },
    grid: {
      show: true,
      borderColor: "var(--chart-border)",

      yaxis: {
        lines: {
          show: true,
        },
      },
    },
    dataLabels: {
      enabled: true,
      enabledOnSeries: undefined,
      formatter: function (val) {
        return val + "%";
      },
      textAnchor: "middle",
      distributed: false,
      offsetX: 0,
      offsetY: 0,
      style: {
        fontSize: "11px",
        fontFamily: "Rubik, sans-serif",
        fontWeight: "500",
      },
    },
    stroke: {
      width: 2,
      dashArray: 0,
      lineCap: "butt",
      colors: "#fff",
    },
    fill: {
      opacity: 1,
    },
    legend: {
      show: false,
    },

    colors: ["#40b8f5"],
    fill: {
      type: "gradient",
      gradient: {
        shade: "light",
        gradientToColors: [CubaAdminConfig.primary],
        shadeIntensity: 1,
        type: "vertical",
        opacityFrom: 0.9,
        opacityTo: 1,
        stops: [0, 100, 100, 100],
      },
    },
    yaxis: {
      min: 0,
      max: 50,
      tickAmount: 5,
      tickPlacement: "between",
      labels: {
        formatter: function (value) {
          return value + "%";
        },
        style: {
          fontWeight: 400,
          colors: "#52526C",
          fontSize: 12,
          fontFamily: "Rubik, sans-serif",
        },
      },

      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
    },
    xaxis: {
      categories: ["India", "Canada", "Russia", "Germany", "France", "China"],
      labels: {
        style: {
          fontWeight: 400,
          colors: "#52526C",
          fontFamily: "Rubik, sans-serif",
          fontSize: 12,
        },
      },
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
    },
    responsive: [
      {
        breakpoint: 1846,
        options: {
          chart: {
            height: 298,
          },
        },
      },
      {
        breakpoint: 1456,
        options: {
          chart: {
            height: 275,
          },
        },
      },
      {
        breakpoint: 1735,
        options: {
          dataLabels: {
            style: {
              fontSize: "9px",
            },
          },
        },
      },
      {
        breakpoint: 1560,
        options: {
          dataLabels: {
            style: {
              fontSize: "8px",
            },
          },
        },
      },
      {
        breakpoint: 1325,
        options: {
          dataLabels: {
            enabled: false,
          },
        },
      },
      {
        breakpoint: 1200,
        options: {
          chart: {
            height: 282,
          },
        },
      },
      {
        breakpoint: 767,
        options: {
          plotOptions: {
            bar: {
              columnWidth: "15px",
            },
          },
        },
      },
      {
        breakpoint: 624,
        options: {
          chart: {
            height: 264,
          },
        },
      },
      {
        breakpoint: 576,
        options: {
          chart: {
            height: 284,
          },
          plotOptions: {
            bar: {
              columnWidth: "30px",
            },
          },
          dataLabels: {
            enabled: true,
            style: {
              fontSize: "12px",
            },
          },
        },
      },
      {
        breakpoint: 400,
        options: {
          plotOptions: {
            bar: {
              columnWidth: "20px",
            },
          },
          dataLabels: {
            enabled: true,
            style: {
              fontSize: "8px",
            },
          },
        },
      },
    ],
  };

  var countryChart = new ApexCharts(document.querySelector("#country-chart"), countryChart);
  countryChart.render();

  // User-analytics
  var userAnalytics = {
    series: [
      {
        name: "Month",
        data: [4, 3, 3, 3, 4, 3, 3, 4, 5, 3.5, 2.5, 2.5],
      },
    ],
    chart: {
      height: 105,
      type: "bar",
      toolbar: {
        show: false,
      },
    },
    plotOptions: {
      bar: {
        borderRadius: 4,
        borderRadiusApplication: "around",
        borderRadiusWhenStacked: "last",
        columnWidth: "30%",
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
        breakpoint: 576,
        options: {
          plotOptions: {
            bar: {
              columnWidth: "8px",
            },
          },
        },
      },
    ],
  };

  var userAnalytics = new ApexCharts(document.querySelector("#user-analytics"), userAnalytics);
  userAnalytics.render();

  // analytics-page-view
  var pageViewChart = {
    series: [
      {
        name: "Month",
        data: [0, 20, 20, 15, 15, 10, 10, 5, 5, 10, 10, 20, 20, 15, 15, 20, 20],
      },
    ],
    chart: {
      type: "area",
      height: 128,
      toolbar: {
        show: false,
      },
    },
    stroke: {
      curve: "smooth",
      width: 2,
    },
    xaxis: {
      type: "category",
      categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "July", "Aug", "Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "July"],
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
      padding: {
        left: -60,
      },
    },
    yaxis: {
      show: false,
    },
    dataLabels: {
      enabled: false,
    },
    markers: {
      hover: {
        sizeOffset: 4,
      },
    },
    colors: [CubaAdminConfig.secondary],
    fill: {
      type: "gradient",
      gradient: {
        shade: "light",
        type: "vertical",
        shadeIntensity: 0.1,
        inverseColors: true,
        opacityFrom: 0.5,
        opacityTo: 0,
        stops: [0, 100],
      },
    },
  };
  var pageViewChart = new ApexCharts(document.querySelector("#page-view-chart"), pageViewChart);
  pageViewChart.render();

  // Visit-duration
  var VisitDuration = {
    series: [
      {
        name: "Month",
        data: [0, 15, 15, 10, 10, 20, 20, 25, 25],
      },
    ],
    chart: {
      type: "area",
      height: 160,
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
      categories: ["jan", "feb", "mar", "apr", "may", "jun", "july", "aug", "sep", "oct"],
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
      padding: {
        left: -60,
      },
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
          dataPointIndex: 7,
          fillColor: "#ffb829",
          strokeColor: "var(--white)",
          size: 6,
          sizeOffset: 3,
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
        opacityFrom: 0.4,
        opacityTo: 0,
        stops: [0, 100],
      },
    },
    responsive: [
      {
        breakpoint: 1501,
        options: {
          chart: {
            height: 188,
          },
        },
      },
      {
        breakpoint: 1200,
        options: {
          chart: {
            height: 130,
          },
        },
      },
    ],
  };
  var VisitDuration = new ApexCharts(document.querySelector("#visit-duration"), VisitDuration);
  VisitDuration.render();

  // Session chart
  var sessionChart = {
    series: [100, 30, 40],
    labels: ["Desktop", "Mobile", "Tablet"],
    chart: {
      height: 285,
      type: "donut",
    },
    plotOptions: {
      pie: {
        expandOnClick: false,
        donut: {
          size: "75%",
          labels: {
            show: true,
            name: {
              offsetY: 4,
            },
            total: {
              show: true,
              fontSize: "20px",
              fontFamily: "Rubik, sans-serif",
              fontWeight: 500,
              label: "9,540",
              formatter: () => "Total",
            },
          },
        },
      },
    },
    dataLabels: {
      enabled: false,
    },
    colors: ["#7366FF", "#65c15c", "#ffb829"],
    fill: {
      type: "solid",
    },
    legend: {
      show: false,
    },
    stroke: {
      width: 0,
    },
    responsive: [
      {
        breakpoint: 1753,
        options: {
          chart: {
            width: "100%",
            height: 250,
          },
        },
      },
      {
        breakpoint: 1571,
        options: {
          chart: {
            width: "100%",
            height: 220,
          },
        },
      },
      {
        breakpoint: 1440,
        options: {
          chart: {
            width: "100%",
            height: 190,
          },
        },
      },
      {
        breakpoint: 1290,
        options: {
          chart: {
            height: 160,
          },
        },
      },
      {
        breakpoint: 768,
        options: {
          chart: {
            height: 200,
          },
        },
      },
    ],
  };

  var sessionChart = new ApexCharts(document.querySelector("#session-chart"), sessionChart);
  sessionChart.render();

  //  Bounce rate
  var bounceRateChart = {
    series: [
      {
        name: "Bounce Rate",
        data: [10, 5, 4, 8, 3, 4, 6, 4, 3, 9, 10, 5, 12, 14, 10, 12, 14, 14, 10, 12, 14, 20, 24, 14, 10, 12, 10, 12, 14, 18, 18, 10, 12, 10, 8, 12, 10, 12, 14, 10, 8, 10, 12, 12, 14, 10, 14, 12, 12, 10, 22, 12, 11, 8, 12, 8, 12, 14, 13, 16, 14, 14, 8, 8, 5, 6, 6, 8, 8, 7, 7, 6, 10, 18, 8],
      },
    ],
    chart: {
      height: 160,
      type: "area",
      toolbar: {
        show: false,
      },
    },
    stroke: {
      width: 2,
      curve: "straight",
      lineCap: "butt",
    },

    colors: ["#fc564a"],
    fill: {
      type: "gradient",
      gradient: {
        shade: "light",
        type: "vertical",
        shadeIntensity: 0.1,
        inverseColors: true,
        opacityFrom: 0.5,
        opacityTo: 0.1,
        stops: [0, 100],
      },
    },
    dataLabels: {
      enabled: false,
    },

    title: {
      show: false,
    },
    grid: {
      show: false,
      padding: {
        left: -60,
      },
    },
    xaxis: {
      categories: undefined,
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
      show: false,
    },
    dataLabels: {
      enabled: false,
    },
    markers: {
      hover: {
        sizeOffset: 4,
      },
    },
    responsive: [
      {
        breakpoint: 1501,
        options: {
          chart: {
            height: 188,
          },
        },
      },
      {
        breakpoint: 1200,
        options: {
          chart: {
            height: 130,
          },
        },
      },
    ],
  };
  var bounceRateChart = new ApexCharts(document.querySelector("#bounce-rate-chart"), bounceRateChart);
  bounceRateChart.render();
})();
