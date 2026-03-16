// Vector map JS

(function () {
  document.addEventListener("DOMContentLoaded", () => {
    const map = document.getElementById("map");
    if (map) {
      const map = new jsVectorMap({
        selector: "#map",
        map: "world",
        regionStyle: {
          initial: {
            fill: "rgba(170, 175, 203, 0.3)",
            fillOpacity: 1,
          },
        },
        markers: [
          { name: "Algeria", coords: [-14.235, -51.9253], style: { image: "../assets/images/dashboard-10/location.png", height: 100, width: 50 } },
          { name: "Chile", coords: [35.8617, 104.1954], style: { image: "../assets/images/dashboard-10/location.png", height: 100, width: 50 } },
          { name: "United Kingdom", coords: [55.3781, 3.436], style: { image: "../assets/images/dashboard-10/location.png", height: 100, width: 50 } },
          { name: "Egypt", coords: [26.8206, 30.8025], style: { image: "../assets/images/dashboard-10/location.png", height: 100, width: 50 } },
          { name: "United States", coords: [37.0902, -95.7129], style: { image: "../assets/images/dashboard-10/location.png", height: 100, width: 50 } },
          { name: "China", coords: [90.8206, 20.105], style: { image: "../assets/images/dashboard-10/location.png", height: 100, width: 50 } },
          { name: "Botswana", coords: [69.8206, 12.8025], style: { image: "../assets/images/dashboard-10/location.png", height: 100, width: 50 } },
        ],
        selectedMarkers: [0],
      });
    } else {
      const countryMap = new jsVectorMap({
        selector: "#countryMap",
        map: "world",
        regionStyle: {
          initial: {
            fill: "rgba(170, 175, 203, 0.3)",
            fillOpacity: 1,
          },
        },
        markers: [
          { name: "Algeria", coords: [-14.235, -51.9253], style: { image: "../assets/images/dashboard-10/location.png", height: 100, width: 50 } },
          { name: "Chile", coords: [35.8617, 104.1954], style: { image: "../assets/images/dashboard-10/location.png", height: 100, width: 50 } },
          { name: "United Kingdom", coords: [55.3781, 3.436], style: { image: "../assets/images/dashboard-10/location.png", height: 100, width: 50 } },
          { name: "Egypt", coords: [26.8206, 30.8025], style: { image: "../assets/images/dashboard-10/location.png", height: 100, width: 50 } },
          { name: "United States", coords: [37.0902, -95.7129], style: { image: "../assets/images/dashboard-10/location.png", height: 100, width: 50 } },
          { name: "China", coords: [90.8206, 20.105], style: { image: "../assets/images/dashboard-10/location.png", height: 100, width: 50 } },
          { name: "Botswana", coords: [69.8206, 12.8025], style: { image: "../assets/images/dashboard-10/location.png", height: 100, width: 50 } },
        ],
        selectedMarkers: [0],
      });
    }
  });
})();
