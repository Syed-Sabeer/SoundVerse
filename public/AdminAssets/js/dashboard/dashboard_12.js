// Dashboard 12 JS

(function () {
  var recentSwiper = new Swiper(".recent-slider", {
    slidesPerView: 2,
    grid: {
      rows: 1,
    },
    loop: true,
    autoplay: {
      delay: 2000,
    },
    spaceBetween: 20,
    navigation: {
      nextEl: ".next",
      prevEl: ".prev",
    },
  });

  // Function to update breakpoints based on class
  function updateBreakpoints() {
    if (document.body.classList.contains("box-layout")) {
      // Update breakpoints for box layout
      recentSwiper.params.breakpoints = {
        0: {
          slidesPerView: 1,
          spaceBetween: 15,
          grid: {
            rows: 1,
          },
        },
        700: {
          slidesPerView: 2,
          spaceBetween: 20,
          grid: {
            rows: 1,
          },
        },
        1080: {
          slidesPerView: 3,
          spaceBetween: 20,
          grid: {
            rows: 1,
          },
        },
      };
    } else {
      // Reset breakpoints to normal layout
      recentSwiper.params.breakpoints = {
        0: {
          slidesPerView: 1,
          spaceBetween: 15,
          grid: {
            rows: 1,
          },
        },
        700: {
          slidesPerView: 2,
          spaceBetween: 20,
          grid: {
            rows: 1,
          },
        },
        1080: {
          slidesPerView: 3,
          spaceBetween: 20,
          grid: {
            rows: 1,
          },
        },
        1400: {
          slidesPerView: 2,
          spaceBetween: 20,
          grid: {
            rows: 1,
          },
        },
      };
    }
    recentSwiper.update();
  }

  // Observe class changes on the body element
  const observer = new MutationObserver(() => {
    updateBreakpoints();
  });

  // Start observing the body element for class changes
  observer.observe(document.body, {
    attributes: true,
    attributeFilter: ["class"],
  });

  // Initial call to set breakpoints based on current class
  updateBreakpoints();

  // Project Dashboard
  var optionStatistics = {
    labels: ["In process", "Pending", "Completed"],
    series: [20, 25, 50],
    chart: {
      type: "donut",
      height: 340,
      animations: {
        enabled: true,
        easing: "easeinout",
        speed: 800,
        animateGradually: {
          enabled: true,
          delay: 150,
        },
        dynamicAnimation: {
          enabled: true,
          speed: 350,
        },
      },
    },
    dataLabels: {
      enabled: false,
    },
    legend: {
      position: "bottom",
      fontSize: "14px",
      fontFamily: "Rubik, sans-serif",
      fontWeight: 500,
      labels: {
        colors: "var(--chart-text-color)",
      },
      markers: {
        width: 6,
        height: 6,
      },
    },
    stroke: {
      width: 0,
      colors: ["var(--light2)"],
    },
    plotOptions: {
      pie: {
        expandOnClick: false,
        donut: {
          size: "72%",
          labels: {
            show: true,
            name: {
              offsetY: 0,
            },
            total: {
              show: true,
              fontSize: "20px",
              fontFamily: "Rubik, sans-serif",
              fontWeight: 600,
              label: "385",
              formatter: () => "Total Task",
            },
          },
        },
      },
    },
    states: {
      normal: {
        filter: {
          type: "none",
        },
      },
      hover: {
        filter: {
          type: "none",
        },
      },
      active: {
        allowMultipleDataPointsSelection: false,
        filter: {
          type: "none",
        },
      },
    },
    colors: ["#ffb829", "#65c15c", "var(--theme-default)"],
  };

  var taskStatistics = new ApexCharts(document.querySelector("#task-statistics"), optionStatistics);
  taskStatistics.render();

  // Estimated Project
  var estimatedOptions = {
    series: [
      {
        name: "Hour By Project",
        data: [25, 60, 70, -35, -105, -130, -130, -115, -95, -60, 15, 45, 105, 60, 35, 70, 105, 120, 140, 150, -20, -66, -95, -95, -60, -55, 15, 48, 105, 60, 25, 75],
      },
    ],
    chart: {
      type: "bar",
      height: 385,
      offsetX: 0,
      offsetY: 20,
      toolbar: {
        show: false,
      },
      animations: {
        enabled: true,
        easing: "easeinout",
        speed: 500,
        animateGradually: {
          enabled: true,
          delay: 150,
        },
        dynamicAnimation: {
          enabled: true,
          speed: 350,
        },
      },
    },
    plotOptions: {
      bar: {
        colors: {
          ranges: [
            {
              from: -150,
              to: 0,
              color: CubaAdminConfig.success,
            },
            {
              from: 0,
              to: 150,
              color: CubaAdminConfig.primary,
            },
          ],
        },
        columnWidth: "80%",
        borderRadius: 0,
      },
    },

    colors: [CubaAdminConfig.primary],
    dataLabels: {
      enabled: false,
    },
    yaxis: {
      title: {
        show: false,
      },

      labels: {
        formatter: function (y) {
          return y.toFixed(0) + "h";
        },
      },
    },

    grid: {
      show: true,
      strokeDashArray: 0,
      borderColor: "rgba(82, 82, 108, 0.1)",
      position: "back",
    },
    xaxis: {
      categories: ["Project_1", "", "", "", "", "Project_2", "", "", "", "", "Project_3", "", "", "", "", "Project_4", "", "", "", "", "Project_5", "", "", "", "", "Project_6", "", "", "", "", "Project_7"],
      labels: {
        rotate: -45,
        rotateAlways: false,
      },
      axisBorder: {
        low: 0,
        offsetX: 0,
        show: false,
      },
      axisTicks: {
        show: false,
      },
    },
    responsive: [
      {
        breakpoint: 1400,
        options: {
          chart: {
            height: 292,
          },
        },
      },
      {
        breakpoint: 911,
        options: {
          chart: {
            height: 275,
          },
        },
      },
    ],
  };

  var estimatedProjectChart = new ApexCharts(document.querySelector("#estimated-project"), estimatedOptions);
  estimatedProjectChart.render();

  // Monthly Expense
  var monthlyExpense = {
    series: [
      {
        name: "Monthly Expense",
        data: [0, 6, 30, 10, 20, 60, 30, 70, 70, 110, 70, 20, 70, 110, 50, 150, 50, 55, 0],
      },
    ],
    chart: {
      type: "area",
      height: 152,
      offsetY: -20,
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
    colors: [CubaAdminConfig.primary],
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
    responsive: [
      {
        breakpoint: 1400,
        options: {
          chart: {
            height: 120,
          },
        },
      },
      {
        breakpoint: 1200,
        options: {
          chart: {
            height: 105,
          },
        },
      },
      {
        breakpoint: 992,
        options: {
          chart: {
            height: 100,
          },
        },
      },
      {
        breakpoint: 906,
        options: {
          chart: {
            height: 120,
          },
        },
      },
      {
        breakpoint: 768,
        options: {
          chart: {
            height: 140,
          },
        },
      },
      {
        breakpoint: 762,
        options: {
          chart: {
            height: 160,
          },
        },
      },
    ],
  };
  var monthlyExpense = new ApexCharts(document.querySelector("#monthly-expense"), monthlyExpense);
  monthlyExpense.render();

  // Year Expenses
  var yearlyExpense = {
    series: [
      {
        name: "Yearly Expense",
        data: [50, 20, 50, 40, 30, 60, 30, 25, 48],
      },
    ],
    chart: {
      type: "bar",
      height: 152,
      stacked: false,
      offsetY: -40,
      toolbar: {
        show: false,
      },
      zoom: {
        enabled: false,
      },
    },

    grid: {
      show: false,
    },
    colors: ["rgba(101, 193, 92, 0.3)", "rgba(101, 193, 92, 0.3)", "rgba(101, 193, 92, 0.3)", "rgba(101, 193, 92, 0.3)", "rgba(101, 193, 92, 0.3)", "rgba(101, 193, 92, 0.3)", "rgba(101, 193, 92, 0.3)", "rgba(101, 193, 92, 0.3)", "#65c15c"],
    plotOptions: {
      bar: {
        vertical: true,
        distributed: true,
        borderRadius: 0,
        columnWidth: "80%",
        backgroundBarColors: ["#65c15c"],
        backgroundBarOpacity: 1,
        dataLabels: {
          total: {
            show: false,
          },
        },
      },
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
    },
    yaxis: {
      show: false,
      min: 0,
      max: 60,
      tickAmount: 6,
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
    },
    tooltip: {
      enabled: true,
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
        breakpoint: 1400,
        options: {
          chart: {
            height: 120,
          },
        },
      },
      {
        breakpoint: 1350,
        options: {
          chart: {
            height: 122,
          },
        },
      },
      {
        breakpoint: 1200,
        options: {
          chart: {
            height: 110,
          },
        },
      },
      {
        breakpoint: 1060,
        options: {
          chart: {
            height: 115,
          },
        },
      },
      {
        breakpoint: 992,
        options: {
          chart: {
            height: 110,
          },
        },
      },
      {
        breakpoint: 768,
        options: {
          chart: {
            height: 130,
          },
        },
      },
    ],
  };
  var yearlyExpense = new ApexCharts(document.querySelector("#yearly-expense"), yearlyExpense);
  yearlyExpense.render();

  // Project analysis
  var projectAnalysis = {
    series: [
      {
        name: "Earnings",
        type: "column",
        data: [25, 18, 15, 32, 16, 22, 18, 24, 15, 22, 19, 24],
      },
      {
        name: "Task",
        type: "line",
        data: [40, 10, 50, 10, 70, 10, 65, 10, 55, 10, 75, 20, 40],
      },
      {
        name: "Project",
        type: "line",
        data: [15, 41, 22, 30, 50, 15, 43, 23, 38, 20, 30, 10, 25],
      },
    ],
    chart: {
      height: 290,
      type: "line",
      stacked: false,
      toolbar: {
        show: false,
      },
      dropShadow: {
        enabled: true,
        enabledOnSeries: [2],
        top: 10,
        left: 0,
        blur: 4,
        color: "#7366FF",
        opacity: 0.2,
      },
    },
    stroke: {
      width: [0, 2, 3],
      curve: "smooth",
      dashArray: [0, 4, 0],
    },
    plotOptions: {
      bar: {
        columnWidth: "30%",
      },
    },
    colors: ["var(--chart-progress-light)", "#ffb829", "#7366FF"],
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
      discrete: [
        {
          seriesIndex: 2,
          dataPointIndex: 0,
          fillColor: "#7366FF",
          strokeColor: "var(--white)",
          size: 6,
          sizeOffset: 3,
        },
        {
          seriesIndex: 2,
          dataPointIndex: 1,
          fillColor: "#7366FF",
          strokeColor: "var(--white)",
          size: 6,
        },
        {
          seriesIndex: 2,
          dataPointIndex: 2,
          fillColor: "#7366FF",
          strokeColor: "var(--white)",
          size: 6,
        },
        {
          seriesIndex: 2,
          dataPointIndex: 4,
          fillColor: "#7366FF",
          strokeColor: "var(--white)",
          size: 6,
        },
        {
          seriesIndex: 2,
          dataPointIndex: 5,
          fillColor: "#7366FF",
          strokeColor: "var(--white)",
          size: 6,
        },
        {
          seriesIndex: 2,
          dataPointIndex: 6,
          fillColor: "#7366FF",
          strokeColor: "var(--white)",
          size: 6,
        },
        {
          seriesIndex: 2,
          dataPointIndex: 7,
          fillColor: "#7366FF",
          strokeColor: "var(--white)",
          size: 6,
        },
        {
          seriesIndex: 2,
          dataPointIndex: 8,
          fillColor: "#7366FF",
          strokeColor: "var(--white)",
          size: 6,
        },
        {
          seriesIndex: 2,
          dataPointIndex: 9,
          fillColor: "#7366FF",
          strokeColor: "var(--white)",
          size: 6,
        },
        {
          seriesIndex: 2,
          dataPointIndex: 10,
          fillColor: "#7366FF",
          strokeColor: "var(--white)",
          size: 6,
        },
        {
          seriesIndex: 2,
          dataPointIndex: 11,
          fillColor: "#7366FF",
          strokeColor: "var(--white)",
          size: 6,
        },
        {
          seriesIndex: 2,
          dataPointIndex: 12,
          fillColor: "#7366FF",
          strokeColor: "var(--white)",
          size: 6,
        },
      ],
      hover: {
        size: 6,
        sizeOffset: 0,
      },
    },
    xaxis: {
      categories: ["Jan", "Feb", "Mar", " Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      tickPlacement: "on",
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
      tickPlacement: "on",

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
        breakpoint: 1400,
        options: {
          chart: {
            height: 292,
          },
        },
      },
      {
        breakpoint: 486,
        options: {
          xaxis: {
            tickAmount: 4,
          },
        },
      },
    ],
  };

  var projectAnalysisChart = new ApexCharts(document.querySelector("#project-analysis"), projectAnalysis);
  projectAnalysisChart.render();
})();
