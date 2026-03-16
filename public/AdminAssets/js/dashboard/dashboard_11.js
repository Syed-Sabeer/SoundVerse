// Dashboard 11 JS

(function () {
  // Application overview chart
  var appOverview = {
    series: [
      {
        type: "rangeArea",
        name: "Hired",

        data: [
          {
            x: "Jan",
            y: [5, 12],
          },
          {
            x: "Feb",
            y: [8, 13],
          },
          {
            x: "Mar",
            y: [6, 18],
          },
          {
            x: "Apr",
            y: [8, 16],
          },
          {
            x: "May",
            y: [16, 27],
          },
          {
            x: "Jun",
            y: [0, 11],
          },
          {
            x: "Jul",
            y: [11, 15],
          },
          {
            x: "Aug",
            y: [6, 10],
          },
        ],
      },

      {
        type: "rangeArea",
        name: "Applications",
        data: [
          {
            x: "Jan",
            y: [21, 24],
          },
          {
            x: "Feb",
            y: [30, 37],
          },
          {
            x: "Mar",
            y: [28, 35],
          },
          {
            x: "Apr",
            y: [24, 30],
          },
          {
            x: "May",
            y: [37, 43],
          },
          {
            x: "Jun",
            y: [39, 49],
          },
          {
            x: "Jul",
            y: [31, 33],
          },
          {
            x: "Aug",
            y: [13, 19],
          },
        ],
      },

      {
        type: "line",
        name: "Hired",
        data: [
          {
            x: "Jan",
            y: 8,
          },
          {
            x: "Feb",
            y: 11,
          },
          {
            x: "Mar",
            y: 12,
          },
          {
            x: "Apr",
            y: 13,
          },
          {
            x: "May",
            y: 20,
          },
          {
            x: "Jun",
            y: 5,
          },
          {
            x: "Jul",
            y: 13,
          },
          {
            x: "Aug",
            y: 8,
          },
          {
            x: "Sep",
            y: 12,
          },
          {
            x: "Oct",
            y: 14,
          },
        ],
      },
      {
        type: "line",
        name: "Applications",
        data: [
          {
            x: "Jan",
            y: 22,
          },
          {
            x: "Feb",
            y: 34,
          },
          {
            x: "Mar",
            y: 31,
          },
          {
            x: "Apr",
            y: 28,
          },
          {
            x: "May",
            y: 40,
          },
          {
            x: "Jun",
            y: 44,
          },
          {
            x: "Jul",
            y: 32,
          },
          {
            x: "Aug",
            y: 16,
          },
          {
            x: "Sep",
            y: 13,
          },
          {
            x: "Oct",
            y: 8,
          },
        ],
      },
    ],
    chart: {
      height: 170,
      type: "rangeArea",
      animations: {
        speed: 500,
      },
      toolbar: {
        show: false,
      },
    },
    colors: ["#ffb829", CubaAdminConfig.primary, "#ffb829", CubaAdminConfig.primary],
    dataLabels: {
      enabled: false,
    },
    fill: {
      opacity: [0.24, 0.24, 1, 1],
    },
    forecastDataPoints: {
      count: 2,
    },
    stroke: {
      curve: "straight",
      width: [0, 0, 2, 2],
    },
    yaxis: {
      min: 0,
      max: 50,
      tickAmount: 5,
      labels: {
        style: {
          colors: "#52526C",
          fontSize: "12px",
          fontFamily: "Rubik, sans-serif",
          fontWeight: 400,
        },
      },
    },
    xaxis: {
      axisTicks: {
        show: false,
      },
      axisBorder: {
        show: false,
      },
      tooltip: {
        enabled: false,
      },
      labels: {
        style: {
          colors: "#52526C",
          fontSize: "12px",
          fontFamily: "Rubik, sans-serif",
          fontWeight: 400,
        },
      },
    },
    legend: {
      show: false,
    },
    markers: {
      hover: {
        sizeOffset: 5,
      },
    },
    responsive: [
      {
        breakpoint: 1560,
        options: {
          xaxis: {
            tickAmount: 5,
            tickPlacement: "between",
          },
        },
      },
      {
        breakpoint: 793,
        options: {
          chart: {
            height: 185,
          },
        },
      },
    ],
  };

  var appOverview = new ApexCharts(document.querySelector("#app-overview"), appOverview);
  appOverview.render();
  //Birthday swiper
  var swiper = new Swiper(".swiper-11", {
    slidesPerView: 1,
    spaceBetween: 5,
    loop: true,
    autoplay: {
      delay: 2000,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

  // Project analytics
  var projectAnalytics = {
    series: [
      {
        name: "Designer",
        data: [3, 5, 7, 4, 6, 3, 4, 8, 7, 9, 12],
      },
      {
        name: "Developers",
        data: [5, 2, 8, 6, 7, 7, 8, 6, 8, 10, 9],
      },
      {
        name: "Managers",
        data: [4, 3, 3, 6, 7, 10, 13, 10, 12, 16, 17],
      },
      {
        name: "Sales & marketing",
        data: [2, 6, 2, 8, 7, 10, 10, 14, 13, 14, 19],
      },
    ],
    chart: {
      type: "bar",
      height: 290,
      stacked: true,
      toolbar: {
        show: false,
      },
      zoom: {
        enabled: false,
      },
    },
    colors: [CubaAdminConfig.primary, CubaAdminConfig.secondary, "#ffb829", "#65c15c"],
    plotOptions: {
      bar: {
        horizontal: false,
        borderRadius: 2,
        columnWidth: "30%",
        dataLabels: {
          total: {
            show: false,
          },
        },
      },
    },
    xaxis: {
      categories: ["Jan 2024", "Feb 2024", "Mar 2024", "Apr 2024", "May 2024", "Jun 2024", "Jul 2024", "Sep 2024", "Oct 2024", "Nov 2024", "Dec 2024"],
      labels: {
        show: true,
        style: {
          fontSize: "12px",
          fontFamily: "Rubik, sans-serif",
          colors: "#52526C",
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
      max: 60,
      tickAmount: 6,
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
      labels: {
        formatter: function (val) {
          return val + " " + "%";
        },
        style: {
          fontSize: "12px",
          fontFamily: "Rubik, sans-serif",
          colors: "#52526C",
        },
      },
    },
    legend: {
      show: false,
    },
    dataLabels: {
      enabled: false,
    },
    fill: {
      opacity: 1,
    },
    responsive: [
      {
        breakpoint: 1852,
        options: {
          chart: {
            height: 345,
          },
        },
      },
      {
        breakpoint: 1706,
        options: {
          chart: {
            height: 360,
          },
        },
      },
      {
        breakpoint: 1641,
        options: {
          chart: {
            height: 250,
          },
        },
      },
      {
        breakpoint: 1550,
        options: {
          xaxis: {
            tickAmount: 6,
            tickPlacement: "between",
          },
        },
      },
      {
        breakpoint: 1491,
        options: {
          chart: {
            height: 390,
          },
        },
      },
      {
        breakpoint: 1400,
        options: {
          chart: {
            height: 252,
          },
        },
      },
      {
        breakpoint: 646,
        options: {
          chart: {
            height: 215,
          },
        },
      },
    ],
  };

  var projectAnalytics = new ApexCharts(document.querySelector("#project_analytics"), projectAnalytics);
  projectAnalytics.render();
})();
