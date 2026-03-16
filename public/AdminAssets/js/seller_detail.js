// Seller details JS

(function () {
  // Total Earnings
  var vendorEarning = {
    series: [
      {
        name: "Earnings",
        data: [600, 679, 850, 760, 870, 740, 910, 1025, 970, 800, 1040, 1199],
      },
    ],
    fill: {
      type: "gradient",
      gradient: {
        type: "vertical",
        shadeIntensity: 0.4,
        gradientToColors: "#ffb829",
        opacityFrom: 0.4,
        opacityTo: 0,
        stops: [0, 90, 100],
        colorStops: [],
      },
    },
    chart: {
      height: 230,
      type: "area",
      dropShadow: {
        enabled: true,
        color: "#ffb829",
        top: 8,
        left: 0,
        blur: 2,
        opacity: 0.2,
      },
      toolbar: {
        show: false,
      },
    },
    colors: ["#ffb829"],
    dataLabels: {
      enabled: true,
      formatter: function (val) {
        return "$" + val;
      },
    },
    textAnchor: "middle",
    style: {
      fontSize: "12px",
      fontFamily: "Rubik, sans-serif",
      fontWeight: "bold",
      borderRadius: 2,
      colors: undefined,
    },

    stroke: {
      curve: "smooth",
      width: 3,
    },
    tooltip: {
      x: {
        show: false,
      },
      z: {
        show: false,
      },
      y: {
        formatter: function (val) {
          return "$" + val;
        },
      },
    },
    markers: {
      size: 1,
    },
    xaxis: {
      categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "July", "Aug", "Sep", "Oct", "Nov", "Dec"],
      axisTicks: {
        show: false,
      },
      axisBorder: {
        show: false,
      },
    },
    yaxis: {
      min: 500,
      max: 1200,
      tickAmount: 4,
    },
    legend: {
      show: false,
    },
    responsive: [
      {
        breakpoint: 575,
        options: {
          xaxis: {
            type: "category",
            tickAmount: 6,
            tickPlacement: "on",
          },
        },
      },
    ],
  };

  var vendorEarning = new ApexCharts(document.querySelector("#seller-earning"), vendorEarning);
  vendorEarning.render();

  // Total Orders
  var vendorOrders = {
    series: [
      {
        name: "Orders",
        data: [30, 50, 105, 80, 120, 40, 90, 150, 60, 160, 170, 140],
      },
    ],
    fill: {
      type: "gradient",
      gradient: {
        type: "vertical",
        shadeIntensity: 0.4,
        gradientToColors: "#65c15c",
        opacityFrom: 0.4,
        opacityTo: 0,
        stops: [0, 90, 100],
        colorStops: [],
      },
    },
    chart: {
      height: 230,
      type: "area",
      dropShadow: {
        enabled: true,
        color: "#65c15c",
        top: 8,
        left: 0,
        blur: 2,
        opacity: 0.2,
      },
      toolbar: {
        show: false,
      },
    },
    colors: ["#65c15c"],
    dataLabels: {
      enabled: true,
    },
    textAnchor: "middle",
    style: {
      fontSize: "12px",
      fontFamily: "Helvetica, Arial, sans-serif",
      fontWeight: "bold",
      borderRadius: 2,
      colors: undefined,
    },

    stroke: {
      curve: "smooth",
      width: 3,
    },
    tooltip: {
      x: {
        show: false,
      },
      z: {
        show: false,
      },
    },
    markers: {
      size: 1,
    },
    xaxis: {
      categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "July", "Aug", "Sep", "Oct", "Nov", "Dec"],
      axisTicks: {
        show: false,
      },
      axisBorder: {
        show: false,
      },
    },
    yaxis: {
      min: 0,
      max: 200,
      tickAmount: 4,
    },
    legend: {
      show: false,
    },
    responsive: [
      {
        breakpoint: 575,
        options: {
          xaxis: {
            type: "category",
            tickAmount: 6,
            tickPlacement: "on",
          },
        },
      },
    ],
  };

  var vendorOrders = new ApexCharts(document.querySelector("#seller-orders"), vendorOrders);
  vendorOrders.render();

  // Total Products
  var vendorProducts = {
    series: [
      {
        name: "Products",
        data: [130, 160, 140, 100, 140, 130, 189, 120, 156, 106, 112, 175],
      },
    ],
    fill: {
      type: "gradient",
      gradient: {
        type: "vertical",
        shadeIntensity: 0.4,
        gradientToColors: "#7366FF",
        opacityFrom: 0.4,
        opacityTo: 0,
        stops: [0, 90, 100],
        colorStops: [],
      },
    },
    chart: {
      height: 230,
      type: "area",
      dropShadow: {
        enabled: true,
        color: "#7366FF",
        top: 8,
        left: 0,
        blur: 2,
        opacity: 0.2,
      },
      toolbar: {
        show: false,
      },
    },
    colors: ["#7366FF"],
    dataLabels: {
      enabled: true,
    },
    textAnchor: "middle",
    style: {
      fontSize: "12px",
      fontFamily: "Helvetica, Arial, sans-serif",
      fontWeight: "bold",
      borderRadius: 2,
      colors: undefined,
    },

    stroke: {
      curve: "smooth",
      width: 3,
    },
    tooltip: {
      x: {
        show: false,
      },
      z: {
        show: false,
      },
    },
    markers: {
      size: 1,
    },
    xaxis: {
      categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "July", "Aug", "Sep", "Oct", "Nov", "Dec"],
      axisTicks: {
        show: false,
      },
      axisBorder: {
        show: false,
      },
    },
    yaxis: {
      min: 0,
      max: 200,
      tickAmount: 4,
    },
    legend: {
      show: false,
    },
    responsive: [
      {
        breakpoint: 575,
        options: {
          xaxis: {
            type: "category",
            tickAmount: 6,
            tickPlacement: "on",
          },
        },
      },
    ],
  };

  var vendorProducts = new ApexCharts(document.querySelector("#seller-products"), vendorProducts);
  vendorProducts.render();

  // =================== Editors =====================
  var editor11 = new Quill("#editor11", {
    modules: { toolbar: "#toolbar11" },
    theme: "snow",
    placeholder: "Enter your messages...",
  });
  var editor12 = new Quill("#editor12", {
    modules: { toolbar: "#toolbar12" },
    theme: "snow",
    placeholder: "Enter your messages...",
  });
  var editor13 = new Quill("#editor13", {
    modules: { toolbar: "#toolbar13" },
    theme: "snow",
    placeholder: "Enter your messages...",
  });
})();
