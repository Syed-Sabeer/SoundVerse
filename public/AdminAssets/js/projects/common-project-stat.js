// Project List chart

(function () {
  var options = {
    labels: ["Budget", "Cost", ""],
    series: [50, 30],
    chart: {
      type: "donut",
      height: 250,
      dropShadow: {
        enabled: true,
        top: 10,
        left: 0,
        blur: 6,
        color: ["#7366FF", "#838383", "#ffffff"],
        opacity: 0.2,
      },
    },
    plotOptions: {
      pie: {
        expandOnClick: false,
        startAngle: -90,
        endAngle: 90,
        offsetY: -20,
        offsetX: 0,
        donut: {
          size: "75%",
          labels: {
            show: true,
            name: {
              offsetY: -25,
            },
            value: {
              show: false,
            },
            total: {
              show: true,
              fontSize: "14px",
              fontFamily: "Rubik, sans-serif",
              fontWeight: 500,
              label: "Actual Cost",
              color: "#363636",
            },
          },
        },
      },
    },
    grid: {
      padding: {
        bottom: -120,
      },
    },
    legend: {
      show: false,
    },
    dataLabels: {
      enabled: false,
    },
    colors: [CubaAdminConfig.primary, "#65c15c", "#ffffff"],
    responsive: [
      {
        breakpoint: 1870,
        options: {
          chart: {
            height: 250,
          },
        },
      },
      {
        breakpoint: 1780,
        options: {
          chart: {
            height: 240,
          },
        },
      },
    ],
  };
  var chart = new ApexCharts(document.querySelector("#cost-performance"), options);
  chart.render();
})();
