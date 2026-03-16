// General Widget JS

(function () {
  "use strict";
  // visitor chart
  var optionsvisitor = {
    series: [
      {
        name: "Active",
        data: [18, 10, 65, 18, 28, 10],
      },
      {
        name: "Bounce",
        data: [25, 50, 30, 30, 25, 45],
      },
    ],
    chart: {
      type: "bar",
      height: 270,
      toolbar: {
        show: false,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "50%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 6,
      colors: ["transparent"],
    },
    grid: {
      show: true,
      borderColor: "var(--chart-border)",
      xaxis: {
        lines: {
          show: true,
        },
      },
    },
    colors: ["#FFA941", "var(--theme-default)"],
    xaxis: {
      categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
      tickAmount: 4,
      tickPlacement: "between",
      labels: {
        style: {
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
    yaxis: {
      min: 0,
      max: 100,
      tickAmount: 5,
      tickPlacement: "between",
      labels: {
        style: {
          fontFamily: "Rubik, sans-serif",
        },
      },
    },
    fill: {
      opacity: 1,
    },
    legend: {
      position: "top",
      horizontalAlign: "left",
      fontFamily: "Rubik, sans-serif",
      fontSize: "14px",
      fontWeight: 500,
      labels: {
        colors: "var(--chart-text-color)",
      },
      markers: {
        width: 6,
        height: 6,
        radius: 12,
      },
      itemMargin: {
        horizontal: 10,
      },
    },
    responsive: [
      {
        breakpoint: 1639,
        options: {
          chart: {
            height: 255,
          },
        },
      },
      {
        breakpoint: 1400,
        options: {
          chart: {
            height: 240,
          },
          xaxis: {
            tickAmount: 3,
            tickPlacement: "between",
          },
        },
      },
      {
        breakpoint: 1366,
        options: {
          plotOptions: {
            bar: {
              columnWidth: "80%",
            },
          },
        },
      },
      {
        breakpoint: 1007,
        options: {
          chart: {
            height: 195,
          },
        },
      },
      {
        breakpoint: 992,
        options: {
          plotOptions: {
            bar: {
              columnWidth: "70%",
            },
          },
        },
      },
      {
        breakpoint: 768,
        options: {
          plotOptions: {
            bar: {
              columnWidth: "30%",
            },
          },
          xaxis: {
            tickAmount: 6,
          },
        },
      },
      {
        breakpoint: 576,
        options: {
          plotOptions: {
            bar: {
              columnWidth: "60%",
            },
          },
          grid: {
            padding: {
              right: 5,
            },
          },
        },
      },
    ],
  };

  var chartvisitor = new ApexCharts(document.querySelector("#visitor-chart"), optionsvisitor);
  chartvisitor.render();

  // radial chart
  function radialCommonOption(data) {
    return {
      series: data.radialYseries,
      chart: {
        height: 130,
        type: "radialBar",
        dropShadow: {
          enabled: true,
          top: 3,
          left: 0,
          blur: 10,
          color: data.dropshadowColor,
          opacity: 0.35,
        },
      },
      plotOptions: {
        radialBar: {
          hollow: {
            size: "60%",
          },
          track: {
            strokeWidth: "60%",
            opacity: 1,
            margin: 5,
          },
          dataLabels: {
            showOn: "always",
            value: {
              color: "var(--body-font-color)",
              fontSize: "14px",
              show: true,
              offsetY: -10,
            },
          },
        },
      },
      colors: data.color,
      stroke: {
        lineCap: "round",
      },
      responsive: [
        {
          breakpoint: 1500,
          options: {
            chart: {
              height: 130,
            },
          },
        },
      ],
    };
  }

  const radial1 = {
    color: ["var(--theme-default)"],
    dropshadowColor: "var(--theme-default)",
    radialYseries: [78],
  };

  const radialchart1 = document.querySelector("#radial-facebook");
  if (radialchart1) {
    var radialprogessChart1 = new ApexCharts(radialchart1, radialCommonOption(radial1));
    radialprogessChart1.render();
  }

  // radial 2
  const radial2 = {
    color: ["#FFA941"],
    dropshadowColor: "#FFA941",
    radialYseries: [70],
  };

  const radialchart2 = document.querySelector("#radial-instagram");
  if (radialchart2) {
    var radialprogessChart2 = new ApexCharts(radialchart2, radialCommonOption(radial2));
    radialprogessChart2.render();
  }

  // radial 3
  const radial3 = {
    color: ["#57B9F6"],
    dropshadowColor: "#57B9F6",
    radialYseries: [50],
  };

  const radialchart3 = document.querySelector("#radial-twitter");
  if (radialchart3) {
    var radialprogessChart3 = new ApexCharts(radialchart3, radialCommonOption(radial3));
    radialprogessChart3.render();
  }

  // radial 4
  const radial4 = {
    color: ["#FF3364"],
    dropshadowColor: "#FF3364",
    radialYseries: [80],
  };

  const radialchart4 = document.querySelector("#radial-youtube");
  if (radialchart4) {
    var radialprogessChart4 = new ApexCharts(radialchart4, radialCommonOption(radial4));
    radialprogessChart4.render();
  }

  // radial 5
  const radial5 = {
    color: ["var(--theme-default)"],
    dropshadowColor: "var(--theme-default)",
    radialYseries: [70],
  };

  const radialchart5 = document.querySelector("#radial-linkedin");
  if (radialchart5) {
    var radialprogessChart5 = new ApexCharts(radialchart5, radialCommonOption(radial5));
    radialprogessChart5.render();
  }

  // radial 6
  const radial6 = {
    color: ["var(--theme-secondary)"],
    dropshadowColor: "var(--theme-secondary)",
    radialYseries: [60],
  };

  const radialchart6 = document.querySelector("#radial-pinterest");
  if (radialchart6) {
    var radialprogessChart6 = new ApexCharts(radialchart6, radialCommonOption(radial6));
    radialprogessChart6.render();
  }

  // radial chart1 js
  function radialCommonOption1(data) {
    return {
      series: data.radialYseries,
      chart: {
        height: 150,
        type: "radialBar",
        dropShadow: {
          enabled: true,
          top: 3,
          left: 0,
          blur: 10,
          color: data.dropshadowColor,
          opacity: 0.35,
        },
      },
      plotOptions: {
        radialBar: {
          hollow: {
            size: "60%",
          },
          track: {
            strokeWidth: "45%",
            opacity: 1,
            margin: 5,
          },
          dataLabels: {
            showOn: "always",
            value: {
              color: "var(--chart-text-color)",
              fontSize: "18px",
              show: true,
              offsetY: -8,
            },
          },
        },
      },
      colors: data.color,
      stroke: {
        lineCap: "round",
      },
      responsive: [
        {
          breakpoint: 1500,
          options: {
            chart: {
              height: 130,
            },
          },
        },
      ],
    };
  }

  const radial7 = {
    color: ["var(--theme-default)"],
    dropshadowColor: "var(--theme-default)",
    radialYseries: [70],
  };

  const radialchart7 = document.querySelector("#radial-chart");
  if (radialchart7) {
    var radialprogessChart1 = new ApexCharts(radialchart7, radialCommonOption1(radial7));
    radialprogessChart1.render();
  }

  // radial 2
  const radial8 = {
    color: ["var(--theme-secondary)"],
    dropshadowColor: "var(--theme-secondary)",
    radialYseries: [80],
  };

  const radialchart8 = document.querySelector("#radial-chart1");
  if (radialchart8) {
    var radialprogessChart2 = new ApexCharts(radialchart8, radialCommonOption1(radial8));
    radialprogessChart2.render();
  }

  // bitcoin widget charts
  function widgetCommonOption(data) {
    return {
      series: [
        {
          data: data.widgetYseries,
        },
      ],
      chart: {
        width: 110,
        height: 110,
        type: "line",
        toolbar: {
          show: false,
        },
        offsetY: 10,
        dropShadow: {
          enabled: true,
          enabledOnSeries: undefined,
          top: 6,
          left: 0,
          blur: 6,
          color: data.dropshadowColor,
          opacity: 0.3,
        },
      },
      grid: {
        show: false,
      },
      colors: data.color,
      stroke: {
        width: 2,
        curve: "smooth",
      },
      labels: data.label,
      markers: {
        size: 0,
      },
      xaxis: {
        axisBorder: {
          show: false,
        },
        axisTicks: {
          show: false,
        },
        labels: {
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
      legend: {
        show: false,
      },
      tooltip: {
        marker: {
          show: false,
        },
        x: {
          show: false,
        },
        y: {
          show: false,
          labels: {
            show: false,
          },
        },
      },
      responsive: [
        {
          breakpoint: 1790,
          options: {
            chart: {
              width: 100,
              height: 100,
            },
          },
        },
        {
          breakpoint: 1661,
          options: {
            chart: {
              width: "100%",
              height: 100,
            },
          },
        },
      ],
    };
  }

  const widget1 = {
    color: ["#FFA941"],
    dropshadowColor: "#FFA941",
    label: ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov"],
    widgetYseries: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39],
  };

  const widgetchart1 = document.querySelector("#currency-chart");
  if (widgetchart1) {
    var bitcoinChart1 = new ApexCharts(widgetchart1, widgetCommonOption(widget1));
    bitcoinChart1.render();
  }

  // widget 2
  const widget2 = {
    color: ["var(--theme-default)"],
    dropshadowColor: "var(--theme-default)",
    label: ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep"],
    widgetYseries: [30, 25, 30, 25, 64, 40, 59, 52, 64],
  };

  const widgetchart2 = document.querySelector("#currency-chart2");
  if (widgetchart2) {
    var bitcoinChart2 = new ApexCharts(widgetchart2, widgetCommonOption(widget2));
    bitcoinChart2.render();
  }

  // widget 3
  const widget3 = {
    color: ["#54BA4A"],
    dropshadowColor: "#54BA4A",
    label: ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct"],
    widgetYseries: [30, 25, 36, 30, 64, 50, 45, 62, 60, 64],
  };

  const widgetchart3 = document.querySelector("#currency-chart3");
  if (widgetchart3) {
    var bitcoinChart3 = new ApexCharts(widgetchart3, widgetCommonOption(widget3));
    bitcoinChart3.render();
  }

  // NFT widgets

  function widgetCommonOption1(data) {
    return {
      series: [
        {
          data: data.widgetYseries,
        },
      ],
      chart: {
        width: 180,
        height: 100,
        type: "line",
        toolbar: {
          show: false,
        },
        offsetY: 10,
        dropShadow: {
          enabled: true,
          enabledOnSeries: undefined,
          top: 3,
          left: 0,
          blur: 3,
          color: data.dropshadowColor,
          opacity: 0.4,
        },
      },
      grid: {
        show: false,
      },
      colors: data.color,
      stroke: {
        width: 2,
        curve: "smooth",
      },
      labels: data.label,
      markers: {
        size: 0,
      },
      xaxis: {
        axisBorder: {
          show: false,
        },
        axisTicks: {
          show: false,
        },
        labels: {
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
      legend: {
        show: false,
      },
      tooltip: {
        marker: {
          show: false,
        },
        x: {
          show: false,
        },
        y: {
          show: false,
          labels: {
            show: false,
          },
        },
      },
      responsive: [
        {
          breakpoint: 1660,
          options: {
            chart: {
              width: 120,
            },
          },
        },
        {
          breakpoint: 768,
          options: {
            chart: {
              width: 300,
            },
          },
        },
        {
          breakpoint: 480,
          options: {
            chart: {
              width: 150,
            },
          },
        },
      ],
    };
  }
  const widget4 = {
    color: ["var(--theme-default)"],
    dropshadowColor: "var(--theme-default)",
    label: ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct"],
    widgetYseries: [30, 25, 64, 30, 45, 35, 64, 15, 30, 20],
  };

  const widgetchart4 = document.querySelector("#artist-chart");
  if (widgetchart4) {
    var artistChart1 = new ApexCharts(widgetchart4, widgetCommonOption1(widget4));
    artistChart1.render();
  }

  const widget5 = {
    color: ["#FFAA05"],
    dropshadowColor: "#FFAA05",
    label: ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov"],
    widgetYseries: [64, 10, 50, 20, 45, 35, 50, 5, 30, 20, 30],
  };

  const widgetchart5 = document.querySelector("#sale-chart");
  if (widgetchart5) {
    var saleChart1 = new ApexCharts(widgetchart5, widgetCommonOption1(widget5));
    saleChart1.render();
  }

  // Session chart
  var sessionChart = {
    series: [100, 30, 40],
    labels: ["Desktop", "Mobile", "Tablet"],
    chart: {
      height: 265,
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

  // activity chart
  var optionsactivity = {
    series: [
      {
        name: "Activity",
        data: [2, 4, 2.5, 1.5, 5.5, 1.5, 4],
      },
    ],
    chart: {
      height: 310,
      type: "bar",
      toolbar: {
        show: false,
      },
      dropShadow: {
        enabled: true,
        top: 10,
        left: 0,
        blur: 5,
        color: "#7064F5",
        opacity: 0.35,
      },
    },
    plotOptions: {
      bar: {
        borderRadius: 6,
        columnWidth: "30%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    xaxis: {
      categories: ["S", "M", "T", "W", "T", "F", "S"],
      labels: {
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
    yaxis: {
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
      labels: {
        formatter: function (val) {
          return val + " " + "Hr";
        },
        style: {
          fontSize: "12px",
          fontFamily: "Rubik, sans-serif",
          colors: "var(--chart-text-color)",
        },
      },
    },
    grid: {
      borderColor: "var(--chart-dashed-border)",
      strokeDashArray: 5,
    },
    colors: ["#7064F5", "#8D83FF"],
    fill: {
      type: "gradient",
      gradient: {
        shade: "light",
        type: "vertical",
        gradientToColors: ["#7064F5", "#8D83FF"],
        opacityFrom: 0.98,
        opacityTo: 0.85,
        stops: [0, 100],
      },
    },
    responsive: [
      {
        breakpoint: 1200,
        options: {
          chart: {
            height: 200,
          },
        },
      },
    ],
  };

  var chartactivity = new ApexCharts(document.querySelector("#activity-chart"), optionsactivity);
  chartactivity.render();

  // User-analytics
  var userAnalytics = {
    series: [
      {
        name: "Month",
        data: [4, 3, 3, 3, 4, 3, 3, 4, 5, 3.5, 2.5, 2.5],
      },
    ],
    chart: {
      height: 125,
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
      height: 148,
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
        breakpoint: 1400,
        options: {
          chart: {
            height: 232,
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
            height: 290,
          },
          xaxis: {
            tickAmount: 8,
            tickPlacement: "between",
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
      {
        breakpoint: 768,
        options: {
          chart: {
            height: 222,
          },
        },
      },
    ],
  };

  var visitChart = new ApexCharts(document.querySelector("#visit-chart"), visitUser);
  visitChart.render();
})();
