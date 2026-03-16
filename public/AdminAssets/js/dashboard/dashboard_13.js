// Dashboard 13 JS

(function () {
  // Package chart
  var packageChart = {
    series: [
      {
        name: "New Packages",
        data: [1.5, 3, 1.9, 1, 3.6, 1, 2.8],
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
        enabledOnSeries: undefined,
        top: 24,
        left: 0,
        blur: 6,
        color: "#7064F5",
        opacity: 0.5,
      },
    },
    plotOptions: {
      bar: {
        borderRadius: 6,
        columnWidth: "30%",
        borderRadiusApplication: "end",
      },
    },
    dataLabels: {
      enabled: false,
    },
    xaxis: {
      show: false,
      categories: [],
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
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
    },
    grid: {
      show: false,
    },
    colors: ["#7366FF", "#8D83FF"],
    fill: {
      type: "gradient",
      gradient: {
        shade: "light",
        type: "vertical",
        gradientToColors: ["#7366FF", "#8D83FF"],
        opacityFrom: 0.98,
        opacityTo: 0.85,
        stops: [0, 100],
      },
    },
  };

  var packageChart = new ApexCharts(document.querySelector("#package-chart"), packageChart);
  packageChart.render();

  // Delivered chart
  var packageDelivered = {
    series: [
      {
        name: "Delivered",
        data: [20, 45, 18, 35, 65, 45],
      },
    ],
    chart: {
      type: "line",
      height: 70,
      sparkline: {
        enabled: true,
      },
      dropShadow: {
        enabled: true,
        top: 3,
        left: 3,
        blur: 2,
        color: ["#ffb829"],
        opacity: 0.4,
      },
    },
    stroke: {
      curve: "stepline",
      width: 2,
    },
    colors: ["#ffb829"],
    fill: {
      opacity: [0.5],
    },
    dataLabels: {
      enabled: false,
    },
    markers: {
      hover: {
        sizeOffset: 4,
      },
      discrete: [
        {
          seriesIndex: 0,
          dataPointIndex: 1,
          fillColor: "#fff",
          strokeColor: "#ffb829",
          size: 3,
          shape: "circle",
        },
        {
          seriesIndex: 0,
          dataPointIndex: 4,
          fillColor: "#fff",
          strokeColor: "#ffb829",
          size: 3,
          shape: "circle",
        },
      ],
    },
    responsive: [
      {
        breakpoint: 1400,
        options: {
          chart: {
            height: 75,
          },
        },
      },
      {
        breakpoint: 1236,
        options: {
          chart: {
            height: 80,
          },
        },
      },
      {
        breakpoint: 1200,
        options: {
          chart: {
            height: 85,
          },
        },
      },
    ],
  };

  var packageDelivered = new ApexCharts(document.querySelector("#package-delivered"), packageDelivered);
  packageDelivered.render();

  // Client Chart
  var newClients = {
    series: [
      {
        name: "New Clients",
        data: [10, 16, 40, 20, 30, 70, 40, 80, 80, 120, 80, 30, 80, 120, 60, 160, 60, 65, 10],
      },
    ],
    chart: {
      type: "area",
      height: 120,
      toolbar: {
        show: false,
      },
    },
    stroke: {
      show: true,
      curve: "smooth",
      lineCap: "butt",
      width: 2,
    },
    xaxis: {
      type: "category",
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
    colors: ["#65c15c"],
    fill: {
      type: "gradient",
      gradient: {
        shade: "light",
        type: "vertical",
        shadeIntensity: 1,
        inverseColors: true,
        opacityFrom: 0.8,
        opacityTo: 0,
        stops: [0, 100],
      },
    },
  };
  var newClients = new ApexCharts(document.querySelector("#new-clients-chart"), newClients);
  newClients.render();

  // Delivery-duration
  var deliveryDuration = {
    series: [
      {
        name: "Late Delivery",
        type: "column",
        data: [30, 22, 15, 37, 30, 22, 30, 15, 30, 22, 26],
      },
      {
        name: "On Time Delivery",
        type: "line",
        data: [72, 35, 58, 50, 90, 38, 75, 50, 55, 28, 65],
      },
    ],
    chart: {
      height: 300,
      type: "line",
      stacked: false,
      offsetX: 20,
      offsetY: 20,
      toolbar: {
        show: false,
      },
      dropShadow: {
        enabled: true,
        enabledOnSeries: [1],
        top: 13,
        left: 0,
        blur: 6,
        color: "#7366FF",
        opacity: 0.4,
      },
    },
    stroke: {
      width: [0, 2],
      curve: "smooth",
      dashArray: [0, 0],
    },
    plotOptions: {
      bar: {
        columnWidth: "30%",
        borderRadius: 6,
        borderRadiusApplication: "end",
      },
    },
    colors: ["rgba(131, 131, 131, 0.3)", "#7366FF"],
    fill: {
      type: "solid",
      gradient: {
        shade: "dark",
        type: "vertical",
        opacityFrom: 1,
        opacityTo: 1,
        stops: [0, 100],
      },
    },
    grid: {
      borderColor: "var(--chart-border)",
      yaxis: {
        lines: {
          show: true,
        },
      },
    },
    legend: {
      show: false,
    },
    markers: {
      size: 0,
      discrete: [
        {
          seriesIndex: 0,
          dataPointIndex: 4,
          fillColor: "rgba(131, 131, 131, 1)",
          strokeColor: "var(--white)",
          size: 6,
          sizeOffset: 3,
        },
        {
          seriesIndex: 1,
          dataPointIndex: 4,
          fillColor: "#7366FF",
          strokeColor: "var(--white)",
          size: 6,
          sizeOffset: 3,
        },
      ],
    },
    annotations: {
      points: [
        {
          x: 217,
          y: 29.5,
          marker: {
            size: 6,
            fillColor: "rgba(131, 131, 131, 0.3)",
            strokeColor: "var(--white)",
            strokeWidth: 2,
            radius: 5,
          },
        },
      ],
      xaxis: [
        {
          x: 217,
          strokeDashArray: 2,
          borderWidth: 1,
          borderColor: "var(--body-font-color)",
        },
      ],
    },
    xaxis: {
      categories: ["Jan", "Feb", "Mar", " Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov"],
      labels: {
        style: {
          fontFamily: "Rubik, sans-serif",
          colors: ["#52526c"],
        },
      },
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
    },
    yaxis: {
      title: {
        text: "Points",
      },
      min: 0,
      max: 100,
      tickAmount: 5,
      title: {
        text: undefined,
      },
    },
    responsive: [
      {
        breakpoint: 1870,
        options: {
          chart: {
            height: 300,
          },
        },
      },
      {
        breakpoint: 1691,
        options: {
          chart: {
            height: 280,
          },
        },
      },
      {
        breakpoint: 1245,
        options: {
          xaxis: {
            tickAmount: 5,
            tickPlacement: "on",
          },
          annotations: {
            points: [
              {
                x: 103,
                y: 29.5,
                marker: {
                  size: 6,
                  fillColor: "rgba(131, 131, 131, 0.3)",
                  strokeColor: "var(--white)",
                  strokeWidth: 2,
                  radius: 5,
                },
              },
            ],
            xaxis: [
              {
                x: 103,
                strokeDashArray: 2,
                borderWidth: 1,
                borderColor: "var(--body-font-color)",
              },
            ],
          },
        },
      },
      {
        breakpoint: 1063,
        options: {
          chart: {
            height: 305,
          },
        },
      },
      {
        breakpoint: 1048,
        options: {
          chart: {
            height: 328,
          },
        },
      },
      {
        breakpoint: 1008,
        options: {
          chart: {
            height: 350,
          },
        },
      },
      {
        breakpoint: 992,
        options: {
          chart: {
            height: 280,
          },
        },
      },
      {
        breakpoint: 968,
        options: {
          chart: {
            height: 328,
          },
        },
      },
      {
        breakpoint: 928,
        options: {
          chart: {
            height: 350,
          },
        },
      },
      {
        breakpoint: 778,
        options: {
          chart: {
            height: 375,
          },
        },
      },
      {
        breakpoint: 576,
        options: {
          chart: {
            height: 250,
            offsetX: 0,
            offsetY: 0,
          },
          xaxis: {
            tickAmount: 3,
            tickPlacement: "on",
          },
        },
      },
    ],
  };

  // // Initialize the chart
  var deliveryDurationChart = new ApexCharts(document.querySelector("#delivery-duration"), deliveryDuration);
  deliveryDurationChart.render();

  // Open Sales Order
  var salesOrderChart = {
    series: [
      {
        name: "Sales Order",
        type: "area",
        data: [0, 45, 16, 30, 15, 60],
      },
    ],
    chart: {
      height: 265,
      type: "line",
      offsetY: 20,
      offsetX: 0,
      stacked: false,
      toolbar: {
        show: false,
      },
      dropShadow: {
        enabled: true,
        enabledOnSeries: [0, 0],
        top: 10,
        left: 0,
        blur: 6,
        color: CubaAdminConfig.success,
        opacity: 0.3,
      },
    },
    stroke: {
      width: [2],
      curve: "straight",
      lineCap: "butt",
      dashArray: [0],
    },
    grid: {
      show: true,
      strokeDashArray: 0,
      position: "back",
      borderColor: "rgba(82, 82, 108, 0.1)",
    },
    title: {
      text: "Boxes Pending Since",
      align: "left",
      offsetY: 10,
      style: {
        fontSize: "16px",
        fontWeight: 400,
        fontFamily: "Rubik, sans-serif",
        color: "rgba(47, 47, 59, 1)",
      },
    },
    colors: [CubaAdminConfig.success],
    fill: {
      type: "gradient",
      gradient: {
        shade: "light",
        type: "vertical",
        opacityFrom: 0.4,
        opacityTo: 0,
        stops: [0, 0],
      },
    },
    annotations: {
      points: [
        {
          x: 275,
          y: 26.5,
          marker: {
            size: 5,
            fillColor: CubaAdminConfig.success,
            strokeWidth: 2,
            strokeColor: "#ffffff",
          },
        },
      ],
    },
    xaxis: {
      categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
      axisBorder: {
        low: 0,
        offsetX: 0,
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
    legend: {
      show: false,
    },
    yaxis: {
      min: 0,
      max: 60,
      tickAmount: 3,
      tickPlacement: "between",
    },
    responsive: [
      {
        breakpoint: 1717,
        options: {
          chart: {
            height: 288,
          },
        },
      },
      {
        breakpoint: 1694,
        options: {
          chart: {
            height: 310,
          },
        },
      },
      {
        breakpoint: 1634,
        options: {
          chart: {
            height: 295,
          },
          annotations: {
            points: [
              {
                x: 106,
                y: 26.5,
                marker: {
                  size: 5,
                  fillColor: CubaAdminConfig.success,
                  strokeWidth: 2,
                  strokeColor: "#ffffff",
                },
              },
            ],
          },
        },
      },
      {
        breakpoint: 1400,
        options: {
          chart: {
            height: 270,
          },
        },
      },
      {
        breakpoint: 1200,
        options: {
          chart: {
            height: 225,
          },
        },
      },
    ],
  };

  var salesOrderChart = new ApexCharts(document.querySelector("#sales-order-chart"), salesOrderChart);
  salesOrderChart.render();

  // Fleet Status
  var fleetStatus = {
    labels: ["In Maintenance(20)", "On the Move(58)", "Total Fleet(63)"],
    series: [70, 60, 45],
    chart: {
      height: 413,
      type: "radialBar",
    },
    plotOptions: {
      radialBar: {
        track: {
          strokeWidth: "60%",
          background: "rgba(216, 216, 216, 0.37)",
        },
        hollow: {
          size: "60%",
        },
        dataLabels: {
          name: {
            fontSize: "16px",
            fontWeight: 500,
            offsetY: 30,
            color: ["#52526C"],
          },
          value: {
            show: true,
            fontSize: "30px",
            fontWeight: 600,
            offsetY: -10,
          },
          total: {
            show: true,
            fontSize: "16px",
            label: "Total Task",
            formatter: function (w) {
              return 95 + "%";
            },
          },
        },
      },
    },
    stroke: {
      lineCap: "round",
    },
    legend: {
      show: true,
      position: "bottom",
      fontSize: "14px",
      fontFamily: "Rubik, sans-serif",
      inverseOrder: true,
      horizontalAlign: "center",
      fontWeight: 500,
      labels: {
        colors: "rgba(82, 82, 108, 1)",
      },
      markers: {
        width: 8,
        height: 8,
        offsetX: -3,
      },
      itemMargin: {
        horizontal: 9,
        vertical: 0,
      },
    },
    colors: ["#65c15c", "#ffb829", "#7366FF"],
    responsive: [
      {
        breakpoint: 1717,
        options: {
          chart: {
            height: 435,
          },
        },
      },
      {
        breakpoint: 1694,
        options: {
          chart: {
            height: 460,
            width: 460,
            offsetX: -30,
          },
        },
      },
      {
        breakpoint: 1634,
        options: {
          chart: {
            height: 444,
            width: 400,
            offsetX: -10,
          },
        },
      },
      {
        breakpoint: 1596,
        options: {
          chart: {
            offsetX: -25,
          },
        },
      },
      {
        breakpoint: 1541,
        options: {
          chart: {
            offsetX: -35,
          },
        },
      },
      {
        breakpoint: 1470,
        options: {
          chart: {
            width: 355,
            offsetX: -20,
          },
        },
      },
      {
        breakpoint: 1425,
        options: {
          chart: {
            offsetX: -25,
          },
        },
      },
      {
        breakpoint: 1401,
        options: {
          chart: {
            offsetX: -30,
          },
        },
      },
      {
        breakpoint: 1400,
        options: {
          chart: {
            width: "100%",
            height: 360,
            offsetX: 0,
            offsetY: 0,
          },
          plotOptions: {
            radialBar: {
              track: {
                strokeWidth: "60%",
                background: "rgba(216, 216, 216, 0.37)",
              },
              hollow: {
                size: "60%",
              },
              dataLabels: {
                name: {
                  fontSize: "12px",
                  fontWeight: 500,
                  offsetY: 20,
                  color: ["#52526C"],
                },
                value: {
                  show: true,
                  fontSize: "16px",
                  fontWeight: 600,
                  offsetY: -20,
                },
                total: {
                  show: true,
                  fontSize: "12px",
                  label: "Total Task",
                  formatter: function (w) {
                    return 95 + "%";
                  },
                },
              },
            },
          },
        },
      },
    ],
  };

  var fleetStatus = new ApexCharts(document.querySelector("#fleet-status"), fleetStatus);
  fleetStatus.render();

  // Profit Country
  var profitableCountryOptions = {
    series: [
      {
        name: "Country",
        data: [142, 195, 99, 150, 75],
      },
    ],
    chart: {
      type: "bar",
      toolbar: {
        show: false,
      },
      height: 372,
    },
    grid: {
      show: true,
      borderColor: "rgba(82, 82, 108, 0.1)",
      strokeDashArray: 0,
    },
    plotOptions: {
      bar: {
        columnWidth: "20%",
        borderRadius: 8,
        borderRadiusApplication: "end",
        distributed: true,
        barHeight: "100%",
      },
    },
    annotations: {
      points: [
        {
          x: 230,
          y: 155.5,
          marker: {
            size: 8,
            fillColor: CubaAdminConfig.success,
            strokeColor: "var(--white)",
            strokeWidth: 4,
            radius: 5,
          },
          label: {
            borderWidth: 0,
            offsetY: -8,
            text: "Germany($150k)",
            color: ["rgba(47, 47, 59, 1)"],
            borderRadius: 10,
            style: {
              fontSize: "13px",
              fontWeight: "600",
              fontFamily: "Rubik, sans-serif",
              background: "#f4f4f4",
              padding: {
                left: 30,
                right: 16,
                top: 10,
                bottom: 10,
              },
            },
          },
        },
      ],
    },
    xaxis: {
      show: false,
      categories: [],
      labels: {
        show: false,
        style: {
          fontSize: "12px",
          fontFamily: "Rubik, sans-serif",
          colors: "var(--chart-text-color)",
        },
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
    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    yaxis: {
      show: true,
      min: 0,
      max: 250,
      tickAmount: 5,
      showForNullSeries: true,
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
      labels: {
        formatter: function (val) {
          return val + "" + "K";
        },
        style: {
          fontSize: "12px",
          fontFamily: "Rubik, sans-serif",
          colors: "rgba(82, 82, 108, 1)",
        },
      },
    },
    colors: [CubaAdminConfig.primary, CubaAdminConfig.secondary, "#ffb829", CubaAdminConfig.success, "#fc564a"],
    fill: {
      type: "gradient",
      opacity: 1,
      gradient: {
        shade: "light",
        type: "vertical",
        shadeIntensity: 0.1,
        opacityFrom: 1,
        opacityTo: 0.2,
        stops: [0, 100],
      },
      opacity: 1,
    },
    responsive: [
      {
        breakpoint: 1826,
        options: {
          annotations: {
            points: [
              {
                x: 120,
                y: 155.5,
                marker: {
                  size: 8,
                  fillColor: CubaAdminConfig.success,
                  strokeColor: "var(--white)",
                  strokeWidth: 4,
                  radius: 5,
                },
                label: {
                  borderWidth: 0,
                  offsetY: -8,
                  text: "Germany($150k)",
                  color: ["rgba(47, 47, 59, 1)"],
                  borderRadius: 10,
                  style: {
                    fontSize: "13px",
                    fontWeight: "600",
                    fontFamily: "Rubik, sans-serif",
                    background: "#f4f4f4",
                    padding: {
                      left: 30,
                      right: 16,
                      top: 10,
                      bottom: 10,
                    },
                  },
                },
              },
            ],
          },
        },
      },
      {
        breakpoint: 1661,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 6,
            },
          },
          annotations: {
            points: [
              {
                x: 50,
                y: 155.5,
                marker: {
                  size: 6,
                  fillColor: CubaAdminConfig.success,
                  strokeColor: "var(--white)",
                  strokeWidth: 3,
                  radius: 3,
                },
                label: {
                  borderWidth: 0,
                  offsetY: -8,
                  text: "Germany($150k)",
                  color: ["rgba(47, 47, 59, 1)"],
                  borderRadius: 10,
                  style: {
                    fontSize: "13px",
                    fontWeight: "600",
                    fontFamily: "Rubik, sans-serif",
                    background: "#f4f4f4",
                    padding: {
                      left: 20,
                      right: 16,
                      top: 10,
                      bottom: 10,
                    },
                  },
                },
              },
            ],
          },
        },
      },
      {
        breakpoint: 1426,
        options: {
          chart: {
            height: 293,
          },
        },
      },
      {
        breakpoint: 1400,
        options: {
          plotOptions: {
            bar: {
              columnWidth: "25%",
            },
          },
        },
      },
      {
        breakpoint: 1290,
        options: {
          chart: {
            height: 212,
          },
          annotations: {
            points: [
              {
                x: 167,
                y: 155.5,
                marker: {
                  size: 6,
                  fillColor: CubaAdminConfig.success,
                  strokeColor: "var(--white)",
                  strokeWidth: 3,
                  radius: 3,
                },
                label: {
                  borderWidth: 0,
                  offsetY: -8,
                  text: "Germany($150k)",
                  color: ["rgba(47, 47, 59, 1)"],
                  borderRadius: 10,
                  style: {
                    fontSize: "13px",
                    fontWeight: "600",
                    fontFamily: "Rubik, sans-serif",
                    background: "#f4f4f4",
                    padding: {
                      left: 20,
                      right: 16,
                      top: 10,
                      bottom: 10,
                    },
                  },
                },
              },
            ],
          },
        },
      },
      {
        breakpoint: 1200,
        options: {
          chart: {
            height: 300,
          },
          plotOptions: {
            bar: {
              borderRadius: 10,
            },
          },
          annotations: {
            points: [
              {
                x: 167,
                y: 155.5,
                marker: {
                  size: 8,
                  fillColor: CubaAdminConfig.success,
                  strokeColor: "var(--white)",
                  strokeWidth: 4,
                  radius: 5,
                },
                label: {
                  borderWidth: 0,
                  offsetY: -8,
                  text: "Germany($150k)",
                  color: ["rgba(47, 47, 59, 1)"],
                  borderRadius: 10,
                  style: {
                    fontSize: "13px",
                    fontWeight: "600",
                    fontFamily: "Rubik, sans-serif",
                    background: "#f4f4f4",
                    padding: {
                      left: 20,
                      right: 16,
                      top: 10,
                      bottom: 10,
                    },
                  },
                },
              },
            ],
          },
        },
      },
      {
        breakpoint: 992,
        options: {
          chart: {
            height: 270,
          },
          annotations: {
            points: [
              {
                x: 80,
                y: 155.5,
                marker: {
                  size: 8,
                  fillColor: CubaAdminConfig.success,
                  strokeColor: "var(--white)",
                  strokeWidth: 4,
                  radius: 5,
                },
                label: {
                  borderWidth: 0,
                  offsetY: -8,
                  text: "Germany($150k)",
                  color: ["rgba(47, 47, 59, 1)"],
                  borderRadius: 10,
                  style: {
                    fontSize: "13px",
                    fontWeight: "600",
                    fontFamily: "Rubik, sans-serif",
                    background: "#f4f4f4",
                    padding: {
                      left: 20,
                      right: 16,
                      top: 10,
                      bottom: 10,
                    },
                  },
                },
              },
            ],
          },
        },
      },
      {
        breakpoint: 426,
        options: {
          chart: {
            height: 250,
          },
          plotOptions: {
            bar: {
              columnWidth: "25%",
              borderRadius: 6,
            },
          },
        },
      },
    ],
  };
  // Initialize the chart
  var profitableCountry = new ApexCharts(document.querySelector("#profitable-country-chart"), profitableCountryOptions);
  profitableCountry.render();
})();
