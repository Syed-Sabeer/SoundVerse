// Dashboard 5 JS

(function () {
  // radial chart js
  function radialCommonOption(data) {
    return {
      series: data.radialYseries,
      chart: {
        height: 120,
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
            size: "55%",
          },
          track: {
            strokeWidth: "55%",
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
    color: ["var(--theme-secondary)"],
    dropshadowColor: "var(--theme-secondary)",
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
    radialYseries: [58],
  };

  const radialchart3 = document.querySelector("#radial-twitter");
  if (radialchart3) {
    var radialprogessChart3 = new ApexCharts(radialchart3, radialCommonOption(radial3));
    radialprogessChart3.render();
  }

  // radial 4
  const radial4 = {
    color: ["#ffb829"],
    dropshadowColor: "#ffb829",
    radialYseries: [60],
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
    radialYseries: [80],
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
    radialYseries: [40],
  };

  const radialchart6 = document.querySelector("#radial-pinterest");
  if (radialchart6) {
    var radialprogessChart6 = new ApexCharts(radialchart6, radialCommonOption(radial6));
    radialprogessChart6.render();
  }

  // instagram subscriber chart
  var optionssubscriber = {
    series: [
      {
        name: "growth",
        type: "line",
        data: [12, 10, 25, 12, 30, 10, 55, 45, 60],
      },
      {
        name: "growth",
        type: "line",
        data: [10, 15, 20, 18, 38, 25, 55, 35, 60],
      },
    ],
    chart: {
      height: 220,
      type: "line",
      toolbar: {
        show: false,
      },
      dropShadow: {
        enabled: true,
        top: 8,
        left: 0,
        blur: 2,
        color: ["#FFA941", "#7366FF"],
        opacity: 0.1,
      },
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
    colors: ["#FFA941", "#7366FF"],
    stroke: {
      width: 2,
      curve: "smooth",
      opacity: 1,
    },
    markers: {
      discrete: [
        {
          seriesIndex: 1,
          dataPointIndex: 4,
          fillColor: "#7064F5",
          strokeColor: "var(--white)",
          size: 6,
        },
      ],
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
      categories: ["Sep 5", "Sep 8", "Sep 12", "Sep 16", "Sep 18", "Sep 17", "Sep 23", "Sep 26", "Sep 30"],
      tickAmount: 12,
      crosshairs: {
        show: false,
      },
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
    fill: {
      opacity: 1,
      type: "gradient",
      gradient: {
        shade: "light",
        type: "horizontal",
        shadeIntensity: 1,
        opacityFrom: 0.95,
        opacityTo: 1,
        stops: [0, 90, 100],
      },
    },
    yaxis: {
      min: 10,
      max: 60,
      tickAmount: 5,
      labels: {
        formatter: function (val) {
          return val + "k";
        },
        style: {
          colors: "var(--chart-text-color)",
          fontSize: "12px",
          fontFamily: "Rubik, sans-serif",
          fontWeight: 400,
        },
      },
    },
    legend: {
      show: false,
    },
    responsive: [
      {
        breakpoint: 1694,
        options: {
          chart: {
            height: 245,
          },
        },
      },
      {
        breakpoint: 1400,
        options: {
          chart: {
            height: 222,
            width: "100%",
          },
          xaxis: {
            tickAmount: 6,
          },
        },
      },
      {
        breakpoint: 1235,
        options: {
          xaxis: {
            tickAmount: 4,
          },
        },
      },
      {
        breakpoint: 1353,
        options: {
          chart: {
            height: 245,
          },
        },
      },
      {
        breakpoint: 1200,
        options: {
          chart: {
            height: 260,
          },
        },
      },
      {
        breakpoint: 1040,
        options: {
          chart: {
            height: 240,
          },
        },
      },
      {
        breakpoint: 992,
        options: {
          chart: {
            height: 255,
          },
        },
      },
    ],
  };

  var subscriberchart = new ApexCharts(document.querySelector("#subscriber-chart"), optionssubscriber);
  subscriberchart.render();

  // Photo Click
  var photoClick1 = {
    series: [
      {
        name: "Clicks",
        data: [20, 22, 20, 23, 23, 18, 18, 15, 15, 20, 20, 22, 22, 20, 20, 22, 22],
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
      curve: "smooth",
      width: 3,
    },
    xaxis: {
      type: "category",
      categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "July", "Aug", "Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "Mar", "Apr"],
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
    colors: [CubaAdminConfig.primary],
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
    responsive: [
      {
        breakpoint: 1400,
        options: {
          chart: {
            height: 140,
          },
        },
      },
    ],
  };
  var photoClick1 = new ApexCharts(document.querySelector("#photo-click1"), photoClick1);
  photoClick1.render();

  // Link Clicks
  var linkClick1 = {
    series: [
      {
        name: "Clicks",
        data: [20, 22, 20, 23, 21, 22, 18, 18, 21, 21, 25, 25, 20, 20, 25, 25, 18, 18],
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
      curve: "smooth",
      width: 3,
    },
    xaxis: {
      type: "category",
      categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "July", "Aug", "Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "Mar", "Apr"],
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
    responsive: [
      {
        breakpoint: 1400,
        options: {
          chart: {
            height: 140,
          },
        },
      },
    ],
  };
  var linkClick1 = new ApexCharts(document.querySelector("#link-click1"), linkClick1);
  linkClick1.render();

  // Follower Click
  var followerClick = {
    series: [
      {
        name: "Followers",
        data: [20, 22, 20, 23, 23, 19, 19, 16, 16, 21, 21, 20, 20, 25, 25, 22, 22],
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
      curve: "smooth",
      width: 3,
    },
    xaxis: {
      type: "category",
      categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "July", "Aug", "Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "Mar", "Apr"],
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
    colors: ["#65c15c"],
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
    responsive: [
      {
        breakpoint: 1400,
        options: {
          chart: {
            height: 140,
          },
        },
      },
    ],
  };
  var followerClick = new ApexCharts(document.querySelector("#follower-click"), followerClick);
  followerClick.render();

  // Engagement Link
  var engagementLink = {
    series: [
      {
        name: "Engagement",
        data: [20, 22, 20, 23, 23, 18, 18, 15, 15, 20, 20, 22, 22, 20, 20, 22, 22],
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
      curve: "smooth",
      width: 3,
    },
    xaxis: {
      type: "category",
      categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "July", "Aug", "Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "Mar", "Apr"],
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
    colors: ["#ffb829"],
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
    responsive: [
      {
        breakpoint: 1400,
        options: {
          chart: {
            height: 140,
          },
        },
      },
    ],
  };
  var engagementLink = new ApexCharts(document.querySelector("#engagement-link"), engagementLink);
  engagementLink.render();

  // Youtube Analysis
  var youtubeAnalysis = {
    series: [
      {
        name: "Followers",
        data: [58, 29, 39, 19, 75, 58, 32, 67, 50, 22, 44, 49],
      },
      {
        name: "Comments",
        data: [45, 69, 32, 70, 45, 32, 50, 40, 45, 60, 40, 45],
      },
      {
        name: "Likes",
        data: [18, 39, 60, 30, 18, 40, 35, 50, 18, 30, 25, 60],
      },
    ],
    chart: {
      type: "bar",
      height: 350,
      toolbar: {
        show: false,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "60%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    colors: ["var(--theme-default)", "#AAAFCB", "#65c15c"],
    xaxis: {
      categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
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
      min: 10,
      max: 80,
      labels: {
        formatter: function (val) {
          return val + "k";
        },
        style: {
          colors: "#52526C",
          fontSize: "12px",
          fontFamily: "Rubik, sans-serif",
          fontWeight: 400,
        },
      },
    },
    fill: {
      opacity: 1,
    },
    legend: {
      show: false,
    },
    grid: {
      show: true,
      position: "back",
      borderColor: "var(--chart-border)",
    },
    responsive: [
      {
        breakpoint: 446,
        options: {
          xaxis: {
            type: "category",
            tickAmount: 5,
            tickPlacement: "between",
          },
        },
      },
      {
        breakpoint: 808,
        options: {
          chart: {
            height: 360,
          },
        },
      },
    ],
  };

  var youtubeAnalysis = new ApexCharts(document.querySelector("#youtube-analysis"), youtubeAnalysis);
  youtubeAnalysis.render();

  // Facebook Analysis
  var facebookAnalysis = {
    series: [
      {
        name: "Followers",
        data: [10, 25, 25, 30, 12, 26, 10, 16, 40, 35, 20, 21],
      },
      {
        name: "Comments",
        data: [20, 15, 35, 17, 47, 36, 25, 13, 14, 45, 48, 36],
      },
      {
        name: "Likes",
        data: [25, 33, 15, 12, 16, 34, 45, 20, 24, 33, 44, 21],
      },
    ],
    chart: {
      type: "bar",
      height: 350,
      toolbar: {
        show: false,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "60%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    colors: ["var(--theme-default)", "#AAAFCB", "#65c15c"],
    xaxis: {
      categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    },
    yaxis: {
      min: 10,
      max: 80,
      labels: {
        formatter: function (val) {
          return val + "k";
        },
        style: {
          colors: "#52526C",
          fontSize: "12px",
          fontFamily: "Rubik, sans-serif",
          fontWeight: 400,
        },
      },
    },
    fill: {
      opacity: 1,
    },
    legend: {
      show: false,
    },
    grid: {
      show: true,
      borderColor: "var(--chart-border)",
    },
    responsive: [
      {
        breakpoint: 446,
        options: {
          xaxis: {
            type: "category",
            tickAmount: 5,
            tickPlacement: "between",
          },
        },
      },
    ],
  };

  var facebookAnalysis = new ApexCharts(document.querySelector("#facebook-analysis"), facebookAnalysis);
  facebookAnalysis.render();

  // Instagram Analysis
  var instagramAnalysis = {
    series: [
      {
        name: "Followers",
        data: [58, 29, 39, 19, 75, 58, 32, 67, 50, 22, 44, 49],
      },
      {
        name: "Comments",
        data: [45, 69, 32, 70, 45, 32, 50, 40, 45, 60, 40, 45],
      },
      {
        name: "Likes",
        data: [18, 39, 60, 30, 18, 40, 35, 50, 18, 30, 25, 60],
      },
    ],
    chart: {
      type: "bar",
      height: 350,
      toolbar: {
        show: false,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "60%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    colors: ["var(--theme-default)", "#AAAFCB", "#65c15c"],
    xaxis: {
      categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    },
    yaxis: {
      min: 10,
      max: 80,
      labels: {
        formatter: function (val) {
          return val + "k";
        },
        style: {
          colors: "#52526C",
          fontSize: "12px",
          fontFamily: "Rubik, sans-serif",
          fontWeight: 400,
        },
      },
    },
    grid: {
      show: true,
      borderColor: "var(--chart-border)",
    },
    fill: {
      opacity: 1,
    },
    legend: {
      show: false,
    },
    responsive: [
      {
        breakpoint: 446,
        options: {
          xaxis: {
            type: "category",
            tickAmount: 5,
            tickPlacement: "between",
          },
        },
      },
    ],
  };

  var instagramAnalysis = new ApexCharts(document.querySelector("#instagram-analysis"), instagramAnalysis);
  instagramAnalysis.render();

  //  LinkedIn Analysis
  var linkedInAnalysis = {
    series: [
      {
        name: "Followers",
        data: [56, 40, 35, 12, 16, 34, 50, 12, 18, 21, 18, 28],
      },
      {
        name: "Comments",
        data: [20, 10, 14, 26, 35, 44, 35, 17, 15, 29, 35, 48],
      },
      {
        name: "Likes",
        data: [16, 35, 50, 35, 68, 49, 25, 14, 12, 30, 47, 18],
      },
    ],
    chart: {
      type: "bar",
      height: 350,
      toolbar: {
        show: false,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "60%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    colors: ["var(--theme-default)", "#AAAFCB", "#65c15c"],
    xaxis: {
      categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    },
    yaxis: {
      min: 10,
      max: 80,
      labels: {
        formatter: function (val) {
          return val + "k";
        },
        style: {
          colors: "#52526C",
          fontSize: "12px",
          fontFamily: "Rubik, sans-serif",
          fontWeight: 400,
        },
      },
    },
    fill: {
      opacity: 1,
    },
    legend: {
      show: false,
    },
    grid: {
      show: true,
      borderColor: "var(--chart-border)",
    },
    responsive: [
      {
        breakpoint: 446,
        options: {
          xaxis: {
            type: "category",
            tickAmount: 5,
            tickPlacement: "between",
          },
        },
      },
    ],
  };

  var linkedInAnalysis = new ApexCharts(document.querySelector("#linked-analysis"), linkedInAnalysis);
  linkedInAnalysis.render();

  //  Twitter Analysis
  var twitterAnalysis = {
    series: [
      {
        name: "Followers",
        data: [56, 46, 35, 12, 16, 34, 62, 34, 65, 35, 18, 28],
      },
      {
        name: "Comments",
        data: [20, 10, 14, 26, 35, 44, 35, 17, 65, 29, 35, 48],
      },
      {
        name: "Likes",
        data: [16, 35, 78, 35, 68, 49, 25, 14, 12, 30, 47, 18],
      },
    ],
    chart: {
      type: "bar",
      height: 350,
      toolbar: {
        show: false,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "60%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    colors: ["var(--theme-default)", "#AAAFCB", "#65c15c"],
    xaxis: {
      categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    },
    yaxis: {
      min: 10,
      max: 80,
      labels: {
        formatter: function (val) {
          return val + "k";
        },
        style: {
          colors: "#52526C",
          fontSize: "12px",
          fontFamily: "Rubik, sans-serif",
          fontWeight: 400,
        },
      },
    },
    fill: {
      opacity: 1,
    },
    legend: {
      show: false,
    },
    grid: {
      show: true,
      borderColor: "var(--chart-border)",
    },
    responsive: [
      {
        breakpoint: 446,
        options: {
          xaxis: {
            type: "category",
            tickAmount: 5,
            tickPlacement: "between",
          },
        },
      },
    ],
  };

  var twitterAnalysis = new ApexCharts(document.querySelector("#twitter-analysis"), twitterAnalysis);
  twitterAnalysis.render();
})();
